<?if ($activity_data['mode']!="manual") {?>
	
		
	<div class="index_block_shadow" style="position:relative; float:left;">
		<div class="index_block_b_header">
			<p style="padding:8px;">
				Record Analysis
				<a id="index_title" class="nyroModal nyro_icon"  href="<?=site_url()?>/profile_page/nyro_daily_record_analysis/<? echo $activity_id?>"></a> 
			</p>	
		</div>
		<div class="index_block_b_body">
			<iframe id="iframe_record_analysis"  src='<?=site_url()?>/profile_page/iframe_record_analysis?<?=$block_record_analysis_iframe_get_string?>&is_live=<?=(isset($is_live))?$is_live:"false"?>&<?=rand()?>' width="490"  frameborder='0' marginwidth="0" marginheight="0" scrolling="no"></iframe>
		</div>
	</div>
<?}?>