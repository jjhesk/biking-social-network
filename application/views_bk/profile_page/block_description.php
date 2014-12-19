<style>
	.block_route {
		font-family: 'dinlight';
	}
</style>

	<div class="block_route index_block_shadow <?=$color?>" style="position:relative; float:left; height: 180px; ">
		<div class="index_block_b_header <?=$color?>"  style="border:0px; border-bottom: 1px solid #FFFFFF;">
		<p style="padding:8px; width: 460px; height: 20px; overflow:hidden;"><?php echo $activity_data['title']?><!--<a id="index_title" class="nyroModal" href="<?=site_url()?>/profile_page/nyro_routes">...</a>--> </p>	
		</div>
		<div class="index_block_b_body <?=$color?> ">
			<?php if( (isset($activity_data['total_distance']))&&($activity_data['total_distance']!='') ) { ?>	
				<div style="color: #F2F2F2; padding-left: 15px; padding-top: 10px; float: left; width: 250px">
					<?php echo $activity_data['description']?>
				</div>
				<!--<div style= "color: #F2F2F2; background-color: rgba(255, 255, 255, 0.2); float: left; width: 95px; height: 95px; border-radius: 100%; margin-left: 0px; margin-top: 5px; font-size:16px; text-align: center; "><p style="padding-top:28px;">Checkpoints <b><?php echo $suggested['checkpoints'];?></b></p></div>-->
				<div style= "color: #F2F2F2; background-color: rgba(255, 255, 255, 0.2); float: left; width: 95px; height: 95px; border-radius: 100%; margin-left: 0px; margin-top: 5px; font-size:16px; text-align: center; ">
					<p style="padding-top:25px;">Distance <br><?php echo $activity_data['total_distance'];?> km</p>
				</div>
			<?php }else{ ?>
				<div style="color: #F2F2F2; padding: 10px 10px; float: left; width: 460px;" class="<?=$color?>">
					<?php echo $activity_data['description']?>
				</div>
			<?php } ?> 
			
		</div>
	</div>