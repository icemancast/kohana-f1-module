<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_F1
{
	
	public $request_url, $request_body, $content_type, $f1config, $_session;
	
	private $password;
	
	public function __construct()
	{
		/**
		 * CHANGED: Require files on load of class
		 * load, oauth library, utility and signer
		 */
		require_once Kohana::find_file('vendor', 'f1/f1_oauth');
		require_once Kohana::find_file('vendor', 'f1/f1_util');
		require_once Kohana::find_file('vendor', 'f1/f1_signer');
	}
	
	public function authenticate_user($username, $password)
	{
		// Separate domain from username for authenticating			
		
		
		$this->f1_config = Kohana::config('f1');
		
		// Concatenate url string for request url
		$this->request_url = $this->f1_config['base_url'] . $this->f1_config['accesstoken_path'];
		
		// Create request body per f1 documentation and examples
		$this->request_body = rawurlencode(base64_encode($username . ' ' . $password));
		$this->request_body = str_replace('%7E', '~', $this->request_body);
		$this->request_body = str_replace('+', ' ', $this->request_body);
		
		// Set content type to json
		$content_type = $this->f1_config['set_content_type'];
		
		$api_consumer = new F1_Oauth($this->f1_config['base_url'], $this->f1_config['consumer_key'], $this->f1_config['consumer_secret']);
		
		$request_body = $api_consumer->postRequest($this->request_url, $this->request_body , $content_type,  200);
		
		// Get tokens and token secret
		preg_match( "~oauth_token\=([^\&]+)\&oauth_token_secret\=([^\&]+)~i", $request_body, $tokens );
		
		if( !isset( $tokens[1] ) || !isset( $tokens[2] ) ) {
			
			/**
			 * TODO: Change to view and notify website admin
			 */
			// Get response headers
			$response_headers = $api_consumer->getResponseHeader();
			
			//var_dump($response_headers);
			
			$status = Helper_Needle::find_header('HTTP/1.1 400 Bad Request ', $response_headers);
			
			throw new Kohana_Exception($status);
		
		} else {
			
			$_session = Session::instance();
			
			$_session->set('access_token', $tokens[1]);
			$_session->set('token_secret', $tokens[2]);
			
			//$access_token = $tokens[1];
			//$token_secret = $tokens[2];
			
			// Load access_token and token_secret in session
			// $api_consumer->initAccessToken($access_token, $token_secret);
			$api_consumer->initAccessToken($_session->get('access_token'), $_session->get('token_secret'));
			
			#var_dump($api_consumer);
			
			// Get response headers
			#$response_headers = $api_consumer->getResponseHeader();
						
			#$person_location = Helper_Needle::find_header('Content-Location: ', $response_headers);
			
			#echo $person_location . '<br /><br />';
						
			#$person = $api_consumer->doRequest($person_location, $content_type);
			
			// Set session to logged in
			
			#$person = json_decode($person, TRUE);
			#$person = $person['person'];
			
			$_session->set('login', true);
			
			return $api_consumer;			
			
			#return $person;
			
		}
		
	}
}