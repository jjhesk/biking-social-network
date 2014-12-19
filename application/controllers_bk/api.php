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
		$this->load->model("activity_model");
		$this->load->model("googlemaps_model");
		$this->load->model("facebook_model");
		$this->load->model("google_model");
		$this->load->model("news_model");
		$this->load->model("user_model");
	}	
	function test_setfansliving(){
		$this->output->enable_profiler(true);
		/*$_POST=array(
			"app_id"=>"",
			"user_inhouse_id"=>"",
			"table"=>"",
			"token"=>"",
			"mode"=>"",
			"custom_data_json"=>"",
		);*/
		//for ihealth_weight upload 
		/*$_POST=array(
			"app_id"=>"3",
			"user_inhouse_id"=>"63",
		 	"token"=>"",
		 	"title"=>"Chirno has measure her weight at 2012-12-24 14:44:10.",
		 	"table"=>"activity_data",
		 	"mode"=>"ihealth_weight", //require and hardcode
		 	"name"=>"Chirno",
			"privacy"=>"default", //require and hardcode
			"new_record"=>"yes", //require and hardcode
			"description"=>"Chirno has measure her weight at 2012-12-24 14:44:10, her weight is 3 KG.",
			"custom_data_json"=>'[{"weight":"3 KG"}]',
		);*/
		//for testing upload device and photo for app_users_data
		/*$_POST=array(
			"app_id"=>"2",
			"user_inhouse_id"=>"63",
		 	"token"=>"",
		 	"table"=>"app_users_data",
			"bluetooth_device_uuid"=>"1301191132",
			"name"=>"Utsuho",
			"description"=>"Utsuho is a Raven who live in the hell. She is Rin's best friend and Satori's pet.",
			"custom_data_json"=>'[{"Age":"100 years old", "Sex":"Female", "Variety":"Raven",  "description":"Utsuho is a Raven who live in the hell. She is Rin\'s best friend and Satori\'s pet."}]',
		);*/
		
		
		$file=file_get_contents("https://fbcdn-sphotos-e-a.akamaihd.net/hphotos-ak-ash3/71837_209998885804550_1698893015_n.jpg");
		$photo=base64_encode($file);
		$_POST=array(
		    "app_id"=>"2",
			"user_id"=>"63",
			"user_inhouse_id"=>"63", //require or user_id
			"table"=>"app_users_data",
			"token"=>"",
			"mode"=>"photo",
			"bluetooth_device_uuid"=>"5347490168001830ea95c2",
		);
		$_POST['photo']=$photo;
		
		
		/*
		$_POST=array(
		    "app_id"=>"2",
			"user_id"=>"5",
			"user_inhouse_id"=>"", //require or user_id
			"table"=>"activity_data",
			"token"=>"",
			"mode"=>"pet_lose",
			"new_record"=>"yes",
			"bluetooth_device_uuid"=>"5347490168001831851d52",
			"custom_data_json"=>'[{"name":"long","time":"2013-01-24-09-25-23","location":[{"coordinate_x":"114.211723","coordinate_y":"22.425031","time":"2013-01-24-09-25-18"}],"image":"","reward":"100000","widget":"pet_notice"}]',
			"coordinates_json"=>'[{"coordinate_x":"114.211804","coordinate_y":"22.425052","time":"2013-01-11 09:18:49"}]'
		);
		*/
		/*$_POST=array(
		 		"app_id"=>"2",
				"user_id"=>"63",
				"table"=>"user_relation",
				"token"=>"",
				"mode"=>"add_friend",
		 		"subject_user_id"=>"63",
		 		"object_user_id"=>"5"
		  );*/	
		/*$_POST=array(
			"app_id"=>"2",
			"user_inhouse_id"=>"5", // not the owner
			//"user_inhouse_id"=>"63", //the owner
		 	"token"=>"",
		 	"table"=>"activity_data",
		 	"mode"=>"pet_found",
			"bluetooth_device_uuid"=>"5347490168001831851d52",
			"coordinates_json"=>'[{"time":"2012-12-24 11:10:28","coordinate_y":"36.050348","coordinate_x":"138.086115"}]',
			"new_record"=>"yes",//require and hardcode, if new_record does not exist, then it will update and view as previous update..
			//"privacy"=>"no", //if this happen, the description will not display reporter name and his phone, only show up the coordinate
			"custom_data_json"=>'[{"Age":"100 years old", "Sex":"Female", "Variety":"Raven",  "description":"Utsuho is appear in the Lake Suwa at 2013-01-19 about 02 PM, she is melting Chirno."}]',
		);*/
		/*$_POST=array(
			"app_id"=>"2",
			"user_inhouse_id"=>"63",
		 	"token"=>"",
		 	"table"=>"activity_data",
		 	"mode"=>"pet_lose",
			"bluetooth_device_uuid"=>"1301191132",
			//"coordinates_json"=>'[{"time":"2012-12-24 11:10:28","coordinate_y":"22.28796","coordinate_x":"114.13525"}]',
			"coordinates_json"=>'[{"time":"2012-12-24 11:10:28","coordinate_y":"36.050348","coordinate_x":"138.086115"}]',
			"new_record"=>"yes",//require and hardcode
			"custom_data_json"=>'[{\"Age\":\"100 years old\", \"Sex\":\"Female\", \"Variety\":\"Raven\", \"description\":\"Utsuho is a Raven who live in the hell. She is Rin\'s best friend and Satori\'s pet.\"}]',
		);*/
		/*$_POST=array(
			"app_id"=>"2",
			"user_inhouse_id"=>"5",
		 	"token"=>"",
		 	"table"=>"user_relation",
		 	"mode"=>"denied_friend",
		 	"subject_user_id"=>"63", //target's 
		 	"object_user_id"=>"5" //myself
		);*/
		/*$_POST=array(
			"app_id"=>"2",
			"user_inhouse_id"=>"5",
		 	"token"=>"",
		 	"table"=>"activity_data",
		 	"mode"=>"accept_friend",
		 	"subject_user_id"=>"63", //target's 
		 	"object_user_id"=>"5", //myself
		 	"new_record"=>"yes"
		);*/
		/*$_POST=array(
			"app_id"=>"2",
			"user_inhouse_id"=>"5",
		 	"token"=>"",
		 	"table"=>"activity_data",
		 	"mode"=>"vote",
		 	"votee_id"=>"49", //target's id, most likey the app_users_data_id
		 	"vote_id"=>"1", //hardcode
		 	"new_record"=>"yes"
		);*/
		$this->setfansliving();
	}
	function setfansliving(){
		
		if(isset($_POST['table'])){
			if( (isset($_POST['mode']))&&( ($_POST['mode']=="manual")||($_POST['mode']=="auto") ) ){
				$this->activity_manual_post();
			}else{
				if((isset($_POST['title']))&&($_POST['title']=="") ){
					$_POST['title']=$_POST['description'];
					$_POST['title']=strstr($_POST['title'], '.', true);
					$_POST['title']=strstr($_POST['title'], ',', true);
					$_POST['title'].='.';
				}
				if( (isset($_POST['q']))&&($_POST['q']!='') ){
					$jsons=json_decode($_POST['q']);
					$wrong=false;
					for($i=0;$i<count($jsons);$i++){
						$this->load->model("activity_model");
						$result=$this->activity_model->DBset_api_input($jsons[$i]);
					}
					echo "success";
				}else{
					$this->load->model("activity_model");
					$result=$this->activity_model->DBset_api_input($_POST);
					echo "success";
				}
			}
		}else{
			echo "no input";
		}
	}
	public function test_getfansliving(){
		$this->output->enable_profiler(true);
		/*	$post=array(
				"app_id"=>$this->post('app_id'),
				"user_inhouse_id"=>$this->post('user_inhouse_id'),
				"request_type"=>$this->post('request_type'),
				"request_key"=>$this->post('request_key'),
				"token"=>$this->post('token'),
				"custom_data_json"=>$this->post('custom_data_json'),
			);
		echo json_encode($post);*/
		//$this->response($post, 200);
		//if(count($_POST)>0){
			//$post=$_POST;
			/*$post=array(
				"app_id"=>$this->post('app_id'),
				"user_inhouse_id"=>$this->post('user_inhouse_id'),
				"request_type"=>$this->post('request_type'),
				"request_key"=>$this->post('request_key'),
				"token"=>$this->post('token'),
				"custom_data_json"=>$this->post('custom_data_json'),
			);*/
		/*$_POST=array(
			"app_id"=>"2",
			"user_inhouse_id"=>"5",
			"request_type"=>"friend_list",
			"request_key"=>"",
			"token"=>"",
		);*/
		/*$_POST=array(
			"app_id"=>"2",
			"user_inhouse_id"=>"5",
			"request_type"=>"lost_pet",
			//"request_key"=>'[{"bluetooth_device_uuid":"1301191132"}]',
			"token"=>"",
		);*/
		/*$_POST=array(
			"app_id"=>"2",
			"user_inhouse_id"=>"5",
			"request_type"=>"pet_list",
			"request_key"=>"",
			"token"=>"",
		);*/
		/*$_POST=array(
			"user_inhouse_id"=>"5",
			"app_id"=>"2",
			"request_type"=>"nearby_list",
			"request_key"=>'[{"bluetooth_device_uuid":"5347490168001831851d52"}]',
			"coordinates_json"=>'[{"time":"2013-01-29 11:10:28","coordinate_y":"36.050348","coordinate_x":"138.086115"}]',
			"token"=>""
		);*/
		//$this->response($_POST, 200);
		/*$_POST=array(
			"app_id"=>"1",
			"user_inhouse_id"=>"63",
			"request_type"=>"leaderboard",
			"request_key"=>'[{"app_id":"3"}]',
			"token"=>"",
		);
		$_GET['q']=json_encode($_POST);*/
		//$_POST=$this->input->post();
		//print_r($_POST);
		//$post=$this->post();
		$this->getfansliving();
	}
	public function getfansliving(){
		if(isset($_POST['request_type'])){
			$post=$_POST;
			if(isset($post)){
				//$get=json_decode($_POST['q'], true);	
				$this->load->model("activity_model");
				$result=$this->activity_model->DBget_api_output($post);
				//result=array_merge($result, array('template_name'=>"friend_list"));
				//echo "<br/>testing_fenix 38 ";
				//print_r($result);
				//$this->response($this->activity_model->api_output_template($post['request_type'], $result), 200);
				if($result!="false"){
					echo $this->activity_model->api_output_template($post['request_type'], $result);
				}else{
					echo "no record3";
				}	
			}else{
					echo "no record2";
			}
		}else{
				echo "no record1";
		}
		//}
		//echo "api 65"
		//$this->response("sanae", 200);
		//$this->response("false", 200);
	}
	public function test_activity_manual_post(){
		/* for ipetfriend use, app_id=2*/
		$this->output->enable_profiler(true);
		  $_POST= array(
			'user_inhouse_id' => '63',
			'app_id' => '2',
			'password' => '1302041108',
			'title' => '最近我們和山女一起去泡溫泉哦~~',
			'description' => '最近我們和山女一起去泡溫泉哦~~',
			'last_updated' => date( 'Y-m-d H:i:s'),
			'has_ended' => '1',
			'mode' => 'auto',
			'new_record'=>"yes",
			'coordinates_json' => '[{"coordinate_y":"36.050348","coordinate_x":"138.086115", "time":"2012-10-24 15:19:18"}]',
			'custom_data_json' => '[{"coordinate_y":"36.050348","coordinate_x":"138.086115", "time":"2012-10-24 15:19:18"}]',
		);
		$this->activity_manual_post();
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
		
		//echo "<br/>api 56";
		$this->activity_model->activity_manual_post();
		
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
		$_POST=array(
			"user_inhouse_id"=>"5",
			"app_id"=>"2",
			"phone"=>"35832186",
		 	"device_token"=>"60fd8f7093edbaae8c9129402fae7228c30dfb187ff1a548693729a3f3609efa" //device_token for push notification
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
		$_POST['receive_friend_notice']="1";
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
					// Create news
					$this->news_model->post_news_to_outbox($user_id, 0, $app_id, "install_app");
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
			echo "success";
		
		}
		
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
    
	function test_activity_photo_post(){
		$this->output->enable_profiler(true);
		//$file=file_get_contents("http://wiki.touhou8.com/uploads/201008/1281160032UCn1ln7D_s.jpg");
		//$file=file_get_contents("http://sns.xiaomei.cc/attachment/temp/img/2011/03/1000/574/img/img_1299688086_9.jpg");
		$file=file_get_contents("http://www.olgame.tw/home/attachment/201107/19/36123_1311069808N1m3.jpg");
		
		$photo=base64_encode($file);
		
		//$_POST['activity_id']="1301191031";
		$_POST['password']="1302041108";
		$_POST['user_inhouse_id']="5";
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
			$password="";
			if( (isset($_POST['password']))&&($_POST['password']!='') ){
				$password=$_POST['password'];
			}else{
				$password=$_POST['activity_id'];
			}
			$result=$this->activity_model->get_activity_from_password($password);
			/* AAAHTUJ0F8LsBAAAwLnFMNzOIxeib0pYTKzSZA1OgjZBFCIm98Mu2aZARcpExK3Fdg66c8E5QXSot4IitjO4NPPiBrLJ6g0DlpJ8DmBQ7CVsSgN65krQ */
			// If no activity made yet, create one
			if($result==null) {
				$real_activity_id = $this->activity_model->create_new_activity(
					$_POST['user_inhouse_id'], 
					$_POST['app_id'], $password
				);
			}else{
				$real_activity_id = $result['activity_id'];
			}
			
			//for testing
			//$result=$this->activity_model->get_activity_from_password($_POST['activity_id']);
			$userinfo=$this->login_model->DBget_user_inhouse_info_by_user_inhouse_id($_POST['user_inhouse_id']);
			
			if($userinfo['photo_publication']=="facebook"){
				$postback = $this->facebook_model->FBset_mobile_upload($real_activity_id, $_POST['photo']);
			}else if($userinfo['photo_publication']=="google"){
				
			}	
			// Check error message
			$postback_string;
			switch ($postback) {
				case '-1':
					$postback_string = "This facebook token may be expired.";
					break;
				case '-2':
					$postback_string = "This activity's owner does not have facebook account.";
					break;
				case '-3':
					$postback_string = "No activity data has been found.";
					break;
				default:
					$postback_string = "Upload successful!";
					break;
			}
			
			
			// Give response
			if ($postback_string) {
				//$this->response($postback_string, 200);
				echo $postback_string;
			} else {
				//$this->response("Unknown error. Please try again later.", 200);
				echo "Unknown error. Please try again later.";
			}
			$this -> activity_model -> update_activity_nodes(0);
	}
	
	function get_news_post($app_id) {
		// GET URL: http://ning.imusictech.net/fansliving/index.php/api/get_news/format/json/
		
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
	/* should be deprecated, I have copy this to googlemap_model.php*/
	function get_location_by_latitude_longitude_from_google($x, $y, $field){
   		$results=json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=".$x.",".$y."&sensor=false"), true);
   		//print_r($results);
   		
   		if($field == 'title') {
   			if($results['status']!='ZERO_RESULTS'){
      			return $results['results'][0]['formatted_address'];
   			}else{
      			return 'Activity';
   			}
		} else {
			 if($results['status']!='ZERO_RESULTS'){
			 	$address_count = count($results['results'][0]['address_components']);
      			return $results['results'][0]['address_components'][$address_count-2]['long_name'];
   			}else{
      			return null;
   			}
		}
	}
}