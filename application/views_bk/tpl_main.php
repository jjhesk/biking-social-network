<!DOCTYPE html>
<html lang="en" dir="ltr" id="texaswebdevelopers" class="no-js"><!--end in tpl_footer.php-->
	
	<head>
		<title>FansLiving</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="google-translate-customization" content="7de5617148e402e2-8f8638c8dcd6c4a0-ge828d0b778263345-17"></meta>
		<meta name="google-translate-customization" content="c9d9b7c64f6596f3-1179860304081fb3-g81edeb2deec080fe-12"></meta>
		<!-- meta content="f89cbb6da0d099d6" is about changed the translate language-->
		<meta name="google-translate-customization" content="f89cbb6da0d099d6-bfce8b9599bb562f-g98a732d2b1147884-17"></meta>
		<!-- skeleton css framework-->
		<link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>images/colorbox/fansliving_32x32.png" rel="shortcut icon">
		<link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>images/colorbox/fansliving_32x32.png" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/base.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/skeleton.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/colorbox.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/nyroModal.css" />
		<script type="text/javascript" id="global" src="<?php echo site_url(); ?>/layout/javascript_init"></script>
		<? if( (preg_match('/community/', $_SERVER["REQUEST_URI"] )) || (preg_match('/product/', $_SERVER["REQUEST_URI"] ))|| (preg_match('/news/', $_SERVER["REQUEST_URI"] )) ){ ?>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery-ui-1.8.23.custom.min.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.rslider.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/hesk.num.js"></script>
		<? }else{ ?>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery-1.9.0.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery-ui-1.10.0.custom.js"></script>
		<? } ?>	
		<script type="text/javascript" src="<?php echo base_url(); ?>js/colorbox/jquery.colorbox.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.scrollTo.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.DivCrapImage.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.easing.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/script.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jq.main_headr_controller.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
		<script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		<script id="googletranslate_ini"> 
                    function googleTranslateElementInit()
                    {
                        new google.translate.TranslateElement({
                             pageLanguage: 'en',
                             autoDisplay: false
                        }, 'google_translate_element');
                     } 
                     $.fn.imgProfileAdjustment = function(dimension) {
			            function doAjust() {
			                //alert("triggered."+$(this).width());
			                if ($(this).width() > $(this).height()) {
			                    $(this).attr('height', dimension + 'px');
			                } else {
			                    $(this).attr('width', dimension + 'px');
			                }
			                $(this).unbind('load');
			            }
			
			
			            this.one('load', doAjust).each(function() {
			                /*if (this.complete) {
			                 $(this).load(doAjust);
			                 }else{
			                 doAjust();
			                 }*/
			            });
			        }
        </script>
        
        <!--This is about the changed the translate language -->
        
     	<script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,zh-CN,zh-TW'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		        

        
        
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.8.23.custom.css" />
		<?php 
			$this -> load -> file('css/page.css.php', false); 
			$this->load->file('css/fenix_css.php', false);
		?>
		<style type="text/css">
			/*this can block the google translate toolbar*/
			body {top: 0px !important; position: static !important; }
			.goog-te-banner-frame {display:none !important}
			<?php
			
			$this->load->file('css/animation.css', false);
			$this->load->file('css/hesk.css', false);
			$this->load->file('css/max_css.php', false);
			$this->load->file('css/shadow_image.css', false);
			$this->load->file('css/font.css', false);
			$this->load->file('css/ui.css', false);
			$this->load->file('css/jquery_ui.css', false);
			$this->load->file('css/comments.css.php', false);
			 /*
			 *//*include_once ('animation.css');
include_once ('hesk.css');
include_once ('max_css.php');
//include_once ('animate_btncss.php');
include_once ('shadow_image.css');
include_once ('font.css');
include_once ('ui.css');
include_once ('comments.css.php');*/
		?>
		</style>


		<?php 
		
		// here we will load up the extra scripts for special use by Hesk
		if(isset($tpl_main_jq)){
			foreach ($tpl_main_jq as $key => $value) {
				?><script type="text/javascript" src="<?php echo base_url().'js/jquery/'.$value ?>.js"></script><?php
			}
		}
		 
				// end
		?>
		<style>
			ul.lof-main-wapper li {
				position: relative;
			}
			</style>	
	</head>
	<body><!--end in tpl_footer.php-->
		
		<div class='wrapper'>
			<div id='leftbar' class="leftbar">
				<div class="alpha"></div>
				<a href="http://www.fansliving.com"><div id="logo">
					<img src='<?php echo base_url('/images/index/00-logo-fansliving.png'); ?>'>
				</div></a>
				<div id="leftbar_background">
					<div id="navigation_bar">						
						<?php echo $block_navigation_bar?>	
					</div>
				</div>
				<!--starting google translation-->
                <div id="google_translate_element"></div>
                <!--end google translation-->
			</div>
			<div id="rightbar" class="rightbar">
			    
				<div id ="header" class="header_banner_background">
					<?php echo $block_header; ?>
				</div>
				<div class="container">
					<div id="findastore"></div>	
					<div id="page_content">
						<?php echo $content; ?>
						&nbsp;
					</div>	
				</div>		
				<?php echo $block_footer?>
			</div>
		</div>　
	</body>
	<script><?php echo 'var basic = "' . site_url() . '", base_url="' . base_url() . '"; frdsurl= "' . site_url() . '/friends_list/";'; ?></script>
	
	
</html>
		
