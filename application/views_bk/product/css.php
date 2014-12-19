<style>

/* -----------------------------------------
 SLIDER THIS IS THE CROSS REFERENCE R-SLIDER BASIC
 ----------------------------------------- */

/* Slider itself */
.rSilder.default {

}
/* Slider with thumbs (used to add padding based on thumbnails size)*/
.rSilder.default.with-thumbs {
    padding-bottom: 68px;
}

/*
 Left and right navigation arrows
 */
.rSilder.default .arrow {
    background: rgb(80, 159, 140);
    background: rgba(80, 159, 140, 1);
    background-image: url(controls-sprite.png);
    /* change arrows size here */
    width: 30px;
    height: 30px;
    margin-top: -15px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
    filter: alpha(opacity=80);
    -moz-opacity: 0.8;
    -khtml-opacity: 0.8;
    opacity: 0.8;
}
/* arrow position in slider with thumbs */
.rSilder.default.with-thumbs .arrow {
    margin-top: -49px;
}
/* Arrow down state */
.rSilder.default .arrow:active {
    background-color: rgba(80,159,140,0.8);
}
/* Arrow hover state */
.rSilder.default .arrow:hover {
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    filter: alpha(opacity=100);
    -moz-opacity: 1;
    -khtml-opacity: 1;
    opacity: 1;
}
/* Arrow disabled state */
.rSilder.default .arrow.disabled {
    background-color: rgba(80,159,140,0.8);
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)" !important;
    filter: alpha(opacity=100) !important;
    -moz-opacity: 1;
    -khtml-opacity: 1;
    opacity: 1;
}
/* left arrow */
.rSilder.default .arrow.left {
    background-position: top left;
    left: 5px;
}
/* right arrow */
.rSilder.default .arrow.right {
    background-position: top right;
    right: 5px;
}
/*
 Bullets and thumbnails navigation
 */
.rSilder.default .royalControlNavOverflow a {
    background-color: transparent;
    background-image: url(controls-sprite.png);
    background-position: 0 -164px;
    width: 18px;
    height: 18px;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
    filter: alpha(opacity=80);
    -moz-opacity: 0.8;
    -khtml-opacity: 0.8;
    opacity: 0.8;
}
/* Current bullet */
.rSilder.default .royalControlNavOverflow a.current {
    background-position: 0 -182px !important;
}
/* Bullet hover state */
.rSilder.default .royalControlNavOverflow a:hover {
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    filter: alpha(opacity=100);
    -moz-opacity: 1;
    -khtml-opacity: 1;
    opacity: 1;
}

/* Bullets nav sub-container */
.rSilder.default .royalControlNavCenterer {
    padding: 3px 5px;
    background: rgb(50, 50, 50);
    background: rgba(0,0,0,0.5);
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
}
/* Bullets nav or thumbnails main container */
.rSilder.default .royalControlNavOverflow {
    margin-top: -30px;
}
/* Thumbnails main container */
.rSilder.default .royalControlNavOverflow.royalThumbs {
    margin-top: 4px;
}

/* Thumbnails */
.rSilder.default .royalControlNavOverflow a.royalThumb {
    background-color: transparent;
    background-position: 0 0;
    width: 60px;
    height: 60px;
    /* thumbnails spacing, use margin-right only */
    margin-right: 4px;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    filter: alpha(opacity=100);
    -moz-opacity: 1;
    -khtml-opacity: 1;
    opacity: 1;
}
/* Current thumbnail */
.rSilder.default .royalControlNavOverflow a.royalThumb.current {
    background-position: -3px -3px !important;
    border: 3px solid #666 !important;
    width: 54px;
    height: 54px;
}
/* Thumbnail hover state*/
.rSilder.default .royalControlNavOverflow a.royalThumb:hover {
    background-position: -3px -3px;
    border: 3px solid #AAA;
    width: 54px;
    height: 54px;
}
/*
 Thumbnails navigation arrows
 */
.rSilder.default .thumbsArrow {
    background: url(controls-sprite.png) no-repeat 0 0;
    width: 28px;
    height: 68px;
    -moz-opacity: 0.8;
    opacity: 0.8;
}
.rSilder.default .thumbsArrow.left {
    background-position: -116px -132px;
    left: 0;
}
.rSilder.default .thumbsArrow.right {
    background-position: -156px -132px;
    right: 0
}
.rSilder.default .thumbsArrow:hover {
    -moz-opacity: 1;
    opacity: 1;
}
.rSilder.default .thumbsArrow.disabled {
    -moz-opacity: 1;
    opacity: 1;
}
.rSilder.default .thumbsArrow.left.disabled {
    background-position: -36px -132px;
}
.rSilder.default .thumbsArrow.right.disabled {
    background-position: -76px -132px;
}
.rsContainer {
    position: relative;
}
.rsContainer .rsSlide {
    position: absolute;
    width: 100%;
    display:inline;
}
.rsContainer .rsSlide>article{
    display:inline;
    width:100%;
    height:100%;
}
/*
        section_heading_stack
 */
section.section_heading_stack{
/*
-moz-border-radius-bottomright: 3px;
border-bottom-right-radius:  3px;
-moz-border-radius-bottomleft:  3px;
border-bottom-left-radius:  3px;
*/
position: relative;
-moz-border-radius:3px;
-webkit-border-radius:  3px;
border-radius:  3px;
-o-box-shadow:0 0 0 1px #ffffff, 0 0 0 2px #D9D9D9; /* Firefox 3.6 and earlier */
-moz-box-shadow:0 0 0 1px #ffffff, 0 0 0 2px #D9D9D9; /* Firefox 3.6 and earlier */
-webkit-box-shadow:0 0 0 1px #ffffff, 0 0 0 2px #D9D9D9;; /* Safari and Chrome */
box-shadow: 0 0 0 1px #ffffff, 0 0 0 2px #D9D9D9;
margin-top:10px;
margin-bottom:20px;
width: 100%;
/*background: rgb(240,183,161); 
background: -moz-linear-gradient(top,  rgba(240,183,161,1) 0%, rgba(140,51,16,1) 50%, rgba(117,34,1,1) 51%, rgba(191,110,78,1) 100%); 
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(240,183,161,1)), color-stop(50%,rgba(140,51,16,1)), color-stop(51%,rgba(117,34,1,1)), color-stop(100%,rgba(191,110,78,1))); 
background: -webkit-linear-gradient(top,  rgba(240,183,161,1) 0%,rgba(140,51,16,1) 50%,rgba(117,34,1,1) 51%,rgba(191,110,78,1) 100%); 
background: -o-linear-gradient(top,  rgba(240,183,161,1) 0%,rgba(140,51,16,1) 50%,rgba(117,34,1,1) 51%,rgba(191,110,78,1) 100%); /
background: -ms-linear-gradient(top,  rgba(240,183,161,1) 0%,rgba(140,51,16,1) 50%,rgba(117,34,1,1) 51%,rgba(191,110,78,1) 100%); 
background: linear-gradient(to bottom,  rgba(240,183,161,1) 0%,rgba(140,51,16,1) 50%,rgba(117,34,1,1) 51%,rgba(191,110,78,1) 100%); 
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f0b7a1', endColorstr='#bf6e4e',GradientType=0 ); 
*/
}
.shadow_plain{
background: url(<?php echo base_url(); ?>images/common/01-bar-shadow.png) no-repeat 0 0;
width: 970px;
height: 15px;
position: absolute;
}
#product_search {
height: 40px
}
#product_findstore {
height: 50px;
}

#product_featured {
/*height: 430px;*/
height:auto;
-webkit-transition: height 1.6s;
-moz-transition: height 1.6s;
transition: height 1.6s;
}
/*
    MAIN PRODUCT SECTION
 */
#product_featured .feature_detail,
#product_featured .product_big{
position:absolute;
margin-top: 30px;
display: inline-block;
}
#product_featured span{
position:relative;
}
#product_featured .product_big{
left: 70px;
}
#product_featured .feature_detail{
left:470px;
}
#product_related{
	overflow:visible;
}
#product_featured {
     min-height:430px;
     display:block;
     clear:both;
}
#sliderK{
    min-height:430px;
    overflow:hidden;width: 100%;
}
#sliderK>article{
    float:left;
    display:block;
    min-height:400px;
    position:relative;
}
.tech_specs .left,
.tech_specs .right{
float:left;    
width:50%;
min-height:400px;
display:inline;
}
.tech_specs .gfeatures{
    margin-top: 45px;font-size:35px;color:#595959;width:350px;display:block;line-height: 45px;
}
.tech_specs .features li{
    font-size:22px;
    line-height: 18px;
    margin-bottom: 12px;
    margin-left: 26px;
    color:#CCCCCC;
}
.tech_specs .product_main_img{
position: relative;
left: 60px;
height: 350px;
}
.tech_specs .feature_text,
.tech_specs .feature_subtext{
    position:relative;
    left:40px;
}
.gallery .feature_text,
.gallery .feature_subtext{
    position:relative;
    left:40px;
}
/**
 *     
 * the marketplace section is started at h
 */
.marketplace{
    display: block;
    width: 190px;
    position: absolute;
    left: 0;
}
.marketplace>div{
    margin-right:15px;
}
.appicon,.appicon img{
    width:60px;
    height:60px;
}
.appicon {
    left: -68px;
    position: absolute;
    top: 0;
}
.remark{
    font-size: 10px;
    clear: both;
    color: #409C0E;
    text-align: left;
    padding-top: 7px;
    line-height: 12px;
}

.appstore, .googleplay{
    width:79px;
    height:27px;
    float:left;
    cursor:pointer;
}
.appstore{
background:url(<?php echo base_url(); ?>images/common/button-download-app.png) no-repeat 0 0;
}
.appstore:hover,.appstore:active{
background:url(<?php echo base_url(); ?>images/common/button-download-app.png) no-repeat 0 -27px;
}
.googleplay{
background:url(<?php echo base_url(); ?>images/common/button-download-app.png) no-repeat -79px 0;
}
.googleplay:hover,.googleplay:active{
background:url(<?php echo base_url(); ?>images/common/button-download-app.png) no-repeat -79px -27px;
}.gallery .right,.gallery .left{
    display:block;
    width:50%;
    float:right;
    min-height:500px;
}
.gallery .thumb{
    width:100px;
    height:80px;
    overflow:hidden;
    float:left;
    margin:5px;
}
.gallery .thumb img{
    width:100px;
}
/*****/
ul.breadcum{
top: 12px;
left: 469px;
position: relative;
width: 500px;
}
ul.breadcum li{
list-style: none;
float: left;
background: url(<?php echo base_url(); ?>images/common/arrow_li.png) no-repeat 0 0px;
padding-left: 22px;
padding-right: 30px;
margin-bottom: 20px;
border-bottom: 1px solid #CCC;
padding-bottom: 10px;
}
ul.breadcum li:hover{
background: url(<?php echo base_url(); ?>images/common/arrow_li.png) no-repeat 0 -34px;
color:#409c0e;
cursor: pointer;
}
ul.breadcum li:active{
background-position:0 -68px;
color:#ccc;
}
ul.breadcum li.active{
background-position: 0 -102px;
color:#ccc;
}
.feature_text{
line-height: 40px;
font-size: 50px;
color: #00A5E7;
display: block;
clear:both;
}
.price{
margin: 16px;
display: block;
left: -17px;
height: 7px;
position: relative;
margin-top: 20px;
}
.price>span{
float:left;
}
.price .currency{
display: block;
position: relative;
bottom: -9px;
font-size:23px;color:#8C8C8C;
}
.price .amount{
font-size:48px;color:#409C0E;
}
#product_devices {
height: 58px;
margin-left: 120px;
width: 850px;
}
#product_devices .wrap{
margin-left: 25px;
margin-right: 48px;
}
#product_devices .wrap .box{
line-height: 18px;
height: 62px;
position: relative;
top: 1px;
text-align: right;
}
#product_devices .wrap .box .block{
margin:13px;
}
#product_devices .wrap .box img{
top: -6px;
position: relative;
}
#product_devices .wrap .box .block,
#product_devices .wrap .box img{
float:right;
margin-top: 0;
margin-bottom: 0;
}
#product_devices .arrow.right{
top: 6px;
right:6px;
z-index: 6;
}
#product_devices .arrow.left{
top: 6px;
z-index: 5;
}
#product_devices .banner{
position:absolute;
top:31px;
height:25px;
width:100%;
background: -moz-linear-gradient(top,  rgba(204,204,204,0.4) 1%, rgba(204,204,204,0.4) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(1%,rgba(204,204,204,0.4)), color-stop(100%,rgba(204,204,204,0.4))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(204,204,204,0.4) 1%,rgba(204,204,204,0.4) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(204,204,204,0.4) 1%,rgba(204,204,204,0.4) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(204,204,204,0.4) 1%,rgba(204,204,204,0.4) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(204,204,204,0.4) 1%,rgba(204,204,204,0.4) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#66cccccc', endColorstr='#66cccccc',GradientType=0 ); /* IE6-9 */
}
#product_devices .wrap{
position: absolute;
height: 60px;
overflow: hidden;
z-index: 1;
margin: 0 auto;
padding: 0;
position: relative;
overflow: hidden;
text-align: center;
}
.batch{
width: 101px;
height: 58px;
z-index: 0;
position: absolute;
background-color: #00A5E7;
-moz-border-left-radius: 3px;
-webkit-border-left-radius:3px;
border-top-left-radius:3px;
border-bottom-left-radius:3px;
}
.batch:before{
content: "";
width: 0;
height: 0;
left: 101px;
position: absolute;
border-top: 29px solid transparent;
border-left: 19px solid #00A5E7;
border-bottom: 29px solid transparent;
}
.batch span{
clear: both;
margin-left: 16px;
font-size: 18px;
color: white;
line-height: 1.5em;
}
.bbatch{
position: absolute;
z-index: 1;
float: left;
width: 971px;
height: 29px;
top: 29px;
background: -moz-linear-gradient(top,  rgba(204,204,204,0.4) 0%, rgba(204,204,204,0.4) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(204,204,204,0.4)), color-stop(100%,rgba(204,204,204,0.4))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(204,204,204,0.4) 0%,rgba(204,204,204,0.4) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(204,204,204,0.4) 0%,rgba(204,204,204,0.4) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(204,204,204,0.4) 0%,rgba(204,204,204,0.4) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(204,204,204,0.4) 0%,rgba(204,204,204,0.4) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#66cccccc', endColorstr='#66cccccc',GradientType=0 ); /* IE6-9 */

}
#product_devices .wrap .box .block .productname{
padding-bottom:8px;
font-weight:bold;
color:#666;
}
#product_devices .right,
#product_related .right,
#product_related .left{
position:absolute;
top:90px;
width:44px;
height:44px;
}
#product_devices .right{
top: 64px;
z-index: 1;
}
#product_related {

}
#product_related .right{
right:-24px;
}
#product_related .left{
left:-22px;
}
#product_related .nav{
position:relative;
}
#product_extra_a {
height: 85px;
}
#product_extra_b {
height: 130px;
}
#product_related .bottompart{
position: absolute;
bottom: 25px;
display: block;
width: 100px;
}
#product_related .fastlink .arrow_s{
width:17px;
height:17px;
margin-right:10px;
}
#product_related .fastlink div{
float:left;
}
#product_related .wrap{
height: 230px;
overflow:hidden;
clear: both;
padding-top:10px;
}
#product_related .wrap .box {
float: left;
height: 230px;
width: 312.5px !important;
border-right:1px solid #e6e6e6;
}
#product_related .wrap .box:last-child{
border:none;
}
#product_related .wrap .box img{
width:130px;
}
#product_related .wrap .box .img{
float: left;
overflow:hidden;
}
#product_related .wrap .box .block {
float: right;
text-align: left;
width:54.5%;
}
#product_related .wrap .box .block .productname,
#product_related .wrap .box .block .model,
#product_related .wrap .box .block .summary{
width:155px;
}
#product_related .wrap .box .block .productname{
color:#666;
font-size:19px;
}
.block .model{
font-size:10px;
color:#00a5e7;
}
#product_related .wrap .box .block .summary{
font-size:14px;
color:#000;
}
#product_related .wrap .box .block .fastlink,
#product_related .wrap .box .block .fastlink a{
display: inline-block;
font-size: 14px;
color: #00A5E7;
cursor: pointer;
text-decoration: none;
width: 160px;
padding: 0;
margin-top: 3px;
}

.fastlink .arrow_s{
background:url(<?php echo base_url(); ?>images/common/arrow-small.png) no-repeat 0 0;
}
.fastlink:hover .arrow_s{
background:url(<?php echo base_url(); ?>images/common/arrow-small.png) no-repeat 0 -17px;
}
.fastlink:active .arrow_s, .fastlink.active .arrow_s{
background:url(<?php echo base_url(); ?>images/common/arrow-small.png) no-repeat 0 -34px;
}
.buy_it_now{
width:135px;
height:42px;
display:block;
background:url(<?php echo base_url(); ?>images/common/button-buynow.png) no-repeat 0 0;
left: -7px;display: block;position: relative; cursor:pointer;
}
.marketplace a,
.buy_it_now a{
    display:block;
    width:100%;
    height:100%;
}
.buy_it_now:hover{
background-position:0 -42px;
}
.buy_it_now:active,.buy_it_now.active{
background-position:0 -84px;
}
.bjoinnow{
width:158px;
height:60px;
display:block;
background:url(<?php echo base_url(); ?>images/common/button-joinnow.png) no-repeat 0 0;
}
.bjoinnow:hover{
background-position:0 -60px;
}
.bjoinnow:active,.bjoinnow.active{
background-position:0 -120px;
}


/*  Horizontal CSS3 carousel
*/

#products_top {
width: 2000px;
left: 160px;
position: relative;
-webkit-animation: hscroll 12s infinite;
-moz-animation: hscroll 12s infinite;
-ms-animation: hscroll 12s infinite;
/*
*/
}
html{
background: rgb(255,255,255); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(255,255,255,1) 0%, rgba(242,242,242,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(100%,rgba(242,242,242,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(242,242,242,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(242,242,242,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(242,242,242,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(255,255,255,1) 0%,rgba(242,242,242,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f2f2f2',GradientType=0 ); /* IE6-9 */
}
@-webkit-keyframes hscroll {
0%   { left: -333px; }
27.33%  {left: -353px;}
33.33%  { left: -533px; }
60.66% { left: -433px; }
66.66% { left: -966px; }
94.99% { left: -1140px; }
100%  { left: -333px;}
}

@-moz-keyframes hscroll {
0%   { left: -333px; }
27.33%  {left: -353px;}
33.33%  { left: -533px; }
60.66% { left: -433px; }
66.66% { left: -966px; }
94.99% { left: -1140px; }
100%  { left: -333px;}
}

@-ms-keyframes hscroll {
0%   { left: -333px; }
27.33%  {left: -353px;}
33.33%  { left: -533px; }
60.66% { left: -433px; }
66.66% { left: -966px; }
94.99% { left: -1140px; }
100%  { left: -333px;}
}
/* extra _ a section */
#product_extra_a .part_a{
width:190px;
margin-left: 60px;
}
#product_extra_a .part_b{
font-size: 20px;
margin-right: 15px;
color:#409C0E;
text-align: right;
}
#product_extra_a .part_d{
top: -7px;
right: 14px;
position: relative;
float: right;
}
#product_extra_a>div{
float:left;
margin-top: 20px;
}
#product_extra_a .k1{
font-size:27px;
color:#409C0E;
text-transform:uppercase;
}
#product_extra_a .shadow_plain{
bottom: -14px;
}
#product_extra_a .k2{
clear:both;
color: #00A5E7;
font-size: 1.0em;
}
/*
Thumbnail scroller jQuery plugin
scrollers styling
*/
.jThumbnailScroller {
position: relative;
height: 230px;
padding: 0;
overflow: hidden;
-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
}
.jThumbnailScroller .jTscrollerContainer{position:absolute;}
.jThumbnailScroller .jTscroller{
position:relative;
height:100%;
margin:0;
left:0;
top:0;
display:inline-block;
*display:inline;
}
.jThumbnailScroller .jTscrollerNextButton,.jThumbnailScroller .jTscrollerPrevButton{
position:absolute;
display:block;
-moz-border-radius:22px;
-webkit-border-radius:22px;
border-radius:22px;
opacity:0.0;
width:44px !important;
height:44px !important;
}
.jThumbnailScroller:hover .jTscrollerNextButton,.jThumbnailScroller:hover .jTscrollerPrevButton{
-webkit-transition: opacity 0.6s;
-moz-transition: opacity 0.6s;
transition: opacity 0.6s;
opacity:0.8;
}
/*
.jThumbnailScroller .jTscrollerNextButton{background:#000 url(nextArrow.png) center center;}
.jThumbnailScroller .jTscrollerPrevButton{background:#000 url(prevArrow.png) center center;}
.jThumbnailScroller .jTscrollerNextButton:hover,.jThumbnailScroller .jTscrollerPrevButton:hover{background-color:#d56916; opacity:1;}
*/
.jThumbnailScroller .jTscroller>div{
display:block;
float:left;
margin:6px 10px 6px 0;
-moz-border-radius:3px;
-webkit-border-radius:3px;
border-radius:3px;
}
/*.jThumbnailScroller .jTscroller>div:hover{border-color:#fff;}*/
.jThumbnailScroller .jTscroller>div:first-child{margin-left:10px;}
.jThumbnailScroller .jTscroller>div img{border:none;}
/**/
#product_related_load .jTscrollerNextButton.right,
#product_related_load .jTscrollerPrevButton.left{
margin:-20px 10px 0 10px; top:50%;
}
#product_related_load .jTscrollerNextButton{right:0;}
#product_related_load .jTscrollerPrevButton{left:0;}
/* different styled scrollers */
/* liquid width scroller */
.jThumbnailScroller#tS1{width:95%;}
.jThumbnailScroller#tS2{margin:30px auto;}
.jThumbnailScroller#tS2 .jTscroller div{opacity:0.7;}
.jThumbnailScroller#tS2 .jTscroller div:hover{opacity:1;}
.jThumbnailScroller#tS2 .jTscrollerNextButton{margin:-20px 10px 0 10px; right:0; top:50%;}
.jThumbnailScroller#tS2 .jTscrollerPrevButton{margin:-20px 10px 0 10px; left:0; top:50%;}
/* a vertical scroller */
.jThumbnailScroller#tS3{position:absolute; left:40px; top:322px; width:122px; height:400px; margin:0; background:#eee;}
.jThumbnailScroller#tS3 .jTscroller{height:auto; margin-bottom:40px;}
.jThumbnailScroller#tS3 .jTscroller div{display:block; margin:0 6px 10px 6px; width:100px; overflow:hidden; opacity:0.7;}
.jThumbnailScroller#tS3 .jTscroller div:hover{opacity:1;}
.jThumbnailScroller#tS3 .jTscroller div:first-child{margin-top:50px;}
.jThumbnailScroller#tS3 .jTscrollerNextButton{
margin:10px 0 10px -20px; bottom:0; left:50%;
-moz-transform:rotate(90deg); -webkit-transform:rotate(90deg); -o-transform:rotate(90deg); -ms-transform:rotate(90deg);}
.jThumbnailScroller#tS3 .jTscrollerPrevButton{
margin:10px 0 10px -20px; top:0; left:50%;
-moz-transform:rotate(90deg); -webkit-transform:rotate(90deg); -o-transform:rotate(90deg); -ms-transform:rotate(90deg);}​
#flux_product{
	overflow:hidden;
}
#flux_product img{
	width:320px !important;
}
/*the elements inside the slider */
.feature_small_comment{
font-size: 14px;
color: #595959;
width: 450px;
display: block;
line-height: 16px;
}.feature_subtext{
    font-size:25px;color:#808080;margin-bottom: -10px;display:block;margin-top: -8px;
}
</style>