<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(true);
		$this->load->model("init_model");
		$this->load->library("native_session");
	}	
	public function open_graph_object()
	{	
		$activity_id = $this->uri->segment(3, '');
		$this->load->model("ctrl_activity_model", "ctrl_activity");
		$this->ctrl_activity->get_open_graph_object($activity_id);
		
	}
	public function index(){
		//note: if you want to change the login user interface, please go to see the data structure in the ctrl_login_model->bll_load_login_page()
		// and change the views > login > 
		$data=$this->init_model->bll_get_header($this->native_session->get("userinfo"));	
		$data['content'] = $this->load->view("corporate_info/front_page_intro", $data, true); 
		$this->load->view("tpl_main.php", $data);
	}
	public function recent_activities(){
		$data=$this->init_model->bll_get_header($this->native_session->get("userinfo"));	
		$data['content'] = $this->load->view("corporate_info/front_page_intro", $data, true); 
		$this->load->view("tpl_main.php", $data);
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
}

?>