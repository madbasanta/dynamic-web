<?php
_require('database/QueryBuilder.php');

class BaseModel
{
	protected $table;
	protected $fillable = [];
	private $fields = [];
	private $builder;
	private $exp = [];
	private $select = [];
	private $append = [];

	function __construct($data = []) {
		$this->builder = new QueryBuilder(get_called_class());
		$this->table = isset($this->table) ? $this->table : strtolower(get_class($this)) . 's';
		$this->setFields($data);
	}

	function __set($name, $value) {
		$this->fields[$name] = $value;
	}

	function __get($name) {
		if(isset($this->fields[$name]))
			return $this->fields[$name];
		return null;
	}

	function _toArray() {
		return $this->fields;
	}

	static function table($table) {
		$model = new static;
		$model->setTable($table);
		return $model;
	}

	function setTable($table) {
		$this->table = $table;
	}

	static function create($arr = []) {
		$me = new static($arr);
		return $me->save();
	}

	function setFields($data) {
		foreach ($this->fillable as $key)
			if(isset($data[$key])) {
				$this->fields[$key] = $this->builder->escape_string($data[$key]);
			}
	}

	function _save($data = []) {
		$this->setFields($data);
		$this->builder->createSaveQuery($this->table, $this->fields);
		$this->builder->execute();
		$id = $this->builder->result();
		return $this->where(['id' => $id])->first();
	}

	function _update($data = []) {
		$this->setFields($data);
		$this->builder->createUpdateQuery($this->table, $this->fields, $this->exp);
		$this->builder->execute();
		return $this->builder->result();
	}

	function _delete() {
		$this->builder->createDeleteQuery($this->table, $this->exp);
		$this->builder->execute();
		return $this->builder->result();
	}

	function _select($column) {
		$columns = gettype($column) === 'string' ? func_get_args() : $column;
		$this->select = array_merge($this->select, $columns);
		return $this;
	}

	function _where($conditions) {
		$conditions = $conditions instanceof DB ? ['raw' => $conditions] : $conditions;
		$this->exp = array_merge($this->exp, $conditions);
		return $this;
	}

	function _count() {
		$this->builder->createReadQuery($this->table, ['count(*) as total'], $this->exp);
		$this->builder->execute();
		return $this->builder->result()[0]->total ?? 0;
	}

	function _get(...$columns) {
		$this->select = count($columns) ? $columns : $this->select;
		$this->builder->createReadQuery($this->table, $this->select, $this->exp, join(' ', $this->append));
		$this->builder->execute();
		return $this->builder->result();
	}

	function _json() {
		$this->builder->setClass('StdClass');
		return $this->_get();
	}

	function _fetch() {
		$this->builder->createReadQuery($this->table, $this->select, $this->exp, join(' ', $this->append));
		$this->builder->fetchArray();
		return $this->builder->result();
	}

	function _first() {
		$this->builder->createReadQuery($this->table, $this->select, $this->exp, ' limit 1');
		$this->builder->execute();
		return $this->builder->first_result();
	}

	function _leftjoin($table, $condition1, $operator, $condition2 = null) {
		$this->builder->join('left join', $table, $condition1, $condition2?:$operator, $condition2?$operator:'=');
		return $this;
	}

	function _join($table, $condition1, $operator, $condition2 = null) {
		$this->builder->join('join', $table, $condition1, $condition2?:$operator, $condition2?$operator:'=');
		return $this;
	}

	function _limit($max) {
		array_push($this->append, "limit $max");
		return $this;
	}

	function _offset($skip) {
		array_push($this->append, "offset $skip");
		return $this;
	}

	function _groupBy() {
		$column = join(', ', func_get_args());
		array_push($this->append, "group by $column");
		return $this;
	}

	function _orderBy($column, $order = 'asc') {
		$column = gettype($column) === 'string' ? [$column => $order] : $column;
		$sql = 'order by';
		foreach($column as $key => $value)
			$sql .= " $key $value,";
		array_push($this->append, rtrim($sql, ','));
		return $this;
	}

	function _paginate(int $per_page = 15) {
		$request = request();
		$current_page = (int) $request->input('page', 1);
		$offset = ($current_page - 1) * $per_page;

		$results = $this->count();
		$this->limit($per_page)->offset($offset);
		
		$last_page = (int)ceil($results/$per_page);
		return (object) [
			'data' => $this->json(), 'total' => $results, 
			'per_page' => $per_page, 'current_page' => $current_page, 'last_page' => $last_page, 
			'previous_page' => ($current_page-1)?:null, 'next_page' => $current_page != $last_page && $last_page?$current_page+1:null ///
		];
	}
	
	public function setClass($class) {
		$this->builder->setClass($class);
		return $this;
	}
}