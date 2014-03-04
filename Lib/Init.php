<?php

/**
 * Un simplu autoloader ce incarca clasele automat in functie de apel.
 */

spl_autoload_register(function ($class_name) {

	$file = str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';

	if ( ! is_file($file = ROOT . $file))
	{
		exit(sprintf('Nu se poate incarca clasa %s. Asigurati-va ca aceasta exista in biblioteca.', $class_name));
	}

	require $file;
});

/**
 * O prescurtare pentru vardump. Formateaza raspunsul primit de la acesta.
 * 
 * @return void
 */
function dd()
{
	echo '<pre>';
	call_user_func_array('var_dump', func_get_args());
	echo '</pre>';
}