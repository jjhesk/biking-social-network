<?php

//run this once when needed.
global $_g_has_apache_getenv;
$_g_has_apache_getenv = function_exists('apache_getenv') ? true : false;

// NOTE: DO NOT make call to other function module here - this file is included in top of page_top for debugging before including other functions.
// It should ONLY require EIG_Exception

//we can add different types of log in here and handle them differently

class Error {
    const CACHE_RECENT_ERROR_SLOTS = 20;
    const CACHE_RECENT_DIE_SLOTS = 20;
    const CACHE_RECENT_EXCEPTION_SLOTS = 20;

    const GENERAL_DIE_PREFIX = 'error_general_recent_dies_';
    const GENERAL_ERROR_PREFIX = 'error_general_recent_errors_';
    const GENERAL_EXCEPTION_PREFIX = 'error_general_recent_exceptions_';

    const TAG_DIE_PREFIX = 'error_tag_recent_dies_';
    const TAG_ERROR_PREFIX = 'error_tag_recent_errors_';
    const TAG_EXCEPTION_PREFIX = 'error_tag_recent_exceptions_';

    const LOG_TYPE_DEFAULT = 'DEFAULT';
    const LOG_TYPE_FAILSAFE = 'FAILSAFE';

    const TYPE_SANDBOX_LOG = 'SANDBOX_LOG';
    const TYPE_DIE = 'DIE';
    const TYPE_ERROR = 'ERROR';
    const TYPE_EXCEPTION = 'EXCEPTION';

    /*
     * Error log paths: phperror.log, mini.log for now
     */
    static function _get_phperror_log_path() {
        return PHP_ERROR_LOG_FILE;
    }

    static function _get_failsafe_log_path() {
        return PHP_MINI_ERROR_LOG_FILE;
    }

    /*
     * Throw exceptions
     */
    public static function throw_exception($msg='No message', $error_type=Error::TYPE_EXCEPTION, $log_type=Error::LOG_TYPE_DEFAULT){
        // we want to handle the error - doing the mini logging but we dont want to write an error yet
        // this is because if the exception is caught, we dont want to log the exception to create logspew
        // if the exception is not caught, PHP will write a fatal error (uncacught exception)
        Error::_log($msg, $error_type, $log_type, false);
        // add stacktrace to the message - php fatal uncaught exception error logging may not include a stack trace
        $e = new EIG_Exception($msg);
        $stacktrace = $e->getTraceAsString();
        $error_message = Error::_prepare_message("$error_type: $msg STACKTRACKE: $stacktrace LOGTYPE: $log_type");
        $e->setDebugMessage($error_message);
        if(General::is_sandbox()){
            Error::_test_sandbox_log($error_message, $log_type);
        }
        throw $e;
    }

/*
 * Log type handler: how to handle different types of log when it happens
 * for example, when there is a general die, we would cache it; however,
 * when there is a failure when running the mini_memcache(for error.php), we
 * would NOT cache it because caching itself might not be working.  As a result,
 * we would just write those critical errors to a special log file: mini.log(for now).
 */
    static function _handle_error_failsafe($message='No message', $error_type=Error::TYPE_ERROR, $log_type=Error::LOG_TYPE_DEFAULT) {
        switch ($log_type) {
            case Error::LOG_TYPE_FAILSAFE:
                // do nothing if we entered 'failsafe' error handling mode - this is necessary to avoid infinite looping in the error handling routines
                break;
            default:
                switch($error_type){
                    case Error::TYPE_DIE:
                        $general_prefix =   Error::GENERAL_DIE_PREFIX;
                        $tag_prefix =       Error::TAG_DIE_PREFIX;
                        $slots =            Error::CACHE_RECENT_DIE_SLOTS;
                        break;
                    case Error::TYPE_EXCEPTION:
                        $general_prefix =   Error::GENERAL_EXCEPTION_PREFIX;
                        $tag_prefix =       Error::TAG_EXCEPTION_PREFIX;
                        $slots =            Error::CACHE_RECENT_EXCEPTION_SLOTS;
                        break;
                    case Error::TYPE_ERROR:
                    default:
                        $general_prefix =   Error::GENERAL_ERROR_PREFIX;
                        $tag_prefix =       Error::TAG_ERROR_PREFIX;
                        $slots =            Error::CACHE_RECENT_ERROR_SLOTS;
                        break;
                }
                //default case: we will cache the recent error dies into cache for quick viewing
                $message = '[' . date('m/d/Y H:i:s') . '] ' . $message;
                $applied_slot = General::get_rand(0, $slots-1);
                $result_message = array('time'=>microtime(1),'message' => $message);
//TODO: memcache set and counter for failsafe
//                Memcache::failsafe_set($general_prefix.$applied_slot, $result_message);
//                Memcache::counter_increment($general_prefix.'counter', 100, 0, MEMCACHE_MAIN_POOL, 0, ERROR_LOG_TYPE_FAILSAFE);

                //write tag specific dies to cache now
               // $current_tags = Tag::get_current_tags();
                foreach($current_tags as $this_tag=>$_) {
                    $applied_tag_slot = General::get_rand(0, $slots-1);
//TODO: memcache set and counter for default
                }
                break;
        }
    }


    static function _log($message='No message', $error_type=Error::TYPE_ERROR, $log_type=Error::LOG_TYPE_DEFAULT, $write_error_log=true){
        $e = new EIG_Exception($message);
        $stacktrace = $e->getTraceAsString();
      //  $stacktrace=str_replace("#","\n\r<br>#",$stacktrace);
        $error_message = Error::_prepare_message("$error_type: $message STACKTRACKE: $stacktrace");
        Error::_handle_error_failsafe($error_message, $error_type, $log_type);
        //put it in the general phperror.log
        if($write_error_log){
            error_log($error_message);
        }
        
        return $error_message;
        //writing additional log files if necessary
      /*  Error::_write_extra_log_file($error_message, $log_type);
        // if in test, also write to the test error log
        global $_g_test_error_log;
        if($write_error_log){
            error_log('[' . date('m/d/Y H:i:s') . '] ' . $error_message . GENERAL_NEWLINE, 3, $_g_test_error_log);
        }*/
    }

    /*
     * This function instructs where the log file should be written based on different log types
     */
    static function _write_extra_log_file($message, $log_type=Error::LOG_TYPE_DEFAULT) {
        if($log_type == Error::LOG_TYPE_FAILSAFE) {
            error_log('[' . date('m/d/Y H:i:s') . ']::LOG_TYPE::'.$log_type.'::'.$message . GENERAL_NEWLINE, 3, Error::_get_failsafe_log_path());
        }
    }

    static function _prepare_message($message='No message') {
        $message = preg_replace("/\s/", ' ', $message );
        $message .= ' HTTP_X_FORWARDED_FOR=' .  Error::_getenv('HTTP_X_FORWARDED_FOR');
        $message .= ' SERVER_ADDR=' .  Error::_getenv('SERVER_ADDR');
        $message .= ' REMOTE_ADDR=' .  Error::_getenv('REMOTE_ADDR');
        //append tags at the end of the error message
      //  $message .= Tag::flatten_current_tags();
        return $message;
    }

    public static function die_failsafe($msg='No message') {
        Error::die_err($msg, Error::LOG_TYPE_FAILSAFE);
    }


    public static function die_err($msg='No message', $die=true) {
        if(!is_string($msg)){
            $msg = print_r($msg, 1);
        }
       $msg= Error::_log($msg, Error::TYPE_ERROR);
       if ($die){
       		$msg=str_replace("#","\n\r<br>#",$msg);
       		die($msg);
       }
    }

    static function _getenv($n) {
        global $_g_has_apache_getenv;
        if($_g_has_apache_getenv) {
            return apache_getenv($n);
        } else {
            return getenv($n);
        }
    }

    static function& _fix_stacktrace_entry(&$e) {
        unset($e['args']);
        return $e;
    }

    public static function get_compat_stacktrace() {
        if (function_exists('debug_backtrace')) {
            $result = array_reverse(debug_backtrace());
            $result = array_map('Error::_fix_stacktrace_entry', $result);
            return $result;
        }
        return array();
    }

    public static function get_one_line_stacktrace() {
        $stack = Error::get_compat_stacktrace();
        $msg = array();
        foreach( array_slice($stack, 0, -2) as $frame ) {
            $line = sprintf("%s:%d (%s)", basename($frame["file"]), $frame["line"], $frame["function"]);
            $msg[] = $line;
        }
        return implode(" / ", $msg) . " PHP_SELF = " . $_SERVER['PHP_SELF'];
    }

    public static function _test_sandbox_log($msg, $log_type=Error::LOG_TYPE_FAILSAFE){
        if(General::is_sandbox()){
            $msg = print_r($msg, true);
            Error::_log($msg, Error::TYPE_SANDBOX_LOG, $log_type);
        }
    }

    public static function redirect_to_error_page(){
        // TODO: implement a nice end-user grade error page
        Error::die_err("IMPLEMENT A GENERAL NICE ERROR PAGE FOR USERS");
    }
}