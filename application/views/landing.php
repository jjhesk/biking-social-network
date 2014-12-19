<?php echo $header;?><body>
<div id="container"><header style="overflow: hidden;"><div class="logo"></div><div class="background_bikes"><div class="bikes_2"></div><div class="bikes_1"></div><div class="bikes_3"></div></div><div class="rightsideimg"><div class="ibikewheel"></div></div><article>A NEW BIKE<br>NETWORKING<br>SITE DESIGNED<br>FOR YOU OWNER</article><div class="login"><a href="<?php echo $facebooklogin; ?>"></a></div>
	</header>
	<div id="body">
		<?php
		echo $bodymenu;
		?>
		<div class="titlebar"><title>WHAT IS IBIKE</title></div>
		<div class="stagepic"><img  class="fix"  src="<?php echo base_url() ; ?>include/image/common/white_frame.png"/>
			<img src="<?php echo base_url() ; ?>include/image/common/gra_intro.png" class="bg"/></div>
			<div class="bgline"></div>
	</div>
	<?php
	echo $footer;
	?>
</div>
</body>
</html>