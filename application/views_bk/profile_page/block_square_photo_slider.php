<div id="square_photo_area" style="width:970px; <? if(count($last_10_activities)-1<=8){ echo "height:130px; overflow-x:hidden; "; }else{ echo "height:150px; overflow-x:scroll; "; } ?> overflow-y:hidden;  ">
	<div style="width: <?=(count($last_10_activities))*107?>px;">
		<? 
		//echo "<br/>block_square_photo slider 3 ";
		//print_r($last_10_activities);
		for($i=count($last_10_activities)-1;$i>=0;$i--){ ?>
			<a id="last_10_activities_<?=$i?>" style="float:left; margin-left: 7px; float:left;" href="<?=site_url()."profile/activity/".$last_10_activities[$i]['activity_id']?>">
				<div title="<?=$last_10_activities[$i]['title']?>" style="width:100px; height: 140px; font-size: 13px; " >
					<div style="background-image: url(<?=$last_10_activities[$i]['thumb_url']?>); background-size: 100px; width:100px; height:100px; background-repeat: no-repeat; margin-bottom: 10px;">&nbsp;</div>
					<?=date("M j, g:ia", strtotime($last_10_activities[$i]['last_updated']))?>		
				</div>
			</a>
		<? } ?>
		<div class="both"></div>
	</div>
	<script>
		function scrollToRight(){
			console.log("block square photo 18 run scrollToRight");
			$("#square_photo_area").scrollTo("#last_10_activities_0", 100);
		}
		$(document).ready(function(){
			scrollToRight();
		});
		var itemcounter=<?=count($last_10_activities)?>;
		
		
	</script>
</div>
