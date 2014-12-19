<?php

// This class main check the input parameter
class Assert {

    public static function _check( $bool, $msg,$die=true ){
        if(!$bool){
            	Error::die_err($msg, $die);
        }
    }
    
    public static function check_int($val, $die=true) {
    	$result =(is_numeric($val) && trim($val)!="");
		 Assert::_check($result, "$val is not interger !" , $die);
		 return $result;
    }
	
	public static function check_id( $val ,$die=true ) {
		 $result =(is_numeric($val) && trim($val)!="" && $val!=0);
		 Assert::_check($result, "$val is not ID !" , $die);
		 return $result;
	}
	
	public static function check_string($val, $non_empty=false , $die=true ) {
	 	Assert::_check(!is_null($val), "$val is null" , $die);
        Assert::_check(is_string($val) || is_numeric($val), "$val is not string (actual '".print_r($val, true)."')" ,$die );
        $val = "$val";
        if($non_empty) {
            Assert::_check(trim($val) != '', "$val String is expected to be nonempty", $die);
        }
	}
	
	public static function check_object($val  , $die=true) {
		 $result=(is_object($val) && $val);
		 Assert::_check($result, "The variable is not an object !" ,$die);
		 return $result;
	}
	
	public static function check_array($val,  $die=true) {
		 $result=(is_array($val) && $val);
		 Assert::_check($result, "$val is not an array !" , $die);
		 return $result;
	}
	
}

