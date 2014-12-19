<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile_page extends CI_Controller {
	public $login, $personal, $user_info, $user_id;	
	function __construct()
	{
		parent::__construct();
		$this->load->model("init_model");
		$this->load->model("login_model");
		$this->load->library("native_session");
		$this->load->library('googlemaps');
		$this->load->model("googlemaps_model");
		$this->load->model("profile_model");
		$this->load->model("activity_model");
		$this->load->model("comments_model");
		$this->load->model("user_model");
		
		$this->output->enable_profiler(false);	//debug function

		//will kick user out of this controller if not log-in		
		$function = $this -> uri -> segment(2, "");
		if(($this->user_info = $this->native_session->get("userinfo"))==null)	
		{
			$this->personal=false;
			$this->user_id=null;
		}else{
			$this->personal=true;
			$this->user_id=$this->user_info['user_inhouse_id'];
		}
		
		//$this->user_id = $user_info['user_inhouse_id'];
	}	
	function __destruct() {
    	$this->init_model->destroy_sensitive_session();
    }
	public function index(){
		
	}
	public function page_user_profile(){
		$data['user_id'] = $this->uri->segment(3, $this->user_id);
		$data = $this->get_page_user_profile_data($data); //note - data will pass-through in the function
		$this->load->view("profile_page/page_user_profile", $data);
	}
	
	public function page_device(){
		$data['user_id'] = $this->uri->segment(3, $this->user_id);
		$data['app_id'] = $this->uri->segment(4, 'device_app_id');
		$data['activity_id'] = $this->uri->segment(5, '0');
		//$data['activity_id'] = 0;
		//
		//echo "<br/>profile_page 47";
		$data = $this->profile_model->get_page_device_data($data);	//note - data will pass-through in the function
		//print_r($data);
		if($data['activity_id']==0)
		$this->load->view("profile_page/page_device", $data);		
	}

	public function iframe_photo()
	{
		$data['user_id'] = $this->uri->segment(3, $this->user_id);
		$data['profile_images']=$this->profile_model->get_user_lastest_photos($data['user_id']);
		$this->load->view("profile_page/block_photo", $data);
	}
	
	public function iframe_summary()
	{
		$data = $_GET;
		
		$activity_id = $data['activity_id'];
		
		$data['color_hex']['normal']=$data['color_hex_normal'];
		$data['color_hex']['shaded']=$data['color_hex_shaded'];

		$data['chart_data']=$this->profile_model->get_summary_data($data['user_id'], $data['app_id']);
		$this->load->view("profile_page/iframe_summary", $data);
	}

	public function iframe_map()
	{
		$activity_id = $this->uri->segment(3);
		
		$data['map'] = $this->googlemaps_model->get_recent_map_small($activity_id);
		$this->load->view("profile_page/iframe_map", $data);
	}
	
	public function iframe_activity_smiley()
	{
		$activity_id = $this->uri->segment(3);
		$user_id = $this->user_id;
		
		$data = array(
			'activity_id' => $activity_id,
			'comment_user_id' => $user_id,);
			
		$this->comments_model->refresh_smiley($data);
	} 
	
	public function iframe_activity_comments()
	{
		
		$activity_id = $this->uri->segment(3);
		$app_id=$this->uri->segment(4);
		
		if($this->personal==true){
			$user_id = $this->user_id;
			
			$data = array(
				'activity_id' => $activity_id,
				'app_id'=>$app_id,
				'comment_user_id' => $user_id
			);
		}else{
			$data = array(
				'activity_id' => $activity_id,
				'app_id'=>$app_id,
				'comment_user_id' => null
			);
		}		
		//$this->load->view("profile_page/block_activity_comments", $data);
		$this->comments_model->refresh_comment_box($data);
		
	} 
	
	
	public function ajax_get_record_analysis() {

		
		$activity_id = $_GET['activity_id'];
		if (!$activity_id) {
			//echo" no activity id !";
			exit();
		}
		$params = unserialize(urldecode($_GET['param']));  
		$this->load->model("sample_widget_model");
		$data['chart'] = $this->sample_widget_model->get_chart_data($activity_id);
		
		$tmp=$data['chart']['coordinates_json'];
		$tmp2=$data['chart']['custom_data_json'];
		$coordinate_arr=json_decode($tmp, true);
		$custom_arr=json_decode($tmp2, true);
		
		//print_r($coordinate_arr);
		//get most updated 15 record
		$updated_coordinate_arr= array_slice($coordinate_arr, -50, 50, true);
		$updated_custom_arr= array_slice($custom_arr, -50, 50, true);
		
		$new_coordinate_arr=array();
		$new_custom_arr=array();
		if (is_array($updated_coordinate_arr)) {
			foreach ($updated_coordinate_arr as $update_coordinate) {
				$new_coordinate_arr[]=$update_coordinate;
			}			
		}
		if (is_array($updated_custom_arr)) {
			foreach ($updated_custom_arr as $updated_custom) {
				$new_custom_arr[]=$updated_custom;
			}			
		}
		
		$update_coordinate_json=json_encode($new_coordinate_arr);
		$update_custom_json=json_encode($new_custom_arr);
		
		$return=$update_coordinate_json."||".$update_custom_json;
		echo $return;
	}
	
	public function iframe_record_analysis()
	{
		$data = $_GET;
		
		$activity_id = $data['activity_id'];
		
		$data['color_hex']['normal']=$data['color_hex_normal'];
		$data['color_hex']['shaded']=$data['color_hex_shaded'];
		
		//TODO: use param instead of "hardcoded model" below
		$params = unserialize(urldecode($data['param']));  
		$this->load->model("sample_widget_model");
		$data['activity'] = $this->sample_widget_model->get_cycle_data($activity_id);
		$data['chart'] = $this->sample_widget_model->get_chart_data($activity_id);
		
		foreach($params as $key => $param)
		{
			$data['block_record_analysis_field'][$key]['name'] = $param['name'];
			$data['block_record_analysis_field'][$key]['title'] = $param['title'];
		}
		
		$this->load->view("profile_page/iframe_record_analysis", $data);
	} 
	
	public function nyro_daily_record_analysis()
	{
		//this->load->model("sample_widget_model");
		//$data['activity'] = $this->sample_widget_model->get_cycle_data($this->user_id);
		//$data['chart'] = $this->sample_widget_model->get_chart_data($this->user_id);	
		//$data['user_id'] = $this->uri->segment(3, $this->user_id);		
		//$this->load->view("profile_page/nyro_daily_record_analysis", $data);
		
		$activity_id = $this->uri->segment(3, 1);		
		//$activity_id = $this->activity_model->get_user_most_recent_activity_id($data['user_id']);
		
		//TODO: use param instead of "hardcoded model" below
		//$params = unserialize(urldecode($data['param']));  
		$this->load->model("sample_widget_model");
		$data['activity'] = $this->sample_widget_model->get_cycle_data($activity_id);
		$data['chart'] = $this->sample_widget_model->get_chart_data($activity_id);
		
		/*foreach($params as $key => $param)
		{
			$data['block_record_analysis_field'][$key]['name'] = $param['name'];
			$data['block_record_analysis_field'][$key]['title'] = $param['title'];
		}*/

		
		
		$this->load->view("profile_page/nyro_record_analysis", $data);
	}
	
	public function nyro_speed_record()
	{
		$data['user_id'] = $this->uri->segment(3, $this->user_id);		
		$this->load->view("profile_page/nyro_speed_record", $data);
	}
	
	public function nyro_data_comparison_with_friends()
	{
		$data['user_id'] = $this->uri->segment(3, $this->user_id);		
		$this->load->view("profile_page/nyro_data_comparison_with_friends", $data);
	}

	public function nyro_recent_activities_map()
	{
		$activity_id = $this->uri->segment(3, 1);
		$data['map'] = $this->googlemaps_model->get_recent_map_large($activity_id);
		$this->load->view("profile_page/nyro_recent_activities_map", $data);
	}

	public function nyro_routes()
	{
		$data['user_id'] = $this->uri->segment(3, $this->user_id);		
		$this->load->view("profile_page/nyro_routes", $data);
	}
			
	public function nyro_news_feed()
	{
		$data['user_id'] = $this->uri->segment(3, $this->user_id);		
		$this->load->view("profile_page/nyro_news_feed", $data);
	}
			
	public function nyro_featured_persons()
	{
		$data['user_id'] = $this->uri->segment(3, $this->user_id);		
		$this->load->view("profile_page/nyro_featured_persons", $data);
	}
										
	public function nyro_photo_content($imageid=1)
	{
		$data['user_id'] = $this->uri->segment(3, $this->user_id);
		
		$data['image']=$this->profile_model->get_user_lastest_photo($data['user_id']);
			
			for($i=0;$i<count($data);$i++){
				if($imageid==$data['image'][$i]['image_id']){
					$tmp=$data['image'][0];
					$data['image'][0]=$data['image'][$i];
					$data['image'][$i]=$tmp;
			}	
		}
		$data['imagenum']=$imageid;
		$this->load->view("profile_page/block_photo_content", $data);
	}
	
	public function nyro_photo_content_activity()
	{
		$activity_id = $this->uri->segment(3);
		
		$data['image']=$this->profile_model->get_activity_photos($activity_id);
		$this->load->view("profile_page/block_photo_content", $data);
	}
	
	public function nyro_add_device()
	{
		$data['user_id'] = $this->uri->segment(3, $this->user_id);		
		$this->load->view("profile_page/nyro_add_device", $data);
	}
			
	public function nyro_activity_calendar()	//I know this is ugly, i'm working on it now - judy
	{
		$data['user_id'] = $this->uri->segment(3, $this->user_id);		
		$data['year'] = $this->uri->segment(4, date('Y'));
		$data['month'] = $this->uri->segment(5, date('m'));
		//$data['menu_item'] = array(array('EvEnts', ''), array('Enquiry', site_url('general/enquiry?topic=events%20this%20month')));			
		$prefs = array (
               'show_next_prev'  => TRUE,
               'next_prev_url'   => site_url("profile_page/nyro_activity_calendar/{$data['user_id']}"),
               'day_type'   => 'short',
               'template' => $this->profile_model->get_calendar_template(),			   
             );
		$this->load->library('calendar', $prefs);		
		$calendar_red = $this->profile_model->generate_red_dates_calendar_array($data['year'], $data['month']);
		$next_month = ($data['month']==12)?1:$data['month']+1;
		$start_date = "{$data['year']}-{$data['month']}-1";
		$end_date = "{$data['year']}-{$next_month}-1";
		$activities = $this->profile_model->get_user_activities_for_calendar($data['user_id'], $start_date, $end_date);					 
		//get an generate the HTML for the calendar box
		$data['calendar'] = $this->calendar->generate($data['year'],$data['month'],'',$activities,$calendar_red);					 
		//$data['calendar'] = $this->calendar->generate($data['year'], $data['month'],   $calendar_festivals, $calendar_events, $calendar_red);
		//$data['calendar'] = $this->calendar->generate($data['year'], $data['month']);
		$this->load->view("profile_page/nyro_activity_calendar", $data);
	}

	public function nyro_activity_comments()
	{
		$data['activity_id'] = $this->uri->segment(3, 1);
		$data['comment_user_id'] = $this->user_id;
		$data['comments_array'] = $this->comments_model->get_comments_for_activity($data['activity_id'], $this->user_id, 'nyro');
		$this->load->helper('form');
		$this->load->view("profile_page/nyro_activity_comments", $data);
	}
	
	public function nyro_all_friends()
	{
		$data['user_id'] = $this->uri->segment(3);
		$data['friends_data'] = $this->friends_model->getdatafriendsid($data['user_id'],array("user_inhouse_id", "firstname", "lastname", "country", "profile_image"));
		foreach ($data['friends_data'] as $key => $value) {
			$data['friends_data'][$key]['apps_installed'] = count($this->user_model->get_user_installed_apps($value['user_inhouse_id']));
		}
		$this->load->view("profile_page/nyro_all_friends", $data);
	}
	
	public function form_submit() {
		if ($this->input->post('post')) {
			$this->comments_model->post_comment($this->input->post(NULL, TRUE));
		} else if ($this->input->post('like')){
			$this->comments_model->like($this->input->post(NULL, TRUE));
		} else if ($this->input->post('dislike')){
			$this->comments_model->dislike($this->input->post(NULL, TRUE));
		} else if ($this->input->post('share')){
			$this->comments_model->share($this->input->post(NULL, TRUE));
		} else if ($this->input->post('comments')){
			//$this->comments_model->comments($this->input->post(NULL, TRUE));
		} else if ($this->input->post('DeleteComment')){
		} else {
			$this->comments_model->change_smiley($this->input->post(NULL, TRUE));
		}
	}
	
	public function feedback_count() {
		$data['news_type'] = $this->uri->segment(3);
		$data['source_id'] = $this->uri->segment(4);
		$data['comment_user_id'] = $this->uri->segment(5);
		$data['like_dislike'] = $this->uri->segment(6);
		$this->comments_model->change_feedback_js($data);
	}
				
}
?>