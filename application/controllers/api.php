<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/
//require APPPATH.'/libraries/REST_Controller.php';

//class api extends REST_Controller
class api extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler(true);
		$this->load->model("ctrl_activity_model", "ctrl_activity_model");
		
		$this->load->model("mod_facebook_model", "facebook_model");
	}	
	public function test_activity_manual_post(){
		/* for ipetfriend use, app_id=2*/
		/*$this->output->enable_profiler(true);
		  $_POST= array(
			'user_inhouse_id' => '161',
			'app_id' => '2',
			'password' => '1302071018',
			'title' => '戀戀很暴力哦~',
			'description' => '戀戀很暴力哦~這是不對的~~ >:( //',
			'last_updated' => date( 'Y-m-d H:i:s'),
			'has_ended' => '1',
			'mode' => 'auto',
			'new_record'=>"yes",
			'coordinates_json' => '[{"coordinate_y":"36.050348","coordinate_x":"138.086115", "time":"2012-10-24 15:19:18"}]',
			'custom_data_json' => '[{"coordinate_y":"36.050348","coordinate_x":"138.086115", "time":"2012-10-24 15:19:18"}]',
		);*/
		//ibike
		$_POST= array(
			'user_inhouse_id' => '161',
			'app_id' => '2',
			'password' => '1302161128',
			'title' => ' :3 其實情人節是橋姬日 (誤) ',
			'description' => ' :3 其實情人節是橋姬日 (誤) 橋姬會從地底跑上來大放妒忌彈幕，目標就是瞄準去死團 >_<  ',
			'last_updated' => date( 'Y-m-d H:i:s'),
			'has_ended' => '1',
			'mode' => 'auto',
			'avg_speed' => '10',
			'avg_temperature' => '25',
			'avg_heart_rate' => '120',
			'total_distance' => '15.2',
			'elapse_time' => '60',
			'elapse_time_sec' => '3600',
			'max_speed' => '15.2',
			'max_heart_rate' => '130',
			'total_calories' => '1534',
			'coordinates_json' => '[{"coordinate_y":"22.42513357","coordinate_x":"114.21185938"},{"coordinate_y":"22.42513211","coordinate_x":"114.21185425"},{"coordinate_y":"22.42513938","time":"2013-02-07 11:15:18","coordinate_x":"114.21185357","speed":"0"}]',
			'custom_data_json' => '[{"time":"2013-02-07 11:15:18","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:19","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:20","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:21","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:22","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:23","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:24","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:25","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:26","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:27","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"}]',
		);
		$this->activity_manual_post();
	}
	function test_activity_photo_post(){
		$this->output->enable_profiler(true);
		//$file=file_get_contents("http://wiki.touhou8.com/uploads/201008/1281160032UCn1ln7D_s.jpg");
		//$file=file_get_contents("http://sns.xiaomei.cc/attachment/temp/img/2011/03/1000/574/img/img_1299688086_9.jpg");
		$file=file_get_contents("http://sphotos-a.ak.fbcdn.net/hphotos-ak-ash4/s480x480/488082_579484832079185_1747318741_n.jpg");
		
		$photo=base64_encode($file);
		
		//$_POST['activity_id']="1301191031";
		$_POST['password']="";
		$_POST['user_inhouse_id']="161";
		$_POST['app_id']="2";
		$_POST['photo']=$photo;
		
		/* if the client need form post normal image without base64_encode
		$_POST['photo']['tmp_name']="upload/12092714.jpg";
		$_POST['photo']['type']='image/jpg';
		$_POST['photo']['error']='0';
		$_POST['photo']['name']='12092714.jpg';
		*/
		//$this->native_session->set('upload_image', $_POST['photo']);
		$this->activity_photo_post();
		//$photo=file_put_contents("upload/12092715.jpg", $photo);
		//echo "<br/>".$this->facebook_model->FBset_mobile_upload($activity_id, $photo)."<br/>";
		echo "finished";
		
	}
	function activity_manual_post() {
		//API
		// POST URL: http://ning.imusictech.net/fansliving/index.php/api/activity_manual/format/json/
		//FOR TESTING ONLY:
		/*$_POST= array(
			'user_inhouse_id' => '63',
			'app_id' => '2',
			'password' => '35832186',
			'title' => 'testing title',
			'description' => 'testing description',
			'last_updated' => date( 'Y-m-d H:i:s'),
			'has_ended' => '1',
			'mode' => 'auto',
			'avg_speed' => '10',
			'avg_temperature' => '25',
			'avg_heart_rate' => '120',
			'total_distance' => '15.2',
			'elapse_time' => '60',
			'elapse_time_sec' => '3600',
			'max_speed' => '15.2',
			'max_heart_rate' => '130',
			'total_calories' => '1534',
			'coordinates_json' => '[{"coordinate_y":"22.42513938","time":"2012-10-24 15:00:18","coordinate_x":"114.21185357","speed":"0"},{"coordinate_y":"22.42513938","time":"2012-10-24 15:00:19","coordinate_x":"114.21185357","speed":"0"},{"coordinate_y":"22.42513938","time":"2012-10-24 15:00:20","coordinate_x":"114.21185357","speed":"0"},{"coordinate_y":"22.42513938","time":"2012-10-24 15:00:21","coordinate_x":"114.21185357","speed":"0"},{"coordinate_y":"22.42513938","time":"2012-10-24 15:00:22","coordinate_x":"114.21185357","speed":"0"},{"coordinate_y":"22.42513938","time":"2012-10-24 15:00:23","coordinate_x":"114.21185357","speed":"0"},{"coordinate_y":"22.42513938","time":"2012-10-24 15:00:24","coordinate_x":"114.21185357","speed":"0"},{"coordinate_y":"22.42513938","time":"2012-10-24 15:00:25","coordinate_x":"114.21185357","speed":"0"},{"coordinate_y":"22.42513938","time":"2012-10-24 15:00:26","coordinate_x":"114.21185357","speed":"0"},{"coordinate_y":"22.42513938","time":"2012-10-24 15:00:27","coordinate_x":"114.21185357","speed":"0"}]',
			'custom_data_json' => '[{"time":"2012-10-24 15:00:18","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:19","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:20","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:21","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:22","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:23","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:24","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:25","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:26","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"},{"time":"2012-10-24 15:00:27","temperature":"0","elevation_gain":"65","calories":"0000","distance":"0","heart_rate":"0"}]',
		);*/
		
		//echo "<br/>api activity manual post";
		$this->ctrl_activity_model->activity_manual_post();
		
		echo "success";
		
	}
	
	// Function to get the client ip address
	public function get_client_ip() {
		$ipaddress = '';
		
		if( getenv('HTTP_CLIENT_IP') )
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
			
		return $ipaddress;
	}
	function test_user_settings_post(){
		$this->output->enable_profiler(true);
		$_GET=array(
			"code"=>"AQDJ2KlI-450aTbMpghCSFWefAIU-R4ppl4X2yV5lKmG5yHig0P4SxCpovrArQr8VcS08ZTN64kdd7yZs_lQ02RyyMsdvPbdSQgJ07emO-3-mIfhg4E_5LcKc7OpKiUfZuF9RmrazVb25WMVOr1btRUkTrEcyiPF2b2gk-JjCMp9mKOEHsxi8FnkXw6kVn6yKFxAUKUJcWeBRpN2inN6LYSC",
			"token"=>"AAABmNfZBuwyMBAEqdZBrKoVAx5oEn8EoC119szv9qhgnk932PIXxcZAXs3KDdbrSSZA0EbS0pBN45Qug7BRjLMSc3gVOmTsJBHSvBAVmSQZDZD"
		);
		$this->user_settings_post();
	}

	function user_settings_post() {
		//API
		// POST URL: http://ning.imusictech.net/fansliving/index.php/api/user_settings/format/json/
		
		//$user_id = $this->post('user_inhouse_id');
		
		// Retrieve data
		/*$user_data=array();
		if(isset($_POST))	
		$user_data = array(
			'user_inhouse_id' => $_POST['user_inhouse_id'],
			'user_id'=> $_POST['user_inhouse_id'],
			'firstname' => $_POST['firstname'],
			'lastname' => $_POST['lastname'],
			'email' => $_POST['email'],
			'language' => $_POST['language'],
			'country' => $_POST['country'],
			'gender' => $_POST['gender'],
			'height' => $_POST['height'],
			'weight' => $_POST['weight'],
			'birthday' => $_POST['birthday'],
			'default_privacy' => "default");
		echo "<br/> api 215 ";
		print_r($user_data);*/
		
		//testing
		/*$this->output->enable_profiler(true);
		$_POST=array(
			"user_inhouse_id"=>"5",
			"app_id"=>"2",
			"phone"=>"35832186",
		 	"device_token"=>"60fd8f7093edbaae8c9129402fae7228c30dfb187ff1a548693729a3f3609efa"
		);*/
		
		//first save the new user_inhouse_data or update the user_inhouse_data
		if($_GET['code']){
			//echo "<br/> api 192 ";	
			$this->load->model("ctrl_login_model", "ctrl_login_model");
			$userinfo=$this->ctrl_login_model->ctrl_save_facebook_login_after_login();
			//print_r($userinfo);
		}
		//then add the activity to show user had install this apps,
		// and post this to facebook
		//...
					
		/*$_POST['receive_friend_notice']="1";
		//echo "<br/> api 251 ";
		$_POST['ip']=$this->get_client_ip();
		
		if(isset($_POST)&&(isset($_POST['user_inhouse_id']))&&($_POST['user_inhouse_id']!='')){
			$user_id = $_POST['user_inhouse_id'];
			$_POST['user_id']= $_POST['user_inhouse_id'];
			
			$fields=$this->init_model->DBget_field_from_table("user_inhouse_data");
			$user_data=array();
			for($i=0;$i<count($fields);$i++){
				if(isset($_POST[$fields[$i]['Field']]))
					$user_data[$fields[$i]['Field']]=$_POST[$fields[$i]['Field']];
			}
			$this->db->where('user_inhouse_id', $user_id);
			$this->db->update('user_inhouse_data', $user_data);
			
			// Install app_user if not installed
			if(isset($_POST['app_id'])){
				$app_id = $_POST['app_id'];
				$query = $this->db->get_where('app_users', array('app_id' => $app_id, 'user_id' => $user_id));
				$existing_data = $query -> result_array();
				if (count($existing_data)==0) {
					//$_POST['default_privacy']="default";
					$fields=$this->init_model->DBget_field_from_table("app_users");
					$app_users_data=array();
					for($i=0;$i<count($fields);$i++){
						if(isset($_POST[$fields[$i]['Field']]))
							$app_users_data[$fields[$i]['Field']]=$_POST[$fields[$i]['Field']];
					}
					$this->db->set("last_updated", date("Y-m-d H:i:s"));
					$this->db->set("default_privacy", "default");
					$this->db->insert('app_users', $app_users_data);
					// Post to community
					$userinfo=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($user_id);
					$app_name=$this->activity_model->DBget_app_name_by_app_id($app_id);
					$_POST['mode']="install_app";
					$_POST['title'] = $userinfo['nickname']." installed ".$app_name.".";
					$_POST['description'] = $userinfo['nickname']." had  installed ".$app_name.". Welcome to fansliving.";
					
					$this->activity_manual_post();
					//$this->activity_model->DBset_new_community($_POST['app_id'], $activity_id, $_POST['user_inhouse_id'], $_POST['title']);
					//create init activity
				}else{
					
					$_POST['default_privacy']="default";
					$fields=$this->init_model->DBget_field_from_table("app_users");
					$app_users=array();
					for($i=0;$i<count($fields);$i++){
						if(isset($_POST[$fields[$i]['Field']]))
							$app_users[$fields[$i]['Field']]=$_POST[$fields[$i]['Field']];
					}
					$this->db->set("last_updated", date("Y-m-d H:i:s"));
					$this->db->where("app_id", $app_users['app_id']);
					$this->db->where("user_id", $app_users['user_id']);
					$this->db->update('app_users', $app_users);
				}
			}
		}
		 * */
			echo "success";
		
		
		/*
		// Update row
		$this->db->where('user_inhouse_id', $user_id);
		$this->db->update('user_inhouse_data', $user_data);

		// Install app if not installed
		$app_id = 1;
		$userinfo=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($user_id);
		$query = $this->db->get_where('app_users', array('app_id' => $app_id, 'user_id' => $user_id));
		$existing_data = $query -> result_array();
		if (count($existing_data)==0) {
			$app_users_data = array( 'app_id' => $app_id, 'user_id' => $user_id, 'default_privacy'=>"default");
			$this->db->insert('app_users', $app_users_data);
			// Create news
			$this->news_model->post_news_to_outbox($user_id, 0, $app_id, "install_app");
		}

		// Give response
        $this->response(array('status' => 'success'), 200);  
		 */
		
	}
    
	
	
	function activity_photo_post() {
		//API
		//echo "<br/>controller api 149 testing<br/>";
		// POST URL: http://ning.imusictech.net/fansliving/index.php/api/activity_photo/format/json/
		/*
		$_POST=array(
			"activity_id"=>"",
		    "mode"=>"",
		    "server"=>"",
		    "files"=>"file ..."
		); */
		//$this->output->enable_profiler(true);
		//echo "<br/>api activity photo post";
		$this->ctrl_activity_model->activity_photo_post($_POST);

	}
	
	function get_news_post($app_id) {
		// GET URL: http://ning.imusictech.net/fansliving/index.php/api/get_news/format/json/
		/*
		$this -> db -> select('news_text, last_updated');
		$this->db->where("app_id", $app_id);
		$query = $this -> db -> get('app_news_outbox_201209');
		$data = $query -> result_array();
		
		// Give response
		if (count($data)>0) {
			echo json_encode($data);	
			//$this->response($data, 200);
		} else {
			echo "no news";
			//$this->response("No news", 200);
		}
		*/
	}
	
	function activity_has_ended() {
		//API
		// GET URL: http://ning.imusictech.net/fansliving/index.php/api/activity_has_ended/format/json/
		
		$result=$this->activity_model->get_activity_from_password($_POST['password']);
		$activity_id =$result['activity_id']; 
		
		$has_ended = $_POST['has_ended'];
		
		if ($activity_id!=null) {
			
			$this->db->set('has_ended', $has_ended);
			$this->db->where('activity_id', $activity_id);
			$this->db->update('activity_data');
		}
		
		// Give response
		if ($has_ended==0) {
			$this->response("Activity is live.", 200);
		} else if($has_ended==1) {
			$this->response("Activity has ended", 200);
		} else {
			$this->response("Error. Activity_id = ".$activity_id, 200);
		}
		
	}
	
}