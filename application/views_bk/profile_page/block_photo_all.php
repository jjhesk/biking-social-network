
<style>
	#block_photo{
		width: 676px;  border:1px #ABABAB solid; position:relative; float:left;
	}
	#block_photo>.big{
		float:left; height: 290px; width: 485px; overflow: hidden; box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.8); position:relative; z-index: 2;
	}
	#block_photo>.small2{
		float:left;height: 145px; width: 191px; overflow: hidden; position:relative; z-index: 2; 
	}
	#block_photo>.small3{
		float:left;height: 97px; width: 191px; overflow: hidden; position:relative; z-index: 2; 
	}
	#block_photo>div>div{
		cursor:pointer;
	}
	#block_photo .small2 img{
		height: 145px;
	}
	#block_photo .small3 img{
		width: 191px;
	}
	#block_photo .big img{
		width: 485px;
	}
	#block_photo .nothing{position:relative; float:left; height:290px; width:676px; background-color:#EDEDED;}
	#block_photo .nothing>div{position:relative; margin-top:100px;}
</style>

<div id="block_photo" class="common_shadow">
	
	<? if($is_permission_denied || count($profile_images)==0) { ?>
				
			<div class="nothing">
				<div align="center">
					<img src="<?=base_url() ?>/images/icon/02-icon-nophoto.png">
				</div>
			</div>
	
	<?} else if (count($profile_images)==1) {?>
		
			<div style="float:left; height: 290px; width: 676px; overflow: hidden;">
				<div onclick="colorbox_i('<?=site_url() ?>/profile_page/nyro_photo_content/<?=$user_id ?>');"><img  src="<?=$profile_images[0]['full_url']; ?>"/></div>
			</div>
			
	<?} else if (count($profile_images)==2) {?>
			
			<?for($i=0; $i<2; $i++) {?>
				<div style="float:left; height: 290px; width: 338px; overflow: hidden;">
					<div onclick="colorbox_i('<?=site_url() ?>/profile_page/nyro_photo_content/<?=$user_id ?>');"><img  height="290px" src="<?=$profile_images[$i]['full_url']; ?>"/></div>
				</div>
			<?}?>
			
	<?} else if (count($profile_images)==3) {?>
		
			<div class="big">
				<div onclick="colorbox_i('<?=site_url() ?>/profile_page/nyro_photo_content/<?=$user_id ?>');"><img  src="<?=$profile_images[0]['full_url']; ?>"/></div>
			</div>
			<?for($i=1; $i<=2; $i++) {?>
				
				<div class="small2">
						<div onclick="colorbox_i('<?=site_url() ?>/profile_page/nyro_photo_content/<?=$user_id ?>');"><img  src="<?=$profile_images[$i]['full_url']; ?>"/></div>
				</div>
			
			<?}?>
			
	<?} else {?>
		
			<div class="big">
				<div onclick="colorbox_i('<?=site_url() ?>/profile_page/nyro_photo_content/<?=$user_id ?>');"><img  src="<?=$profile_images[0]['full_url']; ?>"/></div>
			</div>
			
			<?for($i=1; $i<=3; $i++) {?>
				
				<div class="small3">
						<div onclick="colorbox_i('<?=site_url() ?>/profile_page/nyro_photo_content/<?=$user_id ?>');"><img  src="<?=$profile_images[$i]['full_url']; ?>"/></div>
				</div>
			
			<?}?>
			
	<? } ?>
</div>
