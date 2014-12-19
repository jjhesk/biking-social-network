<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 
 /* Array Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------

 
 /*
The result will be:
Array
(
    [0] => apple
    [1] => bear
    [2] => Tom Cruise
    [3] => or
    [4] => Mickey Mouse
    [5] => another
    [6] => word
)

1. Accepted delimiters: white spaces (space, tab, new line etc.) and commas.

2. You can use either simple (') or double (") quotes for expressions which contains more than one word.
  * 
  * 
  * 
  */
if(! function_exists('searcharray')){
function searcharray($name){
//$search_expression = "apple bear \"Tom Cruise\" or 'Mickey Mouse' another word";
$words = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|" . "[\s,]*'([^']+)'[\s,]*|" . "[\s,]+/", $name, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
//print_r($words);
return $words;
}
}

/**
 * Element
 *
 * Lets you determine whether an array index is set and whether it has a value.
 * If the element is empty it returns FALSE (or whatever you specify as the default value.)
 *
 * @access	public
 * @param	array
 * @param	include_table_tag
 * @param	extraTD			replace [row] or [row_first_value]
 * @param	formSubmit submit as form with key and action, input action script
 * @return	string 	HTML tables
 * @resource http://php.net/manual/en/function.strpos.php
 * 
 * 
 * My version of strpos with needles as an array. Also allows for a string, or an array inside an array.
 * 
 * // Test
echo strpos_array('This is a test', array('test', 'drive')); // Output is 10
 * 
 */	
 
if (!function_exists('strpos_array')){
	function strpos_array($haystack, $needles) {
    if ( is_array($needles) ) {
        foreach ($needles as $str) {
            if ( is_array($str) ) {
                $pos = strpos_array($haystack, $str);
            } else {
                $pos = strpos($haystack, $str);
            }
            if ($pos !== FALSE) {
                return $pos;
            }
        }
    } else {
        return strpos($haystack, $needles);
    }
}	
}
	/**
	 * Extends date helper to return current time in MySQL datetime format
	 * By Dave Rogers
	 * Shinytype.com
	 *
	 * @access  public
	 * @param   string (optional)
	 * @return  string
	 */	
if (!function_exists('mysql_datetime')){
	function mysql_datetime($date = null) {
		if (!$date) {
			// use now() instead of time() to adhere to user setting
			$date = now();
		}
		if (is_numeric($date) && strlen($date) == 10) {
			return mdate("%Y-%m-%d %H:%i:%s", $date);
		} else {
			// try to use now()
			return mdate("%Y-%m-%d %H:%i:%s", now());
		}
	}
}


	/**
	 * Take a MySQL datetime var and turn it into PHP's Unix Epoch time
	 *
	 * @access  public
	 * @param   string
	 *
	 */
if(!function_exists('datetime_to_unix'))
{ 
	function datetime_to_unix($date) {
		if (!$date) {
			return false;
		} else {
			return date('U', strtotime($date));
		}
	}
}



	/**
	 * Take a MySQL datetime var and turn it into a human-readable date/time
	 *
	 * @access public
	 * @param string
	 * @return int
	 */
if(!function_exists('datetime_to_human')){ 
	function datetime_to_human($date, $datestring = '') {
		if (!$date) {
			return false;
		} else {
			if ($datestring == '')
				$datestring = "%d/%m/%Y";
			$d = datetime_to_unix($date);
			return mdate($datestring, $d);
		}
	}
}
if(!function_exists('get_from_array')){ 
	function get_from_array($arr, $start, $length) {
		$sliced = array();
		foreach ($arr as $k => $v) {
			if ($start <= $k && $k <= $start + $length - 1) {
				$sliced[] = $v;
				if (count($sliced) == $length)
					break;
			}
		}
		return $sliced;
	}
}
?>