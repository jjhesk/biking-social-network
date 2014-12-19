<?php

class Login_model extends CI_Model {
	public $openid_para;
	public $openid_header;
	public $openid_server_provider;
	public function __construct(){
		parent::__construct();
		
		$this->load->library("native_session");
		$this->load->library("lightopenid");
		$this->load->model("init_model");
		
		//$config['fb_app_id'] = '513818161967291';
		//$config['fb_app_secret'] = '58887accd7253ad2c3b5b9ab5e1f4867';
		//$config['fb_app_perms'] = 'publish_stream,read_stream,email,user_photos';
		
		
		/* constant setting */
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
		/* end of constant setting */
	}

	public function bll_test_mobile_login($openid, $mobile){
		
		//$this->db->where("user_inhouse_id", $result['user_inhouse_id']);
		//$info=$this->native_session->get("mobile");
		$info=array();
		$info['device_uuid']=$mobile['device_id'];
		$info['app_device_uuid']=$mobile['app_device_id'];		
		$info['manuifacture_token']=$mobile['manuifacture_token'];
		$info['identity']=$mobile['identity'];
		$info['user_inhouse_id']=$openid['user_inhouse_id'];
		
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
	public function check_manufacturer_token($manuifacture_token){
		//LV2
		//echo "<br/>login_model 84<br/>";
		//echo $manuifacture_token;
		$this->db->where("manufacturer_token", $manuifacture_token);
		$result=$this->db->get("app_data");
		$result=$result->result_array();
		if(count($result)>0) return true;
		else return false;
	}
	public function DBset_login_app($post){
		$this->db->where("manufacturer_token", $post['manuifacture_token']);
		$result=$this->db->get("app_data");
		$result=$result->result_array();
		if(count($result)>0){
			$this->db->where("app_device_uuid", $post['app_device_id']);
			$this->db->where("device_uuid", $post['device_id']);
			$result=$this->db->get("user_app_registration_history");
			$result=$result->result_array();
			if(count($result)==0){
				/*$this->db->set("app_device_uuid", $post['app_device_id']);
				$this->db->set("device_uuid", $post['device_id']);
				$result=$this->db->insert("user_app_registration_history");
				$this->db->where("app_device_uuid", $post['app_device_id']);
				$this->db->where("device_uuid", $post['device_id']);
				$result=$this->db->get("user_app_registration_history");
				$result=$result->result_array();
				return $result[0];	*/
			}else{
				//get the old record
				return $result[0];	
			}
		}else{
			return "login_model 86 wrong manufacturer token.";
		}
	}
	public function DBset_app_info($info){
		//LV3
		//echo "<br/>login_model 121 <br/>";
		//print_r($info);
		
		$this->db->where("device_uuid", $info['device_uuid']);
		$this->db->where("app_device_uuid", $info['app_device_uuid']);
		$result=$this->db->get("user_app_registration_history");
		$result=$result->result_array();
		if(count($result)==0){
			//echo "<br/>login_model 129<br/>";
			//echo $info['manuifacture_token'];
			$this->db->where("manufacturer_token", $info['manuifacture_token']);
			$result=$this->db->get("app_data");
			$result=$result->result_array();
			
			$this->db->set("device_uuid", $info['device_uuid']);
			$this->db->set("app_device_uuid", $info['app_device_uuid']);
			$this->db->set("user_inhouse_id", $info['user_inhouse_id']);
			$this->db->set("app_id", $result[0]['app_id']);
			
			$result=$this->db->insert("user_app_registration_history");		
			//return $this->db->insert_id();
		}
		//return $result[0][''];
	}
	
	public function mobile_login($info){
		//LV2
		//$info=json code 
		//for demo only
		/*$info['device_uuid']="d47d4dbb-a117-478d-908a-75dd8ef3b5f0";
		$info['app_id']="95573fd2-52d8-4f0a-9b49-fa4103ce4d25";
		$info['email']="facebook@it.imusictech.com";
		$info['platform']="facebook";
		$info['token']="972bc224acf1145e78f49a3ca5295d3d";*/
		//$info=json_decode($info, true);	
		//echo $info['manuifacture_token'];
		
			//echo "<br/>login_model 91<br/>";	
			//print_r($result);
			
			//save the manufacturer token
			$this->DBset_app_info($info);
			
			//echo "<br/>login_model 159 ".$info['user_inhouse_id'];
			
					$this->db->where("user_inhouse_id", $info['user_inhouse_id']);
					$result=$this->db->get("user_inhouse_data");
					$result=$result->result_array();
					$response['user_inhouse_id']=$result[0]['user_inhouse_id'];
					/*if($result[0]['nickname']!=null)
						$response['nickname']=$result[0]['nickname'];
					else
						$response['nickname']=" ";*/
					$response['nickname']=$result[0]['nickname'] ? $result[0]['nickname'] : " ";
					$response['firstname']=$result[0]['firstname'] ? $result[0]['firstname'] : " ";
					$response['lastname']=$result[0]['lastname'] ? $result[0]['lastname'] : " ";
					$response['identity']=$info['identity'];
					$response['email']=$result[0]['email'];
					$response['profile_image']=$result[0]['profile_image'] ? $result[0]['profile_image'] : " ";
					return json_encode($response);
				
		
	}
	public function bll_load_login_page(){
		if($this->native_session->get("userinfo")){
			$data['userinfo']=$this->native_session->get("userinfo");
			if($data['userinfo']['identity']=="facebook"){
				$data['graph_url']="https://graph.facebook.com/".$data['userinfo']['openid']."/photos?access_token=".$data['userinfo']['access_token'];
				//$data['facebook_id']=$this->native_session->get('access_token');
				$data['fp_app_id']=$this->config->item("fp_app_id");
				$session_key=$this->native_session->get("session_key");
													 //https://www.facebook.com/logout.php?next=http%3A%2F%2Fwww.imobilepet.com%2Ffb_logout.php&access_token=AAADWDk7MLvUBANdutn15esWiM4pKG0sbdZAkhBpwHm7g6VGVhwYkr88ZB7DF6GH5iwZACK85x10rlfpZAEJUqRyuUNBMcZAL3l5sha3ZAsGZBbkxGZAmmGHU
				$data['logout_openid_link']="https://www.facebook.com/logout.php?next=".urlencode(site_url()."login/logout")."&access_token=".$this->native_session->get('access_token'); 
				//$data['logout_openid_link']=site_url()."/login/logout";
				//$this->facebook->getLogoutUrl();
			}else if($data['userinfo']['identity']=="google"){
				$data['logout_openid_link']="https://www.google.com/accounts/Logout";
			}else if($data['userinfo']['identity']=="yahoo"){
				$data['logout_openid_link']="https://login.yahoo.com/config/login?logout=1";
			}
			$inhouse_info=$this->native_session->get("inhouse_info");
			$data['nickname']=$inhouse_info['nickname'];
			
			if($inhouse_info['customize_edit_count']=="0")
				$data['firstlogin']=true;
			else
				$data['firstlogin']=false;
			
			$this->db->select("count(subject_user_id) as counter");
			$this->db->where("subject_user_id", $data['userinfo']['user_inhouse_id']);
			$query=$this->db->get("user_relation");
			$result=$query->result_array();
					
			if( ($result[0]['counter']=="0")&&($inhouse_info['customize_edit_count']>0) )
				$data['afterfirstlogin']=true;
			else
				$data['afterfirstlogin']=false;
			
			$data['no_apps']=$this->check_user_no_apps();
			//print_r($this->native_session->get("userinfo"));
			//print_r($this->native_session->get("sessionToken"));
		}
		//print_r($this->native_session->get("inhouse_info"));
		$this->load->model("facebook_model");
		$data['facebook_login_url']=$this->facebook_model->get_facebook_login_url(site_url()."login/facebook_login");
		$data['show_user_logined']=$this->lv1_get_login();
		
		
		
		if($data['show_user_logined']!=false){
			$data['view_block_login_area']=$this->load->view('login/block_logined', $data, true);
		}else{
			$data['view_block_login_area']=$this->load->view('login/block_loginbtn', $data, true);
		}
		
		return $data;
		
	}		
		
		
	public function lv1_get_login(){		
		if($this->native_session->get('userinfo')==null){
			return false;
		}else{
			$data=array($this->native_session->get('userinfo'));
			return $data;
		}
	}				
	public function text_get_header_text($return_url, $openid_server_provider){
		//LV1 in this class...
		$this->lightopenid->returnUrl=$return_url;
		$this->lightopenid->identity = $this->openid_server_provider[$openid_server_provider];
		$endpoint = $this->lightopenid->discover($this->openid_server_provider[$openid_server_provider]);
		return $endpoint.$this->openid_header['header'].'&openid.return_to=' . urlencode($return_url) .$this->openid_header[$openid_server_provider];
	}
	
	public function save_facebook_account($access_token, $type=null){
		//LV1
		//print_r($get);
		//echo "<br/>";
		//access_token,
		//uid
		$config['appId']=$this->config->item("fb_app_id");
		$config['secret']=$this->config->item("fb_app_secret");		
		$this->load->library("facebook", $config);	
		
		//$session=json_decode($get['session'], true);
		
		//$session=json_decode($get['code'], true);
		
		//echo "<br/>login model 256<br/>";
		//print_r($session);
		//$this->native_session->set("session_key", $session['session_key']);
		$this->facebook->setAccessToken($access_token);
		$this->native_session->set("access_token", $access_token);
		//print_r($session);
		$user=$this->facebook->getUser();
		//echo "<br/>login_model 168 ".$user;
		
		$fql="select email, name, first_name, last_name, sex, locale from user where uid=".$user;
		//echo $fql="select * from users where uid=".$session['uid'];
		$ret_obj = $this->facebook->api(array(
                                   	'method' => 'fql.query',
                                   	'query' => $fql,
                                 	));
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
		$result['server']="facebook";
		$result['identity']="facebook";
		$result['email']=$ret_obj[0]['email'];
		
		//$result['openid']=$session['uid'];
		$result['openid']=$user;
		$result['firstname']=$ret_obj[0]['first_name'];
		$result['lastname']=$ret_obj[0]['last_name'];
		$result['fullname']=$ret_obj[0]['name'];
		$result['gender']=( ($ret_obj[0]['sex']=="male")?"m":"f" );
		$result['language']=$ret_obj[0]['locale'];
		//$result['avator']=$ret_obj[0]['picture'];
		
		$result=$this->db_set_account($result, $type);
		$result[0]['access_token']=$access_token;
		$this->native_session->set("access_token", $access_token);
		return $result;
		
	}
	public function get_redirect_url($url){
	    //LV3	
	    $redirect_url = null;
	 
	    $url_parts = @parse_url($url);
	    if (!$url_parts) return false;
	    if (!isset($url_parts['host'])) return false; //can't process relative URLs
	    if (!isset($url_parts['path'])) $url_parts['path'] = '/';
	      
	    $sock = fsockopen($url_parts['host'], (isset($url_parts['port']) ? (int)$url_parts['port'] : 80), $errno, $errstr, 30);
	    if (!$sock) return false;
	      
	    $request = "HEAD " . $url_parts['path'] . (isset($url_parts['query']) ? '?'.$url_parts['query'] : '') . " HTTP/1.1\r\n";
	    $request .= 'Host: ' . $url_parts['host'] . "\r\n";
	    $request .= "Connection: Close\r\n\r\n";
	    fwrite($sock, $request);
	    $response = '';
	    while(!feof($sock)) $response .= fread($sock, 8192);
	    fclose($sock);
	 
	    if (preg_match('/^Location: (.+?)$/m', $response, $matches)){
	        if ( substr($matches[1], 0, 1) == "/" )
	            return $url_parts['scheme'] . "://" . $url_parts['host'] . trim($matches[1]);
	        else
	            return trim($matches[1]);
	  
	    } else {
	        return false;
	    }
	     
	}
	public function get_Facebook_Profile_Picture($uid){
		return $this->get_redirect_url("http://graph.facebook.com/".$uid."/picture?width=100&height=100");
		//return $get_redirect_url("http://graph.facebook.com/".$uid."/picture?width=180&height=180");
	}
/*	$this->native_session->set("openid_identity", "facebook");
		$this->native_session->set("access_token", $session['access_token']);
		$this->native_session->set("uid", $session['uid']);*/
	public function session_set_user_logout(){
		$userinfo=$this->native_session->get("userinfo");
		if($userinfo['identity']=="facebook"){
			$config['appId']=$this->config->item("fb_app_id");
			$config['secret']=$this->config->item("fb_app_secret");		
			$this->load->library("facebook", $config);	
			$this->facebook->destroySession();
		}
		$this->native_session->delete('userinfo');
		$this->native_session->delete('access_token');
		$this->native_session->delete('session_time');
		$this->native_session->delete('merge');
		$this->native_session->delete('inhouse_info');
	}
	
	public function db_set_account($get, $type=null){
		//LV2
		//$get={server, identity, email, name, first_name, last_name, gender, language };
			//echo "login_model 373 ".$type.":";
			$this->db->where('email',  $get['email']);
			$this->db->where('identity',  $get['identity']);
			
			$query = $this->db->get('user_openid');
			$result=$query->result_array(); 
			//echo count($result);
			if(count($result)==0){
				//insert into new user;
				$new_id = 0;
				if($type==null){
					
					$this->db->set('del', 'n');
					$this->db->set("profile_image", "http://th02.deviantart.net/fs70/150/f/2012/199/4/3/eddsworld___unknown_profile_by_xnamenloserx-d57qvfm.jpg");
					
					if($get['identity']=='facebook'){
						$this->db->set('profile_image', $this->get_Facebook_Profile_Picture($get['openid']));
					}
					//echo "<br/> login_model 203 ";
					foreach($get as $key=>$val){
						if( ($key!='image')&&($key!='identity')&&($key!='server')&&($key!='openid')&&($key!='avator')&&($key!='fullname') ){		
							$this->db->set($key, $val);
							//echo "<br/>[".$key."]=".$val;	
						}else if($key=="avator"){
							$this->db->set("profile_image", $val);
							//echo "<br/>[profile_image]=".$val;	
						}else if( ($key=="fullname")&&($get['identity']=="yahoo") ){
							$this->db->set("firstname", $val);
							$this->db->set("nickname", $val);
						}else if(($key=="fullname")&&($get['identity']=="facebook")){
							//$this->db->set("firstname", $val);
							//$this->db->set("nickname", $val);
							$this->db->set("nickname", $val);
						}
						if( ($key=="firstname")&&($get['identity']=="google") ){
							$this->db->set("nickname", $val);
						}
					}
					$this->db->set("customize_edit_count", 0);
					$this->db->set("last_updated", "NOW()", false);
					$this->db->set("social_media_publication", $get['identity']);
					$this->db->set("photo_publication", $get['identity']);
					$this->db->insert('user_inhouse_data');
					$new_id=$this->db->insert_id();
					
					
					//check if any friend are already in the list 
					//if they are, add them in the friend list and auto accept
					if($get['identity']=='facebook'){
						$facebook_friend_list=$this->facebook_model->FBget_friendlist();
						//echo "<br/>login_model 425";
						//print_r($facebook_friend_list);
						if(count($facebook_friend_list)>0){
							for($i=0;$i<count($facebook_friend_list);$i++){
								$this->db->or_where("openid", $facebook_friend_list[$i]['uid2'] );
							}
							$friend_list=$this->db->get("user_openid");
							$friend_list=$friend_list->result_array();
							//echo "<br/>login_model 433 ".count($friend_list);
							if(count($friend_list)>0){
								$this->load->model("friends_model");
								for($i=0;$i<count($friend_list);$i++){
									$this->friends_model->DBset_friend($new_id, $friend_list[$i]['user_inhouse_id']);			
								}
							}
						}
					}
					
				}else if($type=='merge'){
					$user_inhouse_id=$this->native_session->get('userinfo');
					//print_r($user_inhouse_id);
					$new_id=$user_inhouse_id['user_inhouse_id'];
				}
				//insert 
					$this->db->set('user_inhouse_id', $new_id);
					if($get['identity']=='facebook'){
						$this->db->set('avator', $this->get_Facebook_Profile_Picture($get['openid']));
					}
				
					foreach($get as $key=>$val){
						if($key!='image')		
							$this->db->set($key, $val);				
						else {
							$this->db->set('avator', $val);				
						}
					}
					//$this->db->set("last_updated", "NOW()", false);
					$this->db->insert('user_openid');
					$new_id=$this->db->insert_id();
					if($type=='merge'){
						$old_user_inhouse_id=$this->native_session->get('userinfo');
						$old_user_inhouse_id=$old_user_inhouse_id['user_inhouse_id'];
						$this->merge_account_detail($old_user_inhouse_id, $new_id);
					}
					$this->db->where('user_openid_id',  $new_id);
					$this->db->where('email',  $get['email']);
					$this->db->where('identity',  $get['identity']);
					$query = $this->db->get('user_openid');
					$result=$query->result_array(); 
			}else if($type=="merge"){
				//update the current openid in the merge
				$old_user_inhouse_id=$result[0]['user_inhouse_id'];
				$user_inhouse_id=$this->native_session->get('userinfo');
				//print_r($user_inhouse_id);
				$new_id=$user_inhouse_id['user_inhouse_id'];
				$this->db->set('user_inhouse_id', $new_id);
					if($get['identity']=='facebook'){
						$this->db->set('avator', $this->get_Facebook_Profile_Picture($get['openid']));
					}
				
					foreach($get as $key=>$val){
						if($key!='image')		
							$this->db->set($key, $val);				
						else {
							$this->db->set('avator', $val);				
						}
					}
					//$this->db->set("last_updated", "NOW()", false);
					$this->db->where('email',  $get['email']);
					$this->db->where('identity',  $get['identity']);
					$this->db->update('user_openid');
					
					//if facebook merge, update the oauth 
					if($get['identity']=='facebook'){
						$this->db->set("user_inhouse_id", $new_id);
						$this->db->where("user_inhouse_id", $old_user_inhouse_id);
						$this->db->update("user_oauth");
					}
					$this->merge_account_detail($old_user_inhouse_id, $new_id);
						
					$this->db->where('user_openid_id',  $new_id);
					$this->db->where('email',  $get['email']);
					$this->db->where('identity',  $get['identity']);
					$query = $this->db->get('user_openid');
					$result=$query->result_array(); 
			}
			return $result;
	}
	public function DBset_merge_account_detail($table, $field, $orig, $merge){
		//LV3 DAL
		$this->db->set($field, $merge);
		$this->db->where($field, $orig);
		$this->db->update($table);		
	}
	public function merge_account_detail($orig, $merge){
		//LV2 ctrl
		//activity_data user_id;
		//echo "login_model 499";
		$this->DBset_merge_account_detail("activity_data", "user_inhouse_id", $orig, $merge);
		//app_users user_id;
		$this->DBset_merge_account_detail("app_users", "user_id", $orig, $merge);
		//news_comment comment_user_id;
		$this->DBset_merge_account_detail("news_comment", "comment_user_id", $orig, $merge);
		//news_feedback comment_user_id;
		$this->DBset_merge_account_detail("news_feedback", "comment_user_id", $orig, $merge);
		//news_postman last_user_news_id;
		$this->DBset_merge_account_detail("news_postman", "last_user_news_id", $orig, $merge);
		//user_app_registration_history user_inhouse_id;
		$this->DBset_merge_account_detail("user_app_registration_history", "user_inhouse_id", $orig, $merge);
		//user_inhouse_data del
		$this->db->set("del", "y");
		$this->db->where("user_inhouse_id", $orig);
		$this->db->update("user_inhouse_data");
		//$this->DBset_merge_account_detail("user_inhouse_data", "user_id", $orig, $merge);
		//user_message to_user_id from_user_id
		$this->DBset_merge_account_detail("user_message", "to_user_id", $orig, $merge);
		$this->DBset_merge_account_detail("user_message", "from_user_id", $orig, $merge);
		//user_news_inbox_201209 user_id from_source_id
		$this->DBset_merge_account_detail("user_news_inbox_201209", "user_id", $orig, $merge);
		$this->DBset_merge_account_detail("user_news_inbox_201209", "from_source_id", $orig, $merge);
		//user_news_outbox_201209 user_id
		$this->DBset_merge_account_detail("user_news_outbox_201209", "user_id", $orig, $merge);
		//user_oauth user_inhouse_id
		$this->DBset_merge_account_detail("user_oauth", "user_inhouse_id", $orig, $merge);
		//user_openid user_inhouse_id
		$this->DBset_merge_account_detail("user_openid", "user_inhouse_id", $orig, $merge);
		//user_relation subject_user_id object_user_id 
		$this->DBset_merge_account_detail("user_relation", "subject_user_id", $orig, $merge);
		$this->DBset_merge_account_detail("user_relation", "object_user_id", $orig, $merge);
				
	}

	public function save_openid_account($get, $type=null){
		//LV1
		//$get={openid, }
		$identity='';
		if( strrpos($get['openid_identity'], "google")!=null ){
			$identity="google";
		}else if( strrpos($get['openid_identity'], "yahoo")!=null ){
			$identity="yahoo";
		}
			$get['identity']=$identity;
			//echo "<br/>login_model 249";
			//print_r($get);
			foreach($this->openid_para[$identity] as $key=>$val){
				$generated_data[$key]=$get[$val];				
			}
			$generated_data['identity']=$identity;
			
		$result=$this->db_set_account($generated_data, $type);
		return $result;
	}
	public function session_set_user_login($get){
		$this->native_session->set('userinfo', $get);
		$this->session_set_inhouse_info_after_login();
		$userinfo=$this->native_session->get('userinfo');
		if($userinfo['identity']=="facebook"){
			$access_token=$this->native_session->get("access_token");
			$this->load->model("facebook_model");
			$this->facebook_model->DBset_facebook_oauth($access_token);	
		}
		
	}
	public function check_user_no_apps(){
		//LV3
		$userinfo=$this->native_session->get("userinfo");
		$this->db->select("count(user_id) as counter");
		$this->db->where("user_id", $userinfo['user_inhouse_id']);
		$result=$this->db->get("app_users");
		$result=$result->result_array();
		//echo "<br/>login_mdoel 466<br/>";
		//print_r($result);
		if($result[0]['counter']>0){
			//has apps
			return 1;
		}else{
			//no apps.
			return 2;
		}	
	}
	public function DBget_friend_list_by_user_inhouse_id($user_inhouse_id, $request=false){
		//LV2 DAL	
		//request mean waiting request, false mean not show waiting list
		//true mean it show up the user who is not friend but request you as friend 	
		$user_id=mysql_real_escape_string($user_inhouse_id);
		if($request==false){
			$sql="select * from user_relation where 
				( subject_user_id='".$user_id."' or object_user_id= '".$user_id."' )";	
			$sql.=" and request=0 and block=0";
		}else{
			$sql="select * from user_relation where 
			 (	( subject_user_id='".$user_id."' ) 
				or ( object_user_id= '".$user_id."') ) ";	
			$sql.=" and block!=1";
		}
		$result=$this->db->query($sql);
		$result=$result->result_array();
		if(count($result)>0){
			return $result;
		}else{
			return null;
		}
	}
	public function DBget_app_users_by_user_id_with_app_id($user_id, $app_id){
		$sql="select * from app_users where app_id='".mysql_real_escape_string($app_id)."' ";	
		if(is_array($user_id)){
			$sql.="and ( 0 ";
			for($i=0;$i<count($user_id);$i++){
				$sql.="or user_id='".mysql_real_escape_string($user_id[$i]['user_id'])."' ";
			}
			$sql.=" )";
		}else{
			$sql.=" and user_id='".mysql_real_escape_string($user_id)."'";
		}
		$result=$this->db->query($sql);
		$result=$result->result_array();
		if(count($result)>0){
			return $result;
		}else{
			return null;
		}
	}               
	public function bll_get_friend_list_by_user_inhouse_id($user_inhouse_id, $request=false){
		//LV1 
		$friend_list=$this->DBget_friend_list_by_user_inhouse_id($user_inhouse_id, $request);
		$friend_list_id=array();
		$counter=0;
					//cut out the same id as myself
					for($i=0;$i<count($friend_list);$i++){
						if($friend_list[$i]['object_user_id']!=$user_inhouse_id){
							$friend_list_id[$counter]['user_id']=$friend_list[$i]['object_user_id'];
							$friend_list_id[$counter]['request']=$friend_list[$i]['request'];
							$counter++;
						}
						if($friend_list[$i]['subject_user_id']!=$user_inhouse_id){
							$friend_list_id[$counter]['user_id']=$friend_list[$i]['subject_user_id'];
							$friend_list_id[$counter]['request']=$friend_list[$i]['request'];
							$counter++;
						}
					}
					$counter=0;
					$result=array();
					for($i=0;$i<count($friend_list_id);$i++){
						$savelog=true;
						for($i2=0;$i2<count($friend_list_id);$i2++){
							if( ($i!=$i2)&&($friend_list_id[$i]==$friend_list_id[$i2])&&($friend_list_id[$i]!='_') ){
								$friend_list_id[$i2]="_";
							}							
						}
						if($friend_list_id[$i]!='_'){
							$result[$counter]=$friend_list_id[$i];
							$counter++;
						}
					}
					//echo "<br/>login model 633 ";
					//print_r($result);
		return $result;
	}
	public function DBget_app_users_data_by_user_inhouse_id($data){
		//echo "<br/>activity model 602 ".count($data);
		//print_r($data);
		if( is_array($data) ){
			//unset($data['multiple_search']);	
			//echo "<br/>activity model 608 ".count($data);
			//print_r($data);
			for($i=0;$i<count($data);$i++){
				if(isset($data[$i]['user_id']))
					$this->db->or_where("user_id", $data[$i]['user_id']);
			}	
		}else{
			$this->db->where("user_id", $data);
		}
		$result=$this->db->get("app_users_data");
		$result=$result->result_array();
		if(count($result)>0){
			
				return $result;
		
		}else{
			return null;
		}
	}
                	
	public function DBget_app_users_data_by_app_users_data_id($data){
		//echo "<br/>login model 617 ".count($data);
		//print_r($data);
		if( is_array($data)){
			//unset($data['multiple_search']);	
		//	echo "<br/>activity model 608 ".count($data);
			//print_r($data);
			for($i=0;$i<count($data);$i++){
				$this->db->or_where("app_users_data_id", $data[$i]['app_users_data_id']);
			}	
		}else{
			$this->db->where("app_users_data_id", $data);
		}
		$result=$this->db->get("app_users_data");
		$result=$result->result_array();
		//echo "<br/> login model 633 ";
		//print_r($result);
		if(count($result)>0){
			if(is_array($data)){
				return $result;
			}else{
				return $result[0];
			}
		}else{
			return null;
		}
	}
	public function bll_get_social_permission_by_user_inhouse_data($user_inhouse_data){
		$permission=$user_inhouse_data['social_media_publication'];
		
		if($permission!=null){
			$permission=preg_split('/,/', $permission);
		}
		//template use 0 as permission
		//echo $permission[0];
		return $permission;
	}
	public function DBget_app_users_by_user_id($data){
		//echo "<br/>login model 602 ".count($data);
		if( is_array($data) ){
			//unset($data['multiple_search']);	
			//echo "<br/>activity model 608 ".count($data);
			//print_r($data);
			for($i=0;$i<count($data);$i++){
				if(isset($dat[$i]['user_id']))
					$this->db->or_where("user_id", $data[$i]['user_id']);
			}	
		}else{
			//echo " ".($data);
			$this->db->where("user_id", (int)$data);
		}
		$result=$this->db->get("app_users");
		//echo "<br/>login model 649";
		$result=$result->result_array();
		if(count($result)>0){
			
				return $result;
		}else{
			return null;
		}
	}
	
	public function DBget_app_users_data_by_bluetooth_device_id($data){
		//DAL
		//$data=array(0=>array("bluetooth_device_id"=>"...")
		//echo "<br/>activity model 602 ".count($data);
		//print_r($data);
		if( is_array($data) ){
			//unset($data['multiple_search']);	
			//echo "<br/>activity model 608 ".count($data);
			//print_r($data);
			for($i=0;$i<count($data);$i++){
				$this->db->or_where("bluetooth_device_uuid", $data[$i]['bluetooth_device_id']);
			}	
		}else{
			$this->db->where("bluetooth_device_uuid", $data);
		}
		$result=$this->db->get("app_users_data");
		$result=$result->result_array();
		if(count($result)>0){
			if(is_array($data)){
				return $result;
			}else{
				return $result[0];
			}
		}else{
			return null;
		}
	}
	public function DBget_friend_by_user_inhouse_id($user_inhouse_id_1, $user_inhouse_id_2){
		//DAL	
		//sensitive data, should not been cache!
		$this->init_model->sensitive_session[]="DBget_friend_by_user_inhouse_id($user_inhouse_id_1, $user_inhouse_id_2)";
		if(($this->native_session->get("DBget_friend_by_user_inhouse_id($user_inhouse_id_1, $user_inhouse_id_2)")==null)){
			$sql="select * from user_relation 
				where  (subject_user_id='".mysql_real_escape_string($user_inhouse_id_1)."' and object_user_id='".mysql_real_escape_string($user_inhouse_id_2)."') and block=0 and request=0";
			$result=$this->db->query($sql);				
			$result=$result->result_array();
			if(count($result)>0){
				$sql="select * from user_relation 
					where  (subject_user_id='".mysql_real_escape_string($user_inhouse_id_2)."' and object_user_id='".mysql_real_escape_string($user_inhouse_id_1)."') and block=0 and request=0";
				$result=$this->db->query($sql);				
				$result=$result->result_array();
				if(count($result)>0){
					$this->native_session->set("DBget_friend_by_user_inhouse_id($user_inhouse_id_1, $user_inhouse_id_2)", $result);
					return $result;
				}else{
					return null;	
				}
			}else{
				return null;
			}
		}else{
			return $this->native_session->get("DBget_friend_by_user_inhouse_id($user_inhouse_id_1, $user_inhouse_id_2)");
		}
		/*or (subject_user_id='".mysql_real_escape_string($user_inhouse_id_2)."' and object_user_id='".mysql_real_escape_string($user_inhouse_id_1)."') )
			and block=0 and request=0
			";
		if(count($result)>0){
			return $result; 
		}else{
			return null;
		}*/
	}
	public function check_profile_activity_privacy($target_activity_id){
		//BLL LV1
		$userinfo=$this->activity_model->DBget_activity_data_by_activity_id($target_activity_id);
		//echo "<br/> login_model 602 ";
		//echo $userinfo['user_inhouse_id'].", ".$userinfo['privacy'];
		return $this->check_default_privacy($userinfo, $userinfo['privacy']);
	}
	public function check_profile_apps_privacy($target_app_id, $user_inhouse_id){
		//BLL LV1
		$userinfo=$this->DBget_user_inhouse_info_by_user_inhouse_id($user_inhouse_id);
		$target_userinfo=$this->activity_model->DBget_apps_user($target_app_id, $userinfo);
		//echo "<br/>login_model 604";
		//echo $target_userinfo['user_id']." ".$target_userinfo['default_privacy'];
		return $this->check_default_privacy($target_userinfo, $target_userinfo['default_privacy']);
	}
	public function check_profile_view_privacy($target_user_inhouse_id){
		//BLL LV1
		$target_userinfo=$this->DBget_user_inhouse_info_by_user_inhouse_id($target_user_inhouse_id);
		//echo "login 824 check profile view privacy: ".$target_userinfo['default_privacy'];
		return $this->check_default_privacy($target_userinfo, $target_userinfo['default_privacy']);
		
	}
	public function check_default_privacy($target_user_inhouse_data, $target_privacy, $login_userinfo=null){
		//BLL LV2
		//echo "<br/>login_model 641  ".$target_privacy;
		if($login_userinfo==null){
			$login_userinfo=$this->native_session->get("userinfo");
		}
		$target_user_inhouse_id=(isset($target_user_inhouse_data['user_inhouse_id']))? $target_user_inhouse_data['user_inhouse_id'] : $target_user_inhouse_data['user_id'];
		if($target_privacy=="default"){
			//echo "login model 835 default";
			return $this->check_profile_view_privacy($target_user_inhouse_id);
		}else if( ($target_privacy=="public")||($login_userinfo['user_inhouse_id']==$target_user_inhouse_id) ){
			//public account or self 
			//echo "<br/>login_model 627 public";
			//echo "login model 840 ";
			return true;
		}else if($target_privacy=="friends_only"){
			//friend_only
			//check if not login
			//echo "<br/>login modle 635 friends only";
			if($login_userinfo==null){
				//not allow access if default privacy	
				//echo "<br/> login model 637  friends only no logined userinfo";
				return false;
				//check self first first
			}else{
				//check if they are friend or not...
				$isfriend=$this->DBget_friend_by_user_inhouse_id($target_user_inhouse_id, $login_userinfo['user_inhouse_id']);
				//echo "<br/> login model 645 ".$isfriend;
				//print_r($isfriend);
				if($isfriend!=null) return true; else return false;
			}
		}else{
			//echo "<br/> login model 650  self only no logined userinfo";
			return false;
			//self_only and login_userinfo does not match himself
		}
		
	}
	public function DBget_oauth_by_user_inhouse_id($user_inhouse_id, $oauth_server_name){
		//LV3	
		$this->db->where("user_inhouse_id", $user_inhouse_id);
		$this->db->where("oauth_server_name", $oauth_server_name);
		$this->db->order_by("session_time", "desc");
		$result=$this->db->get("user_oauth");
		$result=$result->result_array();
		//echo "<br/> login_model 796 ".count($result);
		if(count($result)>0){
			if($result[0]['oauth_server_name']=="facebook"){
				$this->load->model("facebook_model");
				$checker=$this->facebook_model->FB_check_permission_by_token($result[0]['oauth_server_id']);
				if($checker==true){
					return $result[0]; 
				}else{
					return null;
				}
			}
		}else{
			return null;
		}
	}
	public function DBget_user_inhouse_info_by_user_inhouse_id($data){
		//echo $data=$user_inhouse_id;
		/*or $data=array(
			"multiple_search"="1"
		); */
		if(is_array($data)){
			for($i=0;$i<count($data);$i++){
				if(isset($data[$i]['user_inhouse_id']))
					$this->db->or_where('user_inhouse_id', $data[$i]['user_inhouse_id']);
			}
			//$this->db->where("del", "n");
			$query=$this->db->get("user_inhouse_data");
			$result=$query->result_array(); 
			if(count($result)>0){
				return $result;
			}else{
				return null;
			}
		}else{
			$user_inhouse_id=$data;
			$this->init_model->sensitive_session[]="DBget_user_inhouse_info_by_user_inhouse_id(".$user_inhouse_id.")";
			if($this->native_session->get("DBget_user_inhouse_info_by_user_inhouse_id(".$user_inhouse_id.")")==null){
				//echo "<br/>login model 672 ";
				$this->db->where('user_inhouse_id', $user_inhouse_id);
				$query=$this->db->get("user_inhouse_data");
				$result=$query->result_array(); 
				if(count($result)>0){
					$this->native_session->set("DBget_user_inhouse_info_by_user_inhouse_id(".$user_inhouse_id.")", $result[0]);
					return $result[0];
				}else{
					return null;
				}
			}else{
				return $this->native_session->get("DBget_user_inhouse_info_by_user_inhouse_id(".$user_inhouse_id.")");
			}
		}
	}
	public function session_set_inhouse_info_after_login(){
		$userinfo=$this->native_session->get('userinfo');
		$user_inhouse_id=$userinfo['user_inhouse_id'];
		$result=$this->DBget_user_inhouse_info_by_user_inhouse_id($user_inhouse_id);
		$this->native_session->set('inhouse_info', $result);
	}
}
?>