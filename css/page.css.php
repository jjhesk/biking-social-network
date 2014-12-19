<style type="text/css">
#product_findstore, #product_extra_a {
background: -moz-linear-gradient(left,  rgba(230,230,230,1) 0%, rgba(255,255,255,0.5) 50%, rgba(230,230,230,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(230,230,230,1)), color-stop(50%,rgba(255,255,255,0.5)), color-stop(100%,rgba(230,230,230,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(left,  rgba(230,230,230,1) 0%,rgba(255,255,255,0.5) 50%,rgba(230,230,230,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(left,  rgba(230,230,230,1) 0%,rgba(255,255,255,0.5) 50%,rgba(230,230,230,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(left,  rgba(230,230,230,1) 0%,rgba(255,255,255,0.5) 50%,rgba(230,230,230,1) 100%); /* IE10+ */
background: linear-gradient(to right,  rgba(230,230,230,1) 0%,rgba(255,255,255,0.5) 50%,rgba(230,230,230,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6e6e6', endColorstr='#e6e6e6',GradientType=1 ); /* IE6-9 */
}
#product_featured, #product_related {
background: rgb(255,255,255); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(255,255,255,1) 0%, rgba(255,255,255,1) 85%, rgba(230,230,230,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(85%,rgba(255,255,255,1)), color-stop(100%,rgba(230,230,230,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,1) 85%,rgba(230,230,230,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,1) 85%,rgba(230,230,230,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(255,255,255,1) 85%,rgba(230,230,230,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(255,255,255,1) 0%,rgba(255,255,255,1) 85%,rgba(230,230,230,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e6e6e6',GradientType=0 ); /* IE6-9 */
}

/*top nav menu control */
.index_nav_menu{
clear: both;
background: -moz-linear-gradient(left,  rgba(230,230,230,1) 0%, rgba(255,255,255,0.5) 50%, rgba(230,230,230,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(230,230,230,1)), color-stop(50%,rgba(255,255,255,0.5)), color-stop(100%,rgba(230,230,230,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(left,  rgba(230,230,230,1) 0%,rgba(255,255,255,0.5) 50%,rgba(230,230,230,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(left,  rgba(230,230,230,1) 0%,rgba(255,255,255,0.5) 50%,rgba(230,230,230,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(left,  rgba(230,230,230,1) 0%,rgba(255,255,255,0.5) 50%,rgba(230,230,230,1) 100%); /* IE10+ */
background: linear-gradient(to right,  rgba(230,230,230,1) 0%,rgba(255,255,255,0.5) 50%,rgba(230,230,230,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6e6e6', endColorstr='#e6e6e6',GradientType=1 ); /* IE6-9 */
height:50px;
position: relative;
border-radius:3px;
-webkit-box-shadow: 1px 1px 5px rgba(50, 50, 50, 0.6);
-moz-box-shadow:    1px 1px 5px rgba(50, 50, 50, 0.6);
box-shadow:         1px 1px 5px rgba(50, 50, 50, 0.6);
z-index: 5;
}
.index_nav_menu > div{
float:right;
cursor:pointer;
}
.index_nav_menu > div > div{
float:left;
}
.index_nav_menu .loginbut {
height:34px;
width:34px;
}
.index_nav_menu .loginedbut {
height:27px;
width:27px;
}
.index_nav_menu .text{
	padding: 7px;
	text-transform:uppercase;
}
.index_nav_menu.logined .text{
	padding: 4px;
	margin-left: -6px;
}
.index_nav_menu .loginlink{
	color:#514460; text-decoration: none;
}
.index_nav_menu > .tab{
float:left;
width:auto !important;
margin:0 !important;
}
.index_nav_menu.logined > .findstore_div > .loginbut,
.index_nav_menu.logined > .logout_div > .loginbut,
.index_nav_menu.logined > .username_div > .loginbut
{
	background: url(<?php echo base_url(); ?>images/common/icon-header-small.png) no-repeat 0 0;
}
.index_nav_menu.logined > .logout_div > .loginbut{
	background-position: 0px 0px;
}
.loginarea_logout_openid:hover > .loginbut,
.index_nav_menu.logined > .logout_div:hover > .loginbut,
.index_nav_menu.logined > .logout_div:active > .loginbut{
	background-position: 0px -27px;
}
.index_nav_menu.logined > .username_div > .loginbut{
	background-position: -54px 0px;
}
.index_nav_menu.logined > .findstore_div > .loginbut{
	background-position: -81px 0px;
}
.index_nav_menu.logined > .findstore_div:hover > .loginbut,
.index_nav_menu.logined > .findstore_div:active > .loginbut{
	background-position: -81px -27px;
}
.index_nav_menu.logined > .username_div > .loginbut{
	background-position: -54px 0px;
}
.index_nav_menu.logined > .username_div:hover > .loginbut,
.index_nav_menu.logined > .username_div:active > .loginbut{
	background-position: -54px -27px;
}
.index_nav_menu.logined > .username_div{
	width: auto;
	margin-right: 15px;
}
.loginarea_logout_openid >div{
	float:left;
}
.loginarea_logout_openid{
	width: auto !important;
	margin-right: 16px;
}
#myIFrame{display:none;}
.index_nav_menu > .search_div,
.index_nav_menu > .join_div,
.index_nav_menu > .find_div
{
	width:170px;
	margin-top: 9px;
}
.index_nav_menu > .find_div > .loginbut,
.index_nav_menu > .search_div > .loginbut,
.index_nav_menu > .join_div > .loginbut
{
	background: url(<?php echo base_url(); ?>images/common/icon-header-big.png) no-repeat 0 0;
}
.index_nav_menu > .join_div > .loginbut{
	background-position: -34px 0px;
}
.index_nav_menu > .find_div > .loginbut{
	background-position: -68px 0px;
}
.index_nav_menu > .find_div:hover > .loginbut,
.index_nav_menu > .find_div:active > .loginbut{
	background-position: -68px -34px;
}
.index_nav_menu > .join_div:hover > .loginbut,
.index_nav_menu > .join_div:active > .loginbut{
	background-position: -34px -34px;
}
.menuitem .main{
	padding-left: 10px;
}
.nav_menu .dinlight.big{
	text-transform: uppercase;
	font-size: 16px;
	width: 130px;
	color:#666;
}
.nav_menu .dinlight.small{
	text-transform:lowercase;
	font-size: 12px;
	margin-top: -7px;
	color:#a6a6a6;
}
.menuitem.active .dinlight.small{
	color:#666;
}
.menuitem.active .dinlight.big{
	 font-family: 'dinmedium';
	color:#333;
}
.menuitem:hover .dinlight.small{
	color:#ccc;
}
.menuitem:hover .dinlight.big{
	color:#a6a6a6;
}
.menuitem:active .dinlight.small,
.menuitem:active .dinlight.big{
	color:#333;
}
<?
	
?>

@media only screen and (min-width:1250px){
	/*the biggest screen size*/
	.mobile_hide{
		display:block;
	}
	.mobile_show{
		display:none;
	}
	.screen_hide{
		display:none;
	}
	/* Target landscape smartphones, portrait tablets, narrow desktops*/
	.wrapper{
    	width: 1290px;
    	margin:0px auto;
    	height: 100%;
    	/*overflow: hidden;
    	background:#FFFFFF;*/
	}
	#rightbar{
    	width: 970px;
    	margin-left: 280px;
	}
	#leftbar{
    	position: fixed;
    	height: 100%;
    	width: 260px;
    	-webkit-box-shadow:inset 0px -2px 0px 1px white, inset 0px -2px 1px 2px #D9D9D9, 0 0 2px 1px #DDD;
    	-moz-box-shadow:inset 0px -2px 0px 1px white, inset 0px -2px 1px 2px #D9D9D9, 0 0 2px 1px #DDD;
    	box-shadow: inset 0px -2px 0px 1px white, inset 0px -2px 1px 2px #D9D9D9, 0 0 2px 1px #DDD;
    	z-index: 9999;
	}
	#logo{
    	height: 170px;
    	text-align: center;
	}
	#logo img{
		padding-top:30px;
	}
	.alpha{
    	background: url(<?php echo base_url(); ?>images/navigation_bar/00-tape-alpha.png) no-repeat 0 0;
    	width: 86px;
    	height: 40px;
    	position: absolute;
    	top: 90px;
    	left: -8px;
	}
	
	.header_banner_background{
    	height: 63px;
        top: 10px;
        position: relative;
	}
	/*.index_nav_menu{
	top: 105px !important;
	}*/
	.menuitem{
    	padding-top:10px;
    	position:relative;
    	width:238px;
    	/*height:50px;*/
    	display: inline-block;
	}
	.menuitem ul{
	    margin-bottom: 8px;
margin-top: 3px;
display: inline-block;
	}
	.menuitem li{
 line-height: 18px;
margin-bottom: 3px;
clear: both;
margin-left: 72px;
margin-top: 0px;
	}
	.menuitem li a{
	    color:#409c0e;
	}
	#navigation_bar{
	   padding-right:8px; margin-top:20px;
    }
    .firstlogin_warning_message{
        left: 229px;
        top: 0px;
    }
    .firstlogin_warning_message.demopage{
        left: -21px;
        top: 60px;
    }
}

@media only screen  and (min-width:480px) and (max-width:1250px) {
/* 
Target landscape smartphones, portrait tablets, narrow desktops
*/
	.ipad_hide{
		display:none;
	}
	.screen_hide{
		display:block;
	}
	.mobile_show{
		display:block;
	}

	.wrapper{
	width: 980px;
	height: 100%;
	margin:0 auto;
	}
	#leftbar{
	width:100%;
	}
	#rightbar{
    	margin-left: 0px!important;
    	width:970px;
	}
	#logo{
    	float: left;
	}
	#logo img{
    	padding-top: 7px;
    	height: 100px;
	}
	.alpha{
    	background: url(<?php echo base_url(); ?>images/navigation_bar/00-tape-alpha.png) no-repeat 0 0;
    	width: 80px;
    	height: 40px;
    	position: relative;
    	top: 8px;
    	left: 0px;
	}
	.index_nav_menu{
    	top: 0px !important;
	}
	.firstlogin_warning_message{
        left: 9px;
        top: 40px
    }
	.menuitem{
		position: relative;
		display: block;
		float: left;
		width:230px;
		height: 50px;
	}
	.menuitem ul{
	    display:none;
	}
	.firstlogin_warning_lightblub{
		left: 90px;
 	   	position: relative;
    	
	}
	.firstlogin_leftbar_message{
		position: relative; 
		left: -45px;
		width: 150px;

	}
	.main.small{
	    white-space: nowrap;
	}
	/*
	.firstlogin_warning_message{
		top: 45px;
	}
	*/
	.menuitem .big{
		position: absolute;
		left: 43px;
		top: -3px;
	}
	.menuitem .small{
		position: absolute;
		top: 21px;
		left: 43px;
	}
	#navigation_bar{
		padding-right:8px; margin-top:0px;
	}
	
}

@media screen and (max-width:480px) {
/*Target portrait smartphones*/
	.mobile_hide{
		display:none;
	}
	.mobile_show{
		display:block;
	}
}

.nav_menu>div>div,
.nav_menu>.menuitem>a>div{
float:left;
}
.devices,.community,.profile,.newsfeed,.settings,.devices:hover,.community:hover,.profile:hover,.newsfeed:hover,
.settings:hover,.devices:active,.community:active,.profile:active,.newsfeed:active,
.settings:active,.devices.active,.community.active,.profile.active,.newsfeed.active,.settings.active{
background: url(<?php echo base_url(); ?>images/common/menu-icon.png) no-repeat 0 0;width:45px;height:30px;
}
.devices{
background-position: 0 0;
}
.profile{
background-position:  -45px 0;
}
.newsfeed{
background-position: -90px 0;
}
.community{
background-position: -135px 0;
}
.settings{
background-position: -180px 0;
}
.menuitem:hover .devices{
background-position: 0 -30px;
}
.menuitem:hover .profile{
background-position:  -45px -30px;
}
.menuitem:hover .newsfeed{
background-position: -90px -30px;
}
.menuitem:hover .community{
background-position: -135px -30px;
}
.menuitem:hover .settings{
background-position: -180px -30px;
}
.menuitem:active .devices{
background-position: 0 -60px;
}
.menuitem:active .newsfeed{
background-position:  -90px -60px;
}
.menuitem:active .profile{
background-position: -45px -60px;
}
.menuitem:active .community{
background-position: -135px -60px;
}
.menuitem:active .settings{
background-position: -180px -60px;
}
.devices.active{
background-position: 0 -90px;
}
.profile.active{
background-position:  -45px -90px;
}
.newsfeed.active{
background-position: -90px -90px;
}
.community.active{
background-position: -135px -90px;
}
.settings.active{
background-position: -180px -90px;
}



.content_image{
background-image: url(<?php echo base_url(); ?>images/index/images.png);
background-repeat: repeat-y;
width:685px;
height:244px;

}

.personal_info{
	background-image: linear-gradient(bottom, rgb(237,237,237) 45%, rgb(250,250,250) 73%);
	background-image: -o-linear-gradient(bottom, rgb(237,237,237) 45%, rgb(250,250,250) 73%);
	background-image: -moz-linear-gradient(bottom, rgb(237,237,237) 45%, rgb(250,250,250) 73%);
	background-image: -webkit-linear-gradient(bottom, rgb(237,237,237) 45%, rgb(250,250,250) 73%);
	background-image: -ms-linear-gradient(bottom, rgb(237,237,237) 45%, rgb(250,250,250) 73%);
	background-image: -webkit-gradient(
		linear,
		left bottom,
		left top,
		color-stop(0.45, rgb(237,237,237)),
		color-stop(0.73, rgb(250,250,250))
	);
	width:280px;
	height:290px;
	float:left;
	margin-top:10px;
	border:1px solid #ABABAB;
	position:relative;
}
.index_speed{
background-image: url(<?php echo base_url(); ?>images/index/speed.png);
background-repeat: repeat-y;
width:971px;
height:52px;

}

.index_content1{
width:278px;
height:455px;

}
.index_content2{
width:220px;
height:455px;
}
.index_content3{
width:460px;
height:455px;

}
.index_profile_img{
background-image: url(<?php echo base_url(); ?>images/index/profile_img.png);
background-repeat: repeat-y;
width:122px;
height:163px;
}
.index_profile_btn{
background-image: url(<?php echo base_url(); ?>images/profile_page/round-button.png);
background-repeat: repeat-;
float:left;
width:70px;
height:70px;
}

.index_profile_button {

display: inline-block;
outline: none;
cursor: pointer;
text-align: center;
text-decoration: none;
font: 20px/100% Arial, Helvetica, sans-serif;
padding: .5em 2em .7em;
text-shadow:10 1px 1px rgba(0,0,0,.3);
-webkit-border-radius: .5em;
-moz-border-radius: .5em;
border-radius: .50em;
-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
-moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
box-shadow: 0 5px 5px rgba(0,0,0,.2);

border-radius:90px;
khtml-border-radius:90px;
moz-border-radius:90px;
webkit-border-radius:90px;
}
.index_profile_button:hover {
text-decoration: none;
}
.index_profile_button:active {
position: relative;
top: 1px;
}

.index_p{
padding: 25px 0 0 30px;
color:#2697DD;
font-size:25px;

}

#container {
height:244px;
margin:0px auto 0px;
padding: 10px;
font-size:12px;
}

.index_block_shadow{
-webkit-box-shadow: 1px 1px 5px rgba(50, 50, 50, 0.6);
-moz-box-shadow:    1px 1px 5px rgba(50, 50, 50, 0.6);
box-shadow:         1px 1px 5px rgba(50, 50, 50, 0.6);
}

.index_round_corners{
-webkit-border-radius: .3em;
-moz-border-radius: .3em;
border-radius: .30em;
}

.nyro_icon {
background-image: url(<?php echo base_url(); ?>/images/icon/02-icon-popup-00.png);
background-repeat: no-repeat;
width:18px;
height:18px;
position:relative;
top:1px;
}

.nyro_icon:hover {
background-image: url(<?php echo base_url(); ?>/images/icon/02-icon-popup-01.png);
background-repeat: no-repeat;
width:18px;
height:18px;
}

.index_block_summary{
width:970px;
height:80px;
color:#F2F2F2;
background-color:#D9D9D9;
}

.index_block_calendar {
width: 970px;
height:60px;
text-align:center;
}

.index_block_a_header {
background-color:#333333;
width:235px;
height:35px;
color:#F2F2F2;
}

.index_block_a_body {
background-color:#333333;
width:235px;
height:104px;
margin-top:1px;
color:#F2F2F2;
float: left;
}

.index_block_b_header {
background-color:#333333;
width:480px;
height:35px;
color:#F2F2F2;
}

.index_block_b_body {
background-color:#333333;
width:480px;
/*height:104px;*/
height: auto;
margin-top:1px;
}

.index_block_c_header {
background-color:#333333;
width:480px;
height:35px;
color:#F2F2F2;
}

.index_block_c_body {
background-color:#333333;
width:480px;
height:254px;
margin-top:1px;
color:#F2F2F2;
}

#index_title{
float:right;
font-size:30px;
position:relative; bottom:8px;
color:#FFFFFF;
text-decoration: none;
}
.index_feed{
border-style:solid;
border-bottom:10px;
border-left:10px;
border-right:10px;
padding:5px;
margin-top:1px;
color:#999999;
height:47px;
}
.index_feature{
padding:5px;
margin-top:1px;
height:85px;
color:#FFFFFF;
}

.index_feature2{
padding:5px;
margin-top:1px;
height:85px;
color:#FFFFFF;
background-color:#555555;
}
.comments_break{
background-image: url(<?php echo base_url()?>images/comments_box/03-border-zigzag.png);
background-repeat: repeat-y;	
}

#login_page_area1{
background-image: url(images/login/singin-bg.png);
background-repeat: repeat-y;
width: 600px;
height: 785px;
}
#login_page_big_logo{
background-image: url(images/login/signin-logo.png);
background-repeat: no-repeat;
position: relative;
top: 100px;
left: 40px;
width: 510px;
height: 415px;
}
#login_page_description{
position: relative; left: 95px; top: 105px;
width: 500px;
}

#login_page_description1{
font-family: fontface1;
color: #409C0E;
font-size: 16px;
}
#login_area_button{
position: relative;
left: 75px; top: 110px;
width: 445px;
}
#login_button_google,
#login_button_yahoo,
#login_button_facebook{
width:112px; height: 125px;
background-repeat: no-repeat;
cursor:pointer;
text-decoration:none;
}

#login_button_google{
background: url(<?php echo base_url()?>images/login/social_login.png) 0 0;
}
#login_button_google:hover{
background: url(<?php echo base_url()?>images/login/social_login.png) 0 -125px;
}
#login_button_yahoo{
background: url(<?php echo base_url()?>images/login/social_login.png) -220px 0;
}
#login_button_yahoo:hover{
background: url(<?php echo base_url()?>images/login/social_login.png) -220px -125px;
}
#login_button_facebook{
background: url(<?php echo base_url()?>images/login/social_login.png) -110px 0;
}
#login_button_facebook:hover{
background: url(<?php echo base_url()?>images/login/social_login.png) -110px -125px;
}
.blue_txt{
	color: #00A5E7;
}
.blue{
background-color: #00A5E7;
}

.green{
background-color: #00C27C;
}

.purple{
background-color: #BD77E8;
}

.yellow{
background-color: #F0A23F;
}

.red{
background-color: #FF5168;
}
.font_marcellus{
font-family: 'Marcellus SC', serif;

}
.profile_gradient{
background: -moz-linear-gradient(left,  rgba(251,251,251,1) 0%, rgba(251,251,251,0.88) 11%, rgba(251,251,251,0) 90%, rgba(251,251,251,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(251,251,251,1)), color-stop(11%,rgba(251,251,251,0.88)), color-stop(90%,rgba(251,251,251,0)), color-stop(100%,rgba(251,251,251,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(left,  rgba(251,251,251,1) 0%,rgba(251,251,251,0.88) 11%,rgba(251,251,251,0) 90%,rgba(251,251,251,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(left,  rgba(251,251,251,1) 0%,rgba(251,251,251,0.88) 11%,rgba(251,251,251,0) 90%,rgba(251,251,251,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(left,  rgba(251,251,251,1) 0%,rgba(251,251,251,0.88) 11%,rgba(251,251,251,0) 90%,rgba(251,251,251,1) 100%); /* IE10+ */
background: linear-gradient(to right,  rgba(251,251,251,1) 0%,rgba(251,251,251,0.88) 11%,rgba(251,251,251,0) 90%,rgba(251,251,251,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fbfbfb', endColorstr='#fbfbfb',GradientType=1 ); /* IE6-9 */
}
#footer{
	position: relative;
	text-align: center;
	background:none;
	height:auto !important;
padding-bottom: 50px;
}
#footer .footerplain{
	background: url(<?php echo base_url(); ?>images/common/01-bar-shadow.png) no-repeat 0 0 !important;
	width: 100%;
height: 16px;
border-top: 1px solid #D9D9D9;
}
#footer a, #footer span{
	z-index: 99;
	margin-right:10px;
	padding-right:10px;
	border-right:1px solid #ccc;
	text-decoration:none;
	cursor:pointer;
}

#footer span{
	cursor:default;
}

#footer a:first-child{
	margin-right:0px;
	border-left:1px solid #ccc;
}

#footer a:last-child{
	margin-right:0px;
	border-right:none;
}


.sampledata{
left: 100px;
top: 250px;
position: absolute;
text-transform: uppercase;
font-size: 130px;
color: #BBB;
line-height: 1em;
z-index:999;
transform: rotate(30deg);
-ms-transform: rotate(30deg); /* IE 9 */
-webkit-transform: rotate(30deg); /* Safari and Chrome */
-o-transform: rotate(30deg); /* Opera */
-moz-transform: rotate(30deg); /* Firefox */
}
#product_featured 
.sampledata{
left: 450px;
top: 180px;
}
/*
html, body {
	
		 -webkit-animation: fadeIn 1s ease;
		 -moz-animation: fadeIn 1s ease;
		 -ms-animation: fadeIn 1s ease;
		 -o-animation: fadeIn 1s ease;
		 animation: fadeIn 1s ease;

}
*/


.hidden_message.disable .firstlogin_warning_message{
	-webkit-animation: flipOutY 1s ease;
	-moz-animation: flipOutY 1s ease;
	-ms-animation: flipOutY 1s ease;
	-o-animation: flipOutY 1s ease;
	animation: flipOutY 1s ease;
}

.hidden_message.active .firstlogin_warning_message{
	-webkit-animation: flipInY 1s ease;
	-moz-animation: flipInY 1s ease;
	-ms-animation: flipInY 1s ease;
	-o-animation: flipInY 1s ease;
	animation: flipInY 1s ease;
	opacity:1.0;
}

.firstlogin_warning_lightblub{
	float:left; padding-left: 0px;	
	padding-top: 0px;
}
.firstlogin_warning_message{
opacity:0;
float:left; 
border-radius: 0.3em 0.3em 0.3em 0.3em;
border: 1px solid #C1C1C1;
background-color: #E6E6E6;
z-index: 3;
padding: 10px;
line-height: 25px;
position: absolute;
display: block;
width: 200px;
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.80);
    -moz-box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.80);
    -webkit-box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.80);
    cursor:default;
}
#google_translate_element{
    text-align:center;
}
<?php
/*
include_once ('animation.css');
include_once ('hesk.css');
include_once ('max_css.php');
//include_once ('animate_btncss.php');
include_once ('shadow_image.css');
include_once ('font.css');
include_once ('ui.css');
include_once ('comments.css.php');*/
?>
/*=================================================================================================*/



/*=================================================================================================*/
</style>

