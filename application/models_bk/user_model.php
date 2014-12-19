<?php

class user_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('native_session');
		
		 //* end of constant setting */	
		//$this->load->model();	
	}
	
	public function error_checking($parameters)
	{
	$weight_error = 0;
	$height_error = 0;
	$birthday_error = 0;
	$weight_error_message = '';
	$height_error_message = '';
	$birthday_error_message = '';
	$has_error = 0;
	
		if ($parameters['weight'] <= 0)
		{
			$weight_error = 1;
			$weight_error_message = 'Please enter a weight above 0kg';
		}
		elseif ($parameters['weight'] > 300) {
			$weight_error = 1;
			$weight_error_message = 'Please enter a weight below 300kg';
		}
		
		if ($parameters['height'] <= 0)
		{
			$height_error = 1;
			$height_error_message = 'Please enter a height above 0cm';
		}
		elseif ($parameters['height'] > 250) {
			$height_error = 1;
			$height_error_message = 'Please enter a height below 250cm';
		}
		
		//error check for the date. But using big numbers for the year will result in displaying the minimum set date (i.e. 1/1/1970)
		if (!is_numeric($parameters['date_month']) || !is_numeric($parameters['date_day']) || !is_numeric($parameters['date_year'])) { 
	        $birthday_error = 1;
			$birthday_error_message = 'Please enter numbers only';
	    } elseif (!checkdate($parameters['date_month'], $parameters['date_day'], $parameters['date_year'])) {
	        $birthday_error = 1;
			$birthday_error_message = 'Please enter a proper date';
	    }
		
		if (($weight_error == 1 || $height_error == 1) || $birthday_error == 1 )
			$has_error = 1; 
		
		$data = array (
				'has_errors' => $has_error,
				'weight_error' => $weight_error,
				'weight_error_message' => $weight_error_message,
				'height_error' => $height_error,
				'height_error_message' => $height_error_message,
				'birthday_error' => $birthday_error,
				'birthday_error_message' => $birthday_error_message,);
		return $data;
	}
		
	function update_user_settings($user_id, $parameters)
	{
		$this->db->select("customize_edit_count");
		$this->db->where("user_inhouse_id", $user_id);
		$result=$this->db->get("user_inhouse_data");
		$result=$result -> result_array();	
		
		//echo "<br/>user_model 71<br/>";
		//print_r($parameters);
				
		$this->db->set("customize_edit_count", $result[0]['customize_edit_count']+1);	
		$this->db->set('firstname', $parameters['firstname']);
		$this->db->set('lastname', $parameters['lastname']);
		$this->db->set('height', $parameters['height']);
		$this->db->set('weight', $parameters['weight']);
		$this->db->set('email', $parameters['email']);
		$this->db->set('country', $parameters['country']);
		$this->db->set('gender', $parameters['gender']);
		$this->db->set('nickname', $parameters['firstname']);
		$this->db->set('email_privacy', $parameters['email_privacy']);
		//convert the dob from 3 separate variable into mysql format YYYY-MM-DD
		$day = $parameters['date_day'];
		$month = $parameters['date_month'];
		$year = $parameters['date_year'];
		$bday_sql_format = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
		$this->db->set('birthday', $bday_sql_format);
		
		$this->db->set('height_privacy', $parameters['height_privacy']);
		$this->db->set('weight_privacy', $parameters['weight_privacy']);
		$this->db->set('birthday_privacy', $parameters['dob_privacy']);
		$this->db->set('default_privacy', $parameters['overall_privacy']);
		$this->db->set('social_media_publication', $parameters['social_media_publication']);
		$this->db->set('photo_publication', $parameters['photo_publication']);
		$this->db->where('user_inhouse_id', $user_id);
		$this->db->update('user_inhouse_data');
		
		$user_app=$this->get_user_installed_apps($user_id);
		
		foreach($user_app as $key=>$value){
			$this->db->set('default_privacy', $parameters['app_'.$value['app_id'].'privacy']);
			$this->db->where('app_id', $value['app_id']);
			$this->db->where('user_id', $user_id);
			$this->db->update('app_users');
		}
		
		$inhouse_info=$this->native_session->get("inhouse_info");
		$inhouse_info['nickname']=$parameters['firstname'];
		$this->native_session->set("inhouse_info", $inhouse_info);
		
		$inhouse_info=$this->native_session->get("inhouse_info");
		$inhouse_info['customize_edit_count']=$inhouse_info['customize_edit_count']+1;
		$this->native_session->set("inhouse_info", $inhouse_info);
		
	}
	
	public function get_default_privacy($user_id)
	{
		$this->db->select('default_privacy');
		$this -> db -> where('user_inhouse_id', $user_id);
		$result = $this -> db -> get('user_inhouse_data');
		$tmp = $result -> result_array();
		return $tmp[0]['default_privacy'];	
	}
	
	function get_user_settings($user_id)
	{
		$this->db->where('user_inhouse_id', $user_id);		
		$result=$this->db->get("user_inhouse_data");
		$result=$result->result_array();
		if(count($result)>0)
			return $result[0]; 
		else
			return null;
	}
	
	function get_user_settings_data($user_id)
	{
		$data = $this->get_user_settings($user_id);
		$data['installed_app'] = $this->get_user_installed_apps($user_id);
		
		// echo '<pre>';
		// print_r ($data);
		// echo '</pre>';
		 	
		return $data;
	}
	
	function get_user_installed_apps($user_id) //return an array of 
	{
		//$this->load->model('news_model');
		//TODO: function gets device name, latest status and time stamp and outputs a 2D array
		//@ using the app_page_layout table
		$this->db->select('app_users.app_id');
		$this->db->select('tab_label');	
		$this->db->select('last_updated');
		//$this->db->select('icon_image_url');
		$this->db->where('user_id', $user_id);
		$this->db->join('app_page_layout', 'app_page_layout.app_id = app_users.app_id');
		
		$query = $this->db-> get('app_users');
		$apps = $query -> result_array();	

		$tmp = array();		
		foreach($apps as $key => $app)
		{
			$tmp[$key] = $app;
			//$tmp[$key]['news_string'] = $this->news_model->get_app_news_string($app['app_id']); 
			
		}
		return $tmp;
	}
	function get_json_installed_app($user_id){
		$data = $this->get_user_installed_apps($user_id);
		return json_encode($data, JSON_FORCE_OBJECT);
	}
}

?>