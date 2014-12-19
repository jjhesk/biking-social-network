<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage Demos
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * PHP sample code for the Photos data API.  Utilizes the
 * Zend Framework Gdata components to communicate with the Google API.
 *
 * Requires the Zend Framework Gdata components and PHP >= 5.1.4
 *
 * You can run this sample from a web browser.
 *
 * NOTE: You must ensure that Zend Framework is in your PHP include
 * path.  You can do this via php.ini settings, or by modifying the
 * argument to set_include_path in the code below.
 *
 * NOTE: As this is sample code, not all of the functions do full error
 * handling.
 */

class Google_model extends CI_Model { 
	 
	function __construct(){
		/**
		 * @see Zend_Loader
		 */
		/**
		 * @see Zend_Gdata
		 */
		parent::__construct();
		$this->load->model("init_model");
		$this->load->model("activity_model");
		$this->load->library("native_session");
		$this->load->model("google_picasa_model", "google_picasa");
	} 
                 	
	public function google_get_oauth($return_url){
			/*$tmp_image=$this->activity_model->save_tmp_image($FILES['photo']);
			if($tmp_image!=''){			
				//save the image and comment in the native_session
				$this->native_session->set("image", $tmp_image);
			}*/
			//$url=$this->google_picasa->getAuthSubUrl(site_url()."/testing_fenix/post_google_image_after_oauth_login");		
			$url=$this->google_picasa->getAuthSubUrl($return_url);		
			header("location: ".$url);
	}
	public function upload_google_image($userinfo, $access_token){
		return $this->google_picasa->upload_google_image($userinfo, $access_token);
	}
	
	public function post_activity_to_google($FILES, $POST){
		//LV1
			$tmp_image=$this->activity_model->save_tmp_image($FILES['photo']);
			if($tmp_image!=''){			
				//save the image and comment in the native_session
				$this->native_session->set("image", $tmp_image);
				$this->native_session->set("comment", $POST['comment']);
			}
			$url=$this->google_picasa->getAuthSubUrl(site_url()."/portal/post_activity_google_after_oauth_login");		
			header("location: ".$url);
		}
	
	public function DBset_google_oauth($access_token, $overwrite=true){
		$userinfo=$this->native_session->get("userinfo");
		$check=$this->DBget_google_oauth_by_oauth_server_id($access_token);
		if(count($check)==0){
			$this->db->set('oauth_server_id', $access_token);
			$this->db->set('oauth_server_name', "google");
			$this->db->set('oauth_update_time', 'NOW()');
			$this->db->set('user_inhouse_id', $userinfo['user_inhouse_id']);
			$this->db->insert('user_oauth');
			return true;
		}else if($overwrite==true){
			$this->db->set('oauth_server_id', $access_token);
			$this->db->set('oauth_update_time', "now()");
			$this->db->where('user_inhouse_id', $userinfo['user_inhouse_id']);
			$this->db->where('oauth_server_name', "google");
			$this->db->update('user_oauth');
		}else{
			return false;
		}
	}
	public function DBget_google_oauth_by_oauth_server_id($oauth_server_id){
		$this->db->where("oauth_server_id", $oauth_server_id);
		$this->db->where("oauth_server_name", "google");
		$query=$this->db->get("user_oauth");
		return $query->result_array(); 
	}
	public function DBget_google_oauth_by_user_inhouse_id($user_inhouse_id){
		$this->db->where("user_inhouse_id", $user_inhouse_id);
		$this->db->where("oauth_server_name", "google");
		$query=$this->db->get("user_oauth");
		$result=$query->result_array();
		return $result[0]; 
	}
	
	
	/**
	 * Processes loading of this sample code through a web browser.  Uses AuthSub
	 * authentication and outputs a list of a user's albums if succesfully
	 * authenticated.
	 *
	 * @return void
	 */
	function LV1_processPageLoad()
	{
	    global $_SESSION, $_GET;
	    if (!isset($_SESSION['sessionToken']) && !isset($_GET['token'])) {
	        requestUserLogin('Please login to your Google Account.');
	    } else {
	        $client = getAuthSubHttpClient();
	        if (!empty($_REQUEST['command'])) {
	            switch ($_REQUEST['command']) {
	                case 'retrieveSelf':
	                    outputUserFeed($client, "default");
	                break;
	                case 'retrieveUser':
	                	outputUserFeed($client, $_REQUEST['user']);
	                break;
	                case 'retrieveAlbumFeed':
	                    outputAlbumFeed($client, $_REQUEST['user'], $_REQUEST['album']);
	                break;
	                case 'retrievePhotoFeed':
	                    outputPhotoFeed($client, $_REQUEST['user'], $_REQUEST['album'], $_REQUEST['photo']);
	                break;
	            }
	        }
	
	        // Now we handle the potentially destructive commands, which have to
	        // be submitted by POST only.
	        if (!empty($_POST['command'])) {
	            switch ($_POST['command']) {
	                case 'addPhoto':
	                    addPhoto($client, $_POST['user'], $_POST['album'], $_FILES['photo']);
	                    break;
	                case 'deletePhoto':
	                    deletePhoto($client, $_POST['user'], $_POST['album'],
	                        $_POST['photo']);
	                    break;
	                case 'addAlbum':
	                    addAlbum($client, $_POST['user'], $_POST['name']);
	                    break;
	                case 'deleteAlbum':
	                    deleteAlbum($client, $_POST['user'], $_POST['album']);
	                    break;
	                case 'addComment':
	                    addComment($client, $_POST['user'], $_POST['album'], $_POST['photo'],
	                        $_POST['comment']);
	                    break;
	                case 'addTag':
	                    addTag($client, $_POST['user'], $_POST['album'], $_POST['photo'],
	                        $_POST['tag']);
	                    break;
	                case 'deleteComment':
	                    deleteComment($client, $_POST['user'], $_POST['album'],
	                        $_POST['photo'], $_POST['comment']);
	                    break;
	                case 'deleteTag':
	                    deleteTag($client, $_POST['user'], $_POST['album'], $_POST['photo'],
	                        $_POST['tag']);
	                    break;
	              default:
	                    break;
	          }
	        }
	
	        // If a menu parameter is available, display a submenu.
	        if (!empty($_REQUEST['menu'])) {
	            switch ($_REQUEST['menu']) {
	              case 'user':
	                displayUserMenu();
	                    break;
	                case 'photo':
	                    displayPhotoMenu();
	                    break;
	            case 'album':
	              displayAlbumMenu();
	                    break;
	            case 'logout':
	              logout();
	                    break;
	            default:
	                header('HTTP/1.1 400 Bad Request');
	                echo "<h2>Invalid menu selection.</h2>\n";
	                echo "<p>Please check your request and try again.</p>";
	          }
	        }
	
	        if (empty($_REQUEST['menu']) && empty($_REQUEST['command'])) {
	            displayMenu();
	        }
	    }
	}
	
	
}
/**
 * Output the CSS for the page
 */
 
?>
