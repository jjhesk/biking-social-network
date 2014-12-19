<?php

class Ctrl_login_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this -> load -> model("init_model");
        $this -> load -> model("Mod_login_model", "login_model");
        $this -> load -> model("Mod_facebook_model", "facebook_model");
        $this -> load -> model("Mod_openid_model", "openid_model");
        $this -> load -> library("native_session");

        /* end of constant setting */
    }

    public function get_facebook_login_link() {
        //LV1 the link of facebook login
        $this -> load -> helper('url');
        $link = $this -> facebook_model -> get_facebook_login_url(site_url() . "login/facebook_login");
        return $link;
    }

    public function get_facebook_logout_link($return_url = null) {
        //LV1 the link for facebook logout
        return $this -> facebook_model -> FBget_logout_url($return_url);
    }

    public function save_facebook_account($access_token, $type = null) {
        //LV2 general function
        //print_r($get);
        //echo "<br/>";
        //access_token,
        //uid
        $config['appId'] = $this -> config -> item("fb_app_id");
        $config['secret'] = $this -> config -> item("fb_app_secret");
        $this -> load -> library("facebook", $config);

        //echo "<br/>login model 256<br/>";
        //print_r($session);
        //$this->native_session->set("session_key", $session['session_key']);
        $ret_obj = $this -> facebook_model -> FBget_user_inhouse_data($access_token);
        $user = $this -> facebook_model -> FBget_User();
        //$email=$ret_obj[0]['email'];
        /*Array ( [0] => Array (
         [email] => facebook@it.imusictech.com
         * [name] => IMusic MusicTech
         * [first_name] => IMusic
         * [last_name] => MusicTech
         * [sex] => male
         * [locale] => en_US ) )
         echo "<br/>";
         print_r($ret_obj);
         */
        $result['server'] = "facebook";
        $result['identity'] = "facebook";
        $result['email'] = $ret_obj[0]['email'];

        //$result['openid']=$session['uid'];
        $result['openid'] = $user;
        $result['firstname'] = $ret_obj[0]['first_name'];
        $result['lastname'] = $ret_obj[0]['last_name'];
        $result['fullname'] = $ret_obj[0]['name'];
        $result['nickname'] = $ret_obj[0]['name'];
        $result['gender'] = (($ret_obj[0]['sex'] == "male") ? "m" : "f");
        $result['language'] = $ret_obj[0]['locale'];
        //$result['avator']=$ret_obj[0]['picture'];

        $result = $this -> login_model -> db_set_account($result, $type);
        //echo "<br/>ctrl login 66 ";
        //print_r($result);
        $result[0]['access_token'] = $access_token;
        $this -> native_session -> set("access_token", $access_token);
        return $result;

    }

    public function bll_load_login_page() {
        //LV2
        if ($this -> native_session -> get("userinfo")) {
            $data['userinfo'] = $this -> native_session -> get("userinfo");

            //get the logout link after login
            if ($data['userinfo']['identity'] == "facebook") {
                $data['graph_url'] = "https://graph.facebook.com/" . $data['userinfo']['openid'] . "/photos?access_token=" . $data['userinfo']['access_token'];
                //$data['facebook_id']=$this->native_session->get('access_token');
                $data['fp_app_id'] = $this -> config -> item("fp_app_id");
                $session_key = $this -> native_session -> get("session_key");
                //https://www.facebook.com/logout.php?next=http%3A%2F%2Fwww.imobilepet.com%2Ffb_logout.php&access_token=AAADWDk7MLvUBANdutn15esWiM4pKG0sbdZAkhBpwHm7g6VGVhwYkr88ZB7DF6GH5iwZACK85x10rlfpZAEJUqRyuUNBMcZAL3l5sha3ZAsGZBbkxGZAmmGHU
                $data['logout_openid_link'] = "https://www.facebook.com/logout.php?next=" . urlencode(site_url() . "/login/logout") . "&access_token=" . $this -> native_session -> get('access_token');
                //$data['logout_openid_link']=site_url()."/login/logout";
                //$this->facebook->getLogoutUrl();
            } else if ($data['userinfo']['identity'] == "google") {
                $data['logout_openid_link'] = "https://www.google.com/accounts/Logout";
            } else if ($data['userinfo']['identity'] == "yahoo") {
                $data['logout_openid_link'] = "https://login.yahoo.com/config/login?logout=1";
            }
            //get userinfo and nickname to display
            $inhouse_info = $this -> native_session -> get("inhouse_info");
            $data['nickname'] = $inhouse_info['nickname'];

            //is first register or not
            if ($inhouse_info['customize_edit_count'] == "0")
                $data['firstlogin'] = true;
            else
                $data['firstlogin'] = false;

            //get friend relation
            $this -> db -> select("count(subject_user_id) as counter");
            $this -> db -> where("subject_user_id", $data['userinfo']['user_inhouse_id']);
            $query = $this -> db -> get("user_relation");
            $result = $query -> result_array();

            //has add friends or not
            if (($result[0]['counter'] == "0") && ($inhouse_info['customize_edit_count'] > 0))
                $data['afterfirstlogin'] = true;
            else
                $data['afterfirstlogin'] = false;

            //$data['no_apps']=$this->check_user_no_apps();
            //print_r($this->native_session->get("userinfo"));
            //print_r($this->native_session->get("sessionToken"));
        }
        //print_r($this->native_session->get("inhouse_info"));
        //get facebook login link
        $this -> load -> model("facebook_model");
        $data['facebook_login_url'] = $this -> facebook_model -> get_facebook_login_url(site_url() . "/login/facebook_login");
        $data['show_user_logined'] = $this -> check_login();

        //get login display area
        if ($data['show_user_logined'] != false) {
            $data['view_block_login_area'] = $this -> load -> view('login/block_logined', $data, true);
        } else {
            $data['view_block_login_area'] = $this -> load -> view('login/block_loginbtn', $data, true);
        }

        return $data;

    }

    public function save_mobile_openid_login_and_submit() {
        //print_r($_POST);
        //need to implement write db record
        //print_r($_POST);
        //if($this->login_model->check_manufacturer_token($_POST['manuifacture_token'])){
        //$result=$this->login_model->DBset_login_app($_POST);
        $this -> native_session -> set("app_info", $_POST);
        //echo "<br/>login 67<br/>";
        //print_r($this->native_session->get("mobile"));
        /*if($_POST['identity']=="google"){
         header("location: ".site_url()."login/login_google/m");
         }else if($_POST['identity']=="yahoo"){
         header("location: ".site_url()."login/login_yahoo/m");
         }else{*/
        //facebook
        $data = $this -> facebook_model -> bll_facebook_login_variable("m");
        /*echo "location: https://www.facebook.com/login.php?api_key=".$data['fb_app_id']."
         &display=popup&fbconnect=1
         &next=".$data['fb_app_return_link']."&return_session=1&session_version=3&v=1.0
         &req_perms=".$data['fb_app_perms'];*/
        $url = $this -> facebook_model -> get_facebook_login_url(site_url() . "login/facebook_login");
        //echo "<br/>login 99 ".$url;
        header("location: " . $url);
        //}
        /*}else{
         $data=array();
         echo $data['result']="login 69 your manufacturer token does not match.";
         $this->load->view("login/page_mobile_logined", $data);

         }*/
        /*<a href="https://www.facebook.com/login.php?api_key=<?php echo $fb_app_id?>
         &display=popup&fbconnect=1
         &next=<?php echo $fb_app_return_link?>&return_session=1&session_version=3&v=1.0
         &req_perms=<?php echo $fb_app_perms?>" >*/

    }

    public function ctrl_save_facebook_login_after_login() {
        //ctrl LV1
        $this -> load -> model("login_model");
        $token = '';
        if ((isset($_GET['token'])) && ($_GET['token'] != '')) {
            $token = $_GET['token'];
        }
        if ($token == '')
            if (($_GET['code'] != '') && (!isset($_GET['token']))) {
                $token = $this -> facebook_model -> FBget_access_token_by_code($_GET);
            }
        if ($token != '') {
            if ($this -> facebook_model -> FB_check_permission_by_token($token) == false) {
                //echo "<br/>facebook model 337 ".$this->FB_check_permission_by_token($token);
                return null;
            }
            //$this->native_session->set("access_token", $token);
            //print_r($result);
            //print_r($_GET);
            $result = $this -> save_facebook_account($token);
			//echo "<br/> ctrl login model 196 ";
			//print_r($result);
            $this -> login_model -> session_set_user_login($result[0]);
            //echo "<br/>facebook_model 210 ".$token;
            //$this->login_model->DBset_facebook_oauth($token);
            return $result;
        } else {
            echo "facebook_model 213 cannot get token.";
            return null;
            //header("location: ".site_url());
        }
    }

    public function get_user_inhouse_data_by_user_inhouse_id($user_inhouse_id) {
        $login_data_list = $this -> login_model -> DBget_user_inhouse_info_by_user_inhouse_id($user_inhouse_id);

        $login_data_list['avator'] = $login_data_list['profile_image'];

        return $login_data_list;
    }

    public function bll_test_mobile_login($openid, $mobile = null) {

        //$this->db->where("user_inhouse_id", $result['user_inhouse_id']);
        //$info=$this->native_session->get("mobile");
        $info = array();
        //$info['device_uuid']=$mobile['device_id'];
        //$info['app_device_uuid']=$mobile['app_device_id'];
        //$info['manuifacture_token']=$mobile['manuifacture_token'];
        $info['identity'] = "facebook";
        $info['user_inhouse_id'] = $openid['user_inhouse_id'];

        //$info['app_id']=$openid['app_id'];
        /*
         *
         *//*$info['device_uuid']="8653c5ef-4ca1-44c7-853e-7c3bb9312134";
         $info['app_id']="d47d4dbb-a117-478d-908a-75dd8ef3b5f1";
         $info['manuifacture_token']="U2FsdGVkX18ZN+U2FsdGVkX18ZN+liN7haYDuYSB1BLaJqPRVcAD8KA2tiS6/fWmTi7WxymziLIb+C";
         $info['email']="facebook@it.imusictech.com";
         $info['platform']="facebook";
         //$info=json_encode($info);*/

        return $info;
    }

    public function facebook_login($reutrn_url = null) {
        //LV1, this is call back url function after facebook login
        global $_GET;
        //print_r($this->native_session->get("mobile"));
        if ($this -> native_session -> get("merge") == "true") {
            //merge account
            $this -> facebook_model -> ctrl_merge_facebook_account($_GET);
            //$this->website_after_login(site_url()."/settings/index/merge");
        } else if ($this -> native_session -> get("image") != null) {
            //save the image upload from activity
            $this -> login_model -> upload_image_to_facebook();
            //echo "controller login 80";
        } else if ($this -> native_session -> get("mobile") == null) {
            //normal website login
            if ($this -> ctrl_save_facebook_login_after_login() != null) {
                $this -> website_after_login($reutrn_url);
            }
        } else if ($this -> native_session -> get("mobile") == "true") {
            $result = $this -> ctrl_save_facebook_login_after_login();
            //the native session app_info is record when the mobile get in the first login page
            //$mobile=$this->native_session->get("app_info");

            $data = $this -> bll_test_mobile_login($result[0]);
            //echo "<br/>ctrl login model 246 ";
            //print_r($data);
            $this -> native_session -> set('mobile_info', $this -> login_model -> mobile_login($data));
            //echo "<br/>ctrl login model 249 ";
            //print_r($this->native_session->get('mobile_info'));
            header("location: " . site_url() . "login/page_mobile_logined");
            exit();
        }
        echo "login 187 out of range";
    }

    public function website_after_login($url = "") {
        //LV3 ctrl
        header("location:" . $url);
    }

    public function get_friend_list_inhouse_data_by_user_inhouse_id($user_inhouse_id) {
        //echo "<br/>ctrl activity model 34 ".$user_inhouse_id;
        $friend_list = $this -> bll_get_friend_list_by_user_inhouse_id($user_inhouse_id, false);
        //echo "<br/>ctrl actiivty model 36 ";
        //print_r($friend_list);
        //BLL LV2
        //echo "<br/> activity_model 744 ".count($friend_list);
        //print_r($friend_list);
        if (count($friend_list) > 0) {
            /*for($i=0;$i<count($friend_list);$i++){
             if($friend_list[$i]!=$post['user_id']){
             $friend_list[$i]['user_id']=$friend_list[$i];
             $friend_list[$i]['user_inhouse_id']=$friend_list[$i];
             }
             }*/
            //echo "<br/>activity_model 518  friend_list:<br/>";
            //print_r($friend_list);
            for ($i = 0; $i < count($friend_list); $i++) {
                $friend_list[$i]['user_inhouse_id'] = $friend_list[$i]['user_id'];
            }
            $friend_list_inhouse_data = $this -> login_model -> DBget_user_inhouse_info_by_user_inhouse_id($friend_list);
            return $friend_list_inhouse_data;
        } else {
            return null;
        }

    }

    public function bll_get_friend_list_by_user_inhouse_id($user_inhouse_id, $self = false) {
        //LV1
        //echo "<br/>ctrl login 262 ".$user_inhouse_id;
        $friend_list = $this -> login_model -> DBget_friend_list_by_user_inhouse_id($user_inhouse_id);
        $friend_list_id = array();
        $counter = 0;
        //cut out the same id as myself
        for ($i = 0; $i < count($friend_list); $i++) {
            if ($friend_list[$i]['object_user_id'] != $user_inhouse_id) {
                $friend_list_id[$counter]['user_id'] = $friend_list[$i]['object_user_id'];
                $friend_list_id[$counter]['request'] = $friend_list[$i]['request'];
                $counter++;
            }
            if ($friend_list[$i]['subject_user_id'] != $user_inhouse_id) {
                $friend_list_id[$counter]['user_id'] = $friend_list[$i]['subject_user_id'];
                $friend_list_id[$counter]['request'] = $friend_list[$i]['request'];
                $counter++;
            }
        }
        $counter = 0;
        $result = array();
        for ($i = 0; $i < count($friend_list_id); $i++) {
            $savelog = true;
            for ($i2 = 0; $i2 < count($friend_list_id); $i2++) {
                if (($i != $i2) && ($friend_list_id[$i] == $friend_list_id[$i2]) && ($friend_list_id[$i] != '_')) {
                    $friend_list_id[$i2] = "_";
                }
            }
            if ($friend_list_id[$i] != '_') {
                $result[$counter] = $friend_list_id[$i];
                $counter++;
            }
        }
        if ($self == true) {
            $result[$counter]['user_id'] = $user_inhouse_id;
        }
        //echo "<br/>login model 633 ";
        //print_r($result);
        return $result;
    }

    public function check_login() {
        //LV1
        //echo "<br/> ctrl login model 352 ";
		//print_r($this -> native_session -> get('userinfo')); 
        
        if ($this -> native_session -> get('userinfo') == null) {
            return false;
        } else {
            $data = array($this -> native_session -> get('userinfo'));
            if ((isset($data['fullname'])) && ($data['fullname'] != ''))
                $data['nickname'] = $data['fullname'];
            return $data;
        }
    }

    /*	$this->native_session->set("openid_identity", "facebook");
     $this->native_session->set("access_token", $session['access_token']);
     $this->native_session->set("uid", $session['uid']);*/

    public function set_user_logout($return_url = null) {
        //LV1 logout function
        $this -> login_model -> session_set_user_logout();
        if ($return_url != null)
            header("location: " . $return_url);
    }

    public function merge_account_detail() {
        //LV1
        $this -> login_model -> merge_account_detail();
    }

    public function mobile_login() {
        $data = array();
        $data['facebook_login_link'] = $this -> facebook_model -> get_facebook_login_url(site_url() . "login/facebook_login");
        $data = $this -> load -> view("login/page_mobile_login", $data, true);
        return $data;
    }

    public function mobile_logined() {
        $data = array();
        $data['result'] = $this -> native_session -> get('mobile_info');
        $data['result'] = json_encode($data['result']);
        //print_r($data);
        $this -> load -> view("login/page_mobile_logined", $data);
        return $data;
    }

    public function merge_facebook_account($get) {
        //ctrl
        //echo "<br/>facebook_model 200 merge facebook account";
        if (isset($get['code']))
            if ($get['code'] != '') {
                $token = $this -> facebook_model -> FBget_access_token_by_code($get);
            }
        $type = "merge";
        $result = $this -> save_facebook_account($token, $type);
        $this -> native_session -> delete("merge");

    }

}
?>