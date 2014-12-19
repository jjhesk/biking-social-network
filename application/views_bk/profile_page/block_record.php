<style>
	.block_record {
		font-family: 'dinlight';
	}
</style>

				<div class="block_record" style="position:relative;">
					<div class="index_block_shadow" style="float:left;" >
						<div class="index_block_a_header <?=$color?>">
						<p style="padding:8px;">
							<? echo $block_record_field[0]['title']?> Record<!--<a id="index_title" class="nyroModal"  href="<?=site_url()?>/profile_page/nyro_speed_record">...</a>--> </p>	
						</div>
						<div class="index_block_a_body <?=$color?> ">
							<div style="text-align: right; margin-top: 20px; float: left; width: 45%; height:48px; top:50%; ">
								Average<br><? echo $block_record_field[0]['title']?>
							</div>
							<div style="text-align: left; margin-top: 31px; margin-left: 10px; float: left; font-size:40px; " >
								<? echo $block_record_field[0]['value'];?>
							</div>
							<br>
							<div style="text-align: right; float: left; width: 200px"><? echo $block_record_field[0]['unit']?></div>
						</div>
					</div>
					
					<div class="index_block_shadow" style="float:left; position:relative; left:10px;">
						<div class="index_block_a_header <?=$color?>">
						<p style="padding:8px;">
							<? echo $block_record_field[1]['title']?> Record<!--<a id="index_title" class="nyroModal"  href="<?=site_url()?>/profile_page/nyro_speed_record">...</a>--> </p>	
						</div>
						<div class="index_block_a_body <?=$color?>">
							<div style="text-align: right; margin-top: 20px; float: left; width: 55%; height:48px; top:50%; ">
								Average<br><? echo $block_record_field[1]['title']?>
							</div>
							<div style="text-align: left; margin-top: 31px; margin-left: 10px; float: left; font-size:40px; " >
								<? echo $block_record_field[1]['value'];?>
							</div>
							<br>
							<div style="text-align: right; float: left; width: 200px"><? echo $block_record_field[1]['unit']?></div>
						</div>
					</div>
					
				</div>
											