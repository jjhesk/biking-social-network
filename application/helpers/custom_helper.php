<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_menu_ressembled')) :
    /**
     * DEVELOPED BY HESKEMO 2012 - THIS SOFTWARE IS TO AIM FOR MAKING A MENU
     * width is array
     * height is a integer
     * 
     * @param       id
     * @param       URL: src file
     * @param       print_out_li_elements: default true
     * @param       vertical
     * @return      css + list HTML5 structure
     * @category    helper
     * @link        www.hkmdev.wordpress.com
     * @author      Heskemo
     */
    function get_menu_ressembled($width_list, $height, $id, $url, $print_out_li_elements = true, $vertical = false) {
        $w = 0;
        $total = count($width_list);
        if (!is_array($width_list)) {
            return false;
        }
        $p = 0;
        $display_position = 0;
        $html_content = '<style>';
        for ($i = 0; $i < $total; $i++) {
            if (is_array($width_list)) {
                $location = $i - 1;
                if ($location >= 0) {
                    $p += intval($width_list[$location]);
                    $display_position = $p;
                }
            } else {
                $display_position = $w * $i;
            }
            $on_element = "." . $id . ">li:nth-child(" . intval($i + 1) . ")";
            $html_content .= $on_element . "{width:" . $width_list[$i] . "px;background-position: -" . $display_position . "px 0; }";
            $html_content .= $on_element . ":hover{background-position: -" . $display_position . "px -" . $height . "px; }";
            $html_content .= $on_element . ":active{background-position: -" . $display_position . "px -";
            $html_content .= 2 * $height . "px;}" . $on_element . ".active," . $on_element . ".active,";
            $html_content .= $on_element . ".current_page_item," . $on_element . ".current_main_bar{background-position: -" . $display_position . "px -";
            $html_content .= 3 * $height . "px;}";
            //$html_content .=$height*2."px;}".$id.$i.".active,#".$id.$i.".active,#";
            //$html_content .=$id.$i.".current_page_item{background-position: -".$i*$w."px -".$height*2."px;}";
        }
        if ($vertical) {
            $extra = 'clear:both';
        } else {
            $extra = 'float:left';
        }
        $html_content .= '.' . $id . '>li{margin: 0;padding: 0;height:' . $height . 'px;background-image:url(' . $url . ');font-size:0;list-style:none;' . $extra . ';}';
        $html_content .= '.' . $id . ' a{margin: 0;font-size:0px; padding:0;display:block;height:' . $height . 'px;width:100%;}';
        $html_content .= '.' . $id . '{position:absolute;top:100px;left:10px;z-index:10;}';
        $html_content .= '</style>';
        if ($print_out_li_elements) {
            $html_content .= "<ul id='list_" . $id . "' class='" . $id . "'>";
            for ($i = 0; $i < $total; $i++) {
                $html_content .= '<li><a></a></li>';
            }
            $html_content .= "</ul>";
        }
        return $html_content;
    }

endif;
/**
 * Customized Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Element
 *
 * Lets you determine whether an array index is set and whether it has a value.
 * If the element is empty it returns FALSE (or whatever you specify as the default value.)
 *
 * @access	public
 * @param	array
 * @param	include_table_tag
 * @param	extraTD			replace [row] or [row_first_value]
 * @param	formSubmit submit as form with key and action, input action script
 * @return	string 	HTML tables
 */	

if ( ! function_exists('create_table_html'))
{
	function create_table_html($array, $listing_url='', $sorting_url='', $sort_desc='', $show_checkbox=false)
	{
		if(empty($array))
		{
			return '<p>No result found.</p>';
		}
		
		$text='';
		$text.=<<<_HTML_
		<script type="text/javascript">
		function check_all(checkallbox) 
		{
			var elements = document.getElementsByName ("selected_users[]");
			for (var i=0; i < elements.length; i++) 
				elements[i].checked = checkallbox.checked;
		}
		</script>
_HTML_;
		
		$text.='<table border="1">';
		$first_time=true;      //1st element doesn't necessary is [0]
		$first_cell=true;
		foreach( $array as $rowkey => $row )
		{
			if($first_time)    
			{
				$first_time=false;
				if ($show_checkbox)
					$text.= '<tr><td><input type=checkbox onclick="check_all(this)"><br>check / <br>uncheck all</td>';
				else
					$text.= '<tr>';

				foreach($row as $key => $value) 
				{
					if ($sorting_url)
					{
						if ($sort_desc != $key)
							$text.= "<th><b><a href='{$sorting_url}sort_order/asc/sort_by/{$key}'>{$key}</a></b></th>";
						else
							$text.= "<th><b><a href='{$sorting_url}sort_order/desc/sort_by/{$key}'>{$key}</a></b></th>";
					}
					else
						$text.= "<th><b>{$key}</b></th>";
				}

				$text.='</tr>';
			}

			

			if ($show_checkbox)
			{
				$first_value = reset($row);
				$text.= "<tr><td><input type='checkbox' name='selected_users[]' value='{$first_value}' /></td>";
			}
			else
				$text.= "<tr>";

			foreach($row as $key => $value)	
			{
				if ($first_cell)
				{
					$first_cell=false;
					if ($listing_url != '')
						$cell = "<td><a href='{$listing_url}{$value}'>{$value}</a></td>";
					else
						$cell = "<td>{$value}</td>";					

				} else
					$cell = "<td>{$value}</td>";

				$text.= $cell;
			}

			$text.= '</tr>'; 
			$first_cell=true;
		}

		$text.='</table>';
		return $text;
	}
}
//				$text.='<td>'.str_replace('[row_first_value]', reset($row), str_replace("[row]", $rowkey, $extraTD)).'</td>';

		
if ( ! function_exists('create_row_html'))
{
	function create_row_html($array_row)
	{
		$array[0] = $array_row;
		return create_table_html($array);
	}
}

if ( ! function_exists('create_button')) // need png
{
	function create_button($caption, $link)
	{
		return "<a href='{$link}'><table border='0' cellpadding='0' cellspacing='0' height='28px'><tr>
		<td height='28px'><img src='/images/icons/button_l.png' border='0'/></td>
		<td height='28px' background='/images/icons/button_m.png'><span style='text-decoration:none;  color:#000000;' >&nbsp;{$caption}&nbsp;</span></td>
		<td height='28px'><img src='/images/icons/button_r.png' border='0'/></td></tr></table></a>";
	}
}

if ( ! function_exists('create_submit_button')) // need png
{
	function create_submit_button($caption, $form)
	{
		return "<a href='javascript: {$form}.submit()' ><table border='0' cellpadding='0' cellspacing='0' height='28px' ><tr>
		<td height='28px'><img src='/images/icons/button_l.png' border='0'/></td>
		<td height='28px' background='/images/icons/button_m.png'><span style='font-style: italic; text-decoration:none;  color:#000000;' >&nbsp;{$caption}&nbsp;</span></td>
		<td height='28px'><img src='/images/icons/button_r.png' border='0'/></td></tr></table></a>";
	}
}

if(!function_exists('create_drop_shadow_box'))
{
	//need css in tpl_bonheur.php
	function create_drop_shadow_box($content)
	{
	return '
	<div id="shadow-container">
		<div class="shadow1">
			<div class="shadow2">
				<div class="shadow3">
					<div class="container">'.$content.'
					</div>
				</div>
			</div>
		</div>
	</div>
	';
	}
}

if ( ! function_exists('create_table_excel'))
{
	function create_table_excel($array)
	{
		$text='';
		
		$first_time=true;      //1st element doesn't necessary is [0]
		$first_cell=true;
		foreach( $array as $rowkey => $row )
		{
			if($first_time)    
			{
				$first_time=false;
				
				foreach($row as $key => $value) 
						$text.= "{$key}\t";

				$text.="\n";
			}

			foreach($row as $key => $value)	
				$text.= "{$value}\t";

			$text.= "\n"; 
		}
		return $text;
	}
}

function debug($array)
{
	
		echo '<pre>lalal';
		print_r($array);
		echo '</pre>';
		
}

	function _killFacebookCookies()
	{
		// get your api key
		$apiKey = $this->getConfig()->getApiKey();
		// get name of the cookie
		$cookie = $this->getConfig()->getCookieName();

		$cookies = array('user', 'session_key', 'expires', 'ss');
		foreach ($cookies as $name) 
		{
			setcookie($apiKey . '_' . $name, false, time() - 3600);
			unset($_COOKIE[$apiKey . '_' . $name]);
		}

		setcookie($apiKey, false, time() - 3600);
		unset($_COOKIE[$apiKey]);       
	} // */

	
	
/*
if ( ! function_exists('create_table_html'))
{
	function create_table_html($array, $incTableTag=true, $extraTD='', $formSubmit='')
	{
		$text='';
		if($incTableTag) $text.='<table border="1">';
		$firstTime=true;      //1st element doesn't necessary is [0]
		foreach( $array as $rowkey => $row )
		{
				if($formSubmit!='')	$text.= "<form action='{$formSubmit}' method='POST'>";                    
				if($firstTime)    
				{
						$firstTime=false;
						$text.= '<tr>';
						foreach($row as $key => $value) 
						{
							$text.= "<th><b>{$key}</b></th>";
						}
						if($extraTD!='')	$text.='<td></td>';
						$text.='</tr>';
	
					}
				$text.= '<tr>';
				foreach($row as $key => $value) 
				{            
					if($formSubmit!='') 
						$text.="<td><input type='text' name='{$key}' id='{$key}' value='{$value}'/></td>";
					else 
						$text.="<td>{$value}</td>";                                   
				}
	
				if($formSubmit!='')         
				{
					$mykey = key($row);
					$reset = reset($row);
					$text.="<td><input type='hidden' name='{$mykey}' value='{$reset}'/><input type='submit' name='edit_row' id='edit_row' value='save row change' /></td>";
				}
				
				if($extraTD!='')
				{
					$text.='<td>'.str_replace('[row_first_value]', reset($row), str_replace("[row]", $rowkey, $extraTD)).'</td>';
				}
				
				$text.= '</tr>'; 
				if($formSubmit!='') $text.= '</form>';
	   }
	   
	   if($formSubmit!='')	//create last add row
	   {
			$text.="<form action={$formSubmit} method='POST'><tr>";
			foreach($row as $key => $value){
				$text.="<td><input type='text' name='{$key}' id='{$key}'></td>";
			}
			if($extraTD!='')	$text.='<td></td>';
			$text.="<td><input type='submit' name='add_row' id='add_row' value='add row' /></td>";
			$text.='</tr></form>';
	   }
	   
	   if($incTableTag)  $text.='</table>';
	   return $text;
	}
}
// */

// ------------------------------------------------------------------------

function remove_http($url = '')
{
return(str_replace(array('http://','https://'), '', $url));
}


/**
 * get youtube video ID from URL
 *
 * @param string $url
 * @return string Youtube video id or FALSE if none found. 
 */
if(!function_exists('youtube_id_from_url'))
{

	function youtube_id_from_url($url) {
	    $pattern = 
	        '%^# Match any youtube URL
	        (?:https?://)?  # Optional scheme. Either http or https
	        (?:www\.)?      # Optional www subdomain
	        (?:             # Group host alternatives
	          youtu\.be/    # Either youtu.be,
	        | youtube\.com  # or youtube.com
	          (?:           # Group path alternatives
	            /embed/     # Either /embed/
	          | /v/         # or /v/
	          | /watch\?v=  # or /watch\?v=
	          )             # End path alternatives.
	        )               # End host alternatives.
	        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
	        $%x'
	        ;
	    $result = preg_match($pattern, $url, $matches);
	    if (false !== $result) {
	        return $matches[1];
	    }
	    return false;
	}
}

function parse_signed_request($signed_request, $secret) {
  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

  // decode the data
  $sig = base64_url_decode($encoded_sig);
  $data = json_decode(base64_url_decode($payload), true);

  if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
    error_log('Unknown algorithm. Expected HMAC-SHA256');
    return null;
  }

  // check sig
  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  if ($sig !== $expected_sig) {
    error_log('Bad Signed JSON signature!');
    return null;
  }

  return $data;
}

function base64_url_decode($input) {
  return base64_decode(strtr($input, '-_', '+/'));
}

/* End of file custom_helper.php */
/* Location: ./system/helpers/custom_helper.php */