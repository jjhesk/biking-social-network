<?php

class Mod_openid_model extends CI_Model {
	public $openid_para;
	public $openid_header;
	public $openid_server_provider;

	public function __construct(){
		parent::__construct();
		/* constant setting */
		$this->openid_para=array();
		$this->openid_header=array();
		$this->openid_server_provider=array();
		$this->openid_para['google']=array(
			"email"=>"openid_ext1_value_email",
			"identity"=>"openid_identity",
			"openid"=>"openid_claimed_id",
			"language"=>"openid_ext1_value_language",
			"firstname"=>"openid_ext1_value_firstname",
			"lastname"=>"openid_ext1_value_lastname"
		);
		$this->openid_para['yahoo']=array(
			"email"=>"openid_ax_value_email",
			"identity"=>"openid_identity",
			"openid"=>"openid_claimed_id",
			"language"=>"openid_ax_value_language",
			"image"=>"openid_ax_value_image",
			"gender"=>"openid_ax_value_gender",
			"fullname"=>"openid_ax_value_fullname"
		);
		$this->openid_header['header']='?openid.ns='.urlencode('http://specs.openid.net/auth/2.0') .
            '&openid.realm=' . urlencode('http://'.$_SERVER['HTTP_HOST']) .
            '&openid.claimed_id=' . urlencode('http://specs.openid.net/auth/2.0/identifier_select') .
            '&openid.identity=' . urlencode('http://specs.openid.net/auth/2.0/identifier_select') .
            '&openid.mode=' . urlencode('checkid_setup') .
            '&openid.ns.ax=' . urlencode('http://openid.net/srv/ax/1.0') .
            '&openid.ax.mode=' . urlencode('fetch_request');
		$this->openid_header['google']='&openid.ax.required=' . urlencode('firstname,lastname,email,language') .
            '&openid.ax.type.firstname=' . urlencode('http://axschema.org/namePerson/first') .
            '&openid.ax.type.lastname=' . urlencode('http://axschema.org/namePerson/last') .
			'&openid.ax.type.language=' . urlencode('http://axschema.org/pref/language') .
            '&openid.ax.type.email=' . urlencode('http://axschema.org/contact/email');	
		$this->openid_header['yahoo']='&openid.ax.required=' . urlencode('fullname,email,language,image,gender') .
            '&openid.ax.type.fullname=' . urlencode('http://axschema.org/namePerson') .
            '&openid.ax.type.email=' . urlencode('http://axschema.org/contact/email') .
			'&openid.ax.type.language=' . urlencode('http://axschema.org/pref/language') .
			'&openid.ax.type.image=' . urlencode('http://axschema.org/media/image/default') .
            '&openid.ax.type.gender=' . urlencode('http://axschema.org/person/gender');
		 
		$this->openid_server_provider['google']='https://www.google.com/accounts/o8/id';
		$this->openid_server_provider['yahoo']='https://me.yahoo.com';
	} 
	public function text_get_header_text($return_url, $openid_server_provider){
		//LV1 in this class...
		$this->lightopenid->returnUrl=$return_url;
		$this->lightopenid->identity = $this->openid_server_provider[$openid_server_provider];
		$endpoint = $this->lightopenid->discover($this->openid_server_provider[$openid_server_provider]);
		return $endpoint.$this->openid_header['header'].'&openid.return_to=' . urlencode($return_url) .$this->openid_header[$openid_server_provider];
	}

}
?>