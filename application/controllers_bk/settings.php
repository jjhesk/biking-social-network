<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller{
	
	public $login;
	function __construct()
	{
		parent::__construct();
		
		//will kick user out of this controller if not log-in
		$this->load->library("native_session");		
		if(($user_info = $this->native_session->get("userinfo"))==null)	
		{
			$url = site_url();
			header( "HTTP/1.1 301 Moved Permanently" );
			header("Location: {$url}/portal/login");
			exit();
		}
		$this->user_id = $user_info['user_inhouse_id'];
		
		$this->load->model("init_model");
		$this->load->model("login_model");		
		$this->load->library('googlemaps');
		$this->load->model("googlemaps_model");
		$this->load->model("profile_model");
		$this->load->model("activity_model");
		$this->load->model("user_model");
		
		$this->output->enable_profiler(false);	//debug function
		
		
	}
	function __destruct() {
    	$this->init_model->destroy_sensitive_session();
    }
	public function index($firstlogin="")
	{
		
		$data = $this -> init_model -> bll_get_header($this -> native_session -> get("userinfo"));
		//echo "<br/>settings 38<br/>";
		//print_r($this -> native_session -> get("userinfo"));
		$data['merge']=$this -> uri -> segment(3, "");
		//echo "settings 37 ".$data['merge'].":".$data['firstlogin'];
		$data['submited']=false;
		$this->load->helper('form');
		$data['user_data'] = $this -> user_model -> get_user_settings_data($this->user_id);
		$data['errors'] = array();
		// $data['user_app']=$this->profile_model->get_installed_app_id($this->user_id);
		$data['user_app']=$this->user_model->get_user_installed_apps($this->user_id);
		$data['content'] = $this->load->view("settings/page_main", $data, true);
		$data['block_navigation_bar'] = $this->load->view("header/block_navigation_bar", $data, TRUE);
		$this->load->view("tpl_main", $data);
	}
	
	public function form_submit()
	{
			
		//check the data and change it.
		$errors = $this->user_model->error_checking($_POST);
		if (!$errors['has_errors']) {
			$this->user_model->update_user_settings($this->user_id, $_POST);
		}	
		
		//normally display the result.
		$data = $this -> init_model -> bll_get_header($this -> native_session -> get("userinfo"));
		$data['user_data'] = $this -> user_model -> get_user_settings_data($this->user_id);
		$data['user_app']=$this->user_model->get_user_installed_apps($this->user_id);
		$data['firstlogin']=false;
		$data['merge']=$this -> uri -> segment(3, "");
		//echo "settings 37 ".$data['merge'].":".$data['firstlogin'];
		if ($errors['has_errors']) {
			$data['errors'] = $errors;
			$data['user_data']['weight'] = $this->input->post('weight');
			$data['user_data']['height'] = $this->input->post('height');
			$data['submited']=false;
		
		} else {
			$data['errors'] = array();
			$data['user_data'] = $this -> user_model -> get_user_settings_data($this->user_id);
			//$this->user_model->update_user_settings($this->user_id, $_POST);
			$data['submited']=true;
		
		}

		$this->load->helper('form');
		
		$data['content'] = $this->load->view("settings/page_main", $data, true);
		$this->load->view("tpl_main", $data);
	}

	public function merge(){
		$data=array("fb_app_id"=>$this->config->item('fb_app_id'), 
			"fb_app_secret"=>$this->config->item('fb_app_secret'),
			"fb_app_perms"=>$this->config->item('fb_app_perms'),
			"fb_app_return_link"=>$this->init_model->urlwriting("login/facebook_login/merge"),
			"ismerge"=>true
			);
		//cho "user 54";
		$this->load->view("page_login", $data);	
	}	
	
		
}

?>