<div style="position: relative; width: 970px; height: 20px" class="meter_k index_block_shadow  
<?php
if (isset($is_live) && $is_live == true) {
	echo "live";
} else
	echo $color;
?>">


	<div id="time" style="position: absolute; margin-top:7px; left: 162px;"></div>
	<div id="h1" style="position: absolute; margin-top:7px; left: 438px;"></div>
	<div id="h2" style="position: absolute; margin-top:7px; left: 634px;"></div>
	<div id="h3" style="position: absolute; margin-top:7px; left: 824px;"></div>
	<div style="position: absolute; margin-top:10px; text-align:right; font-size: 13px; width: 100px; color: #333333; left: 58px;">
		Time
	</div>
	<div style="position: absolute; margin-top:26px; text-align:right; font-size: 13px; width: 100px; color: #333333; left: 58px;">
		spent
	</div>
	<div style="position: absolute; margin-top:10px; text-align:right; font-size: 13px; width: 200px; color: #333333; left: 235px;">
		Distance
	</div>
	<div style="position: absolute; margin-top:10px; text-align:right; font-size: 13px; width: 200px; color: #333333; left: 432px;">
		Calories
	</div>
	<div style="position: absolute; margin-top:10px; text-align:right; font-size: 13px; width: 200px; color: #333333; left: 621px;">
		Heart rate (avg)
	</div>
	<div style="position: absolute; margin-top:26px; text-align:right; font-size: 13px; width: 200px; color: #<?=$color_hex['normal'] ?>; left: 235px;">
		km
	</div>
	<div style="position: absolute; margin-top:26px; text-align:right; font-size: 13px; width: 200px; color: #<?=$color_hex['normal'] ?>; left: 432px;">
		J
	</div>
	<div style="position: absolute; margin-top:26px; text-align:right; font-size: 13px; width: 200px; color: #<?=$color_hex['normal'] ?>; left: 621px;">
		bpm
	</div>
	<div class="progressbar-deprecated" data-perc="20">
		<div class="bar <?php echo $color; ?>">
			<span></span>
		</div>
	</div>

</div>
<script><?php
if(isset($activity_data['split_time'][0])){
	echo "var time_k = \"" . $activity_data['split_time'][0] . ":" . $activity_data['split_time'][1] . ":" . $activity_data['split_time'][2] . "\";";
}
echo "var distance_k = \"" . $activity_data['total_distance'] . "\";";
echo "var calories_k = \"" . $activity_data['total_calories'] . "\";";
echo "var heartrate_k = \"" . $activity_data['avg_heart_rate'] . "\";";
if (isset($is_live) && $is_live == true) {
	echo "var islive=true; ";
} else
	echo "var islive=false; ";
?></script>
<script>
	jQuery(function($) {
		jQuery("#time").heskCounter(time_k.toString());
		jQuery("#h1").heskCounter(distance_k.toString());
		jQuery("#h2").heskCounter(calories_k.toString());
		jQuery("#h3").heskCounter(heartrate_k.toString());
		var fke;
		if (islive) {
			$('.progressbar').each(function() {
				var t = $(this), dataperc = t.attr('data-perc'), barperc = Math.round(dataperc * 5.56);
				t.find('.bar').animate({
					width : barperc
				}, dataperc * 25);
				t.find('.label').append('<div class="perc"></div>');
				function perc() {
					var length = t.find('.bar').css('width'), perc = Math.round(parseInt(length) / 5.56), labelpos = (parseInt(length) - 2);
					t.find('.label').css('left', labelpos);
					t.find('.perc').text(perc + '%');
				}

				//perc();
				//fke=setInterval(perc, 5);
			});
		}
	}); 
</script>
<style>
.meter_k{
width: 970px; height: 55px; background-image: url(<?php echo base_url(); ?>/images/profile_page/activity_overview2.png); background-repeat: no-repeat;
}
.progressbar span{
padding:9px;
font-size:20px;
}
</style>