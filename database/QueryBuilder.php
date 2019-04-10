<?php
class QueryBuilder
{
	private $meta;
	private $pdo;
	private $create = 'insert into %s(%s) values(%s)';
	private $read = 'select %s from %s where %s';
	private $update = 'update %s set $s where %s';
	private $query;
	private $result;
	private $model;
	private $table_join;

	function __construct($model) {
		$this->meta = config('database');
		$this->pdo = new Mysqli(
			$this->meta['host'], 
			$this->meta['username'], 
			$this->meta['password'], 
			$this->meta['db_name']
		);
		if($this->pdo->error) {
			throw new Exception($this->pdo->error);
		}
		$this->model = $model;
	}

	private function run() {
		$result = $this->pdo->query($this->query);
		if($message = $this->pdo->error) {
			throw new Exception($message);
		}
		if($id = $this->pdo->insert_id) {
			$this->result = $id;
		}
		if($result->num_rows) {
			$this->result = [];
			while($v = $result->fetch_object($this->model)) {
				array_push($this->result, $v);
			}
		}
		return $this->result;
	}

	function createSaveQuery($table, $data = []) {
		$colums = array_keys($data);
		$values = array_map(function($value) { return "'$value'"; }, array_values($data));
		$this->query = sprintf($this->create, $table, join(', ', $colums), join(', ', $values));
	}

	function createUpdateQuery($table, $data = [], $conditions = [1 => 1]) {
		$values = '';
		foreach($data as $column => $value)
			$values .= " $column = '$value',";
		$exp = $this->conditionString($conditions);
		$this->query = sprintf($this->update, $table, rtrim($values, ','), $exp);
	}

	function createReadQuery($table, $columns, $exp, $appends = '') {
		$table = $this->table($table);
		$columns = count($columns) ? join(', ', $columns) : '*';
		$exp = $this->conditionString($exp);
		$this->query = sprintf($this->read, $columns, $table, $exp) . $appends;
	}

	function execute() {
		// debugger($this->query);
		return $this->run();
	}

	function result() {
		return $this->result;
	}
	function first_result() {
		return isset($this->result[0]) ? $this->result : null;
	}

	function escape_string($un_escaped) {
		return $this->pdo->real_escape_string($un_escaped);
	}
	function conditionString($conditions) {
		$exp = '1 = 1';
		foreach($conditions as $key => $value)
			$exp .= " $key = '$value' AND";
		return rtrim($exp, 'AND');
	}

	private function table($table) {
		return "$table $this->table_join";
	}
	public function join($type, $table, $con1, $con2, $operator) {
		$this->table_join = "$type $table on $con1 $operator $con2";
	}
}