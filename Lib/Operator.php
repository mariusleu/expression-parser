<?php
namespace Lib;

class Operator
{
	public $operator;
	public $priority;

	const PLUS = '+';
	const MINUS = '-';
	const PROD = '*';
	const DIV = '/';
	const POW = '^';
	const SENTINEL = '#';

	public function __construct($operator, $priority)
	{
		$this->operator = $operator;
		$this->priority = $priority;
	}

	/**
	 * Verifica daca obiectul (operator) este egal cu un operator dat sub forma de caracter.
	 * 
	 * @param  char $operator
	 * @return bool
	 */
	public function equals($operator)
	{
		if ($this->operator == $operator)
		{
			return true;
		}
		return false;
	}
}