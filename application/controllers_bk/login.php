<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(true);	//debug function
		$this->load->model("init_model");
		$this->load->model("login_model");
		$this->load->model("facebook_model");
		$this->load->model("activity_model");
		$this->load->library("native_session");
		
		//$this->init_model->includeControllerFile("user");
		//$this->login=new User();
		//$this->load->library('facebook');
		//header(Location)	
		$this->load->library("lightopenid");
		$this->load->model("user_model");
	}
	function __destruct() {
    	$this->init_model->destroy_sensitive_session();
    }
	//============login area===============//
	public function openid_login($type=null){
		global $_REQUEST;	
		//echo "login 24 ".$type;
		//print_r($_REQUEST);
		if( isset($_REQUEST['openid_claimed_id']) ){
			//print_r($_REQUEST);
			if($this->native_session->get('merge')=="true"){
				//echo "login 30"; 
				$this->login_model->save_openid_account($_REQUEST, "merge");
				$this->website_after_login(site_url()."/settings/index/merge");
		
			}else if($type==null){
				$result=$this->login_model->save_openid_account($_REQUEST);
				//echo "<br/>login 33<br/>";
				//print_r($result);
				$this->login_model->session_set_user_login($result[0]);
				$this->website_after_login();
			}else if($type=="m"){
				//m for mobile
				$result=$this->login_model->save_openid_account($_REQUEST);
				//echo "<br/>login 40 <br/>";
				//print_r($result);
				$mobile=$this->native_session->get("app_info");
				//print_r($mobile);
				//$this->native_session->set('mobile', $result);
				//echo "<br/>login 45 <br/>";
				//print_r($result);
				$data=$this->login_model->bll_test_mobile_login($result[0], $mobile);
				//echo "<br/>login 47 <br/>";
				//print_r($data);
				$this->native_session->set('mobile_info', $this->login_model->mobile_login($data));
				//echo "<br/>login 50 <br/>";
				//print_r($this->native_session->get('mobile'));
				//print_r($this->native_session->get('mobile'));
				header("location: ".site_url()."login/page_mobile_logined");
				//$this->load->view(site_url()."/login/page_mobile_logined", $data);
				exit();
			}
		}else{
			echo "login 62 cannot get open id provider response";
			
		}
		//eader("location:".base_url());
	}
	public function page_mobile_logined(){
		$data=array();
		$data['result']=$this->native_session->get('mobile_info');
		//$data['result']=json_encode($data['result']);
		//print_r($data);
		$this->load->view("login/page_mobile_logined", $data);
	}
	public function save_mobile_openid_login_and_submit(){
		//print_r($_POST);
		//need to implement write db record
		//print_r($_POST);
		if($this->login_model->check_manufacturer_token($_POST['manuifacture_token'])){
			//$result=$this->login_model->DBset_login_app($_POST);
			$this->native_session->set("app_info", $_POST);
			//echo "<br/>login 67<br/>";
			//print_r($this->native_session->get("mobile"));
			if($_POST['identity']=="google"){
				header("location: ".site_url()."login/login_google/m");
			}else if($_POST['identity']=="yahoo"){
				header("location: ".site_url()."login/login_yahoo/m");
			}else{
				//facebook
				$data=$this->facebook_model->bll_facebook_login_variable("m");
				/*echo "location: https://www.facebook.com/login.php?api_key=".$data['fb_app_id']."
					&display=popup&fbconnect=1
					&next=".$data['fb_app_return_link']."&return_session=1&session_version=3&v=1.0
					&req_perms=".$data['fb_app_perms'];*/
				$url=$this->facebook_model->get_facebook_login_url(site_url()."login/facebook_login");
				//echo "<br/>login 99 ".$url;
				header("location: ".$url);
			}
		}else{
			$data=array();
			echo $data['result']="login 69 your manufacturer token does not match.";	
			$this->load->view("login/page_mobile_logined", $data);
			
		}
		/*<a href="https://www.facebook.com/login.php?api_key=<?php echo $fb_app_id?>
				&display=popup&fbconnect=1
				&next=<?php echo $fb_app_return_link?>&return_session=1&session_version=3&v=1.0
				&req_perms=<?php echo $fb_app_perms?>" >*/
			
		
	}

	public function facebook_channel(){
		//LV1
		$cache_expire = 60*60*24*365;
 		header("Pragma: public");
 		header("Cache-Control: max-age=".$cache_expire);
 		header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$cache_expire) . ' GMT');
		?>
 		<script src="//connect.facebook.net/en_US/all.js"></script>
		<?php
	}
	
	public function show_login($merge=null){	
		//LV1	
		//global $config;
		//$data['login']=$this->facebook_model->bll_facebook_login_variable();
		if($merge!=null){
			$this->native_session->set("merge", "true");
			$data['merge']="merge";
		}else{
			$data['merge']="no";	
		}
		$data['facebook_login_link']=$this->facebook_model->get_facebook_login_url(site_url()."login/facebook_login");
		
		//print_r($data);
		//this page will be opened in lightbox, no tpl is needed.
		//cho "user 54";
		$this->load->view("login/page_login.php", $data);	
		//$this->load->view("page_main.php", $data);	
	}
	public function facebook_logout(){
		//$data=$this->facebook_model->bll_facebook_login_variable();
		//$data['facebook_logout_url']=$this->facebook_model->FBget_logout_url();
		//$this->load->view("login/page_facebook_logout", $data);
		//setcookie('fbs_'.$this->facebook->getAppId(), '', time()-100, '/', $_SERVER['HTTP_HOST']);
		//setcookie('PHPSESSID', '', time()-3600, "/");
		//header("location: ".site_url()."/login/logout");
		//$this->session->sess_destroy();
    	//redirect('/user', 'refresh');
    	$arg['next']=site_url();
		//echo $data['logout_openid_link']=
    	echo $url="https://www.facebook.com/logout.php?next=".urlencode(site_url())."&access_token=".$this->native_session->get('access_token'); 
				
    	//echo $url=$this->facebook->getLogoutUrl($arg);
    	//$this->facebook->destroySession();
    	header("location: ".$url);
	}
	
	public function website_after_login($url=""){
		//LV3 ctrl
		$inhouse_info=$this->native_session->get("inhouse_info");
		if($inhouse_info['customize_edit_count']==0){
			header("location:".site_url()."/settings/index/firstlogin");			
		}else if($url==""){
			header("location:".site_url());	
		}else{
			header("location:".$url);	
		}
	}
	
	public function login_again(){
		$next=$this -> uri -> segment(3, null);
		$data=array();
		if($next=="index"){
			$data['next']=site_url();
		}else if($next=="mobile"){
			$data['next']=site_url()."login/mobile_login";
		}
		$this->load->view("login/page_login_again", $data);
		
	}
	
    public function facebook_login(){
    	//LV1
    	global $_GET;
		$this->output->enable_profiler(true);	//debug function
		//print_r($this->native_session->get("mobile"));
		if($this->native_session->get("merge")=="true"){
			//merge account 
			$this->facebook_model->ctrl_merge_facebook_account($_GET);
			$this->website_after_login(site_url()."settings/index/merge");
		}else if($this->native_session->get("image")!=null){
			//save the image upload from activity
			$this->facebook_model->ctrl_upload_image_to_facebook();
			//echo "controller login 80";
		}else if($this->native_session->get("mobile")==null){
			//normal website login
	    	if($this->facebook_model->ctrl_save_facebook_login_after_login()!=null){
				$this->website_after_login();
	    	}else{
	    		header("location: ".site_url()."login/login_again/index");
	    	}
		}else if($this->native_session->get("mobile")=="true"){
			$result=$this->facebook_model->ctrl_save_facebook_login_after_login();
			//the native session app_info is record when the mobile get in the first login page 
			$mobile=$this->native_session->get("app_info");
			$data=$this->login_model->bll_test_mobile_login($result[0], $mobile);
			$this->native_session->set('mobile_info', $this->login_model->mobile_login($data));
			header("location: ".site_url()."login/page_mobile_logined");
			exit();
		}
		echo "login 187 out of range";
    }
	public function login_google($type){
		//LV1
		//print_r($this->lightopenid);
		/*echo $this->init_model->urlwriting("/user/openid_login");
		echo "<br/>";
		echo $this->user_model->text_get_header_text( $this->init_model->urlwriting("/user/openid_login"), "yahoo");
		*/
		if($type==null)
			header('Location: ' . $this->login_model->text_get_header_text($this->init_model->urlwriting("login/openid_login"), "google"));
		else if($type=='merge')
			header('Location: ' . $this->login_model->text_get_header_text($this->init_model->urlwriting("login/openid_login/merge"), "google"));
		else if($type=='m'){
			//echo "controller login 85";
			header('Location: ' . $this->login_model->text_get_header_text($this->init_model->urlwriting("login/openid_login/m"), "google"));
		}
	} 
	public function login_yahoo($type){
		//LV1
		//print_r($this->lightopenid);
		//echo $this->user_model->text_get_header_text( $this->init_model->urlwriting("/user/openid_login"), "google");
		if($type==null)
			header('Location: ' . $this->login_model->text_get_header_text($this->init_model->urlwriting("login/openid_login"), "yahoo"));
		else if($type=='merge')
			header('Location: ' . $this->login_model->text_get_header_text($this->init_model->urlwriting("login/openid_login/merge"), "yahoo"));
		else if($type=='m'){
			header('Location: ' . $this->login_model->text_get_header_text($this->init_model->urlwriting("login/openid_login/m"), "yahoo"));
		}	
	} 
	
	
	public function mobile_login($info=""){
		/*
	 	 * objective: 
		 * allow mobile both login and regist,
		 * demo only
		 * the server will search for the email + platform as key
		 * if has record, then pass the user_inhouse_id
		 * if there is no record, then insert it and pass user_inhouse_id
		 * $info={device_uuid, app_id, email, platform, token}
		 * device_uuid, //device uuid 
		 * app_id,  // apps id in our server, the device_apps_uuid can be taken in database.
		 * email, 
		 * platform, //yahoo, google, facebook
		 * token //inhouse developer apps token
		*/
		//for testing only:
		//$info=$this->login_model->bll_test_mobile_login();
		//echo $this->login_model->mobile_login($info);
		//$data=$this->facebook_model->bll_facebook_login_variable("m");
		$data=array();
		$data['facebook_login_link']=$this->facebook_model->get_facebook_login_url(site_url()."login/facebook_login");
		$this->load->view("login/page_mobile_login.php", $data);	
		//for real
	}
	public function show_user_base_data_input_form(){
		$data="";	
		$this->load->view("login/", $data);	
	}
	/*public function mobile_regist($info){
		$info={email, }
	}*/
	public function logout($openid){
		//LV1
		$this->login_model->session_set_user_logout();
		header('location:'.base_url());
	}
	//==========end of login area==========//
}