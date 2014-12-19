<?php
class Activity_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->model("init_model");
		$this->load->model("login_model");
		$this->load->library("native_session");
		
		$config['appId']=$this->config->item("fb_app_id");
		$config['secret']=$this->config->item("fb_app_secret");	
		$this->load->library("facebook", $config);
		//ini_set("upload_max_filesize", "200M");
	}	
	
	public function save_tmp_image($file){
		$filename=rand(10000000, 99999999)."_".$file['name'];
		$dest=$this->init_model->get_FSPATH("upload/".$filename);	
		move_uploaded_file($file['tmp_name'], $dest);
		//move_uploaded_file($file['tmp_name'], "upload/".$filename);
		return $dest;	
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


	public function DBget_oauth_by_user_inhouse_id($user_inhouse_id, $oauth_server_name){
		//LV3	
		$this->db->where("user_inhouse_id", $user_inhouse_id);
		$this->db->where("oauth_server_name", $oauth_server_name);
		$result=$this->db->get("user_oauth");
		return $result->result_array(); 
	}
	//http://a2.sphotos.ak.fbcdn.net/hphotos-ak-ash3/530876_150950288376077_1369148335_n.jpg
	//http://a2.sphotos.ak.fbcdn.net/hphotos-ak-ash3/530876_150950288376077_1369148335_n.jpg
	public function db_set_activity($input2){
		//save the data in activity
		//$input2={userinfo, comment, full_url, thumb_url, original_url}
		//those 3 url come from get_photo_from_facebook($id)
		
		$bll['user_id']=$input2['userinfo']['user_inhouse_id'];
		$bll['event_detail']=$input2['comment'];
		if(isset($input2['full_url']))
			$bll['full_url']=$input2['full_url'];
		if(isset($input2['thumb_url']))
			$bll['thumb_url']=$input2['thumb_url'];
		if(isset($input2['original_url']))
			$bll['original_url']=$input2['original_url'];
		$this->db->insert('api_activity', $bll);
		echo "activity model 80 had been written.";
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
		$result=$result[0];
		if(count($result)>0){
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
		
	public function DBget_activity_data_by_activity_id($activity_id){
		$this->db->where("activity_id", $activity_id);
		$result=$this->db->get("activity_data");
		return $result->result_array(); 
	}
	
	public function get_user_most_recent_activity_id($user_id) {
		$this -> db -> select('activity_id, user_inhouse_id, last_updated');
		$query = $this -> db -> get_where('activity_data', array('user_inhouse_id' => $user_id));
		$data = $query -> result_array();
		
		$most_recent_time = strtotime($data[0]['last_updated']);
		$most_recent_activity_id = $data[0]['activity_id'];
		foreach ($data as $key => $arr) {
			if (strtotime($arr['last_updated']) > $most_recent_time) {
				$most_recent_time = strtotime($arr['last_updated']);
				$most_recent_activity_id = $arr['activity_id'];
			}
		}
		
		return $most_recent_activity_id;
	}
	
	public function get_user_max_speed($user_id) {
		$this -> db -> select('activity_id, user_inhouse_id, max_speed');
		$query = $this -> db -> get_where('activity_data', array('user_inhouse_id' => $user_id));
		$data = $query -> result_array();
		
		$max_speed = $data[0]['max_speed'];
		foreach ($data as $key => $arr) {
			if ($arr['max_speed'] > $max_speed) {
				$max_speed = $arr['max_speed'];
			}
		}
		return $max_speed;
	}

	public function get_feature_friends($user_id, $number_of_friends) {
		
		for ($i=0; $i < $number_of_friends; $i++) { 
			$this -> db -> select('user_inhouse_id, firstname, lastname, profile_image');
			$query = $this -> db -> get_where('user_inhouse', array('user_inhouse_id' => 303+$i));
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
}
?>
	