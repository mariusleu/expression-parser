<?php

namespace Lib;

class Stack
{
	private $data = [];

	/**
	 * Impinge un element in capul stivei.
	 *
	 * @param  mixed $element
	 * @return mixed
	 */
	public function push($element)
	{
		return $this->data[] = $element;
	}

	/**
	 * Inlatura un element din stiva, returnandu-i valoarea.
	 * 	
	 * @return mixed
	 */
	public function pop()
	{
		if ($this->size() > 0)
		{
			return array_pop($this->data);
		}
		throw new EmptyStackAccessException;
	}

	/**
	 * Returneaza elementul din capul stivei.
	 * 
	 * @return mixed
	 */
	public function top()
	{
		$size = $this->size();

		if ($size > 0)
		{
			return $this->data[$size - 1];
		}
		throw new EmptyStackAccessException;
	}

	/**
	 * Indeparteaza toate elementele stivei.
	 * 
	 * @return void
	 */
	public function clear()
	{
		$this->data = [];
	}

	/**
	 * Returneaza numarul de elemente din stiva.
	 * 
	 * @return int
	 */
	public function size()
	{
		return count($this->data);
	}
}

class EmptyStackAccessException extends \Exception {}