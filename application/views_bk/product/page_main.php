<!--<section id="product_search" class="function">
	<div class="face">
		<?php echo $search_options; ?>
		<input type="text" placeholder="looking for ... " value=""/>
		<div class="search_submit"></div>
	</div>
</section>-->
<? 
include("css.php");

if(isset($no_apps)){if($no_apps==2){ ?>
	<div style="height: 50px; width: 950px; padding-top: 10px; ">
				 <div class="settings_firstlogin_welcome dinlight">
				 Welcome!
				 </div>
		 		 <div class="settings_firstlogin_message dinlight" style="width:680px;">For the first time user,<Br/>
				 please click the "Buy now" button to download the Fansliving iBikeFans demo apps.
				 </div>
	</div>
<? } }?>
<section class="section_heading_stack">
	<!--<div class="arrow right"></div><div class="banner"></div>-->
	<div class="bbatch"></div>
	<div class="batch"><span>Bluetooth</span><br><span>Devices</span></div>
	<div id="product_devices" class="jThumbnailScroller">
	<div class="jTscrollerContainer" style="width: 800px; "><div class="jTscroller wrap"></div></div>
    <div class="jTscrollerPrevButton arrow left hflip"></div>
    <div class="jTscrollerNextButton arrow right"></div>
    </div>
    <div class="shadow_plain"></div>
</section>
<section id="product_featured" class="section_heading_stack">
	<ul class="breadcum"><li>Overview</li><li>Tech Specs</li><li>Gallery</li><!--<li>Add Device</li>--></ul><br>
	<div id="sliderK" class="kslider">
    	<article class="main_front_page overview">
        	<div class="product_big"><div id="flux_product">
            <img class="product_main_img" src="" alt="" />
            <!--<img src="<?=base_url()?>external/device_images/ibikefans-02.png" alt="" />-->
            </div></div><div class="feature_detail">
        		<span class="feature_text"></span><br>
        		<span class="feature_subtext"></span><br>
        		<span class="feature_small_comment"></span><br>
        		<div class="price"><span class="currency">USD</span><span class="amount">TBA</span></div><BR>
        		<div class="buy_it_now"><a target="_blank"></a></div><br>
        		<span class="remark" style="top: -27px;">Buy online and free shipping</span><br>
        		<div class="marketplace">
        		    <div class="appstore"><a target="_blank"></a></div>
        		    <div class="googlepaly"><a target="_blank"></a></div>
        		<div class="remark">Register <span style="color:#00A5E7">iBike Fans</span> through Smartphone Bluetooth 4.0 Appplcation</div><div class="appicon"></div>
        		</div>
        	</div>
    	</article>
    	<article class="tech_specs">
    	    <div class="left">
    	        <span class="feature_text"></span><br>
    	        <span class="feature_subtext" style="font-size:25px;color:#808080;margin-bottom: -10px;display:block;margin-top: -8px;"></span><br>
    	        <img class="product_main_img" src="" alt="" />
    	    </div>
    	    <div class="right">
    	        <!--<span class="gfeatures">General Features</span>
    	        <ul class="features">
    	            <li>speed</li>
    	            <li>distance</li>
    	            <li>temperature</li>
    	            <li>programmable wheel size</li>
    	            <li>bluetooth low energy 4.0 technology</li>
    	            <li>energy saving, battery last for 2 years</li><li>calories</li><li>time</li><li>heart rate</li><li>max speed</li>
    	        </ul>-->
    	    </div>
    	</article>
    	<article class="gallery">
    	    <span class="feature_text"></span>
    	    <div class="right"><div id="mainfeature_image_area"><img /></div></div>
    	    <div class="left"><div id="gallerlist"></div></div>
    	</article>
    	<article class="add_device"><img src="http://hesk.imusictech.net/fansliving/images/index/screen-adddevice.png"/>add_device is under construction</article>
	</div>
	<div class="shadow_plain"></div>
</section>
<section id="product_related" class="section_heading_stack">
	<div id="product_related_load" class="jThumbnailScroller">
	<div class="jTscrollerContainer"><div class="jTscroller wrap"></div></div>
    <div class="jTscrollerPrevButton arrow left hflip"></div>
    <div class="jTscrollerNextButton arrow right"></div>
    </div>
    <div class="shadow_plain"></div>
</section>
<!--<img src="http://hesk.imusictech.net/fansliving/images/common/screen-04.png" width="960px" height="204px"/>-->
<section id="product_extra_a" class="section_heading_stack"><div class="part_a"><span class="k1" style="">Fans living&nbsp</span><br><span class="k2">bluetooth 4.0 community</span></div>
	<div class="part_b">TOTAL meters&nbsp<br>around the world</div><div id="heskcoun" class="part_c"></div><!--<div class="part_d bjoinnow"></div>--><div class="shadow_plain"></div></section>
<?php

include("script.php"); 

?>
