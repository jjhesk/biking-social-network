<style>
	<? $this -> load -> file('css/page.css.php'); ?>
</style>
<style>

		.block_comments {
			font-family: dinlight;
			float: left;
			background-color: #FFFFFF;
			width:750px;
			height: 400px;
			margin-right:30px;
		}

		.block_comments .profilepic {
		    height: 40px;
		    width: 40px;
		    overflow: hidden;
		}
		.block_comments .profilepic img {
		    width: 40px;
		}
		.block_comments .comments_delete_button {
			background-image:url('<? echo base_url()?>images/comments_box/03-icon-comment-delete-00.png');
			float:left;
			position:relative; 
			color:transparent;
			background-color:transparent;
			margin-top:6px; 
			margin-left:180px; 
			border:none;
			width:14px;
			height:14px;
		}
		.block_comments .comments_delete_button:hover {
			background-image:url('<? echo base_url()?>images/comments_box/03-icon-comment-delete-02.png');
			
		}
		
		.comments_like_button {
			position:relative;
			float:right;
			background-image:url('<? echo base_url()?>images/comments_box/03-icon-like-00.png');
			background-repeat: no-repeat;
			background-position:10px 4px;
			top:2px;
			right:30px;
			width:20px;
			height:20px;
			cursor:pointer;
		}
		
		.comments_dislike_button {
			position:relative;
			float:right;
			background-image:url('<? echo base_url()?>images/comments_box/03-icon-dislike-00.png');
			background-repeat: no-repeat;
			background-position:10px 4px;
			top:2px;
			right:30px;
			width:20px;
			height:20px;
			cursor:pointer;
		}
		
		.comments_like_label {
			position:relative;
			float:right;
			top:2px;
			right:20px;
			width:30px;
			height:20px;
			color: #999;
			font-size: 11px;
		}

		.comments_dislike_label {
			position:relative;
			float:right;
			top:2px;
			right:20px;
			width:30px;
			height:20px;
			color: #999;
			font-size: 11px;
		}
		
		
		
	
</style>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.js"></script>

<script>
	$(document).ready(function(){
		
		$(".comments_like_button").click(function(){
			
			value_string = $(this).attr("value");
			value_array = value_string.split(" ");
			
			comment_id = value_array[0];
			self_like_dislike = value_array[1];
			original_like_count = value_array[2];
			original_dislike_count = value_array[3];
			
			if (self_like_dislike==1) {
				original_like_count = original_like_count -1;
			} else if (self_like_dislike==-1) {
				original_dislike_count = original_dislike_count -1;
			}
						
			new_like_count=parseInt($("#like"+comment_id).html());
			new_dislike_count=parseInt($("#dislike"+comment_id).html());
			
			if (new_like_count > original_like_count) {
				new_like_count--;
			} else if (new_dislike_count > original_dislike_count) {
				new_dislike_count--;
				new_like_count++;
				$("#dislike"+comment_id).html(new_dislike_count);
			} else {
				new_like_count++;
			}
			
			$("#like"+comment_id).html(new_like_count);
			
			// Call add one function
			$.get("<?=site_url()?>/profile_page/feedback_count/activity_comment/"+comment_id+"/<?=$comment_user_id?>/1", function(event){
			});
			
		});
		
		$(".comments_dislike_button").click(function(){
			
			value_string = $(this).attr("value");
			value_array = value_string.split(" ");
			
			comment_id = value_array[0];
			self_like_dislike = value_array[1];
			original_like_count = value_array[2];
			original_dislike_count = value_array[3];
			
			if (self_like_dislike==1) {
				original_like_count = original_like_count -1;
			} else if (self_like_dislike==-1) {
				original_dislike_count = original_dislike_count -1;
			}
			
			new_like_count=parseInt($("#like"+comment_id).html());
			new_dislike_count=parseInt($("#dislike"+comment_id).html());
			
			if (new_dislike_count > original_dislike_count) {
				new_dislike_count--;
			} else if (new_like_count > original_like_count) {
				new_like_count--;
				new_dislike_count++;
				$("#like"+comment_id).html(new_like_count);
			} else {
				new_dislike_count++;
			}
			
			$("#dislike"+comment_id).html(new_dislike_count);
			
			// Call minus one function
			$.get("<?=site_url()?>/profile_page/feedback_count/activity_comment/"+comment_id+"/<?=$comment_user_id?>/-1", function(event){
			});
			
		});
	});
</script>

<form action="<?=site_url()?>/profile/view/nyro_activity_comments">
<div class="block_comments">

	<div style="background-color:#FFFFFF; 
	-webkit-border-radius: .3em; -moz-border-radius: .3em; border-radius: .30em; ">

		<?php

		for ($i=0; $i < count($comments_array); $i++) { ?>

		<!--PHOTO-->
		<div class="profilepic" style="float:left; position:relative; margin-top:7px; margin-left:15px; width:55px;">
			<a target="_top" href="<?=site_url()?>/profile/view/<?=$comments_array[$i]['user_inhouse_id']?>" class="ajax" style="text-decoration:none;">
				<img src="<?=$comments_array[$i]['profile_image'] ?>" style="border:1px solid #C2C1C2"></a>
			</a>
		</div>

			
		<!--NAME-->
		<div style="float:left; position:relative; margin-top:5px; margin-left:10px; width:60%; color:#00A5E7; font-weight: bold; font-size: 12px; letter-spacing: -1px">
			<a target="_top" href="<?=site_url()?>/profile/view/<?=$comments_array[$i]['user_inhouse_id']?>" class="ajax" style="text-decoration:none; color:#00A5E7">
				<?=$comments_array[$i]['firstname'] ?> <?=$comments_array[$i]['lastname'] ?>
			</a>
		</div>
		
		<!--Delete button-->
		<?
			//if($comments_array[$i]['comment_user_id'] == $comment_user_id){
				$delete_button_data = array(
						'name' => 'DeleteComment',
						'value' => $comments_array[$i]['comment_id'],
						'class' => 'comments_delete_button',
				);
				
				//echo $comments_array[$i]['comment_id'];
				echo form_submit($delete_button_data);
			//}
			
		?>
		
		<!-- COMMENT, DATE-->
		<div style="float:left; position:relative; margin-top:1px; margin-left:10px; width:80%; font-size: 12px; ">
			<?=$comments_array[$i]['comment_text'] ?>
		</div>
		<div style="float:left; position:relative; margin-top:2px; margin-left:10px; width:100px; font-size: 10px; color: #707070">
			<?=$comments_array[$i]['last_updated'] ?>
		</div>
		
		<!--LIKE DISLIKE BUTTON-->
		<div class="comments_dislike_label" id=<? echo "dislike".$comments_array[$i]['comment_id']?>><?=$comments_array[$i]['dislike_count']?></div>
		<div class="comments_dislike_button" value="<?=$comments_array[$i]['comment_id']?> <?=$comments_array[$i]['self_like_dislike']?> <?=$comments_array[$i]['like_count']?> <?=$comments_array[$i]['dislike_count']?>"></div>
		<div class="comments_like_label" id=<? echo "like".$comments_array[$i]['comment_id']?>><?=$comments_array[$i]['like_count']?></div>
		<div class="comments_like_button" value="<?=$comments_array[$i]['comment_id']?> <?=$comments_array[$i]['self_like_dislike']?> <?=$comments_array[$i]['like_count']?> <?=$comments_array[$i]['dislike_count']?>"></div>
		
		<!--BREAK IMAGE-->
		<div style="position:relative; float:left; margin-top:5px; width:98%; height:13px; background-repeat:repeat-n;
		background-image: url(<?php echo base_url(); ?>images/comments_box/03-border-zigzag.png) ;"></div>

		<?} ?>
	</div>
</div>
</form>