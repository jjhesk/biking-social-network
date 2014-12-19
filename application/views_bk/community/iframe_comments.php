<style>
	<? $this -> load -> file('css/page.css.php'); ?>
</style>

<style>
	.profile_comments_border {
		font-family: 'dinlight';
	}
	
	/* DISCUSSION THREAD CLASSES */

	.like_dislike_button {
		float:left;
		margin-right:5px;
		height:25px;
		background-color:#FFF;
		border:solid 1px #CCC;
		-webkit-border-radius: .3em;
		-moz-border-radius: .3em;
		border-radius: .30em;
		color: #C1C1C1;
		cursor:pointer;
		font-family: 'dinlight';
	}
	
	.like_dislike_number {
		position:absolute;
		margin-top:5px;
		color: #C1C1C1;
		font-size:11px;
	}
	
	.like_number {
		left: 130px;
	}
	
	.dislike_number {
		left: 230px;
	}

	.like_button {
		background-image:url('<? echo base_url()?>images/comments_box/03-icon-like-00.png');
		background-repeat: no-repeat;
		background-position:10px 4px;
		width:80px;
	}
	
	.like_button:hover {
		background-image:url('<? echo base_url()?>images/comments_box/03-icon-like-02.png');
		background-repeat: no-repeat;
		background-position:10px 4px;
	}
	
	.dislike_button {
		background-image:url('<? echo base_url()?>images/comments_box/03-icon-dislike-00.png');
		background-repeat: no-repeat;
		background-position:10px 5px;
		width:95px;
	}
	
	.dislike_button:hover {
		background-image:url('<? echo base_url()?>images/comments_box/03-icon-dislike-02.png');
		background-repeat: no-repeat;
		background-position:10px 5px;
	}
	
	.reply_comment {
		float:left;
		width:500px;
		height:25px;
		resize: none;
		border:solid 1px #CCC;
		font-family: 'dinlight';
		color: #333;
		font-size:11.5px;
		padding: 3px;
		-webkit-border-radius: .3em;
		-moz-border-radius: .3em;
		border-radius: .30em;
	}
	
	.reply_button {
		float:left;
		margin-left:5px;
		height:25px;
		background-color:#BBB;
		border:solid 1px #CCC;
		-webkit-border-radius: .3em;
		-moz-border-radius: .3em;
		border-radius: .30em;
		color: #FFF;
		cursor:pointer;
		font-family: 'dinlight';
	}
	
	/* DISCUSSION COMMENTS CLASSES */
	
	.subcomments {
		float: left;
		margin-top: 10px;
		font-size: 12px;
		width: 700px;
	}


	.subcomments .subcomments_arrow, .subcomments .subcomments_arrow_with_delete {
		float:left;
		margin-top: 2px;
		width: 14;
		height: 14;
		background-image:url('<? echo base_url()?>images/comments_box/arrow-post.png');
		background-repeat: no-repeat;
		background-position:3px 0px;
		border:none;
		color:transparent;
		background-color: transparent;
	}
	
	.subcomments .subcomments_arrow_with_delete:hover {
		background-image:url('<? echo base_url()?>images/comments_box/03-icon-comment-delete-02.png');
		background-position:-2px -2px;
		
	}
	
	.subcomments .subcomments_displayname {
		float:left;
		margin-left: 5px;
		color: #00A4E7;
		font-weight: bold;
		letter-spacing: -1px;
	}
	
	.subcomments .subcomments_comment {
		float:left;
		margin-left: 5px;
	}
	
	.subcomments .subcomments_timestamp {
		float:left;
		margin-left: 5px;
		color: #C1C1C1;
	}
	
	/* OTHERS CLASSES */
	
	.profile_comments_border{
		border-width:1px; border-color:#FFFFFF;border-style:solid;
		
	}
	
	.comments_body_viewcomments .profilepic {
	    height: 40px;
	    width: 40px;
	    overflow: hidden;
	}
	.comments_body_viewcomments .profilepic img {
	    width: 40px;
	}
	
	.discussion_like_dislike_button {
		float:right;
		margin-top:6px;
		margin-right:5px;
		height:25px;
		width:40px;
		background-color:transparent;
		border:0px;
		color: #C1C1C1;
		cursor:pointer;
	}

	.discussion_like_dislike_number {
		float:right;
		margin-top:10px;
		color: #C1C1C1;
		font-size:12px;
	}
	
	.discussion_like_button {
		background-image:url('<? echo base_url()?>images/comments_box/03-icon-like-01.png');
		background-repeat: no-repeat;
		background-position:10px 4px;
	}
	
	.discussion_like_button:hover {
		background-image:url('<? echo base_url()?>images/comments_box/03-icon-like-02.png');
		background-repeat: no-repeat;
		background-position:10px 4px;
	}
	
	.discussion_dislike_button {
		background-image:url('<? echo base_url()?>images/comments_box/03-icon-dislike-01.png');
		background-repeat: no-repeat;
		background-position:10px 5px;
	}
	
	.discussion_dislike_button:hover {
		background-image:url('<? echo base_url()?>images/comments_box/03-icon-dislike-02.png');
		background-repeat: no-repeat;
		background-position:10px 5px;
	}
	
	.comments_delete_button {
		background-image:url('<? echo base_url()?>images/comments_box/03-icon-comment-delete-00.png');
		width: 14px;
		height: 14px;
		position: absolute;
		top:25px;
		left:800px;
		border:solid 0px;
		color:transparent;
		background-color: transparent;
	}
	.comments_delete_button:hover {
		background-image:url('<? echo base_url()?>images/comments_box/03-icon-comment-delete-02.png');
	}
	
</style>


<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

<div id="profile_comments" class="profile_comments_border">
	
	
	
	<?php
	
	if ($comment_user_id!=-1)
		echo form_open('community/form_submit');
	
	// Set hidden data
	$hidden_data = array(
		'discussion_id'  => $discussion_id,
		'comment_user_id' => $comment_user_id,);

	echo form_hidden($hidden_data);
	?>
	
	<div id="delete_data_class" style="display:null;"></div>
	
	<div class="community_comments_header community_top_radius" >
		<div style="padding:8px 0px 5px 15px; float:left; font-family:'dinlight';">
			You can add comments here.
		</div>
		
		
		<!--<div class="fb-like" data-href="http://www.fansliving.com" data-send="true" data-width="450" data-show-faces="true" style="float:right; margin-top:5px;"></div>
		-->
		
		<?
			$dislike_button_data = array(
				'id' => 'like_dislike',
				'name' => 'dislike',
				'value' => ' ',
				'class' => 'discussion_like_dislike_button discussion_dislike_button',
				'style' => '',
			);
			echo form_submit($dislike_button_data);
		?>
		
		<div class="discussion_like_dislike_number"><?=$likes_dislikes['num_of_dislikes']?></div>
		
		<?$like_button_data = array(
			'id' => 'like_dislike',
			'name' => 'like',
			'value' => ' ',
			'class' => 'discussion_like_dislike_button discussion_like_button',
			'style' => '',
			);
			echo form_submit($like_button_data);
		?>
		
		
		<div class="discussion_like_dislike_number"><?=$likes_dislikes['num_of_likes']?></div>
		
	</div>
	
	<div class="community_comments_body " >
		
		<? if ($comment_user_id!=-1) {?>
		
		<div style="width:1000px; height: 110px;" >
			
			<div class="comments_body_comments" style="float:left;" >
				<?
				$textarea_data = array(
						'name' => 'comment_text',
						'value' => '',
						'placeholder' => 'Compose your comments here',
						'rows' => 2,
						'style' => "box-shadow: 0 0 0 1px #CCCCCC;
									width:880px;
									height:64px;
									padding:5px;
									resize: none;
									border:0px;
									-webkit-border-radius: .3em;
									-moz-border-radius: .3em;
									border-radius: .30em;
									font-family: 'dinlight';
									font-size:14px;", );

				echo form_textarea($textarea_data);
			?>
			</div>
			<!--btn_post -->
			<?php	$submit_button_data = array(
						'name' => 'post',
						'value' => 'Post',
						'style' => 	'float:left;
									margin-right:10px;
									margin-top:40px;
									width:40px;
									height:25px;
									background-color:#636466;
									color:#FFFFFF;
									border:1px solid #66;
									-webkit-border-radius: .3em;
									-moz-border-radius: .3em;
									border-radius: .30em;
									position:relative; left:40px; ',
						'class' => 'post_button_press');

				echo form_submit($submit_button_data);
			?>

		</div>
		
		<?} else {?>
			<div style="text-align:center; font-family: 'dinlight'; font-size:14px; height: 35px; position: relative; top:10px;">Please sign up / log in to leave a comment.</div>
			
		<?}?>
		<div class="comments_body_viewcomments" >

			<?php
			
			$post_num = count($comments_array);
			for($i=0; $i<$post_num; $i++){	?>
			
			<div style="width:900px; padding:15px; position: relative; background-color:#FFF; -webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; 	box-shadow: 0 0 0 1px #CCCCCC;">
				<table>
					<tr>
						<td style="width:50px;text-align:top;vertical-align:top"><!--IMG -->
							<div class="profilepic" style="width:40px;height:40px;">
								<a target="_parent" href="<?=site_url()?>/profile/view/<?=$comments_array[$i]['user_inhouse_id']?>" class="ajax" style="text-decoration:none;">
									<img src="<?=$comments_array[$i]['profile_image']?>" border=0>
								</a>
							</div>
						</td>
						
						<td style="width:800px; "><!--content -->
							<div style="color:#00A4E7; margin-bottom:5px; font-size: 14px; font-weight: bold; letter-spacing: -1px;">
								<a target="_parent" href="<?=site_url()?>/profile/view/<?=$comments_array[$i]['user_inhouse_id']?>" class="ajax" style="text-decoration:none; color:#00A4E7;">
									<?=$comments_array[$i]['display_name']?>
								</a>
							</div>
							<div style="width: 650px; overflow-x:hidden; margin-bottom:5px; font-size: 14px;
							   	word-wrap: break-word;">
								<?=$comments_array[$i]['comment_text']?>
							</div>
							<div style="color:#C1C1C1;font-size:10px; font-size: 12px;">
								<?=$comments_array[$i]['last_updated']?>
							</div>
							
							<!----- LIKE, DISLIKE, REPLY BUTTONS -->
							
							<div style="margin-top:15px; ">
								
								<div class="like_dislike_number like_number"><?=$comments_array[$i]['num_likes']?></div>
								
								<?$like_button_data = array(
									'id' => 'like_dislike',
									'name' => $comments_array[$i]['news_type']. '_' .$comments_array[$i]['comment_id'],
									'value' => 'Like',
									'class' => 'like_dislike_button like_button',
									);
									
									if ($comments_array[$i]['self_like_dislike'] == 1) {
										$like_button_data['style'] = "background-image:url(".base_url()."images/comments_box/03-icon-like-01.png)";
									}
	
									echo form_submit($like_button_data);
								?>
								
								<div class="like_dislike_number dislike_number"><?=$comments_array[$i]['num_dislikes']?></div>
								
								<?$dislike_button_data = array(
									'id' => 'like_dislike',
									'name' => $comments_array[$i]['news_type']. '_' .$comments_array[$i]['comment_id'],
									'value' => 'Dislike',
									'class' => 'like_dislike_button dislike_button',
									);
									
									if ($comments_array[$i]['self_like_dislike'] == -1) {
										$dislike_button_data['style'] = "background-image:url(".base_url()."images/comments_box/03-icon-dislike-01.png)";
									}
							
									echo form_submit($dislike_button_data);
								?>
								
								<? if ($comment_user_id!=-1) {?>
								
									<!-- REPLY TEXT AREA -->
									
									<?$textarea_reply = array(
											'name' => 'reply_comment'.$comments_array[$i]['comment_id'],
											'value' => '',
											'placeholder' => 'Reply',
											'rows' => 2,
											'class' => 'reply_comment',);
									
									echo form_textarea($textarea_reply);?>
									
									
									<!-- REPLY BUTTON -->
									
									<?$reply_button_data = array(
											'name' => $comments_array[$i]['news_type']. '_' .$comments_array[$i]['comment_id'],
											'value' => 'Reply',
											'class' => 'reply_button');
						
										echo form_submit($reply_button_data);
									?>
								
								<?}?>
							</div>
							
							<!--Delete Button -->
					
							<?
								if($comments_array[$i]['comment_user_id'] == $comment_user_id){       
									$delete_button_data = array(
												'name' => 'DeleteDiscussionThread',
												'value' => $comments_array[$i]['comment_id'],
												'class' => 'comments_delete_button',
												'onclick' => "delete_comment_confirm('DeleteDiscussionThread', ".$comments_array[$i]['comment_id'].")"
										);
												
									//echo form_submit($delete_button_data);
									
									echo form_button($delete_button_data);
									
								}
								
							?>
							
							<!-- Tpm -->
							<!----- SUB COMMENTS -->
							
							<script type="text/javascript">
							function delete_comment_confirm(name, comment_id){
							    var reply = confirm("Are you sure to delete this comment?");
							    if (reply == true){
							    	//document.write(name);
							    	//document.forms[0].DeleteDiscussionComment.value = comment_id;
							    	
							    	document.getElementById("delete_data_class").innerHTML = "<input type='hidden' name='"+name+"' value='"+comment_id+"'>";
							    	
							    	document.forms[0].submit();
							       
							        //document.getElementById('myform').submit();
							    }
							}
							</script>
							
							
							<? if(isset($comments_array[$i]['subcomment_array']))
							
								for ($j=0; $j < count($comments_array[$i]['subcomment_array']); $j++) {?>
								
								<div class="subcomments">
									
									<?
							
									if($comments_array[$i]['subcomment_array'][$j]['comment_user_id'] == $comment_user_id){
										$delete_button_data = array(
												'name' => 'DeleteDiscussionComment',
												'value' => $comments_array[$i]['subcomment_array'][$j]['comment_id'],
												'class' => 'subcomments_arrow_with_delete',
												'onclick' => "delete_comment_confirm('DeleteDiscussionComment', ".$comments_array[$i]["subcomment_array"][$j]["comment_id"].")"
										);
										//echo anchor('delete/something', 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
										echo form_button($delete_button_data);
										
									} else {
										$delete_button_data = array(
												'name' => 'DeleteDiscussionComment',
												//'value' => $comments_array[$i]['subcomment_array'][$j]['comment_id'],
												'class' => 'subcomments_arrow',
										);
										echo form_button($delete_button_data);
									}
									
								//}
								
							?>
									
									<div class="subcomments_displayname">
										<a target="_parent" href="<?=site_url()?>/profile/view/<?=$comments_array[$i]['user_inhouse_id']?>" class="ajax" style="text-decoration:none; color:#00A4E7;">
											<? echo $comments_array[$i]['subcomment_array'][$j]['firstname'] . " " . $comments_array[$i]['subcomment_array'][$j]['lastname'] . ": "?>
										</a>
									</div>
									<div class="subcomments_comment">
										<?=$comments_array[$i]['subcomment_array'][$j]['comment_text']?>
									</div>
									<div class="subcomments_timestamp">
										<?=$comments_array[$i]['subcomment_array'][$j]['last_updated']?>
									</div>
								</div>
							<?}?>
							
						</td>
					</tr>
				</table>

			</div>
			
			
			<div class='comment_break'></div>
			<?}?>
			<!--
				if ($post_num != $i) {
					echo "<div class='comments_break'></div>";
				}
				}
			-->
		</div>

	</div>
	
	

</div>

<!--
<div style="position: fixed; 
    width:100px; height:1001px; top:0%; left:20%; background-color: red;">asdasda</div>
-->







