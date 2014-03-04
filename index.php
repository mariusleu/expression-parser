<?php

require 'Lib/Autoloader.php';

$loader = new Autoloader;
$loader->setIncludePath(dirname(__FILE__));
$loader->register();

use Lib\Parser as Parser;

$expression = '2^(5+2)-20/5';
$parser = new Parser($expression);
echo $expression . ' = ' . $parser->evaluate();