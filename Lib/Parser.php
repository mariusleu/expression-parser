<?php
namespace Lib;

use Lib\Stack as Stack;
use Lib\Operator as Operator;

class Parser
{
	/** @var array Stocheaza token-urile generate */
	protected $tokens;

	protected $operators = [
		Operator::SENTINEL => 0,
		Operator::PLUS => 1,
		Operator::MINUS => 1,
		Operator::PROD => 2,
		Operator::DIV => 2,
		Operator::POW => 3,
	];

	public function __construct($str)
	{
		$str = Operator::SENTINEL . str_replace(' ', '', $str) . Operator::SENTINEL;
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
	 * Rezolva o expresie intre 2 operanzi.
	 * 
	 * @param  numeric $op1
	 * @param  numeric $op2
	 * @param  char $op_type
	 * @return numeric
	 */
	protected function solve($op1, $op2, $op_type)
	{
		switch ($op_type)
		{
			case Operator::PLUS: return $op1 + $op2;
			case Operator::MINUS: return $op1 - $op2;
			case Operator::PROD: return $op1 * $op2;
			case Operator::DIV: return $op1 / $op2;
			case Operator::POW: return pow($op1, $op2);
		}
		return 0;
	}

	/**
	 * Parser::evaluate()
	 * 
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
						if ($token == Operator::SENTINEL && $operatorTop->equals(Operator::SENTINEL))
						{
							break;
						}
						
						$top = $operands->pop();
						$beforeTop = $operands->pop();

						$operands->push($this->solve($beforeTop, $top, $operatorTop->operator));
						$operators->pop();
						$operatorTop = $operators->top();

						$opDone++;

						if ($operatorTop->priority < $this->operators[$token] || 
							($operatorTop->equals($token) && $token == Operator::SENTINEL))
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