<?php


class Facebook_model extends CI_Model {
	//permission : https://www.facebook.com/dialog/permissions.request?_path=permissions.request&app_id=513818161967291&redirect_uri=http%3A%2F%2Fwww.fansliving.com%2Findex.php%2Flogin%2Ffacebook_login&display=page&response_type=code&state=b55265d69b0009862c1cc6ca13f163ff&perms=publish_stream%2Cread_stream%2Cemail%2Cuser_photos%2Cread_friendlists&fbconnect=1&from_login=1&client_id=513818161967291
	public function __construct(){
		parent::__construct();
		$this->load->model("init_model");
		$this->load->model("activity_model");
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
	/*public function fb_set_facebook_open_graph_object($data){
		//LV2 DAL 
			$data=array(
				"description",
				"title",
				"image",
				"access_token",
				"link",
			);
			$attachment=array(
				"access_token"=>$data['access_token'], 
				"name"=>$activity_data['title'], 	
				"link"=>site_url()."/portal/open_graph_object/".$activity_id,
				'caption' => '',
				'description' =>$description,
				"picture"=>$image
			);
			//echo "<br/>facebook model 45 ";
			//print_r($attachment);
			$result=$this->curls($attachment, $link);
			return $result;
	}*/
	public function upload_facebook_open_graph_object_by_activity($activity_id, $access_token){
		//LV1 ctrl level
		//echo "<br/>facebook model 64 upload_facebook_open_graph_object_by_activity";
		$user_fbid=$this->facebook_model->FBget_User($access_token);	
		$activity_data=$this->activity_model->DBget_activity_data_by_activity_id($activity_id);	
		if($activity_data!=null){
			$app_data=$this->activity_model->DBget_apps_data_by_apps_id($activity_data['app_id']);
			$image=base_url()."/images/colorbox/fansliving_32x32.png";
			if($app_data['apps_icon']!=""){
				//$image=base_url().$app_data['apps_icon'];
				$image=$app_data['apps_icon'];
			}
			$link='https://graph.facebook.com/'.$user_fbid.'/feed';
			
			//echo "<br/>facebook model 81 ";
			//print_r($activity_data);
			$description="";
			if( (isset($_POST['description']))&&($_POST['description']!=null) ){
				$description=$_POST['description'];
			}else if($activity_data['description']!=''){
				$description=$activity_data['description'];
			}
			
			$attachment=array(
				"access_token"=>$access_token, 
				"name"=>$activity_data['title'], 	
				"link"=>site_url()."/portal/open_graph_object/".$activity_id,
				'caption' => '',
				'description' =>$description,
				"picture"=>$image
			);
			//echo "<br/>facebook model 45 ";
			//print_r($attachment);
			$result=$this->curls($attachment, $link);
		}else{
			echo "<br/> facebook mdoel 43 no activity data found";
			return null;
		}
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
	public function api_set_comment($data){
		//$data=array("userinfo", "message", "post_id" );
		$this->facebook->setAccessToken($data['userinfo']['access_token']);
		$this->facebook->setFileUploadSupport(true);
				$content=array( 	
                	'message'=>$data['message']
                );
                //echo "<br/> facebook model 84 ";
				//print_r($content);
				$photo = $this->facebook->api('/'.$data['post_id'].'/comments', 'POST', $content);
		
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
			if(!isset($data['userinfo']['access_token'])) {
				//echo "<br/>facebook_model 139 no token";
				$data['access_token']=$this->native_session->get("token");	
			}
			if( ($data['userinfo']['access_token']!='')&&($data['userinfo']['access_token']!=null) ){
				//echo "<br/>facebook_model 143 had token";
				$this->facebook->setAccessToken($data['userinfo']['access_token']);
			}
			
			
			$message='';
			if(isset($data['comment'])) $message.=$data['comment'];
			if(isset($data['description'])) $message.=$data['description'];
			//echo "<br/>facebook_model 62 ".$message;
			
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
	
	public function DBset_facebook_oauth($access_token, $overwrite=true){
		//LV3
		//require native_session userinfo 
		$userinfo=$this->native_session->get("userinfo");
		$check=$this->DBget_facebook_oauth_by_oauth_server_id($access_token, $userinfo['user_inhouse_id']);
		if(count($check)==0){
			$this->db->set('oauth_server_id', $access_token);
			$this->db->set('oauth_server_name', "facebook");
			$this->db->set('user_inhouse_id', $userinfo['user_inhouse_id']);
			$this->db->set('oauth_update_time', "NOW()", false);
			
			$this->db->set('session_time', date('Y-m-d h:i:s', strtotime("now")+(int)$this->native_session->get('session_time')));
			$this->db->set('code', $this->native_session->get('code'));
			$this->db->insert('user_oauth');
			//echo "<br/>facebook_model 70 insert oauth success<br/>";
			
		}else if($overwrite==true){
			$this->db->set('oauth_server_id', $access_token);
			$this->db->set('oauth_update_time', "NOW()", false);
			$this->db->where('user_inhouse_id', $userinfo['user_inhouse_id']);
			$this->db->where('oauth_server_name', "facebook");
			$this->db->set('session_time', date('Y-m-d h:i:s', strtotime("now")+(int)$this->native_session->get('session_time')));
			$this->db->set('code', $this->native_session->get('code'));
			$this->db->update('user_oauth');	
			//echo "<br/>facebook_model 78 update oauth success<br/>";
		}
		
	}
	public function bll_facebook_login_variable($type=""){
		$data=array("fb_app_id"=>$this->config->item('fb_app_id'), 
			"fb_app_secret"=>$this->config->item('fb_app_secret'),
			"fb_app_perms"=>$this->config->item('fb_app_perms'),
			"fb_app_return_link"=>site_url()."login/facebook_login", 
			"cancel_url"=>site_url(),
			"ismerge"=>false
			
			);
			
		if($type=="m"){
			$this->native_session->set("mobile", "true");
		}
		return $data;
	}	
	public function DBget_facebook_oauth_by_oauth_server_id($oauth_server_id, $user_inhouse_id=''){
		//LV3
		if($user_inhouse_id==''){
			$this->db->where("oauth_server_id", $oauth_server_id);
		}else{
			$this->db->where("user_inhouse_id", $user_inhouse_id);
		}	
		$this->db->where("oauth_server_name", "facebook");
		
		$query=$this->db->get("user_oauth");
		return $query->result_array(); 
	}
	
	public function ctrl_FBset_photo($access_token, $file){
		//echo "<br/> facebook model 269 ".$access_token." ".strlen($file);
		$data=$this->bll_post_activity_facebook_from_mobile($access_token, $file);
		//echo "<br/> facebook model 273 ";
		//print_r($data);
		$result=$this->upload_facebook_activity($data);
		$facebook_id=$result['id'];
		$result=$this->get_photo_from_facebook($result['id']);
		$result['id']=$facebook_id;
		//echo "<br/> facebook model 271 ";
		//print_r($result);
		return $result;
	}
	
	public function FBset_mobile_upload($activity_id, $photo=null){
		//LV2
		//$activity_id= acitivty_data's id
		//$photo=base64encoded image [string]
		//====get activity data by activity id===
		//return "run facebook_model 107";
		//echo "<br/>facebook_model 107<br/>photo length: ";
		//echo strlen($photo);
		
		$this->db->where("activity_id", $activity_id);
		$activity_data=$this->db->get("activity_data");
		$activity_data=$activity_data->result_array(); 
		//============
		if(count($activity_data)>0){
			//====get user oauth data by user_inhouse_id===
			$user_inhouse_id=$activity_data[0]['user_inhouse_id'];
			$this->db->where("user_inhouse_id", $user_inhouse_id);
			$this->db->where("oauth_server_name", "facebook");
			$user_oauth=$this->db->get("user_oauth");
			$user_oauth=$user_oauth->result_array(); 
			//==================
			if(count($user_oauth)>0){
				//===upload the photo to facebook
				$access_token=$user_oauth[0]['oauth_server_id'];
				//echo "<br/>facebook_model 125<br/>";
				//echo $access_token;
				$data=$this->bll_post_activity_facebook_from_mobile($access_token, $photo);
				//echo "<br/>facebook_model 120 before fb submit<br/>";
				$data['description']=$activity_data[0]['description'];
				$result=$this->upload_facebook_activity($data);
				
				//echo "<br/>facebook_model 122 after fb submit<br/>";
				//print_r($result);
				//====================
				if($result!=''){
					$imageinfo=$this->get_photo_from_facebook($result['id']);
					//echo "<br/>facebook_model 114<br/>";
					//print_r($imageinfo);
					$userinfo['activity_id']=$activity_id;
					$userinfo['thumb_url']=$imageinfo['src_small'];
					$userinfo['full_url']=$imageinfo['src_big'];
					$userinfo['original_url']=$imageinfo['images'][0]['source'];
					$userinfo['userinfo']['user_inhouse_id']=$user_inhouse_id;
					$userinfo['comment']='';
					$this->activity_model->db_set_activity($userinfo);
					unlink($data['image']['tmp_name']);
					//echo $result=$this->db->insert_id();
					return $result;
				}else{
					//"This facebook token may be expired. "
					return -1;
				}
			}else{
				//"This activity's owner does not have facebook account."	
				return -2;
			}
		}else{
			//"No activity data has been found."
			return -3;
		}
					
		/*$this->db->set("activity_id", $activity_id);
		$this->db->set("activity_id", $activity_id);
		$this->db->insert("", );*/
	}
	public function ctrl_save_facebook_login_after_login(){
			//ctrl
			$this->load->model("login_model");
			
			if(isset($_GET['code']))
	    	if($_GET['code']!=''){
				$token=$this->FBget_access_token_by_code($_GET);
				if($this->FB_check_permission_by_token($token)==false){
					//echo "<br/>facebook model 337 ".$this->FB_check_permission_by_token($token); 
					return null;
				}
				//$this->native_session->set("access_token", $token);
	    		//print_r($result);
				//print_r($_GET);
	    		$result=$this->login_model->save_facebook_account($token);
				$this->login_model->session_set_user_login($result[0]);		
				//echo "<br/>facebook_model 210 ".$token;
				$this->DBset_facebook_oauth($token);
				return $result;
			}else{
				echo "facebook_model 213 cnanot get code.";
				return null;				
				//header("location: ".site_url());
			}
	}
	public function ctrl_upload_image_to_facebook(){
		//ctrl
		$access_token=$this->facebook->getAccessToken();
			if(($access_token)!=''){
				$this->DBset_facebook_oauth($access_token);
				$userinfo=$this->bll_post_activity_facebook($access_token);
				if( ($result=$this->upload_facebook_activity($userinfo))!=''){
					if($this->native_session->get('upload_image')!=null){
						$imageinfo=$this->get_photo_from_facebook($result['id']);
						//print_r($imageinfo);
						$userinfo['thumb_url']=$imageinfo['src_small'];
						$userinfo['full_url']=$imageinfo['src_big'];
						$userinfo['original_url']=$imageinfo['images'][0]['source'];
						unlink($this->native_session->get('upload_image'));
					}	
					$this->activity_model->db_set_activity($userinfo);
					$this->native_session->delete("upload_image");
					$this->native_session->delete("comment");
					
					echo "facebook_model 219 upload facebook success.";
				}else{
					echo "facebook_model 221 upload facebook unsuccess.";
				}
				echo "facebook_model 223 upload facebook access token";
				
			}else{
				echo "facebook_model 226 cannot get the facebook access token";
				
			}
		
	}

	public function ctrl_merge_facebook_account($get){
			//ctrl
			//echo "<br/>facebook_model 200 merge facebook account";
			if(isset($get['code']))
	    	if($get['code']!=''){
				$token=$this->FBget_access_token_by_code($get);
			}
			$type="merge";
			$result=$this->login_model->save_facebook_account($token, $type);
			$this->native_session->delete("merge");
	
	}
	
	
	public function FBget_access_token_by_code($get){
		//echo "model facebook_model 396 https://graph.facebook.com/oauth/access_token?client_id=".$this->config->item('fb_app_id')."&redirect_uri=".site_url()."/login/facebook_login&client_secret=".$this->config->item('fb_app_secret')."&code=".$get['code'];
		if( (isset($get['oauth_server_id']))&&($get['oauth_server_id']!="") ){
			$token_content=file_get_contents("https://graph.facebook.com/me?access_token=".$get['oauth_server_id']);
			if(!isset($token['error'])){
				return $get['oauth_server_id'];
			}
		}	
			$token_content=file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=".$this->config->item('fb_app_id')."&redirect_uri=".site_url()."login/facebook_login&client_secret=".$this->config->item('fb_app_secret')."&code=".$get['code']);
			//echo "<br/>facebook 282 ".$token_content;
			$token_content=preg_split('/&/', $token_content);
			$token=preg_replace('/access_token=/', '', $token_content[0]);
			$session_time=preg_replace('/expires=/', '', $token_content[1]);
			$this->native_session->set("token", $token);
			
			//echo "<br/>facebook 288 ".$token;
			
			//echo "<br/>facebook_model 219 ".$session_time;
			//print_r($get);
			$this->native_session->set("session_time", $session_time);
			$this->native_session->set("code", $get['code']);
			return $token;
		
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
	public function FBget_logout_url($current_url){
		$url=$this->facebook->getLogoutUrl();
		return $url;
	}
	public function fql_api($params){
		//$params=array('method', 'query');	
		$imageinfo = $this->facebook->api($params);
		return $imageinfo;
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