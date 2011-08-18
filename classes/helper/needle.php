<?php defined('SYSPATH') or die('No direct script access');

class Helper_Needle {
	
	public $string;
	
	public static function find_header($needle, $array)
	{
		// Get person link to retreive person object
		foreach($array as $value) {
						
			// Find the position
			$pos = strpos($value, $needle);
			
			// If value is in string pull it
			if($pos !== false)
			{
				$string = str_replace($needle, '', $value);
			}
		}
				
		return $string;
		
	}
	
}