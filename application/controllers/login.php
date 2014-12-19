<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		//$this->output->enable_profiler(true);	//debug function
		$this->load->model("ctrl_login_model", "ctrl_login");
        $this->callback_url=site_url()."loginedin/index/";
	} 
    private function get_config_hesk(){
            $config_hesk=array();
            $config_hesk['_headload'] = $this -> _headload;
            $config_hesk['_footerload'] = $this -> _footerload;
            $config_hesk['_browser'] =  $this->overhead_model->browserVersion();
            return $config_hesk;
    }
	public function index()
	{
		echo "hello";
	}
	public function test(){
		$this->load->helper('url');
		echo "<a href='".$this->ctrl_login->get_facebook_login_link()."'>login</a><br/><a href='".$this->ctrl_login->get_facebook_logout_link(site_url()."/login/logout")."' >logout</a>";
		//echo "<br/><a href='https://www.facebook.com/logout.php?next=http%3A%2F%2Ffenix.it.imusictech.com%2F121231_facebook%2Findex.php%2Flogin%2Ftest&access_token=AAAILaZBR2fncBAK2Pr6xTj2HFPrI5RUPZBTGTxtWSSEkhJIgxlZAxePO3FDZC2tZAZAwWqoXsHLlahWQsnHa5NrQ5BGUSbZBePy1ePXloYFl46fZCAQOstQj'>logout</a>";
		//print_r($_SESSION);
	}
	public function logout(){
		$this->ctrl_login->set_user_logout();
		//echo "login 35 this is logout page, load this page equal to logout.";
		header("location: ".site_url());
	}
	public function facebook_login(){
		$this->load->helper('url');
		$this->ctrl_login->facebook_login($this->callback_url);
	}
	public function page_mobile_logined(){
		$data=array();
		$data['result']=$this->native_session->get('mobile_info');
		//$data['result']=json_encode($data['result']);
		//print_r($data);
		$this->load->view("login/page_mobile_logined", $data);
	}
	public function mobile_login(){
		echo $this->ctrl_login->mobile_login();
	}
	public function mobile_logined(){
		echo $this->ctrl_login->mobile_logined();
	}
	public function return_area(){
		echo "<br/>login 36 this is the return area after facebook login.";
	}
	public function save_mobile_openid_login_and_submit(){
		$this->ctrl_login->save_mobile_openid_login_and_submit();
	}
	
	/*public function test_token(){
		$_GET['oauth_server_id']="AAABmNfZBuwyMBAAnpdeBGQVj1RyZCvhDcemY5QT01qdTF0JX0fwYgssjCkWsGVZAeOUKoWmPsgqnh1ZCcAQ0qmYNNJnMS9iml6uZBjrKKjwZDZD";
		$this->load->model("mod_facebook_model", "facebook_model");
		echo $token=$this->facebook_model->FBget_access_token_by_code($_GET);
	}*/
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */