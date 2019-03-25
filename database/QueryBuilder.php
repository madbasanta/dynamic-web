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

	function __construct() {
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
	}

	private function run() {
		$this->result = $this->pdo->query($this->query);
		if($message = $this->pdo->error) {
			throw new Exception($message);
		}
		if($id = $this->pdo->insert_id) {
			$this->result = $id;
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
		$columns = count($columns) ? join(', ', $columns) : '*';
		$exp = $this->conditionString($exp);
		$this->query = sprintf($this->read, $columns, $table, $exp) . $appends;
	}

	function execute() {
		return $this->run();
	}

	function result() {
		return $this->result;
	}

	function escape_string($un_escaped) {
		return $this->pdo->real_escape_string($un_escaped);
	}
	function conditionString($conditions) {
		$exp = '';
		foreach($conditions as $key => $value)
			$exp .= " $key = '$value' AND";
		return rtrim($exp, 'AND');
	}
}