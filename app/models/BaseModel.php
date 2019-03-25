<?php

class BaseModel
{
	function __construct($data = []) {
		$this->builder = new QueryBuilder();
		$this->table = isset($this->table) ? $this->table : strtolower(get_class($this)) . 's';
		$this->setFields($data);
	}

	function setTable($table) {
		$this->table = $table;
	}
}