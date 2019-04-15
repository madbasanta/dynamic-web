<?php

class QueryBuilder
{
	private $meta;
	private $pdo;
	private $create = 'insert into %s(%s) values(%s)';
	private $read = 'select %s from %s where %s';
	private $update = 'update %s set %s where %s';
	private $delete = 'delete from %s where %s';
	private $query;
	private $result;
	private $model;
	private $table_join = [];

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
		// dd($this->query);
		$result = $this->pdo->query($this->query);
		if($message = $this->pdo->error) {
			throw new Exception($message);
		}
		if(isset($result->num_rows) && is_numeric($result->num_rows)) {
			$this->result = [];
			for($i = 0; $i < $result->num_rows; $i++)
				array_push($this->result, $result->fetch_object($this->model));
		} else {
			$this->result = $result;
		}
		if($id = $this->pdo->insert_id) {
			$this->result = $id;
		}
		return $this->result;
	}

	private function runQuery() {
		// dd($this->query);
		$result = $this->pdo->query($this->query);
		if($message = $this->pdo->error) {
			throw new Exception($message);
		}
		if(isset($result->num_rows) && is_numeric($result->num_rows)) {
			$this->result = [];
			for($i = 0; $i < $result->num_rows; $i++)
				array_push($this->result, $result->fetch_assoc());
		} else {
			$this->result = $result;
		}
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

	function createDeleteQuery($table, $exp) {
		$exp = $this->conditionString($exp);
		$this->query = sprintf($this->delete, $table, $exp);
	}

	function execute() {
		// dd($this->query);
		return $this->run();
	}

	function prepare($query) {
		$this->query = $query;
		return $this;
	}

	function fetchArray() {
		return $this->runQuery();
	}

	function setClass($class) {
		$this->model = $class;
		return $this;
	}

	function result() {
		return $this->result;
	}
	function first_result() {
		return is_array($this->result) && isset($this->result[0]) ? $this->result[0] : null;
	}

	function escape_string($un_escaped) {
		$un_escaped = trim($un_escaped);
		if ($un_escaped == '') return null;
		return $this->pdo->real_escape_string($un_escaped);
	}
	function conditionString($conditions = []) {
		$exp = '';
		$conditions = count($conditions) > 0 ? $conditions : [1 => 1];
		
		foreach($conditions as $key => $value) {
			if ($value instanceof DB) {
				$exp .= " $value AND";
			} else {
				$exp .= " $key = '$value' AND";
			}			
		}
		return rtrim($exp, 'AND');
	}

	private function table($table) {
		return $table .' '. join(' ', $this->table_join);
	}
	public function join($type, $table, $con1, $con2, $operator) {
		$this->table_join[] = "$type $table on $con1 $operator $con2";
	}
}

class DB
{
	private $query;

	function __construct($query) {
		$this->query = $query;
	}

	public function __toString() {
		return $this->query;
	}

	static function raw($query) {
		return new static($query);
	}

	static function table($table) {
		$m = new static;
		$m->setTable($table);
		$m->setClass('StdClass');
		return $m;
	}
}