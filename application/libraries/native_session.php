<?php

//http://www.moreofless.co.uk/using-native-php-sessions-with-codeigniter/

if ( ! defined('BASEPATH') )
    exit( 'No direct script access allowed' );

class Native_session
{
    public function __construct()
    {
        if(!isset($_SESSION)) {
			//session_id($_GET['session']);	//safari session prob        	
 		    session_start();
		}
		// IE security cookie problem within iframe - http://gathadams.com/2007/06/25/how-to-set-third-party-cookies-with-iframe-facebook-applications/
		header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"'); 		
    }

    public function set( $key, $value )
    {
        $_SESSION[$key] = $value;
    }

    public function get( $key )
    {
    	//echo "<br/>native_session 27 ".$key;
        return isset( $_SESSION[$key] ) ? $_SESSION[$key] : null;
    }
	public function listAll($filename, $linenumber){
		echo "<br/>".$filename." ".$linenumber." list all native session: <br/>";	
		print_r($_SESSION);
		echo "<br/>";
	}
    public function regenerateId( $delOld = false )
    {
        session_regenerate_id( $delOld );
    }

    public function delete( $key )
    {
        unset( $_SESSION[$key] );
    }
}

?>