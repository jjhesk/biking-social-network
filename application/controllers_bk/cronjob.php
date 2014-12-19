<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cronjob extends CI_Controller {	
	
	function __construct()
	{
		parent::__construct();
		//$this->load->model("googlemaps_model");
		//$this->load->model("friends_model");
		
		
	}
	
	function index()
	{
		$this->news_postman();
		$this->set_community_record();
	}
	/*
	 *
	 TODO: judy, make sure the priority if the calucations should be taken place on the CRON JOBS and it is not operated by user requests.
	 */
	public function get_max_speed_record($app_id) {
		$this -> db -> join('user_inhouse_data', 'activity_data.user_inhouse_id = user_inhouse_data.user_inhouse_id');
		$this -> db -> select('activity_id, max_speed, firstname, lastname, profile_image, country');
		$query = $this -> db -> get_where('activity_data', array('app_id' => $app_id, 'mode' => 'auto', 'default_privacy' => 'public'));
		$data = $query -> result_array();
		if (count($data) > 0) {
			$max_speed = 0;
			$max_speed_index = 0;
			for ($i = 0; $i < count($data); $i++) {
				if ($data[$i]['max_speed'] > $max_speed) {
					$max_speed = $data[$i]['max_speed'];
					$max_speed_index = $i;
				}
			}
			$return_array = array('fullname' => $data[$max_speed_index]['firstname'] . " " . $data[$max_speed_index]['lastname'], 'profile_image' => $data[$max_speed_index]['profile_image'], 'max_speed' => $data[$max_speed_index]['max_speed'], 'country' => $data[$max_speed_index]['country']);

			return $return_array;
		} else {
			return null;
		}
	}
	function set_community_record()
	{
		// calculate population
		
		// app1,  max speed
			//get max speed from db
			
			//
		
		// update app_page_layout.community_record_data_json
			//encode..
			//max, poplutaion
		
		// app 2, max distance
		
		// update app_page_layout.community_record_data_json
			//encode..
			//max, poplutaion
		
		
		
	}
	
	public function news_postman()
	{
		//$this->output->enable_profiler(true);	//debug function
		$this->load->model("user_model");
		
		
		//TODO: swap table monthly, etc
		$table_postfix = '201209';
		$source_type = 'user';
		
		//get postman
		$this -> db -> order_by("deliver_time", "desc");
		$this -> db -> limit(1);
		$result = $this -> db -> get("news_postman");
		$postman = $result -> result_array();
				
		//echo create_table_html($postman);
		$last_user_news_id = $this->deliver_mail('user',  $table_postfix, $postman[0]["last_user_news_id"]);
		$last_app_news_id = $this->deliver_mail('app',  $table_postfix, $postman[0]["last_app_news_id"]);
		
		if ($last_user_news_id==null){
			$last_user_news_id = $postman[0]["last_user_news_id"];
		}
		
		if ($last_app_news_id==null){
			$last_app_news_id = $postman[0]["last_app_news_id"];
		}
				
		$update = array
		(
			'last_user_news_id' => $last_user_news_id,
			'last_user_mailbox_table' => $table_postfix,
			'last_app_news_id' => $last_app_news_id,
			'last_app_mailbox_table' => $table_postfix,
		);
		$this->db->insert("news_postman", $update);
		
		echo 'cronjob done';	
	}
	
	function deliver_mail($source_type, $table_postfix, $last_check)
	{
		// check mailbox for number > last post
	
		$this -> db -> where("{$source_type}_news_id >", $last_check);
		$result = $this -> db -> get("{$source_type}_news_outbox_{$table_postfix}");
		$unsend_mails = $result -> result_array();
		
		//echo create_table_html($unsend_mail);
		// post out for each unsend mail
		
		if($source_type == 'app')
			$privacy = 'public';
		
		foreach($unsend_mails as $mail)
		{	
			// write to the inbox of the friend for each unsend mail
			if($source_type == 'user')
				$privacy = $this->user_model->get_default_privacy($mail["{$source_type}_id"]);
			
			switch($privacy)
			{
				case 'public': 
						//distrbute to app inbox
			//echo create_table_html($friends);
				
				 $news = array
				(	
					'app_id' => $mail['app_id'],
					'source_news_id' => $mail["{$source_type}_news_id"],
					'news_timestamp' => $mail['last_updated'],
					'from_source_type' => $source_type,
					'from_source_id' => $mail['app_id'],
					'news_text' => $mail['news_text'],
				);
				$this->db->insert("app_news_inbox_{$table_postfix}", $news); 
	
				case 'friends_only':
						//distrubte to friends
						// get friends for each mail
				$friends= $this -> friends_model -> getdatafriendsid($mail["{$source_type}_id"], array('user_inhouse_id'));
				
				//echo create_table_html($friends);
				
				
				// 1 row for each friend, copy messages (insert)
				
				if($friends!=null){
					foreach ($friends as $friend)
					{
							 $news = array
							(	
								'user_id' => $friend['user_inhouse_id'],
								'source_news_id' => $mail["{$source_type}_news_id"],
								'news_timestamp' => $mail["last_updated"],
								'from_source_type' => $source_type,
								'from_source_id' => $mail["{$source_type}_id"],
								'news_text' => $mail['news_text'],
							);
							$this->db->insert("user_news_inbox_{$table_postfix}", $news); 
					}
				}
				
				case 'me_only':
					//do nothing
					
				
			}			
				

		}
		// update postman
		if (count($unsend_mails)!=0) {
			$last_check = $mail["{$source_type}_news_id"];
			return $last_check;
		} else {
			return null;
		}
	}
	
	
}
?>