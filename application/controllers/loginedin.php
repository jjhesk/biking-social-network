<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Loginedin extends CI_Controller {
    private $check_login;
    private $_headload;
    private $_footerload;
    private $user_login_data;
    private $pagnation;
    private $count_in_page = 10;
    var $isSelf;
    public function __construct() {
        parent::__construct();
        $this -> load -> helper('url');
        $this -> load -> model("ctrl_login_model", "ctrl_login");
        $this -> load -> model("ctrl_activity_model");
        $this -> load -> model("overhead_model");
        $this -> load -> model("develop_home_page_model");
        $this -> load -> model("mod_googlemaps_model", "googlemaps_model");
        $this -> _headload = $this -> overhead_model -> loadCSS(array("recent", "colorbox"));
        $this -> _footerload = $this -> overhead_model -> loadJS(array("jquery.colorbox.min", "head.load.min", "underscore", "jquery.isotope.min"));
        //echo "<br/> loginedin 22" ;
        //print_r($this -> ctrl_login -> check_login());
        $this -> user_login_data = $this -> ctrl_login -> check_login();
    }

    private function get_overhead_headerfooter_data() {
        $config_hesk = array();
        $config_hesk['_headload'] = $this -> _headload;
        $config_hesk['_footerload'] = $this -> _footerload;
        $config_hesk['_browser'] = $this -> overhead_model -> browserVersion();
        return $config_hesk;
    }

    private function login_process($userID) {
        $login_data_list = $this -> ctrl_login -> get_user_inhouse_data_by_user_inhouse_id($userID);
        return $login_data_list;
    }

    private function check_current_user_and_log_out() {
        // no login then go to out
        if (count($this -> user_login_data) > 0) {
            $data = $this -> user_login_data;
            if (count($data[0]) === 0) {
                //the logined user is not log in and it needs to be log out now
                header("location: " . site_url());
                exit ;
            }
        }
    }

    private function loop_render_user_activity_brief($userID, $start_date = FALSE) {
        //$this->output->enable_profiler(true);
        //echo sprintf("<pre>%s</pre>",$userID);
        $data['bodymenu'] = "";
        //$data['bodymenu']=get_menu_ressembled(array(50,50,50),45,"socialmenu",base_url()."include/image/common/btn_share_ui.png",true,false);
        $data['footer'] = $this -> load -> view('components/footersmall', $this -> get_overhead_headerfooter_data(), true);
        $data['header'] = $this -> load -> view('components/header', $this -> get_overhead_headerfooter_data(), true);
        //$recent_activities_serial contains an array that is ordered (numberically) by the just an continuous integer number)
        $data_recent_activities = $this -> ctrl_activity_model -> get_activities_by_user_inhouse_id($userID, FALSE, $this -> pagnation);
        $data_friend_list = $this -> ctrl_login -> get_friend_list_inhouse_data_by_user_inhouse_id($userID);
        //$recent_activities_serial contains an array that is ordered (key) by the activity ID)
        $recent_activities_serial = $this -> develop_home_page_model -> recent_activities_serial($data_recent_activities);
        //$time_function_group_activities contains an array =([activity_id],[order number in an array of $data_recent_activities])
        /*TODO: fix this here with this thing. */
        //print_r($data_recent_activities);
        if ($data_recent_activities != null) {
            $time_function_group_activities = $this -> develop_home_page_model -> time_function_group_activities($data_recent_activities);
        } else {
            $time_function_group_activities = null;
        }
        $ids_script = $this -> develop_home_page_model -> serialize_time_function_group($time_function_group_activities);
        //echo "<br/> loginedin 73 ";
        //print_r($ids_script);
        $logindata = $this -> login_process($userID);
        $data["user_date_login"] = $this -> develop_home_page_model -> get_login_user_date($data_recent_activities, $userID);
        $data["recent_activities"] = $data_recent_activities;
        $data["friend_list"] = $data_friend_list;
        $data["logindata"] = $logindata;
        $data["recent_4_activities_count"] = $this -> ctrl_activity_model -> get_4_recent_activities_count_by_user_inhouse_id($userID);
        //this will be displayed in the recent.php
        $data["time_function_group_activities"] = $time_function_group_activities;
        //this will be displayed in the recent.php
        $data["recent_activities_serial"] = $recent_activities_serial;
        $data["activity_limit"] = 10;
        //this will be displayed in the recent.php
        $middle_part_of_script = $this -> googlemaps_model -> get_mapScripts($ids_script, $data["activity_limit"], "small_map");
        $data['googlemapblock'] = $this -> load -> view('components/block_google_setup_', array("middle_part_of_script" => $middle_part_of_script), true);
        //initialize the view and print all of them in HTML
        if ($this -> isSelf) {
            $data["errormessage"] = "You do not have any activities.";
        } else {
            $data["errormessage"] = "Your friend does not have any activities.";
        }
        if (!$start_date) {
            return $this -> load -> view('recent', $data, TRUE);
        } else {
            return $this -> load -> view('recent_continue_ajax', $data, TRUE);
        }
    }

    //this is the selection of one single friend and have it to show the EVENTs AROUND that friend.
    public function friend() {
        $logined_id = $this -> uri -> segment(3, '');
        $this -> index($logined_id);
    }

    public function p() {
        $this -> check_current_user_and_log_out();
        $logindata = $this -> user_login_data;
        $data_login = $logindata[0];
        $model = $this -> uri -> segment(3, NULL);
        $page = $this -> uri -> segment(4, 0);
        $friend_id = $this -> uri -> segment(5, $data_login["user_inhouse_id"]);
        if (!isset($model)) {
            $this -> index();
        } else {
            $pag_start = $page * $this -> count_in_page;
            $this -> pagnation = array("start" => $pag_start, "limit" => $this -> count_in_page);
            //http://hesk.imusictech.net/2012_ibike/index.php/loginedin/p/recent/0/
            //http://hesk.imusictech.net/2012_ibike/index.php/loginedin/p/friend/2011/
            if ($model == "friend" && isset($friend_id)) {
                echo $this -> loop_render_user_activity_brief($friend_id);
            } else if ($model == "recent" || $model == "index") {
                echo $this -> loop_render_user_activity_brief(-1);
            }
        }
    }

    private function pagination_recent() {

    }

    public function index($logined_id = -1) {
        //$this->output->enable_profiler(true);
        $this -> check_current_user_and_log_out();
        $logindata = $this -> user_login_data;
        //your userinfo data
        $data_login = $logindata[0];
        if ($logined_id != -1) {
            //echo "<br/>loginedin 117 ";
            //print_r($data_login);
            $logined_id = $this -> uri -> segment(3, $data_login["user_inhouse_id"]);
            if ($logined_id == $data_login["user_inhouse_id"]) {
                $this -> isSelf = TRUE;
            } else {
                $this -> isSelf = FALSE;
            }
            echo $this -> loop_render_user_activity_brief($logined_id);
        } else {
            $logined_id = $data_login["user_inhouse_id"];
            // echo "<br/>loginedin 121 ";
            //print_r($data_login);
            $this -> isSelf = TRUE;
            echo $this -> loop_render_user_activity_brief($logined_id);
        }
        $this -> pagnation = array("start" => 0, "limit" => 10);
        //echo $this -> loop_render_user_activity_brief($logined_id);
    }

    public function show_more_recent_activities() {
        $logined_id = $this -> uri -> segment(3, $data_login["user_inhouse_id"]);
        echo $this -> loop_render_user_activity_brief($logined_id);
    }

    //this page is to display a single detail page for the activity
    public function activity() {
        $activity_id = $this -> uri -> segment(3, '');
        $data_login = $this -> ctrl_login -> check_login();
        //your userinfo data
        $logined_id = $data_login[0]["user_inhouse_id"];
        if (!isset($logined_id)) {
            header("location: " . site_url());
        }
        if (intval($activity_id) > 0) {
            $data['bodymenu'] = "";
            //--------------------------------------------------------------------------------------------
            $data['footer'] = $this -> load -> view('components/footersmall', $this -> get_overhead_headerfooter_data(), true);
            //--------------------------------------------------------------------------------------------
            $data['header'] = $this -> load -> view('components/header', $this -> get_overhead_headerfooter_data(), true);
            //--------------------------------------------------------------------------------------------
            $data['logindata'] = $this -> login_process($logined_id);
            //--------------------------------------------------------------------------------------------
            $data_recent_activities = $this -> ctrl_activity_model -> get_activity_data_by_activity_id($activity_id);
            //--------------------------------------------------------------------------------------------
            //echo "<br/>loginedin 169 ";
            //print_r($data_recent_activities);
            //recent_activities_serial
            //$recent_activities_serial contains an array that is ordered (key) by the activity ID)
            //--------------------------------------------------------------------------------------------
            $recent_activities_serial = $this -> develop_home_page_model -> single_key_from_activity_id_filter($data_recent_activities);
            //--------------------------------------------------------------------------------------------
            $data_friend_list = $this -> ctrl_login -> get_friend_list_inhouse_data_by_user_inhouse_id($logined_id);
            //--------------------------------------------------------------------------------------------
            //$time_function_group_activities contains an array =([activity_id],[order number in an array of $data_recent_activities])
            //--------------------------------------------------------------------------------------------
            $time_function_group_activities = $this -> develop_home_page_model -> time_function_group_activities($data_recent_activities);
            //--------------------------------------------------------------------------------------------
            $activity_singular = $this -> ctrl_activity_model -> get_activity_singular_by_user_inhouse_id($logined_id);
            //--------------------------------------------------------
            if (count($recent_activities_serial) > 0) {
                //echo "<br/>loginedin 55 userinfo:";
                //print_r($data['logindata']);
                if ($data['logindata'] != null) {
                    $data['recent_activities_personal'] = $data_recent_activities;
                    $data['friend_list'] = $this -> ctrl_login -> get_friend_list_inhouse_data_by_user_inhouse_id($logined_id);
                    $data['recent_4_activities_count'] = $this -> ctrl_activity_model -> get_4_recent_activities_count_by_user_inhouse_id($logined_id);
                    $data["user_date_login"] = $this -> develop_home_page_model -> get_login_user_date($data_recent_activities, $logined_id);
                    $data['recent_activities_serial'] = $recent_activities_serial;
                    $data['time_function_group_activities'] = $time_function_group_activities;
                    //the script is just needed to make one so thats why
                    //-----------------------
                    $middle_part_of_script = $this -> googlemaps_model -> get_mapScriptsBig($recent_activities_serial, 1);
                    $data['googlemapblock'] = $this -> load -> view('components/block_google_setup_', array("middle_part_of_script" => $middle_part_of_script), true);
                    //this may, or may not be view/recent, because it show the main content of activity
                    //echo "<br/>loginedin 63 ";
                    //print_r($data['recent_4_activities_count']);
                    $this -> load -> view('event_single', $data);
                } else {
                    header("location: " . site_url());
                }
            } else {
                header("location: " . site_url());
            }
        } else {
            header("location: " . site_url());
        }
    }

    public function open_graph_object() {
        $this -> output -> enable_profiler(true);
        $activity_id = $this -> uri -> segment(3, '');
        header(':', true, 206);
        //$this->load->model("ctrl_activity_model", "ctrl_activity");
        $this -> ctrl_activity_model -> get_open_graph_object($activity_id);

    }

    public function generate_kml() {
        //$activity_id = $this->uri->segment(3, '');
        //echo "1";
        //remember turn off the codeigniter debug mode!
        //otherwise it will make kml error and cannot load the map!
        $this -> output -> enable_profiler(false);
        //echo $map_type =    $this->uri->segment(3, 0);
        $map_type = "small";
        $activity_id = $this -> uri -> segment(4, 0);

        $data = $this -> ctrl_activity_model -> get_kml_by_activity_id($map_type, $activity_id);
        //echo "<br/>loginedin 53 ".$activity_id;
        //print_r($data);
        //echo $data['kml_path'];
        $this -> output -> set_content_type('application/vnd.google-earth.kml') -> set_header("Pragma: no-cache") -> set_header("Cache-Control: post-check=0, pre-check=0") -> set_header("Cache-Control: no-store, no-cache, must-revalidate") -> set_header("HTTP/1.0 200 OK") -> set_header("HTTP/1.1 200 OK")
        // ->                            set_status_header('401')
        -> set_status_header('200') -> cache(1);
        $this -> output -> set_output(trim($data['kml_path']));
        /*if ($map_type == 'small') {
         $this->output->set_output($data['kml_path']);
         } else {
         $this->output->set_output($data['kml_checkpoints']);
         }*/

    }

    public function test_map() {
        $activity_id = $this -> uri -> segment(3, '');
        $data['activity_data'] = $this -> ctrl_activity_model -> get_activity_data_by_activity_id($activity_id);
        echo "<br/>loginedin 46 " . $activity_id;
        echo $data['activity_data']['map']['js'];
        echo $data['activity_data']['map']['html'];
        //print_r($data['activity_data']['map']);
        //print_r($data['activity_data']);
    }

    public function test_newmenu() {
        //get_menu_ressembled(array(50,50,50),45,"socialmenu",base_url()."include/image/common/btn_share_ui.png",true,false);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
/*
 print_r($logindata);
 $data_login=  Array
 (
 [user_openid_id] =&gt; 196
 [identity] =&gt; facebook
 [server] =&gt; facebook
 [openid] =&gt; 562419152
 [user_inhouse_id] =&gt; 176
 [firstname] =&gt; Heskeyo
 [lastname] =&gt; Kam
 [fullname] =&gt; Heskeyo Kam
 [nickname] =&gt; Heskeyo Kam
 [email] =&gt; ooxhesk@yahoo.com.hk
 [language] =&gt; en_US
 [country] =&gt;
 [avator] =&gt; http://profile.ak.fbcdn.net/hprofile-ak-ash4/c8.8.100.100/s100x100/377218_10150451737984153_808742789_s.jpg
 [gender] =&gt; m
 [access_token] =&gt; AAABmNfZBuwyMBAHZBGEP1O4gNGCXwYmlXc5PbGlB0ZCtz2ofuNn92f0bYZBH6YMJUbcRLZBrTvJfLmRnhvYZBZCleVkSep3otzGw5gZB6U4XiQZDZD
 )
 */
/*
 print_r($data['friend_list']);
 $friend_list = Array
 (
 [0] =&gt; Array
 (
 [user_inhouse_id] =&gt; 161
 [nickname] =&gt; Fenix Lam
 [firstname] =&gt; Fenix
 [lastname] =&gt; Lam
 [email] =&gt; fenixheat@gmail.com
 [email_privacy] =&gt; 1
 [language] =&gt; zh_TW
 [country] =&gt;
 [createdate] =&gt;
 [del] =&gt; n
 [career] =&gt;
 [profile_image] =&gt; http://profile.ak.fbcdn.net/hprofile-ak-ash3/c9.9.112.112/s100x100/557057_3259013328884_41227031_s.jpg
 [gender] =&gt; m
 [height] =&gt;
 [height_privacy] =&gt; 1
 [weight] =&gt;
 [weight_privacy] =&gt; 1
 [birthday] =&gt;
 [birthday_privacy] =&gt; 1
 [apps_installed] =&gt;
 [default_privacy] =&gt; public
 [social_media_publication] =&gt; facebook
 [photo_publication] =&gt; facebook
 [last_updated] =&gt; 2013-02-14 16:38:03
 [customize_edit_count] =&gt; 0
 [phone] =&gt;
 )
 [1] =&gt; Array
 (
 [user_inhouse_id] =&gt; 163
 [nickname] =&gt; Leonard Nimoy
 [firstname] =&gt; Leonard
 [lastname] =&gt; Nimoy
 [email] =&gt; facebook@it.imusictech.com
 [email_privacy] =&gt; 1
 [language] =&gt; en_US
 [country] =&gt;
 [createdate] =&gt;
 [del] =&gt; n
 [career] =&gt;
 [profile_image] =&gt; http://profile.ak.fbcdn.net/hprofile-ak-prn1/c29.10.122.122/s100x100/59519_200409440096828_788917531_a.jpg
 [gender] =&gt; m
 [height] =&gt;
 [height_privacy] =&gt; 1
 [weight] =&gt;
 [weight_privacy] =&gt; 1
 [birthday] =&gt;
 [birthday_privacy] =&gt; 1
 [apps_installed] =&gt;
 [default_privacy] =&gt; public
 [social_media_publication] =&gt; facebook
 [photo_publication] =&gt; facebook
 [last_updated] =&gt; 2013-02-19 10:57:53
 [customize_edit_count] =&gt; 0
 [phone] =&gt;
 )
 )
 for($i=0;$i<count($data['recent_activities']);$i++){
 echo "<br/>".$data['recent_activities'][$i]['nickname'].":".$data['recent_activities'][$i]['last_updated'];
 }
 */
