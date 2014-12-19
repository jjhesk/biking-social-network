<?php

class Develop_home_page_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this -> load -> model("init_model");
        $this -> load -> library("native_session");
        $this -> load -> model("mod_activity_model", "activity_model");
        $this -> load -> model("mod_login_model", "login_model");
        $this -> load -> model("mod_facebook_model", "facebook_model");
        $this -> load -> model("mod_googlemaps_model", "googlemaps_model");
        /* end of constant setting */
    }

    public function get_login_user_date($data_recent_activities, $id) {
        // echo $id;
        //echo "<br/> developer home page 17 ".count($data_recent_activities);
		//print_r($data_recent_activities);
        if(!isset($data_recent_activities[0]['user_inhouse_id']))
			$data_recent_activities=array($data_recent_activities);
        foreach ($data_recent_activities as $key => $value) {
            // echo $value["user_inhouse_id"].", ";
            if(isset($value["user_inhouse_id"]))
            if ($value["user_inhouse_id"] == $id) {
                //echo "------------------------";
                return $this -> nicetime($value["end_time"]);
            }
        }
    }

    public function recent_activities_serial($data_recent_activities) {
        $data = array();
		//echo "<br/> develop home page model 28 ";
		//print_r($data_recent_activities);
        foreach ($data_recent_activities as $key => $value) {
            $activity_id = $value["activity_id"];
            $time = $value["last_updated"];
            $time = $this -> break_down_time($time);
            //echo "<br/> develop home page model 34 ";
            //print_r($time);
            $data[$activity_id] = array_merge((array)$value, (array)$time);
        }
        return $data;
    }

    public function single_key_from_activity_id_filter($data_recent_activities) {
        $data = array();
		//echo "<br/> develop home page model 43 ";
		//print_r($data_recent_activities);
		//$data_recent_activities[0]=$data_recent_activities;
        //foreach ($data_recent_activities as $key => $value) {
        	//echo "<br/> develop home page model 46 ";
			//print_r($value);
            $activity_id = $data_recent_activities["activity_id"];
           // $time = $value["last_updated"];
            $time = $this -> break_down_time($data_recent_activities["last_updated"]);
			//echo "<br/> develop home page model 49 ";
			//print_r($time);
            $data[$activity_id] = array_merge((array)$data_recent_activities, (array)$time);
        //}
        //  print_r($data);
        return $data;
    }

    public function get_responding_activity_ids($data_recent_activities) {
        $data = array();
        foreach ($data_recent_activities as $key => $value) {
            $data[] = $value["activity_id"];
        }
        return $data;
    }

    private function break_down_time($gmt) {
        $hr = date('h', strtotime($gmt));
        $min = date('i', strtotime($gmt));
        $ago = $this -> nicetime($gmt);
        $apm = date('A', strtotime($gmt));
        $extra = array("up_hour" => $hr, "up_min" => $min, "up_ago" => $ago, "up_apm" => $apm, );
        return $extra;
    }

    public function time_function_group_activities($data_recent_activities) {
        $groupedArray = array();
		//echo "<br/>develop home page 82 ";
		//print_r($data_recent_activities);
		if(!isset($data_recent_activities[0]['activity_id']))
			$data_recent_activities=array($data_recent_activities);
        foreach ($data_recent_activities as $key => $value) {
            // echo $value["user_inhouse_id"].", ";
            
            $activity_id = $value["activity_id"];
            $time = $value["last_updated"];
            $datetime = date('F j, Y', strtotime($time));
            if (!isset($groupedArray[$datetime])) :
                $groupedArray[$datetime] = array();
            endif;
            $groupedArray[$datetime][] = array($activity_id, $key);
        }
        //print_r($groupedArray);
        return $groupedArray;

    }

    public function serialize_time_function_group($list) {
     
        $normal_list = array();
		if($list!=null)
        foreach ($list as $key => $time_date) {
            foreach ($time_date as $key => $t) {
                $normal_list[] = $t[0];
            }
        }
        return $normal_list;
    }

    private function nicetime($date) {
        if (empty($date)) {
            return "No date provided";
        }

        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        $now = time();
        $unix_date = strtotime($date);

        // check validity of date
        if (empty($unix_date)) {
            return "Bad date";
        }

        // is it future date or past date
        if ($now > $unix_date) {
            $difference = $now - $unix_date;
            $tense = "ago";

        } else {
            $difference = $unix_date - $now;
            $tense = "from now";
        }

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if ($difference != 1) {
            $periods[$j] .= "s";
        }

        return $difference . " " . $periods[$j] . " " . $tense;

    }

    private function time_present_for_endtime() {
        $end_time = $future_date - time();
        $difference = $this -> time_difference($end_time);

    }

    private function time_difference($endtime) {
        $days = (date("j", $endtime) - 1);
        $months = (date("n", $endtime) - 1);
        $years = (date("Y", $endtime) - 1970);
        $hours = date("G", $endtime);
        $mins = date("i", $endtime);
        $secs = date("s", $endtime);
        $diff = "'day': " . $days . ",'month': " . $months . ",'year': " . $years . ",'hour': " . $hours . ",'min': " . $mins . ",'sec': " . $secs;
        return $diff;
    }

}
?>