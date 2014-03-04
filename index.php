<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('LIB', ROOT . 'Lib' . DS);

require 'Lib/Init.php';

use Lib\Stack as Stack;
use Lib\Parser as Parser;

$expression = '(2+5/2)-4';
//$expression = '2+5/2-4';
//$expression = '2/2-4+4-9/3';

$parser = new Parser($expression);
echo $expression . ' = ' . $parser->evaluate();