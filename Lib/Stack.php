<?php

namespace Lib;

class Stack
{
	private $data = [];

	public function push($element)
	{
		$this->data[] = $element;
	}

	public function pop()
	{
		if ($this->size() > 0)
		{
			return array_pop($this->data);
		}
		throw new EmptyStackAccessException;
	}

	public function top()
	{
		$size = $this->size();

		if ($size > 0)
		{
			return $this->data[$size - 1];
		}
		throw new EmptyStackAccessException;
	}

	public function clear()
	{
		$this->data = [];
	}

	public function size()
	{
		return count($this->data);
	}
}

class EmptyStackAccessException extends \Exception {}