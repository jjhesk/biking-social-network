	<div style="float:left; width:480px; height:250px; background-color:#DDDDDD; color:#808080; border:1px #ABABAB solid;">
		<div style="float:left; margin-top:8px; margin-left:15px;">Recent Activities</div>
		
		<div class="index_round_corners" style="position:relative; background-color:#FFFFFF; margin-top:35px; margin-left:10px;  margin-bottom:10px; width:460px; height: 200px; overflow-y: auto">
			
			<? 
				//echo "<br/>block recent activities standard 8 ".count($recent_news);
				for($i=0;$i<count($recent_news);$i++) {
			?>
			<div style="position:relative; color:#313131; padding:5px 10px; ">
				<a style="color:#313131; text-decoration:none; font-size:14px;" href="<?=site_url()?>/profile/activity/<?=$recent_news[$i]['activity_id']?>" >
					<?=date( 'M j, g:ia ', strtotime($recent_news[$i]['last_updated']))?> : <?=$recent_news[$i]['news_text']?>
				</a>
			</div>
			<? } ?>
			
		</div>
	</div>