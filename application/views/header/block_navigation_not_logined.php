<script>
	$(document).ready(function() {
		var loc = document.location.href;
		//alert(loc+loc.indexOf("index.php/settings"));
		var loc_arr = ["product", "community", "profile", "news", "settings"];
		var i;
		jQuery(".nav_menu").removeClass("active");
		for ( i = 0; i < loc_arr.length; i++) {
			var name_from_url = loc_arr[i];
			if (loc.indexOf("index.php/" + name_from_url) >= 0) {
				//alert("block navigation 6 "+$(".left_"+loc_arr[i]).html());
				if (name_from_url == "product")
					name_from_url = "devices";
				if (name_from_url == "news")
					name_from_url = "newsfeed";
				var ob = $(".nav_menu ." + name_from_url);
				if (!ob.hasClass("active")) {
					ob.addClass("active");
				}
			}
		}
	}); 
</script>
<div class="nav_menu">
	<div class="menuitem">
		<a href="<?php echo site_url()?>/product" style=" text-decoration: none;"><div class="devices icon" ></div>
		<div class="main big dinlight">
			Device
		</div><div class="main small dinlight">
			device information
		</div></a>
	</div>
	<div class="menuitem">
		<a href="<?php echo site_url()?>/community" class="ajax" style=" text-decoration: none;"><div class="community icon" ></div>
		<div class="main big dinlight">
			Community
		</div><div class="main small dinlight">
			get in touch with fans
		</div></a>
		<ul><?php foreach ($community_submenu as $key => $value) { ?>
            <li class="<?php echo $key ?>"><a href="<?php echo $value['url']; ?>"><?php echo $value['title']; ?></a></li>
        <?php } ?>
        </ul>
	</div>
	
		<div class="main small dinlight" style="display: block;margin-top: 10px;text-align: center;">Login for more access to profile and more</div>
	
	<div class="mobile_hide ipad_hide" style="text-align:center; margin-top:30px; color:#333;">
		<img src="<?=base_url()?>/images/index/nav_bar_divider.png">
		<a href="http://www.fansliving.com/external/install_petnfans">Download our 
			iOS App Alpha now!	
			<br>
			
			
				<img src="http://www.fansliving.com/external/install_petnfans/qr_code_petnfans_install.png" style="width: 160px"/>
			</a>


	</div>
</div>