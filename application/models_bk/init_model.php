
<?php
class Init_model extends CI_Model 
{
	function __construct()
	{	
		parent::__construct();	
		if(ENVIRONMENT=="development"){
			$this->loadDevelopment();
		}else if(ENVIRONMENT=="production"){
			$this->loadDevelopment();
		}
		
	}
	public $sensitive_session;
	public function urlwriting($url, $index_php=true){
		if($index_php==true){
			return base_url().$url;		
		}else{
			return base_url().$url;		
		}
	}
	public function get_FSPATH($url){
		return $url;
		//return FCPATH."/application/".$url;
		
		
	}
	public function DBget_field_from_table($tablename){
		//DAL
		$result=$this->db->query("show columns from `".mysql_real_escape_string($tablename)."`");
		$result=$result->result_array();
		return $result;
	}
	public function DBget_index_from_table($tablename){
		//DAL
		$result=$this->db->query("show index from `".mysql_real_escape_string($tablename)."`");
		$result=$result->result_array();
		return $result;
	}
	public function DBset_condition_for_select($input_array){
		//BLL
		 /*$input=array(
			"table"=>"" //require
		  * ... //other is free to set
		);*/	
			$available_field=$this->DBget_index_from_table($input_array['table']);
			foreach($input_array as $ikey=>$ival){
				foreach($available_field as $avail_field){
					if($ikey==$avail_field['Column_name']){
						//echo "<br/>activity_model 484 field=".$avail_field['Column_name'];
						$this->db->where($ikey, $ival);
					}
				}
			}
	}
	public function DBset_available_input_field($input_array){
		//BLL
		 /*$input=array(
			"table"=>"" //require
		  * ... //other is free to set
		);*/	
		$output_array=array();
			$available_field=$this->DBget_field_from_table($input_array['table']);
			foreach($input_array as $ikey=>$ival){
				foreach($available_field as $avail_field){
					if($ikey==$avail_field['Field']){
						$output_array[$ikey]=$ival;
					}
				}
			}
		return $output_array;	
	}
	public function array_inner_join_in_same_key($data){
			/*	inner join = if the condition_key does not match, both record will not display
			 *  "in_same_key" means 3 key should be match, so we cannot divided the condition into several, but only use one condition.
				$data['array'][table1][record1][condition_key]=value1; //first array 
				$data['array'][table2][record2][condition_key]=value2; //second array
			 *  ....
			 * $data['condition_key'][0]="..." //the key field that contain in the array1,
			 * $data['condition_key'][1]="..." //the key field that contain in the array1,
			 * ....
			 * 
			 * */
				$result=array();
				$temp_result=array();
				$counter=0;
				//echo "<br/>init_model 43 ".count($data['array']);
				//print_r($data);
				if(count($data['array'])>=2){
					//$record1 is the loop counter of first array's record 
					//$table2 is the loop counter of second+ array
					//$record2 is the loop counter of second+ array's record
					//echo "<br/>init_model 49 ".count($data['array'][0]);
					//print_r($data['array'][0]);
					for($record1=0;$record1<count($data['array'][0]);$record1++){
						$temp_result=$data['array'][0][$record1];
						$condition_counter=1;
						for($table2=1;$table2<count($data['array']);$table2++){
							//$condition_counter is the loop counter of condition key  
							//echo "<br/>init_model 56 ".$table2.":".count($data['array'][$table2]);
							for($record2=0;$record2<count($data['array'][$table2]);$record2++){
								//echo "<br/>init_model 57 ".$data['condition_key'][0].":".$data['array'][0][$record1][$data['condition_key'][0]].":".$data['condition_key'][$table2].":".$data['array'][$table2][$record2][$data['condition_key'][$table2]];
								if($data['array'][0][$record1][$data['condition_key'][0]]==$data['array'][$table2][$record2][$data['condition_key'][$table2]]){
										
									$temp_result=array_merge($temp_result, $data['array'][$table2][$record2]);
									$condition_counter++;
								}
							}
						}
						//check if all table join..
						//echo "<br/>init_model 65 ".$condition_counter.":".count($data['array']);
						
						if($condition_counter==count($data['array'])){
							$result[$counter]=$temp_result;
							$counter++;
						}
					}
					return $result;
				}else{
					//echo "<br/>init_model 70";
					return null;
				}
				/*select * from user_relatiion 
				inner join app_users_data 
				on user_relation.user_inhouse_id=app_users_data 
				where user_relation.user_inhouse_id='63'
				
				$r1=select * from user_relation where user_inhouse_id=63;
				select * from app_users_data  where user_inhouse_id ='...' or user_inhouse_id='...'
				*/
	}
	public function array_outer_join_in_same_key($data){
				//$result=array();
				$temp_result=array();
				$counter=0;
				//echo "<br/>init_model 43 ".count($data['array']);
				//print_r($data);
				if(count($data['array'])>=2){
					//$record1 is the loop counter of first array's record 
					//$table2 is the loop counter of second+ array
					//$record2 is the loop counter of second+ array's record
					//echo "<br/>init_model 49 ".count($data['array'][0]);
					//print_r($data['array'][0]);
					for($record1=0;$record1<count($data['array'][0]);$record1++){
						$temp_result=$data['array'][0][$record1];
						for($table2=1;$table2<count($data['array']);$table2++){
							//$condition_counter is the loop counter of condition key  
							//echo "<br/>init_model 56 ".$table2.":".count($data['array'][$table2]);
							for($record2=0;$record2<count($data['array'][$table2]);$record2++){
								//echo "<br/>init_model 57 ".$data['condition_key'][0].":".$data['array'][0][$record1][$data['condition_key'][0]].":".$data['condition_key'][$table2].":".$data['array'][$table2][$record2][$data['condition_key'][$table2]];
								if($data['array'][0][$record1][$data['condition_key'][0]]==$data['array'][$table2][$record2][$data['condition_key'][$table2]]){
									$temp_result=array_merge($temp_result, $data['array'][$table2][$record2]);
								}
							}
						}
						$result[$counter]=$temp_result;
						$counter++;
						//check if all table join..
						//echo "<br/>init_model 65 ".$condition_counter.":".count($data['array']);
						/*
						if($condition_counter==count($data['array'])){
							$result[$counter]=$temp_result;
							$counter++;
						}*/
					}
					return $result;
				}else{
					//echo "<br/>init_model 70";
					return null;
				}
	}
	public function loadProduction(){
		$this->loadLanguage();
		
	}
	public function loadDevelopment(){
		$this->loadLanguage();
		ini_set("upload_max_filesize", "200M");
		
	}
	public function loadLanguage(){
		//now the website domain will be en.XXX.com
		//or ch.XXX.com, this will affect the server load different language
		//for the localhost testing, add these in 
		// c:\windows\system32\drivers\etc\hosts.txt
		// 127.0.0.1 en.localhost
		// 127.0.0.1 ch.localhost
		global $config;
		$lang=preg_split('/[.]/', $_SERVER['HTTP_HOST']);
		$lang=$lang[0];
		//print_r($lang);
		if(strlen($lang)>2){
			$this->lang->load("test", $config['language']);
		}else{
			$this->lang->load("test", $lang);
		}
	}
	public function bll_get_header($is_logined=true, $profile_tabs_html=''){
			//load in every main controller
			$data=$this->login_model->bll_load_login_page();
			//echo "<br/> init model 57";
			//print_r($data);		
			$data['profile']=$this->profile_model->bll_index_page_header_profile();
			
			//$data['block_header'] = $this->load->view("header/block_header", $data, TRUE);
			$data['block_footer'] = $this->load->view("block_footer", $data, TRUE);
			$data['is_logined'] = $is_logined;
            //$data['community_submenu'] = $this->get_community_submenu_data();
            //these data is going to block_navigation_bar / block_navigation_not_logined
            
			if($is_logined)
				$data['block_navigation_bar'] = $this->load->view("header/block_navigation_bar", $data, TRUE);
			else		
				$data['block_navigation_bar'] = $this->load->view("header/block_navigation_not_logined.php", $data, TRUE);
			
			//these data is going to TPL main
			$data['profile_tabs_html'] = $profile_tabs_html;
			$data['block_header'] = $this->load->view("header/block_header", $data, TRUE);
			
			$data['nyro_width']=$this->config->item('nyro_width');
			$data['nyro_height']=$this->config->item('nyro_height');
        return $data;
	}
	public function is_login(){
		if($this->native_session->get("userinfo")!=null) return true; else return false;	
	}
	public function destroy_sensitive_session(){
		//this function destroy the sensitive session that cache the database result, 
		//will run every time in every controller
		/*$this->load->library("native_session");*/
		if(count($this->sensitive_session)>0)
		foreach($this->sensitive_session as $val){
			//echo "init_model 86 gc:";
			//echo $val;
			$this->native_session->delete($val);
		}
	}
	
	public function get_community_submenu_data()
	{
		$this -> db -> where('is_hidden', 0);
		$query = $this -> db -> get('app_data');
		$tmp = $query -> result_array();
		
		$data = NULL;
		foreach ($tmp as $key => $value){
		    $id = $value['app_id'];
		    $key = "app_id_".$id;
			$data[$key]['title'] = $value['product_name'];
			$data[$key]['url'] = site_url("community/app/{$id}");
		}
		
		return $data;
	}
}


