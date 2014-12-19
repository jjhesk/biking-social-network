<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class Portal extends CI_Controller { 	//used by Fenix to check out acitivites - will move to other controllers
	public $login;
	function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(true);	//debug function
		$this->load->model("init_model");
		$this->load->model("login_model");
		$this->load->model("activity_model");
		$this->load->model("profile_model");
		$this->load->model("facebook_model");
		$this->load->library("native_session");
		
	}
	function __destruct() {
    	$this->init_model->destroy_sensitive_session();
    	//parent::__destruct();
    }
	public function index(){
		
		//$url=site_url('product/view');
		//header("Location: {$url}");
		$data=$this->init_model->bll_get_header($this->native_session->get("userinfo"));	
		$data['content'] = $this->load->view("corporate_info/front_page_intro", $data, true); 
		$this->load->view("tpl_main.php", $data);
	} 
	
	public function login(){
		//TODO: bug
		$data=$this->init_model->bll_get_header($this->native_session->get("userinfo"));	
		$data['login']=$this->facebook_model->bll_facebook_login_variable();
		//$data['content'] = $this->load->view("login/block_loginbtn", $data, TRUE);
		$data['content'] = $this->load->view("page_main", $data, TRUE);
		$this->load->view("tpl_main.php", $data);
	}
	
	
	
	public function nyro_first_signup_form()
	{
		$data['user_id'] = $this->uri->segment(3, 'user_id');		
		$this->load->view("settings/nyro_first_signup_form", $data);
	}

	public function subpage()
	{
		echo 'subpage';
		$data['content'] = $this->load->view("settings/nyro_first_signup_form", $data, TRUE);
		$this->load->view("tpl_main", $data);
	}
	public function open_graph_object()
	{
		//current use in contest_gallery_like
		$activity_id = $this->uri->segment(3, '');
		//echo $activity_id;
		$data['open_graph_object']=$this->activity_model->DBget_get_open_graph_object($activity_id);
		$data['fb_app_id']=$this->config->item("fb_app_id");
		$data['fb_admins']=$this->config->item("fb_admins");
		//$returnurl=FACEBOOK_APP_URL;
		//echo "<br/> portal 242";
		//print_r($data);
		header(':', true, 206);
		if(count($data['open_graph_object'])>0){					
			$this->load->view("open_graph_object", $data);		
		}else{
			echo "<br/>protal 249 no activity found";	
		}
	}
	
	
}
?>