<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Utility extends CI_Controller {	
	
	function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(true);
		$this->load->model("googlemaps_model");
		$this->load->model("friends_model");
		$this->load->model("community_model");
		$this->load->model("activity_model");
	}	

	public function fix_comments1() {
		$this -> db -> select('user_inhouse_id, activity_id, last_updated');
		$query = $this -> db -> get('activity_data');
		$data = $query -> result_array();
		
		for ($i=0; $i < count($data); $i++) {
				 
			$post_data = array(
			 'news_type' => "activity_thread",
			 'source_id' => $data[$i]['activity_id'],
			 'comment_user_id' => $data[$i]['user_inhouse_id'],
			 'comment_text' => 'I started an activity with iBikeFans',
			 'last_updated' => $data[$i]['last_updated'],);
			$this->db->insert('news_comment', $post_data);
		}
	}

	public function fix_comments2() {
		$query = $this -> db -> get_where('news_comment', array('news_type' => 'activity_comment'));
		$data = $query -> result_array();
		
		for ($i=0; $i < count($data); $i++) {
			
			$query = $this -> db -> get_where('news_comment', array('news_type' => 'activity_thread', 'source_id' => $data[$i]['source_id']));
			$single_data = $query -> result_array();
			$new_activity_id = $single_data[0]['comment_id'];
				 
			$this->db->set('source_id', $new_activity_id);
			$this->db->where('comment_id', $data[$i]['comment_id']);
			$this->db->update('news_comment');
		}
	}
	
	public function fix_comments3() {
		
		// TODO: Change activity feedback ids
		$query = $this -> db -> get_where('news_feedback', array('news_type' => 'activity_thread'));
		$data = $query -> result_array();
		
		for ($i=0; $i < count($data); $i++) {
			
			$query = $this -> db -> get_where('news_comment', array('news_type' => 'activity_thread', 'source_id' => $data[$i]['source_id']));
			$single_data = $query -> result_array();
			$new_activity_id = $single_data[0]['comment_id'];
				 
			$this->db->set('source_id', $new_activity_id);
			$this->db->where('feedback_id', $data[$i]['feedback_id']);
			$this->db->update('news_feedback');
		}
	}
	
	
	
	public function generate_kml(){ //to be used in map
		//echo "1";
		//remember turn off the codeigniter debug mode!
		//otherwise it will make kml error and cannot load the map! 
		$this->output->enable_profiler(false);
		$map_type = $this->uri->segment(3, 0);
		$activity_id = $this->uri->segment(4, 0);
		$data = array();
		$data = $this -> googlemaps_model -> get_kml($activity_id);
		//echo "<br/>utility 76 ";
		//print_r($data);
		if($data['kml_checkpoints']==NULL) {
			$this->googlemaps_model->update_checkpoint_kml($activity_id);
			$data = $this -> googlemaps_model -> get_kml($activity_id);
		}
		if($data['kml_path']==NULL) {
			$this->googlemaps_model->update_path_kml($activity_id);
			$data = $this -> googlemaps_model -> get_kml($activity_id);
		}
		//echo "<br/>utility 86 ";
		//print_r($data);
		
		$this -> output
		->set_content_type('application/vnd.google-earth.kml')
		->set_header("Pragma: no-cache")
		->set_header("Cache-Control: post-check=0, pre-check=0")
		->set_header("Cache-Control: no-store, no-cache, must-revalidate")
		->set_header("HTTP/1.0 200 OK")
		->set_header("HTTP/1.1 200 OK")
		//->set_status_header('401')
		->set_status_header('200')
		->cache(1);
		
		if ($map_type == 'small') {
			

			
			$this->output->set_output($data['kml_path']);
		} else {
			

			
			$this->output->set_output($data['kml_checkpoints']);
		}
	}

	public function generate_block_json(){
		//for iBicycle
		echo  json_encode(
				array(
					array(						
					'widget' => 'block_route',
					'position' => 'right',
					'param' => 	NULL, //no param needed, uses activity_id
					),
					array(						
					'widget' => 'block_map',
					'position' => 'right',
					'param' => 	NULL, //no param needed, uses activity_id
					),
					array(						
					'widget' => 'block_record_analysis',
					'position' => 'left',
					'param' => 	array(		
									array(	
									'name' => 'heartbeat',
									'title' => 'Heart Beat (bpm)'),
									array(	
									'name' => 'speed',
									'title' => 'Speed (km/h)'),
								),				
					),
					array(						
					'widget' => 'block_record',
					'position' => 'left',
					'param' => 	array(						
									array(	
									'title' => 'Speed',
									'unit' => 'km/h',//TODO: user define
									'function_param' => 'avg_speed'),	
									array(	
									'title' => 'Temperature',
									'unit' => 'Celcius',//TODO: user define
									'function_param' => 'avg_temperature'),	
								),				
					),
					
				)	
			);
	}

	public function generate_community_page_json(){
			
		//for iBicycle
		echo  json_encode(
				array(
					
					array(						
					'widget' => 'max_record',
					'param' => 	array(		
									'max_record_type' => 'speed',
									'title' => 'SPEED RECORD<br>Maximum Speed',
								),				
					),
					
					array(						
					'widget' => 'total_users_around_the_world',
					'param' => 	NULL, //no param needed
					),
					
				)	
			);
	}



	public function testing(){
		$this -> load -> model('profile_model');
		$test = $this -> profile_model -> get_user_latest_news('8');
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
	
	public function display_activity_nodes() {
		$this -> activity_model -> display_activity_nodes();
	}


	public function update_activity_nodes() {
		$this -> activity_model -> update_activity_nodes(1);
	}
	
	public function clean_up_user_relations() {
		$this -> friends_model -> clean_up_user_relations();
	}

	// TESTING ONLY
	public function post_fake_data() {
		
		$last_activity_id = $this->activity_model->get_user_most_recent_activity_id(1);

		// TESTING ONLY
		$data = array(
			'user_inhouse_id' => 1,
			'app_id' => 1,
			'password' => "1111116",
			'title' => "TEST",
			'description' => "Hardcode from PHP file",
			'mode' => "manual",
			'avg_speed' => 1,
			'avg_temperature' => 2,
			'avg_heart_rate' => 3,
			'total_distance' => 4,
			'elapse_time' => 5,
			'elapse_time_sec' => 6,
			'max_speed' => 7,
			'max_heart_rate' => 8,
			'total_calories' => 9999,
			'coordinates_json' => 0,
			'custom_data_json' => 0,
			'prev_activity_id' => $last_activity_id,
			'next_activity_id' => NULL);
		
		// See if password exists
		$activity_id = $this->activity_model->get_activity_id_from_password("1111116");
		
		// If no such password, create new row
		if ($activity_id==null) {
			$this->db->insert('activity_data', $data);
			$activity_id = $this->activity_model->get_user_most_recent_activity_id(1);
			
			// Update node in previous activity
			$this->db->set('next_activity_id', $activity_id);
			$this->db->where('activity_id', $last_activity_id);
			$this->db->update('activity_data'); 
		
		// Else update row
		} else {
			
			// Update node in previous activity
			$data['prev_activity_id'] = $this->activity_model->get_prev_activity_node_from_id($activity_id);
		
			// Update row
			$this->db->where('activity_id', $activity_id);
			$this->db->update('activity_data', $data);
		}

		// Give response
        echo "success. activity_id = ". $activity_id;  
	}
	
}