	<style>
	<? $this->load->file('css/page.css.php'); ?>
	</style>
	<style>

		#profile_comments{
			float:left; 
		}
		.comments_header{
			background-color:#C2C1C2; color:#FFFFFF;
			
		}
		
		a:link {text-decoration:none;}
		a:visited {text-decoration:none;}
		a:hover {text-decoration:none;}
		a:active {text-decoration:none;}
	</style>	
	
	
		
		<div class="index_block_shadow comments_header" style="position:relative; float:left; ">
			<div class="index_block_c_header comments_header" >
				<? /*
				<?= $activity_id ?>
				<?= $app_id ?>
				<?=$comment_count?>
			`	*/ ?>
				<iframe class="index_block_c_header comments_header" src="<?=site_url()?>/profile_page/iframe_activity_smiley/<? echo $activity_id?>" frameborder='0' marginwidth="0" marginheight="0" style="overflow-x: hidden; overflow-y: hidden;"></iframe>
			</div>
			
			<div style="width:480px; height:1px; position:relative; float:left; background-color:#FFF;">
				
			</div>
			
			<div class="index_block_c_body comments_header">
					
				<iframe class="index_block_c_body comments_header" src="<?=site_url()?>/profile_page/iframe_activity_comments/<? echo $activity_id?>/<? echo $app_id; ?>" frameborder='0' marginwidth="0" marginheight="0" style="overflow-x: hidden; overflow-y: hidden; height:234px;"></iframe>
			
				<div style="position:absolute; top:240px;left:20px;">
					<div class="addthis_toolbox addthis_default_style" addthis:url="<?=site_url()?>/profile/view_activity/<?=$user_id?>/<?=$app_id?>/<?=$activity_id?>" style="position:absolute; float:left; width:200px; margin-top:1px; margin-left:-5px;">
								<a class="addthis_button_preferred_1"></a>
								<a class="addthis_button_preferred_2"></a>
								<a class="addthis_button_preferred_3"></a>
								<a class="addthis_button_preferred_4"></a>
								<!--Deleted for request <a class="addthis_button_preferred_4"></a>-->
								<a class="addthis_button_compact"></a>
								<a class="addthis_counter addthis_bubble_style" target="_parent"></a>
					</div>
						<script type="text/javascript">var addthis_config = {"data_track_addressbar":false, "url":"http://fenix.it.imusictech.com/index.php"};</script>
						<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-507775013c08be56"></script>
					
					
				</div>
		
			</div>
			
			<? if ($comment_count>0) {?>
					<div style="position:absolute; top:267px; left:340px; background-color:#C2C1C2; color:#FFF; font-family:'dinlight'; cursor:pointer;">
						<!--<a class="cboxElement" style="text-decoration:none;" onclick="colorbox_fix('<?php echo site_url(); ?>/profile_page/nyro_activity_comments/<?php echo $activity_id ?>');">
						-->
						<a class="nyroModal" href="<?=site_url()?>/profile_page/nyro_activity_comments/<?php echo $activity_id ?>">
							See all comments
						</a>
					</div>
			<?}?>
		</div>
