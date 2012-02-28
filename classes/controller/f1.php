<?php defined('SYSPATH') or die ('No direct script access');

class Controller_F1 extends Controller_Application {
	
	/**
	* @var string Selects which realm to apply for request.
	*/
	public $realm;
	
	public function action_index()
	{
		/**
		* Check to see if session exist if not then authenticate through f1 and set tokens
		*
		*/
		$access_token = $this->_session->get('access_token');
		$token_secret = $this->_session->get('token_secret');
		
		if(!isset($access_token) || !isset($token_secret))
		{
			$login = new f1();
			$api = $login->authenticate_user($this->_f1config['username'], $this->_f1config['password']);
		
			$this->_session->set('access_token', $api['tokens'][1]);
			$this->_session->set('token_secret', $api['tokens'][2]);	
		}
		else
		{
			$login = new f1();
			$api = $login->authenticate_user($this->_f1config['username'], $this->_f1config['password']);
		}
		
		$api['data']->initAccessToken($this->_session->get('access_token'), $this->_session->get('token_secret'));
		
		$realm = $this->request->param('realm');
		$request = $this->request->param('request');
		$param[] = $this->request->param('id');
		$param[] = $this->request->param('alt_id');
		$param[] = $this->request->param('alt_var');
		
		/**
		* Load correct config file for the realm requested.
		*/
		$realm_config = Kohana::config($realm);
		
		/**
		* Grab url for request and start configuring the url for the request replacing vars inside the url.
		*/
		$config_url = preg_split($this->_f1config['var_pattern'], $realm_config[$request]);
		
		/**
		 * Helper method to create url with config url, replace vars with params
		 */
		$request_url = Helper_Needle::create_url($this->_f1config['var_pattern'], $realm_config[$request], $param);
		
		// var_dump($config_url);
		// exit();
		
		// preg_match_all($this->_f1config['var_pattern'], $realm_config[$request], $ids_in_string, PREG_PATTERN_ORDER);
		
		/**
		* Set array to index 0 for extra array level added from preg_match_all
		*/
		// $ids_in_string = $ids_in_string[0];
		
		/**
		 * Check if {id} is in array and favor it first if not then go in sequence
		 */
		// if(in_array('{id}', $ids_in_string))
		// {
			/**
			 * Find which index is variable {id}
			 */
			// $key_match = array_search('{id}', $ids_in_string);
			//$ids_in_string[$key_match] = $id;
			
			/*
				TODO not sure i like how this is setup will need to refigure
				###################################
				LEFT OFF HERE
				###################################
			*/
			// foreach($ids_in_string as $some_id)
			// {
				// if($some_id != $ids_in_string[$key_match] && $some_id != $alt_var && $some_id != $alt_id)
				// {
					// $some_id = $alt_id;
				// }
				// elseif ($some_id != $ids_in_string[$key_match])
				// {
					// $some_id = $alt_var;
				// }
				// else
				// {
					// $some_id = $id;
				// }
				
				// $ids_array[] = $some_id;
				
			// }
								
		// }
		// else
		// {
			
			/**
			 * If {id} not in string build id array
			 */
			
			/*
				TODO may need to just do ids in consecutive order will be easiest and best way
			*/
			// for($i = 0; $i <= count($ids_in_string); $i++)
			// {
				
			// }
			
			// var_dump($ids_array);
			
		// }

		// $request_url = $this->_f1config['base_url'] . $request;
		
	}
	
}