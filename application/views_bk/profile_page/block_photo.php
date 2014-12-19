<? 	if(isset($images))
	if (count($images)>0) { ?>
	
	<div class="index_block_shadow" style="position:relative; float:left; " >
		<div class="index_block_c_header">
			<p style="padding:8px">Photos<!--<a id="index_title" class="nyroModal nyro_icon" href="<?=site_url()?>/profile_page/nyro_recent_activities_map/<? echo $activity_id?>"></a>--></p>
		</div>
		<div style="margin-top:1px; border:1px solid #000; line-height:0px;">
			<a onclick="colorbox_i('<?=site_url()?>/profile_page/nyro_photo_content_activity/<?=$activity_id?>')">
				<img style="width:478px;" src="<?=$images[0]['full_url'];?>">
			</a>
		</div>
	</div>

<? }?>