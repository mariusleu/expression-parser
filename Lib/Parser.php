<?php
namespace Lib;

use Lib\Stack as Stack;
use Lib\Operator as Operator;

class Parser
{
	/** @var array Stocheaza token-urile generate */
	protected $tokens;

	protected $operators = [
		'#' => 0,
		'+' => 1,
		'-' => 1,
		'*' => 2,
		'/' => 2,
		'^' => 3,
	];

	public function __construct($str)
	{
		$str = '#' . str_replace(' ', '', $str) . '#';
		$this->tokens = $this->tokenize($str);
	}

	/**
	 * Are rolul de a imparti expresia in token-uri in functie de operatorii suportati
	 * de parserul nostru. 
	 * 
	 * @param  string $str
	 * @return array
	 */
	protected function tokenize($str)
	{
		return str_split($str);
	}

	/**
	 * Preia in prioritatea din token-ul
	 * @param  array $token
	 * @return int 
	 */
	protected function getPriority($token)
	{
		return $token[1];
	}

	protected function solve($op1, $op2, $op_type)
	{
		switch ($op_type)
		{
			case '+': return $op1 + $op2;
			case '-': return $op1 - $op2;
			case '*': return $op1 * $op2;
			case '/': return $op1 / $op2;
			case '^': return pow($op1, $op2);
		}
		return 0;
	}

	/**
	 * Executa operatiile necesare interpretarii expresiilor folosind metoda celor 2 stive.
	 * @return int/float
	 */
	public function evaluate()
	{
		$operators = new Stack;
		$operands  = new Stack;

		$priority = 0;

		foreach ($this->tokens as $token)
		{
			if ($token == '(') 
			{
				$priority += 10;
				continue;
			}

			if ($token == ')')
			{
				$priority -= 10;
				continue;
			}

			$opDone = 0;

			if (isset($this->operators[$token]))
			{
				if ($operators->size() > 0)
				{
					$operatorTop = $operators->top();

					while ($operatorTop->priority >= $priority + $this->operators[$token])
					{
						if ($token == '#' && $operatorTop->equals('#'))
						{
							break;
						}

						$top = $operands->pop();
						$beforeTop = $operands->pop();

						$operands->push($this->solve($beforeTop, $top, $operatorTop->operator));
						$operators->pop();
						$operatorTop = $operators->top();

						$opDone++;

						if ($operatorTop->priority < $this->operators[$token] || ($operatorTop->equals($token) && $token == '#'))
						{
							$opDone = 0;
						}
						
					}
				}
				if ($opDone == 0)
				{
					$operators->push(new Operator($token, $priority + $this->operators[$token]));
				}
			}
			else
			{
				$operands->push($token);
			}
		}

		return $operands->top();
	}
}