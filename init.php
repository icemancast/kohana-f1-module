<?php defined('SYSPATH') or die('No direct script access.');

$modules = Kohana::modules();


Route::set('f1', '(<controller>(/<action>(/<realm>(/<request>(/<id>(/<alt_id>))))))')
	->defaults(array(
		'controller' => 'f1',
		'action'     => 'index',
	));