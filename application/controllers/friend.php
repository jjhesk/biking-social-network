<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Friend extends CI_Controller {
    private $check_login;
    private $_headload;
    private $_footerload;
    private $user_login_data;
    public function __construct() {
        parent::__construct();
        $this -> load -> helper('url');
        $this -> load -> model("ctrl_login_model", "ctrl_login");
        $this -> load -> model("ctrl_activity_model");
        $this -> load -> model("overhead_model");
        $this -> load -> model("develop_home_page_model");
        $this -> load -> model("mod_googlemaps_model", "googlemaps_model");
        $this -> load -> model("friends_model", "frd");
        $this -> _headload = $this -> overhead_model -> loadCSS(array("recent", "colorbox", "friend"));
        $this -> _footerload = $this -> overhead_model -> loadJS(array("jquery.colorbox.min", "head.load.min", "underscore", "jquery.isotope.min"));
    }

    public function index() {
        $logindata = $this -> ctrl_login -> check_login();
        //your userinfo data
        $data_login = $logindata[0];
        
        $logined_id = $this -> uri -> segment(3, $data_login["user_inhouse_id"]);
        
        $this->user_login_data=$data_login;
        if (!isset($logined_id)) {
            header("location: " . site_url());
        }
        $this->friend_list($logined_id);
    }
    private function get_config_hesk(){
            $config_hesk=array();
            $config_hesk['_headload'] = $this -> _headload;
            $config_hesk['_footerload'] = $this -> _footerload;
            $config_hesk['_browser']=$this->overhead_model->browserVersion();
            return $config_hesk;
    }
    private function friend_list($userID) {
        $data['bodymenu'] = "";
        //$data['bodymenu']=get_menu_ressembled(array(50,50,50),45,"socialmenu",base_url()."include/image/common/btn_share_ui.png",true,false);
        $data['footer'] = $this -> load -> view('components/footersmall', $this->get_config_hesk(), true);
        $data['header'] = $this -> load -> view('components/header', $this->get_config_hesk(), true);
        //$fans_count=$this->frd->count_fans($userID);
        //$fans=$this->frd->my_friends($userID);
        /*
            if($fans_count>0){
                $fans_list = $this->frd->get_user_of_friends_details($userID);
            }else{
                $fans_list=array();
            }
        */
        //$recent_activities_serial contains an array that is ordered (numberically) by the just an continuous integer number)
        $data_recent_activities = $this -> ctrl_activity_model -> get_activities_by_user_inhouse_id($userID);
        $data_friend_list = $this -> ctrl_login -> get_friend_list_inhouse_data_by_user_inhouse_id($userID);
		$fans_count=0;
        if(count($data_friend_list)>0){
            $fans_count=count($data_friend_list);
        }
        //$recent_activities_serial contains an array that is ordered (key) by the activity ID)
        $recent_activities_serial = $this -> develop_home_page_model -> recent_activities_serial($data_recent_activities);
        //$time_function_group_activities contains an array =([activity_id],[order number in an array of $data_recent_activities])
        //echo "<br/> friend 67 ";
		//print_r($data_recent_activities);
        if($data_recent_activities!=null){
	        $time_function_group_activities = $this -> develop_home_page_model -> time_function_group_activities($data_recent_activities);
        }else{
        	$time_function_group_activities=null;
        }
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
        $data["user_date_login"] = $this -> develop_home_page_model -> get_login_user_date($data_recent_activities, $userID);
        $data["recent_activities"] = $data_recent_activities;
        $data["friend_list"] = $data_friend_list;
		//echo "<br/>friend 133 ";
		//print_r($data_friend_list);
        $data["logindata"] = $this->user_login_data;
        $data["recent_4_activities_count"] = $this -> ctrl_activity_model -> get_4_recent_activities_count_by_user_inhouse_id($userID);
        //this will be displayed in the recent.php
	    $data["time_function_group_activities"] = $time_function_group_activities;
        //this will be displayed in the recent.php
        $data["recent_activities_serial"] = $recent_activities_serial;
        $data["activity_limit"] = 5;
        $data["fancount"]=$fans_count;
        //initialize the view and print all of them in HTML
        $this -> load -> view('friends', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
