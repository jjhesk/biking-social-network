<?php

class Mod_login_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->model("init_model");
		$this->load->database();
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
				
			}else{
				//get the old record
				return $result[0];	
			}
		}else{
			return "login_model 86 wrong manufacturer token.";
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
	
	public function DBset_facebook_oauth($access_token, $overwrite=true){
		//LV3
		//require native_session userinfo 
		//echo "<br/> DBset_faceboook_oauth 78 ";
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
	
	public function mobile_login($info){
		//LV1
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
			//$this->DBset_app_info($info);
			
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
	public function get_Facebook_Profile_Picture($uid){
		return $this->get_redirect_url("http://graph.facebook.com/".$uid."/picture?width=100&height=100");
		//return $get_redirect_url("http://graph.facebook.com/".$uid."/picture?width=180&height=180");
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
		//request mean waiting request, false mean not show waiting list (is friend)
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
	public function bll_get_social_permission_by_user_inhouse_data($user_inhouse_data){
		$permission=$user_inhouse_data['social_media_publication'];
		
		if($permission!=null){
			$permission=preg_split('/,/', $permission);
		}
		//template use 0 as permission
		//echo $permission[0];
		return $permission;
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
	
	public function check_profile_view_privacy($target_user_inhouse_id){
		//BLL LV1
		$target_userinfo=$this->DBget_user_inhouse_info_by_user_inhouse_id($target_user_inhouse_id);
		return $this->check_default_privacy($target_userinfo, $target_userinfo['default_privacy']);
		
	}
	public function check_default_privacy($target_user_inhouse_data, $target_privacy, $login_userinfo=null){
		//BLL LV2
		//echo "<br/>login_model 641 ".print_r($target_user_inhouse_data).", ".$target_privacy;
		if($login_userinfo==null){
			$login_userinfo=$this->native_session->get("userinfo");
		}
		$target_user_inhouse_id=(isset($target_user_inhouse_data['user_inhouse_id']))? $target_user_inhouse_data['user_inhouse_id'] : $target_user_inhouse_data['user_id'];
		if($target_privacy=="default"){
			return $this->check_profile_view_privacy($target_user_inhouse_id);
		}else if( ($target_privacy=="public")||($login_userinfo['user_inhouse_id']==$target_user_inhouse_id) ){
			//public account or self 
			//echo "<br/>login_model 627 public";
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
	
	public function DBget_user_inhouse_info_by_user_inhouse_id($data){
		//echo $data=$user_inhouse_id;
		/*or $data=array(
			"multiple_search"="1"
		); */
		if(is_array($data)){
			for($i=0;$i<count($data);$i++){
				$this->db->or_where('user_inhouse_id', $data[$i]['user_inhouse_id']);
			}
			//$this->db->where("del", "n");
			$query=$this->db->get("user_inhouse_data");
			$user_inhouse_data=$query->result_array(); 
			if(count($user_inhouse_data)>0){
				for($i=0;$i<count($data);$i++){
					$this->db->or_where('user_inhouse_id', $data[$i]['user_inhouse_id']);
				}
				$query=$this->db->get("user_openid");
				$user_openid=$query->result_array(); 
				
				for($i=0;$i<count($user_openid);$i++){
					unset($user_openid[$i]['nickname']);
				}
				$result['array'][0]=$user_inhouse_data;
				$result['array'][1]=$user_openid;
				$result['condition_key'][0]="user_inhouse_id";
				$result['condition_key'][1]="user_inhouse_id";
				$result=$this->init_model->array_inner_join_in_same_key($result);
								
				return $result;
			}else{
				return null;
			}
		}else if($data!=0){
			$user_inhouse_id=$data;
			$this->init_model->sensitive_session[]="DBget_user_inhouse_info_by_user_inhouse_id(".$user_inhouse_id.")";
			if($this->native_session->get("DBget_user_inhouse_info_by_user_inhouse_id(".$user_inhouse_id.")")==null){
				//echo "<br/>login model 672 ";
				$this->db->where('user_inhouse_id', $user_inhouse_id);
				$query=$this->db->get("user_inhouse_data");
				$user_inhouse_data=$query->result_array(); 
				if(count($user_inhouse_data)>0){
					$this->db->where('user_inhouse_id', $user_inhouse_id);
					$query=$this->db->get("user_openid");
					$user_openid=$query->result_array(); 
					for($i=0;$i<count($user_openid);$i++){
						unset($user_openid[$i]['nickname']);
					}
					$result['array'][0]=$user_inhouse_data;
					$result['array'][1]=$user_openid;
					$result['condition_key'][0]="user_inhouse_id";
					$result['condition_key'][1]="user_inhouse_id";
					$result=$this->init_model->array_inner_join_in_same_key($result);
					$this->native_session->set("DBget_user_inhouse_info_by_user_inhouse_id(".$user_inhouse_id.")", $result[0]);
					return $result[0];
				}else{
					return null;
				}
			}else{
				return $this->native_session->get("DBget_user_inhouse_info_by_user_inhouse_id(".$user_inhouse_id.")");
			}
		}else{
			//search all user
				$query=$this->db->get("user_inhouse_data");
				$user_inhouse_data=$query->result_array(); 
				if(count($user_inhouse_data)>0){
					//$this->db->where('user_inhouse_id', $user_inhouse_id);
					$query=$this->db->get("user_openid");
					$user_openid=$query->result_array(); 
					for($i=0;$i<count($user_openid);$i++){
						unset($user_openid[$i]['nickname']);
					}
					$result['array'][0]=$user_inhouse_data;
					$result['array'][1]=$user_openid;
					$result['condition_key'][0]="user_inhouse_id";
					$result['condition_key'][1]="user_inhouse_id";
					$result=$this->init_model->array_inner_join_in_same_key($result);
					//$this->native_session->set("DBget_user_inhouse_info_by_user_inhouse_id(".$user_inhouse_id.")", $result[0]);
					return $result;
				}else{
					return null;
				}
		}
	}
	public function session_set_inhouse_info_after_login(){
		$userinfo=$this->native_session->get('userinfo');
		$user_inhouse_id=$userinfo['user_inhouse_id'];
		$result=$this->DBget_user_inhouse_info_by_user_inhouse_id($user_inhouse_id);
		$this->native_session->set('inhouse_info', $result);
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
		//echo "<br/> mod login model 631 ";
		//print_r($userinfo);
		if($userinfo['identity']=="facebook"){
			$access_token=$this->native_session->get("access_token");
			$this->load->model("facebook_model");
			$this->DBset_facebook_oauth($access_token);	
		}
	}
	
	
}
	