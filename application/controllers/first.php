<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class First extends CI_Controller {
    /**

     */
    public function __construct() {
        parent::__construct();
        $this -> load -> model("ctrl_login_model", "ctrl_login");
        $this -> load -> model("overhead_model");
        $this -> load -> helper('url');
    }

    public function index() {
        $data['bodymenu'] = "";
        //$data['bodymenu']=get_menu_ressembled(array(50,50,50),45,"socialmenu",base_url()."include/image/common/btn_share_ui.png",true,false);
        $config_hesk['_headload'] = $this -> overhead_model -> loadCSS(array("landing"));
        $config_hesk['_footerload'] = $this -> overhead_model -> loadJS();
        $config_hesk['_browser']=$this->overhead_model->browserVersion();
        $data['footer'] = $this -> load -> view('components/footersmall', $config_hesk, true);
        $data['header'] = $this -> load -> view('components/header', $config_hesk, true);
        $data['facebooklogin'] = $this -> ctrl_login -> get_facebook_login_link();
        $this -> load -> view('landing', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
