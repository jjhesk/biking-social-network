<style>
	.block_friends .user_link{
	}
	
	.block_friends .user_link:hover {
		color:#446572;
		text-shadow: 1px 1px 1px #4d4d4d;
	}
	
	.block_friends .profilepic {
	    border-radius: 6px 6px 6px 6px;
	    height: 55px;
	    width: 55px;
	    overflow: hidden;
	}
	.block_friends .profilepic img {
	    width: 53px;
	}
	
</style>

	<div class="block_friends" style="position:relative;">
		
		<div style="background-color:#DDDDDD; width:278px; height:35px;	color:#808080; border: 1px #FFFFFF solid">
			<div style="float:left; margin-top:8px; margin-left:15px">Friends</div>
			<div style="float:left; margin-top:8px; margin-left:8px; color:#00A5E7;">(<?=count($friends_data)?>)</div>
			<!--<p style="padding:8px"><a id="index_title" class="nyroModal nyro_icon" href="<?=site_url()?>/profile_page/nyro_all_friends/<?=$user_id?>"></a></p>-->
		</div>
		
		<? for($i=0;$i<count($friends_data);$i++) {?>
			
			<? if ($i>=3) {break;} ?>
		
			<div style="position:relative; width:278px; height:85px; background-color:#FFFFFF">
				
				<!--PHOTO-->
				<div class="profilepic" style="position:relative; top:10px;left:15px;">
					<a href="<?=site_url()?>/profile/view/<?=$friends_data[$i]['user_inhouse_id']?>" class="ajax" style="text-decoration:none;">
					<img src="<?=$friends_data[$i]['profile_image']?>" style="border:1px solid #808080"></a>
				</div>
				
				<!--NAME-->
				<div  style="position:absolute; left:83px; top:10px; ">
					<a href="<?=site_url()?>/profile/view/<?=$friends_data[$i]['user_inhouse_id']?>" class="ajax user_link" style="text-decoration:none; color:#00A5E7">
					<?=$friends_data[$i]['firstname']?> <?=$friends_data[$i]['lastname']?></a>
				</div>
				
				<!--COUNTRY-->
				<div style="position:absolute; left:83px; top:29px; font-size: 12px;"><?=$friends_data[$i]['country']?></div>
				
				<!--NUM OF DEVICES-->
				<div style="position:absolute; left:83px; top:47px; font-size: 12px;">
					<?=$friends_data[$i]['apps_installed']?> Devices
				</div>
				
				<!--BREAK IMAGE-->
				
				<? if ($i!=count($friends_data)-1) {?>
					<div style="position:absolute; float:left; margin-top:15px; width:278px; height:13px; background-repeat:repeat-n;
						background-image: url(<?php echo base_url();?>images/comments_box/03-border-zigzag.png) ;">
					</div>
				<?}?>
					
			</div>
		<?}?>
		
		<? if (count($friends_data)>3) {?>
			<div style="background-color:#DDDDDD; width:100%; height:20px;">
				<a id="index_title" class="cboxElement" onclick="colorbox_fix('<?php echo site_url(); ?>/profile_page/nyro_all_friends/<?php echo $user_id; ?>');"
					style="margin-right:5px; top:2px; color:#00A5E7; text-align: right; font-size: 11px; cursor:pointer;">See all friends...</a>
			</div>
		<?} ?>
		
	</div>