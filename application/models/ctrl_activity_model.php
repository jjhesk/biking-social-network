<?php

class Ctrl_activity_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this -> load -> model("init_model");
        $this -> load -> model("mod_activity_model", "activity_model");
        $this -> load -> model("mod_login_model", "login_model");
        $this -> load -> model("mod_facebook_model", "facebook_model");
        $this -> load -> model("mod_googlemaps_model", "googlemaps_model");

        /* end of constant setting */
    }

    public function get_open_graph_object($activity_id) {
        //current use in contest_gallery_like
        //echo $activity_id;
        $data['open_graph_object'] = $this -> activity_model -> DBget_get_open_graph_object($activity_id);
        $data['fb_app_id'] = $this -> config -> item("fb_app_id");
        $data['fb_admins'] = $this -> config -> item("fb_admins");
        $data['website_name'] = $this -> config -> item("website_name");
        //$returnurl=FACEBOOK_APP_URL;
        //echo "<br/> portal 242";
        //print_r($data);
        header(':', true, 206);
        if (count($data['open_graph_object']) > 0) {
            $this -> load -> view("open_graph_object", $data);
        } else {
            echo "<br/>protal 249 no activity found";
        }
    }

    public function get_4_recent_activities_count_by_user_inhouse_id($user_inhouse_id) {
        return $this -> activity_model -> DBget_4_recent_activities_count_by_user_inhouse_id($user_inhouse_id);
    }

    public function get_google_map_by_activity_id($activity_id) {
        $data['map'] = $this -> googlemaps_model -> get_recent_map_small($activity_id);
        return $this -> load -> view("iframe_map", $data, true);
    }

    public function get_activity_data_by_user_inhouse_id($user_inhouse_id, $self = FALSE, $args = array()) {
        $this -> load -> model("ctrl_login_model");
        //echo "<br/>ctrl activity model 34 ".$user_inhouse_id;
        if ($user_inhouse_id == "0") {
            $friend_list_inhouse_data = $this -> login_model -> DBget_user_inhouse_info_by_user_inhouse_id(0);
            /*for($i=0;$i<count($friend_list);$i++){
             $friend_list[$i]['user_inhouse_id']=$friend_list[$i]['user_id'];
             }*/
            //echo "<br/>ctrl activity model 55 ";
            //print_r($friend_list_inhouse_data);
            $friend_activity_data = $this -> activity_model -> DBget_activity_data_by_multi_user_inhouse_id($friend_list_inhouse_data, $args);
            $result['array'][0] = $friend_activity_data;
            $result['array'][1] = $friend_list_inhouse_data;
            //$result['condition_key'][0]="object_user_id";
            $result['condition_key'][0] = "user_inhouse_id";
            $result['condition_key'][1] = "user_inhouse_id";
            $result = $this -> init_model -> array_inner_join_in_same_key($result);
            //$result=$this->init_model->array_outer_join_in_same_key($result);
            //echo "<br/>ctrl activity model 58 ";
            //print_r($friend_activity_data);
            for ($i = 0; $i < count($result); $i++) {
                //"html_map_size"
                $result[$i]['map'] = $this -> googlemaps_model -> get_recent_map_html($result[$i]['activity_id'], $args["html_map_size"]);
                //echo "<br/> ctrl activity model 61 ";
                //print_r($result[$i]['map']);
            }
            //echo "<br/> ctrl activity model 77 ------------------rsult";
            //print_r($result);
            return $result;
        }

        if ($self) {
          //  echo "<br/>ctrl activity model 42 is_self";
            //$is_selfs=true;
            $friend_list = $this -> ctrl_login_model -> bll_get_friend_list_by_user_inhouse_id($user_inhouse_id, true);
        } else {
            //$is_selfs=false;
           // echo "<br/>ctrl activity model 47 no self";
            $friend_list[0]['user_id'] = $user_inhouse_id;
        }
        //echo "<br/>ctrl actiivty model 36 ";
        //print_r($friend_list);
        //BLL LV2
        //echo "<br/>ctrl activity_model 744 ".count($friend_list);
        //print_r($friend_list);
        if (count($friend_list) > 0) {
            //echo "<br/>activity_model 518  friend_list:<br/>";
            //print_r($friend_list);
            for ($i = 0; $i < count($friend_list); $i++) {
                $friend_list[$i]['user_inhouse_id'] = $friend_list[$i]['user_id'];
            }

            $friend_list_inhouse_data = $this -> login_model -> DBget_user_inhouse_info_by_user_inhouse_id($friend_list);
            //echo "<br/>ctrl activity model 55 ";
            //print_r($friend_list_inhouse_data);
            $friend_activity_data = $this -> activity_model -> DBget_activity_data_by_multi_user_inhouse_id($friend_list, $args);
            //echo "<br/>ctrl activity model 58 ";
            //print_r($friend_activity_data);
            $result['array'][0] = $friend_activity_data;
            $result['array'][1] = $friend_list_inhouse_data;
            //$result['condition_key'][0]="object_user_id";
            $result['condition_key'][0] = "user_inhouse_id";
            $result['condition_key'][1] = "user_inhouse_id";
            $result = $this -> init_model -> array_inner_join_in_same_key($result);
            //$result=$this->init_model->array_outer_join_in_same_key($result);
            //echo "<br/>ctrl activity model 58 ";
            //print_r($friend_activity_data);
            for ($i = 0; $i < count($result); $i++) {
                //"html_map_size"
                $result[$i]['map'] = $this -> googlemaps_model -> get_recent_map_html($result[$i]['activity_id'], $args["html_map_size"]);
            }
            //echo "<br/> ctrl activity model 77 ------------------rsult";
            //print_r($result);
            return $result;
        } else {
            return "false";
        }
        //echo "<br/>ctrl_activity_model 32 ".count($activity_data);
        /*if(count($activity_data)>0){
         for($i=0;$i<count($activity_data);$i++){
         $activity_data[$i]['activity_photo']=$this->activity_model->DBget_activity_photo_by_activity_id($activity_data[$i]['activity_id']);
         }
         return $activity_data;
         }else{
         return null;
         }*/
    }

    public function get_activity_singular_by_user_inhouse_id($user_inhouse_id) {
        return $this -> get_activity_data_by_user_inhouse_id($user_inhouse_id, '', array("html_map_size" => "big"));
    }

    public function get_activities_by_user_inhouse_id($user_inhouse_id = 0, $self = FALSE, $options = array()) {
        return $this -> get_activity_data_by_user_inhouse_id($user_inhouse_id, $self, array("html_map_size" => "small", "pagnation" => $options));
    }

    public function bll_post_activity_facebook_from_mobile($access_token, $photo = null) {
        //LV3
        //echo "<br/>facebook_model 411 ".$access_token;
        $userinfo['userinfo']['access_token'] = $access_token;
        $this -> facebook -> setAccessToken($access_token);
        $userinfo['userinfo']['openid'] = $this -> facebook -> getUser();
        $userinfo['comment'] = "";
        if ($photo != null) {
            $photo = base64_decode($photo);
            //echo "<br/>facebook_model 165<br/>photo length:";
            //echo strlen($photo);
            $filename = rand(10000000, 99999999);
            $dest = "upload/" . $filename . ".jpg";
            file_put_contents($dest, $photo);
            $userinfo['image']['tmp_name'] = $dest;
        }
        //echo "<br/>facebook_model 424 ";
        //print_r($userinfo);
        return $userinfo;
    }

    public function activity_photo_post($post = null) {
        $password = "";
        if ((isset($_POST)) && ($_POST != null) && ($post == null))
            $post = $_POST;
        if ((isset($post['password'])) && ($post['password'] != '')) {
            $password = $post['password'];
        } else {
            $password = $post['activity_id'];
        }
        $result = $this -> activity_model -> get_activity_from_password($password);
        /* AAAHTUJ0F8LsBAAAwLnFMNzOIxeib0pYTKzSZA1OgjZBFCIm98Mu2aZARcpExK3Fdg66c8E5QXSot4IitjO4NPPiBrLJ6g0DlpJ8DmBQ7CVsSgN65krQ */
        // If no activity made yet, create one
        if ($result == null) {
            $real_activity_id = $this -> activity_model -> create_new_activity($post['user_inhouse_id'], $post['app_id'], $password);
        } else {
            $real_activity_id = $result['activity_id'];
        }

        //for testing
        //$result=$this->activity_model->get_activity_from_password($_POST['activity_id']);
        $userinfo = $this -> login_model -> DBget_user_inhouse_info_by_user_inhouse_id($post['user_inhouse_id']);

        if ($userinfo['photo_publication'] == "facebook") {
            $postback = $this -> FBset_mobile_upload($real_activity_id, $post['photo']);
        } else if ($userinfo['photo_publication'] == "google") {

        }
        // Check error message
        $postback_string;
        switch ($postback) {
            case '-1' :
                $postback_string = "This facebook token may be expired.";
                break;
            case '-2' :
                $postback_string = "This activity's owner does not have facebook account.";
                break;
            case '-3' :
                $postback_string = "No activity data has been found.";
                break;
            default :
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

    public function get_userinfo($data) {

    }

    public function FBset_mobile_upload($activity_id, $photo = null) {
        //LV2
        //$activity_id= acitivty_data's id
        //$photo=base64encoded image [string]
        //====get activity data by activity id===
        //return "run facebook_model 107";
        //echo "<br/>facebook_model 107<br/>photo length: ";
        //echo strlen($photo);
        $activity_data = $this -> activity_model -> DBget_activity_data_by_activity_id($activity_id);
        if (count($activity_data) > 0) {
            //====get user oauth data by user_inhouse_id===
            $user_inhouse_id = $activity_data['user_inhouse_id'];
            $this -> db -> where("user_inhouse_id", $user_inhouse_id);
            $this -> db -> where("oauth_server_name", "facebook");
            $user_oauth = $this -> db -> get("user_oauth");
            $user_oauth = $user_oauth -> result_array();
            //==================
            if (count($user_oauth) > 0) {
                //===upload the photo to facebook
                $access_token = $user_oauth[0]['oauth_server_id'];
                //echo "<br/>facebook_model 125<br/>";
                //echo $access_token;
                $data = $this -> bll_post_activity_facebook_from_mobile($access_token, $photo);
                //echo "<br/>facebook_model 120 before fb submit<br/>";
                $data['description'] = $activity_data['description'];
                $result = $this -> facebook_model -> upload_facebook_activity($data);

                //echo "<br/>facebook_model 122 after fb submit<br/>";
                //print_r($result);
                //====================
                if ($result != '') {
                    $imageinfo = $this -> facebook_model -> get_photo_from_facebook($result['id']);
                    //echo "<br/>facebook_model 114<br/>";
                    //print_r($imageinfo);
                    $userinfo['activity_id'] = $activity_id;
                    $userinfo['fbid'] = $result['id'];
                    $userinfo['thumb_url'] = $imageinfo['src_small'];
                    $userinfo['full_url'] = $imageinfo['src_big'];
                    $userinfo['original_url'] = $imageinfo['images'][0]['source'];
                    $userinfo['userinfo']['user_inhouse_id'] = $user_inhouse_id;
                    $userinfo['comment'] = '';
                    $this -> activity_model -> db_set_activity($userinfo);
                    unlink($data['image']['tmp_name']);
                    //echo $result=$this->db->insert_id();
                    return $result;
                } else {
                    //"This facebook token may be expired. "
                    return -1;
                }
            } else {
                //"This activity's owner does not have facebook account."
                return -2;
            }
        } else {
            //"No activity data has been found."
            return -3;
        }

        /*$this->db->set("activity_id", $activity_id);
         $this->db->set("activity_id", $activity_id);
         $this->db->insert("", );*/
    }

    public function get_activity_data_by_activity_id($activity_id) {
        $result = $this -> activity_model -> DBget_activity_data_by_activity_id($activity_id);
        $result['map'] = $this -> googlemaps_model -> get_recent_map_html($activity_id, "big");
        //echo "<br/>ctrl activity model 258 ";
        //print_r($result);
        return $result;
    }

    public function get_kml_by_activity_id($map_type, $activity_id) {
        $data = array();
        $data = $this -> googlemaps_model -> get_kml($activity_id);
        //echo "<br/>ctrl_activity"
        //echo "<br/>utility 76 ";
        //print_r($data);
        /*if($data['kml_checkpoints']==NULL) {
         $this->googlemaps_model->update_checkpoint_kml($activity_id);
         $data = $this -> googlemaps_model -> get_kml($activity_id);
         }*/
        if ($data['kml_path'] == NULL) {
            $this -> googlemaps_model -> update_path_kml($activity_id);
            $data = $this -> googlemaps_model -> get_kml($activity_id);
        }
        //echo "<br/>utility 86 ";
        //print_r($data);
        return $data;

    }

    public function bll_activity_manual_post_1($post, $userinfo, $last_activity_id) {

        //echo "<br/>activity_model 472";
        //print_r($post);
        //$apps_info=$this->activity_model->DBget_apps_data_by_apps_id($post['app_id']);
        $apps_name = $this -> config -> item("website_name");

        $title = $apps_name;
        if ((!isset($post['title'])) || ($post['title'] == null)) {
            if ($app_name = "PetNfans") {
                //From user's perspective, PetNfans does not contain activity, therefore the upload title is changed
                $title = $userinfo['nickname'] . " just uploaded a new photo through " . $apps_name . ".";
            } else {
                //For now, only iBikeFans activity will be on else. Change here when more theme are added
                $title = $userinfo['nickname'] . " just completed an " . $apps_name . " activity.";
            }
        } else {
            $title = $post['title'];
        }
        if (isset($post['coordinate_json']))
            $post['coordinates_json'] = $post['coordinate_json'];
        if ((!isset($post['description'])) || ($post['description'] == null)) {
            $description = $this -> activity_model -> get_description_from_coordinates(null, $apps_name, $userinfo['nickname'], $post['coordinates_json']);
        } else {
            $description = $post['description'];
        }
        $privacy = $this -> activity_model -> DBget_privacy($post['app_id'], $userinfo);
        //echo "<br/>api 72";
        // Retrieve data
        $data = $post;
        $data['table'] = "activity_data";
        $data['user_inhouse_id'] = $userinfo['user_inhouse_id'];
        $data['title'] = $title;
        $data['description'] = $description;
        $data['privacy'] = $privacy;
        $data['prev_activity_id'] = $last_activity_id;
        $data['last_updated'] = date('Y-m-d H:i:s');
        $data['mode'] = $post['mode'];
        $data['privacy'] = "default";
        $data['end_time'] = date('Y-m-d H:i:s');
        $data['start_time'] = date('Y-m-d H:i:s', strtotime("-" . $data['elapse_time'] . " minute"));

        $result = $this -> init_model -> DBset_available_input_field($data);
        //echo "<br/> activity_model 871 ";
        //print_r($result);
        /*$data = array(
         'user_inhouse_id' => $userinfo['user_inhouse_id'],
         'app_id' => $post['app_id'],
         'password' => $post['password'],
         'title' => $title,
         'description' => $description,
         'last_updated' => date( 'Y-m-d H:i:s'),
         'has_ended' => $post['has_ended'],
         'mode' => $post['mode'],
         'avg_speed' => $post['avg_speed'],
         'avg_temperature' => $post['avg_temperature'],
         'avg_heart_rate' => $post['avg_heart_rate'],
         'total_distance' => $post['total_distance'],
         'elapse_time' => $post['elapse_time'],
         'elapse_time_sec' => $post['elapse_time_sec'],
         'max_speed' => $post['max_speed'],
         'max_heart_rate' => $post['max_heart_rate'],
         'total_calories' => $post['total_calories'],
         'coordinates_json' => $post['coordinates_json'],
         'custom_data_json' => $post['custom_data_json'],
         'privacy'=>$privacy,
         'prev_activity_id' => $last_activity_id,
         'next_activity_id' => NULL);*/
        return $result;

    }

    public function get_self_activity() {

    }

    public function activity_manual_post($post = null) {
        if ($post != null)
            $_POST = $post;
        $user_id = null;
        if (isset($_POST['user_inhouse_id']))
            $user_id = $_POST['user_inhouse_id'];
        $userinfo = $this -> login_model -> DBget_user_inhouse_info_by_user_inhouse_id($user_id);
        //echo "<br/> activity_model 1041 ".count($userinfo);
        if (count($userinfo) > 0) {

            //prepare the upload data
            $last_activity_id = $this -> activity_model -> get_user_most_recent_activity_id($user_id);
            $new_data = $this -> bll_activity_manual_post_1($_POST, $userinfo, $last_activity_id);
            $activity_id = null;
            // See if password exists
            if (isset($_POST['password'])) {
                $result = $this -> activity_model -> get_activity_from_password($_POST['password']);
                $activity_id = $result['activity_id'];
            }
            //echo "<br/>activity model 1059";
            //get privacy
            // If no such password, create new row
            if ($activity_id == null) {
                //echo "<br/>api 106";
                // Create new activity
                $this -> db -> insert('activity_data', $new_data);
                //$activity_id = $this->activity_model->get_user_most_recent_activity_id($user_id);
                $activity_id = $this -> db -> insert_id();
            } else {
                $this -> db -> where("activity_id", $activity_id);
                $this -> db -> update('activity_data', $new_data);
            }

            // Update node in previous activity
            $this -> db -> set('next_activity_id', $activity_id);
            $this -> db -> where('activity_id', $last_activity_id);
            $this -> db -> update('activity_data');
            //echo "<br/>api 132";
            if ((isset($_POST['coordinates_json'])) && ($_POST['coordinates_json'] != '[]')) {
                //echo "<br/>ctrl activity model 117 update map";
                $this -> googlemaps_model -> update_path_kml($activity_id);
                $this -> googlemaps_model -> update_checkpoint_kml($activity_id);
            }
            //auto upload the activity to facebook if the user have facebook account
            $data['userinfo'] = $userinfo;
            $data['activity_id'] = $activity_id;
            $this -> ctrl_share_to_social_publication($data);
            $response = array("status" => "success", "activity_id" => $activity_id);
            echo json_encode($response);
        } else {
            echo "<br/> api 64 there is no user here.";
        }
    }

    public function ctrl_share_to_social_publication($data) {
        //LV2 ctrl
        /*$data=array(
         "userinfo",
         *  "activity_id",
         );*/
        $permission = $this -> login_model -> bll_get_social_permission_by_user_inhouse_data($data['userinfo']);
        if ($permission != null) {
            foreach ($permission as $_permission) {
                if ($_permission == "facebook") {
                    $facebook_oauth = $this -> login_model -> DBget_oauth_by_user_inhouse_id($data['userinfo']['user_inhouse_id'], "facebook");
                    //echo "<br/>activity 161 after upload ".$facebook_oauth['code'];
                    if ($facebook_oauth != null) {
                        $facebook_oauth = $this -> facebook_model -> FBget_access_token_by_code($facebook_oauth);
                        if (isset($data['activity_id'])) {
                            echo $this -> upload_facebook_open_graph_object_by_activity($data['activity_id'], $facebook_oauth);
                        }
                    }
                } else if ($_permission == "google") {

                }
            }
        } else {
            echo "<br/> activity model 949 no permission";
        }
    }

    public function upload_facebook_open_graph_object_by_activity($activity_id, $access_token) {
        //LV1 ctrl level
        //echo "<br/>facebook model 64 upload_facebook_open_graph_object_by_activity";
        $user_fbid = $this -> facebook_model -> FBget_User($access_token);
        $activity_data = $this -> activity_model -> DBget_activity_data_by_activity_id($activity_id);
        if ($activity_data != null) {
            $image = base_url() . "/images/logo_ibike.png";
            $link = 'https://graph.facebook.com/' . $user_fbid . '/feed';

            //echo "<br/>facebook model 81 ";
            //print_r($activity_data);
            $description = "";
            if ((isset($_POST['description'])) && ($_POST['description'] != null)) {
                $description = $_POST['description'];
            } else if ($activity_data['description'] != '') {
                $description = $activity_data['description'];
            }

            $attachment = array("access_token" => $access_token, "name" => $activity_data['title'], "link" => site_url() . "/portal/open_graph_object/" . $activity_id, 'caption' => '', 'description' => $description, "picture" => $image);
            //echo "<br/>facebook model 45 ";
            //print_r($attachment);
            $result = $this -> facebook_model -> curls($attachment, $link);
        } else {
            echo "<br/> facebook mdoel 43 no activity data found";
            return null;
        }
    }

}
?>