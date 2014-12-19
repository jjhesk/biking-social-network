<script>
var refreshIntervalId;


	
	var activity_id;
	function ajax_refresh_live_data() {
	//	ajax_get_activity_overview_data();
		console.log('page_device.php line 17: ajax_refresh_live_data..');
		$.ajax({
			  type: 'GET',
			  url: basic+'/profile/ajax_get_activity_overview_data',
			  data: 'activity_id=<?=$activity_id?>&app_id=<?=$app_id?>&user_id=<?=$user_id?>',
			  cache: false,
			  success: function(data) {
				  call_back_update_ui(data);
			  },
		});
	}
	function call_back_update_ui (data ) {
		  result=data.split('~||~');
		    // console.log("iframe_record_analysis line 85 , heart rate json :\n "+result[1]);
		  activity_overview_ui=result[0];
		  block_record_ui=result[1];
		  block_route_ui=result[2];
	//	if (activity_overview_ui!=""){			     
		     $('#activity_overview_block').html(activity_overview_ui);
	//	}
	  //  if (block_record_ui!="") {
	    	 $('#block_record').html(block_record_ui);
	    	// alert(block_record_ui);
	//    }
	//	if (block_route_ui!="") {
			$('#block_route').html(block_route_ui);
	//    }
	//	} 
	} 
	function update_activity_id(id) {
		activity_id=id;
	}


	function delegate_path() {
		var pathname_url = window.location.pathname;
		//document.location.href = basic + '/login/logout';
		//alert(pathname_url);
		if(pathname_url.indexOf("view_activity/")!=-1){
			scan_loading_block();
			//alert("scan_loading_block line 50");
		};
	}
	
		$(document).ready(function() {
			delegate_path();
		<?if ( isset($is_live)) {
				if ($is_live=="true") {?>
					clearInterval(refreshIntervalId);
					refreshIntervalId = setInterval(ajax_refresh_live_data, 3500);
					//setTimeout(auto_refresh_live_data, 2500);
		 <? } else {?>
		 		clearInterval(refreshIntervalId);
		 <?} } ?>
	});
</script>
<div id='body' style="position:relative; bottom:39px;">
	<div id="main_left" style="width:980px; float:left;">
	
		<div class="content_bar" style="float:left; ">
		</div>


				<div id="main content" class="notranslate" style="margin-top:50px; width:920px; height:20px; color:#<?=$color_hex['normal'] ?>; font-size:32px; font-family:dinregular; " align="right"><?=$profile['name'] ?></div>
				<div class="profile_gradient"style="position:absolute; margin-top:5px; width:970px; height:3px; " ></div>
				<div style="margin-top:5px; width:970px; height:3px; background-color:#<?=$color_hex['normal'] ?>;" ></div>
				<div style="height: 10px;"></div>

	<?=$page_device_content?>
	</div>
</div>
