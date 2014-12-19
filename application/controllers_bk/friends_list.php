<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Friends_list extends CI_Controller {
	public $login;
	private $button_fans = array("add" => "add", "profile" => "profile", "cloud" => "message");
	private $button_connections = array("unconnect" => "unconnect", "profile" => "profile", "cloud" => "message");
	private $button_requests = array("remove" => "cancel request", "profile" => "profile", "cloud" => "message");
	private $button_strangers = array("add" => "request", "profile" => "profile", "report" => "report abuse");
	private $buttons_add_search_friends = array("add" => "add from search");
	private $buttons_add_search_facebook = array("add" => "make a request");
	private $friends_view = array("profile" => "profile");
	function __construct() {
		parent::__construct();
		//$this->output->enable_profiler(true);
		$this -> output -> set_header("Access-Control-Allow-Origin: https://*.twitter.com");
		$this -> load -> model('friends_model', 'f');
		$this -> load -> model('facebook_model', 'fb');
		$this -> load -> helper(array('array_helper', 'file'));
		$this -> load -> model('profile_model', 'profile');
		$this -> load -> model('news_model', 'news');
		$this -> load -> library('user_agent');
	}
	function __destruct() {
    	$this->init_model->destroy_sensitive_session();
    }
	public function random_friends_related() {
		$data = $this -> f -> get_random_friends_related();
		$h = '<div class="topwidebanner">People You May Know</div><div id="js_item_manage">';
		foreach ($data as $key => $val) {
			$a = $val['profile_image'] == null ? base_url() . 'images/common/no-photo.png' : $val['profile_image'];
			$b = $val['nickname'] == null ? 'unknown' : $val['nickname'];
			$c = $val['gender'] == null ? 'n/a' : $val['gender'];
			$h .= '<div class="item kbox" uid="' . $val['user_inhouse_id'] . '">';
			$h .= '<div class="upperpart"><img src="' . $a . '"/>';
			$h .= '<div class="lowerpart"><div class="name">' . $b . '</div><div class="sex">' . $c . '</div></div>';
			$h .= '</div></div>';
		}
		$h .= '</div>';
		echo $h;
	}

	public function pending_friends_ajax() {
		$data = $this -> f -> get_pending_friendrequests_of();
		$how_many = count($data);
		$h = '<div class="topwidebanner">You have ' . $how_many . ' pending requests to your friends.</div><div id="js_item_manage">';
		foreach ($data as $key => $val) {
			$a = $val['profile_image'] == null ? base_url() . 'images/common/no-photo.png' : $val['profile_image'];
			$b = $val['nickname'] == null ? 'unknown' : $val['nickname'];
			$c = $val['gender'] == null ? 'n/a' : $val['gender'];
			$h .= '<div class="item kbox" uid="' . $val['user_inhouse_id'] . '">';
			$h .= '<div class="upperpart"><img src="' . $a . '"/>';
			$h .= '<div class="lowerpart"><div class="name">' . $b . '</div><div class="sex">' . $c . '</div></div>';
			$h .= '</div></div>';
		}
		$h .= '</div>';
		echo $h;
	}

	public function facebook_external($request) {
		$list = array();
		$page = "";
		$content = read_file('./upload/sample_fb.json');
		$ar = json_decode($content, TRUE);
		foreach ($ar as $key => $val) {
			$value = $val['name'];
			$pos = strripos(strtolower($value), strtolower($request));
			if ($pos === false) {
				// string needle NOT found in haystack
			} else {
				// string needle found in haystack
				$page .= "<span uid_fb='" . $val['uid'] . "'>";
				$page .= $value . $this -> editarea($this -> buttons_add_search_facebook);
				$page .= "</span>";
			}
			//$value = $val['uid'];
			//$pos = searcharray(strtolower($request));
			//$pos = strpos_array($value,searcharray(strtolower($request)));
			//$pos = searcharray(strtolower($request));
			//$pos = $value." ".$key;
			//print_r($pos);
			//	if($pos>0) {
			//$list[] = array($val['name'], $val['uid'], $val['username']);
			// $page.="<span uid_fb='".$val['uid']."'>";
			//	$page.=$val['name'].editarea($this->buttons_add_search_facebook);
			//	$page.="</span>";
			//}
			//$pos = "";
			//$page .=$pos."  ";
		}
		if (empty($page))
			$page = "0";
		echo $page;
	}

	public function fb() {
		$content = read_file('./upload/sample_fb.json');
		$ar = json_decode($content, TRUE);
		//print_r($ar);
		foreach ($ar as $key => $val) {
			echo $val['name'] . "<br>";
			//username
			//uid
		}
		//======
		// JSA
		//======
		//$ar=$this->fb->get_friendlist_from_facebook();
		//print_r($ar);
	}

	public function index() {
		//$data["thispeak"]=$this->f->this_this();
		$this -> load -> view("friends_list/page_main.php", $this -> data_ini());
	}

	private function search_listing($obj) {
		$o = "<select>";
		foreach ($obj as $k => $value) {
			$o .= '<option value=' . $k . '>' . $value . '</option>';
		}
		$o .= "</select>";
		return $o;
	}

	private function data_ini() {
		$options_search = array("by name", "by email", "by ID", "by gender", "by age");
		$data = array();
		$data["count_follow"] = $this -> f -> count_follow();
		$data["count_fans"] = $this -> f -> count_fans();
		$data["count_real"] = $this -> f -> count_real_friends();
		$data["base"] = base_url() . 'index.php/';
		$data["my_name"] = "sssss";
		$data["my_id"] = $this -> f -> me_id();
		$data["friends"] = $this -> f -> show_my_requests();
		$data["not_friends"] = $this -> f -> show_not_myfriends();
		$data["true_friends"] = $this -> f -> show_real_friends();
		$data["fans"] = $this -> f -> show_fans();
		$data["search_options"] = $this -> search_listing($options_search);
		return $data;
	}

	/*
	 * 			get the count numbers related to the database and it is released to the public URL
	 *
	 *
	 */
	public function get_counts() {
		$h = array("fan" => $this -> f -> count_fans(), "connect" => $this -> f -> count_real_friends(), "follow" => $this -> f -> count_follow());
		$h = json_encode($h, JSON_FORCE_OBJECT);
		echo $h;
	}

	public function get_user_datapack() {
		$h = $this -> f -> myfriends_package();
		$h = json_encode($h, JSON_FORCE_OBJECT);
		echo $h;
	}

	public function get_count_msg() {
		echo $this -> f -> get_msg_n();
	}

	public function get_count_friends() {
		echo $this -> f -> count_real_friends() + $this -> f -> count_follow();
	}

	public function get_count_connnects() {
		echo $this -> f -> count_real_friends();
	}

	public function get_count_fans() {
		echo $this -> f -> count_fans();
	}

	public function get_count_follow() {
		echo $this -> f -> count_follow();
	}

	public function pipline_summary() {
	}

	private function editarea($buttons, $extra = "") {
		$output = '<div class="editarea">';
		foreach ($buttons as $button => $value) {
			$output .= '<div class="animated ' . $button . '" desc="' . $value . '">';
			$output .= '<div class="buttonlabel right">' . $value . '</div></div>';
		}
		$output .= $extra;
		$output .= '</div>';
		return $output;
	}

	private function spanhelper($id, $content) {
		return '<div class="animated display_single item" uid="' . $id . '">' . $content . '</div>';
	}

	private function imghelper($url) {
		if ($url == "NULL" || $url === NULL || $url == '')
			$pic = '';
		else
			$pic = '<img rel="profilepicture" src="' . $url . '"/>';
		$html = '<div class="profilepic">' . $pic . '</div>';
		return $html;
	}

	private function helper_k_factor($k) {
		$c = '';
		$c .= $this -> imghelper($k['profile_image']);
		$c .= '<div class="textblock"><div class="top"><div class="name">' . $k['firstname'] . ' ' . $k['lastname'] . '</div>';
		$c .= '<div class="location">' . $k['country'] . '</div></div>';
		$c .= '<div class="k_man">' . '' . '</div></div>';
		$c .= $this -> editarea($this -> button_fans);
		return $c;
	}

	private function helper_factor_pipeline_friends($k, $button) {
		$c = '';
		$c .= $this -> imghelper($k['profile_image']);
		$news = $this -> news -> get_user_latest_news_string($k['user_inhouse_id']);
		$a = $this -> f -> count_friend_time($this -> f -> me_id(), $k['user_inhouse_id']);
		$b = '<span class="hidebox text" since="' . $a . '">Been friends since <span></span></span>';
		$edit_extra = '<span class="hidebox text"></span><br>';
		$edit_extra .= '<div class="hidebox remove"><div class="buttonlabel right" desc="removefrd">';
		$edit_extra .= 'Remove Friend</div></div>' . $b;

		//$news= '';
		$c .= '<div class="textblock"><div class="top"><div class="name">' . $k['firstname'] . ' ' . $k['lastname'] . '</div>';
		$c .= '<div class="location">' . $k['country'] . '</div></div>';
		$c .= '<div class="k_man">' . $news . '</div></div>';

		$c .= $this -> editarea($button, $edit_extra);
		return $c;
	}

	private function list_search($data) {
		if (empty($data)) {
			$output = "There is no result";
			return $output;
		}
		if (is_array($data)) {
			$output = "<div id='result'>";
			foreach ($data as $nothing => $k) {
				$status = $this -> f -> get_friends_status($k['user_inhouse_id']);
				switch($status) {
					case 0 :
						break;
					case 1 :
						//this is the situation for an ordinary friend relationship
						$listbottons = $this -> friends_view;
						$additional_comment = 'You are already friends with ';
						break;
					case 2 :
						//this is for the pending friend request from A -> B
						$listbottons = array("remove" => "cancel the request");
						$additional_comment = 'Your friend request has sent';
						break;
					case 3 :
						//this is just a fresh new people and they are unrelated.
						$listbottons = $this -> buttons_add_search_friends;
						$additional_comment = '';
						break;
					case 4 :
						$additional_comment = '';
						$listbottons = $this -> button_connections;
						break;
				}
				$output .= '<div class="animated display_single item" uid="' . $k['user_inhouse_id'] . '">';
				$output .= $this -> imghelper($k['profile_image']);
				//$output .= '<div class="textblock"><div class="top"><div class="name">' . $k['firstname'] . ' ' . $k['lastname'];
				$output .= '<div class="name">@' . $k['nickname'] . ', ' . $k['firstname'] . ' ' . $k['lastname'];

				if (!empty($additional_comment)) {
					$output .= '<br><span style="text-transform:none">' . $additional_comment . $k['nickname'] . '</span>';
				}
				//$output .= '</div>';
				$output .= '</div>' . $this -> editarea($listbottons);
				$output .= '</div>';
			}
			$output .= "</div>";
			return $output;
		}
	}

	public function pipeline_friends() {
		$dime = '';
		$method = array('user_inhouse_id', 'firstname', 'lastname', 'country', 'career', 'profile_image', 'gender');
		$data = $this -> f -> getdatafriendsid($this -> f -> me_id(), $method);
		//print_r($data);
		//exit;
		foreach ($data as $k) {
			$d = $k['user_inhouse_id'];
			$dime .= $this -> spanhelper($d, $this -> helper_factor_pipeline_friends($k, $this -> friends_view));
		}
		echo $dime;
	}

	public function pie_conntect_n_fan($n = 0) {
		$dime = "<br>";
		$msa_status = $dime . "this is the message for the person. fansliving is cool!";
		$data = $this -> f -> show_real_friends($n);
		$dime = '';
		foreach ($data as $k) {
			$d = $k['user_inhouse_id'];
			//$dime .= $this -> spanhelper($d, $this -> helper_k_factor($k));
		}
		$data = $this -> f -> show_my_requests($n);
		foreach ($data as $k) {
			$d = $k['user_inhouse_id'];
			$dime .= $this -> spanhelper($d, $this -> helper_k_factor($k));
		}
		echo $dime;
	}

	public function pipline_conntect_fans($n = 0) {
		$dime = "<br>";
		$msa_status = $dime . "this is the message for the person. fansliving is cool!";
		$data = $this -> f -> show_real_friends($n);
		$dime = '';
		foreach ($data as $k) {
			$d = $k['subject_user_id'];
			//$dime .= $this -> spanhelper($d, $this -> helper_k_factor($k));
		}
		echo $dime;
	}

	public function pieline_mypeople($n = 0) {
		//this is the people i have requseted that will be show in html group
		$data = $this -> f -> show_my_requests($n);
		//print_r($data);
		//exit;
		$dime = '';
		foreach ($data as $k) {
			$d = $k['user_inhouse_id'];
			$dime .= $this -> spanhelper($d, $this -> helper_k_factor($k));
		}
		echo $dime;
	}

	//=======================================================================
	public function pieline_mypeople_limit() {
		$dime = '';
		$data = $this -> f -> show_my_requests(20);
		foreach ($data as $k) {
			$d = $k['subject_user_id'];
			//$dime .= $this -> spanhelper($d, $this -> helper_k_factor($k));
		}
		echo $dime;
	}

	public function pieline_fans_limit() {
		$data = $this -> f -> show_fans(20);
		$dime = '';
		foreach ($data as $k) {
			$d = $k['subject_user_id'];
			//$dime .= $this -> spanhelper($d, $this -> helper_k_factor($k));
		}
		echo $dime;
	}

	public function pieline_notmypeople() {
		$dime = '';
		$data = $this -> f -> show_not_myfriends(20);
		foreach ($data as $k) {
			$d = $k['subject_user_id'];
			//$dime .= $this -> spanhelper($d, $this -> helper_k_factor($k));
		}
		echo $dime;
	}

	public function pieline_friendsrequestpanel() {
		$d = $this -> f -> getdatafriendrequests(array('firstname', 'lastname', 'profile_image', 'gender', 'user_inhouse_id'));
		if (!$d)
			echo "0";
		else
			echo $this -> list_my_friend_requests($d);
	}

	private function list_my_friend_requests($data) {
		$d = '';
		//click on this tab and a list of friends request will show on the top bar where you will able to see accept friends or reject friends
		foreach ($data as $k) {
			$d .= '<li uid=' . $k['user_inhouse_id'] . '>';
			$d .= '<div class="left"><img src="' . $k['profile_image'] . '"/></div><div class="middle">' . $k['firstname'] . ' ' . $k['lastname'] . '</div>';
			$d .= '<div class="sex">' . $k['gender'] . '</div>';
			$d .= '<br><div class="reject"><div class="mark"></div><span>reject</span></div><div class="accept"><div class="mark"></div><span>accept</span></div>';
			$d .= '</li>';
		}
		return $d;
	}

	/*
	 *
	 * this is for debug purposes
	 *
	 * action_gen_relation
	 *
	 * action_gen_people
	 *
	 * action_gen_fans
	 *
	 *
	 */
	public function action_gen_message($n = 100) {
		if ($this -> f -> add_r_msg($n))
			die("1");
		else
			die("0");
	}

	public function action_gen_relation($n = 100) {
		if ($this -> f -> add_random_relation($n))
			die("1");
		else
			die("0");
	}

	public function action_gen_people($n = 100) {
		if ($this -> f -> add_random_people($n))
			die("1");
		else
			die("0");
	}

	public function action_gen_fans($n = 100) {
		if ($this -> f -> add_random_fan($n))
			die("1");
		else
			die("0");
	}

	//======================================================================================================actively using from the system
	public function action_accept($id) {
		echo $this -> f -> accept_newfriend($id) ? "1" : "0";
	}

	public function action_reject($id) {
		echo $this -> f -> reject_newfriend($id) ? "1" : "0";
	}

	public function action_addfan($user) {
		//determin if your have made request to this person
		/*$result_n =  $this -> f -> is_request($this -> f -> me_id(), $user) ;
		 if($result_n>0){
		 echo '1';
		 }else{
		 $this -> f -> add_friend($user);
		 echo '0';
		 }*/
		//$user = $_POST['targetuid'];
		echo $this -> f -> add_friend($user);
	}

	public function action_remove($id) {
		echo $this -> f -> remove_friend($id) ? "1" : "0";
	}

	//======================================================================================================
	public function action_remove_my_request($user) {
		$result = $this -> f -> remove_request($user) ? "1" : "0";
		echo $result;
	}

	public function action_unconnect($user) {
		$result = $this -> f -> unconnect($user);
		echo $result;
	}

	public function friend_single_redirect() {
		$this -> f -> add_fan();
		//if($this->f->is_new_friend()){ $this->f->add_fan(); echo "1"; }else{ echo "0";}
	}

	public function actionsearch_name($name) {
		$h = $this -> f -> search_by_name($name);
		echo $this -> list_search($h);
	}

	public function action_searchid($id) {
		$h = $this -> f -> search_by_id($id);
		echo $this -> list_search($h);
	}

	public function action_searchemail($email) {
		$h = $this -> f -> search_by_email($email);
		echo $this -> list_search($h);
	}

	//=================== hack and test for quality

	public function test_get_data() {
		//echo $this -> f -> getdatafriendsid(5,array("",));
	}

}
?>