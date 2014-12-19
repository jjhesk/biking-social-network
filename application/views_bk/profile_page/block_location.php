<? if ($has_map) { ?>

<style>
	.block_map {
		font-family: 'dinlight';
	}
</style>

	<div class="block_map index_block_shadow" style="position:relative; float:left; ">
		<div class="index_block_c_header" >
			<p style="padding:8px">Location</p>
		</div>
		<div class="index_block_c_body" >
			<!-- test link: http://www.fansliving.com/index.php/profile_page/iframe_map/1 -->
			<iframe class="index_block_c_body" src="<?=site_url()?>/profile_page/iframe_map/<? echo $activity_id?>" frameborder='0' marginwidth="0" marginheight="0"></iframe>
			<!--<img src = <?php echo base_url(); ?>/images/fake_map/temp_map.png>-->
		</div>
	</div>
	
<?}?>