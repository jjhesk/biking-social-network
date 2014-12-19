<style type="text/css">
	
</style>
<script>
	function signin(){
			//alert("block_loginbtn 4");
			
			//alert("<?php echo site_url()?>/login/show_login");
		$.colorbox({
			href: "<?php echo site_url()?>login/show_login",
			scrolling : false,
			width : 950,
			height : 570,
			onLoad : function() {
				$('html, body').css('overflow', 'hidden');
				// page scrollbars off
			},
			onClosed : function() {
				$('html, body').css('overflow', '');
				// page scrollbars on
			}
		});
	}
</script>
<div class="join_div" onclick="signin()">
	<div class="loginbut"></div>
	<div class="text">sign up/ log in</div>
</div>
<div class="find_div" onclick="findstore()">
	<div class="loginbut"></div>
	<div class="text">find a store
	</div>
</div>
