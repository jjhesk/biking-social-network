<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model("init_model");
		$this -> load -> model("login_model");
		$this -> load -> model("profile_model");
		$this -> load -> model("product_model");
		//		$this->output->enable_profiler(true);	//debug function
		$this -> external_images =  $this->config->item('external_images_dir');
	}

	public $external_images;
	private function ttruncat($text, $numb) {

		if (strlen($text) > $numb) {
			$text = substr($text, 0, $numb);
			$text = substr($text, 0, strrpos($text, " "));
			$etc = " ...";
			$text = $text . $etc;
		}
		return $text;

	}

	private function select_listing($objname, $obj) {
		$o = '<div class="fans_button_search"><ul value="' . $objname . '" class="fans_selection bottom">';
		foreach ($obj as $k => $value) {
			$o .= '<li><div class="radius"></div><span value=' . $k . '>' . $value . '</span></li>';
		}
		$o .= '</ul></div>';
		return $o;
	}

	public function index() {
		$url = site_url('product/view');
		header("Location: {$url}");
	}

	public function related_topbar_items($offset = 0, $l = 10) {
		//$o = '<ul id="products_top">';
		$o = '';
		//$r = $this -> product_model -> get_products($l, $offset);
		$r = $this -> product_model -> get_promote_products($l, $offset);
		//print_r($r);
		foreach ($r as $k => $list) {
			$id = $list['product_id'];
			$name = $list['product_name'];
			$model = $list['product_model'];
			$summary = $list['product_summary'];
            $iurl=$list['image_url'];
            $url = (strpos($iurl, 'http') === 0)?$iurl:$this -> external_images . $iurl;
            $o .= '<div class="box" data-id="'.$id.'">';
			$o .= '<img width="50px" height="53px" src="' . $url . '"/><div class="block"><div class="productname" value="' . $id . '">' . $name . '</div>';
			$o .= '<div class="model">' . $model . '</div></div>';
			$o .= '</div>';
		}
		//$o .= '</ul>';
		echo $o;
	}

	public function related_features($offset = 0, $l = 10) {
		//$o = '<ul id="products_related">';
		$o = '';
		$r = $this -> product_model -> get_products($l, $offset);
		//print_r($r);
		foreach ($r as $k => $list) {
			$id = $list['product_id'];
			$name = $list['product_name'];
			$model = $list['product_model'];
			$summary = $list['product_summary'];
            $price = $list['setprice'];
            $iurl=$list['image_url'];
			$url = (strpos($iurl, 'http') === 0)?$iurl:$this -> external_images . $iurl;
			$o .= '<div class="box" data-id="'.$id.'"><div class="img">';
			$o .= '<img src="' . $url . '"/></div><div class="block"><div class="productname" value="' . $id . '">' . $name . '</div>';
			$o .= '<div class="model">' . $model . '</div>';
			$o .= '<div class="summary">' . $this -> ttruncat($summary, 50) . '</div>';
			$o .= '<div class="bottompart"><div class="fastlink"><a class="productdetailonstage"><div class="arrow_s"></div>Learn more</a></div>';
			$o .= '<div class="fastlink"><div class="arrow_s"></div>Add device</div></div></div>';
			$o .= '</div>';
		}
		//$o .= '</ul>';
		echo $o;
	}

	public function top_bar_jax($offset = 0) {
		$r = $this -> product_model -> get_products(4, $offset);
		foreach ($r as $k => $list) {
			$v = $list['product_id'];
			$name = $list['product_name'];
			$model = "XXX IIs C2";
			$url = $this -> external_images . $list['image_url'];
		}
	}
    public function get_single_product_obj($product_id=null){
        $list =$this->product_model->get_product($product_id);
        $iurl=$list['image_url'];
        $url = (strpos($iurl, 'http') === 0)?$iurl:$this -> external_images . $iurl;
        $list['image_url']=$url;
        echo json_encode($list,JSON_FORCE_OBJECT);
    }
	public function view() {
		$data = $this -> init_model -> bll_get_header($this -> native_session -> get("userinfo"));
		$options_search = array("by name", "by product ID");
		/* 
         output
		 [0] => Array
		 (
		 [product_id] => 6
		 [app_id] => 1
		 [product_name] => Super cycling
		 [product_summary] => Cying is fun and i amd typing some description blah blah blah blahb blah
		 [image_url] => https://encrypted-tbn0.google.com/images?q=tbn:ANd9GcRI7hgKT2-vANCRMk51YlQQ0i-Sqlm39eN7tnB8TBNzVLXTa_Lg
		 [last_updated] => 2012-09-19 10:08:01
		 )
		 */
		//$data["base_url_product"] = base_url() . 'index.php/product/';
		//$data["base_url_friends"] = base_url() . 'index.php/friends_list/';
		//$data["base_url_jq"] = base_url() . 'js/jquery/';
		//$data["basicdomain"] = base_url();
		$data["search_options"] = $this -> select_listing('product_search', $options_search);
		$data["content"] = $this -> load -> view("product/page_main", $data, TRUE);
		$this -> load -> view("tpl_main", $data);
	}
	public function nyro_product() {
		$data['product_id'] = $this -> uri -> segment(3);
		echo "<img src='http://judy.imusictech.net/external/product.png'>";
	}
}
?>