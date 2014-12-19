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

class Google_picasa_model extends CI_Model { 
	public $return_url;
	function __construct(){
		/**
		 * @see Zend_Loader
		 */
		/**
		 * @see Zend_Gdata
		 */
		parent::__construct();
		$this->load->library("zend");
		$this->zend->load("Zend/Gdata/AuthSub");
		$this->zend->load("Zend/Gdata/Photos");
		$this->zend->load("Zend/Gdata/Photos/UserQuery");
		$this->zend->load("Zend/Gdata/Photos/AlbumQuery");
		$this->zend->load("Zend/Gdata/Photos/PhotoQuery");
		$this->zend->load("Zend/Gdata/App/Extension/Category");
				$this->return_url=site_url()."/testing_fenix/google_set_image_after_oauth_login";
		//require_once 'application/model/libraries/Zend/Loader.php';
		/**
		 * @see Zend_Gdata_AuthSub
		 */
		//Zend_Loader::loadClass('Zend_Gdata_AuthSub', "library");
		/**
		 * @see Zend_Gdata_Photos
		 */
		//Zend_Loader::loadClass('Zend_Gdata_Photos');
		/**
		 * @see Zend_Gdata_Photos_UserQuery
		 */
		//Zend_Loader::loadClass('Zend_Gdata_Photos_UserQuery');
		/**
		 * @see Zend_Gdata_Photos_AlbumQuery
		 */
		//Zend_Loader::loadClass('Zend_Gdata_Photos_AlbumQuery');
		/**
		 * @see Zend_Gdata_Photos_PhotoQuery
		 */
		//Zend_Loader::loadClass('Zend_Gdata_Photos_PhotoQuery');
		/**
		 * @see Zend_Gdata_App_Extension_Category
		 */
		//Zend_Loader::loadClass('Zend_Gdata_App_Extension_Category');
			
	} 
	
	/**
	 * Adds a new photo to the specified album
	 *
	 * @param  Zend_Http_Client $client  The authenticated client
	 * @param  string           $user    The user's account name
	 * @param  integer          $albumId The album's id
	 * @param  array            $photo   The uploaded photo
	 * @return void
	 */
	 
	function addPhoto($client, $user, $albumId, $photo)
	{
	    $photos = new Zend_Gdata_Photos($client);
		echo "<br/>google_model 99";
		echo $photo["tmp_name"];
	    $fd = $photos->newMediaFileSource($photo["tmp_name"]);
	    $fd->setContentType($photo["type"]);
	
	    $entry = new Zend_Gdata_Photos_PhotoEntry();
	    $entry->setMediaSource($fd);
	    $entry->setTitle($photos->newTitle($photo["name"]));
	
	    $albumQuery = new Zend_Gdata_Photos_AlbumQuery;
	    $albumQuery->setUser($user);
	    $albumQuery->setAlbumId($albumId);
	
	    $albumEntry = $photos->getAlbumEntry($albumQuery);
	
	    $result = $photos->insertPhotoEntry($entry, $albumEntry);
	    if ($result) {
	        //outputAlbumFeed($client, $user, $albumId);
	        echo "<Br/>google model 118<br/>";
			echo $result;
	        return $result;
	    } else {
	        echo "There was an issue with the file upload.";
	    }
	}
	
	/**
	 * Deletes the specified photo
	 *
	 * @param  Zend_Http_Client $client  The authenticated client
	 * @param  string           $user    The user's account name
	 * @param  integer          $albumId The album's id
	 * @param  integer          $photoId The photo's id
	 * @return void
	 */
	function deletePhoto($client, $user, $albumId, $photoId)
	{
	    $photos = new Zend_Gdata_Photos($client);
	
	    $photoQuery = new Zend_Gdata_Photos_PhotoQuery;
	    $photoQuery->setUser($user);
	    $photoQuery->setAlbumId($albumId);
	    $photoQuery->setPhotoId($photoId);
	    $photoQuery->setType('entry');
	
	    $entry = $photos->getPhotoEntry($photoQuery);
	
	    $photos->deletePhotoEntry($entry, true);
	
	    outputAlbumFeed($client, $user, $albumId);
	}
	
	/**
	 * Adds a new album to the specified user's album
	 *
	 * @param  Zend_Http_Client $client The authenticated client
	 * @param  string           $user   The user's account name
	 * @param  string           $name   The name of the new album
	 * @return void
	 */
	function addAlbum($client, $user, $name)
	{
	    $photos = new Zend_Gdata_Photos($client);
	
	    $entry = new Zend_Gdata_Photos_AlbumEntry();
	    $entry->setTitle($photos->newTitle($name));
	
	    $result = $photos->insertAlbumEntry($entry);
	    if ($result) {
	        return $result;	
	        //outputUserFeed($client, $user);
	    } else {
	        echo "There was an issue with the album creation.";
	    }
	}
	
	/**
	 * Deletes the specified album
	 *
	 * @param  Zend_Http_Client $client  The authenticated client
	 * @param  string           $user    The user's account name
	 * @param  integer          $albumId The album's id
	 * @return void
	 */
	function deleteAlbum($client, $user, $albumId)
	{
	    $photos = new Zend_Gdata_Photos($client);
	
	    $albumQuery = new Zend_Gdata_Photos_AlbumQuery;
	    $albumQuery->setUser($user);
	    $albumQuery->setAlbumId($albumId);
	    $albumQuery->setType('entry');
	
	    $entry = $photos->getAlbumEntry($albumQuery);
	
	    $photos->deleteAlbumEntry($entry, true);
	
	    outputUserFeed($client, $user);
	}
	
	/**
	 * Adds a new comment to the specified photo
	 *
	 * @param  Zend_Http_Client $client  The authenticated client
	 * @param  string           $user    The user's account name
	 * @param  integer          $albumId The album's id
	 * @param  integer          $photoId The photo's id
	 * @param  string           $comment The comment to add
	 * @return void
	 */
	function addComment($client, $user, $album, $photo, $comment)
	{
	    $photos = new Zend_Gdata_Photos($client);
	
	    $entry = new Zend_Gdata_Photos_CommentEntry();
	    $entry->setTitle($photos->newTitle($comment));
	    $entry->setContent($photos->newContent($comment));
	
	    $photoQuery = new Zend_Gdata_Photos_PhotoQuery;
	    $photoQuery->setUser($user);
	    $photoQuery->setAlbumId($album);
	    $photoQuery->setPhotoId($photo);
	    $photoQuery->setType('entry');
	
	    $photoEntry = $photos->getPhotoEntry($photoQuery);
	
	    $result = $photos->insertCommentEntry($entry, $photoEntry);
	    if ($result) {
	        outputPhotoFeed($client, $user, $album, $photo);
	    } else {
	        echo "There was an issue with the comment creation.";
	    }
	}
	
	/**
	 * Deletes the specified comment
	 *
	 * @param  Zend_Http_Client $client    The authenticated client
	 * @param  string           $user      The user's account name
	 * @param  integer          $albumId   The album's id
	 * @param  integer          $photoId   The photo's id
	 * @param  integer          $commentId The comment's id
	 * @return void
	 */
	function deleteComment($client, $user, $albumId, $photoId, $commentId)
	{
	    $photos = new Zend_Gdata_Photos($client);
	
	    $photoQuery = new Zend_Gdata_Photos_PhotoQuery;
	    $photoQuery->setUser($user);
	    $photoQuery->setAlbumId($albumId);
	    $photoQuery->setPhotoId($photoId);
	    $photoQuery->setType('entry');
	
	    $path = $photoQuery->getQueryUrl() . '/commentid/' . $commentId;
	
	    $entry = $photos->getCommentEntry($path);
	
	    $photos->deleteCommentEntry($entry, true);
	
	    outputPhotoFeed($client, $user, $albumId, $photoId);
	}
	
	/**
	 * Adds a new tag to the specified photo
	 *
	 * @param  Zend_Http_Client $client The authenticated client
	 * @param  string           $user   The user's account name
	 * @param  integer          $album  The album's id
	 * @param  integer          $photo  The photo's id
	 * @param  string           $tag    The tag to add to the photo
	 * @return void
	 */
	function addTag($client, $user, $album, $photo, $tag)
	{
	    $photos = new Zend_Gdata_Photos($client);
	
	    $entry = new Zend_Gdata_Photos_TagEntry();
	    $entry->setTitle($photos->newTitle($tag));
	
	    $photoQuery = new Zend_Gdata_Photos_PhotoQuery;
	    $photoQuery->setUser($user);
	    $photoQuery->setAlbumId($album);
	    $photoQuery->setPhotoId($photo);
	    $photoQuery->setType('entry');
	
	    $photoEntry = $photos->getPhotoEntry($photoQuery);
	
	    $result = $photos->insertTagEntry($entry, $photoEntry);
	    if ($result) {
	        outputPhotoFeed($client, $user, $album, $photo);
	    } else {
	        echo "There was an issue with the tag creation.";
	    }
	}
	
	/**
	 * Deletes the specified tag
	 *
	 * @param  Zend_Http_Client $client     The authenticated client
	 * @param  string           $user       The user's account name
	 * @param  integer          $albumId    The album's id
	 * @param  integer          $photoId    The photo's id
	 * @param  string           $tagContent The name of the tag to be deleted
	 * @return void
	 */
	function deleteTag($client, $user, $albumId, $photoId, $tagContent)
	{
	    $photos = new Zend_Gdata_Photos($client);
	
	    $photoQuery = new Zend_Gdata_Photos_PhotoQuery;
	    $photoQuery->setUser($user);
	    $photoQuery->setAlbumId($albumId);
	    $photoQuery->setPhotoId($photoId);
	    $query = $photoQuery->getQueryUrl() . "?kind=tag";
	
	    $photoFeed = $photos->getPhotoFeed($query);
	
	    foreach ($photoFeed as $entry) {
	        if ($entry instanceof Zend_Gdata_Photos_TagEntry) {
	            if ($entry->getContent() == $tagContent) {
	                $tagEntry = $entry;
	            }
	        }
	    }
	
	    $photos->deleteTagEntry($tagEntry, true);
	
	    outputPhotoFeed($client, $user, $albumId, $photoId);
	}
	
	/**
	 * Returns the path to the current script, without any query params
	 *
	 * Env variables used:
	 * $_SERVER['PHP_SELF']
	 *
	 * @return string Current script path
	 */
	function getCurrentScript()
	{
	    global $_SERVER;
	    return $_SERVER["PHP_SELF"];
	}
	
	/**
	 * Returns the full URL of the current page, based upon env variables
	 *
	 * Env variables used:
	 * $_SERVER['HTTPS'] = (on|off|)
	 * $_SERVER['HTTP_HOST'] = value of the Host: header
	 * $_SERVER['SERVER_PORT'] = port number (only used if not http/80,https/443)
	 * $_SERVER['REQUEST_URI'] = the URI after the method of the HTTP request
	 *
	 * @return string Current URL
	 */
	function getCurrentUrl()
	{
	    global $_SERVER;
	
	    /**
	     * Filter php_self to avoid a security vulnerability.
	     */
	    $php_request_uri = htmlentities(substr($_SERVER['REQUEST_URI'], 0,
	    strcspn($_SERVER['REQUEST_URI'], "\n\r")), ENT_QUOTES);
	
	    if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') {
	        $protocol = 'https://';
	    } else {
	        $protocol = 'http://';
	    }
	    $host = $_SERVER['HTTP_HOST'];
	    if ($_SERVER['SERVER_PORT'] != '' &&
	        (($protocol == 'http://' && $_SERVER['SERVER_PORT'] != '80') ||
	        ($protocol == 'https://' && $_SERVER['SERVER_PORT'] != '443'))) {
	            $port = ':' . $_SERVER['SERVER_PORT'];
	    } else {
	        $port = '';
	    }
	    return $protocol . $host . $port . $php_request_uri;
	}
	
	/**
	 * Returns the AuthSub URL which the user must visit to authenticate requests
	 * from this application.
	 *
	 * Uses getCurrentUrl() to get the next URL which the user will be redirected
	 * to after successfully authenticating with the Google service.
	 *
	 * @return string AuthSub URL
	 */
	function getAuthSubUrl($next="")
	{
		$this->load->library("zend", "Zend/Gdata/AuthSub");
		//require_once 'Zend/Gdata/AuthSub.php';
		if($next=="")
		    $next = $this->getCurrentUrl();
	    $scope = 'http://picasaweb.google.com/data';
	    $secure = false;
	    $session = true;
		$result=new Zend_Gdata_AuthSub;
	    return $result->getAuthSubTokenUri($next, $scope, $secure, $session);
	    //return Zend_Gdata_AuthSub::getAuthSubTokenUri($next, $scope, $secure, $session);
	}
	
	/**
	 * Outputs a request to the user to login to their Google account, including
	 * a link to the AuthSub URL.
	 *
	 * Uses getAuthSubUrl() to get the URL which the user must visit to authenticate
	 *
	 * @return void
	 */
	function requestUserLogin($linkText)
	{
	    $authSubUrl = getAuthSubUrl();
	    echo "<a href=\"{$authSubUrl}\">{$linkText}</a>";
	}
	
	/**
	 * Returns a HTTP client object with the appropriate headers for communicating
	 * with Google using AuthSub authentication.
	 *
	 * Uses the $_SESSION['sessionToken'] to store the AuthSub session token after
	 * it is obtained.  The single use token supplied in the URL when redirected
	 * after the user succesfully authenticated to Google is retrieved from the
	 * $_GET['token'] variable.
	 *
	 * @return Zend_Http_Client
	 */
	//function getAuthSubHttpClient($token='', $auth_return_path){
	function getAuthSubHttpClient($token=''){
		global $_SESSION, $_GET;
		if($token=='') $token=$_GET['token'];
		 //$token=$_GET['token'];
	    if (!isset($_SESSION['sessionToken']) && ($token!='')) {
	        $_SESSION['sessionToken'] = Zend_Gdata_AuthSub::getAuthSubSessionToken($token);
			if($_SESSION['sessionToken']==false){
				//$url=$this->getAuthSubUrl(site_url()."/portal/post_activity_google_after_oauth_login");		
				$url=$this->getAuthSubUrl($this->return_url);
				unset($_SESSION['sessionToken']);
				echo "<br/>google_model 434 auth sub session token return false";
				//header("location: ".$url);
				exit();
			}
	    }
	    //$client = Zend_Gdata_AuthSub::getHttpClient($_SESSION['sessionToken']);
	    $client = Zend_Gdata_AuthSub::getHttpClient($token);
	    return $client;
	}
	//========================================================
	//public function upload_google_activity($userinfo, $access_token){
	public function upload_google_image($userinfo, $access_token){
		echo "<br/>google_picasa_model 496";
		
		//$bll=$this->google_model->bll_post_activity_google($_POST, $_FILES, $userinfo, $access_token);
		echo $access_token;
		
		$client=$this->getAuthSubHttpClient($access_token);
		echo "<br/>google_picasa_model 454";
		print_r($client);
		$photos = new Zend_Gdata_Photos($client);
		echo "<br/>google_picasa_model 456";
		print_r($photos);
		$query = new Zend_Gdata_Photos_UserQuery();
		echo "<br/>google_picasa_model 458";
		print_r($query);
		echo "<br/>google_picasa_model 460";		
		$user=$query->getUser();
		print_r($user);
		echo "<br/>google_picasa_model 462";		
		$userFeed = $photos->getUserFeed($user, $query);
		echo "<br/>google_picasa_model 464";		
		$_FILES=$this->native_session->get('upload_image');
		$albumname=date("F j, Y");
		
		echo "<br/> google_model 513 ";
		print_r($_FILES);
		
		//$photos = new Zend_Gdata_Photos($client);
		$newalbum=$this->addAlbum($client, $user, $albumname);
		$albumID=$newalbum->getGphotoId();
		$result=$this->addPhoto($client, $user, $albumID, $_FILES['photo']);
		return $result;
	}
	//public function bll_post_activity_google($POST=null, $FILES=null, $userinfo=null, $access_token=null){
	public function bll_post_activity_google($POST=null, $FILES=null, $userinfo=null, $access_token=null){
		//$_GET['token']=$access_token;
		//echo $access_token;
		$client=$this->getAuthSubHttpClient($access_token);
		$photos = new Zend_Gdata_Photos($client);
		$query = new Zend_Gdata_Photos_UserQuery();
   		$query->setUser(null);
		$user=$query->getUser();
		$userFeed = $photos->getUserFeed($user, $query);
		/*foreach ($userFeed as $entry) {
	        if ($entry instanceof Zend_Gdata_Photos_AlbumEntry) {
				echo $userFeed->getTitle() . "&album=" . $entry->getGphotoId()."(".$entry->getTitle().") <br/>";	
			}
		}*/
		$photo=$FILES['photo'];
		$albumname=date("F j, Y");
		
		//$photo['tmp_name']="upload/".$this->native_session->get("image");
		//echo "google_model 461 <br/>";
		//print_r($userFeed);
		
		//$userFeed = $photos->getUserFeed(null, $query);
		
		$result['client']=$client;
		$result['user']=$user;
		$result['albumname']=$albumname;
		$result['photo']=$photo;
		
		return $result;	
	}
	
	
	
}
/**
 * Output the CSS for the page
 */
 
?>
