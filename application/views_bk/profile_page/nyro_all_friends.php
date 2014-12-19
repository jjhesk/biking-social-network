<style>
<? $this->load->file('css/page.css.php'); ?>
</style>
<style>
	.user_link{
	}
	
	.user_link:hover {
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

		<? for($i=0;$i<count($friends_data);$i++) {?>
				
			<? if ($i % 3 ==0) { echo "<div>"; }?>
				<div class="block_friends" style="position:relative; float:left; height:85px; background-color:#FFFFFF;
					<? if ($i % 3 ==2) { echo "width:300px;"; }
					else { echo "width:250px;";}?>
				">
					
					<!--PHOTO-->
					<div class="profilepic" style="position:relative; top:10px;left:15px;">
						<a href="<?=site_url()?>/profile/view/<?=$friends_data[$i]['user_inhouse_id']?>" class="ajax" style="text-decoration:none;">
						<img src="<?=$friends_data[$i]['profile_image']?>" style="border:1px solid #808080"></a>
					</div>
					
					<!--NAME-->
					<div  style="position:absolute; left:83px; top:10px; ">
						<a target="_top" " href="<?=site_url()?>/profile/view/<?=$friends_data[$i]['user_inhouse_id']?>" class="ajax user_link load_on_profile_tab" style="text-decoration:none; font-weight:bold; color:#00A5E7">
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
			<? if ($i % 3 ==2) { echo "</div>"; }?>
		<?}?>