<?php

class EIG_Exception extends Exception {

    private $cause;
    private $debug_message;

    function __construct($_message = null, $_code = 0, Exception $_cause = null) {
        parent::__construct($_message, $_code);
        $this->cause = $_cause;
    }

    public function setDebugMessage($debug_message){
        $this->debug_message = $debug_message;
    }

    public function getDebugMessage(){
        return $this->debug_message;
    }

    public function getCause() {
        return $this->cause;
    }

    public function getStackTrace() {
        if ($this->cause !== null) {
            //stack trace array
            $arr = array();
            $trace = $this->getTrace();
            array_push($arr, $trace[0]);
            unset($trace);
            if (get_class($this->cause) == "EIG_Exception") {
                foreach ($this->cause->getStackTrace() as $key => $trace) {
                    array_push($arr, $trace);
                }
            }
            else {
                foreach ($this->cause->getTrace() as $key => $trace) {
                    array_push($arr, $trace);
                }
            }
            return $arr;
        }
        else {
            return $this->getTrace();
        }
    }

    public function getStackTraceHtml() {
        $htmldoc = "<p style=\"font-family: monospace; border: solid 1px #000000\"><span style=\"font-weight: bold; color: #000000;\">EIG_EXCEPTION<br/></span>";
        $htmldoc.= "Exception code : $this->code<br/>";
        $htmldoc.= "Exception message : $this->message<br/>";
        $htmldoc.= "Stacktrace:<br/>";
        $htmldoc.= "<span style=\"color: #0000FF;\">";
        $i = 0;
        foreach ($this->getStackTrace() as $key => $trace) {
            $htmldoc.= $this->_showTrace($trace, $i);
            $i++;
        }
        $htmldoc.= "#$i {main}<br/>";
        unset($i);
        $htmldoc.= "</span></p>";
        return $htmldoc;
    }

    public function getDieHtml() {
        $htmldoc = "<p style=\"font-family: monospace; border: solid 1px #000000\"><span style=\"font-weight: bold; color: #000000;\">DIE<br/></span>";
        $htmldoc.= "Code: $this->code<br/>";
        $htmldoc.= "Message: $this->message<br/>";
        $htmldoc.= "Stacktrace:<br/>";
        $htmldoc.= "<span style=\"color: #0000FF;\">";
        $i = 0;
        foreach ($this->getStackTrace() as $key => $trace) {
            $htmldoc.= $this->_showTrace($trace, $i);
            $i++;
        }
        $htmldoc.= "#$i {main}<br/>";
        unset($i);
        $htmldoc.= "</span></p>";
        return $htmldoc;
    }

    private function _showTrace($_trace, $_i, $newline = '<br/>') {
        $htmldoc = "#$_i ";
        if (array_key_exists("file",$_trace)) {
            $htmldoc.= $_trace["file"];
        }
        if (array_key_exists("line",$_trace)) {
            $htmldoc.= "(".$_trace["line"]."): ";
        }
        if (array_key_exists("class",$_trace) && array_key_exists("type",$_trace)) {
            $htmldoc.= $_trace["class"].$_trace["type"];
        }
        if (array_key_exists("function",$_trace)) {
            $htmldoc.= $_trace["function"]."(";
            if (array_key_exists("args",$_trace)) {
                if (count($_trace["args"]) > 0) {
                    $args = $_trace["args"];
                    $type = gettype($args[0]);
                    $value = $args[0];
                    unset($args);
                    if ($type == "boolean") {
                        if ($value) {
                            $htmldoc.= "true";
                        }
                        else {
                            $htmldoc.= "false";
                        }
                    }
                    elseif ($type == "integer" || $type == "double") {
                        if (settype($value, "string")) {
                            if (strlen($value) <= 20) {
                                $htmldoc.= $value;
                            }
                            else {
                                $htmldoc.= substr($value,0,17)."...";
                            }
                        }
                        else {
                            if ($type == "integer" ) {
                                $htmldoc.= "? integer ?";
                            }
                            else {
                                $htmldoc.= "? double or float ?";
                            }
                        }
                    }
                    elseif ($type == "string") {
                        if (strlen($value) <= 18) {
                            $htmldoc.= "'$value'";
                        }
                        else {
                            $htmldoc.= "'".substr($value,0,15)."...'";
                        }
                    }
                    elseif ($type == "array") {
                        $htmldoc.= "Array";
                    }
                    elseif ($type == "object") {
                        $htmldoc.= "Object";
                    }
                    elseif ($type == "resource") {
                        $htmldoc.= "Resource";
                    }
                    elseif ($type == "NULL") {
                        $htmldoc.= "null";
                    }
                    elseif ($type == "unknown type") {
                        $htmldoc.= "? unknown type ?";
                    }
                    unset($type);
                    unset($value);
                }
                if (count($_trace["args"]) > 1) {
                    $htmldoc.= ",...";
                }
            }
            $htmldoc.= ")$newline";
        }
        return $htmldoc;
    }
}