<?php
namespace Lib;

class Operator
{
	public $operator;
	public $priority;

	public function __construct($operator, $priority)
	{
		$this->operator = $operator;
		$this->priority = $priority;
	}

	public function equals($operator)
	{
		if ($this->operator == $operator)
		{
			return true;
		}
		return false;
	}
}