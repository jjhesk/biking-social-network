<?php

class googlemaps_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->library('googlemaps');
		$this->load->model("activity_model");
	}
	
	function get_kml($activity_id) {
		$this -> db -> select('activity_id, kml_path, kml_checkpoints');
		$query = $this -> db -> get_where('activity_data', array('activity_id' => $activity_id));
		$data = $query -> result_array();
		return $data[0];
	}
	
	function get_activity_photos($activity_id) {
		$this -> db -> select('photo_id, activity_id, thumb_url, full_url');
		$query = $this -> db -> get_where('activity_photo', array('activity_id' => $activity_id));
		$data = $query -> result_array();
		return $data;
	}
		
	function get_activity_data($activity_id) {
		$this -> db -> select('coordinates_json, activity_id');
		$query = $this -> db -> get_where('activity_data', array('activity_id' => $activity_id));
		$data = $query -> result_array();
		if(count($data)>0){
			return $data[0];
		}else{
			return null;
		}
	}
	
	function get_activity_checkpoint($checkpoint_id) {
		$this -> db -> select('checkpoint_id, activity_id, name, description, coordinate_x, coordinate_y');
		$query = $this -> db -> get_where('activity_checkpoint', array('checkpoint_id' => $checkpoint_id));
		$data = $query -> result_array();
		return $data;
	}
	
	public function get_location_by_latitude_longitude_from_google($coordinates){
		//BLL, overload function for Googleget_location_by_latitude_longitude_from_google
		echo "<br/> googlemaps model 45";
		print_r($coordinates);
		if ($coordinates!=null) {
				$x = $coordinates[0]['coordinate_x'];
				$y = $coordinates[0]['coordinate_y'];
				//echo "<br/> googlemaps model 44 ";
				$location = $this->Googleget_location_by_latitude_longitude_from_google($x,$y);
				//$description = $this->get_location_by_latitude_longitude_from_google($x, $y, 'description');
				return $location;
		}else{
			echo "<br/> googlemaps model 49 no location found ";
			return null;
		} 
	}
	public function bll_get_location($coordinates_json, $type){
		//echo "<br/> googlemaps 59 ".$coordinates_json;
		$coordinates_json=json_decode($coordinates_json, true);
		if(isset($coordinates_json['coordinate_x'])){
			$coordinates_json=array($coordinates_json);
		}
		if( (isset($coordinates_json[0]['coordinate_x']))&&(isset($coordinates_json[0]['coordinate_y'])) ){
			$x=$coordinates_json[0]['coordinate_x'];
			$y=$coordinates_json[0]['coordinate_y'];
			$location=$this->Googleget_location_by_latitude_longitude_from_google($x, $y, $type);
			if($location!=null){
				return "in ".$location;
			}else{
				return null;
			}
		}else{
			return null;
		}	
	}
	function Googleget_location_by_latitude_longitude_from_google($x, $y, $type="short"){
		//DAL
		//echo "<br/>googlemaps model 57 ";
		//echo "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$x.",".$y."&sensor=false";
   		$results=json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=".$y.",".$x."&sensor=false"), true);
   		//echo "<br/>googlemaps model 57 ";
   		//print_r($results);
   		if($results['status']!='ZERO_RESULTS'){
   			if($type=="long"){
	      		return $results['results'][0]['formatted_address'];
			}else if($type=="short"){
		 		return $results['results'][0]['address_components'][1]['long_name'];
			}
   		}else{
      		return null;
   		}
	}
	
	function kml_create_helper($obj) {
		
		if(!is_array($obj))return;
		
		$checkpoint_images_values = array("0", "32", "64", "96", "128", "160", "192", "224");
		$x_val = 0;
		$y_val = 0;
		
		$dom = new DOMDocument('1.0', 'UTF-8');
		$node = $dom -> createElementNS('http://earth.google.com/kml/2.1', 'kml');
		$parNode = $dom -> appendChild($node);
		$fnode = $dom -> createElement('Document');
		$mainNode = $parNode -> appendChild($fnode);
		foreach ($obj as $key => $value) {

			if ($key == "placemark_path") {
				$node = $dom -> createElement('Placemark');
				
				$placeNode = $mainNode -> appendChild($node);
				$placeNode -> setAttribute('id', $value['id']);
				
				if (array_key_exists('name', $value)) {
					$nameNode = $dom -> createElement('name', $value['name']);
					$placeNode -> appendChild($nameNode);
				}
					
				if (array_key_exists('desc', $value)) {
					$descNode = $dom -> createElement('description', $value['desc']);
					$placeNode -> appendChild($descNode);
				}

				if (array_key_exists('styleUrl', $value)) {
					$styleNode = $dom -> createElement('styleUrl', "#".$value['styleUrl']);
					$placeNode -> appendChild($styleNode);
				}
				
				//Create a LineString element
				$lineNode = $dom -> createElement('LineString');
				$placeNode -> appendChild($lineNode);
				
					$exnode = $dom -> createElement('extrude', '1');
					$lineNode -> appendChild($exnode);
				
					$almodenode = $dom -> createElement('altitudeMode', 'relativeToGround');
					$lineNode -> appendChild($almodenode);
				
					$coorNode = $dom -> createElement('coordinates', $value['coordinates']);
					$lineNode -> appendChild($coorNode);
			}

			// CHECKPOINT TABLE NOT USED ANYMORE 2013-1-11 (NING)
			
			if ($key == "placemark_point") {
					
				foreach ($value as $key => $value) {
					
					$node = $dom -> createElement('Placemark');
					
					if (array_key_exists('checkpoint_id', $value)) {
						$placeNode = $mainNode -> appendChild($node);
						$placeNode -> setAttribute('id', $value['checkpoint_id']);
						
							// Define style for checkpoints
							$styleNode = $dom -> createElement('Style');
							$placeNode -> appendChild($styleNode);
	
							$iconStyleNode = $dom -> createElement('IconStyle');
							$styleNode -> appendChild($iconStyleNode);
						
							$iconNode = $dom -> createElement('Icon');
							$iconStyleNode -> appendChild($iconNode);
							
							$hrefNode = $dom -> createElement('href', 'root://icons/palette-5.png');
							$iconNode -> appendChild($hrefNode);
							
							$xNode = $dom -> createElement('x', $checkpoint_images_values[$x_val]);
							$iconNode -> appendChild($xNode);
							
							$yNode = $dom -> createElement('y', $checkpoint_images_values[$y_val]);
							$iconNode -> appendChild($yNode);
							
							$wNode = $dom -> createElement('w', '32');
							$iconNode -> appendChild($wNode);
							
							$hNode = $dom -> createElement('h', '32');
							$iconNode -> appendChild($hNode);
							
							
							// Increment
							$x_val++;
							if ($x_val == 8) {
								$x_val = 0;
								$y_value += 2;
							}
						
					} else {
						$placeNode = $mainNode -> appendChild($node);
						$placeNode -> setAttribute('id', $value['id']);
					}
					
					if (array_key_exists('name', $value)) {
						$nameNode = $dom -> createElement('name', $value['name']);
						$placeNode -> appendChild($nameNode);
					}
					
					if (array_key_exists('description', $value)) {
						$descNode = $dom -> createElement('description', $value['description']);
						$placeNode -> appendChild($descNode);
					}

					if (array_key_exists('styleUrl', $value)) {
						$styleNode = $dom -> createElement('styleUrl', "#".$value['styleUrl']);
						$placeNode -> appendChild($styleNode);
					}
					
					// Create a Point element
					$pointNode = $dom -> createElement('Point');
					$placeNode -> appendChild($pointNode);
					
						$coorNode = $dom -> createElement('coordinates', $value['coordinate_x'] . ',' . $value['coordinate_y']);
						$pointNode -> appendChild($coorNode);
						
				}
			}
			 
			
		}
		$kmlOutput = $dom -> saveXML();
		//echo "<br/>googlemaps_model 222 ";
		//echo $kmlOutput;
		return $kmlOutput;
	}

	function get_data($maptype, $activity_id) {
		$data = array();
		$data['activity_data'] = $this -> get_activity_data($activity_id);
		
		// CHECKPOINT TABLE NOT USED ANYMORE 2013-1-11 (NING)
		// $data['activity_checkpoint'] = $this -> get_activity_checkpoint($activity_id);
		
		$data['activity_photo'] = $this -> get_activity_photos($activity_id);

		//Create a coordinates element and give it the value of the lng and lat columns from the results
		$dummy = "";
		if( (isset($data['activity_data']['coordinates_json']))&&($data['activity_data']['coordinates_json']!=null) ){
			$json_array = json_decode($data['activity_data']['coordinates_json'], true);
			
			$start[0] = $json_array[0]['coordinate_x'];
			$start[1] = $json_array[0]['coordinate_y'];
			$end[0] = $json_array[count($json_array)-1]['coordinate_x'];
			$end[1] = $json_array[count($json_array)-1]['coordinate_y'];
			
			foreach ($json_array as $key => $arr) {
				$_x_ = $arr['coordinate_x'];
				$_y_ = $arr['coordinate_y'];
				$_z_ = '0';
				$dummy .= $_x_ . ',' . $_y_ . ',' . $_z_ . ' ';
			}
	
			if ($maptype == 'small') {
				
				$kmldata = array(
				
					"placemark_path" => array(
						"id" => "path",
						"coordinates" => $dummy, ),
						
					"placemark_point" => array(
						array(
							"id" => "starting_point",
							"coordinate_x" => $start[0],
							"coordinate_y" => $start[1], ),
						array(
							"id" => "ending_point",
							"coordinate_x" => $end[0],
							"coordinate_y" => $end[1], ), ),
				);
			
			
			} else {
				
				$kmldata = array(
	
					"placemark_path" => array(
						"id" => "path",
						"coordinates" => $dummy, ),
						
					//"placemark_point" => $data['activity_checkpoint'],
				);
			}
			
			return $this -> kml_create_helper($kmldata);
		}
		return null;
	}

	function check_activity_has_map($activity_id) {
		
		$activity_data = $this -> get_activity_data($activity_id);
		$json_array = json_decode($activity_data['coordinates_json'], true);
		//echo "<br/>googlemaps_model 267";
		//print_r($json_array);
		if(isset($json_array['coordinate_x'])){
			$json_array=array($json_array);
		}
		if(isset($json_array[0]['coordinate_x'])){
			if ($json_array[0]['coordinate_x']!=0) {
				return true;
			} 
		}
		return false;
		
	}

	public function update_path_kml($activity_id) {
		$content = $this->get_data('small', $activity_id);
		if($content!=null){
			$this->db->set('kml_path', $content);
			$this->db->where('activity_id', $activity_id);
			$this->db->update('activity_data'); 
		}
	}
	
	public function update_checkpoint_kml($activity_id) {
		$content = $this->get_data('large', $activity_id);
		if($content!=null){
			$this->db->set('kml_checkpoints', $content);
			$this->db->where('activity_id', $activity_id);
			$this->db->update('activity_data'); 
		}
	}
	
	public function isValidURL($url) {
		$file_headers = @get_headers($url);
		if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
		    return false;
		}
		else {
		    return true;
		}
	}
	
	function create_checkpoint_html($checkpoint_id) {
		$data['photos'] = $this -> get_activity_photos($checkpoint_id);
		
		$html = '<b>$[name]</b><br><br>$[description]<br><br>';
		foreach ($data['photos'] as $value)
		{
			if ($this->isValidURL($value['thumb_url'])) {
				$html = $html.'<img src="';
    			$html = $html.$value['thumb_url'];
				$html = $html.'" width=100>';
			}
		}
		//$html = htmlentities($html);
		
		echo "<![CDATA[{$html}]]>";
		
		return "<![CDATA[{$html}]]>";

	}
		
	public function get_recent_map_small($activity_id) {
		
		$config = array(
			'center'=>'auto',
			//'center'=>'22.21283,113.84377',
			'minifyJS'=>TRUE,
			'map_width'=>'478px',
			'map_height'=>'253px',
			'zoom'=>'18',
			'disableStreetViewControl' => TRUE,
			'disableMapTypeControl' => TRUE,
			'kmlLayerURL'=>site_url().'/utility/generate_kml/small/'.$activity_id,
			//'kmlLayerURL'=>"http://apps.imusictech.com/test.kml",
		);
		/*$config['center'] = '37.4419, -122.1419';
		$config['zoom'] = 'auto';
		$config['map_width'] = '478px';
		$config['map_height'] = '253px';*/
		
		
		$this->googlemaps->initialize($config);
		return $this->googlemaps->create_map();
	}
	
	public function get_recent_map_large($activity_id) {
		
		$config = array(
			'center'=>'auto',
			'minifyJS'=>TRUE,
			'zoom'=>'13',
			'map_height'=>'580px',
			'map_width'=>'780px',
			'disableStreetViewControl' => TRUE,
			'kmlLayerURL'=>site_url().'/utility/generate_kml/small/'.$activity_id,
		);
			
		$this->googlemaps->initialize($config);
		return $this->googlemaps->create_map();
	}
	

}
?>