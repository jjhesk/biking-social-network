<style>
	.block_notice_cal {
		padding-left: 240px;	
		position: relative;
		height:40px;
	}
	.prevblock, .nextblock, .centerblock {
		text-transform: capitalize;
		display: block;
		height: 21px;
		float: left;
		cursor: pointer;
		font-family: dinregular
	}
	.prevblock, .nextblock {
		padding-top: 10px;
		width: 170px
	}
	.prevblock > div {
		float: left;
		text-align: left
	}
	.nextblock > div {
		float: right;
		text-align: right
	}
	.centerblock {
		width: auto !important;
		font-size: 20px;
		margin-top: 9px;
		white-space: pre
	}
	.calendar a:link {
		text-decoration: none;
	}/* unvisited link */
	.calendar a:hover {
		text-decoration: underline
	}
	.calendar a:visited, .calendar a:active {
		text-decoration: none
	}
	.cal.arrow {
		position: absolute;
		right: 12px;
		top: 250px;
	}
	.cal.arrow.hflip {
		top: 130px
	}
	.cal_event_click {
		font-size: 12px;
		cursor: pointer;
	}
 </style>
 
 <div class = "block_notice_cal">
 	<?php if($calendar!=null) {
				$centerblock_url = site_url() . "/profile_page/nyro_activity_calendar/" . $user_id;
				$cc = '<div class="centerblock" onclick="colorbox_cal(\'' . $centerblock_url . '\');">' . $calendar['current_activity'] . '</div>';	
				 if(isset($calendar['previous_activity_link'])){ ?>
					<div class="load_on_profile_tab prevblock ar" href="<?=$calendar['previous_activity_link'] ?>" >previous activity<div class="arrow_s hflip"></div></div>
				<? }else{
					echo '<div class="prevblock"><div class="arrow_s"></div></div>';
				}
				if(isset($calendar['previous_activity_link'])){
					?><div class="load_on_profile_tab" href="<?=$calendar['previous_activity_link'] ?>" ></div>
				<? }
						echo $cc;
				if(isset($calendar['next_activity_link'])){
 ?><div class="load_on_profile_tab nextblock ar" href="<?=$calendar['next_activity_link'] ?>">next activity<div class="arrow_s"></div></div><? }else{
echo '<div class="nextblock"><div class="arrow_s"></div></div>';
}
}
else
{
echo "You have no activity yet.";
}
						?>
</div>
						
						<?
							if ($activity_data['mode'] == "manual") {
								echo '<div style="position:relative; text-align:center;"><img src=' . base_url() . 'images/profile_page/02-bar-manualinput.png height="22"></div>';
							}
							if ($is_live=="true") {
								echo '<div style="position:relative; text-align:center;"><img src=' . base_url() . 'images/profile_page/02-bar-live.png height="22"></div>';
							}
						?>