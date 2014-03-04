<?php

namespace \Lib\Stack;

class Stack
{
	private $data = [];

	public function push($element)
	{
		$this->data[] = $element;
	}

	public function pop()
	{
		return array_pop($this->data);
	}
/*
	public function empty()
	{
		$this->data = [];
	} */

	public function size()
	{
		return count($this->data);
	}
}