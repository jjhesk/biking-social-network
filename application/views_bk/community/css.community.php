<style>
*,*:after,*:before {
box-sizing:border-box;
-moz-box-sizing:border-box;
-webkit-box-sizing:border-box;
}
.producticon,.rightsideproductinfo{
width:350px;
float:left;
overflow:hidden;
}
.producticon{
width: 350px;
top: 10px;
position: relative;
}
.producticon img{
width:350px;
}
.rightsideproductinfo{
width:600px;
}
.productname, .marketplace{
float: left;
height: 100px;
margin-top: 30px;
}
.productname .big{
font-size: 65px;
color: #00A5E7;
line-height: 76px;
}
.productname .small{
font-size:18px;
color:#808080;
}
/**
*
* the marketplace section is started at h
*/
.marketplace{
display: block;
width: 190px;
position: absolute;
right: 0;
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

.appstore, .googlepaly{
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
.googlepaly{
background:url(<?php echo base_url(); ?>images/common/button-download-app.png) no-repeat -79px 0;
}
.googlepaly:hover,.googlepaly:active{
background:url(<?php echo base_url(); ?>images/common/button-download-app.png) no-repeat -79px -27px;
}
.row>div{
float:left;
}
.bar1,.bar2{
 margin: 2px;
clear:both;
height:100px;
background: rgb(230,230,230);
background: -moz-linear-gradient(left,  rgba(230,230,230,1) 0%, rgba(255,255,255,1) 100%);
background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(230,230,230,1)), color-stop(100%,rgba(255,255,255,1)));
background: -webkit-linear-gradient(left,  rgba(230,230,230,1) 0%,rgba(255,255,255,1) 100%);
background: -o-linear-gradient(left,  rgba(230,230,230,1) 0%,rgba(255,255,255,1) 100%);
background: -ms-linear-gradient(left,  rgba(230,230,230,1) 0%,rgba(255,255,255,1) 100%);
background: linear-gradient(to right,  rgba(230,230,230,1) 0%,rgba(255,255,255,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6e6e6', endColorstr='#ffffff',GradientType=1 );
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;
-o-box-shadow: 0 0 0 1px #ccc;
-moz-box-shadow: 0 0 0 1px #ccc;
-webkit-box-shadow: 0 0 0 1px #ccc;
box-shadow: 0 0 0 1px #ccc;
margin-bottom: 30px;
}
.bar1>div,.bar2>div{
float:left;
margin-top: 30px;
}
.part_a{
width:190px;
margin-left: 60px;
}
.part_b{
font-size: 18px;
margin-right: 23px;
margin-left: 35px;
color:#409C0E;
text-align: right;
letter-spacing: -1px;
}
.part_e{
font-size: 52px;
color: #666;
line-height: 43px;
font-family: 'dinmedium';
font-weight: bold;
}
.part_f{
font-size: 15px;
color: #666;
padding-top: 20px;
padding-left: 9px;
}
.part_d{
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
#product_extra_a .k2{
clear:both;
color: #00A5E7;
font-size: 1.0em;
}
#profile_pic{
-moz-transform: scale(0.7);
-webkit-transform: scale(0.7);
/*zoom: 0.7;*/
left: 0px;
top: -30px;
}
#name_tag{
position: relative;
font-size: 23px;
text-align: left;
display: block;
width: 170px;
}
.fastlink li{
list-style:none;
margin-left:22px;
padding-left:22px;
background: url(<?php echo base_url(); ?>images/common/arrow_li.png) no-repeat 0 0px;
}
.fastlink li:hover {
color: #409c0e;
cursor: pointer;
background-position: 0 -34px;
}
.fastlink li:active {
background-position: 0 -68px;
color: #ccc;
}
.fastlink li.active {
background-position: 0 -102px;
}
.fastlink li a {
color: #00A5E7;
text-decoration: none;
}
.fastlink li:hover a {
color: #409c0e;
}
.fastlink li:active a {
color: #999;
}
.more {
margin-top: 43px !important;
}
section.topface {
background: -moz-linear-gradient(left, rgba(230, 230, 230, 1) 0%, rgba(255, 255, 255, 0.5) 50%, rgba(230, 230, 230, 1) 100%);
background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(230, 230, 230, 1)), color-stop(50%,rgba(255, 255, 255, 0.5)), color-stop(100%,rgba(230, 230, 230, 1)));
background: -webkit-linear-gradient(left, rgba(230, 230, 230, 1) 0%,rgba(255, 255, 255, 0.5) 50%,rgba(230, 230, 230, 1) 100%);
background: -o-linear-gradient(left, rgba(230, 230, 230, 1) 0%,rgba(255, 255, 255, 0.5) 50%,rgba(230, 230, 230, 1) 100%);
background: -ms-linear-gradient(left, rgba(230, 230, 230, 1) 0%,rgba(255, 255, 255, 0.5) 50%,rgba(230, 230, 230, 1) 100%);
background: linear-gradient(to right, rgba(230, 230, 230, 1) 0%,rgba(255, 255, 255, 0.5) 50%,rgba(230, 230, 230, 1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6e6e6', endColorstr='#e6e6e6'
,GradientType=1 );
width: 100%;
height: 400px;
position: relative;
}
.cruv_feature {
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;
-o-box-shadow: 0 0 0 1px #ffffff, 0 0 0 2px #D9D9D9;
-moz-box-shadow: 0 0 0 1px #ffffff, 0 0 0 2px #D9D9D9;
-webkit-box-shadow: 0 0 0 1px #ffffff, 0 0 0 2px #D9D9D9;
box-shadow: 0 0 0 1px #ffffff, 0 0 0 2px #D9D9D9;
border-radius: 3px 3px 3px 3px;
box-shadow: 0 0 0 1px #FFFFFF, 0 0 0 2px #D9D9D9;
margin-top: 10px;
}
.discussion > article {
display: inline-block;
width: 100%;
position: relative;
}
.comment.cruv_feature {
margin-bottom: 0px;
}
.dislike_icon, .like_icon, .emot_smile, .emot_sad, .emot_blank, .emot_oops {
width: 15px;
height: 15px;
background: url(<?php echo base_url(); ?>images/comments_box/buttons_face.png) no-repeat 0 0px;
	margin-top:5px;
	}
	.like_icon {
		background-position: 0 0;
	}
	.num_likes:hover .like_icon {
		background-position: 0px -30px;
	}
	.num_likes:active .like_icon, .num_likes.active .like_icon {
		background-position: 0px -46px;
	}
	.dislike_icon {
		background-position: -15px 0;
	}
	.num_dislikes:hover .dislike_icon {
		background-position: -15px -30px;
	}
	.num_dislikes:active .dislike_icon, .num_dislikes.active .dislike_icon {
		background-position: -15px -46px;
	}
	.emot_smile {
		background-position: -30px 0;
	}
	.smile:hover .emot_smile {
		background-position: -30px -30px;
	}
	.smile:active .emot_smile, .smile.active .emot_smile {
		background-position: -30px -46px;
	}
	.emot_sad {
		background-position: -45px 0;
	}
	.sad:hover .emot_sad {
		background-position: -45px -30px;
	}
	.sad:active .emot_sad, .sad.active .emot_sad {
		background-position: -45px -46px;
	}
	.emot_oops {
		background-position: -60px 0;
	}
	.oops:hover .emot_oops {
		background-position: -60px -30px;
	}
	.oops:active .emot_oops, .oops.active .emot_oops {
		background-position: -60px -46px;
	}
	.emot_blank {
		background-position: -75px 0;
	}
	.blank:hover .emot_blank {
		background-position: -75px -30px;
	}
	.blank:active .emot_blank, .blank.active .emot_blank {
		background-position: -75px -46px;
	}
	.discussion .name {
		color: #00A4E7;
		display: inline-block;
		font-size: 19px;
		font-weight: bold;
		letter-spacing: -1px;
		line-height: 20px;
		margin-top: 13px;
		white-space: nowrap;
	}
	.discussion .name a {
		color: #00A4E7;
		text-decoration: none;
	}
	.discussion .comment .comm_img {
		width: 50px;
		text-align: top;
		vertical-align: top;
		margin: 10px;
		height: 50px;
		overflow: hidden;
		/*-webkit-border-radius: 6px;
		 -moz-border-radius: 6px;
		 border-radius: 6px;
		 -webkit-transition: all 0.5s ease-in;
		 -moz-transition: all 0.5s ease-in;
		 transition: all 0.5s ease-in;
		 -webkit-box-shadow: 0px 0px 0px 1px rgb(30, 44, 36), 0px 0px 3px 2px rgb(145, 163, 185), 0 0 2px 1px #DDD;
		 -moz-box-shadow: 0px 0px 0px 1px rgb(30, 44, 36), 0px 0px 3px 2px rgb(145, 163, 185), 0 0 2px 1px #DDD;
		 box-shadow:  0px 0px 0px 1px rgb(30, 44, 36), 0px 0px 3px 2px rgb(145, 163, 185), 0 0 2px 1px #DDD;*/
	}
	.discussion .comment .comm_img img {
		width: 50px;
		height: auto;
	}
	.disscussion .content {
		width: 100%;
	}
	.comment_main_text {
		font-size: 14px;
		word-wrap: break-word;
	}
	.disscussion * {
		font-family: 'dinlight';
	}
	.disscussion article.comment {
		width: 100%;
		min-height: 100px;
		display: inline-block;
		clear: both;
	}
	.discussion .content {
		width: 90%;
	}
	.discussion .comm_img, .discussion .content {
		display: block;
		float: left;
		height: 100%;
		position: relative;
	}
	section.replybox, section.subcomments {
		display: block;
		position: relative;
		clear: both;
		margin-top: 30px;
	}

	.subcomments_arrow {
		background-position: 3px 0;
		background-repeat: no-repeat;
		border: medium none;
		color: transparent;
		height: 14px;
		margin-top: 5px;
		width: 14px;
		background-color: transparent;
		background-image: url("http://www.fansliving.com/images/comments_box/arrow-post.png");
	}
	.subcomments_displayname {
		color: #00A4E7;
		font-weight: bold;
		letter-spacing: -1px;
		margin-left: 3px;
		font-size: 12px;
	}
	.subcomments_comment {
		margin-left: 17px;
		clear: both;
		width: 100%;
		display: inline-block;
	}
	.subcomments_timestamp {
		margin-left: 6px;
		clear: both;
	}
	.subcomments_displayname, .subcomments_arrow {
		float: left;
		display: inline;
	}
	.timestamp, .subcomments_timestamp {
		color: #C1C1C1;
		font-size: 11px;
	}
	ul.pagination > li {
		text-align: center;
	}
	ul.rowbuttons > li {
		line-height: 26px;
		cursor: pointer;
		display: block;
		list-style: none;
		float: left;
		min-width: 50px;
		margin-bottom: 0;
		background: #E2E2E2;
		text-align: center;
		padding-left: 7px;
	}

	ul.rowbuttons > li:hover {
		background: #E2E2E2;
	}
	ul.rowbuttons > li:active {
		background: #E2E2E2;
	}
	ul.rowbuttons > li:first-child {
		-webkit-border-top-left-radius: 3px;
		-webkit-border-bottom-left-radius: 3px;
		-moz-border-radius-topleft: 3px;
		-moz-border-radius-bottomleft: 3px;
		border-top-left-radius: 3px;
		border-bottom-left-radius: 3px;
	}
	ul.rowbuttons > li:last-child {
		-webkit-border-top-right-radius: 3px;
		-webkit-border-bottom-right-radius: 3px;
		-moz-border-radius-topright: 3px;
		-moz-border-radius-bottomright: 3px;
		border-top-right-radius: 3px;
		border-bottom-right-radius: 3px;
	}
	ul.rowbuttons > li > div {
		float: left;
	}
	ul.rowbuttons {
		margin-top: 0;
		display: inline-block;
		float: left;
		margin-right: 10px;
		margin-bottom: 6px;
	}
	.sub {
		clear: both;
	}
	.sub .subcomments_timestamp {
		height: 19px;
		line-height: 13px;
		margin-left: 17px;
	}
	.sub > ul.rowbuttons {
		margin-left: 17px;
		margin-right: -12px;
	}
	.sub ul.rowbuttons > li {
		background: transparent;
		line-height: 15px;
		border-top: 1px solid #CCC;
		border-bottom: 1px solid #CCC;
		min-width: 32px;
		color: #C8C8C8;
		padding: 3px;
	}
	.sub ul.rowbuttons > li > div {
		margin-top: 0;
	}
	.sub ul.rowbuttons > li:first-child {
		border-left: 1px solid #CCC;
	}
	.sub ul.rowbuttons > li:last-child {
		border-right: 1px solid #CCC;
	}

	section.replybox textarea, section.replybox input, section.replybox button {
		float: left;
		display: block;
		position: relative;
		top: 0;
		border: 0;
		outline: 0;
		margin: 0;
		padding-left: 3px;
		padding-right: 3px;
		padding-top: 3px;
		-webkit-appearance: none;
		-webkit-border-radius: 0;
		-webkit-box-sizing: border-box;
	}

	section.replybox {
		width: 100%;
		display: inline-block;
		margin-top: 10px;
	}
	section.replybox input, section.replybox textarea {
		background-color: white;
		font-size: 11px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
	section.replybox input {
		width: 500px;
	}
	.discussion section.replybox button {
		position: absolute;
		right: -71px;
		padding-bottom: 3px;
		text-transform: lowercase;
		padding-left: 16px;
		padding-right: 16px;
	}
	section.login_n_discuss.replybox button {
		width: 50px;
		display: block;
		margin-right: 20px;
		position: relative;
	}
	section.login_n_discuss.replybox textarea {
		font-size: 14px;
		height: 64px;
		padding: 5px;
		width: 892px !important;
	}
	.comment section.replybox {
		float: left;
		clear: none;
		margin-top: 0;
		width: 500px;
	}
	.comment section.replybox textarea, .comment section.replybox input {
		height: 26px;
		font-size: 14px;
	}
	section.login_n_discuss.replybox button.sendbutton {
		height: 24px;
		width: 63px;
		margin-right: 0px;
		right: 6px;
		margin-top: 4px;
		text-transform: lowercase;
		position: absolute;
		padding-bottom: 3px;
		-webkit-border-top-right-radius: 6px;
		-webkit-border-bottom-right-radius: 6px;
		-moz-border-radius-topright: 6px;
		-moz-border-radius-bottomright: 6px;
		border-top-right-radius: 6px;
		border-bottom-right-radius: 6px;
		padding-left: 16px;
		padding-right: 16px;
	}
	input[type='name'], input[type='text'], input[type='email'], input[type='password'], input[type='url'], input[type='number'], input[type='search'], textarea {
		background: rgb(237,237,237);
	}
	input[type='name']:focus, input[type='text']:focus, input[type='email']:focus, input[type='password']:focus, input[type='url']:focus, input[type='number']:focus, input[type='search']:focus, textarea:focus {
		background: rgb(242,242,242);
		background: -moz-linear-gradient(top,  rgba(237,237,237,1) 0%, rgba(255,255,255,1) 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(237,237,237,1)), color-stop(100%,rgba(255,255,255,1)));
		background: -webkit-linear-gradient(top,  rgba(237,237,237,1) 0%,rgba(255,255,255,1) 100%);
		background: -o-linear-gradient(top,  rgba(237,237,237,1) 0%,rgba(255,255,255,1) 100%);
		background: -ms-linear-gradient(top,  rgba(237,237,237,1) 0%,rgba(255,255,255,1) 100%);
		background: linear-gradient(to bottom,  rgba(237,237,237,1) 0%,rgba(255,255,255,1) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ededed', endColorstr='#ffffff',GradientType=0 );
	}
	/*--------------------------------------------------------------
	 2.0 - BUTTON
	 --------------------------------------------------------------*/
	.sendbutton {
		background: #E2E2E2;
		color: #767268;
		display: inline-block;
		font: 15px/15px 'HelveticaNeue-Bold', Helvetica, Arial, sans-serif;
		margin: 0 5px;
		padding: 14px 23px;
		text-decoration: none;
		text-shadow: 0 1px 0 rgba(255,255,255,.81);
		border-radius: 4px !important;
		-moz-border-radius: 4px !important;
		-webkit-border-radius: 4px !important;
		line-height: 18px;
	}
	.sendbutton:hover, .sendbutton.hover {

	}
	.sendbutton:active, .sendbutton.pressed {
		background: rgb(176,212,227);
		background: -moz-linear-gradient(-45deg,  rgba(176,212,227,1) 0%, rgba(169,196,206,1) 100%);
		background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(176,212,227,1)), color-stop(100%,rgba(169,196,206,1)));
		background: -webkit-linear-gradient(-45deg,  rgba(176,212,227,1) 0%,rgba(169,196,206,1) 100%);
		background: -o-linear-gradient(-45deg,  rgba(176,212,227,1) 0%,rgba(169,196,206,1) 100%);
		background: -ms-linear-gradient(-45deg,  rgba(176,212,227,1) 0%,rgba(169,196,206,1) 100%);
		background: linear-gradient(135deg,  rgba(176,212,227,1) 0%,rgba(169,196,206,1) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b0d4e3', endColorstr='#a9c4ce',GradientType=1 );
		color: #6a675e;
		box-shadow: 0 2px 0 rgba(255,255,255,.76), 0 1px 5px rgba(0,0,0,.26) inset;
		-moz-box-shadow: 0 2px 0 rgba(255,255,255,.76), 0 1px 5px rgba(0,0,0,.26) inset;
		-webkit-box-shadow: 0 2px 0 rgba(255,255,255,.76), 0 1px 5px rgba(0,0,0,.26) inset;
	}
	.sendbutton_2 {
		background: rgb(207,202,190);
		background: -moz-linear-gradient(top, rgba(207,202,190,1) 0%, rgba(203,198,185,1) 18%, rgba(179,172,153,1) 83%, rgba(175,168,148,1) 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(207,202,190,1)), color-stop(18%,rgba(203,198,185,1)), color-stop(83%,rgba(179,172,153,1)), color-stop(100%,rgba(175,168,148,1)));
		background: -webkit-linear-gradient(top, rgba(207,202,190,1) 0%,rgba(203,198,185,1) 18%,rgba(179,172,153,1) 83%,rgba(175,168,148,1) 100%);
		background: -o-linear-gradient(top, rgba(207,202,190,1) 0%,rgba(203,198,185,1) 18%,rgba(179,172,153,1) 83%,rgba(175,168,148,1) 100%);
		background: -ms-linear-gradient(top, rgba(207,202,190,1) 0%,rgba(203,198,185,1) 18%,rgba(179,172,153,1) 83%,rgba(175,168,148,1) 100%);
		background: linear-gradient(to bottom, rgba(207,202,190,1) 0%,rgba(203,198,185,1) 18%,rgba(179,172,153,1) 83%,rgba(175,168,148,1) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cfcabe', endColorstr='#afa894',GradientType=0 );
		border: 1px solid #938e81 !important;
		color: #767268;
		display: inline-block;
		font: 15px/15px 'HelveticaNeue-Bold', Helvetica, Arial, sans-serif;
		margin: 0 5px;
		padding: 14px 23px;
		text-decoration: none;
		text-shadow: 0 1px 0 rgba(255,255,255,.81);
		box-shadow: 0 2px 3px rgba(0,0,0,.28), 0 1px 0 #dedcd3 inset;
		-moz-box-shadow: 0 2px 3px rgba(0,0,0,.28), 0 1px 0 #dedcd3 inset;
		-webkit-box-shadow: 0 2px 3px rgba(0,0,0,.28), 0 1px 0 #dedcd3 inset;
		border-radius: 4px;
		-moz-border-radius: 4px;
		-webkit-border-radius: 4px
	}
	.sendbutton_2:hover, .sendbutton_2.hover {
		box-shadow: 0 2px 3px rgba(0,0,0,.28), 0 1px 0 #dedcd3 inset, 0 0 3px #fff inset;
		-moz-box-shadow: 0 2px 3px rgba(0,0,0,.28), 0 1px 0 #dedcd3 inset, 0 0 3px #fff inset;
		-webkit-box-shadow: 0 2px 3px rgba(0,0,0,.28), 0 1px 0 #dedcd3 inset, 0 0 3px #fff inset;
	}
	.sendbutton_2:active, .sendbutton_2.pressed {
		background: rgb(186,180,162);
		background: -moz-linear-gradient(top, rgba(186,180,162,1) 0%, rgba(196,190,176,1) 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(186,180,162,1)), color-stop(100%,rgba(196,190,176,1)));
		background: -webkit-linear-gradient(top, rgba(186,180,162,1) 0%,rgba(196,190,176,1) 100%);
		background: -o-linear-gradient(top, rgba(186,180,162,1) 0%,rgba(196,190,176,1) 100%);
		background: -ms-linear-gradient(top, rgba(186,180,162,1) 0%,rgba(196,190,176,1) 100%);
		background: linear-gradient(to bottom, rgba(186,180,162,1) 0%,rgba(196,190,176,1) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#bab4a2', endColorstr='#c4beb0',GradientType=0 );
		color: #6a675e;
		box-shadow: 0 2px 0 rgba(255,255,255,.76), 0 1px 5px rgba(0,0,0,.26) inset;
		-moz-box-shadow: 0 2px 0 rgba(255,255,255,.76), 0 1px 5px rgba(0,0,0,.26) inset;
		-webkit-box-shadow: 0 2px 0 rgba(255,255,255,.76), 0 1px 5px rgba(0,0,0,.26) inset;
	}
	button.blackbtn {
		background-color: black;
		border: none;
		border-radius: 5px;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		-webkit-box-shadow: 0px 2px 0px rgba(0, 0, 0, 0.5);
		-moz-box-shadow: 0px 2px 0px rgba(0, 0, 0, 0.5);
		box-shadow: 0px 2px 0px rgba(0, 0, 0, 0.5);
		color: white;
		cursor: pointer;
		font-family: 'Nobile', sans-serif;
		font-style: italic;
		font-weight: 900;
		margin: 0px 0px;
		padding: 7px 20px;
	}
	button.blackbtn:hover {
		background-color: #333333;
	}
	button.blackbtn:active {
		-webkit-box-shadow: inset 0px 2px 2px #000000;
		-moz-box-shadow: inset 0px 2px 2px #000000;
		box-shadow: inset 0px 2px 2px #000000;
		margin-top: 2px;
		-webkit-transition: all 0.1s ease;
		-moz-transition: all 0.1s ease;
		-ms-transition: all 0.1s ease;
		-o-transition: all 0.1s ease;
	}
	#bannertext_community {
		font-size: 35px;
		color: #00A5E7;
		line-height: 56px;
	}
	.community_txt {
		border-bottom: 1px solid #00A5E7;
	}
	.shadow_plain {
		background: url(http://hesk.imusictech.net/fansliving/images/common/01-bar-shadow.png) no-repeat 0 0;
		width: 970px;
		height: 15px;
		position: absolute;
		bottom: -16px;
	}
</style>