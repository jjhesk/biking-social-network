<html>
	<head>
		<meta name="description" content="trevorrudolph.com">
		<meta name="format-detection" content="telephone=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta http-equiv="Content-Type" content="text/html; Charset=UTF-8"  /> 
		<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<script type="text/javascript" id="global" src="<?php echo site_url(); ?>/layout/javascript_init"></script>
		<!--<link rel="apple-touch-icon" href="http://trevorrudolph.com/wordpress/apple-touch-icon.png">-->
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/normalize.css">
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.scrollTo.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/hesk.num.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.rslider.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/slidedeck.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.masonry_hesk.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.mobile.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>application/views/webview_apps/petnfans/framework.js"></script>
		<?php echo(isset($css)?$css:'');?>
		<?php echo(isset($js)?$js:'');?>
	</head>
	<style>
		.screenshot_frame {
			margin: -10px;
		}
	</style>
	<body>
	    <?php echo $content; ?>
	</body>
</html>