<?php defined('SYSPATH') or die ('No direct script access');

class Controller_Application extends Controller {
	
	protected $_session, $_f1config;
	
	public function before()
	{
		parent::before();
		
		$this->_session = Session::instance();
		
		$this->_f1config = Kohana::config('f1');
		
		/*
			TODO Place config file here so i can use on all pages.
		*/
	}
	
}