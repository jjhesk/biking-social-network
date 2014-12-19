<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Layout extends CI_Controller {
    protected $configurations;
    public function __construct() {
        parent::__construct();
        $this -> load -> model("googlemaps_model");
        $this -> load -> model("friends_model");
        $this -> load -> library("native_session");
        if ($user_info = $this -> native_session -> get("userinfo")) {
            //get infomation from the table openid
            $this -> user_id = $user_info['user_inhouse_id'];
        }
        /**!
         DEVELOPED BY HESKEMO 2012
         THIS SOFTWARE IS IMPLEMENT SETTING INTERFACE FOR ALL HIS JS APPLICATIONS
         @author heskemo

         **/
        // var fans_obj = ....
        $base_configuration = array(
        //the fansliving current URL domain
        "domain" => base_url(),
        //the external image bin of the folder
        "external_imgbin" => $this -> config -> item('external_images_dir'),
        //the main jQuery folder bin
        "jsbin" => base_url() . "js/jquery/",
        //all the controller for API request will start from this url
        "interface" => base_url() . 'index.php/',
        //the loading HTML5 structure for the CSS
        "loading" => "<div class=\"flickr-loader dark\"><span>loading</span><span>....</span></div>",
        //webview settings initialization
        "webview" => array(
        //webview settings initialization
        "ajaxdiscussions" => base_url() . "index.php/webview_petnfans/ajax_get_data_community",
        //webview settings initialization
        "ajaxtopics" => base_url() . "index.php/webview_petnfans/ajax_get_data_topics",
        //webview settings initialization
        "ajaxNews" => base_url() . "index.php/webview_petnfans/ajax_get_news_mainpage",
        //webview settings initialization
        "ajaxCommunityPost" => base_url() . "index.php/webview_petnfans/ajaxCommunityPost", ),
        //settings islogin
        "islogin" => FALSE,
        //settings detect_mobile
        "ismobile" => $this -> detect_mobile(), );

        $jcomponent_royal_slider = array(
        //this is the configuration from the royalslider that will be used for the front end
        "autoScaleSlider" => FALSE, "autoHeight" => TRUE, "navigateByClick" => FALSE, "controlNavigation" => 'none', "fullscreen" => array(
        // fullscreen options go gere
        "enabled" => TRUE, "native" => TRUE), "autoPlay" => array(
        // autoplay options go gere
        "enabled" => FALSE, "pauseOnHover" => TRUE));
        //adding -jcomponent_royal_slider to the main bone
        $base_configuration["jcomponent_royal_slider_petsnfan"] = $jcomponent_royal_slider;
        
        
        if (isset($this -> user_id)) {
            $new_part_array = array(
            //the user inhouse
            "user_id" => $user_info['user_inhouse_id'],
            //the given name
            "user_name" => $user_info['firstname'] . " " . $user_info['lastname'],
            //only the first name
            "user_1" => $user_info['firstname'],
            //only the last name
            "user_2" => $user_info['lastname'], );
            
            
            /*$this -> configurations["webview"]["user_id"] = $user_info['user_inhouse_id'];
             $this -> configurations["webview"]["user_name"] = $user_info['firstname'] . " " . $user_info['lastname'];
             $this -> configurations["webview"]["user_1"] = $user_info['firstname'];
             $this -> configurations["webview"]["user_2"] = $user_info['lastname'];*/
            // $this->configurations["webview"]["user_profile_image"]=$user_info['profile_image'];
            $base_configuration["islogin"] = TRUE;
            $previous_array = $base_configuration["webview"];
            //adding extra parts for the webview configuration
            $base_configuration["webview"] = array_merge($new_part_array, $previous_array);
        }

        $this -> configurations = $base_configuration;
    }

    public function javascript_init() {
        echo "var fans_obj=" . json_encode($this -> configurations, true) . ";";
    }

    function get_config() {
        return $this -> configurations;
    }

    private function detect_mobile() {
        if (preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|playbook|sagem|sharp|sie-|silk|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
            return true;
        else
            return false;
    }

    /*=======================================================================
     * Forgive me for the beginner regex question but I was hoping that someone could show me how to get the youtube id out of a url regardless of what other GET variables are in the URL.
     * Use this video for example:
     * http://www.youtube.com/watch?v=C4kxS1ksqtw&feature=related
     * so between v= and before the next &
     *=======================================================================*/
    private function parse_youtube_id($url) {
        //$url = "http://www.youtube.com/watch?v=C4kxS1ksqtw&feature=relate";
        $my_array_of_vars = array();
        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
        return $my_array_of_vars['v'];
        // Output: C4kxS1ksqtw
    }

    /*====================================
     * @source: http://www.456bereastreet.com/archive/201010/how_to_make_wordpress_urls_root_relative/
     * WordPress, on the other hand, seems to like absolute URLs for some reason. To clean this up a bit I have the following simple function in my functions.php file to strip the protocol and domain name from URL strings:
     * ===================================*/
    private function make_href_root_relative($input) {
        return preg_replace('!http(s)?://' . $_SERVER['SERVER_NAME'] . '/!', '/', $input);
    }

}
?>