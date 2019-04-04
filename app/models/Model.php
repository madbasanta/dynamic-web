<?php
_require('database/QueryBuilder.php');
_model('BaseModel');

class Model extends BaseModel
{
	protected $table;
	protected $fields = [];
	protected $builder;
	protected $fillable = [];
	private $exp = [];
	private $select = [];

	static function table($table) {
		$model = new static;
		$model->setTable($table);
		return $model;
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

	function save($data = []) {
		$this->setFields($data);
		$this->builder->createSaveQuery($this->table, $this->fields);
		$this->builder->execute();
		$id = $this->builder->result();
		return $this->where(['id' => $id])->first();
	}

	function update($data = []) {
		$this->setFields($data);
		$this->builder->createUpdateQuery($this->table, $this->fields, $this->exp);
		$this->builder->execute();
		return $this->builder->getResult();
	}

	function select(...$columns) {
		$this->select = array_merge($this->select, $columns);
		return $this;
	}

	function where($conditions) {
		$this->exp = array_merge($this->exp, $conditions);
		return $this;
	}

	function get(...$columns) {
		$this->select = count($columns) ? $columns : $this->select;
		$this->builder->createReadQuery($this->table, $this->select, $this->exp);
		$this->builder->execute();
		return $this->builder->result();
	}

	function first() {
		$append = ' limit 1';
		$this->builder->createReadQuery($this->table, $this->select, $this->exp, $append);
		$this->builder->execute();
		return $this->builder->result()->fetch_object();
	}
}