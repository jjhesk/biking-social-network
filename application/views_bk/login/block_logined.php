<style type="text/css">
	
	
		
</style>
<script>
	function logout(para) {
		//alert(para);
		if (para == "yahoo") {
			$("#logoutarea").load("https://login.yahoo.com/config/login?logout=1", function() {
				logoutredirect();
			});
		} else if (para == "google") {
			//$("#logoutarea").attr("src", "https://www.google.com/accounts/Logout");

			logoutredirect();
			return false;
			/*$("#logoutarea").load("https://www.google.com/accounts/Logout", function(){
			 alert('logout google');
			 //logoutredirect();
			 });*/
		}
	}

	function logoutredirect() {
		document.location.href = basic + 'login/logout';
	}
</script>
	<iframe id="myIFrame" name="myIFrame" style="display:none;"></iframe>
	<a class="loginarea_logout_openid" <? if($userinfo['identity']!="facebook") { ?>  href="<?=$logout_openid_link ?>" onclick="setTimeout(logoutredirect, 2000)"  target="myIFrame" <? }else{ ?> href="<?=$logout_openid_link ?>" <? } ?> >
				<div class="loginedbut"></div>
				<div class="text" style="color: #444444; cursor:pointer;">
					Logout 
				</div>
	</a>
	<div class="findstore_div" onclick="findstore();">
		<div class="loginedbut"></div>
		<div class="text">find a store</div>
	</div>
	<div class="username_div">
		<div class="loginedbut"></div>
		<div class="text notranslate">Hi, <?=$nickname ?></div>
	</div>
	
	<div class="clear"></div>
