<?php defined('SYSPATH') or die ('No direct script access');

class Controller_F1 extends Controller_Application {
	
	//public $f1_config = Kohana::config('f1');
	
	public function action_index()
	{
		
		parent::before();
		
		$f1_config = Kohana::config('f1');
		
		$login = new f1();
		
		$login_info = $login->authenticate_user($this->_f1config['username'], $this->_f1config['password']);
		
		$person = $api_consumer->doRequest($person_location, $content_type);
		
		 //$test = $_session->get('access_token');
		 echo $test;
		//
	
		
	}
	
	/*
		TODO Maybe move this function to main kohana f1 module so information is served up in a var as opposed to be displayed however i want.
	*/
	public function action_request()
	{
		$realm = $this->request->param('realm');
		$request = $this->request->param('request');
				
		$realm_config = Kohana::config($realm);
		
		var_dump($login_info);
		
		//echo $request;
			
		//$person = $api_consumer->doRequest($request, $content_type);
	}
	
}