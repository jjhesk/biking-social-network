<?php

//	$debugObj= new Debug();
//	$debugObj->debug_time_start();
//	sleep(2);
//	$timeDiff=$debugObj->debug_return_time();
//	echo $timeDiff;

global $_debug_start_time;
include_once("EIG_Exception.class.php");
include_once("Error.class.php");

class Debug {

	//short hand version of debug_dump
	public static function d($var, $show_trace = false, $ob_flush=true) {
		Debug::debug_dump($var, $show_trace, $ob_flush);
	}

    //return the content of the variable
    public static function debug_dump_return($var, $show_trace = false){
        $e = new EIG_Exception('');
        $trace = $e->getTrace();
        $html = '';
        $html .= "<pre><div style='background-color:#eeeeee'>";
        if($show_trace) {
            $html .= $e->getStackTraceHtml();
        } else{
            $html .= '<strong>'.$trace[1]['file'].'('.$trace[1]['line'].'):</strong><BR>';
        }
        $html .= Debug::do_dump_return($var);

        $html .= "</div></pre>";
        return $html;
    }

	//dump out the content of the variable
	public static function debug_dump($var, $show_trace = false, $ob_flush=true){
        $e = new EIG_Exception('');
        $trace = $e->getTrace();

		echo "<pre><div style='background-color:#eeeeee'>";
	    if($show_trace) {
            print $e->getStackTraceHtml();
        } else{
            print '<strong>'.$trace[1]['file'].'('.$trace[1]['line'].'):</strong><BR>';
        }
		Debug::do_dump($var);

		echo "</div></pre>";
		if ($ob_flush) {
		    ob_flush();
		}
	}
	
	
	//dump out the content of the variable and die
	public static function debug_die($var, $show_trace = true, $ob_flush=true){
		Debug::debug_dump($var, $show_trace, $ob_flush);
		//die now after dumping out the $var
		die;
	}

	public static function debug_htmldump($var, $show_trace = false){

	}

	//return a block of html text with the content of the variable
	public static function debug_return_htmldump($var, $show_trace = false){
	}

	public static function debug_return_query_result($query_assoc_all_results) {
	}

	//print out
	public static function debug_dump_query_result($query_assoc_all_results) {
		print debug_return_query_result($query_assoc_all_results);
	}

	######################### mem debug


	################################## time debug

	//start counting, using microtime(1)
	public static function debug_time_start(){

		global $_debug_start_time;

		list($usec, $sec) = explode(" ", microtime());
		$_debug_start_time= ((float)$usec + (float)$sec);
	}

	//return the time diff since debug_time_start()
	public static function debug_return_time() {

		global $_debug_start_time;

		list($usec, $sec) = explode(" ", microtime());
		$end_time= ((float)$usec + (float)$sec);

		return $end_time-$_debug_start_time;
	}

	//each label is an anchor for a time duration
	public static function debug_time($label, $flush=true){
		print  '#'.$label. '-->'.Debug::debug_return_time().'#<br/>';
        if ($flush) ob_flush();
	}

	public static function do_dump_return(&$var, $var_name = NULL, $indent = NULL, $reference = NULL)  {
        $do_dump_indent = "<span style='color:#eeeeee;'>|</span> &nbsp;&nbsp; ";
        $reference = $reference.$var_name;
        $keyvar = 'the_do_dump_recursion_protection_scheme';
        $keyname = 'referenced_object_name';
        $html = '';
        if (is_array($var) && isset($var[$keyvar]))
        {
            $real_var = &$var[$keyvar];
            $real_name = &$var[$keyname];
            $type = ucfirst(gettype($real_var));
            $html .= "$indent$var_name <span style='color:#a2a2a2'>$type</span> = <span style='color:#e87800;'>&amp;$real_name</span><br>";
        }
        else
        {
            $var = array($keyvar => $var, $keyname => $reference);
            $avar = &$var[$keyvar];

            $type = ucfirst(gettype($avar));
            if($type == "String") $type_color = "<span style='color:green'>";
            elseif($type == "Integer") $type_color = "<span style='color:red'>";
            elseif($type == "Double"){ $type_color = "<span style='color:#0099c5'>"; $type = "Float"; }
            elseif($type == "Boolean") $type_color = "<span style='color:#92008d'>";
            elseif($type == "NULL") $type_color = "<span style='color:black'>";

            if(is_array($avar))
            {
                $count = count($avar);
                $html .= "$indent" . ($var_name ? "$var_name => ":"") . "<span style='color:#a2a2a2'>$type ($count)</span><br>$indent(<br>";
                $keys = array_keys($avar);
                foreach($keys as $name)
                {
                    $value = &$avar[$name];
                    $html .= Debug::do_dump_return($value, "['$name']", $indent.$do_dump_indent, $reference);
                }
                $html .= "$indent)<br>";
            } elseif(is_object($avar)) {
                $html .= "$indent$var_name <span style='color:#a2a2a2'>$type</span><br>$indent(<br>";
                foreach($avar as $name=>$value) {
                    $html .= Debug::do_dump_return($value, "$name", $indent.$do_dump_indent, $reference);
                }
                $html .= "$indent)<br>";
            } elseif(is_int($avar)) {
                $html .=   "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color$avar</span><br>";
            } elseif(is_string($avar)) {
                $html .= "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color\"$avar\"</span><br>";
            } elseif(is_float($avar)) {
                $html .= "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color$avar</span><br>";
            } elseif(is_bool($avar)) {
                $html .= "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color".($avar == 1 ? "TRUE":"FALSE")."</span><br>";
            } elseif(is_null($avar)) {
                $html .= "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> {$type_color}NULL</span><br>";
            } else {
                $html .= "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $avar<br>";
            }
            $var = $var[$keyvar];
        }
        return $html;
    }

	// better than print_r and var_dump
	public static function do_dump(&$var, $var_name = NULL, $indent = NULL, $reference = NULL)	{
        echo Debug::do_dump_return($var, $var_name, $indent, $reference);
	}
	public static function rsArray($arr){
		foreach($arr as $key=>$value){
			$res[$key]=mysql_real_escape_string(trim($value));
		}
		return $res;
	}
}

