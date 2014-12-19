<?php 

?><style type="text/css">

* {
  box-sizing: border-box;
}

html, body {
  min-height: 100%;
  background:url(<?php echo base_url()."application/views/webview_apps/petnfans/image/bg.png";?>);
  background-repeat:repeat;
}

a {
  text-decoration: none;
}
/* ----- heskemo editions ----- */
	body * {
		-webkit-tap-highlight-color: rgba(255,255,255,0)
	}
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
/*jquery mobile */
.ui-loader-default{
    display:none;
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
}
/**
 *     
 *   USER RSLIDER CONTROL ONE
 *
 */
#communityView{
    
}
.main-header {
  background: -webkit-linear-gradient(#3f94bf, #246485);
  background: linear-gradient(#3f94bf, #246485);
  padding: 5px;
  text-align: center;
  color: white;
  text-shadow: #222222 0px -1px 1px;
  position: fixed;
  width: 100%;
  left: 0;
  -webkit-transition: all 0.3s ease;
  display: block;
}
.main-header .toggle-menu {
  position: absolute;
  left: 10px;
  top: 10px;
  color: white;
  font-size: 32px;
  cursor: pointer;
}
.main-header h1 {
  font-size: 18px;
}

.page-wrap {
  float: right;
  width: 100%;
  -webkit-transition: width 0.3s ease;
  position: relative;
  overflow: hidden;
}

.main-nav-check {
  display: none;
}

.main-nav {
  position: fixed;
  top: 0;
  width: 0;
  height: 100%;
  background: #3B3B3B;
  overflow: hidden;
  -webkit-transition: width 0.3s ease;
  transition: width 0.3s ease;
}
.main-nav a {
  display: block;
  background: -webkit-linear-gradient(#3e3e3e, #383838);
  background: linear-gradient(#3e3e3e, #383838);
  border-top: 1px solid #484848;
  border-bottom: 1px solid #2E2E2E;
  color: white;
  padding: 15px;
}
.main-nav a:hover, .main-nav a:focus {
  background: -webkit-linear-gradient(#484848, #383838);
  background: linear-gradient(#484848, #383838);
}
.main-nav:after {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  height: 100%;
  width: 34px;
  background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.4));
  background: linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.4));
}

.close-menu {
  display: none;
}

#main-nav-check:checked + #main-nav {
  width: 20%;
}

#main-nav-check:checked ~ .page-wrap {
  width: 80%;
}
#main-nav-check:checked ~ .page-wrap .open-menu {
  display: none;
}
#main-nav-check:checked ~ .page-wrap .close-menu {
  display: block;
}
#main-nav-check:checked ~ .page-wrap .main-header {
  width: 80%;
  left: 20%;
}

.content > section {
  position: absolute;
  display: block;
}

.content {
  padding: 0px;
  padding-top: 0px;
  display: block;
}
.content article {
  position: relative;
  display: inline-block;
  width: 100%;
  /*background-color: #343434;*/
  color:white;
  /*background-color: rgba(255, 255, 255, 0.5);*/
  /*background:url(<php echo base_url()."application/views/webview_apps/petnfans/image/bg.png";?>);*/
}
.content article .Q {
  background-image:url(<?php echo base_url()."application/views/webview_apps/petnfans/image/q.png";?>);
 display: inline-block;
    font-size: 0;
    height: 60px;
    position: absolute;
    width: 40px;
    top: 6px;
}
.content article .slidename{
  font-size: 25px;  display: inline-block;
}
.content article.communitytopic .wrapper {
  display: inline-block;
  left: 40px;
  position: relative;
  top: 0;
  width: auto;
  margin-bottom: 10px;
  margin-top: 10px;
}
.content article .updatetime{
    font-size:10px;
}
.content article .wrapper .question, .content article .wrapper .smallanswer {
  position: relative;
  left: 0px;
  display: block;
  clear: both;
  line-height: 30px;
}
.content article .bubble {
  background-origin: padding-box;
    background-position: 0 0;
    background-repeat: no-repeat;
    background-size: 40% auto;
    font-size: 17px;
    height: 38px;
    line-height: 24px;
    position: absolute;
    right: 21px;
    text-align: left;
    text-indent: 32px;
    top: 25px;
    width: 79px;
    background-image:url(<?php echo base_url()."application/views/webview_apps/petnfans/image/bubble.png";?>);
}
.content article .readmore {
    background-repeat: no-repeat;
    background-size: 100% 100%;
    cursor: pointer;
    height: 50px;
    position: absolute;
    right: -3px;
    top: 15px;
    width: 50px;
  background-image:url(<?php echo base_url()."application/views/webview_apps/petnfans/image/arrow.png";?>);
}
/*FOR COMMUNITY DISCUSSION PART*
.content article.communityTopic:before{
   background-color: rgba(255, 255, 255, 0.5);
    border-radius: 10px 10px 10px 10px;
    box-shadow: 0 0 2px 2px white inset;
    content: " ";
    display: inline-block;
    height: 85%;
    margin: 5px;
    position: absolute;
    width: 100%;
    z-index: 0;
    min-width: 480px;
}*/
article.communityTopic:before{
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 10px 10px 10px 10px;
    box-shadow: 0 0 2px 2px white inset;
    content: " ";
    display: inline-block;
    margin: 5px;
    position: absolute;
    width: 99%;
    height:90%;
    z-index: 0;
    min-width: 480px;
    text-align:center;
}
article.communityTopic .answer{
    color:yellow;
}
article.discussionThread:before{
    bottom:2px;
    width:98%;
    content: " ";
    margin-left: 5px;
    position: absolute;
    border-radius: 50% 50% 50% 50%;
    height: 5px;
    background-color: rgba(255, 255, 255, 0.50);
}
article.discussionThread .wrapper{
     width:100%;
     margin-left:0px
}
article.discussionThread .updatetime{
position: absolute;
top: 6px;
right: 3px;
text-align: right;
}
.topbanner{
    width:100%;
    background-color: rgba(255, 255, 255, 0.50);
    text-align:center;
    color:white;
}
@media only screen and (min-width: 0px) and (max-width: 480px) {
    article.communitytopic .wrapper{
        width:200px;
    }
    article.communitytopic .wrapper .question{
         line-height: 20px;
         width:150px;
    }
    article.communitytopic{
        min-height:80px;
    }
    article.communitytopic:before{
       width: 98%;
       min-width:98%;
       max-width: 450px;
       margin-left: 3px;
    }
    article.discussionThread .wrapper{
         width:280px;
         left: 0px;
    }
}
@media only screen and (min-width: 481px) {
    .content article .bubble{
         right: 51px;
    }
    .content article .readmore{
      right: 17px;
  }
}
article.discussionThread .username{
    font-size: 18px;
    line-height: 26px;
    padding-left: 3px;
    white-space: nowrap;
    width: 100px;
}
.content article.discussionThread .response{
    display:inline-block;
    margin-bottom:10px;
    padding-left: 3px;
}
/**
 *     #response_input_community styling
 */
#response_input_community{
    position:fixed;
    top:0px;
    width:100%;
}
#response_input_community .textinput{
    width:80%;
}
#response_input_community .sendinput{
    width:20%;
    background: rgb(255,197,120);
    background: -moz-linear-gradient(-45deg,  rgba(255,197,120,1) 0%, rgba(251,157,35,1) 100%);
    background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(255,197,120,1)), color-stop(100%,rgba(251,157,35,1)));
    background: -webkit-linear-gradient(-45deg,  rgba(255,197,120,1) 0%,rgba(251,157,35,1) 100%);
    background: -o-linear-gradient(-45deg,  rgba(255,197,120,1) 0%,rgba(251,157,35,1) 100%);
    background: -ms-linear-gradient(-45deg,  rgba(255,197,120,1) 0%,rgba(251,157,35,1) 100%);
    background: linear-gradient(135deg,  rgba(255,197,120,1) 0%,rgba(251,157,35,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffc578', endColorstr='#fb9d23',GradientType=1 );
}
#response_input_community > input{
    display:inline-block;
    float:left;
    font-size: 40px;
    height: 52px;
}
#response_input_community > input.sendinput{
    font-size: 10px;
}
#communityView #discussions{
    margin-bottom:30px;
}
.rsSlide #discussions{
    padding-top:50px;
}
.rsSlide #discussions:before{
    content:"wipe me to go back >>>";
    display:block;
    width:100%;
    position:absolute;
    top:0px;
    color:white;
    font-size:30px;
    line-height:30px;
    text-align:center;
    
    
}
/* -----------------------------------------
 FOR NEWS ONLY
 ----------------------------------------- */
.content article .image{
     /*---------------DEFAULT IMAGES-------------------------- */
    background:url(<?php echo base_url()."application/views/webview_apps/petnfans/image/arrow.png";?>);
}
</style>