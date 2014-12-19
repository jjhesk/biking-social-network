<style>
<? $this->load->file('css/page.css.php'); ?>
</style>
<style>
		.post_button_press {
			background-color:#404040;
		}
		.post_button_press:hover {
			background-color:#262626;
		}
		.other_button_press {
			background-color:#FFFFFF;
		}
		.other_button_press:hover {
			background-color:#EEEEEE;
		}
	
</style>

				<div style="background-color: #C2C1C2; padding-bottom: 0px">
					
						<?php
						echo form_open('profile_page/form_submit');
						
						// Set hidden data
						$hidden_data = array(
              				'activity_id'  => $activity_id,
              				'comment_user_id' => $comment_user_id,);

						echo form_hidden($hidden_data);
						
						$i =  count($comments_array);
						
						if ($i==0) {
						
							$textarea_data = array(
		              			'name'			=> 'comment_text',
		              			'value'			=> '',
		              			'placeholder'	=> 'Compose your comments here',
		              			'rows'			=> 2,
		          			    'style'     	=> 'margin-left:15px; margin-top:8px; width:450px; height:195px; resize: none; border:0px;
		          			   						-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; ',);
							
							echo form_textarea($textarea_data);
							
						} else if ($i==1) {
							
							$textarea_data = array(
		              			'name'			=> 'comment_text',
		              			'value'			=> '',
		              			'placeholder'	=> 'Compose your comments here',
		              			'rows'			=> 2,
		          			    'style'     	=> 'margin-left:15px; margin-top:8px; width:450px; height:127px; resize: none; border:0px;
		          			   						-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; ',);
							
							echo form_textarea($textarea_data);?>
							
							<div style="margin-left:15px; margin-top:8px; width:450px; height:60px; background-color:#FFFFFF;
		          			   						-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; ">
		          				
		          				<!--PHOTO-->
		          				<div style="float:left; position:relative; margin-top:9px; margin-left:15px;">
									<img src="<?=$comments_array[0]['profile_image']?>" width="40" height="40" style="border:1px solid #C2C1C2"></a>
								</div>
								
								<!--NAME, COMMENT, DATE-->
								<div style="float:left; position:relative; margin-top:7px; margin-left:10px; width:350px; color:#00A5E7; font-weight: bold; font-size: 12px; letter-spacing: -1px">
									<?=$comments_array[0]['firstname']?> <?=$comments_array[0]['lastname']?>
								</div>
								<div style="float:left; position:relative; margin-top:1px; margin-left:10px; width:350px; font-size: 12px; ">
									<?=$comments_array[0]['comment_text']?>
								</div>
								<div style="float:left; position:relative; margin-top:2px; margin-left:10px; width:350px; font-size: 10px; color: #707070">
									<?=$comments_array[0]['last_updated']?>
									<?//=date("Y-m-d H:i:s", strtotime($comments_array[0]['last_updated']))?>
								</div>		          				
		          						          			
		          			</div>
		          			
		          			
		          		<?} else {
		          			
							$textarea_data = array(
		              			'name'			=> 'comment_text',
		              			'value'			=> '',
		              			'placeholder'	=> 'Compose your comments here',
		              			'rows'			=> 2,
		          			    'style'     	=> 'margin-left:15px; margin-top:8px; width:450px; height:67px; resize: none; border:0px;
		          			   						-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; ',);
							
							echo form_textarea($textarea_data);?>
							
							<div style="margin-left:15px; margin-top:8px; width:450px; height:120px; background-color:#FFFFFF;
		          			   						-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; ">
		          			
		          				<!--PHOTO-->
		          				<div style="float:left; position:relative; margin-top:7px; margin-left:15px;">
									<img src="<?=$comments_array[0]['profile_image']?>" width="40" height="40" style="border:1px solid #C2C1C2"></a>
								</div>
								
								<!--NAME, COMMENT, DATE-->
								<div style="float:left; position:relative; margin-top:5px; margin-left:10px; width:350px; color:#00A5E7; font-weight: bold; font-size: 12px; letter-spacing: -1px">
									<?=$comments_array[0]['firstname']?> <?=$comments_array[0]['lastname']?>
								</div>
								<div style="float:left; position:relative; margin-top:1px; margin-left:10px; width:350px; font-size: 12px; ">
									<?=$comments_array[0]['comment_text']?>
								</div>
								<div style="float:left; position:relative; margin-top:2px; margin-left:10px; width:350px; font-size: 10px; color: #707070">
									<?=$comments_array[0]['last_updated']?>
									<?//=date("Y-m-d H:i:s", strtotime($comments_array[0]['last_updated']))?>
								</div>
								
								<!--BREAK IMAGE-->
								<div style="position:relative; float:left; margin-top:5px; width:450px; height:13px; background-repeat:repeat-n;
										background-image: url(<?php echo base_url();?>images/comments_box/03-border-zigzag.png) ;">
								</div>
								
								<!--PHOTO-->
		          				<div style="float:left; position:relative; margin-top:2px; margin-left:15px;">
									<img src="<?=$comments_array[1]['profile_image']?>" width="40" height="40" style="border:1px solid #C2C1C2"></a>
								</div>
								
								<!--NAME, COMMENT, DATE-->
								<div style="float:left; position:relative; margin-left:10px; width:350px; color:#00A5E7; font-weight: bold; font-size: 12px; letter-spacing: -1px">
									<?=$comments_array[1]['firstname']?> <?=$comments_array[1]['lastname']?>
								</div>
								<div style="float:left; position:relative; margin-top:1px; margin-left:10px; width:350px; font-size: 12px; ">
									<?=$comments_array[1]['comment_text']?>
								</div>
								<div style="float:left; position:relative; margin-top:2px; margin-left:10px; width:350px; font-size: 10px; color: #707070">
									<?=$comments_array[1]['last_updated']?>
									<?//=date("Y-m-d H:i:s", strtotime($comments_array[0]['last_updated']))?>
								</div>
								
							</div>
							
		          		<?}?>
						
						<div style="height:35px; width:480;">
						<?
						
						// Buttons at the bottom
						
						$submit_button_data = array(
	              			'name'		=> 'post',
	              			'value'		=> 'Post',
	          			    'style'     => 'float:right; margin-right:15px; margin-top:10px; width:50px; height:25px; color:#FFFFFF; border:1px solid #404040;
	          			    				-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; ',
							'class'		=> 'post_button_press');
						
						echo form_submit($submit_button_data);
						
						/*
						$comments_button_data = array(
	              			'name'		=> 'comments',
	              			'value'		=> 'Comments',
	          			    'style'     => 'float:right; margin-right:15px; margin-top:10px; width:80px; height:25px; color:#999999; border:1px solid #FFFFFF;
	          			    				-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; ',
							'class'		=> 'other_button_press',);
						
						echo '<a id="index_title" class="nyroModal" href='. site_url().'/profile_page/nyro_activity_comments/'.$activity_id.'>';
						echo form_submit($comments_button_data);
						echo '</a>';
						 * 
						 */
						 
						$like_button_data = array(
	              			'name'		=> 'like',
	              			'value'		=> 'Like',
	          			    'style'     => 'float:left; margin-left:15px; margin-top:10px; width:80px; height:25px; color:#999999; border:1px solid #FFFFFF;
	          			    				-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; ',
							'class'		=> 'other_button_press');
						
						echo form_submit($like_button_data);
						
						$dislike_button_data = array(
	              			'name'		=> 'dislike',
	              			'value'		=> 'Dislike',
	          			    'style'     => 'float:left; margin-left:5px; margin-top:10px; width:80px; height:25px; color:#999999; border:1px solid #FFFFFF;
	          			    				-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; ',
							'class'		=> 'other_button_press');
						
						echo form_submit($dislike_button_data);
						
						$share_button_data = array(
	              			'name'		=> 'share',
	              			'value'		=> 'Share',
	          			    'style'     => 'float:left; margin-left:5px; margin-top:10px; width:80px; height:25px; color:#999999; border:1px solid #FFFFFF;
	          			    				-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; ',
							'class'		=> 'other_button_press');
						
						echo form_submit($share_button_data);
						?>
						</div>
				</div>