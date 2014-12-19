<?php $this->load->file('css/page.css.php', false); ?>
</style>		
<script src="<?php echo base_url()?>/js/jquery/jquery.js"></script>
<script>
	/*function saysomething(){
		document.location='protocol://{"user_inhouse_id":"9","nickname":"IMusic MusicTech","firstname":"imusic","lastname":"tech","email":"facebook@it.imusictech.com","profile_image":"http:\/\/profile.ak.fbcdn.net\/hprofile-ak-ash4\/371825_100003833201223_855918585_q.jpg"}';
	}*/
	if (window.DeviceOrientationEvent) {
	  console.log("DeviceOrientation is supported");
	  window.addEventListener('deviceorientation', function(eventData) {
	        var LR = eventData.gamma;
	        var FB = eventData.beta;
	        var DIR = eventData.alpha;
	        deviceOrientationHandler(LR, FB, DIR);
	    }, false);
	} else {
	    console.log("Not supported on your device or browser.  Sorry.");
	}
	 
	function deviceOrientationHandler(LR, FB, DIR) {
	   //for webkit browser
	   document.getElementById("imgLogo").style.webkitTransform = "rotate("+ LR +"deg) rotate3d(1,0,0, "+ (FB*-1)+"deg)";
	 
	   //for HTML5 standard-compliance
	   document.getElementById("imgLogo").style.transform = "rotate("+ LR +"deg) rotate3d(1,0,0, "+ (FB*-1)+"deg)";
	}
	function loginalert(){
		alert("You have successfully login!");
	}
	function applyvariable(app_device_uuid, device_uuid, manuifacture_token){
		$("#app_device_id").attr("value", app_device_uuid);
		$("#device_id").attr("value", device_uuid);
		$("#manuifacture_token").attr("value", manuifacture_token);
		//alert("page_mobile_login 11 "+app_device_uuid+":"+device_uuid+manuifacture_token);
	}
	function submit_openid(identity){
		$("#identity").attr("value", identity);
		$("#ajax_loading").show();
		$("#mobile_login_form").submit();
	}
	
	//$info['device_uuid']="8653c5ef-4ca1-44c7-853e-7c3bb9312134";
		//$info['app_id']="d47d4dbb-a117-478d-908a-75dd8ef3b5f1";
		//$info['token']="U2FsdGVkX18ZN+U2FsdGVkX18ZN+liN7haYDuYSB1BLaJqPRVcAD8KA2tiS6/fWmTi7WxymziLIb+C";
</script>
<body style="background-color: #000000;">
	
<form id="mobile_login_form" style="display:none;" name="mobile_login_form" action="<?php echo site_url()?>/login/save_mobile_openid_login_and_submit" method="post">
	<input type="hidden" id="app_device_id" name="app_device_id" value="d47d4dbb-a117-478d-908a-75dd8ef3b5f1" />
	<input type="hidden" id="device_id" name="device_id" value="18653c5ef-4ca1-44c7-853e-7c3bb9312134" />
	<input type="hidden" id="manuifacture_token" name="manuifacture_token" value="U2FsdGVkX18ZN+U2FsdGVkX18ZN+liN7haYDuYSB1BLaJqPRVcAD8KA2tiS6/fWmTi7WxymziLIb+C" />
	<input type="hidden" id="identity" name="identity" value="" />
</form>			
<!--<div style="background-image: url(<?php echo base_url()?>/images/login/singin-bg.png); width: 100%; height: 100%; background-repeat: repeat;">
-->
	<img id="ajax_loading" src="<?=base_url()?>/images/colorbox/ajaxLoader.gif" style="display:none; position: absolute; left:40%; top:40%; background-color: #FFFFFF; border: 5px solid #000000; z-index:10;" />
	<div style="position: absolute; top: 0%; left: 10%; width: 80%; overflow:hidden;">
		<img src="<?php echo base_url()?>/include/image/common/logo_ibike_mobile_b.gif" width="100%"  />
		<table border=0 cellpadding=0 cellspacing=0 width=100%>
			<!--<tr>
				<td align="center" id="login_page_description1" style="font-size: 150%; width: 100%;" colspan=3>
					Please click the button and Sign in with facebook account.
				</td>
			</tr>-->
			<tr><td align=left width="33%" valign=center align=right style="font-size: 100%;font-weight:bold; color:#FFFFFF;">
					<!--<img src="<?php echo base_url()?>/images/login/button-google.png" style="cursor:pointer" width='100%' onclick="submit_openid('google')" />
					-->
					<br/><br/>
					Please click
			</td><td align=center width="33%" valign=center>
					<br/>
					<br/>
					 <img src="<?php echo base_url()?>/include/image/common/facebook.jpg" width=100%  onclick="submit_openid('facebook')" /> 
			</td><td align=right width="33%" valign=center align=left style="font-size: 100%; font-weight:bold; color:#FFFFFF;">
					<br/><br/>to login in.
					<!--
						<img src="<?php echo base_url()?>/images/login/button-yahoo.png" style="cursor:pointer" width='100%' onclick="submit_openid('yahoo')" />
					-->
			</td></tr>
		</table>
	</div>
</body>

<!--</div>-->
