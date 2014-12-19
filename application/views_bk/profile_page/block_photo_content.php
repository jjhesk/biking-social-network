
    <link rel="stylesheet" href="<?=base_url()?>js/nivo-slider3.1/themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=base_url()?>js/nivo-slider3.1/themes/light/light.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=base_url()?>js/nivo-slider3.1/themes/dark/dark.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=base_url()?>js/nivo-slider3.1/themes/bar/bar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=base_url()?>js/nivo-slider3.1/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=base_url()?>js/nivo-slider3.1/style1.css" type="text/css" media="screen" />
	</head>
<body>
    <div id="wrapper">
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
            	<?php for($i=0;$i<count($image);$i++){ ?>
	                <img src="<?=$image[$i]['full_url']?>" />
	                <!--<img src="<?=$image[$i]['full_url']?>"  alt=""title="photo<?=$i?>" />-->
            	<?php } ?>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?=base_url()?>js/nivo-slider3.1/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/nivo-slider3.1/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
    	
        $('#slider').nivoSlider({
        	effect: 'fade',
        	manualAdvance:true });
    });
    </script>