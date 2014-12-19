<?php
class Overhead_model extends CI_Model {
    public $data;
    public $JSpath;
    public $CSSpath;
    public function __construct() {
        parent::__construct();
        /* constant setting */
        $this -> array = array();
        $this -> CSSpath = base_url() . "include/css/";
        $this -> JSpath = base_url() . "include/jsproduction/";
        $this -> load -> library('user_agent');
    }

    public function loadLayout_settings() {
        if ($this -> agent -> is_browser()) {
            $agent = $this -> agent -> browser() . ' ' . $this -> agent -> version();
        } elseif ($this -> agent -> is_robot()) {
            $agent = $this -> agent -> robot();
        } elseif ($this -> agent -> is_mobile()) {
            $agent = $this -> agent -> mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }
        //echo $agent;
        //echo $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)
    }

    public function loadCSS($data = array()) {
        $output = "";
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $file = $this -> CSSpath . $value . '.css';
                $output .= '<link id="' . $value . '" rel="stylesheet" type="text/css" href="' . $file . '"/>';

            }
        }
        if ($this -> is_ie8()) {
            $output .= '<link id="ie8" rel="stylesheet" type="text/css" href="' . $this -> CSSpath . 'ie8.css"/>';
            $output .= '<script charset="UTF-8" id="ie8js" type="text/javascript" src="' . $this -> JSpath . 'html5.js"/></script>';
            $output .= '<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>';
        }

        return $output;
    }

    public function loadJS($data = array()) {
        $output = "";
        if (count($data) > 0) {
            //   return "";
            foreach ($data as $key => $value) {
                $file = $this -> JSpath . $value . '.js';
                $output .= '<script charset="UTF-8" id="' . $value . '" type="text/javascript" src="' . $file . '"></script>';
            }
        }

        return $output;
    }

    public function is_ie8() {
        $list = $this -> browserVersion();
        if ($list["major"] <= 8 && $list["browser"] == "internet explorer") {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function browserVersion() {
        $name = $this -> agent -> browser();
        $version = $this -> agent -> version();
        $version = explode(".", $version);
        $major = $version[0];
        return array("browser" => strtolower($name), "major" => $major, "whole" => strtolower($name) . $major);
    }

}
?>