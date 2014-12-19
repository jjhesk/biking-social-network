<?php
class Mod_activity_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->model("init_model");
		$this->load->model("mod_login_model", "login_model");
		$this->load->model("mod_googlemaps_model", "googlemaps_model");
		$this->load->model("mod_facebook_model", "facebook_model");
				
		
		$this->load->library("native_session");
		/*
		$config['appId']=$this->config->item("fb_app_id");
		$config['secret']=$this->config->item("fb_app_secret");	
		$this->load->library("facebook", $config);*/
		//ini_set("upload_max_filesize", "200M");
	}	
	
	public function save_tmp_image($file){
		$filename=rand(10000000, 99999999)."_".$file['name'];
		$dest=$this->init_model->get_FSPATH("upload/".$filename);	
		move_uploaded_file($file['tmp_name'], $dest);
		//move_uploaded_file($file['tmp_name'], "upload/".$filename);
		return $dest;	
	}
	public function set_activity_privacy($data){
		/* BLL
		 * $set_activity_privacy=array(
					"app_id"=>$this->post('app_id'),
					"activity_id"=>$this->db->insert_id(),
					"userinfo"=>$userinfo
			);
		 */
		$privacy=$this->DBget_privacy();
		$this->db->set("privacy", $privacy);
		$this->db->where("activity_id", $data['activity_id']);
		$this->db->update("activity");
		return $this->DBget_activity_data_by_activity_id($data['activity_id']);
	}
	public function bll_home_to_tpl_main(){
		//LV1
		$data=array();		
		if($this->native_session->get("userinfo")){
			$data['userinfo']=$this->native_session->get("userinfo");
		}else{
			echo "activity_model 31 cannot get native_session userinfo";
			
		}
		$data['show_user_logined']=$this->login_model->lv1_get_login();
		$data['content'] = 'page_front_page';
		$data['login_interface'] = $this->init_model->urlwriting("login/show_login");
		return $data;
	}


	
	
	//http://a2.sphotos.ak.fbcdn.net/hphotos-ak-ash3/530876_150950288376077_1369148335_n.jpg
	//http://a2.sphotos.ak.fbcdn.net/hphotos-ak-ash3/530876_150950288376077_1369148335_n.jpg
	//this function should be deprecated
	public function db_set_activity($input2){
		//save the data in activity
		//deprecated
		//$input2={userinfo, comment, full_url, thumb_url, original_url}
		//those 3 url come from get_photo_from_facebook($id)
		
		//get the last record from activity data, 
		$bll['user_inhouse_id']=$input2['userinfo']['user_inhouse_id'];

		$this->db->where("user_inhouse_id", $bll['user_inhouse_id']);	
		$this->db->order_by("last_updated", "desc");	
		$result=$this->db->get("activity_data");
		$result=$result->result_array();
		if(count($result)>0){
			$bll['prev_activity_id']=$result[0]['activity_id'];
		}
		if(!isset($input2['activity_id'])){
			$bll['description']=$input2['comment'];
			$bll['password']="website";
			$bll['mode']="manual";
			//$bll['privacy']=$this->DBget_privacy($input2['app_id'], $input2['userinfo']);
			//then insert the new activity data
			$this->db->set("privacy", "default");
			$this->db->insert('activity_data', $bll);
			//then set the prev_activity_id in last record
			$bll['activity_id']=$this->db->insert_id();
		}else{
			$bll['activity_id']=$input2['activity_id'];
		}		
		
		if(isset($bll['prev_activity_id'])){
			$this->db->set("next_activity_id", $bll['activity_id']);	
			$this->db->where("activity_id", $bll['prev_activity_id']);
			$this->db->update("activity_data");
		}
		
	
		//then insert the activity_photo if the they upload the photo
		if(isset($input2['full_url'])){
		
			//unset the unnesscary bll data
			unset($bll['user_inhouse_id']);	
			unset($bll['prev_activity_id']);	
			unset($bll['description']);	
			unset($bll['password']);	
			unset($bll['mode']);	
			unset($bll['privacy']);
		
			//insert the activity photo
			//$bll['user_id']=$input2['userinfo']['user_inhouse_id'];
			$bll['photo_description']=$input2['comment'];
			if(isset($input2['full_url']))
				$bll['full_url']=$input2['full_url'];
			if(isset($input2['thumb_url']))
				$bll['thumb_url']=$input2['thumb_url'];
			if(isset($input2['original_url']))
				$bll['original_url']=$input2['original_url'];
			if(isset($input2['fbid']))
				$bll['fbid']=$input2['fbid'];
			$this->db->insert('activity_photo', $bll);
		}
		//echo "activity model 80 had been written.";
		/*$friendlist=$this->facebook_model->get_friendlist_from_facebook();
		echo "<br/>friend list:";
		print_r($friendlist);
		*/
		//print_r($input);
	}
	public function bll_get_page_max_draw_summary_by_activity_id($activity_id){
		
		/*var data = google.visualization.arrayToDataTable([

        ['Summary', '',],

        ['Distance:', '33.09 mi',],

        ['Time:', '1:54:49',],

        ['Avg Speed:', '17.3 mph',],

        ['Elevation Gain:', '1085 ft',],

        ['Calories:', '1354 C',],

      ]);
	  "time":"2012-08-27 18:10:28","coordinate_y":"22.41135","coordinate_x":"114.22382","speed":"75"},{"time":"2012-08-27 18:16:28","coordinate_y":"22.37833","coordinate_x":"114.18640","speed":"75"},{"time":"2012-08-27 18:18:28","coordinate_y":"22.42404","coordinate_x":"114.21249","speed":"83"},{"time":"2012-08-27 18:20:28","coordinate_y":"22.44594","coordinate_x":"114.17095","speed":"77"}
	  */
		$result=$this->DBget_activity_data_by_activity_id($activity_id);
		//$result=$result[0];
		if($result!=null){
	  		//$result=$result[0]['coordinates_json'];
			//$result=json_decode($result, true);
			$result2['Summary']='';
			$result2['Distance']=$result['total_distance'].' mi';
			$result2['Time']=$this->get_time_by_minisecond($result['elapse_time']);
			$result2['Avg Speed']=$result['avg_speed'].' mph';
			$result2['Elevation Gain']='0 ft';
			$result2['Calories']=$result['total_calories'].' C';
			
			$result3='[';
			foreach($result2 as $key => $val){
				$result3.="['".$key."', '".$val."'],";
			}
			$result3.=']';  
			return $result3;
		}
	  
	}
	public function get_time_by_minisecond($minisecond){
		//echo "<br/>activity_model 117 ";	
		$second=($minisecond-$minisecond%1000)/1000;
		$hour=round($second/60/60);
		$mins=round(($second-($hour*60*60))/60);
		$second=round($second-($hour*60*60)-($mins*60), 3);
		if($mins<10) $mins="0".$mins;
		if($second<10) $second="0".$second;
		return $hour.":".$mins.":".$second;
	}
	public function DBget_activity_data_by_multi_user_inhouse_id($array_user_inhouse_id, $args=array()){
		/*$sql="select * from activity_data 
			inner join activity_photo on activity_data.activity_id=activity_photo.activity_id
			where 0 ";
		for($i=0; $i<count($array_user_inhouse_id); $i++){
			$sql.=' or user_inhouse_id="'.$array_user_inhouse_id[$i]['user_inhouse_id'].'"';
		}
		$sql.=" order by last_updated desc";
		$result=$this->db->query($sql);
		$result=$result->result_array();
		return $result;*/
		// end time is 0.1434
		
		$sql="select * from activity_data where 0 ";
		for($i=0; $i<count($array_user_inhouse_id); $i++){
			$sql.=' or user_inhouse_id="'.$array_user_inhouse_id[$i]['user_inhouse_id'].'"';
		}
		
		$sql.=" order by last_updated desc";
		if( (isset($args['pagnation']))&&($args['pagnation']!=null) &&($args['pagnation']!='') ){
			$sql.=" limit ".$args['pagnation']['start'].", ".$args['pagnation']['limit'];
		}
		$activity_data=$this->db->query($sql);
		$activity_data=$activity_data->result_array();
		if(count($activity_data)>0){
			for($i=0;$i<count($activity_data);$i++){		
				$this->db->or_where("activity_id", $activity_data[$i]['activity_id']);
			}
			$image=$this->db->get("activity_photo");
			$image=$image->result_array();
			if(count($image)>0){
				//$activity_data=$result;
				$result['array'][0]=$activity_data;
				$result['array'][1]=$image;
				$result['condition_key'][0]="activity_id";
				$result['condition_key'][1]="activity_id";
				$result=$this->init_model->array_outer_join_in_same_key($result, "photo");
				//echo "<br/>mod activity 212 ";
				//print_r($result);
			}else{
				//no photo can be search up
				
				for($i=0;$i<count($activity_data);$i++){
					$activity_data[$i]['photo']=null;
				}
				$result=$activity_data;
			}
			
			return $result;
		}else{
			return null;
		}
		//end time 0.8820
		
	}
	public function DBget_activity_data_by_user_inhouse_id($user_inhouse_id){
		$this->init_model->sensitive_session[]="DBget_activity_data_by_user_inhouse_id(".$user_inhouse_id.")";
		if($this->native_session->get("DBget_activity_data_by_user_inhouse_id(".$user_inhouse_id.")")==null){
			$this->db->where("user_inhouse_id", $user_inhouse_id);
			$this->db->order_by("last_updated", "desc");
			$result=$this->db->get("activity_data");
			$result=$result->result_array(); 
			if(count($result)>0){
				$this->native_session->set("DBget_activity_data_by_user_inhouse_id(".$user_inhouse_id.")", $result);
				return $result;
			}else{
				return null;
			}
		}else{
			return $this->native_session->get("DBget_activity_data_by_user_inhouse_id(".$user_inhouse_id.")");
		}
	}
	public function DBget_4_recent_activities_count_by_user_inhouse_id($user_inhouse_id){
		$sql="select sum(total_distance) as total_distance, 
					 sum(elapse_time) as hours, 
					 count(activity_id) as diaries from activity_data where user_inhouse_id='".$user_inhouse_id."'";
		$result=$this->db->query($sql);
		$result=$result->result_array();
		if(count($result)>0){
			//echo "<br/>mod activity model 216 ".$user_inhouse_id;
			$result[0]['hours']=number_format(floatval($result[0]['hours'])/60, 1);
			$activity_data=$this->DBget_activity_data_by_user_inhouse_id($user_inhouse_id);
			$sql="select count(activity_id) as photo_count from activity_photo where 0 "; 
			for($i=0;$i<count($activity_data);$i++){
				$sql.=" or activity_id='".$activity_data[$i]['activity_id']."'";
			}
			$photo_count=$this->db->query($sql);
			$photo_count=$photo_count->result_array();
			$result[0]['photo_taken']=$photo_count[0]['photo_count'];
			$result[0]['total_distance']=number_format($result[0]['total_distance'], 1);
			//return intval($result[0])<0?"0":intval($result[0]);
			return $result[0];
		}else{
			return null;
		}		 
	}

	public function DBget_activity_data_by_activity_id($activity_id){
		$this->init_model->sensitive_session[]="DBget_activity_data_by_activity_id(".$activity_id.")";
		if($this->native_session->get("DBget_activity_data_by_activity_id(".$activity_id.")")==null){
			$this->db->where("activity_id", $activity_id);
			$result=$this->db->get("activity_data");
			$result=$result->result_array(); 
			if(count($result)>0){
				$this->db->where("activity_id", $activity_id);
				$image=$this->db->get("activity_photo");
				$image=$image->result_array();
				$result[0]['photo']=$image;
				$this->native_session->set("DBget_activity_data_by_activity_id(".$activity_id.")", $result[0]);
				return $result[0];
			}else{
				return null;
			}
		}else{
			return $this->native_session->get("DBget_activity_data_by_activity_id(".$activity_id.")");
		}
	}
	public function get_description_from_coordinates($activity, $apps_name, $user_name, $coordinates, $needLocation=true){
		//BLL
		//echo "<br/>activity model 193 ";
		//print_r($activity);
		if( (isset($activity))&&($activity!=null)&&($activity['mode']!='auto')&&($activity['description']!='') ){
			$description=$activity['description'];
		}else{
				
			$coordinates = json_decode($coordinates, true);
			//echo "<br/>activity model 182 ";
			//print_r($coordinates);
			if($app_name="PetNfans"){
				//From user's perspective, PetNfans does not contain activity, therefore the upload title is changed
				$description=$user_name." uploaded a new photo to ".$apps_name."";
			}else{
				//For now, only iBikeFans activity will be on else. Change here when more theme are added
				$description=$user_name." created a new ".$apps_name." record";
			}
			if($needLocation==true){
				$this->load->model("mod_googlemaps_model", "googlemaps_model");
				$location=$this->googlemaps_model->get_location_by_latitude_longitude_from_google($coordinates);
				if($location!=null){
					$description.=" in ".$location;
					$description.=" at ".date("F j, Y");
				}
			}else{
				$description.=". You can click here to review his/ her story.";
			}
			 
		}
			//$description.=" at ".date("F j, Y").". You can click here to review his story.";
		return $description;
	}
	
	public function DBget_activity_photo_by_activity_id($data){
		//$data={"activity_id"}
		//echo "<br/> activity model 221 ";
		//print_r($data);
		/*
		if(is_array($data)){
			for($i=0;$i<count($data);$i++){
				$this->db->or_where("activity_id", $data[$i]['activity_id']);
			}
		}else{
			$this->db->where("activity_id", $data);
		}
		$result=$this->db->get("activity_photo");
		$result=$result->result_array();
		echo "<br/>activity model 229 ";
		print_r($result);
		if(count($result)>0){
			if( (is_array($data))&&(count($result)>1) ){
				return $result;
			}else{
				return $result[0];
			}
		}else {
			return null;
		}
		 * */
	}
	public function DBget_get_open_graph_object($activity_id){
		//BLL
		$activity=$this->DBget_activity_data_by_activity_id($activity_id);	
		if($activity!=null){
			/*$result['open_graph_object_property']=array(
				'self_url'=>'og:url',
				'title'=>'og:title',
				'image'=>'og:image',
				'total_distance'=>'fansliving:total_distance',
				'elapse_time'=>'fansliving:elapse_time',
				'total_calories'=>'fansliving:total_calories',
				'max_speed'=>'fansliving:max_speed',
				'avg_speed'=>'fansliving:avg_speed',
				'max_heart_rate'=>'fansliving:max_heart_rate',
				'avg_heart_rate'=>'fansliving:avg_heart_rate',
				'avg_temperature'=>'fansliving:avg_temperature',
				'description'=>'og:description'
			);*/
			$result['open_graph_object_property']=array(
				'self_url'=>'og:url',
				'title'=>'og:title',
				'image'=>'og:image',
				'description'=>'og:description'
			);
			$image=$this->DBget_activity_photo_by_activity_id($activity_id);
			//echo "<br/>activity model 254";
			//print_r($image);
			if($image==null){
				$image=base_url()."images/logo_ibike.png";
			}else{
				$image=$image['thumb_url'];
			}
			$app_name=$this->config->item("website_name");
			//print_r($activity);
			//$app_data=$this->DBget_apps_data_by_apps_id($activity['app_id']);
			$userinfo=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($activity['user_inhouse_id']);
			/*if(isset($app_data['apps_icon'])){
				$image=$app_data['apps_icon'];
			}*/
			
			$description=$this->get_description_from_coordinates($activity, $app_name, $userinfo['nickname'], $activity['coordinates_json'], false);
		
			$result['open_graph_object_data']=array(
				'self_url'=>site_url()."loginedin/open_graph_object/".$activity_id,
				'title'=>$activity['title'],
				'image'=>$image,
				'description'=>$description
			);
			$result['returnurl']=site_url()."loginedin/activity/".$activity_id;
			return $result;
			//http://www.fansliving.com/index.php/profile/view_activity/1/1/2
		}else{
			return null;
		}
		
	}
	
	public function DBget_user_last_app_activity($data){
		//$data=array("user_inhouse_id", "app_id", "new_activity_id"="null" //new_activity_id for exception that does not need.);
		$this->db->where("user_id", $data['user_inhouse_id']);
		$this->db->where("app_id", $data['app_id']);
		$device=$this->db->get("app_users_data");
		$device=$device->result_array();
		$sql="select * from activity_data where 1 and (";
		if(count($device)>0){
			$sql.="app_users_data_id='".$device[0]['app_users_data_id']."' or ";
		}
		$sql.=" (user_inhouse_id='".mysql_real_escape_string($data['user_inhouse_id'])."' and app_id='".mysql_real_escape_string($data['app_id'])."')) order by last_updated desc";
		
		//$result=$this->db->get("activity_data");
		//$result=$this->db->query("select * from activity_data  where app_users_data_id='79' order by last_updated desc");
		$result=$this->db->query($sql);
		$result=$result->result_array();
		
		//echo "<br/> activity model 310 ";
		//print_r($result);
		if(count($result)>0){
			if( (isset($data['new_activity_id']))&&($data['new_activity_id']==$result[0]['activity_id']) ){
				//echo "<br/> activity model 321 ";
				return null;
			}else{
				//echo "<br/> activity model 324 ";
				return $result;
			}
		}else{
			//echo "<br/> activity model 328 ";
			return null;
		}
	}
	
	public function get_user_most_recent_activity_id($user_id) {
		$this -> db -> select('activity_id, user_inhouse_id, last_updated');
		$query = $this -> db -> get_where('activity_data', array('user_inhouse_id' => $user_id));
		$data = $query -> result_array();
		if(count($data)>0){
			$most_recent_time = strtotime($data[0]['last_updated']);
			$most_recent_activity_id = $data[0]['activity_id'];
			foreach ($data as $key => $arr) {
				if (strtotime($arr['last_updated']) > $most_recent_time) {
					$most_recent_time = strtotime($arr['last_updated']);
					$most_recent_activity_id = $arr['activity_id'];
				}
			}
			return $most_recent_activity_id;
		}else{
			return null;
		}
	}
	
	public function get_user_activity_record($activity_id) {
		$this -> db -> select('activity_id, user_inhouse_id, title, description, mode, avg_speed, max_speed, avg_temperature, avg_heart_rate, max_heart_rate, total_distance, elapse_time, elapse_time_sec, total_calories');
		$query = $this -> db -> get_where('activity_data', array('activity_id' => $activity_id));
		$data = $query -> result_array();
		if(count($data)>0)
			return $data[0];
		else{
			return null;
		}
	}
	
	
	
	
	public function get_user_single_record($activity_id, $record_name) {
		$this -> db -> select('activity_id, user_inhouse_id, '.$record_name);
		$this->db->order_by("last_updated", "desc");
		$query = $this -> db -> get_where('activity_data', array('activity_id' => $activity_id));
		$data = $query -> result_array();
		
		if(count($data)>0)
			return $data[0][$record_name];
		else{
			return null;
		}
	}

	public function get_feature_friends($user_id, $number_of_friends) {
		
		for ($i=0; $i < $number_of_friends; $i++) { 
			$this -> db -> select('user_inhouse_id, firstname, lastname, profile_image');
			$query = $this -> db -> get_where('user_inhouse_data', array('user_inhouse_id' => 303+$i));
			$data = $query -> result_array();
			//echo "<br/> activity model 162";
			//print_r($data);
			$output[$i]['id'] = $data[0]['user_inhouse_id'];
			$output[$i]['name']=$data[0]['firstname']. ' ' . $data[0]['lastname'];
			$output[$i]['fans']=rand(1, 1000);
			$output[$i]['image_url']=$data[0]['profile_image'];
		}
		
		return $output;
		
		/*
			$output[0]['user']='test';
			$output[0]['fans']='10';
			return $output;
		 * 
		 */
	}
	
	public function get_activity_from_password($password) {
		$this -> db -> select('activity_id, user_inhouse_id, password');
		$query = $this -> db -> get_where('activity_data', array('password' => $password));
		$data = $query -> result_array();
		
		// If no activity, create one
		
		
		if (count($data)==0) {
			return null;
		} else {
			return $data[0];
		}
	}
	
	public function create_new_activity($user_id, $app_id, $password) {
		
		$last_activity_id = $this->get_user_most_recent_activity_id($user_id);
		$userinfo=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($user_id);
		// Retrieve data
		$data = array(
			'user_inhouse_id' => $user_id,
			'app_id' => $app_id,
			'password' => $password,
			'title' => '(Activity Title)',
			'description' => '(Activity Description)',
			'mode' => 'manual',
			'avg_speed' => '0',
			'avg_temperature' => '0',
			'avg_heart_rate' => '60',
			'total_distance' => '0',
			'elapse_time' => '000000',
			'elapse_time_sec' => '0',
			'max_speed' => '0',
			'max_heart_rate' => '60',
			'total_calories' => '0',
			'privacy'=>$this->DBget_privacy(),
			'coordinates_json' => '[{"time":"0000-00-00 00:00:00","coordinate_y":"0","coordinate_x":"0","speed":"0"}]',
			'custom_data_json' => '[{"time":"0000-00-00 00:00:00","heart_rate":"60","temperature":"0","elevation_gain":"0","distance":"0","calories":"0"}',
			'prev_activity_id' => $last_activity_id,
			'next_activity_id' => NULL);
		
		// Create new row
		$this->db->set("privacy", "default");
		$this->db->insert('activity_data', $data);
		$activity_id = $this->get_user_most_recent_activity_id($user_id);
	
		// Update node in previous activity
		if ($last_activity_id) {
			$this->db->set('next_activity_id', $activity_id);
			$this->db->where('activity_id', $last_activity_id);
			$this->db->update('activity_data');
		}
		
		return $activity_id;
	}
	
	
	public function get_number_of_activities_from_app_id($user_id, $app_id) {
		$this -> db -> select('activity_id');
		$query = $this -> db -> get_where('activity_data', array('app_id' => $app_id, 'user_inhouse_id' =>$user_id));
		$data = $query -> result_array();
		
		return count($data);
	}

	public function get_user_id_from_activity_id($activity_id) {
		$this -> db -> select('user_inhouse_id');
		$query = $this -> db -> get_where('activity_data', array('activity_id' =>$activity_id));
		$data = $query -> result_array();
		
		if (count($data)>0)
			return $data[0]['user_inhouse_id'];
		else {
			return null;
		}
	}
	
	function check_if_activity_has_ended($activity_id) {
		//DAL
		$this -> db -> select('has_ended');
		$query = $this -> db -> get_where('activity_data', array('activity_id' => $activity_id));
		$data = $query -> result_array();
		
		if (count($data)>0) {
			if ($data[0]['has_ended']!=1) {
				return false;
			} else {
				return true; 
			}
		}
	}
	public function DBget_apps_data_by_apps_id($app_id){
		//DAL	
		$this->db->where("app_id", $app_id);
		$result=$this->db->get("app_data");
		$result=$result->result_array();
		if(count($result)>0){
			return $result[0];
		}else{
			return null;
		}
	}
	public function DBget_app_users_by_app_id_and_user_id($app_id, $user_id){
		//DAL	
		$this->db->where("app_id", $app_id);
		$this->db->where("user_id", $user_id);
		$result=$this->db->get("app_users");
		$result=$result->result_array();
		if(count($result)>0){
			return $result[0];
		}else{
			return null;
		}
	}
	public function api_output_template($template_name, $data){
		/*$data={
			"template_name"=>"friend_list",
			"array"=>array() 
		}*/
		//echo "<br/>activity model 481";
		//print_r($data);
		switch($template_name){
			case "friend_list":
			case "nearby_list":
			case "keep_track":
			case "lost_pet":
			case "leaderboard":
			case "pet_list":
				//echo "<br/>activity model 483 ".count($data);
				//print_r($data[0]);
				//unset($data['template_name']);
				$result=array();
				for($i=0;$i<count($data);$i++){
					//echo "<br/>activity 503 ";	
					//print_r($data[$i]);
					//echo $data[$i]['custom_data_json'];
					$custom_data_json=json_decode($data[$i]['custom_data_json'], true);
					//echo "<br/>activity model 484";
					//print_r($custom_data_json);
					
					$result[$i]['line_1']=$custom_data_json[0]['Age'].", owned by ".$data[$i]['nickname'];
					$result[$i]['line_2']=$data[$i]['name'];
					$result[$i]['image1']=$data[$i]['image'];
					//$result[$i]['image1']=$custom_data_json[0]['image'];
					$result[$i]['image2']="";
					if( (isset($data[$i]['email']))&&($data[$i]['email']!='') )
						$result[$i]['email']=$data[$i]['email'];
					if( (isset($data[$i]['phone']))&&($data[$i]['phone']!='') )
						$result[$i]['phone']=$data[$i]['phone'];
					if( (isset($data[$i]['user_inhouse_id']))&&($data[$i]['user_inhouse_id']!='') )
						$result[$i]['user_inhouse_id']=$data[$i]['user_inhouse_id'];
					if( (isset($data[$i]['user_id']))&&($data[$i]['user_id']!='') )
						$result[$i]['user_id']=$data[$i]['user_id'];
					if( (isset($data[$i]['app_users_data_id']))&&($data[$i]['app_users_data_id']!='') )
						$result[$i]['app_users_data_id']=$data[$i]['app_users_data_id'];
					if( (isset($data[$i]['is_lost']))&&($data[$i]['is_lost']!='') )
						$result[$i]['is_lost']=$data[$i]['is_lost'];
					if( (isset($data[$i]['bluetooth_device_uuid']))&&($data[$i]['bluetooth_device_uuid']!='') )
						$result[$i]['bluetooth_device_uuid']=$data[$i]['bluetooth_device_uuid'];
					if( (isset($data[$i]['request']))&&($data[$i]['request']!='') )
						$result[$i]['request']=$data[$i]['request'];
					if($template_name=="leaderboard"){
						$result[$i]['right_line']="Walked for 15.6km";
					}
					$result[$i]['description']=$data[$i]['description'];
					$result[$i]['custom_data_json']=$data[$i]['custom_data_json'];
				}
				//echo "<br/> activity model 508 ";
				//print_r($result);
				return json_encode($result);
			break;
			case "breed_list":
				return json_encode($result);
			break; 
			/*case "pet_list":
				$result[$i]['line_1']=$custom_data_json[0]['Age'].", owned by ".$data[$i]['nickname'];
				$result[$i]['line_2']=$data[$i]['name'];
				$result[$i]['image1']=$data[$i]['image'];
				$result[$i]['description']=$data[$i]['description'];
				$result[$i]['custom_data_json']=$data[$i]['custom_data_json'];
				if( (isset($data[$i]['is_lost']))&&($data[$i]['is_lost']!='') )
						$result[$i]['is_lost']=$data[$i]['is_lost'];
				if( (isset($data[$i]['bluetooth_device_uuid']))&&($data[$i]['bluetooth_device_uuid']!='') )
						$result[$i]['bluetooth_device_uuid']=$data[$i]['bluetooth_device_uuid'];
				if( (isset($data[$i]['user_id']))&&($data[$i]['user_id']!='') )
						$result[$i]['user_id']=$data[$i]['user_id'];
			break;*/
		}
	}
	
	public function DBget_api_output($post){
		//BLL LV1
		$this->load->model("init_model");
		
		//echo $post['request_type'];
		switch($post['request_type']){
			case "friend_list":
				return $this->api_get_friend_list($post);
			break;
			case "nearby_list":
				return $this->api_get_nearby_list($post);
			break;
			case "keep_track":
				return $this->api_get_keep_track($post);
			break;
			case "lost_pet":
				return $this->api_get_lost_pet($post);
			break;
			case "breed_list":
				$this->load->model('petnfans_model');
				return $this->petnfans_model->get_breed_list();
			break;
			case "pet_list":
				return $this->api_get_pet_list($post);
			break;
			/*case "leaderboard":
				return $this->api_get_leaderboard($post);
			break;*/
		}
	}
	public function api_get_pet_list($post){
		//LV2
		$device=$this->db->get("app_users_data");
		$device=$device->result_array();
		if(count($device)>0){
			$user_inhouse_data=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($device);	
			$result['array'][0]=$device;
			$result['array'][1]=$user_inhouse_data;
			$result['condition_key'][0]="user_id";
			$result['condition_key'][1]="user_inhouse_id";
			$result=$this->init_model->array_inner_join_in_same_key($result);
			return $result;
		}else{
			return null;
		}
	}
	
	public function api_get_lost_pet($post){
				
				if( (isset($post['request_key']))&&($post['request_key']!='') ){		
					$bluetooth_device_uuid=json_decode($post['request_key'], true);
					//echo "<br/>activity_model 642 ";
					//print_r($bluetooth_device_id);
					$bluetooth_device_uuid=$bluetooth_device_uuid[0]['bluetooth_device_uuid'];
					$lost_app_users_data=$this->DBget_app_users_data_by_bluetooth_device_uuid($bluetooth_device_uuid);
				}else{
					$lost_app_users_data=$this->DBget_lost_pet($post['app_id']);
				}
				//print_r($bluetooth_device_id);
				//$bluetooth_device_id=$bluetooth_device_id[0]['bluetooth_device_id'];
				//$bluetooth_device_id['multiple_search']=null;
				if(count($lost_app_users_data)>0){
					//echo "<br/>activity model 674 ";
					//print_r($app_users_data);
					for($i=0;$i<count($lost_app_users_data);$i++){
						$lost_app_users_data[$i]['user_inhouse_id']=$lost_app_users_data[$i]['user_id'];
					}
					//$app_users_data['user_inhouse_id']=$lost_app_users_data['user_id'];
					$app_device_user_inhouse_data=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($lost_app_users_data);
					//print_r($app_device_user_inhouse_data);
					//print_r($lost_app_users_data);
					$result['array'][0]=$lost_app_users_data;
					$result['array'][1]=$app_device_user_inhouse_data;
					$result['condition_key'][0]="user_id";
					$result['condition_key'][1]="user_inhouse_id";
					$result=$this->init_model->array_inner_join_in_same_key($result);
					//echo "<br/>activity model 594 ";
					//print_r($result);
					return $result;
				}else{
					return "false";
				}
		
	}
	public function api_get_leaderboard($post){
		if(isset($post['request_key'])){
			$app_id=json_decode($post['request_key'], true);
			//echo "<br/>activity model 564 ";
			$app_id=$app_id[0]["app_id"];
			//print_r($app_id);
			$this->load->model("comments_model");
			$comments=$this->comments_model->DBget_discussion_comments_by_source_id($app_id);
			//echo "<br/>activity model 568 ";
			//print_r($comments);
			if(count($comments)>0){
				for($i=0;$i<count($comments);$i++){
					//for DBget_user_inhouse_info_by_user_inhouse_id
					$comments[$i]['user_inhouse_id']=$comments[$i]['comment_user_id'];
					//DBget_app_users_data_by_user_inhouse_id
					$comments[$i]['user_id']=$comments[$i]['comment_user_id'];
				}
				$user_inhouse_data=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($comments);
				$app_users_data=$this->login_model->DBget_app_users_data_by_user_inhouse_id($comments);
				//echo "<br/>activity model 580 ";
				//print_r($app_users_data);
				
				$result['array'][0]=$app_users_data;
				$result['array'][1]=$user_inhouse_data;
				$result['array'][2]=$comments;
				$result['condition_key'][0]="user_id";
				$result['condition_key'][1]="user_inhouse_id";
				$result['condition_key'][2]="comment_user_id";
				$result=$this->init_model->array_inner_join_in_same_key($result);	
				//echo "<br/>activity model 585 ";
				//print_r($result);	
				return $result;
			}
			return "false";
		
			/*$comments=$this->comments_model->get_comments_for_discussion($post['user_inhouse_id'], $app_id);
			echo "<br/>activity model 568 ";
			print_r($comments);
			echo "<br/>===============<br/>";
			
			$like_dislikes=$this->comments_model->get_discussion_likes_dislikes($app_id);
			echo "<br/>activity model 573 ";
			print_r($like_dislikes);
			echo "<br/>===============<br/>";*/
			
		}
	}
	
	public function api_get_keep_track($post){
		$user_id="";
		$post=$this->bll_user_id_exchange($post);
		$user_id=$post['user_id'];
		if($user_id!=''){
			$app_users=$this->login_model->DBget_app_users_by_user_id($user_id);
			if(count($app_users)>0){
				$keep_track=array();
				if($app_users[0]['keep_track']!=''){
					//echo "<br/>activity_model 566 ";
					//echo $app_users[0]['keep_track'];
					//print_r(json_decode('{"0":"3"}', true));
					$keep_track_list=json_decode($app_users[0]['keep_track'], true);
					//print_r($keep_track_list);
					for($i=0;$i<count($keep_track_list[0]);$i++){
						$keep_track[$i]['app_users_data_id']=$keep_track_list[0][$i];
					}
					$app_users_data=$this->login_model->DBget_app_users_data_by_app_users_data_id($keep_track);
					if(count($app_users_data)>0){
						for($i=0;$i<count($app_users_data);$i++){
							$app_users_data[$i]['user_inhouse_id']=$app_users_data[$i]['user_id'];
						}
						//print_r($app_users_data);
						$user_inhouse_data=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($app_users_data);
						//echo "<br/>activity model 581 ";
						//print_r($user_inhouse_data);
						$result['array'][0]=$app_users_data;
						$result['array'][1]=$user_inhouse_data;
						$result['condition_key'][0]="user_id";
						$result['condition_key'][1]="user_inhouse_id";
						$result=$this->init_model->array_inner_join_in_same_key($result);
						//print_r($result);
						return $result;
						
					}
					//echo "<br/>activity_model 529 ";
					//print_r($result);
				}
			}
		}
		return "false";
		
	}
	public function old_api_get_friend_list($post){
		//BLL LV2
			$user_id="";
			$post=$this->bll_user_id_exchange($post);
			$user_id=$post['user_id'];
				$friend_list=$this->login_model->DBget_friend_list_by_user_inhouse_id($user_id, true);
				
				if(count($friend_list)>0){
					for($i=0;$i<count($friend_list);$i++){
						if($friend_list[$i]['object_user_id']!=$post['user_id']){
							$friend_list[$i]['user_id']=$friend_list[$i]['object_user_id'];
							$friend_list[$i]['user_inhouse_id']=$friend_list[$i]['object_user_id'];
						}
						if($friend_list[$i]['subject_user_id']!=$post['user_id']){
							$friend_list[$i]['user_id']=$friend_list[$i]['subject_user_id'];
							$friend_list[$i]['user_inhouse_id']=$friend_list[$i]['subject_user_id'];
						}
					}
					//echo "<br/>activity_model 518 ";
					//print_r($friend_list);	
					//$friend_app_users=$this->login_model->DBget_app_users_by_user_inhouse_id($friend_list);
					$friend_list_device=$this->login_model->DBget_app_users_data_by_user_inhouse_id($friend_list);
					$friend_list_inhouse_data=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($friend_list);
					
					//echo "<br/>activity model 539 ";
					//print_r($friend_list);
					//$result['array'][0]=$friend_list;
					$result['array'][0]=$friend_list_inhouse_data;
					$result['array'][1]=$friend_list_device;
					//$result['condition_key'][0]="object_user_id";
					$result['condition_key'][0]="user_inhouse_id";
					$result['condition_key'][1]="user_id";
					$result=$this->init_model->array_inner_join_in_same_key($result);
					//echo "<br/> activity_model 696 ";
					//print_r($result);
					
					for($i=0;$i<count($friend_list);$i++){
						for($i2=0;$i2<count($result);$i2++){
							//echo "<br/> activity_model 687 ".$result[$i2]["user_inhouse_id"]." "
								//.$friend_list[$i]['subject_user_id']." ".$friend_list[$i]['object_user_id'];
							if( ($result[$i2]["user_inhouse_id"]==$friend_list[$i]['subject_user_id'])
								||($result[$i2]["user_inhouse_id"]==$friend_list[$i]['object_user_id']) )
							{
								$result[$i2]['request']=$friend_list[$i]['request'];
							}	
						}
					}
					
					//echo "<br/>activity_model 529 ";
					//print_r($result);
					return $result;
				}else{
					return "false";
				}
	}
	public function api_get_friend_list($post){
		//BLL LV2
			$user_id="";
			$post=$this->bll_user_id_exchange($post);
			$user_id=$post['user_id'];
				$friend_list=$this->login_model->bll_get_friend_list_by_user_inhouse_id($user_id, true);
				//echo "<br/> activity_model 744 ".count($friend_list);
				//print_r($friend_list);
				if(count($friend_list)>0){
					/*for($i=0;$i<count($friend_list);$i++){
						if($friend_list[$i]!=$post['user_id']){
							$friend_list[$i]['user_id']=$friend_list[$i];
							$friend_list[$i]['user_inhouse_id']=$friend_list[$i];
						}
					}*/
					//echo "<br/>activity_model 518  friend_list:<br/>";
					//print_r($friend_list);	
					
					$friend_app_users=$this->login_model->DBget_app_users_by_user_id_with_app_id($friend_list, $post['app_id']);
					//echo "<br/>activity_model 748  friend_app_users:".count($friend_app_users);
					//print_r($friend_app_users);	
					for($i=0;$i<count($friend_app_users);$i++){
						$friend_app_users[$i]['user_inhouse_id']=$friend_app_users[$i]['user_id'];
					}
					
					$friend_list_inhouse_data=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($friend_app_users);
					$result['array'][0]=$friend_app_users;
					$result['array'][1]=$friend_list_inhouse_data;
					//$result['condition_key'][0]="object_user_id";
					$result['condition_key'][0]="user_id";
					$result['condition_key'][1]="user_inhouse_id";
					$friend_inhouse_data=$this->init_model->array_inner_join_in_same_key($result);
					
					//echo "<br/>activity_model 759  friend_inhouse_data:".count($friend_inhouse_data);
					//print_r($friend_inhouse_data);	
					$friend_list_device=$this->login_model->DBget_app_users_data_by_user_inhouse_id($friend_list);
					
					//echo "<br/>activity model 539 count:".count($friend_inhouse_data);
					//print_r($friend_list);
					//$result['array'][0]=$friend_list;
					$result['array'][0]=$friend_inhouse_data;
					$result['array'][1]=$friend_list_device;
					//$result['condition_key'][0]="object_user_id";
					$result['condition_key'][0]="user_inhouse_id";
					$result['condition_key'][1]="user_id";
					$result=$this->init_model->array_outer_join_in_same_key($result);
					
					
					
					//echo "<br/>activity_model 777  result:<br/>";
					//print_r($result);	
					//echo "<br/> activity_model 696 ";
					//print_r($result);
					
					//fix the data empty hole when the user does not have pet...
					for($i=0;$i<count($friend_list);$i++){
						for($i2=0;$i2<count($result);$i2++){
							//echo "<br/> activity_model 687 ".$result[$i2]["user_inhouse_id"]." "
								//.$friend_list[$i]['subject_user_id']." ".$friend_list[$i]['object_user_id'];
							if( ($result[$i2]["user_inhouse_id"]==$friend_list[$i]['user_id']) ){
								$result[$i2]['request']=$friend_list[$i]['request'];
							}	
							if(!isset($result[$i2]['custom_data_json'])){
								$result[$i2]['custom_data_json']=" ";
							}
							if(!isset($result[$i2]['name'])){
								$result[$i2]['name']=$result[$i2]['nickname'];
							}
							if(!isset($result[$i2]['description'])){
								$result[$i2]['description']=" ";
							}
							if(!isset($result[$i2]['image'])){
								$result[$i2]['image']=$result[$i2]['profile_image'];
							}
							if(!isset($result[$i2]['app_users_data_id'])){
								$result[$i2]['app_users_data_id']=$post['app_id'];
							}
							if(!isset($result[$i2]['is_lost'])){
								$result[$i2]['is_lost']=0; 
							}
							if(!isset($result[$i2]['bluetooth_device_uid'])){
								$result[$i2]['bluetooth_device_uid']=" ";
							}
							
							//echo "<br/> activity_model 792 <br/>";
						}
							
					}
					
					//echo "<br/>activity_model 529 count:".count($result);
					//print_r($result);
					return $result;
				}else{
					return "false";
				}
	}
	public function api_get_nearby_list($post){
		//BLL LV2
		//echo "<br/>activity model 577 ";
				$bluetooth_device_uuid=json_decode($post['request_key'], true);
					//print_r($bluetooth_device_id);
				$bluetooth_device_uuid=$bluetooth_device_uuid[0]['bluetooth_device_uuid'];
				
				//$bluetooth_device_id['multiple_search']=null;
				$app_users_data=$this->login_model->DBget_app_users_data_by_bluetooth_device_id($bluetooth_device_uuid);
				if(count($app_users_data)>0){
					//echo "<br/>activity model 674 ";
					//print_r($app_users_data);
					/*for($i=0;$i<count($app_users_data);$i++){
						$app_users_data[$i]['user_inhouse_id']=$app_users_data[$i]['user_id'];
					}*/
					$app_users_data['user_inhouse_id']=$app_users_data['user_id'];
					$app_device_user_inhouse_data=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($app_users_data['user_id']);
					//print_r($app_device_user_inhouse_data);
					
					$result['array'][0]=array($app_users_data);
					$result['array'][1]=array($app_device_user_inhouse_data);
					$result['condition_key'][0]="user_inhouse_id";
					$result['condition_key'][1]="user_inhouse_id";
					$result=$this->init_model->array_inner_join_in_same_key($result);
					
					//auto report to owner if someone found it.
					//echo "<br/> activity model 943 ";
					//print_r($post);
					//print_r($result);
					//echo "::".$result['is_lost'].":".$result[0]['is_lost'];
					if( ($result[0]['is_lost']=='1')&&($result[0]['user_id']!=$post['user_inhouse_id']) ){
							$auto_report_setting=array(
									"app_id"=>$post['app_id'],
									"user_inhouse_id"=>$post['user_inhouse_id'], //the reporter
								 	"token"=>"",
								 	"table"=>"activity_data",
								 	"mode"=>"pet_found",
								 	"privacy"=>"no",
									"bluetooth_device_uuid"=>$result[0]['bluetooth_device_uuid'],
									"custom_data_json"=>$result[0]['custom_data_json'],
							);
							$this->db->where("app_id", $post['app_id']);
							$this->db->where("user_inhouse_id", $post['user_inhouse_id']);
							$this->db->where("mode", "pet_found");
							$this->db->where("app_users_data_id", $app_users_data['app_users_data_id']);	
							$this->db->order_by("last_updated", "desc");
							$last_pet_found_activity=$this->db->get("activity_data");
							$last_pet_found_activity=$last_pet_found_activity->result_array();
							if(count($last_pet_found_activity)==0){
								//echo "<br/> activity model 987 insert new record";
								$auto_report_setting['new_record']="yes";	
							}else{
								$last_pet_found_activity_date=date("Y-m-d", strtotime($last_pet_found_activity[0]['last_updated']));
								if($last_pet_found_activity_date!=date("Y-m-d")){
									//echo "<br/> activity model 987 insert new record, allow insert in next date ".$last_pet_found_activity_date.":".date("Y-m-d");
									$auto_report_setting['new_record']="yes";	
								}else{
									//echo "<br/> activity model 987 same date with should update record";
									$auto_report_setting['app_users_data_id']=$last_pet_found_activity[0]['app_users_data_id'];
								}
							}
							if( (isset($post['coordinates_json']))&&($post['coordinates_json']!='') ){
								$auto_report_setting["coordinates_json"]=$post['coordinates_json'];
							}
							$this->DBset_api_input($auto_report_setting);
						
					}
					
					//echo "<br/>activity model 594 ";
					//print_r($result);
					return $result;
				}else{
					return "false";
				}
	}
	
	public function DBget_lost_pet($app_id){
		$now=date("Y-m-d h:m:s", strtotime("+1 day"));
		$last_month=date("Y-m-d h:m:s", strtotime("-1 month"));
		$sql="select * from app_users_data where is_lost='1' and  (";	
		if(is_array($app_id)){
			for($i=0;$i<count($app_id);$i++){
				if($i>=1) $sql.=" or ";
				$sql.="app_id='".$app_id[$i]['app_id']."'";
			}			
		}else{
			$sql.="app_id='".$app_id."'";
		}
		$sql.=") and last_updated between date('".$last_month."') and date('".$now."')";
		$result=$this->db->query($sql);
		$result=$result->result_array();
		if(count($result)>0){
			return $result;
		}else{
			return null;
		}
	}
	
	public function bll_user_id_exchange($post){
		//BLL LV3
		/*if( (!isset($post['user_id']))&&(isset($post['user_inhouse_id'])) ){
			$user_id=$post['user_inhouse_id'];
			$post['user_id']=$user_id;
		}else if( (!isset($post['user_inhouse_id']))&&(isset($post['user_id'])) ){
			$user_id=$post['user_id'];
			$post['user_inhouse_id']=$user_id;
		}*/
		if( (isset($post['user_id']))&&($post['user_id']!='') ){
			$post['user_inhouse_id']=$post['user_id'];
		}else if( (isset($post['user_inhouse_id']))&&($post['user_inhouse_id']!='') ){
			$post['user_id']=$post['user_inhouse_id'];
		}
		//echo "<br/> activity model 876 ";
		//print_r($post);
		return $post;
	}
	public function DBget_app_users_data_by_bluetooth_device_uuid($data){
		//$data
		if(is_array($data)){
			for($i=0;$i<count($data);$i++){
				$this->db->or_where("bluetooth_device_uuid", $data[$i]['bluetooth_device_uuid']);
			}			
		}else{
			$this->db->where("bluetooth_device_uuid", $data);
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
		//$data
			if(is_array($data)){
				for($i=0;$i<count($data);$i++){
					$this->db->or_where("app_users_data_id", $data[$i]['app_users_data_id']);
				}			
				$result=$this->db->get("app_users_data");
				$result=$result->result_array();
				if(count($result)>0){
					return $result;
				}else{
					return null;
				}
			}else{
				$this->init_model->sensitive_session[]="DBget_app_users_data_by_app_users_data_id($data)";
				if($this->native_session->get("DBget_app_users_data_by_app_users_data_id($data)")==null){
					$this->db->where("app_users_data_id", $data);
					$result=$this->db->get("app_users_data");
					$result=$result->result_array();
					if(count($result)>0){
						$this->native_session->set("DBget_app_users_data_by_app_users_data_id($data)", $result[0]);
						return $result[0];
					}else{
						return null;
					}
				}else{
					return $this->native_session->get("DBget_app_users_data_by_app_users_data_id($data)");
				}
			}
		
	}
	
	public function DBset_pet_reward($post, $device){
		//DAL
		//update device set reward in custom_data_json
					//echo "<br/>activity model 1169 ";
					if( (isset($post['custom_data_json']))&&($post['custom_data_json']!='') ){
						//echo "<br/>activity model 1173 ";
						$custom_data_json=json_decode($post['custom_data_json'], true);
						//print_r($custom_data_json);
						//echo $post['custom_data_json']['reward'];
						if( (isset($custom_data_json[0]['reward']))&&($custom_data_json[0]['reward']!='') ){
								
							//echo "<br/>activity model 1176 ";
							$device_custom_data_json=json_decode($device['custom_data_json'], true);
							//$device_custom_data_json=$device_custom_data_json[0];
							//print_r($device_custom_data_json);
							$device_custom_data_json[0]['Reward']=$custom_data_json[0]['reward'];
							$device_custom_data_json=json_encode($device_custom_data_json);
							//echo "<br/>activity model 1109 ".$device_custom_data_json;
							$this->db->set("custom_data_json", $device_custom_data_json);
							$this->db->where("app_users_data_id", $device['app_users_data_id']);
							$this->db->update("app_users_data");
							//echo "<br/>activity model 1113 ";
						}else{
							//echo "<br/>activity model 1116";
						}
					}
	}
	public function DB_unset_pet_reward($device){
		$device_custom_data_json=json_decode($device['custom_data_json'], true);
		unset($device_custom_data_json[0]['Reward']);
		$device_custom_data_json=json_encode($device_custom_data_json);
		$this->db->set("custom_data_json", $device_custom_data_json);
		$this->db->where("app_users_data_id", $device['app_users_data_id']);
		$this->db->update("app_users_data");
		//$device_custom_data_json=$device_custom_data_json[0];
							
	}
	public function DBset_api_input($post){
		//BLL level
		/*$post=array(
			"app_id"=>"",
			"user_id"=>"",
			"user_inhouse_id"=>"", //require or user_id
			"table"=>"",
			"token"=>"",
			"mode"=>"",
		 * ... //other is free to set
		);*/
		
		//init the user id with differrent user id input in table...
		//echo "<br/> activity model 911";
		//print_r($post);
		$user_id="";
		$post=$this->bll_user_id_exchange($post);
		//echo "<br/>activity model 976 ";
		//print_r($post);
		$user_id=$post['user_id'];
		//exception execution:
		if(!isset($post['mode'])){
			$post['mode']=" ";
		}
		if( ($post['mode']=="vote") ){
			//echo "<br/>activity model 783 ".$post['mode'];
			//$sql="update app_users_data set vote=vote+1 where app_users_data_id='".mysql_real_escape_string($post['app_users_data_id'])."'";
			//$this->db->query($sql);
			$this->load->model("community_model");
			$result=$this->community_model->set_vote($post['vote_id'], $user_id, $post['votee_id']);
			if($result==true){
				$vote_selfuser=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($user_id);
				$vote_targetdevice=$this->login_model->DBget_app_users_data_by_app_users_data_id($post['votee_id']);
				$vote_data=$this->community_model->DBget_vote_data_by_vote_id($post['vote_id']);
				if($vote_data['votee_id_type']=="app_users_data_id"){
					$this->db->set("app_users_data_id", $post['votee_id']);
				}
				$post['title']=$vote_selfuser['nickname']." voted for ".$vote_targetdevice['name'];
				$this->db->set("title", $post['title']);
				$description=$vote_selfuser['nickname']." voted for ".$vote_targetdevice['name']." in ".$vote_data['vote_name']." on ".date('Y-m-d').' about '.date('g a').". If you want to vote as well, please visit ".site_url()." to download our app and vote!";
				$this->db->set("description", $description);
			}else{
				return "success";
			}
		}
		//pet_lose, this is 
		if( ($post['table']=="activity_data")&&(isset($post['mode']))&&($post['mode']=='pet_lose') ){
			$device=$this->DBget_app_users_data_by_bluetooth_device_uuid($post['bluetooth_device_uuid']);
			if($device==null)
				return "success";
			/*if(count($device)==0){
				return "success";
			}*/
			//echo "<br/> activity model 1016 ";
			//print_r($device);
			$device=$device[0];
			if($device['is_lost']==1){
				$this->db->where("app_users_data_id", $device['app_users_data_id']);
				$pet_lost_activity=$this->db->get("activity_data");
				$pet_lost_activity=$pet_lost_activity->result_array();
				//echo "<br/>activity model 1154 ";
				if(count($pet_lost_activity)>0){
					$pet_lost_activity=$pet_lost_activity[0];
					$new_id=$pet_lost_activity['activity_id'];
					if( (isset($post['coordinates_json']))&&($post['coordinates_json']!='') ){
						
					}else{
						$post['coordinates_json']='';
					}
					//$this->load->model("mod_googlemaps_model", "googlemaps_model");
					$post['title']=$device['name']." is lost! ".$device['name']. " was last seen at ".$this->googlemaps_model->bll_get_location($post['coordinates_json'], "short")." on ".date('Y-m-d')." about ".date('g a');
					$this->db->set("title", $post['title']);
					$this->db->set("description", $device['name']." is lost! ".$device['name']. " was last seen at ".$this->googlemaps_model->bll_get_location($post['coordinates_json'], "short")." on ".date('Y-m-d')." about ".date('g a'));
					$this->db->set("app_users_data_id", $device['app_users_data_id']);
					$this->db->where("activity_id", $new_id);
					$this->db->update("activity_data");
					//update device set reward in custom_data_json
					$this->DBset_pet_reward($post, $device);
					$social['activity_id']=$new_id;
					$social['userinfo']=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($device['user_id']);
					$this->ctrl_share_to_social_publication($social);
					return "success";
				}else{
					return "<br/>activity model 1020 pet is lost, but pet lost activity not found";
				}
			}else{
				//echo "<br/>activity model 1200 ";
				$this->DBset_pet_reward($post, $device);
				$this->db->where("app_users_data_id", $device['app_users_data_id']);
				$pet_lost_activity=$this->db->get("activity_data");
				$pet_lost_activity=$pet_lost_activity->result_array();
					if( (isset($post['coordinates_json']))&&($post['coordinates_json']!='') ){
						
					}else{
						$post['coordinates_json']='';
					}
				$post['title']=$device['name']." is lost!";
				$post['description']=$device['name']." is lost! ".$device['name']. " was last seen at ".$this->googlemaps_model->bll_get_location($post['coordinates_json'], "short")." on ".date('Y-m-d')." about ".date('g a');
						
			}
		}
		if($post['mode']=="add_friend"){
			$this->load->model("friends_model");
			//echo "<br/>activity model 1099 ";
			$checker1=$this->friends_model->is_request($post['subject_user_id'], $post['object_user_id'], 0);
			$checker2=$this->friends_model->is_request($post['subject_user_id'], $post['object_user_id'], 1);
			if( ($checker1==0)&&($checker2==0) ){
				//echo "success";
				$post['request']=1;
				$post['block']=0;
				$post["new_record"]='yes';
			}else{
				//echo "<br/>activity model 790 ";
				//print_r($checker1);
				//print_r($checker2);
				return null;
			}
		}
		if($post['mode']=="pet_found"){
			//$app_users_data=$this->DBget_app_users_data_by_bluetooth_device_uuid($post['bluetooth_device_uuid']);
			//$device=$this->DBget_app_users_data_by_bluetooth_device_uuid($post['bluetooth_device_uuid']);
			$this->db->where("bluetooth_device_uuid", $post['bluetooth_device_uuid']);
			$this->db->where("is_lost", '1');
			$device=$this->db->get("app_users_data");
			$device=$device->result_array();
			if(count($device)>0){
				//if the user is owner:
				$device=$device[0];
				if($post['user_id']==$device['user_id']){
					//cancel the lost sign
					$this->db->set("is_lost", "0");
					$this->db->where("bluetooth_device_uuid", $post['bluetooth_device_uuid']);
					$this->db->where("is_lost", '1');
					$this->db->update("app_users_data");
					$this->DB_unset_pet_reward($device);
					//create title and description for activity
					$owner=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($device['user_id']);
					//echo "<br/>activity model 994 ";
					//print_r($owner);
					if( (isset($post['coordinates_json']))&&($post['coordinates_json']!='') ){
						
					}else{
						$post['coordinates_json']='';
					}
					$post['title']=$device['name']." was found.";
					$description=$device['name']." was found and returned back to ".$owner['nickname'].". ".$device['name']." was found ".$this->googlemaps_model->bll_get_location($post['coordinates_json'], "long")." on ".date('Y-m-d')." about ".date('g a');
					$this->db->set("app_users_data_id", $device['app_users_data_id']);
					$this->db->set("title", $post['title']);
					$this->db->set("description", $description);
				}else{
					//if the user is not the owner:
					//get founder information
					$founder=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($post['user_id']);
					$app_users=$this->DBget_app_users_by_app_id_and_user_id($device['app_id'], $device['user_id']);
					if( (isset($post['coordinates_json']))&&($post['coordinates_json']!='') ){
						
					}else{
						$post['coordinates_json']='';
					}
					if( (isset($post['privacy']))&&($post['privacy']=='no') ){
						$description=$device['name']." last appeared at ".$this->googlemaps_model->bll_get_location($post['coordinates_json'], "long")." on ".date('Y-m-d')." about ".date('g a').".";
					}else{
						$description=$device['name']." last appeared at ".$this->googlemaps_model->bll_get_location($post['coordinates_json'], "long")." on ".date('Y-m-d')." about ".date('g a').". It is located by ".$founder['nickname'].".";
						if($founder['phone']!=''){
							$description.=" You can contact him/her by phone ".$founder['phone'];
						}					
					}	
					
					if(isset($post['new_record'])){
						$this->load->library("SimplePush/iphone_sendmessage", "iphone_sendmessage");
						//echo "<br/> activity model 873 ".$app_users['device_token']. "::".$description;
						//print_r($app_users);
						//echo $device['device_token']."::".$description;
						$this->iphone_sendmessage->sendmessage($app_users['device_token'], $description);
					}	
					//create title and description for activity
					$this->db->set("app_users_data_id", $device['app_users_data_id']);
					$post['title']=$device['name']." last appeared at ".$this->googlemaps_model->bll_get_location($post['coordinates_json'], "short")." on ".date('Y-m-d')." about ".date('g a');
					$this->db->set("title", $post['title']);
					$this->db->set("description", $description);
				}
			}		
			//$lost_activity=$this->
		}
		if($post['mode']=="denied_friend"){
			$this->db->where("subject_user_id", $post['subject_user_id']);
			$this->db->where("object_user_id", $post['object_user_id']);
			$this->db->set("request", "0");
			$this->db->set("block", "1");
			$this->db->update("user_relation");
			return null;
		}
		if($post['mode']=="accept_friend"){
			$this->db->where("subject_user_id", $post['subject_user_id']);
			$this->db->where("object_user_id", $post['object_user_id']);
			$this->db->set("request", "0");
			$this->db->set("block", "0");
			$this->db->update("user_relation");
			
			$selfplayer=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id( $post['subject_user_id']);
			$otherplayer=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($post['object_user_id']);
			
			
			//prepare insert database activity_data 
			$post['title']=$otherplayer['nickname']." had accepted ".$selfplayer['nickname'].' as friendship.';
			$post['description']=$otherplayer['nickname']." had accepted ".$selfplayer['nickname'].' as friendship.';
			$post['has_ended']="1";
			$post['last_updated']=date( 'Y-m-d H:i:s');
			
			//send push notification to both side
			$selfdevice=$this->DBget_app_users_by_app_id_and_user_id($post['app_id'], $selfplayer['user_inhouse_id']);
			$otherdevice=$this->DBget_app_users_by_app_id_and_user_id($post['app_id'], $otherplayer['user_inhouse_id']);
			$this->load->library("SimplePush/iphone_sendmessage", "iphone_sendmessage");
			$this->iphone_sendmessage->sendmessage($selfdevice['device_token'], $post['description']);
			$this->iphone_sendmessage->sendmessage($otherdevice['device_token'], $post['description']);
			
			
		}
		
		//echo "<br/> activity model 795 ".$post['mode'];
		if( ($post['mode']=="photo") ){
			//echo "<br/> activity model 796 ";
			$userinfo=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($user_id);
			//print_r($userinfo);
			if($userinfo['photo_publication']=="google"){
				//for google upload only
			}else if($userinfo['photo_publication']=="facebook"){
				//for facebook upload only
				//echo "<br/> activity model 803 ";
				//get user id for access token
				if(isset($post['user_inhouse_id']))
					$post['user_id']=$post['user_inhouse_id'];
				//echo $post['user_id'];
				//get token for facebook upload image
				$access_token=$this->native_session->get("token");
				if($access_token==''){
					$access_token=$this->login_model->DBget_oauth_by_user_inhouse_id($post['user_id'], "facebook");
					if($access_token!=null){
						$access_token=$access_token['oauth_server_id'];
					}else{
						//access_token expire?
						echo "no permission";
						return;
					}
				}
				//echo " ".$access_token;
				//set facebook upload image
				$result=$this->facebook_model->ctrl_FBset_photo($access_token, $post['photo']);
				//choose table as list update 
				//get facebook image for data
				if($post['table']=="app_users_data"){
					$post['server_image_id']=$result['id'];
					$post['image']="";
					for($i=7;$post['image']=='';$i--){
						if( (isset($result['images'][$i]['source']))&&($result['images'][$i]['source']!="NoPic") ){
							$post['image']=$result['images'][$i]['source']; //130x130
						}
					}
					$post['full_image']='';
					for($i=4;$post['full_image']=='';$i--){
						if( (isset($result['images'][$i]['source']))&&($result['images'][$i]['source']!="NoPic") ){
							$post['full_image']=$result['images'][$i]['source']; //480x400
						}
					}
				}
				
			}
		}
		//for update procedure
		$input_data=$this->init_model->DBset_available_input_field($post);
		if(!isset($post["new_record"])){
			$this->init_model->DBset_condition_for_select($post);
			$result=$this->db->get($post['table']);
			$result=$result->result_array();
			//echo "<br/>activity model 816 ".count($result);
			if( (count($result)>0) ){
				//echo "<br/>activity_model 829 update";
				$this->init_model->DBset_condition_for_select($post);
				$this->db->order_by("last_updated", "desc");
				$this->db->limit(1);
				$this->db->update($post['table'], $input_data);
				if($post['table']=="activity_data"){
					$this->init_model->DBset_condition_for_select($post);
					$new_id=$this->db->get($post['table']);
					$new_id=$new_id->result_array();
					$new_id=$new_id[0]['activity_id'];
				}
			}else{
				//echo "<br/>activity_model 834 insert";
				if($post['table']=="activity_data")
					$this->db->set("privacy", "default");
				$this->db->insert($post['table'], $input_data);
				$new_id=$this->db->insert_id();
			}
		}else{
			//echo "<br/> activity model 824 ";
			//print_r($input_data);
			//echo "<br/>activity_model 841 insert";
			if($post['table']=="activity_data")
				$this->db->set("privacy", "default");
			$this->db->insert($post['table'], $input_data);
			$new_id=$this->db->insert_id();
		}
		
		//after update
		if( ($post['table']=="activity_data")&&(isset($post['coordinates_json']))&&($post['coordinates_json']!='') ){
			
			//$this->load->model("mod_googlemaps_model", "googlemaps_model");
			$this->googlemaps_model->update_path_kml($new_id);
			$this->googlemaps_model->update_checkpoint_kml($new_id);
			// Post to community
			//echo "<br/> activity model 1265 ";
			//print_r($post);
			if( (isset($post['title']))&&($post['title']!='') ){
				//$this->activity_model->DBset_new_community($post['app_id'], $new_id, $user_id, $post['title']);
			}else{
				//$post['title']="";
				//$this->activity_model->DBset_new_community($post['app_id'], $new_id, $user_id, $post['title']);
			}
		}
		if( ($post['mode']=="pet_found")&&(isset($owner)) ){
			$social['activity_id']=$new_id;
			$social['userinfo']=$owner;
			$this->ctrl_share_to_social_publication($social);
		}
		
		if( ($post['table']=="activity_data")&&(isset($post['mode']))&&($post['mode']=='pet_lose') ){
				
				//echo "<br/>activity model 1231";
				
				//$device=$device[0];
					if( ($device['is_lost']==0) ){
						$this->db->where("bluetooth_device_uuid", $post['bluetooth_device_uuid']);
						$this->db->set("is_lost", "1");
						$this->db->update("app_users_data");
						//get device name
						$device=$this->DBget_app_users_data_by_bluetooth_device_uuid($post['bluetooth_device_uuid']);
						/*$this->db->where("bluetooth_device_uuid", $post['bluetooth_device_uuid']);
						$device=$this->db->get('app_users_data');
						$device=$device->result_array();*/
						$device=$device[0];
					}
									//echo "<br/>activity model 1245";
					
					//get location from coordinates_json
					//$location=json_decode($post['coordinates_json'], false);
					//$location=$this->googlemaps_model->Googleget_location_by_latitude_longitude_from_google($location[0]['coordinates_']);
					if( (isset($post['coordinates_json']))&&($post['coordinates_json']!='') ){
						
					}else{
						$post['coordinates_json']='';
					}
					$post['title']=$device['name']." is lost!";
					$this->db->set("title", $post['title']);
					$this->db->set("description", $device['name']." is lost! ".$device['name']." was last seen ".$this->googlemaps_model->bll_get_location($post['coordinates_json'], "long")." on ".date('Y-m-d').' about '.date('g a'));
					$this->db->set("app_users_data_id", $device['app_users_data_id']);
					$this->db->where("activity_id", $new_id);
					$this->db->update("activity_data");
					//echo "<br/>activity model 1256";
							
					$social['activity_id']=$new_id;
					$social['userinfo']=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($device['user_id']);
					$this->ctrl_share_to_social_publication($social);
					//echo "<br/>activity model 1261";
			
		}
		if($post['mode']=="add_friend"){
			//for push notification coding	
			
			$sender=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($post['subject_user_id']);
			$app_users=$this->DBget_app_users_by_app_id_and_user_id($post['app_id'], $post['object_user_id']);
			$app_name=$this->DBget_app_name_by_app_id($post['app_id']);
			$description=$sender['nickname']." added you as a friend, if you want to accept him/ her, please download ".$app_name." to accept this request.";
			$this->load->library("SimplePush/iphone_sendmessage", "iphone_sendmessage");
			$this->iphone_sendmessage->sendmessage($app_users['device_token'], $description);
			
		}
		if( ($post['table']=="app_users_data")&&(isset($post['new_record']))&&($post['new_record']!='') ){
			/*$app_name="";
			switch($post['app_id']){
				case 1: $app_name="iBikeFans"; break;
				case 2: $app_name="PetNfans"; break;
				case 3: $app_name="iHealthFans"; break;
				
			}
			$mode="begin";
			$userinfo=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($user_id);
			if( (isset($post['mode']))&&($post['mode']!="") ) $mode=$post['mode'];
			$_POST=array(
				"app_id"=>$post['app_id'],
				"user_inhouse_id"=>$user_id,
			 	"token"=>"",
			 	"title"=>$userinfo['nickname']." is begin to use ".$app_name." at ".date("Y-m-d")." about ".date("g a"),
			 	"table"=>"activity_data",
			 	"mode"=>$mode,
				"name"=>$post['name'],
				"privacy"=>"default",
				"new_record"=>"yes",//require and hardcode
				"description"=>$userinfo['name']." is begin to use ".$app_name." at ".date("Y-m-d")." about ".date("g a").", Welcome to join the Fansliving!",
			);	
			$this->activity_manual_post($_POST);	*/
			
		}
		if( ($post['table']=="activity_data")&&(isset($post['new_record']))&&($post['new_record']!='')  ){
			// Create news
			//echo "<br/>activity model 1299";
			$this->news_model->post_news_to_outbox($user_id, $new_id, $post['app_id'], $post['mode']);
			//echo "<br/>activity model 1305";
			// Post to community
			//$this->activity_model->DBset_new_community($post['app_id'], $new_id, $user_id, $post['title']);
			//echo "<br/>activity model 1308";
			
		}
		return "success";
	}
	public function DBget_activity_mode($data){
		//$data=array("mode"=>"ihealth_BMI", "app_id"=>"", "user_inhouse_id"=>"");	
		
			$this->db->where("mode", $data['mode']);
			$this->db->where("user_inhouse_id", $data['user_inhouse_id']);
			$this->db->where("app_id", $data['app_id']);
			$this->db->order_by("last_updated", "desc");
			$result=$this->db->get("activity_data");
			$result=$result->result_array();
			if(count($result)>0){
				return $result;
			}else{
				return null;
			}
		

		
	}
	public function DBget_app_icon_by_app_id($app_id){
		//LV2
		$this->init_model->sensitive_session[]="DBget_app_icon_by_app_id($app_id)";
		if($this->native_session->get("DBget_app_icon_by_app_id($app_id)")==null){
			$this->db->select("apps_icon");
			$this->db->where("app_id", $app_id);
			$result=$this->db->get("app_data");
			$result=$result->result_array();
			if(count($result)>0){
				$this->native_session->set("DBget_app_icon_by_app_id($app_id)", $result[0]['apps_icon']);
				return $result[0]['apps_icon'];
			}else{
				return null;
			}
		}else{
			return $this->native_session->get("DBget_app_icon_by_app_id($app_id)");
		}
	}
	
	
	
	
	public function DBget_privacy(){
		//BLL
		return "default";
	}
	
	
	
	public function display_activity_nodes() {
		
		// Sort DB
		$this -> db -> order_by('app_id asc, user_inhouse_id asc, last_updated asc');
		$results = $this -> db -> get("activity_data");
		$row = $results -> result_array();
		
		// Set initial anchors
		$app_anchor = -1;
		$user_anchor = -1;
		
		foreach ($row as $value) {
			
			// Check if start of new set of activity
			if ($value['app_id']!=$app_anchor || $value['user_inhouse_id']!=$user_anchor) {
				$app_anchor = $value['app_id'];
				$user_anchor = $value['user_inhouse_id'];
				
				echo "<br/>";
				echo $value['user_inhouse_id'].",".$value['app_id']." time=".$value['last_updated']." activity_id=".$value['activity_id']." prev=".$value['prev_activity_id']." prev=".$value['next_activity_id']."<br />";
				
			} else {
				
				echo $value['user_inhouse_id'].",".$value['app_id']." time=".$value['last_updated']." activity_id=".$value['activity_id']." prev=".$value['prev_activity_id']." prev=".$value['next_activity_id']."<br />";
			}
			
			
		}
	}


	public function update_activity_nodes($echo) {
		
		// Sort DB
		$this -> db -> order_by('app_id asc, user_inhouse_id asc, last_updated asc');
		$results = $this -> db -> get("activity_data");
		$row = $results -> result_array();
		
		// Set initial anchors
		$app_anchor = -1;
		$user_anchor = -1;
		
		for ($i=0; $i<count($row); $i++) {
			if(isset($row[$i]) && isset($row[$i+1]))
			if (($row[$i]['app_id']!=$app_anchor || $row[$i]['user_inhouse_id']!=$user_anchor) &&
				($row[$i]['app_id']!=$row[$i+1]['app_id'] || $row[$i]['user_inhouse_id']!=$row[$i+1]['user_inhouse_id'])) {
					
				$this->db->set('prev_activity_id', NULL);
				$this->db->set('next_activity_id', NULL);
				$this->db->where('activity_id', $row[$i]['activity_id']);
				$this->db->update('activity_data');
			
			// Check if start of new set of activity
			} else if ($row[$i]['app_id']!=$app_anchor || $row[$i]['user_inhouse_id']!=$user_anchor) {
				$app_anchor = $row[$i]['app_id'];
				$user_anchor = $row[$i]['user_inhouse_id'];

				// Set previous node as null
				$this->db->set('prev_activity_id', NULL);
				$this->db->set('next_activity_id', $row[$i+1]['activity_id']);
				$this->db->where('activity_id', $row[$i]['activity_id']);
				$this->db->update('activity_data');
			
			} else if ($row[$i]['app_id']!=$row[$i+1]['app_id'] || $row[$i]['user_inhouse_id']!=$row[$i+1]['user_inhouse_id']) {
				
				// Set previous node as null
				$this->db->set('prev_activity_id', $row[$i-1]['activity_id']);
				$this->db->set('next_activity_id', NULL);
				$this->db->where('activity_id', $row[$i]['activity_id']);
				$this->db->update('activity_data');
					
				
			} else {
				
				// Set previous node as null
				$this->db->set('prev_activity_id', $row[$i-1]['activity_id']);
				$this->db->set('next_activity_id', $row[$i+1]['activity_id']);
				$this->db->where('activity_id', $row[$i]['activity_id']);
				$this->db->update('activity_data');
				
			}
		}
		
		if($echo)
			$this->display_activity_nodes();
	}
	
}
?>
	