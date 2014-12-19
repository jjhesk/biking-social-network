<?php

class Mod_facebook_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->model("init_model");
		$this->load->library("native_session");
		//$this->output->enable_profiler(true);	//debug function
	
		$config['appId']=$this->config->item("fb_app_id");
		$config['secret']=$this->config->item("fb_app_secret");	
		$this->load->library("facebook", $config);
		//ini_set("upload_max_filesize", "200M");
		
	}	
	public function FBget_User($access_token=""){
		if($access_token!=""){
			$this->facebook->setAccessToken($access_token);
			$openid=$this->facebook->getUser();
		}else{
			$openid=$this->facebook->getUser();
		
		}
		return $openid;
	}
	public function FB_check_permission_by_token($access_token){
		$result=file_get_contents("https://graph.facebook.com/me/permissions?access_token=".$access_token);
		$returner=true;
		//echo "<br/>facebook_model 32 "."https://graph.facebook.com/me/permissions?access_token=".$access_token;
		$result=json_decode($result, true);
		//print_r($result);
		if( (!isset($result['data'][0]['photo_upload']))||(!isset($result['data'][0]['publish_stream']))||(!isset($result['data'][0]['publish_actions'])) ){
			$returner=false;
		}
		return $returner;
	}
	public function FBget_friendlist($access_token=null){
		if($access_token!=null){
			$this->facebook->setAccessToken($access_token);
			//$fql="SELECT uid2 FROM friend WHERE uid1 = me()";
		}
		$params = array(
	        			'method' => 'fql.query',
	        			'query' => "SELECT uid2 FROM friend WHERE uid1 = me()",
	  			  	);
		 $friend_list = $this->facebook->api($params);
		return $friend_list;	
	}
	public function curls($attachment, $link){
		//DAL
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $link);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output 
		$result = curl_exec($ch);
		//echo "<br/>";
		curl_close ($ch);
		return $result;
		//if($result!=''){ return true; }else{ return false; }
		
		//return $this->facebook->api($link, 'POST', $attachment);	
	}
	public function upload_facebook_activity($data){
		//LV1
		//$data=array("userinfo"=>$_SESSION['userinfo'], "image"=>$_FILES['photo'], "comment"=>"comment")
		//echo $data['image']['tmp_name'];
		//$data can be:
			/*
			'user_inhouse_id' => $this->post('user_inhouse_id'),
			'app_id' => $this->post('app_id'),
			'password' => $this->post('password'),
			'title' => $this->post('title'),
			'description' => $this->post('description'),
			'last_updated' => date( 'Y-m-d H:i:s'),
			'has_ended' => $this->post('has_ended'),
			'mode' => $this->post('mode'),
			'avg_speed' => $this->post('avg_speed'),
			'avg_temperature' => $this->post('avg_temperature'),
			'avg_heart_rate' => $this->post('avg_heart_rate'),
			'total_distance' => $this->post('total_distance'),
			'elapse_time' => $this->post('elapse_time'),
			'elapse_time_sec' => $this->post('elapse_time_sec'),
			'max_speed' => $this->post('max_speed'),
			'max_heart_rate' => $this->post('max_heart_rate'),
			'total_calories' => $this->post('total_calories'),
			'coordinates_json' => $this->post('coordinates_json'),
			'custom_data_json' => $this->post('custom_data_json'),
			'prev_activity_id' => $last_activity_id,
			'next_activity_id' => NULL
			'image'=>$_POST, will read 'image'
			'token'=> facebook access token
			"userinfo"=>$_SESSION['userinfo'],
			"comment"=>"comment" 
			 * );*/
			/*if(isset($data['userinfo']))
				$session=$data['userinfo'];
			else
				$session=$this->native_session->get("userinfo"); 	*/
			//echo "activity_model 22 <br/>";
			//echo $this->facebook->getAccessToken();
			//echo "<br/>facebook_model 23 ".$data['image']['tmp_name'];
			//$this->facebook->setAccessToken($session['access_token']);
			//echo "<br/>facebook_model 57 ".$data['token'];
			if(isset($data['token']))
			if( ($data['token']!='')&&($data['token']!=null) ){
				$this->facebook->setAccessToken($data['token']);
			}
			$message='';
			if(isset($data['comment'])) $message.=$data['comment'];
			if(isset($data['description'])) $message.=$data['description'];
			echo "<br/>facebook_model 62 ".$message;
			
			$openid=$this->facebook->getUser();
			if(isset($data['image']) && ($data['image']!="")){
				$this->facebook->setFileUploadSupport(true);
				$img = $data['image']['tmp_name'];
				
				//echo "<br/>facebook_model 28:1 ".$img.":".$data['comment']."<br/>";
			    $content=array( 	
			    	'source'=>'@'.$img,
                	'message'=>$message
                );
            	//echo "<br/> facebook model 77 ";
				//print_r($content);
				$photo = $this->facebook->api('/'.$openid.'/photos', 'POST', $content);
			}else{
				$content=array( 	
                	'message'=>$message
                );
                //echo "<br/> facebook model 84 ";
				//print_r($content);
				$photo = $this->facebook->api('/'.$openid.'/feed', 'POST', $content);
			}
			//$openid=$data['userinfo']['openid'];
			/*echo "<br/> facebook model 83 ";
			print_r($content);
			
			$photo = $this->facebook->api('/'.$openid.'/photos', 'POST', $content);*/
			//echo "<br/> facebook model 85 ".$photo;
			return $photo;
	}
public function FBget_user_inhouse_data($access_token){
		//echo "<br/>mod_facebook_model 146 ".$access_token;
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
		//echo "<br/>mod_facebooko_model 158 ";
		//print_r($ret_obj);
		return $ret_obj;
}
	
	public function get_facebook_login_url($returnurl){
		//LV2
					//then load login page for the user login, redirect to save page
					$params=$this->config->item('fb_app_perms');	
					$params=array(
						'scope'=>$params,
						'redirect_uri'=>$returnurl,
						'display'=>'page'
					);
					$facebook_oauth_dialog_link=$this->facebook->getLoginUrl($params, $returnurl);
					return $facebook_oauth_dialog_link;
	}
	/*
		https://www.facebook.com/login.php?api_key=235356939890421
	 	&display=popup&fbconnect=1
		&cancel_url=http%3A%2F%2Fwww.imobilepet.com%2Findex.php
		&next=http%3A%2F%2Fwww.imobilepet.com%2Findex.php
		&return_session=1&session_version=3&v=1.0
	    &req_perms=publish_stream%2Cread_stream%2Cemail%2Cuser_photos
	 * 
		https://www.facebook.com/login.php?api_key=235356939890421&display=popup&fbconnect=1&cancel_url=http%3A%2F%2Fwww.imobilepet.com%2Findex.php&next=http%3A%2F%2Fwww.imobilepet.com%2Findex.php&return_session=1&session_version=3&v=1.0&req_perms=publish_stream%2Cread_stream%2Cemail%2Cuser_photos
	
	 	https://www.facebook.com/login.php?api_key=513818161967291
	 *  &display=page&fbconnect=1
	 *  &next=http://fenix.it.imusictech.com/2012_fansliving/webportal/index.php/login/facebook_login
	 *  &return_session=1&session_version=3&v=1.0
	 *  &req_perms=publish_stream,read_stream,email,user_photos,read_friendlists
	 * 
	 * 
	 * 
	 */ 
	
	
	public function bll_facebook_login_variable($type=""){
		$data=array("fb_app_id"=>$this->config->item('fb_app_id'), 
			"fb_app_secret"=>$this->config->item('fb_app_secret'),
			"fb_app_perms"=>$this->config->item('fb_app_perms'),
			"fb_app_return_link"=>site_url()."/login/facebook_login", 
			"cancel_url"=>site_url(),
			"ismerge"=>false
			
			);
			
		if($type=="m"){
			$this->native_session->set("mobile", "true");
		}
		return $data;
	}	
	
	public function FBset_access_token($access_token){
		//LV2 use in login model
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
		$this->native_session->set("access_token", $access_token);							
		return $ret_obj;
	}
	
	public function get_redirect_url($url){
	    //LV2	
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
	
	


	private function bll_post_activity_facebook_from_mobile($access_token, $photo=null){
		//LV3
		$userinfo['userinfo']['access_token']=$access_token;
		$this->facebook->setAccessToken($access_token);
		$userinfo['userinfo']['openid']=$this->facebook->getUser();
		$userinfo['comment']="";
		if($photo!=null){
			$photo=base64_decode($photo);
			//echo "<br/>facebook_model 165<br/>photo length:";
			//echo strlen($photo);
			$filename=rand(10000000, 99999999);
			$dest="upload/".$filename.".jpg";
			file_put_contents($dest, $photo);
			$userinfo['image']['tmp_name']=$dest;
		}
		return $userinfo;
	}
	
	public function FBget_access_token_by_code($get){
		//echo "model facebook_model 396 https://graph.facebook.com/oauth/access_token?client_id=".$this->config->item('fb_app_id')."&redirect_uri=".site_url()."/login/facebook_login&client_secret=".$this->config->item('fb_app_secret')."&code=".$get['code'];
		if( (isset($get['oauth_server_id']))&&($get['oauth_server_id']!="") ){
			$token_content=file_get_contents("https://graph.facebook.com/me?access_token=".$get['oauth_server_id']);
			if(!isset($token['error'])){
				return $get['oauth_server_id'];
			}else{
				echo "<br/> mod facebook model 336 fb exchange token";
				$link="https://graph.facebook.com/oauth/access_token";
				$attachment=array(
					"client_id"=>$this->config->item("fb_app_id"),
					"client_secret"=>$this->config->item("fb_app_secret"),
					"grant_type"=>"fb_exchange_token",
					"fb_exchange_token"=>$get['oauth_server_id'],
				);
			}
		}else{
			//get is not worked anymore...
			//$token_content=file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=".$this->config->item('fb_app_id')."&redirect_uri=".site_url()."login/facebook_login&client_secret=".$this->config->item('fb_app_secret')."&code=".$get['code']);
			//use form post instead...
			//echo "<br/>mod facebook mod 308 ";
			$link="https://graph.facebook.com/oauth/access_token";
			$attachment=array(
				"client_id"=>$this->config->item("fb_app_id"),
				"client_secret"=>$this->config->item("fb_app_secret"),
				"code"=>$get['code'],
				"redirect_uri"=>site_url()."login/facebook_login",
			);
			//print_r($attachment);
			
		}	
			$token_content=str_replace("access_token=", "", $this->curls($attachment, $link));	
			echo "<br/>mod facebook model 304 ".preg_match('/error/', $token_content);
			/*print_r($token_content);
			if(preg_match('/error/', $token_content)>0){
				echo "<br/>facebook 315 had error ".$token_content['error'];
			}else{
				echo "<br/>facebook 313 no error had token ";
			}*/
			if(preg_match('/error/', $token_content)==0){
				//get the token successfully
				//echo "<br/>facebook 282 get token success";
				$token_content=preg_split('/&/', $token_content);
				$token=$token_content[0];
				$session_time=str_replace('expires=', '', $token_content[1]);
				$this->native_session->set("token", $token);
				
				//echo "<br/>facebook 288 ".$token;
				
				//echo "<br/>facebook_model 219 ".$session_time;
				//print_r($get);
				$this->native_session->set("session_time", $session_time);
				//$this->native_session->set("code", $get['code']);
				return $token;
			}else {
				echo "<br/>mod facebook model 345 cannot get the token";
				print_r($token_content);
			}
			/*
			 * 
			 
			 */
			//$token=str_replace("access_token=", "", $token_content);
			//file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=".$this->config->item('fb_app_id')."&redirect_uri=".site_url()."login/facebook_login&client_secret=".$this->config->item('fb_app_secret')."&code=".$get['code']);
			
			
		
		//header( "location: https://graph.facebook.com/oauth/access_token?client_id=".$this->config->item('fb_app_id')."&redirect_uri=".site_url()."/login/facebook_login&client_secret=".$this->config->item('fb_app_secret')."&code=".$get['code']);
	}
	
	public function bll_post_activity_facebook($access_token){
			$userinfo['userinfo']=$this->native_session->get("userinfo");
			if($this->native_session->get('image')!=null){
				$userinfo['image']['tmp_name']=$this->native_session->get('image');
			}
			//$this->init_model->urlwriting("/cache/".$this->native_session->get('image'), false);
			$this->native_session->set("access_token", $access_token);
			$userinfo['userinfo']['access_token']=$access_token;
			
			$userinfo['userinfo']['openid']=$this->facebook->getUser();
			$userinfo['comment']=$this->native_session->get("comment");
		
		return $userinfo;
	}
	public function getCurrentUrl() {
	    if (isset($_SERVER['HTTPS']) &&
	        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
	        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
	        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
	      $protocol = 'https://';
	    }
	    else {
	      $protocol = 'http://';
	    }
	    $currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	    $parts = parse_url($currentUrl);
	
	    $query = '';
	    if (!empty($parts['query'])) {
	      // drop known fb params
	      $params = explode('&', $parts['query']);
	      $retained_params = array();
	      foreach ($params as $param) {
	        if ($this->shouldRetainParam($param)) {
	          $retained_params[] = $param;
	        }
	      }
	
	      if (!empty($retained_params)) {
	        $query = '?'.implode($retained_params, '&');
	      }
	    }
	
	    // use port if non default
	    $port =
	      isset($parts['port']) &&
	      (($protocol === 'http://' && $parts['port'] !== 80) ||
	       ($protocol === 'https://' && $parts['port'] !== 443))
	      ? ':' . $parts['port'] : '';
	
	    // rebuild
	    return $protocol . $parts['host'] . $port . $parts['path'] . $query;
  	}
	public function FBget_logout_url($current_url=null){
		if( ($current_url!=null) ){
			$params['next']=$current_url;
		}else{
			$params['next']=$this->getCurrentUrl();
		}
		//echo "<br/>base_facebook 568 ".$next;
		
		//$userinfo['userinfo']=$this->native_session->get("userinfo");
		//$params['access_token']=$userinfo['userinfo']['access_token'];
		$params['access_token']=$this->native_session->get("access_token");
		$url=$this->facebook->getLogoutUrl($params);
		return $url;
	}
	
	public function get_photo_from_facebook($id){
		$params = array(
	        			'method' => 'fql.query',
	        			'query' => "SELECT src_small, src_big, images FROM photo WHERE object_id=".$id,
	  			  	);
	 	$imageinfo = $this->facebook->api($params);
		//print_r($imageinfo);
		return $imageinfo[0];
	}
	public function get_friendlist_from_facebook(){
		$params = array(
	        			'method' => 'fql.query',
	        			'query' => "SELECT uid2 FROM friend WHERE uid1 = me()",
	  			  	);
	 	$friendlist = $this->facebook->api($params);
		
		$query='select uid, name, first_name, middle_name, last_name, sex, locale, pic_small_with_logo, pic_big_with_logo, pic_square_with_logo, pic_with_logo, username
				from user where ';
		foreach($friendlist as $val){
			$query.='uid='.$val['uid2'].' or ';
		}
		$query=substr($query, 0, strlen($query)-4);
		
		$params=array(
			'method'=>'fql.query',
			'query'=>$query
		);
		$friendlist = $this->facebook->api($params);
		return $friendlist;
	}
}
?>