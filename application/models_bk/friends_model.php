<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 * HESK (HKM) developed Friends Model
 * Introductions: This is the model developed for the use of friend's connection and the way to define the relationships with friends.
 * Core Features: User ID management, user relationship definitions, backdoor functions, JSON generator with advanced moduled function structures
 * Newest way to transfer data with the use of function select(*) that will able to be used further for memcache optimizations
 * Data connection management prompt by Single user ID or object ID
 * TODO: keep everything in this library and the functions will be called freely by giving calls.
 * @link: http://hkmdev.wordpress.com/
 * @category: external native_session might cause studden crash
 * @license no warranty is provided
 * @author Heskeyo Kam
 * @author and addition authors Fenix Lam, Ning
 */
class Friends_model extends CI_Model {
	private $current_user_login_id;
	private $current_user_login_nickname;
	private $sample_data_career = array('programmer', 'chinese teacher', 'english teacher', 'NBA player', 'developer', 'accountant', 'doctor', 'investor', 'eshop', 'MLMer', 'photographer', 'gardener', 'seller', 'ebayer', 'oil n gas buyer', 'gold trader', 'stock', 'anaylsis', 'engineer', 'cyclist', 'clerk', 'writer', 'flight attendent', 'retailer', 'DJ', 'club host', 'owner', 'boss', 'manager', 'strategist', 'money lender', 'banker', 'farmer', 'artist', 'singer', 'performer', 'painter', 'reseller');
	private $sample_data_names = array('justin', 'biber', 'candy', 'candus', 'miki', 'peter', 'susan', 'hellomello', 'heskemo', 'herol', 'mallow', 'mellooo', 'cici', 'mina', 'yomiko', 'mama', 'joseph', 'jojo', 'kiki', 'lolo', 'babe', 'bibi', 'coco', 'yumyum', 'zack', 'jack', 'jacky', 'angel', 'tiffa', 'Frank', 'Todd', 'James', 'yummy', 'ann', 'lilly', 'samuel', 'sam', 'max', 'fenix', 'linux', 'hesk', 'hero', 'dragon', 'vincent', 'calvin', 'judy', 'jos', 'leo', 'gigi');
	private $sample_data_country = array('TW', 'US', 'JP', 'HK', 'CN', 'EN', 'GR', 'FR', 'MO', 'KR', 'TL', 'VM', 'VE', 'CA', 'BR', 'MX', 'EG', 'IS', 'IT', 'GK', 'LV', 'MC', 'AC');
	//private $related_id;
	//private $current_user_view_id;
	function __construct() {
		parent::__construct();
		//$this->load->model("news_model");
		//load up all the environmental settings natively
		$this -> load -> library('native_session');
		//use this when you have really logged into your account.
		//$this->init();
		$this -> load -> helper(array('array_helper', 'custom_helper'));
		$this -> current_user_login_id = 2;
		$this -> current_user_login_nickname = 'LOG MAN 0' . $this -> current_user_login_id;
		//$this->related_id = 29;
	}

	function me_id() {
		$userinfo = $this -> native_session -> get("inhouse_info");
		return $userinfo['user_inhouse_id'];
		//$userinfo is the whole record in database table: user_inhouse.
		//	return $this -> current_user_login_id;
	}
	function me(){
		//$this;
		return TRUE;
	}
	public function getdatafriendsid($id,$method){
		// Introduction:  when you have an id of a person and you want to request a list of profile pictures and the names from their friends. 
		// TODO: This is the function for this situation, get an array of data from given id with a given method
		// example method array('firstname','profile_image')
		$ids=$this->myfriends_id_universal($id);
		if(count($ids)==0)return null;
		$q=$this->db->
		select($method)
		//with the selected combinations of columns only
		->where_in('user_inhouse_id', $ids)
		//the user inhouse ids with in array format
		->get('user_inhouse_data')
		//call from the database
		->result_array();
		//genereate the result only in array
		return $q;
	}
	/*public function ctrl_add_friend($data){
		//LV1 for fast call add friend procedure
		$data=array(
			"subject_user_id"=>"",
			"object_user_id"=>"",
		);
		$check_friend_exist=$this->is_request($data['subject_user_id'], $data['subject_user_id']);
		if(count($check_friend_exist)>0){
			return null;
		}else{
			$this->db->set('subject_user_id', $data);
		}
	}
	public function DBcheck_had_request($subject_user_id, $object_user_id){
		$this->		
	}*/
	public function getdatafriendrequests($method){
		$ids = $this->my_friend_requests($this->me_id());
		// it returns a list of IDs
		if(count($ids)==0)return FALSE;
		//print_r($ids);
		//exit;
		//die("count my friends here: ".count($ids));
		$q=$this->db->
		select($method)
		//with the selected combinations of columns only
		->where_in('user_inhouse_id', $ids)
		//the user inhouse ids with in array format
		->get('user_inhouse_data')
		//call from the database
		->result_array();
		//genereate the result only in array
		//print_r($q);
		//exit;
		return $q;
	}
	function get_imgprofile_by_id($id){
	$q = $this->db->query("select profile_image from user_inhouse_data where user_inhouse_id=$id")
	->result_array();
	//print_r($q);
	$e='';
		foreach ($q as $img => $url) {
			$e=$url['profile_image'];
		}
	return $e;
	}
	public function accept_newfriend($id){
		$myid=$this->me_id();
		$method_1 = array(
		'subject_user_id'=>$myid,
		//object to be in here
		'object_user_id'=>$id,
		'request'=>0
		);
		$method_2 = array(
		'object_user_id'=>$myid,
		//object to be in here
		'subject_user_id'=>$id,
		'request'=>1
		);
		$method_3 = array(
		'request'=>0
		);
		//print_r('condition: is friend = '.$this->is_friend($id)." , is requested = ".$this->is_request($id,$myid));
		//exit;
		if($this->is_friend($id)==0&&$this->is_request($id,$myid)>0){
				$this->db->where($method_2);
				$this -> db -> update('user_relation', $method_3);
				$error= ($this->db->affected_rows() == 0)?TRUE:FALSE;
				if($error)die(" 0 result from line 93");
				$this -> db -> insert('user_relation', $method_1);
				$error= ($this->db->affected_rows() == 0)?TRUE:FALSE;
				if($error)die(" 0 result from line 97");
		
				// Post to news [Ning]		
				//$this->news_model->post_news_to_outbox($myid, $id, 0, "accept_friend");
				//$this->news_model->post_news_to_outbox($id, $myid, 0, "accept_friend");
			return TRUE;
				//tested and its working fine
				/*
				 SELECT * FROM  `user_relation` ORDER BY  `user_relation`.`object_user_id` ASC LIMIT 0 , 30
				 */
		}else{
			return FALSE;
		}
	}
	public function DBset_friend($user_id1, $user_id2){
		//DAL
		$this->db->where("subject_user_id", $user_id1);
		$this->db->where("object_user_id", $user_id2);	
		$result=$this->db->get("user_relation");
		$result=$result->result_array();
		if(count($result)>0){
			
		}else{
			$this->db->set("subject_user_id", $user_id1);
			$this->db->set("object_user_id", $user_id2);
			$this->db->set("request", 0);
			$this->db->set("block", 0);
			$this->db->set("time", date("Y-m-d h:i:s"));
			$this->db->insert("user_relation");
		}
	}
	public function reject_newfriend($id){
		$myid=$this->me_id();
		$method = array(
		'subject_user_id'=>$id,
		'object_user_id'=>$myid,
		//object to be in here
		'request'=>1
		);
		//die("count my friends here: ".count($ids));
		//exit;
		/*testing */
		$a = $this->is_friend($id);
		$b = $this->is_request($id,$myid);
		//die("is friends? ".$a." is requested? ".$b);
		if($a==0 && $b==1){
			$this->db->where($method);
			$this->db->delete('user_relation'); 
			$error= ($this->db->affected_rows() == 0)?TRUE:FALSE;
			if($error)die(" 0 result from line 97");
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//this is a get method in array
	function myfriends_package() {
		/*
		 * 
		 * DO NOT PRINT ANY SESSION OR ECHO ANYTHING FROM HERE
		 * THIS WILL MESS UP THE JSON STRUCTUR IF YOU TRY
		 * 
		 */
		 //using openid table
		$userinfo = $this -> native_session -> get("inhouse_info");
		$mename = $userinfo['firstname'].' '.$userinfo['lastname'];
		if($userinfo['profile_image']==NULL){
			$profile_pic=$data["base"] = base_url() . 'images/common/no-photo.png';
		}else $profile_pic=$userinfo['profile_image'];
		//profile data for this user
		$myid = $this -> me_id();
		$g_frd = $this -> my_friends($myid);
		$g_request = $this -> my_request($myid);
		//$g_connections = $this -> db -> query($this -> db_my_connection($myid)) -> count_all_results();
		$g_block = $this -> my_block($myid);
		$g_myfrdrequests = $this -> my_friend_requests($myid);
		$data_pack = array(
		//get the profile information
		//'row' => $this -> get_user_row($myid),
		//total number of my friends #
		// get this ID
		'mylogin' => $myid,
		// the first and last name
		'myname'=>$mename,
		//the full path of the profil picture
		'myprofilepic'=>$profile_pic,
		//the total friends that is connected to me
		'totalfrds' => count($g_frd),
		//get total requested fans # to me
		'total_frd_requests' => count($g_myfrdrequests),
		//get total blocked fans
		'total_blocks' => count($g_block),
		//get total requested fans # from me
		'total_my_requests' => count($g_request),
		//location by country name
		'location' => $userinfo['country'],
		//current job
		'work' => $userinfo['career'],
		//the time stamp in raw data of the person to be updated the most recently
		'lastupdate' => $userinfo['last_updated'],
		//get the array list of my friends IDs
		'myfriend' => $g_frd,
		//get the array list of my request to friend IDs
		'myrequest' => $g_request,
		//get the array list of my block friend IDs
		'myyblock' => $g_block,
		//get the array list of my friend request IDs
		'myfrdrequest' => $g_myfrdrequests);
		return $data_pack;
	}
	public function get_random_friends_related(){
		//create a list of people that is being requested and not requested.
		$myid = $this -> me_id();
		$gfrd = $this -> my_friends($myid);
		$grequest = $this -> my_request($myid);
		$gblock = $this -> my_block($myid);
		$gprivacy1 = $this->my_get_privacy("me_only");
		$gprivacy2 = $this->my_get_privacy("myself_only");
		$list = array_merge ($gfrd,array($myid),$grequest,$gblock,$gprivacy1,$gprivacy2);
		$list = array_unique ($list);
		//print_r($list);
		$query = $this -> db 
		-> select("user_inhouse_id, nickname, profile_image, gender") 
        //condition by the IDs not in user_inhouse_id
		-> where_not_in("user_inhouse_id", $list) 
        //condition by table
		-> get("user_inhouse_data");
		$query = $query->result_array();
		return $query;
	}
	public function get_pending_friendrequests_of($target_id=null){
		if(!isset($target_id))$target_id=$this -> me_id();
		$grequest = $this -> my_request($target_id);
		$query = $this -> db 
		-> where_in("user_inhouse_id", $grequest) 
		-> get("user_inhouse_data");
		return $query = $query->result_array();
	}
	public function get_friends_status($user_id){
				$isfriend = ($this -> is_friend($user_id) == 2) ? TRUE : FALSE;
				$nn = $this ->  is_request($this ->  me_id(), $user_id);
				//$additional_comment = '';
				// the requested person is myself.
				//echo "<br/>friend_model 260 ";
				//echo $user_id.":".$this->me_id();
				if($this ->  me_id() == $user_id) return 0;
				//echo $nn;
				//echo "is friends? ".$this->f->is_friend($user_id)." is requested? ".$nn;
				$isrequested = $nn > 0 ? TRUE : FALSE;
				if (!$isrequested && $isfriend) {
					//this is the situation for an ordinary friend relationship
					//$listbottons = $this -> friends_view;
					//$additional_comment = 'You are already friends with ';
					return 1;
				} else if ($isrequested && !$isfriend) {
					//this is for the pending friend request from A -> B
					$listbottons = array("remove" => "cancel the request");
					//$additional_comment = 'Your friend request has sent';
					return 2;
				} else if (!$isrequested && !$isfriend) {
					//this is just a fresh new people and they are unrelated.
					//$listbottons = $this -> buttons_add_search_friends;
					//$additional_comment = '';
					return 3;
				}
	}
	public function is_fan($user) {
		$this -> db -> select('subject_user_id, object_user_id');
		$backward = $this -> backward_relation($user);
		$query = $this -> db -> get_where('user_relation', $backward);
		$data = $query -> result_array();
		return (count($data) > 0) ? FALSE : TRUE;
	}

	public function is_friend($id) {
		$this -> db -> select('subject_user_id, object_user_id');
		$data = array(
		//subject_user_id will be me the user id
		'subject_user_id' => $this -> me_id(),
		//subject user id is the current user
		'object_user_id' => $id,
		//this is the dynamic to the users that is targeted to be friend with the current user
		'request' => 0);
		$q=$this -> db -> get_where('user_relation', $data);
		//$data = $q -> result_array();
		//return (count($data) > 0) ? TRUE : FALSE;
		$a=$q->num_rows();
		$this -> db -> select('subject_user_id, object_user_id');
		$data = array(
		//subject_user_id will be me the user id
		'object_user_id' => $this -> me_id(),
		'subject_user_id' => $id,
		'request' => 0);
		$q=$this -> db -> get_where('user_relation', $data);
		$b=$q->num_rows();
		//	echo "<br> got B->A ".$b."<br>";
		//	echo "<br> result B+A ".intVal($b+$a)."<br>";
		return $a+$b;
	}

	function is_request($a, $b, $request=1) {
		/**
		 * introduction : this function is to determine if the user A has requested friend to the user B
		 *
		 * @param a - the value for user_relation.subject_user_id
		 * @param b - the value for user_relation.object_user_id
		 * return
		 * 			FALSE - invalid inputs
		 * 			1	- there is a request from the diection a to b
		 * 			0	- there is no request from the diection a to b
		 *
		 * */
		$method1 = array('subject_user_id'=>$a,'object_user_id'=>$b,'request'=>$request);
		//$method2 = array('subject_user_id'=>$b,'object_user_id'=>$a,'request'=>$request);
		//$sql = "select * from user_relation where subject_user_id=" . $a . " and object_user_id=" . $b . " and request=1";
		$q = $this -> db ->where($method1)
		//->or_where($method2)
		//run the procedure 
		->get('user_relation');
		//$j = $q -> count_all();
		//if ($q->num_rows() > 0){	}
		/*$this->db->affected_rows() == 0 // Update query was ran successfully but nothing was updated
		 $this->db->affected_rows() == 1 // Update query was ran successfully and 1 row was updated
		 $this->db->affected_rows() == -1 // Query failed count_all num_rows
		 */
		//echo $j=$this->db->last_query(); 
		 $j=$q->num_rows();
		 return $j;

	}

	function my_inbox($sub_id) {
		$sql = "select * from user_message where to_user_id=" . $sub_id;
		$q = $this -> db -> query($sql);
		return $q -> result_array();
	}

	function my_outbox($sub_id) {
		$sql = "select * from user_message where from_user_id=" . $sub_id;
		$q = $this -> db -> query($sql);
		return $q -> result_array();
	}

	function get_user_row($sub_id) {
		// get a single row of the user_inhouse_data for display to the profile
		$sql = "select * from user_inhouse_data where user_inhouse_id=" . $sub_id;
		$q = $this -> db -> query($sql);
		return $q -> result_array();
	}

	function my_friend_requests($id) {
		//$sql = "select * from user_relation where object_user_id=" . $id . " and request=1";
		//$q = $this -> db -> query($sql);
		$method=array('object_user_id'=>$id,
		//the $id is the key id for the specific target
		'request'=>1
		// making sure that you are looking for the pending request
		);
		$q=$this->db->where($method)->get('user_relation');
		return $this -> get_serialize($q -> result_array(), 'subject_user_id');
	}

	function my_block($sub_id) {
		$sql = "select * from user_relation where subject_user_id=" . $sub_id . " and object_user_id!=" . $sub_id . " and block=1";
		$q = $this -> db -> query($sql);
		return $this -> get_serialize($q -> result_array(), 'subject_user_id');
	}

	function my_request($sub_id) {
		/* return array of ids of the requested friend IDs */
		$method=array('subject_user_id'=>$sub_id,
		'object_user_id !='=>$sub_id,
		'request'=>1);
		//$sql = "select * from user_relation where subject_user_id=" . $sub_id . " and object_user_id!=" . $sub_id . " and request=1";
		$q=$this->db->where($method)->get('user_relation');
		//$q=$this->db->where($method)->get('user_relation');
		return $this -> get_serialize($q -> result_array(), 'object_user_id');
	}
	function my_get_privacy($options){
		$q = $this -> db -> 
		select("user_inhouse_id") -> 
		where("default_privacy",$options)-> 
		get("user_inhouse_data");
		return $this -> get_serialize($q -> result_array(), 'user_inhouse_id');
}
	function my_friends($sub_id) {
		/* return array of ids of the object IDs */
		/*
		 SELECT *
		 FROM user_relation
		 WHERE subject_user_id =12
		 AND object_user_id !=12
		 */
		$sql = "select * from user_relation where subject_user_id=" . $sub_id . " and object_user_id!=" . $sub_id . " and request=0";
		$q = $this -> db -> query($sql);
		return $this -> get_serialize($q -> result_array(), 'object_user_id');
	}
	/* not in used - start */
	function show_fans($limit = 0) {
		$conditions = array('object_user_id' => $this -> me_id(), 'subject_user_id !=' => $this -> me_id(), 'request'=>0);
		$query = $this -> db -> select('user_relation.subject_user_id, user_relation.object_user_id,user_inhouse_data.nickname') 
		//list the items from a friend
		-> from('user_relation') 
		-> join('user_inhouse_data', 'user_inhouse_data.user_inhouse_id = user_relation.subject_user_id', 'right') 
		//adding the conditions
		-> where($conditions);
		//	-> where_in('user_inhouse_id', $ar);
		//-> limit(20);
		if ($limit > 0)
			$query = $this -> db -> limit($limit);
		$query = $this -> db -> order_by('nickname', "asc") -> get();
		$data = $query -> result_array();

		return $data;
	}
	/* not in used - end */
	function show_my_requests($n = 20) {
		//the request from the user to their fans
		//$ar = $this -> myfriends_id();
		//if (empty($ar)) {return array();}
		//$data = $this->findusers($ar,$n);
		//return $data;
		$ar1 = $this -> myconnection_id();
		$ar2 = $this -> myfriends_id();
		if (empty($ar2)) {
			return array();
		}
		if (empty($ar1)) {
			$data = $this -> findusers($ar2, $n);
		} else {
			$data = $this -> findleaps($ar2, $ar1, $n);
		}
		return $data;
	}

	function show_not_myfriends($n = 20) {
		//myfriends_id
		$ar = $this -> myfriends_id();
		$ar[] = $this -> me_id();
		$data = $this -> findusers_exclusion($ar, $n);
		return $data;
	}

	function show_real_friends($n = 20) {
		//people that you are connected to each other
		$ar = $this -> myconnection_id();
		if (empty($ar)) {
			return array();
		}
		$data = $this -> findusers($ar, $n);
		return $data;
	}

	function search_by_name($query) {
		//$arf = $this->myfans();
		//$ar = $this->myconnection_id();
		$n = urldecode($query);
		$userinfo=$this->native_session->get("userinfo");
		/**
         * @helped by Fenix
		 * to solve this function and this is a cross table search feature 
		 * since this database does not support FULLTEXT INDEXING
		 */
		$sqlquery="select *, concat( firstname, ' ', lastname ) as fullname from user_inhouse_data 
				where (nickname like '%$n%' 
				or concat( firstname, ' ', lastname ) like '%$n%'
				or concat( lastname, ' ', firstname ) like '%$n%')
				 and default_privacy!='me_only' and user_inhouse_id!='".$userinfo['user_inhouse_id']."'";
		$query=$this->db->query($sqlquery);
		/*$where = "nickname like '%$n%' or firstname like '%$n%' or lastname like '%$n%'";
		//$where = "nickname like '$n' or firstname like '$n' or lastname like '$n'";
		//$where = "match (nickname, firstname, lastname) against ('".$n."' IN NATURAL LANGUAGE MODE)";
		$query = $this -> db -> 
		//select("user_inhouse_id, nickname") -> 
		//select($where)->
		//where($where, NULL, FALSE)-> 
		where($where)->
		where_not_in("default_privacy",array('me_only')) ->
		//->where_not_in("user_inhouse_id",$arf)
		get("user_inhouse_data");*/
		$r = $query -> result_array();
		if (count($r) > 100)
			$r = get_from_array($r, 0, 100);
		return $this -> search_name_fine_tune($r);
	}

	private function search_name_fine_tune($data) {
		foreach ($data as $key => &$value) {
			$user_id = $value['user_inhouse_id'];
			$added = $this -> is_friend($user_id) ? "1" : "0";
			$fanned = $this -> is_fan($user_id) ? "1" : "0";
			$value['added'] = $added;
			$value['fan'] = $fanned;
		}
		return $data;
	}

	function search_by_email($mail) {
		$query = $this -> db -> select("user_inhouse_id, nickname, email") -> where("email", $mail) -> get("user_inhouse_data");
		$r = $query -> result_array();
		if (count($r) > 100)
			$r = get_from_array($r, 0, 100);
		return $this -> search_name_fine_tune($r);
		//return $r;
	}

	function search_by_id($id) {
		$query = $this -> db -> select("user_inhouse_id, nickname, email") -> where("user_inhouse_id", $id) -> get("user_inhouse_data");
		$r = $query -> result_array();
		if (count($r) > 100)
			$r = get_from_array($r, 0, 100);
		return $this -> search_name_fine_tune($r);
		//return $r;
	}

	private function findleaps($inclusion, $exclusion, $n = 20) {
		$query = $this -> db -> where_in('user_inhouse_id', $inclusion) -> where_not_in('user_inhouse_id', $exclusion);
		if ($n > 0)
			$query = $query -> limit($n);
		$data = $query -> order_by("nickname", "asc") -> get("user_inhouse_data") -> result_array();
		return $data;
	}

	private function findusers($user_ids, $n = 20) {
		$query = $this -> db -> where_in('user_inhouse_id', $user_ids);
		if ($n > 0)
			$query = $query -> limit($n);
		$data = $query -> order_by("nickname", "asc") -> get("user_inhouse_data") -> result_array();
		return $data;
	}

	private function findusers_exclusion($user_ids, $n = 20) {
		$query = $this -> db -> where_not_in('user_inhouse_id', $user_ids);
		if ($n > 0)
			$query = $query -> limit($n);
		$data = $query -> order_by("nickname", "asc") -> get("user_inhouse_data") -> result_array();
		return $data;
	}
	public function count_friend_time($ask_userID, $accept_userID){
		/*
		 * this is to show the time start for a friendship from A ($ask_userID) to B ($accept_userID)
		 * We will count from the start time where B accepted A as a friend. 
		 */
		$method=array('subject_user_id'=>$accept_userID,'object_user_id'=>$ask_userID);
		$r = $this->db->select('time')->where($method)->get('user_relation')-> result_array();
		if(count($r)>0){
			return $r[0]['time'];
		}else {
			return null;
		}
	}
	public function count_real_friends($user_id = '') {
		/* count the number of connections that is satisfied on the both conditions (A to B) AND (B to A). Optionally by the given user ID specified in the inhouse_user table */
		if ($user_id == '')
			$q = $this -> myconnections($this -> me_id()) -> result_array();
		else
			$q = $this -> myconnections($user_id) -> result_array();
		return count($q);
	}

	public function count_follow($user_id = '') {
		/* count the number of followers by the given user ID specified in the inhouse_user table */
		if ($user_id != '') {
			$b = $this -> count_real_friends($user_id);
			$q = $this -> myfriends($user_id) -> result_array();
		} else {
			$b = $this -> count_real_friends($this -> me_id());
			$q = $this -> myfriends($this -> me_id()) -> result_array();
		}
		return count($q) - $b;
	}

	public function count_fans($user_id = '') {
		/* count the number of fans by the given user ID specified in the inhouse_user table */
		if ($user_id != '') {
			$b = $this -> count_real_friends($user_id);
			$q = $this -> myfans($user_id) -> result_array();
		} else {
			$b = $this -> count_real_friends($this -> me_id());
			$q = $this -> myfriends($this -> me_id()) -> result_array();
		}
		return count($q) - $b;
	}

	function remove_fan($id) {
		/* this is the function to remove the fan by selecting the given user ID specified in the inhouse_user table */
		$d = $this -> forward_relation($id);
		$this -> db -> insert('user_relation', $d);
	}

	function remove_duplication() {
		/* this is to remove the duplication lines in the database */
		$q = $this -> db -> query("SELECT subject_user_id, COUNT(*) AS total FROM user_relation GROUP BY subject_user_id");
		$r = $q -> result_array();
		$c = count($r);
		while ($c > 0) {
			$c--;
			//if ($r[$c]['total'] > 1)
			/*	$q = $this -> db -> query("DELETE FROM members WHERE ID=$row[ID] LIMIT $row[total]-1");
			 $q -> result_array();
			 */
		}
	}

	function get_msg_n($from_id) {
		if (empty($from_id))
			return FALSE;
		$from_id = $this -> me_id();
		$n = $this -> db -> query("select count(*) as totalmessage from user_message where from_user_id=$from_id group by from_user_id");
		return $n['totalmessage'];
	}

	function add_msg($from_id, $to_id, $msg) {
		/*this is to add messages
		 * @param from_id the user id for the from person
		 * @param to_if the user id for the to person
		 * @param this is the string of the message.
		 */
		if (empty($from_id) || empty($to_id) || empty($msg))
			return FALSE;
		$data = array('to_user_id' => $to_id, 'from_user_id' => $from_id, 'message' => $msg);
		$r = $this -> db -> insert('user_message', $data);
		return TRUE;
	}

	function add_r_msg($n = 10) {
		/**
         * this is to generate random messages for testing  to random users
		 * @param n a number of random messages
		 * @param from_id the user id for the from person
		 * @param to_if the user id for the to person
		 * @param this is the string of the message.
		 */
		//if (empty($from_id) || empty($to_id) || empty($msg))
		//	return FALSE;
		if ($n < 0 || empty($n))
			return FALSE;
		$people = $n;
		$r = array();
		$r[] = "1 and 2 Kings (like 1 and 2 Samuel and 1 and 2 Chronicles) are actually one literary work, called in Hebrew tradition simply \"Kings.\"";
		$r[] = "Together Samuel and Kings relate the whole history of the monarchy, from its rise under the ministry of Samuel to its fall at the hands of the Babylonians.";
		$r[] = "As Solomon grew older, his wives beguiled him with their alien gods and he became unfaithful - he didn't stay true to his God as his father David had done.";
		$r[] = "Solomon openly defied God; he did not follow in his father David's footsteps.";
		$r[] = "Years earlier, when David devastated Edom, Joab, commander of the army, on his way to bury the dead, massacred all the men of Edom.";
		$from_id = $this -> me_id();
		while ($people > 0) {
			$random_n_msg = rand(0, count($r) - 1);
			$toUser = rand(0, 14000);
			$this -> add_msg($from_id, $toUser, $r[$random_n_msg]);
			$people--;
		}
		return TRUE;
	}

	function add_random_fan($people) {
		if ($people < 0 || empty($people))
			return FALSE;
		while ($people > 0) {
			$f = rand(0, 14000);
			$data = array('subject_user_id' => $f, 'object_user_id' => $this -> me_id(), );
			$re = $this -> db -> insert('user_relation', $data);
			$people--;
		}
		return TRUE;
	}

	function add_random_relation($people) {
		if ($people < 0 || empty($people))
			return FALSE;
		while ($people > 0) {
			$entries = 100;
			while ($entries > 0) {
				$f = rand(0, 14000);
				$data = array('subject_user_id' => $people, 'object_user_id' => $f, );
				$re = $this -> db -> insert('user_relation', $data);
				$entries--;
			}
			$people--;
		}
		return TRUE;
	}

	public function add_random_people($people) {
		/**
		 * intro: generate a list of random people directly into the database
		 *
		 * @param people - a number of users to be generated
		 *
		 * return
		 * 			TRUE - successful
		 * 			FALSE - not successful
		 */
		if ($people < 0 || empty($people) || $people > 10000)
			return FALSE;
		// be careful about this number to be no more than 70,000
		//must be lower than 10,000 - 30 sec
		$gender = array('F', 'M');
		$count_c = count($this -> sample_data_country) - 1;
		$count_s = count($this -> sample_data_names) - 1;
		$count_f = count($this -> sample_data_career) - 1;
		while ($people > 0) {
			$country = $this -> sample_data_country[rand(0, $count_c)];
			$nam1 = $this -> sample_data_names[rand(0, $count_s)];
			$nam2 = $this -> sample_data_names[rand(0, $count_s)];
			$nam3 = $this -> sample_data_career[rand(0, $count_f)];
			$ng = $gender[rand(0, 1)];
			$data = array('nickname' => $nam1 . 'D' . strtolower($country), 'firstname' => $nam1, 'lastname' => $nam2, 'career' => $nam3, 'country' => $country, 'email' => $nam2 . "_fx@gmail.com", 'del' => 'n', 'language' => $country, 'gender' => $ng);
			$re = $this -> db -> insert('user_inhouse_data', $data);
			//return $this->db->insert_id();
			$people--;
		}
		return TRUE;
	}

	public function unconnect($id) {
		$this -> db -> where("subject_user_id", $this -> me_id()) -> where("object_user_id", $id) -> delete("user_relation");
		return "1";
	}
	public function remove_friend($id){
		$conditions = array(
		"subject_user_id"=> $this -> me_id(),
		//the subject id got to be the current user loging user id
		"object_user_id"=> $id,
		//this is the target pending request ID 
		"request"=>0,
		// to make sure there is a request or pending status on the 'request' column
		);
		$this -> db -> where($conditions) -> delete("user_relation");
		$result1= ($this->db->affected_rows() > 0)?TRUE:FALSE;
		$conditions = array(
		"subject_user_id"=> $id,
		"object_user_id"=> $this -> me_id(),
		"request"=>0,
		);
		$this -> db -> where($conditions) -> delete("user_relation");
		$result2= ($this->db->affected_rows() > 0)?TRUE:FALSE;
		return $result = ($result1 && $result2)?TRUE:FALSE;
	}
	public function remove_request($id) {
		$conditions = array(
		"subject_user_id"=> $this -> me_id(),
		//the subject id got to be the current user loging user id
		"object_user_id"=> $id,
		//this is the target pending request ID 
		"request"=>1,
		// to make sure there is a request or pending status on the 'request' column
		);
		$this -> db -> where($conditions) -> delete("user_relation");
		//remove the data fom the table
		return $result= ($this->db->affected_rows() != 0)?TRUE:FALSE;
		//return "1";
	}

	public function add_friend($id) {
		//two steps to process the data
		$a = intval($this->is_request($this->me_id(), $id));
		$c = intval($this->is_request($id,$this->me_id()));
		// if that is not my friend but u have submitted a request to the person
		$b = intval($this->is_friend($id));
		// if that is my friend already
			if($a==0 && $c==0 && $b==0){
		 		$d = $this -> forward_relation($id);
				$this -> db -> insert('user_relation', $d);
				return "1";
			}else{
				return "0";
				//return "0 - a:".$a." b:".$b." c:".$c;
			}
	}

	private function backward_relation($id) {
		$data = array(
		//this can be applied to making a various of relationship to many different friends
		'object_user_id' => $this -> me_id(), 'subject_user_id' => $id,
		//		   'time'=>time(),
		);
		return $data;
	}

	private function forward_relation($id) {
		// this function will apply to adding new friends or making a friend request
		$data = array(
		//==========================================================================
		'subject_user_id' => $this->me_id(),
		//subject user id is the current user
		'object_user_id' => $id,
		//this is the dynamic to the users that is targeted to be friend with the current user
		'request' => 1);
		//this is to ensure that the newly added friend be notified to the interface that they will able to see your friend request
		return $data;
	}

	private function myconnections($id) {
		//this relation exist between both the subject and the object
		/**

		 SELECT t1.subject_user_id AS f1, t2.subject_user_id AS f2
		 FROM user_relation AS t1
		 JOIN user_relation AS t2
		 ON t1.subject_user_id = t2.object_user_id
		 WHERE t1.subject_user_id =34
		 GROUP BY f2

		 SELECT subject_user_id AS a, object_user_id AS b FROM user_relation As f1
		 JOIN user_relation As f2 ON f1. subject_user_id = f2. object_user_id
		 WHERE f1.subject_user_id = 10

		 $sql = "SELECT
		 t1.subject_user_id AS f1, t2.subject_user_id AS object_user_id, t3.nickname
		 FROM user_relation AS t1 RIGHT JOIN user_relation AS t2
		 ON t1.subject_user_id = t2.object_user_id LEFT JOIN user_inhouse_data AS t3
		 ON t3.user_inhouse_id = t2.subject_user_id
		 WHERE t1.subject_user_id =$this->me_id()
		 GROUP BY object_user_id";
		 $q = $this -> db -> query($sql);
		 return $q;

		 */
		//count(*) AS total,

		$sql = "SELECT t1.object_user_id 
		FROM user_relation AS t1
		RIGHT JOIN user_relation AS t2 
		ON t1.subject_user_id = t2.object_user_id
		AND t1.object_user_id = t2.subject_user_id
		WHERE t1.subject_user_id =$id
		GROUP BY t1.object_user_id";
		$q = $this -> db -> query($sql);
		return $q;
		// $data = $q -> result_array();
		/**

		 $q = $this -> db -> select('t1.subject_user_id AS f1, t2.subject_user_id AS object_user_id, t3.nickname') -> from('user_relation AS t1') -> join('user_relation AS t2 ', 't1.subject_user_id = t2.object_user_id', 'left') -> join('user_inhouse_data AS t3 ', 't3.user_inhouse_id = t1.f1', 'right') -> where('t1.sujbect_user_id', $this -> me_id()) -> group_by('f2');
		 $data = $q -> result_array();

		 */
		//return $data;
	}

	private function myfans($id) {
		//this is the function to call for the people that they follow me
		//column look up in the object
		$q = $this -> db -> select('subject_user_id, object_user_id') -> get_where('user_relation', array('object_user_id' => $id, ));
		//$data = $q -> result_array();
		return $q;
	}

	private function myfriends($id) {
		//this is the function to call for the people that I follow
		//column look up in the subject
		$q = $this -> db -> select('subject_user_id, object_user_id, time') -> get_where('user_relation', 
		array('subject_user_id' => $id,
		//to making the subject user to be pointed at the ID
		'request'=>0,
		//to make sure that they are not on request.
		 ));
		//$data = $q -> result_array();
		return $q;
	}

	private function init() {
		$arr = array();
		$arr = $this -> native_session -> get("userinfo");
		$this -> current_user_login_id = $arr['user_inhouse_id'];
		$this -> current_user_login_nickname = $arr['nickname'];
	}

	/**
	 * Get the serialization of the column name
	 * @param result - the query result
	 * @param column name - single name of the column result
	 *
	 */

	private function get_serialize($result, $column_name) {
		if (!is_array($result))
			return FALSE;
		$k = array();
		foreach ($result as $key) {
			$k[] = $key[$column_name];
		}
		return $k;
	}

	private function get_ids($result) {
		$k = array();
		foreach ($result as $key) {
			$k[] = $key['object_user_id'];
		}
		return $k;
	}

	private function get_block_ids($result) {
		$k = array();
		foreach ($result as $key) {
			$k[] = $key['block'];
		}
		return $k;
	}

	// ===================================================================
	public function myfriends_id_universal($id){
		//ask for an array of IDs from a given user ID
		$ti = $this -> myfriends($id);
		$t = $ti -> result_array();
		return $this -> get_ids($t);
	}
	private function myconnection_id() {
		$ti = $this -> myconnections($this -> current_user_login_id);
		$t = $ti -> result_array();
		return $this -> get_ids($t);
	}

	private function myfan_id() {
		$ti = $this -> myfans($this -> current_user_login_id);
		$t = $ti -> result_array();
		return $this -> get_ids($t);
	}

	private function myfriends_id() {
		$ti = $this -> myfriends($this -> current_user_login_id);
		$t = $ti -> result_array();
		return $this -> get_ids($t);
	}

	private function blocked_by_others() {
		$q = $this -> db -> select('subject_user_id, object_user_id, block') -> get_where('user_relation', array('object_user_id' => $this -> current_user_login_id, 'block' => 1));
		$t = $q -> result_array();
		return $this -> get_block_ids($t);
	}

	//=====================================================================
	
	// @NING use for update
	public function clean_up_user_relations() {
		// Get all user id
		$this -> db -> select('user_inhouse_id');
		$query = $this -> db -> get('user_inhouse_data');
		$user_ids = $query -> result_array();
		
		
		$table_name = 'activity_data';
		$primary_key = 'activity_id';
		$user_id_key = 'user_inhouse_id';
		

			$this -> db -> select($primary_key.' '.$user_id_key);
			$query = $this -> db -> get($table_name);
			$data = $query -> result_array();
			
			
			for ($i=0; $i<count($data); $i++) {
				
				$no_such_user_id = true;
				
				for ($j=0; $j<count($user_ids); $j++) {
					if ($data[$i][$user_id_key]==$user_ids[$j]['user_inhouse_id']) {
						$no_such_user_id = false;
						break;
					}
				}
				
				if ($no_such_user_id) {
					$this->db->delete($table_name, array($primary_key => $data[$i][$primary_key]));
					echo "table [".$table_name."]: delected id [".$i."], user id ".$user_ids[$j][$user_id_key];
				}
			}
			echo "<br/>";

			
		}
}
