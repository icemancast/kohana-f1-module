<?php defined('SYSPATH') or die('No direct script access.');

$modules = Kohana::modules();


Route::set('f1', '(<controller>(/<realm>(/<request>(/<id>(/<alt_id>(/<alt_var>))))))')
	->defaults(array(
		'controller' => 'f1',
		'action'     => 'index',
	));