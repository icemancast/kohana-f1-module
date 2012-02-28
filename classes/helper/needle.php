<?php defined('SYSPATH') or die('No direct script access');

class Helper_Needle {
	
	public $string;
	
	public static function find_header($needle, $array)
	{
		// Find needle in haystack
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
	
	public static function create_url($pattern, $request, $param)
	{
		// $url_array = preg_match($pattern, $request, PREG_SPLIT_OFFSET_CAPTURE);
		preg_match_alL($pattern, $request, $url_replace_array, PREG_PATTERN_ORDER);
		
		$url_replace_array = $url_replace_array[0]; // Get rid of first array layer
		
		if(in_array('{id}', $url_replace_array))
		{
			foreach($url_replace_array as $key => $value)
			{
				if($value == '{id}')
				{
					// Set/favor first parameter to id
					$url_replace_array[$key] = $param[0];
				}
				else
				{
					// Set to 2nd passed parameter
					$url_replace_array[$key] = $param[1];
				}
				
			}
		}
		else
		{
			foreach($url_replace_array as $key => $value)
			{
				$i = 0;
				$url_replace_array[$key] = $param[$i];
				$i++;
			}
		}
		
		$url_array = preg_replace(array($pattern), $url_replace_array, $request);
		
		// var_dump($pattern_array);
		
		echo '<br /><br />';
		
		var_dump($url_replace_array);
		
		echo '<br /><br />';
		
		echo $url_array;
		
		// Start building url
	}
	
}