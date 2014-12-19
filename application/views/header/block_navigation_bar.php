<div class="nav_menu">
	<div class="menuitem">
		<a  href="<?php echo site_url(); ?>/product" style=" text-decoration: none;"> <div class="devices icon"></div>
		<div class="main big dinlight">
			Devices
		</div>
		<div class="main small dinlight">
			device information
		</div>
		<?	if(isset($no_apps)){
				if($no_apps==2){
				?>
					<img class="firstlogin_warning_lightblub mobile_show" style="position: relative; left: 110px;"  src="<?=base_url() ?>/images/common/lightbulbs.png" />
			<?	}
			}
		?>
		</a>
	</div>
	<div class="menuitem">
		<a href="<?php echo site_url()?>/community"  style=" text-decoration: none;"><div class="community icon"></div>
		<div class="main big dinlight">
			Community
		</div>
		<div class="main small dinlight">
			get in touch with fans
		</div></a>
		<ul><?php foreach ($community_submenu as $key => $value) { ?>
			<li class="<?php echo $key ?>"><a href="<?php echo $value['url']; ?>"><?php echo $value['title']; ?></a></li>
 		<?php } ?>
		</ul>
	</div>
	<div class="menuitem">
		<a href="<?php echo site_url()?>/profile" style=" text-decoration: none;"><div class="profile icon"></div>
		<div class="firstlogin_leftbar_message">
			<div class="main big dinlight">
				Profile
			</div>
			<div class="main small dinlight">
				view your activities
			</div>
		</div>
		</a><!--profile_page/index-->
</div>
<div class="menuitem">
	<a href="<?php echo site_url()?>/news" style=" text-decoration: none;"><div class="newsfeed icon" ></div>
	<div class="firstlogin_leftbar_message">
		<div class="main big dinlight">
			Newsfeed
		</div>
		<div class="main small dinlight">
			latest news
		</div>
	</div> <? if(isset($afterfirstlogin)){
	if($afterfirstlogin==true){ ?><div class="hidden_message"> <img class="firstlogin_warning_lightblub"  src="<?=base_url() ?>/images/common/lightbulbs.png" />
	<!--<div class="firstlogin_warning_message">
		Please go to Newsfeed Page to add your friends.
	</div>-->
</div>
<?	}
	}
?></a>
</div>
<div class="menuitem">
	<a href="<?php echo site_url()?>/settings/index" style=" text-decoration: none;"> <div class="settings icon"></div>
	<div class="firstlogin_leftbar_message">
		<div class="main big dinlight">
			Settings
		</div>
		<div class="main small dinlight">
			edit your page

		</div>
	</div> <? if(isset($firstlogin)){
	if($firstlogin==true){
	?><div class="hidden_message"><img class="firstlogin_warning_lightblub"  src="<?=base_url() ?>/images/common/lightbulbs.png" />
	<!--<div class="firstlogin_warning_message">
		Please go to Setting Page to finish the first login setting.
	</div>-->
</div>
<?	}
	}
?></a>
</div>
<div class="mobile_hide ipad_hide" style="text-align:center; margin-top:30px; color:#333;">
	<img src="<?=base_url() ?>/images/index/nav_bar_divider.png">
	<a href="http://www.fansliving.com/external/install_petnfans">Download our PetNfans
	<br>
	iOS App Alpha now!	
	<br>
	
		<img src="http://www.fansliving.com/external/install_petnfans/qr_code_petnfans_install.png" style="width: 160px"/>
	</a>
	<!--ibikefans link<img src="<?=base_url() ?>/images/common/apps_qr_download_link.png" width="120"/>-->
	<? if(isset($no_apps)){
			if($no_apps==2){
			?>
			<div style="position: relative;">
				<div class="hidden_message" style="position: absolute; left: 212px; top: -60px;">
					<img class="firstlogin_warning_lightblub"  src="<?=base_url() ?>/images/common/lightbulbs.png" />
					<!--<div class="firstlogin_warning_message demopage">
					Please go to profile Page to download the IBicycle demo apps.
					</div>-->
				</div>
			</div>
		<?	}
		}
	?>
	
</div>
</div>
<?php if(isset($firstlogin) || isset($no_apps)){  ?>
<script>
	$(function($) {
		$(".hidden_message img").hover(
		function() {
			$(this).parent().removeClass("disable").addClass("active");
		},
		function() {
			$(this).parent().removeClass("active").addClass("disable");
		});
	}); 
</script><?php } ?>