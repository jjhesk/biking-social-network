<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Profile extends CI_Controller {
	public $login, $user_id;
	function __construct() {
		parent::__construct();

		//will kick user out of this controller if not log-in
		$this -> load -> library("native_session");
		$function = $this -> uri -> segment(2, "");
		$user_info = $this -> native_session -> get("userinfo");
		if($function=="view")
		if (($user_info = $this -> native_session -> get("userinfo")) == null) {
			$url = site_url();
			header( "HTTP/1.1 301 Moved Permanently" );
			header("Location: {$url}/portal/login");
			exit();
		}
		if( ($function=="view")&&($user_info!=null) )
			$this -> user_id = $user_info['user_inhouse_id'];

		$this -> load -> model("init_model");
		$this -> load -> model("login_model");
		$this -> load -> library('googlemaps');
		$this -> load -> model("googlemaps_model");
		$this -> load -> model("profile_model");
		$this -> load -> model("activity_model");
		//$this->output->enable_profiler(true);	//debug function

	}
	function __destruct() {
		$this -> load -> model("init_model");
    	$this->init_model->destroy_sensitive_session();
    }
	public function index() {
		$url = site_url('profile/view');
		header("Location: {$url}");
	}

	public function view() {
		//page inputs
		$data['user_id'] = $this -> uri -> segment(3, $this -> user_id);
		if($this->login_model->check_profile_view_privacy(	$data['user_id'])==true){
			//echo "<br/>profile 43 ";	
			$data['device_tabs'] = $this -> profile_model -> get_user_device_tabs($data['user_id']);
			$profile_tabs_html = $this -> profile_model -> get_user_device_tabs_html($data['user_id']);
			$data = array_merge($data, $this -> init_model -> bll_get_header(true, $profile_tabs_html));
			$data = $this -> profile_model -> get_page_user_profile_data($data);
			
			$data['profile_tab'] = $this -> load -> view("profile_page/page_user_profile", $data, TRUE);
			/*
			 $data['app_id'] = 1;
			 $data['activity_id'] = $this->activity_model->get_user_most_recent_activity_id($data['user_id']);
			 $data['activity_num']=0;
			 $data = $this->profile_model->get_page_device_data($data);	//note - data will pass-through in the function
			 $data['profile_tab'] = $this->load->view("profile_page/page_device", $data, TRUE);
			*/
			$data['content'] = $this -> load -> view("profile_page/page_main", $data, TRUE);
			//this is to generate the tab page with the given valuables
			$this -> load -> view("tpl_main", $data);
		}else{
			//echo "<br/>profile 61 ";	
			//echo "<br/> profile 58 not allow to access.";
			$data=$this->profile_model->jump_to_no_activity_found();
			$this -> load -> view("tpl_main", $data);
			//header("location: ".site_url());
		}
	}

	public function view_activity() {
		//$data['user_id'] = $this -> uri -> segment(3, $this -> user_id);
		//$data['app_id'] = $this -> uri -> segment(4, 'device_app_id');
		$data['activity_id'] = $this -> uri -> segment(5, 0);
		//0 for lastest(none)
		$url = site_url("profile/activity/{$data['activity_id'] }");
		header("Location: {$url}");
		/*
		$this->load->model("profile_model");
		$data=$this->profile_model->bll_view_activity($data);
		
		$data['content'] = $this -> load -> view("profile_page/page_device", $data, true);
		$this -> load -> view("tpl_main", $data);*/
	}
	public function activity(){
		//echo "<br/>profile 86 ";
		$data['activity_id'] = $this -> uri -> segment(3, 0);
		if($data['activity_id']!=0){
			//echo "<br/>profile 67";
			$activity=$this->activity_model->DBget_activity_data_by_activity_id($data['activity_id']);
			//echo "<br/> profile 80 ".$data['activity_id'].count($activity).":".$activity['app_id'];
			//print_r($activity);
			if( (isset($activity['app_id']))&&($activity['app_id']!=null) ){
				//echo "<br/>profile 70";
				//$data['user_id']=$activity['user_id'];
				//$data['app_id'] =$activity['app_id'];
				$data['user_inhouse_data'] =$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($activity['user_inhouse_id']);
				$data['user_id']=$activity['user_inhouse_id'];
				$data['app_id']=$activity['app_id'];
				$data['app_data'] =$activity;
				$data=$this->profile_model->bll_view_activity($data);
				//echo "<br/>profile 74";
				//print_r($data);
				$data['content'] = $this -> load -> view("profile_page/page_device", $data, true);
				
				//print_r($data);
				//echo "<br/>profile 86";
				//print_r($data);
				$this -> load -> view("tpl_main", $data);	
				//echo "<br/>profile 76";
				
				//=========================
				
				/*$data['device_tabs'] = $this -> profile_model -> get_user_device_tabs($data['user_id']);
				$profile_tabs_html = $this -> profile_model -> get_user_device_tabs_html($data['user_id']);
				$data = array_merge($data, $this -> init_model -> bll_get_header(true, $profile_tabs_html));
				$data = $this -> profile_model -> get_page_user_profile_data($data);
				
				$data['profile_tab'] = $this -> load -> view("profile_page/page_user_profile", $data, TRUE);
				$data['content'] = $this -> load -> view("profile_page/page_main", $data, TRUE);
				//this is to generate the tab page with the given valuables
				$this -> load -> view("tpl_main", $data);
				*/
				
			}else{
				/*$data['user_id'] =null;
				$data['app_id'] =null;*/
				//echo "<br/> profile 93";
				$data=$this->profile_model->jump_to_no_activity_found();
				$this -> load -> view("tpl_main", $data);
			}
		}else{
				/*$data['user_id'] =$activity['user_inhouse_id'];
				$data['app_id'] =0;
				$data=$this->profile_model->bll_view_activitiy($data);*/
				//echo "<br/> profile 101";
				$data=$this->profile_model->jump_to_no_activity_found();
				$this -> load -> view("tpl_main", $data);
		}
	}

	public function page_user_profile() {
		//echo "<br/> profile 133";
		$data = array();
		$data['user_id'] = $this -> uri -> segment(3, $this -> user_id);
				
		$data = $this -> profile_model -> get_page_user_profile_data($data);		
		//note - data will pass-through in the function
		$this -> load -> view("profile_page/page_user_profile", $data);
	}

	public function ajax_get_activity_overview_data() {
		//echo "<br/> profile 142";
		$data['user_id'] = $_GET['user_id'];
		$data['activity_id'] = $_GET['activity_id'];
		$data['app_id'] = $_GET['app_id'];
		if (!$data['activity_id'] || !$data['app_id'] || !$data['user_id']) {
			exit();
		}

		//$ui_arr = $this -> profile_model -> ajax_get_page_device_data($data);
		$ui_arr = $this -> profile_model -> get_page_device_data($data, true);
		
		if(isset($ui_arr['block_activity_overview']))
			echo $ui_arr['block_activity_overview'] . "~||~" . $ui_arr['left']['block_views']['block_record'] . "~||~" . $ui_arr['right']['block_views']["block_route"];
		else {
			echo $ui_arr['left']['block_views']['block_record'] . "~||~" . $ui_arr['right']['block_views']["block_route"];
		}
	}

	public function demo_download_page() {
		$data = array();
		$this -> load -> view("profile_page/block_iphone_apps_demo_downloader", $data);
	}

	public function page_device() {
			
		//$this->output->enable_profiler(true);	
		
		$data = array();
		$data['user_id'] = $this -> uri -> segment(3, $this -> user_id);
		$data['app_id'] = $this -> uri -> segment(4, 'device_app_id');
		$data['activity_id'] = $this -> uri -> segment(5, 0);
		
		if ($data['activity_id'] == 0) {
			$data['activity_id'] = $this -> profile_model -> get_lastest_activity_id($data['user_id'], $data['app_id']);
		}
		//echo "<br/>profile 188 ".$data['activity_id'];
		$activity_has_ended = $this -> activity_model -> check_if_activity_has_ended($data['activity_id']);
		if ($activity_has_ended) {
			$data['is_live'] = "false";
		} else {
			$data['is_live'] = "true";			
		}
		
		$data = $this -> profile_model -> get_page_device_data($data);
		
		//note - data will pass-through in the function
		$this -> load -> view("profile_page/page_device", $data);
	}


}
