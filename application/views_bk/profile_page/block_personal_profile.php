<style>
	/*.personal_profile .profilepic {
	 border-radius: 6px 6px 6px 6px;
	 height: 100px;
	 width: 100px;
	 overflow: hidden;
	 }
	 .personal_profile .profilepic img {
	 width: 100px;
	 }*/
	.personal_profile .status_3, .personal_profile .status_2, .personal_profile .status_1 {
		position: absolute;
		bottom: -96px;
	}
</style><script>
	var eventmap_event = {
		/*
		 * the map is mainly dealing with the listed below:
		 * 1) add friend - done
		 * 2) remove friend
		 * 3) send messages
		 * 4) view the profile - done
		 * 5) report the friend
		 */
		click : function() {
			//alert("on click 26");
			var send, uid = jQuery(this).attr("uid"), ob = jQuery(this);
			var g = function(send) {
				//alert("on click 29");
				jQuery.ajax(send).done(function(r) {
				//	alert("on click 30");
					if (parseInt(r) == 1) {
						ob.addClass("disable");
					} else if (parseInt(r) == 0) {
						//alert("error 32");
						//if (ob.hasClass("status_3")) {
							//ob.removeClass("status_3").addClass("status_2");
						//}
					}
				});
			}
			var p = function(cmd) {
				send = frdsurl + cmd + "/" + uid;
				//alert("on click status_3");
				g(send);
			}
			//if (ob.hasDesc("profile"))
			//profileView(uid);
			//if (ob.hasDesc("add from search"))
			//p("action_addfan");
			//if (ob.hasDesc("unconnect"))
			//p("action_unconnect");
			//if (ob.hasDesc("cancel the request"))
			//p("action_remove_my_request");
			if (ob.hasClass("status_1")) {
				//alert("on click status_1");
				return false;
			}
			if (ob.hasClass("status_2")) {
				//alert("on click status_2");
				return false;
			}
			if (ob.hasClass("status_3")) {
				
				p("action_addfan");
				return false;
			}
			//initialization();
			//pieline_user_data_packet();
			//event.stopImmediatePropagation();
			//alert(event);
			//event.preventDefault();
		}
	};
	jQuery(function($) {

		$("#profile_pic img").imgProfileAdjustment(85);
		$(".uibutton").click(function() {
			/*TODO: fenix: */
			//please the request link as the json to the URL and get the response from the server
		});
		$(".uibutton").bind(eventmap_event);
	})
</script>
<div class="personal_profile" style="position:relative; width:100px; padding:10px;" >
			<div style="  width:260px; height:160px;padding-left:10px; padding-top:4px; ">
				<div class="notranslate" style="color:#00A9EB; font-size:14px;">
					<?= $profile['name']; ?>
				</div>
				
				<? 
					$friend_status=$profile['friend_status'];
					//echo "<br/>block personal profile 93 ".$profile['default_privacy'].":".$friend_status;
					if( 
						( ($profile['default_privacy'] == 'myself_only')&&($friend_status!=0) )
						||( ($profile['default_privacy'] == 'friends_only')&&($friend_status>=2) ) 
					){
					echo "This person's profile is set to private.";
				 }else{ ?>
					<div style="color:#888888;">
						<br/>Last Updated<br/>
						<font style="color:#0095BB;" >
						<?php //echo $profile['lastupdate'];
							echo date('M j, g:ia', strtotime($profile['lastupdate']));
							echo '<br><br>';
						?>	
						</font>
					</div>
					<div>
						<? echo 'Gender: ' . $profile['gender'].'<br>';
						
						if ($profile['weight_privacy'] == 1)
							echo 'Weight: ' . $profile['weight'] . ' lbs<br>';
	
						if ($profile['height_privacy'] == 1)
							echo 'Height: ' . $profile['height'] . ' cm<br>';
	
						if ($profile['birthday_privacy'] == 1)
							echo 'Birthday: ' . $profile['birthday'] . '<br> ';
	
						if ($profile['email_privacy'] == 1)
							echo 'Email: ' . $profile['address'] . '<br> '; ?>
					</div>
				
				<? 
				
				if($friend_status!=0){?>
					<a class="large special uibutton 
					
					<?php $return_string = ''; //this is to determine if this person will be added to the friends list or not
					switch($friend_status) {
							case 1 :
								$return_string = "Manage friend";
								break;
							case 2 :
								$return_string = "Your friend request is pending.";
								break;
							case 3 :
								$return_string = "Add friend";
								break;
					}
					echo 'status_'.$friend_status ?>" uid="<?php echo $profile['uid']; ?>"><?php
					echo $return_string;
					?>
					</a>
				<? } ?>
			</div>
			
			<? if (!$is_permission_denied) {?>
				<div id="profile_pic" style="position:absolute; left:155px; top:20px; ">
					<img src="<?=$profile['image_url']; ?>">
				</div>
			<?}
		} //if( ( ($profile['default_privacy'] == 'myself_only')&&($friend_status!=0) ) ||( ($profile['default_privacy'] == 'friends_only')&&($friend_status>=2) ) ) ?>
</div>
	
	<!--<div style="width:270px; height:90px; position: relative; top: 5px">
		original version <div class="index_profile_btn" style="float:left;"><p style="padding:40px 0 0 30px; color:#2697DD; font-size:25px;"><?php echo $profile['btn_number'][0]; ?></p></div>
		<div class="index_profile_btn" style="float:left; position:absolute; left: 10px; top: 14px; "> <div class="index_p"><?php echo $profile['btn_number'][0]; ?></div></div>
		<div class="index_profile_btn" style="float:left; position:absolute; left: 100px; top: 14px; "><div class="index_p" ><?php echo $profile['btn_number'][1]; ?></div></div>
		<div class="index_profile_btn" style="float:left; position:absolute; left: 190px; top: 14px;"><div class="index_p"><?php echo $profile['btn_number'][2]; ?></div></div>
	</div>
	<div style="width:270px; height:20px; ">
		<div style="float:left; width:90px; height:20px; text-align:center;"> Fans</div>
		<div style="float:left; width:90px; height:20px; text-align:center;">Following</div>
		<div style="float:left; width:90px; height:20px; text-align:center;">Devices</div>
	</div>
</div>-->