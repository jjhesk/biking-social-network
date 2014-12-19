<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hesk_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		
		//judy test
	
	}
	function animation_content_frames($list) {
		$o='';
		foreach ($list as $time => $list2) {
			$o .= $time . ' { ';
			//foreach ($list2 as $nothing => $str) {}
			$o .= $list2;
			$o .= ' } ';
		}
		return $o;
	}
	function csshelper_opactiy($n) {
		$o='';
		$float_n = $n / 100;
		$o .= 'opacity: ' . $float_n . '; ';
		/* standard: ff gt 1.5, opera, safari */
		$o .= '-ms-filter: "alpha(opacity=' . $n . ')"; ';
		/* ie 8 */
		$o .= '-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=' . $n . ')"; ';
		/* ie 8 */
		$o .= 'opacity: ' . $float_n . '; ';
		$o .= 'filter: alpha(opacity=' . $n . '); ';
		/* ie lt 7 */
		$o .= '-moz-opacity:' . $float_n . '; ';
		/* ff lt 1.5, netscape */
		$o .= '-khtml-opacity:' . $float_n . '; ';
		/* safari 1.x */
		return $o;
	}
	// function
	function css_transition($sec, $prop){
		$o='';
		if($sec=="")return;
		if($prop=="")$prop='all';
/*		$o='transition:'.$prop'.' 2s, height 2s, transform 2s;
-moz-transition: $prop 2s, height 2s, -moz-transform 2s;
-webkit-transition: $prop 2s, height 2s, -webkit-transform 2s;
-o-transition: $prop 2s, height 2s,-o-transform 2s;
	*/	
		
		
	}
	//calling method:
	//config setting for the action
	//php: $fadein = array('0%' => "left:300px; " . csshelper_opactiy(0), '100%' => "left:400px; " . csshelper_opactiy(100));
	//generate keyframe and motion css
	//echo css_keyframes("slidemove", $fadein);
	//$data['keyframe']=$this->init_model->css_keyframes(XXX);
	//$data['css_animation_init']=$this->init_model->css_animation_init(XXX);
	
	
	//generate the css 
	//css_animation_init("slidemove",1.2); 
	function css_keyframes($obj, $list_content) {
		$o='';
		$content = $this->animation_content_frames($list_content);
		$o .= '@keyframes ' . $obj . ' { ' . $content . ' } ';
		$o .= '@-ms-keyframes ' . $obj . ' { ' . $content . '  } ';
		$o .= '@-webkit-keyframes ' . $obj . '{ ' . $content . '  } ';
		$o .= '@-o-keyframes ' . $obj . ' {  ' . $content . ' } ';
		$o .= '@-moz-keyframes ' . $obj . ' {  ' . $content . ' } ';
		return $o;
	}
	function css_animation_init($tag,$time,$inf=FALSE){
		$o='';
		$in='';
		$t = $time.'s';
		if($inf)$in='infinite';
		$o.='animation: '.$tag.' '.$t.' '.$in.';';
		$o.='-webkit-animation: '.$tag.' '.$t.' '.$in.';';
		$o.='-moz-animation: '.$tag.' '.$t.' '.$in.';';
		$o.='-o-animation: '.$tag.' '.$t.' '.$in.';';
		//$o.='-webkit-animation: slidemove 1.2s ;
		return $o;
	}
}