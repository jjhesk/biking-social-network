<style>
<? $this->load->file('css/page.css.php'); ?>
</style>


		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.js"></script>

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
		
		.like_button {
			<? if ($self_like_dislike == 1) {?>
				background-image:url('<? echo base_url()?>images/comments_box/03-icon-like-01.png');
			<?} else {?>
				background-image:url('<? echo base_url()?>images/comments_box/03-icon-like-00.png');
			<?}?>
			background-repeat: no-repeat;
			background-position:10px 4px;
		}
		
		.like_button:hover {
			background-image:url('<? echo base_url()?>images/comments_box/03-icon-like-02.png');
			background-repeat: no-repeat;
			background-position:10px 4px;
		}
		
		.dislike_button {
			<? if ($self_like_dislike == -1) {?>
				background-image:url('<? echo base_url()?>images/comments_box/03-icon-dislike-01.png');
			<?} else {?>
				background-image:url('<? echo base_url()?>images/comments_box/03-icon-dislike-00.png');
			<?}?>
			background-repeat: no-repeat;
			background-position:10px 5px;
		}
		
		.dislike_button:hover {
			background-image:url('<? echo base_url()?>images/comments_box/03-icon-dislike-02.png');
			background-repeat: no-repeat;
			background-position:10px 5px;
		}
		
		.block_comments {
			font-family: dinlight;
			height:234px;
			overflow-x: hidden;
			overflow-y: hidden;
		}

		.block_comments .profilepic {
		    height: 40px;
		    width: 40px;
		    overflow: hidden;
		}
		.block_comments .profilepic img {
		    width: 40px;
		}
		
		
		.block_comments .textarea_all {
			margin-left:15px;
			margin-top:8px;
			width:450px;
			resize: none;
			border:0px;
		    -webkit-border-radius: .3em;
		    -moz-border-radius: .3em;
		    border-radius: .30em;
		    font-family: 'dinlight';
		    font-size:14px;
		}
		
		.block_comments .textarea_1 {
			height:185px;
		}
		
		.block_comments .textarea_2 {
			height:93px;
		}
		
		.block_comments .textarea_3 {
			height:57px;
		}
		
		.block_comments .comment_display_all {
			margin-left:15px;
			margin-top:8px;
			width:450px;
			background-color:#FFF;
		    -webkit-border-radius: .3em;
		    -moz-border-radius: .3em;
		    border-radius: .30em; 
		}
		
		.block_comments .comment_display_1 {
			height:55px;
		}
		
		.block_comments .comment_display_2 {
			height:120px;
		}
		
		.comments_like_button {
			position:absolute;
			background-image:url('<? echo base_url()?>images/comments_box/03-icon-like-00.png');
			background-repeat: no-repeat;
			background-position:10px 4px;
			top:200px;
			left:340px;
			width:20px;
			height:20px;
			cursor:pointer;
		}
		
		.comments_dislike_button {
			position:absolute;
			background-image:url('<? echo base_url()?>images/comments_box/03-icon-dislike-00.png');
			background-repeat: no-repeat;
			background-position:10px 4px;
			top:201px;
			left:390px;
			width:20px;
			height:20px;
			cursor:pointer;
		}
		
		.comments_like_label {
			position:absolute;
			top:205px;
			left:370px;
			width:30px;
			height:20px;
			color: #999;
			font-size: 12px;
		}

		.comments_dislike_label {
			position:absolute;
			top:205px;
			left:420px;
			width:30px;
			height:20px;
			color: #999;
			font-size: 12px;
		}
</style>


<script>

	$(document).ready(function(){
		
		<?php if (isset($comments_array[0])) {
			if ($comments_array[0]['self_like_dislike']==1) {
				echo 'var original_like_count = parseInt($(".comments_like_label").html()) -1;';
				echo 'var original_dislike_count = parseInt($(".comments_dislike_label").html());';
			} else if ($comments_array[0]['self_like_dislike']==-1) {
				echo 'var original_like_count = parseInt($(".comments_like_label").html());';
				echo 'var original_dislike_count = parseInt($(".comments_dislike_label").html()) -1;';
			} else {
				echo 'var original_like_count = parseInt($(".comments_like_label").html());';
				echo 'var original_dislike_count = parseInt($(".comments_dislike_label").html());';
			}
		} else {
				echo 'var original_like_count = 0;';
				echo 'var original_dislike_count = 0;';
		}?>
		
		$(".comments_like_button").click(function(){
						
			new_like_count=parseInt($(".comments_like_label").html());
			new_dislike_count=parseInt($(".comments_dislike_label").html());
			
			if (new_like_count > original_like_count) {
				new_like_count--;
			} else if (new_dislike_count > original_dislike_count) {
				new_dislike_count--;
				new_like_count++;
				$(".comments_dislike_label").html(new_dislike_count);
			} else {
				new_like_count++;
			}
			
			$(".comments_like_label").html(new_like_count);
			
			// Call add one function
			id=$(this).attr("val");
			<? if(isset($comments_array[0])){ ?>
				$.get("<?=site_url()?>/profile_page/feedback_count/activity_comment/<?=$comments_array[0]['comment_id']?>/<?=$comment_user_id?>/1", function(event){
				
				});
			<? } ?>
			
		});
		
		$(".comments_dislike_button").click(function(){
			
			new_like_count=parseInt($(".comments_like_label").html());
			new_dislike_count=parseInt($(".comments_dislike_label").html());
			
			if (new_dislike_count > original_dislike_count) {
				new_dislike_count--;
			} else if (new_like_count > original_like_count) {
				new_like_count--;
				new_dislike_count++;
				$(".comments_like_label").html(new_like_count);
			} else {
				new_dislike_count++;
			}
			
			$(".comments_dislike_label").html(new_dislike_count);
			
			// Call add one function
			<? if(isset($comments_array[0])){ ?>
			$.get("<?=site_url()?>/profile_page/feedback_count/activity_comment/<?=$comments_array[0]['comment_id']?>/<?=$comment_user_id?>/-1", function(event){
			});
			<? } ?>
			
		});
	});
</script>

			<div class="block_comments" style="background-color: #C2C1C2; padding-bottom: 0px">
						<? 
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
		              			'placeholder'	=> 'Compose your comments here',
		          			    'class'     	=> 'textarea_all textarea_1',);
							
							echo form_textarea($textarea_data);
							
						} else {
							
							$textarea_data = array(
		              			'name'			=> 'comment_text',
		              			'placeholder'	=> 'Compose your comments here',
		          			    'class'     	=> 'textarea_all textarea_2',);
							
							echo form_textarea($textarea_data);
						
						}?>
							
		          			
		          		<?/*} else {
		          			
							$textarea_data = array(
		              			'name'			=> 'comment_text',
		              			'placeholder'	=> 'Compose your comments here',
		          			    'class'     	=> 'textarea_all textarea_3',);
							
							echo form_textarea($textarea_data);?>
							
							
							
		          		}*/?>
		          		
		          		
		          		
		          		<!----------------------------->
						<!--------- START BUTTONS------>
		          		<!----------------------------->
		          		
		          		<div style="height:35px; width:480;">
								<!-- Buttons at the bottom -->
							<?
							//print_r($activity_id);
							//print_r($comments_array);
							?>
								<!-- AddThis Button BEGIN -->
								
								
								<?/*
								<div class="addthis_toolbox addthis_default_style" addthis:url="<?=site_url()?>/profile/view_activity/<?=$comment_user_id?>/<?=$app_id?>/<?=$activity_id?>" style="position:absolute; float:left; width:200px; margin-top:15px; margin-left:20px;">
								<a class="addthis_button_preferred_1"></a>
								<a class="addthis_button_preferred_2"></a>
								<a class="addthis_button_preferred_3"></a>
								<!--Deleted for request <a class="addthis_button_preferred_4"></a>-->
								<a class="addthis_button_compact"></a>
								<a class="addthis_counter addthis_bubble_style" target="_parent"></a>
								</div>
								*/?>
								
								
								
								
								
								
								<script type="text/javascript">var addthis_config = {"data_track_addressbar":false, "url":"http://fenix.it.imusictech.com/index.php"};</script>
								<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-507775013c08be56"></script>
								<!-- AddThis Button END -->
								
								<? if($comment_user_id!=null){
										$submit_button_data = array(
					              			'name'		=> 'post',
					              			'value'		=> 'Post',
					              			'style'     => 'float:right; margin-right:15px; margin-top:10px; width:100px; height:25px; color:#FFFFFF; border:1px solid #404040;
					          			    				-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; ',
											'class'		=> 'post_button_press');
										
										echo form_submit($submit_button_data);
										$dislike_button_data = array(
					              			'name'		=> 'dislike',
					              			'value'		=> 'Dislike ('.$num_likes_dislikes['num_of_dislikes'].')',
					          			    'style'     => 'float:right; margin-right:10px; margin-top:10px; width:95px; height:25px; color:#999999; border:1px solid #FFFFFF;
					          			    				-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; text-align:right;',
											'class'		=> 'other_button_press dislike_button');
										
										echo form_submit($dislike_button_data);
										
										
										$like_button_data = array(
					              			'name'		=> 'like',
					              			'value'		=> 'Like ('.$num_likes_dislikes['num_of_likes'].')',
					          			    'style'     => 'float:right; margin-right:10px; margin-top:10px; width:80px; height:25px; color:#999999; border:1px solid #FFFFFF;
					          			    				-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; text-align:right;',
											'class'		=> 'other_button_press like_button');
										
										echo form_submit($like_button_data);
								} ?>						
		
								<!--
								if (count($comments_array)>2) {
								
								<a target="_parent" class="nyroModal cboxElement" onClick="colorbox_fix('<?=site_url()?>/profile_page/nyro_activity_comments/<? echo $activity_id?>')">
								
								$all_comments_button_data = array(
			              			'name'		=> 'comments',
			              			'content'	=> 'See all comments',
			          			    'style'     => 'float:left; margin-left:5px; margin-top:10px; width:120px; height:25px; color:#00A5E7; border:1px solid #FFFFFF;
			          			    				-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; ',
									'class'		=> 'other_button_press ',
									//'target'	=> "_parent",
									//'onClick'	=> "window.open('".site_url()."/profile_page/nyro_activity_comments/".$activity_id."')",
									);
									
								
								echo form_button($all_comments_button_data);
								-->
						</div>
						
						<!----------------------------->
						<!--------- END --------------->
		          		<!----------------------------->
		          		
		          		
		          		<?if ($i>=1) {?>
		          			
		          			<div class='comment_display_all' style="height: 85px">
		          				
		          				<div style="float:left; position:relative; margin-top:6px; margin-left:15px; width:390px; font-size: 12px; color: #666; font-weight: bold; letter-spacing: -1px;">
									Most recent comment:
								</div>
		          				
		          				<!--PHOTO-->
		          				<div class="profilepic" style="float:left; position:relative; margin-top:6px; margin-left:15px;">
		          					<a target="_parent" href="<?=site_url()?>/profile/view/<?=$comments_array[0]['user_inhouse_id']?>" class="ajax" style="text-decoration:none;">
										<img src="<?=$comments_array[0]['profile_image']?>" style="border:1px solid #C2C1C2"></a>
									</a>
								</div>
								
								<!--NAME, COMMENT, DATE-->
								<div style="float:left; position:relative; margin-top:7px; margin-left:10px; width:350px; color:#00A5E7; font-weight: bold; font-size: 12px; letter-spacing: -1px">
									<a target="_parent" href="<?=site_url()?>/profile/view/<?=$comments_array[0]['user_inhouse_id']?>" class="ajax" style="text-decoration:none; color:#00A5E7">
										<?=$comments_array[0]['firstname']?> <?=$comments_array[0]['lastname']?>
									</a>
								</div>
								<div style="float:left; position:relative; margin-top:1px; margin-left:10px; width:350px; font-size: 12px; ">
									<?=$comments_array[0]['comment_text']?>
								</div>
								<div style="float:left; position:relative; margin-top:2px; margin-left:10px; width:350px; font-size: 10px; color: #707070">
									<?=$comments_array[0]['last_updated']?>
									<?//=date("Y-m-d H:i:s", strtotime($comments_array[0]['last_updated']))?>
								</div>
								
								<!--LIKE-->
								<div class="comments_like_button"></div>
								<div class="comments_like_label"><?=$comments_array[0]['like_count']?></div>
								<div class="comments_dislike_button"></div>
		          				<div class="comments_dislike_label"><?=$comments_array[0]['dislike_count']?></div>
		          			</div>
		          		
		          		<?}?>
		          		
		          		<?/*if ($i==1) {?>
		          			
							<div class='comment_display_all comment_display_1'>
		          				
		          				<!--PHOTO-->
		          				<div class="profilepic" style="float:left; position:relative; margin-top:9px; margin-left:15px;">
									<img src="<?=$comments_array[0]['profile_image']?>" style="border:1px solid #C2C1C2"></a>
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
		          		
		          		
		          		<?} else if ($i>1) {?>
		          			
		          			<div class='comment_display_all comment_display_2'>
		          			
		          				<!--PHOTO-->
		          				<div class="profilepic" style="float:left; position:relative; margin-top:7px; margin-left:15px;">
									<img src="<?=$comments_array[0]['profile_image']?>" style="border:1px solid #C2C1C2"></a>
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
		          				<div class="profilepic" style="float:left; position:relative; margin-top:2px; margin-left:15px;">
									<img src="<?=$comments_array[1]['profile_image']?>" style="border:1px solid #C2C1C2"></a>
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
							
						<?}*/?>
						
				</div>