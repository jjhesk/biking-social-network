<?php
class HtmlHeader {
	


		public static function print_cms_header( $print_tab=true,$js=true) {


			?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html>
			<head>
			<style type="text/css">
			@import "<?php echo base_url(); ?>/css/admin_style.css";
			</style>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<META Http-Equiv="Cache-Control" Content="no-cache">
			<META Http-Equiv="Pragma" Content="no-cache">
			<META Http-Equiv="Expires" Content="0">
			<title>CMS </title>
			</head>

			<script type="text/javascript" src="<?php echo base_url()?>/js/general.js" ></script>
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" ></script>
			
			<?php
			if ($print_tab) {
				HtmlHeader::print_cms_menu();
				
			}
			if ($js) {
					HtmlHeader::print_musicnext_admin_js();
			}
		}
		
		public static function print_musicnext_admin_js () {
			?>

			<script>

			
				function update_published ( content_id ) {

					var option_arr = document.getElementsByName( content_id +"_published");
			        for (i=0; i<option_arr.length; i++) {
			            if (option_arr[i].checked==true) {
			            	check='1';
			            }
			            else	{
			            	check='0';
			            }
			        }
			      	 $('#'+ content_id +"_published").load("<?=site_url()?>/musicnext_ajax/update_publish?content_id="+content_id+"&publish="+check, function(){
				        	if (check=='1')
								color='transparent';
							else
								color='#dddddd';
							$('#'+content_id+"_tr").css("backgroundColor",color);
						});

				}

				function delete_item ( content_id ) {

						if (confirm("Are you sure want to delete this item ?")) {
					      	 $('#'+ content_id +"_published").load("<?=site_url()?>/musicnext_ajax/delete_item?content_id="+content_id, function(){
					      		$('#'+content_id+"_row").fadeOut(500, function() {	
					      			$('#'+content_id+"_row").html("");
					      			
								});
					      	});
						}
				}

				function update_winner ( content_id, winner_nos ) {
						 $('#'+ content_id +"_published").load("<?=site_url()?>/musicnext_ajax/update_winner?content_id="+content_id+"&winner_nos="+ winner_nos , function(){
							 if (winner_nos==-1) {
								 $('#'+content_id+"_row").fadeOut(500, function() {	
						      			$('#'+content_id+"_row").html("");		
									});
							 } else {
								alert("Contestant added to winner list");
							 }
						 });
					}

					function update_score( content_id, score ,e) {
						var char_code;
						
						//char_code=get_key_code(e);
						 var Ucode=e.keyCode? e.keyCode : e.charCode
						//alert(" key :" +content_id +" || "+ score+"||"+Ucode);
						if (Ucode==13) {
							 $('#'+ content_id +"_published").load("<?=site_url()?>/musicnext_ajax/update_score?content_id="+content_id+"&score="+ score , function(){
								 $('#'+content_id+"_field").fadeOut(500, function() {	
										  
									 		$('#'+content_id+"_field").fadeIn(500, function () {
									 			 $('#'+content_id+"_field").blur();
									 			//alert("test");
									 		});	
									});
							 });
						} 
	
					}

					function update_nos( content_id, nos ,e) {
						var char_code;

						//alert ("test");
						//char_code=get_key_code(e);
						 var Ucode=e.keyCode? e.keyCode : e.charCode
						//alert(" key :" +content_id +" || "+ nos+"||"+Ucode);
						if (Ucode==13) {
							 $('#'+ content_id +"_published").load("<?=site_url()?>/musicnext_ajax/update_winner?content_id="+content_id+"&winner_nos="+ nos , function(){
								 $('#'+content_id+"_field").fadeOut(500, function() {	
										  
									 		$('#'+content_id+"_field").fadeIn(500, function () {
									 			 $('#'+content_id+"_field").blur();
									 			//alert("test");
									 		});	
									});
							 });
						} 
	
					}
					
				
			</script>	
		
			<?php 
		}


		public static function print_cms_menu () {
			
			$campaign_id=$_SESSION["campaign_id"];
			$self_php_path=$_SERVER['PHP_SELF'];
			$path_arr=pathinfo($self_php_path);
			$self_php=$path_arr['basename'];
			$self_php=str_replace(".php", "",$self_php);
			
			$main_menu_arr=array("index"=>"Campaign","contestant"=>"Contestant","winner"=>"Winner");  //"order_record.php"=>"Order Record"

//			$map_url=$url_map[$self_php];

?>
			<table cellspacing="0" cellpadding="0" width="90%" align=center style="margin-bottom:5px;"><tr>
			<td><div style="float:right"></div>
			<br><Br>
			<center><h1>Music Next Campaign Content Management</h1></center></td></tr></table>
			 <Br></Br>
			<table cellspacing="0" cellpadding="0" width="680px" align=center >
			<tr><td width="5px" class="erp_tab" >&nbsp;</td>

			<?php

			foreach ($main_menu_arr as $url=>$menu_item) {
					
			//	echo "$base || $self_php || $temp <br>";

				if ($url!=$self_php) {
					if ($map_url!=$url)
						$class="erp_inactive_tab";
					else
						$class="erp_active_tab";
				} else {
						$class="erp_active_tab";
				}
					
				// $class=(strstr($url,$self_php))?"erp_active_tab":"erp_inactive_tab";
				echo "<td class='$class' >";
				$full_url=site_url('musicnext_admin/'.$url);
				
				if (($base!=$url && $campaign_id ) || $url=="index")
					echo "<a href='$full_url'>$menu_item</a>";
				else
					echo "<font color='grey'>$menu_item</font>";
				echo "</td >";
				echo '<td class="erp_tab" width="5px">&nbsp;</td>';

			}
			?></tr></table><?php
		}

	}