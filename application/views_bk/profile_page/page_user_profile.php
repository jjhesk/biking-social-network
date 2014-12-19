<script>
	/*function load_tab_color(){
		document.getElementById('user_profile').style.backgroundColor = '#cccccc';
	}*/
</script>
<div id="main_left" style="width:980px; float:left;">
	<div id="content_left" >
		<div  style="float:left; width:676px; margin-top:10px;">
			<?php echo $block_image;?>
		</div>
		<div style="float:left; width:280px; margin-left:10px;" id="porfile">
			<div class='personal_info' >
				<?php echo $block_personal_profile;?>
			</div>
		</div>
	</div>
	<div style="float:left; position:relative; width:970px; height:10px;"></div>
	
	<? if (!$is_permission_denied) {?>
		<div style="width: 970px">
			<div id="left_column" style="float:left; position:relative; width:676px;">
				<?php echo $block_recent_activities;?>
			</div>
			<div style="float:left; position:relative; width:10px; height:100px;"></div>
			<div id="right_column" style="float:left; position:relative; width:280px; border:1px #ABABAB solid;">
				<?php echo $block_friends;?>					
			</div>
		</div>
	<?}?>
</div>