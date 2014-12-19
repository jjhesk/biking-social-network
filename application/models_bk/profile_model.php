<?php

class Profile_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		//* end of constant setting */
		//$this->load->model();
		$this -> load -> model("activity_model");
		$this -> load -> model("friends_model");
		$this -> load -> model("user_model");
		$this->load->library("native_session");
	}

	function get_profile_data($user_id) {
		if($this->native_session->get("DBget_user_inhouse_info_by_user_inhouse_id($user_id)")==null){
			$this -> db -> select('user_inhouse_id, firstname, lastname, email, profile_image, gender, weight, height, birthday, email_privacy, height_privacy, weight_privacy, default_privacy, birthday_privacy, last_updated');
			$query = $this -> db -> get_where('user_inhouse_data', array('user_inhouse_id' => $user_id));
			$data = $query -> result_array();
			if(count($data)>0)
				return $data[0];
			else {
				return null;
			}
		}else{
			return $this->native_session->get("DBget_user_inhouse_info_by_user_inhouse_id($user_id)");
		}
	}
	public function bll_view_activity($data){
		//LV1
		//$data=['user_id, app_id, activity_id']
		//0 for lastest(none)
		//echo "<br/>profile_model 27 ";
		//print_r($data);
		$data['is_live'] = "false";
		if(isset($data['user_id'])){
			/*$data['device_tabs'] = $this ->  get_user_device_tabs($data['user_id']);
			$profile_tabs_html = $this ->  get_user_device_tabs_html($data['user_id']);
			$data = array_merge($data, $this -> init_model -> bll_get_header(true, $profile_tabs_html));
			$data = $this ->  get_page_device_data($data);*/
			
			//echo "<br/> profile_model 36";
			//print_r($data);
			if(isset($data['user_inhouse_data']['user_inhouse_id']))
				$data['user_id']=$data['user_inhouse_data']['user_inhouse_id'];
			$data['device_tabs'] = $this ->  get_user_device_tabs($data['user_id']);
			$profile_tabs_html = $this ->  get_user_device_tabs_html($data['user_id'], $data['device_tabs']);
			$data = array_merge($data, $this -> init_model -> bll_get_header(true, $profile_tabs_html));
			$data = $this ->  get_page_device_data($data);
			
		}else {
			//echo "<br/> profile_model 54";
			$data['device_tabs']=null;
			if($this->native_session->get("userinfo")!=null){
				$data = array_merge($data, $this -> init_model -> bll_get_header(true));
			}else{
				$data = array_merge($data, $this -> init_model -> bll_get_header(false));
			}
			//echo "<br/> profile_model 61 ";
			//print_r($data);
			$data = $this -> get_page_device_data($data);
		}
		
		//echo "<br/> profile_model 33";
		//$data = $this ->  get_page_device_data($data);
		//note - data will pass-through in the function
		//$data['content'] = $this -> load -> view("profile_page/page_device", $data, true);
		//$js_vars['cc'] = "";
		return $data;		
	}
	function get_most_recent_time($activity_id) {
		$this -> db -> select('last_updated, activity_id');
		$query = $this -> db -> get_where('activity_data', array('activity_id' => $activity_id));
		$data = $query -> result_array();
		if (count($data) > 0)
			return $data[0];
		else {
			return null;
		}
	}

	function get_friends_comparison_data($user_id) {

		$data['completed_routes']['completed'] = 11;
		$data['completed_routes']['incomplete'] = 15;
		$data['completed_routes']['value'] = 15;
		$data['time']['spent'] = 10300;
		$data['time']['not_spend'] = 12600;
		$data['time']['value'] = 12600;
		$data['distance']['travelled'] = 15.29;
		$data['distance']['not_travel'] = 10;
		$data['distance']['value'] = 10;
		$data['active']['rank'] = 2;
		$data['active']['total'] = 9;

		return $data;
	}

	public function bll_index_page_header_profile($user_id = '') {

		if ($user_id == '') {
			$user_inhouse_info = $this -> native_session -> get('inhouse_info');
			$user_inhouse_id = $user_inhouse_info['user_inhouse_id'];
		} else {
			$user_inhouse_id = $user_id;
		}
		//print_r($user_inhouse_info);

		$data = $this -> DBget_profile_user_info_by_user_inhouse_id($user_inhouse_id);
		//print_r($data);
		$result['profile_image'] = $data['profile_image'];
		$result['fullname'] = $data['firstname'] . " " . $data['lastname'];

		$result['address'] = 'Professional cyclist Hong Kong';
		$result['lastupdate'] = '13:46 2012.8.20';
		$result['btn_number'] = array("1", "2", "5");
		return $data;

	}

	function get_installed_app_id($user_id) {
		$this -> db -> where("user_id", $user_id);
		$result = $this -> db -> get("app_users");
		return $result -> result_array();
	}

	public function get_most_recent_time_by_user_id($user_id) {
		$this -> db -> select('last_updated');
		$query = $this -> db -> get_where('user_inhouse_data', array('user_inhouse_id' => $user_id));
		$data = $query -> result_array();
		if (count($data) > 0)
			return $data[0];
		else {
			return null;
		}
	}

	public function get_user_profile_info($user_id) {

		$content = $this -> get_profile_data($user_id);
		$data['uid']=$user_id;
		$data['friend_status']= $this->friends_model->get_friends_status($user_id);
		//echo "<br/>profile model 124 ".$data['friend_status'];
		$data['name'] = $content['firstname'] . ' ' . $content['lastname'];
		$data['address'] = $content['email'];
		$data['image_url'] = $content['profile_image'];
		$data['gender'] = $content['gender'];
		$data['weight'] = $content['weight'];
		$data['height'] = $content['height'];
		$data['birthday'] = $content['birthday'];
		$data['btn_number'][0] = '1';
		$data['btn_number'][1] = '2';
		$data['btn_number'][2] = '3';
		$data['email_privacy'] = $content['email_privacy'];
		$data['height_privacy'] = $content['height_privacy'];
		$data['weight_privacy'] = $content['weight_privacy'];
		$data['birthday_privacy'] = $content['birthday_privacy'];
		$data['default_privacy'] = $content['default_privacy'];
		$data['lastupdate'] = $content['last_updated'];

/*
		$activity_id = $this -> activity_model -> get_user_most_recent_activity_id($user_id);
		if ($activity_id != null) {
			$content2 = $this -> get_most_recent_time($activity_id);
		} else {
			$content2 = $this -> get_most_recent_time_by_user_id($user_id);
		}
		if ($content2 != null)
			$data['lastupdate'] = $content2['last_updated'];
		else {
			$data['lastupdate'] = null;
		}
 */

		return $data;
	}

	public function DBget_profile_user_info_by_user_inhouse_id($user_inhouse_id) {
		$this -> db -> where('user_inhouse_id', $user_inhouse_id);
		$result = $this -> db -> get("user_inhouse_data");
		$result = $result -> result_array();
		if (count($result) > 0)
			return $result[0];
		else
			return null;

	}
	
	function get_is_permission_denied($profile, $my_id)	//to check on the profile //Note: function is_friend itself do not check "my_id";
	{
		switch($profile['default_privacy'])
		{
			case 'public':
				return false;			
				
			case 'friends_only':
				if($profile['uid'] == $my_id)
					return false;
				else
					return !($this->friends_model->is_friend($profile['uid']));		//Note: function itself do not check "my_id";
				
			case 'myself_only':
				if($profile['uid'] == $my_id)
					return false;
				else
					return true;
		}
	}
	
	
	

	/* written by fenix, replaced by judy's function 20120928
	 public function DBget_activity_data_by_activity_id($activity_id=''){
	 if($activity_id==''){
	 $this->db->order_by("last_updated","desc");
	 $result=$this->db->get("activity_data");
	 $result=$result->result_array();
	 return $result;
	 }
	 $this->db->where("activity_id", $activity_id);
	 $result=$this->db->get("activity_data");
	 $result=$result->result_array();
	 return $result;
	 }
	 public function DBget_activity_data_by_user_inhouse_id($user_inhouse_id=''){	//- not sure if it'll still be in use after judy modify - 20120925
	 if($user_inhouse_id==''){
	 $this->db->order_by("last_updated","desc");
	 $result=$this->db->get("activity_data");
	 $result=$result->result_array();
	 return $result;
	 }
	 $this->db->where("user_inhouse_id", $user_inhouse_id);
	 $this->db->order_by("last_updated","desc");
	 $result=$this->db->get("activity_data");
	 $result=$result->result_array();
	 return $result;
	 }

	 public function DBget_activity_for_calendar_header_by_user_inhouse_id($user_inhouse_id=''){
	 if($user_inhouse_id!='')
	 $this->db->where("user_inhouse_id", $user_inhouse_id);
	 $this->db->order_by("last_updated","desc");
	 $result=$this->db->get("activity_data");
	 $result=$result->result_array();
	 return $result;

	 }
	 public function DBget_activity_for_calendar_header_by_activity_id($user_id, $app_id, $result, $activity_num){
	 if($result!=null){
	 if($activity_num==''){
	 $activity_num=0;
	 }

	 // Current activity with title:

	 $data['current_activity']=date("g:ia, M d, Y", strtotime($result[$activity_num]['last_updated'])+28800); // HardCoded to HKG time

	 $data['current_activity_id']=$result[$activity_num]['activity_id'];
	 if(isset($result[$activity_num+1])){
	 $data['previous_activity_link']=site_url()."/profile/page_device/$user_id/$app_id/".($activity_num+1);
	 }
	 if(isset($result[$activity_num-1])){
	 $data['next_activity_link']=site_url()."/profile/page_device/$user_id/$app_id/".($activity_num-1);
	 }
	 return $data;
	 }else{
	 return null;
	 }

	 }
	 */
	 
	 public function DBget_activity_by_dates($user_id, $app_id, $starting_dates, $last_ending_date){
	 	//Note: will not look into mode, dierectly use json_key as output
		 $data = array();
		 foreach($starting_dates as $key=>$start_date)
		 {
		 	$end_date = $key+1 < (count($starting_dates))?$starting_dates[$key+1]:$last_ending_date;
			
			$this->db->where("last_updated >= '{$start_date}'");
			$this->db->where("last_updated < '{$end_date}'");
				
			$this->db->where('user_inhouse_id', $user_id);
			$this->db->where('app_id', $app_id);	 	 		 	 	 
			$this->db->order_by("last_updated","desc");
			$this->db->group_by('mode');	//actually will be key-by json_key
			$this->db->from('activity_data');
			$result=$this->db->get();
			$result=$result->result_array();
			
			foreach($result as $row)	//group by mode
			{
				//privacy assume must be default
				$tmp=json_decode($row['custom_data_json'],true);
				if(isset($tmp[0]))
				foreach($tmp[0] as $row_key => $item)					//assume only 1 record per entry
				{
					$data[$row_key]['date'][$key] = $row['last_updated'];
					$data[$row_key]['value'][$key] = $item;
				}
			}
		 }	 
		return $data;		 
		 
		 /*
		$weights='[';
		$datetime="";
		for($i=0;$i<count($result);$i++){
			$weight=json_decode($result[$i]['custom_data_json'],true);
			//print_r($weight);
			if( (isset($data['replace_key']))&&($data['replace_key']!='') )
				$weight=preg_replace('/'.$data['replace_key'].'/', '', $weight[0][$data['json_key']]).',';
			$weights.=$weight;
			$datetime.="'".date("M j", strtotime($result[$i]['last_updated']))."',";
		}
		$weights=substr($weights, 0, strlen($weights)-1);
		$weights.=']';
		$datetime=substr($datetime, 0, strlen($datetime)-1);
		return array("value"=>$weights, "datetime"=>$datetime);*/
	 }
	 
	 
	 /*public function DBget_activity($data){ replaced by function above - judy 20121227
	 	/*
		 * $data=array(
	 		"mode"=>"ihealth_weight",
		 * "user_inhouse_id"=>"63",
		 * "app_id"=>"2",
		 * "json_key"=>"weight"
		 * "replace_key"=>" KG"
		 * 
		); * /
		$sql="select * from activity_data where mode='".mysql_real_escape_string($data['mode'])."' 
				and user_inhouse_id='".mysql_real_escape_string($data['user_inhouse_id'])."' 
				and app_id='".mysql_real_escape_string($data['app_id'])."' 
				group by date(last_updated) order by last_updated desc limit 0, 12";
		$result=$this->db->query($sql);
		$result=$result->result_array();
		$weights='[';
		$datetime="";
		$has_value=0;
		for($i=0;$i<count($result);$i++){
			$weight=json_decode($result[$i]['custom_data_json'],true);
			//print_r($weight);
			if( (isset($data['replace_key']))&&($data['replace_key']!='') ){
				$weight=preg_replace('/'.$data['replace_key'].'/', '', $weight[0][$data['json_key']]).',';
				$has_value=1;
			}
			$weights.=$weight;
			$datetime.="'".date("M j", strtotime($result[$i]['last_updated']))."',";
		}
		$weights=substr($weights, 0, strlen($weights)-1);
		$weights.=']';
		$datetime=substr($datetime, 0, strlen($datetime)-1);
		return array("value"=>$weights, "datetime"=>$datetime, "has_value"=>$has_value);
	 }*/
	 
	 function get_block_weight_analysis_data($user_id, $app_id)
	 {
	 	$data['title'] = 'Health Chart';
	 	$data['x-axis'] = '';
	 
	 	//set calendar for past 12 mth
	 	for($mth = 11; $mth >=0; $mth--)
	 	{
	 		$text_mth = date("m")-$mth;
		 	$start_dates[] = date("Y-m-d", mktime(0, 0, 0, $text_mth, 1, date("Y")));
		 	$start_dates[] = date("Y-m-d", mktime(0, 0, 0, $text_mth, 7, date("Y")));
			$start_dates[] = date("Y-m-d", mktime(0, 0, 0, $text_mth, 15, date("Y")));
			$start_dates[] = date("Y-m-d", mktime(0, 0, 0, $text_mth, 22, date("Y")));
			
			$data['x-axis'] .= "{$text_mth}, '', '', '',";
		}
		$last_end_date = date("Y-m-d", mktime(0, 0, 0, date("m")-$mth  , 1, date("Y")));		
		
		$result=$this->DBget_activity_by_dates($user_id, $app_id, $start_dates, $last_end_date);
		
		//TODO: the following is hardcoded for iHealthFans
		$weight = array();
		foreach($start_dates as $key=>$value)
		{
			$weight[$key] = isset($result['weight']['value'][$key])?(int)$result['weight']['value'][$key]:'null';
			$BMI[$key] = isset($result['BMI']['value'][$key])?(int)$result['BMI']['value'][$key]:'null';
			$avg_heart_rate[$key] = isset($result['avg_heart_rate']['value'][$key])?(int)$result['avg_heart_rate']['value'][$key]:'null'; 
		}
		
			$text_dates = array();
			foreach ($start_dates as $item)
			{
				$text_dates[] = "'{$item}'";
			}
			
			$data['tooltip'][0]['title'] = 'Weight';
			$data['tooltip'][0]['unit'] =  ' kg';
			$data['tooltip'][0]['date'] =  '['.implode(',', $text_dates) .']';
			$data['plot'][0]['name'] =  'Weight';
			$data['plot'][0]['axis'] =  '0';
			$data['y-axis'][0]['title'] = 'Weight';
			$data['y-axis'][0]['color'] = '#00BE96';
			$data['y-axis'][0]['unit'] = 'kg';
			$data['plot'][0]['data'] = 	'['.implode(',', $weight) .']';
		
		
			$data['y-axis'][1]['title'] = 'BMI';
			$data['y-axis'][1]['color'] = '#7798BF';
			$data['y-axis'][1]['unit'] = '';
			$data['tooltip'][1]['title'] = 'BMI';
			$data['tooltip'][1]['unit'] = ' ';
			$data['tooltip'][1]['date'] =  '['.implode(',', $text_dates) .']';
			$data['plot'][1]['name'] =  'BMI';
			$data['plot'][1]['axis'] =  '1';
			$data['plot'][1]['data'] = 	'['.implode(',', $BMI) .']';
			
			$data['y-axis'][2]['title'] = 'Heart Rate';
			$data['y-axis'][2]['color'] = '#FF1F84';
			$data['y-axis'][2]['unit'] = 'bpm';
			$data['tooltip'][2]['title'] = 'Heart Rate';
			$data['tooltip'][2]['unit'] = ' bpm';
			$data['tooltip'][2]['date'] =  '['.implode(',', $text_dates) .']';
			$data['plot'][2]['name'] =  'Heart Rate';
			$data['plot'][2]['axis'] =  '2';
			$data['plot'][2]['data']='['.implode(',', $avg_heart_rate) .']';
			
			
			//$data['date_text']= '['.implode(',', $text_dates) .']';
		
		// echo '<pre>';
	 	// print_r($weight);
	 	// echo '</pre>';
		// echo $data['plot'][0]['data']; 
		// echo $data['x-axis'];
		//*/
		return $data; 
	 }
	 
	function get_user_app_data($user_id, $app_id)
	{
		$this -> db -> where("user_id", $user_id);
		$this -> db -> where("app_id", $app_id);
		$this -> db -> where("is_del", 0);
		$this->db->order_by("last_updated", "desc");
		$result = $this -> db -> get("app_users_data");
		return $result -> result_array();
	}
	
	function get_page_user_profile_data($data)//note - data will pass-through in the function
	{
		$target_id = $data['user_id'];
		// profile block
		$data['profile'] = $this  -> get_user_profile_info($target_id);
		$data['is_permission_denied'] = $this->profile_model->get_is_permission_denied($data['profile'], $this->user_id);		
		
		
		$data['block_personal_profile'] = $this -> load -> view("profile_page/block_personal_profile", $data, TRUE);

		// photo block
		$data['profile_images'] = $this -> profile_model -> get_user_lastest_photo($target_id);
		$data['block_image'] = $this -> load -> view("profile_page/block_photo_all", $data, TRUE);

		
		// friends block
		$data['friends_data'] = $this -> friends_model -> getdatafriendsid($target_id, array("user_inhouse_id", "firstname", "lastname", "country", "profile_image"));
		
		if (count($data['friends_data']) > 0)
			foreach ($data['friends_data'] as $key => $value) {
				$data['friends_data'][$key]['apps_installed'] = count($this->user_model->get_user_installed_apps($value['user_inhouse_id']));
			}

		$data['block_friends'] = $this -> load -> view("profile_page/block_friends", $data, TRUE);
		return $data;
	}
	
	public function jump_to_no_activity_found(){
		$data=$this->profile_model->bll_view_activity(null);
		$data['activity_id'] =0;
		$data['content'] = $this -> load -> view("profile_page/page_device", $data, true);
		return $data;
	}
	public function get_page_device_data($data, $ajax=false)//note - data will pass-through in the function
	{
		if( (isset($data['app_id']))&&($data['user_id']) ){
			$app_layout = $this -> profile_model -> get_app_layout($data['app_id']);
	
			//theme colors
			$data['color'] = $app_layout['theme_color'];
			$data['color_hex']['normal'] = $app_layout['color_hex_normal'];
			$data['color_hex']['shaded'] = $app_layout['color_hex_shaded'];
	
			$data['profile'] = $this  -> get_user_profile_info($data['user_id']);
	
			switch($app_layout['page_type'])
			{
				case 'activity_layout':
				case 'petnfans_layout':				
					$data = $this->profile_model->get_activity_layout($data, $ajax, $app_layout);
					$data['page_device_content'] = $this->load->view("profile_page/page_device_activity_layout", $data, TRUE);
					break;
				
				case 'petnfans_layout1':	//not in use yet, but for expansion of really exceptional layout
					$data = $this->profile_model->get_petnfans_layout($data, $app_layout);
					$data['page_device_content'] = $this->load->view("profile_page/page_device_petnfans_layout", $data, TRUE);
					break;
			}
			return $data;
		}else{
			$app_layout = $this -> profile_model -> get_app_layout(1);
	
			//theme colors
			$data['color'] = $app_layout['theme_color'];
			$data['color_hex']['normal'] = $app_layout['color_hex_normal'];
			$data['color_hex']['shaded'] = $app_layout['color_hex_shaded'];
			$data['profile'] = $this  -> get_user_profile_info(0);
	
			$data = $this->profile_model->get_activity_layout($data, $ajax, $app_layout);
			$data['page_device_content'] = $this->load->view("profile_page/page_device_activity_layout", $data, TRUE);
			return $data;
			
		}
	}
	
	public function get_petnfans_layout($data, $app_layout)
	{
		return $data;	
	}
	
	public function get_activity_layout($data, $ajax=false, $app_layout)//note - data will pass-through in the function
	{	
		if(!isset($data['activity_id']))
			$data['activity_id']=0;
			
		if( ($data['activity_id']==0) && (isset($data['user_id']))&&(isset($data['app_id']) ) ){
			$data['activity_id'] = $this -> get_lastest_activity_id($data['user_id'], $data['app_id']);
		}
		
		if($data['activity_id']==0){
			return $data;
		}else if($this->login_model->check_profile_activity_privacy($data['activity_id'])==false){
			$data['activity_id']=-1;
			return $data;
		}
		
		$data['activity_data'] = $this -> activity_model -> get_user_activity_record($data['activity_id']);
		
		$blocks = json_decode($app_layout['block_json'], true);

		foreach ($blocks as $block) {

			switch($block['widget']) {
				case 'block_calendar':	//ibikefans
					if($ajax==false){
						$data['calendar'] = $this -> get_activity_calendar_bar($data['activity_id'], $data['user_id'], $data['app_id']);
						$data['block_views'][$block['position']]['block_calendar'] = $this -> load -> view("profile_page/block_calendar", $data, TRUE);
					}
				break;
				
				case 'block_photo':	//ibikefans photo - not that petnfas use "square photo"
					if($ajax==false){
				//		$data['profile_images'] = $this -> profile_model -> get_user_lastest_photo($data['user_id']);
						$data['images'] = $this -> get_activity_photos($data['activity_id']);
						$data['block_views'][$block['position']]['block_photo'] = $this -> load -> view("profile_page/block_photo", $data, TRUE);
					}
				break;
				
				case 'block_square_photo':	//petnfans
					// this default photo is hardcoded for petnfans
					$profile = $this->profile_model->get_user_app_data($data['user_id'], $data['app_id']); 		
					if($profile[0]['full_image']!=null){				
						$default_photo = $profile[0]['full_image'];
					}else {
						$default_photo = $profile[0]['image'];		
					}
					$images = $this->get_activity_photos($data['activity_id']);
					$data['image'] = count($images)>0?$images[0]['full_url']:$default_photo;
					//echo "<br/>profile model 581 ".$data['image'].":".$images[0]['full_url'].":".$default_photo;
					$data['block_views'][$block['position']]['block_app_profile'] = $this -> load -> view("profile_page/block_square_photo", $data, TRUE);
				break;
				
				case 'block_app_profile':	//petnfans TODO: make sure 1 profile per app_users_data_id
					$data['app_profile'] = $this->profile_model->get_user_app_data($data['user_id'], $data['app_id']);
					$data['block_views'][$block['position']]['block_app_profile'] = $this -> load -> view("profile_page/block_app_profile", $data, TRUE);
				break;				
				
				case 'block_location':	//petnfans
					//TODO: fenix - some function?
					if($data['has_map'] = $this -> googlemaps_model -> check_activity_has_map($data['activity_id']))
						$data['block_views'][$block['position']]["block_location"] = $this -> load -> view("profile_page/block_location", $data, TRUE);
				break;
			
				case 'block_square_photo_slider': //petnfans, shared by all activities
					$bll_activity=array(
						"app_id"=>$data['app_id'],
						"user_inhouse_id"=>$data['user_id']
					);
					$data['last_activities']=$this->activity_model->DBget_user_last_app_activity($bll_activity);
					for($i=0;( ($i<count($data['last_activities']))&&($i<20) );$i++){
						$data['last_10_activities'][$i]=$data['last_activities'][$i];
					}
					//echo "<br/>profile model 600 ";
					//print_r($data['last_10_activities']);
					
					$last_10_activities_photo=$this->activity_model->DBget_activity_photo_by_activity_id($data['last_10_activities']);
					//echo "<br/>profile model 603 ";
					//print_r($last_10_activities_photo);
					
					$result['array'][0]=$data['last_10_activities'];
					$result['array'][1]=$last_10_activities_photo;
					$result['condition_key'][0]="activity_id";
					$result['condition_key'][1]="activity_id";
					$result=$this->init_model->array_outer_join_in_same_key($result);
					$app_icon_image=$this->activity_model->DBget_app_icon_by_app_id($data['app_id']);
					//echo "<br/> profile model 619 ";
					//print_r($result);
					
					for($i=0;$i<count($result);$i++){
						if( (!isset($result[$i]['thumb_url']))||($result[$i]['thumb_url']=='') ){
							if( (isset($result[$i]['app_users_data_id']))&&($result[$i]['app_users_data_id']!='') ){
								$device=$this->activity_model->DBget_app_users_data_by_app_users_data_id($result[$i]['app_users_data_id']);
								//echo "<br/> profile model 624 ";
								//print_r($device);
								if( (count($device)>0)&&($device['image']!='') ){
									$result[$i]['thumb_url']=$device['image'];
								}else{
									$result[$i]['thumb_url']=$app_icon_image;
								}
							}else{
								$result[$i]['thumb_url']=$app_icon_image;
							}
						}
					}
					//echo "<br/>profile model 625 ";
					//print_r($result);
					$data['last_10_activities']=$result;
					
					//echo "<br/>profile model 608 ".count($last_10_activities_photo)." app_icon:".$app_icon_image;
		
					/*for($i=0;( ($i<count($data['last_10_activities']))&&($i<10) );$i++){
							
						if( (!isset($last_10_activities_photo[$i]['thumb_url']))||($last_10_activities_photo[$i]['thumb_url']=='') ){
							//last 10 acvtivities photo had no image
							//echo "<br/>profile model 614 ".$i;
							if( (isset($data['last_10_activities'][$i]['app_users_data_id']))&&($data['last_10_activities'][$i]['app_users_data_id']!='') ){
								//if last 10 activities has device, use device image as icon
								$device=$this->activity_model->DBget_app_users_data_by_app_users_data_id($data['last_10_activities'][$i]['app_users_data_id']);
								echo "<br/>profile model 624 ";
								echo $data['last_10_activities'][$i]['thumb_url']=$device['image'];
								//if device does not have image, use app icon...
								if($data['last_10_activities'][$i]['thumb_url']=='') $data['last_10_activities'][$i]['thumb_url']=$app_icon_image;
								//echo "<br/>profile model 614 ".$data['last_10_activities'][$i]['thumb_url'];
							}else{
								// last 10 activity does not have device, so the image use app icon...
								//echo "<br/>profile model 624  no device, activity_id : ".$data['last_10_activities'][$i]['activity_id'];
								$data['last_10_activities'][$i]['thumb_url']=$app_icon_image;
							}
						}else{
							
							//$last_10_activities_photo has image...	
							//$data['last_10_activities'][$i]['thumb_url']=$app_icon_image;
						}
					}*/
					//$data['last_10_activities']=$last_10_activities_photos;
					/*$result['array'][0]=$data['last_10_activities'];
					$result['array'][1]=$last_10_activities_photos;
					$result['condition_key'][0]="activity_id";
					$result['condition_key'][1]="activity_id";
					$result=$this->init_model->array_inner_join_in_same_key($result);*/
					//$data['last_10_activities']=$last_10_activities_photos;
					//echo "<br/>profile model 626 ";
					//print_r($data['last_10_activities']);
					$data['block_views'][$block['position']]['block_square_photo_slider'] = $this -> load -> view("profile_page/block_square_photo_slider", $data, true);
				break;
				
				case 'block_recent_activities': //petnfans, shared by all activities
					//TODO: fenix - some function?
					//$data['recent_news'] = $this -> news_model -> get_user_recent_activities_by_profile_data($data);
					//echo "<br/>profile model 670 ";
					//print_r($data['recent_news']);
					//$data['recent_news'] = array('some news', 'xxx', 'yyy','xxx','kkk', 'ppp','sss','ooo');
					$data['block_views'][$block['position']]['block_recent_activities'] = $this -> load -> view("profile_page/block_recent_activities_standard", $data, TRUE);
				break;

				case 'block_fb_comments': //petnfans
					//uses $data['activity_id'];					
					$data['fb_comments_url']=site_url("portal/open_graph_object/".$data['activity_id']);
					$data['block_views'][$block['position']]['block_fb_comments'] = $this -> load -> view("profile_page/block_fb_comments", $data, TRUE);
				break;
				
				case 'block_weight_analysis' :	//ihealthfans
					//block_weight_analysis
					//echo "<br/>profile_model 367 load block_weight_analysis ";
					$data['block_weight_analysis_data'] = $this->profile_model->get_block_weight_analysis_data($data['user_id'], $data['app_id']);
					$data['block_views'][$block['position']]['block_weight_analysis'] = $this -> load -> view("profile_page/block_weight_analysis", $data, TRUE);
				break;
				
				
				case 'block_elapse_time' :	//ibikefans
								
				if(isset($data['activity_data']['split_time'])){	//TODO: looks like a big mess when enabled
						$data['activity_data']['split_time'] = str_split($data['activity_data']['elapse_time'], 2);
						$data['block_views'][$block['position']]['block_activity_overview'] = $this -> load -> view("profile_page/block_activity_overview", $data, TRUE);
					}
				break;
				
				case 'block_summary' :	//ibikefans
					//block_summary		- note: fixed position
					$data['block_summary_iframe_get_string'] = http_build_query(array('user_id' => $data['user_id'], 'app_id' => $data['app_id'], 'color_hex_normal' => $app_layout['color_hex_normal'], 'color_hex_shaded' => $app_layout['color_hex_shaded'], 'activity_id' => $data['activity_id'], 'param' => urlencode(serialize($block['param'])), ));
					$data['block_views'][$block['position']]['block_summary'] = $this -> load -> view("profile_page/block_summary", $data, TRUE);
				break;

				case 'block_record_analysis' :	//ibikefans
						$data['block_record_analysis_iframe_get_string'] = http_build_query(array('user_id' => $data['user_id'], 'app_id' => $data['app_id'], 'color_hex_normal' => $app_layout['color_hex_normal'], 'color_hex_shaded' => $app_layout['color_hex_shaded'], 'activity_id' => $data['activity_id'], 'param' => urlencode(serialize($block['param'])), ));
						$data['block_views'][$block['position']]["block_record_analysis"] = $this -> load -> view("profile_page/block_record_analysis", $data, TRUE);
				break;

				case 'block_record' :	//ihealthfans

					if($data['app_id']!='3'){
						$has_value=0;
						
						foreach ($block['param'] as $key => $param) {
							if( (isset($data['activity_data'][$param['function_param']]))&&($data['activity_data'][$param['function_param']]!='') ){
								$data['block_record_field'][$key]['title'] = $param['title'];
								$data['block_record_field'][$key]['unit'] = $param['unit'];
								$data['block_record_field'][$key]['value'] = $data['activity_data'][$param['function_param']];
								$has_value=1;
							}
						}
						if($has_value==1)
							$data['block_views'][$block['position']]["block_record"] = $this -> load -> view("profile_page/block_record", $data, TRUE);
					}else{
						$data['ihealth_heart_rate']=$this->activity_model->DBget_activity_mode(array("mode"=>"ihealth_heart_rate", "app_id"=>"3", "user_inhouse_id"=>$data['user_id']));
						$data['ihealth_weight']=$this->activity_model->DBget_activity_mode(array("mode"=>"ihealth_weight", "app_id"=>"3", "user_inhouse_id"=>$data['user_id']));
						if(count($data['ihealth_weight'])>0){
						
							$bmi=json_decode($data['ihealth_weight'][0]['custom_data_json'], true);
							
							if(isset($bmi[0]['bmi']))
								$bmi=$bmi[0]['bmi'];
						}


						foreach ($block['param'] as $key => $param) {
								$data['block_record_field'][$key]['title'] = $param['title'];
								$data['block_record_field'][$key]['unit'] = $param['unit'];
								if( ($param['unit']=="bpm")&&(isset($data['ihealth_heart_rate'][0]['avg_heart_rate']))&&($data['ihealth_heart_rate'][0]['avg_heart_rate']!='') )
									$data['block_record_field'][$key]['value'] = $data['ihealth_heart_rate'][0]['avg_heart_rate'];
								else if( ($param['unit']=="BMI")&&(isset($bmi))&&($bmi!='') )
									$data['block_record_field'][$key]['value'] =$bmi;
								else
									$data['block_record_field'][$key]['value']=0;
						
						}
						$data['block_views'][$block['position']]["block_record"] = $this -> load -> view("profile_page/block_record", $data, TRUE);
					}
				break;

				case 'block_map' : 	//ibikefans, petnfans use block_location
					//map use iframe, no data sent.
					if($ajax==false){
						$data['has_map'] = $this -> googlemaps_model -> check_activity_has_map($data['activity_id']);
						if($data['has_map']==1)
							$data['block_views'][$block['position']]["block_map"] = $this -> load -> view("profile_page/block_map", $data, TRUE);
					}
				break;

				case 'block_description' :	
					//map + location block
					$data['suggested']['checkpoints'] = '6';
					$data['suggested']['distance'] = '10.56';

					$data['block_views'][$block['position']]["block_description"] = $this -> load -> view("profile_page/block_description", $data, TRUE);
				break;

				case 'block_activity_comments' :					
					//if($ajax==false){
						$data['comment_activity_id'] = $this->comments_model->get_comment_id_from_actvity_id($data['activity_id']);
						$data['comment_count'] = $this -> comments_model -> count_comments_for_activity($data['comment_activity_id']);
						$data['block_views'][$block['position']]["block_activity_comments"] = $this -> load -> view("profile_page/block_activity_comments", $data, TRUE);
					//}
				break;

				
			}
		}
		
		return $data;

	}
	

	
	function get_lastest_activity_id($user_id, $app_id)//judy
	{
		$sql="select activity_id from activity_data where 1 and ";
		
		$this -> db -> where("user_id", $user_id);
		$this -> db -> where("app_id", $app_id);
		$this->db->order_by("last_updated", "desc");
		$app_users_data=$this->db->get("app_users_data");
		
		$app_users_data=$app_users_data->result_array();
		if(count($app_users_data)>0){
			$app_users_data_id=$app_users_data[0]['app_users_data_id'];
			$sql.=" app_users_data_id='".$app_users_data_id."' or ";
		}
		$sql.=" (user_inhouse_id='".mysql_real_escape_string($user_id)."' 
					and app_id='".mysql_real_escape_string($app_id)."') ";
		
		$sql.=" order by last_updated desc";
		$result=$this->db->query($sql);
		/*$this -> db -> select('activity_id');
		$this -> db -> order_by("last_updated", "desc");
		$this -> db -> where("user_inhouse_id", $user_id);
		$this -> db -> where("app_id", $app_id);
		if(isset($app_users_data_id))
			$this -> db -> or_where("app_users_data_id", $app_users_data_id);
		$result = $this -> db -> get("activity_data");*/
		$result = $result -> result_array();
		if ($result == NULL)
			return 0;
		else
			return $result[0]['activity_id'];
		
	}

	function get_activity_calendar_bar($activity_id, $user_id, $app_id) { //judy 201209
		$this -> db -> where("activity_id", $activity_id);
		//$this->db->where("user_inhouse_id", $user_id); //POSSIBLE BUG: can be removed, but currently here to reduce visible bug. supposed to be irrelevant when bugless - judy20120928
		$result = $this -> db -> get("activity_data");
		$result = $result -> result_array();
		$activity = $result[0];

		$data['current_activity'] = date("g:ia, M d, Y", strtotime($activity['last_updated']) );
		//$data['current_activity'] = date("g:ia, M d, Y", strtotime($activity['last_updated']) + 28800);
		// TODO: HardCoded to HKG time

		if ($activity['prev_activity_id'])
			$data['previous_activity_link'] = site_url("profile/page_device/{$user_id}/{$app_id}/{$activity['prev_activity_id']}");

		if ($activity['next_activity_id'])
			$data['next_activity_link'] = site_url("profile/page_device/{$user_id}/{$app_id}/{$activity['next_activity_id']}");

		return $data;
	}

	function get_user_lastest_photo($user_id) {

		$this -> db -> join('activity_data', 'activity_data.activity_id = activity_photo.activity_id');
		$this -> db -> select('activity_photo.full_url, activity_data.user_inhouse_id');
		$this -> db -> where('activity_data.user_inhouse_id', $user_id);
		$this->db->order_by("activity_photo.timestamp","asc");
		$result = $this -> db -> get("activity_photo");
		$rows = $result -> result_array();

		$data = array();
		foreach ($rows as $row) {
			$data[]['full_url'] = $row['full_url'];
			//TODO: take original url after demo
		}

		for ($i = 0; $i < count($data); $i++) {
			$data[$i]['image_id'] = $i;
		}
		return $data;
	}

	function get_activity_photos($activity_id) {
		$this -> db -> select('full_url');
		$this->db->order_by("photo_id", "desc");
		$query = $this -> db -> get_where('activity_photo', array('activity_id' => $activity_id));
		
		$data = $query -> result_array();
		return $data;
	}

	function get_profile_box($user_id) {
		$data['profile']['image'] = '/images/index/profile_img.png';
		$data['profile']['name'] = 'Kenny Ma';
		$data['profile']['address'] = 'Professional cyclist Hong Kong';
		$data['profile']['lastupdate'] = '13:46 2012.8.20';
		$data['profile']['btn_number'] = array("1", "2", "5");

		return $data['profile'];
	}

	function get_summary_data($user_id, $app_id) {

		// Get number of routes
		$this -> db -> select('user_inhouse_id, app_id, total_distance, elapse_time_sec');
		$query = $this -> db -> get_where('activity_data', array('user_inhouse_id' => $user_id, 'app_id' => $app_id));
		$result = $query -> result_array();
		$number_of_routes = count($result);

		// Get total distance
		$total_distance = 0;
		foreach ($result as $key1 => $val1) {
			$total_distance += $val1['total_distance'];
		}

		// Get total time
		$total_time = 0;
		foreach ($result as $key2 => $val2) {
			$total_time += $val2['elapse_time_sec'];
		}

		$data['pie_chart'][0]['shade'] = 'Completed';
		$data['pie_chart'][0]['normal'] = 'Incompleted';
		$data['pie_chart'][0]['label'] = 'Completed Routes';
		$data['pie_chart'][0]['value'] = $number_of_routes;
		$data['completed_routes']['completed'] = 11;
		$data['completed_routes']['incomplete'] = $number_of_routes;

		$data['pie_chart'][1]['shade'] = 'Spent';
		$data['pie_chart'][1]['normal'] = 'Not Spend';
		$data['pie_chart'][1]['label'] = 'Total Time Spent';
		$data['pie_chart'][1]['value'] = $this -> comments_model -> time_since($total_time);
		$data['time']['spent'] = 203000;
		$data['time']['not_spend'] = $total_time;

		$data['pie_chart'][2]['shade'] = 'Travelled';
		$data['pie_chart'][2]['normal'] = 'Not Travel';
		$data['pie_chart'][2]['label'] = 'Total Distance ';
		$data['pie_chart'][2]['value'] = $total_distance . ' km';
		$data['distance']['travelled'] = 8529;
		$data['distance']['not_travel'] = $total_distance;

		$data['display_number']['label'] = 'Active Ranking out of';
		$data['active']['rank'] = 4;
		$data['active']['total'] = 9;

		return $data;
	}

	function get_app_layout($app_id) {
		$this -> db -> join('app_theme_color', 'app_page_layout.theme_color = app_theme_color.theme_color');
		$query = $this -> db -> get_where('app_page_layout', array('app_page_layout.app_id' => $app_id));
		$data = $query -> result_array();
		if (count($data) > 0)
			return $data[0];
		else
			return null;
	}

	function get_user_activities_for_calendar($user_id, $start_date, $end_date) {
		$this -> db -> select('tab_label, activity_id, activity_data.app_id, title, DATE_FORMAT(last_updated, "%e") as day, color_hex_normal', false);
		$this -> db -> where('user_inhouse_id', $user_id);
		$this -> db -> where('last_updated >', $start_date);
		$this -> db -> where('last_updated < ', $end_date);
		$this -> db -> join('app_page_layout', 'activity_data.app_id = app_page_layout.app_id');
		$this -> db -> join('app_theme_color', 'app_page_layout.theme_color = app_theme_color.theme_color');
		$result = $this -> db -> get("activity_data");
		$result = $result -> result_array();

		$data = array();
		foreach ($result as $item) {
			$day = $item['day'];
			$url = site_url("profile/page_device/{$user_id}/{$item['app_id']}/{$item['activity_id']}");
			$data[$day] = "<span style='background-color: #{$item['color_hex_normal']}; color:white; font-size:10px; padding:2px; border-radius: 5px;'>{$item['tab_label']}</span>
			<a target='_top' class='cal_event_click' onclick='pipeline(\"".$url."\")' style='color: #{$item['color_hex_normal']}'>{$item['title']}</a>";
			//TODO: activity

			/*switch($item['category'])
			 {
			 case 'party':			$img='48x48_party.png'; break;
			 case 'course (cake)':	$img='48x48_cake.png';	break;
			 case 'outdoor (wargame)': $img='48x48_wargame.png'; break;
			 case 'outdoor (general)': $img='48x48_sun.png'; break;
			 default: $img='48x48_house.png'; break;
			 }

			 $tag = "<img src='/images/icons/{$img}' width='48px' height='48px' border='0' /><br>".character_limiter($item['str_name_en'], 4);

			 $day = date('j', strtotime($item['start_time']));
			 if(!isset($data[$day]))
			 $data[$day] = "<a href='{$url}'>{$tag}</a>";
			 else
			 $data[$day] = "<table border='0' cellpadding='0' cellspacing='0'><tr><td><a href='{$url}'>{$tag}</a></td><td>&nbsp;</td><td>{$data[$day]}</td></tr></table>";
			 * */
		}

		return $data;

	}

/*	function get_user_device_tabs($user_id) { //judy 20121009 replaced with below function
		$this -> db -> select('apps_installed');
		$query = $this -> db -> get_where('user_inhouse_data', array('user_inhouse_id' => $user_id));
		$data = $query -> result_array();

		if ($data[0]['apps_installed']) {
			$app_ids = explode(',', $data[0]['apps_installed']);

			$my_apps = array();
			foreach ($app_ids as $key => $app_id)//not using wherein, since num of app is small, and we prefer to sort by specified order
			{
				$this -> db -> select('app_id, color_hex_normal, color_hex_shaded, tab_label');
				$this -> db -> where('app_id', $app_id);
				$this -> db -> join('app_theme_color', 'app_page_layout.theme_color = app_theme_color.theme_color');
				$query = $this -> db -> get('app_page_layout');
				$apps = $query -> result_array();

				$my_apps[$key]['app_id'] = $apps[0]['app_id'];
				$my_apps[$key]['color_hex_normal'] = $apps[0]['color_hex_normal'];
				$my_apps[$key]['color_hex_shaded'] = $apps[0]['color_hex_shaded'];
				$my_apps[$key]['tab_label'] = $apps[0]['tab_label'];
			}
			return $my_apps;
		} else
			return array();
	}*/

	function DBget_user_device_tabs($user_id) {
		$this -> db -> select('app_users.app_id, color_hex_normal, color_hex_shaded, tab_label, app_users.default_privacy');
		$this -> db -> where('user_id', $user_id);
		$this -> db -> join('app_page_layout', 'app_page_layout.app_id = app_users.app_id');
		$this -> db -> join('app_theme_color', 'app_page_layout.theme_color = app_theme_color.theme_color');
		$query = $this -> db -> get('app_users');
		return $query -> result_array();
	}
	function get_user_device_tabs($user_id){
		//BLL
		$result=null;
		$cc=0;
		$orig_result=$this->DBget_user_device_tabs($user_id);
		if(count($orig_result)>0)
		for($i=0;$i<count($orig_result);$i++){
			//echo "<br/>profile_model 834";
			//print_r($orig_result[$i]);
			if($this->login_model->check_profile_apps_privacy($orig_result[$i]['app_id'], $user_id)==true){
				$result[$cc]=$orig_result[$i];
				$cc++;
			}
		}
		return $result;
	}
	
	function get_user_device_tabs_html($user_id, $user_device_tabs=null, $active_device_id = '') {
		$device_tabs=$user_device_tabs;
		if($device_tabs==null){
			$device_tabs = $this -> get_user_device_tabs($user_id);
		}	
		
		//$this -> db -> select('default_privacy');
		//$query = $this -> db -> get_where('user_inhouse_data', array('user_inhouse_id' =>$user_id));
		//$user_privacy = $query -> result_array();
		//if ($user_privacy[0]['default_privacy'] != 'myself_only') {
		//	$device_tabs = $this -> get_user_device_tabs($user_id);
		//} else {
		//	$device_tabs = array();
		//}
		
		$site_url = site_url();
		// rewrote by Heskeyo Kam
		// pre style sheet
		$html = '<style>.shadow{-webkit-box-shadow: 0px -4px 7px rbga(0, 0, 0, .5);-moz-box-shadow: 0px -4px 7px rbga(0, 0, 0, .5);}.tab{font-size: 16px; float:left; height: 20px; padding:15px;}.tab:visited {color:#999999; text-decoration:none;} .tab:active {color:#111111; text-decoration:none;}';
		$part1 = '';
		$part2 = '';
		if(count($device_tabs)>0)
		foreach ($device_tabs as $tab) {
			$tab_label = $tab['tab_label'];
			$did = $tab['app_id'];
			$device_name = "device_" . $did;
			$device_color = $tab['color_hex_normal'];
			$part1 .= ".{$device_name}:hover,.{$device_name}.active{background-color:#".$device_color."; color: #FFFFFF; text-decoration:none;}";
			$part2 .= '<div class="tab load_on_profile_tab ' . $device_name . '" href="' . $site_url . '/profile/page_device/' . $user_id . '/' . $did . '">' . $tab_label . '</div>';
		}
		$html .= $part1;
		$html .= '</style><div id="user_profile" href="' . $site_url . '/profile/page_user_profile/' . $user_id . '" class="load_on_profile_tab tab">Profile</div>';
		$html .= $part2;
		
		return $html;
		// Mod - Hesk 2012
	}

	function get_calendar_template()//in the class calendar format
	{
		$cell_height = '85px';
		$cell_width = '130px';

		//cal_cell_start changed to cell with festival
		return '		
		   {table_open}<table border="0" cellpadding="5" cellspacing="0" class="grey" >{/table_open}
		
		   {heading_row_start}<tr>{/heading_row_start}
		
		   {heading_previous_cell}<th><a ><div href="{previous_url}" class="cal arrow hflip"></div></a></th>{/heading_previous_cell}
		   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
		   {heading_next_cell}<th><a ><div href="{next_url}" class="cal arrow"></div></a></th>{/heading_next_cell}
		
		   {heading_row_end}</tr>{/heading_row_end}
		
		   {week_row_start}<tr>{/week_row_start}
		   {week_day_cell}<td>{week_day}</td>{/week_day_cell}
		   {week_row_end}</tr>{/week_row_end}
		
		   {cal_row_start}<tr>{/cal_row_start}
		   {cal_cell_start}<td width="' . $cell_width . '" height="' . $cell_height . '" valign="top">{/cal_cell_start}
		
		   {cal_cell_festival}
		   <table border="0" cellpadding="0" cellspacing="0">
		   <tr><td valign="top">{day}</td><td>&nbsp;&nbsp;<span style="color:#FFCC99; font-size:9px">{festival}</span></td></tr>
		   <tr><td>&nbsp;</td><td>{event}</td></tr>
		   </table>		   
		   {/cal_cell_festival}
		   
		   {cal_cell_festival_today}
		   <table border="0" cellpadding="0" cellspacing="0">
		   <tr><td valign="top"><div class="highlight">{day}</div></td><td>&nbsp;&nbsp;<span style="font-size:9px">{festival}</span></td></tr>
		   <tr><td>&nbsp;</td><td>{event}</td></tr>
		   </table>		   
		   {/cal_cell_festival_today}
		
		   {cal_cell_no_festival}
   		   <table border="0" cellpadding="0" cellspacing="0">
		   <tr><td valign="top">{day}</td><td>&nbsp;</td></tr>
		   <tr><td>&nbsp;</td><td>{event}</td></tr>
		   </table>		   
		   {/cal_cell_no_festival}
		   
		   {cal_cell_no_festival_today}
   		   <table border="0" cellpadding="0" cellspacing="0">
		   <tr><td valign="top"><div class="highlight">{day}</div></td><td>&nbsp;</td></tr>
		   <tr><td>&nbsp;</td><td>{event}</td></tr>
		   </table>		   
		   {/cal_cell_no_festival_today}
		
		   {cal_cell_blank}&nbsp;{/cal_cell_blank}
		
		   {cal_cell_end}</td>{/cal_cell_end}
		   {cal_row_end}</tr>{/cal_row_end}
		
		   {table_close}</table>{/table_close}
		';
	}

	function generate_red_dates_calendar_array($year = '', $month = '') {
		if ($year == '') {
			$year = date('Y');
			$month = date('m');
		}
		/*
		 $this->db->where('YEAR(date)', $year)
		 ->where('MONTH(date)', $month)
		 ->where('is_public_hol', '1');

		 $query = $this->db->get('calendar_festival');
		 $result =  $query->result_array();

		 $data = array();
		 foreach($result as $item)
		 $data[date('j', strtotime($item['date']))] = $item['str_name_en'];
		 */
		//get sundays
		$count = strtotime('-1 day', strtotime("{$year}-{$month}-1"));
		$count = strtotime('next Sunday', $count);
		//	$data[date('d', $count)] = 'sunday';

		while (date('m', $count) == $month) {
			$data[date('j', $count)] = 'sunday';
			$count = strtotime('next Sunday', $count);

		}

		return $data;
	}

}
?>