<style type="text/css">
/*
*.selectnone{-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:-moz-none;-o-user-select:none;user-select:none}input[type=text]{-webkit-user-select:text;-khtml-user-select:text;-moz-user-select:text;-o-user-select:text;user-select:text}p,h1,h2,h3,h4,h5{-webkit-user-select:text;-khtml-user-select:text;-moz-user-select:text;-o-user-select:text;user-select:text}*/
.button_bubbleair_raise {
font: 15px Calibri, Arial, sans-serif;
/* A semi-transparent text shadow */
text-shadow: 1px 1px 0 rgba(255,255,255,0.4);
/* Overriding the default underline styling of the links */
text-decoration: none !important;
white-space: nowrap;
display: inline-block;
vertical-align: baseline;
position: relative;
cursor: pointer;
padding: 10px 20px;
background-repeat: no-repeat;
/* The following two rules are fallbacks, in case
the browser does not support multiple backgrounds. */

background-position: bottom left;
background-image: url('button_bg.png');
/* Multiple backgrounds version. The background images
are defined individually in color classes */

background-position: bottom left, top right, 0 0, 0 0;
background-clip: border-box;
/* Applying a default border raidus of 8px */

-moz-border-radius: 8px;
-webkit-border-radius: 8px;
border-radius: 8px;
/* A 1px highlight inside of the button */

-moz-box-shadow: 0 0 1px #fff inset;
-webkit-box-shadow: 0 0 1px #fff inset;
box-shadow: 0 0 1px #fff inset;
/* Animating the background positions with CSS3 */
/* Currently works only in Safari/Chrome */

-webkit-transition: background-position 1s;
-moz-transition: background-position 1s;
transition: background-position 1s;
}

.button_bubbleair_raise:hover {

/* The first rule is a fallback, in case the browser
does not support multiple backgrounds
*/

background-position: top left;
background-position: top left, bottom right, 0 0, 0 0;
}

.button_bubbleair_raise:active {
/* Moving the button 1px to the bottom when clicked */
bottom: -1px;
}​
.widget {
display: none;
}
.widget, .widget .name, .widget .firendlist {
-webkit-border-radius: 6px;
-moz-border-radius: 6px;
border-radius: 6px;
width: 300px;
float: left;
}
.widget .moretag {
background-color: #251728;
position: absolute;
bottom: 0;
right: 0;
display: block;
}
.widget div, .widget div.friendlist {
background-color: #231223;
clear: both;
color: white;
cursor: pointer;
}
.friendlist span {
color: #700707;
float: left;
margin: 3px;
padding: 5px;
background-color:
/* IE10 Consumer Preview */
background-image : -ms-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* Mozilla Firefox */
background-image: -moz-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* Opera */
background-image: -o-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* Webkit (Safari/Chrome 10) */
background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #8AFFB1), color-stop(1, #BCEFAA));
/* Webkit (Chrome 11+) */
background-image: -webkit-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* W3C Markup, IE10 Release Preview */
background-image: linear-gradient(to top, #8AFFB1 0%, #BCEFAA 100%);
-webkit-box-shadow: 1px 1px 5px 2px #32332;
box-shadow: 1px 1px 5px 2px #32332;
cursor: pointer;
}
#page {
width: 100%;
clear: both;
}
#search_friends {
display: none;
}
#showpage .function .search_submit {
top: 2px;
right: 3px;
position: relative;
}
#showpage .function .face{
-webkit-border-radius: 25px;
-moz-border-radius: 25px;
border-radius: 25px;
}
#container > * {
-webkit-transition-timing-function: cubic-bezier(0.895, 0.375, 0.120, 0.955);
-moz-transition-timing-function: cubic-bezier(0.895, 0.375, 0.120, 0.955);
-ms-transition-timing-function: cubic-bezier(0.895, 0.375, 0.120, 0.955);
-o-transition-timing-function: cubic-bezier(0.895, 0.375, 0.120, 0.955);
transition-timing-function: cubic-bezier(0.895, 0.375, 0.120, 0.955); /* custom */
}
#container #search_friends {
margin: 50px auto;
display: inline-block !important;
position: relative;
width: 450px;
}
#search_friends > section.inputbox input[type="text"] {
font-size: 22px;
margin-left: 10px;
margin-right: 10px;
width: 310px;
}
#search_friends > section.inputbox > select {
display: none;
}
#search_friends > section.inputbox #selection_field:hover {
background: url(<?php echo base_url(); ?>images/friends_list/search-button.png) no-repeat 0 -40px;
}
#search_friends > section.inputbox #selection_field {
clear: both;
width: 40px;
height: 40px;
background: url(<?php echo base_url(); ?>images/friends_list/search-button.png) no-repeat 0 0;
}
#search_friends > section.inputbox {
padding: 10px;
clear: both;
width: 445px;
height: 60px;
background: url(<?php echo base_url(); ?>images/friends_list/search-bg.png) no-repeat 0 0;
}
#search_friends > section.inputbox > div {
float: left;
display: inline;
}
#search_friends > section.inputbox button#search_button, #search_friends > section.inputbox button#search_button:hover, #search_friends > section.inputbox button#search_button:active {
width: 40px;
height: 40px;
content: "" !important;
background: url(<?php echo base_url(); ?>images/friends_list/search-button.png) no-repeat -40px -40px;
border: none;
}
#search_friends > section.invite {
width: 65px;
height: 65px;
display: none;
/*all friends functions are not in use temporary*/
float: left;
margin-left: 8px;
}
#search_friends .facebook {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat 0 0;
}
#search_friends .facebook:hover {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat 0 -65px;
}
#search_friends .facebook:active, #search_friends .facebook.selected {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat 0 -130px;
}
#search_friends .yahoo {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -65px 0;
}
#search_friends .yahoo:hover {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -65px -65px;
}
#search_friends .yahoo:active, #search_friends .yahoo.selected {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -65px -130px;
}
#search_friends .google {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -130px 0;
}
#search_friends .google:hover {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -130px -65px;
}
#search_friends .google:active, #search_friends .google.selected {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -130px -130px;
}
#search_friends .bing {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -195px 0;
}
#search_friends .bing:hover {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -195px -65px;
}
#search_friends .bing:active, #search_friends .bing.selected {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -195px -130px;
}
#search_friends .twitter {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -260px 0;
}
#search_friends .twitter:hover {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -260px -65px;
}
#search_friends .twitter:active, #search_friends .twitter.selected {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -260px -130px;
}
#search_friends .instagram {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -325px 0;
}
#search_friends .instagram:hover {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -325px -65px;
}
#search_friends .instagram:active, #search_friends .instagram.selected {
background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -325px -130px;
}
#request_tab .fans_selection{
width: 300px;
bottom: -70px;
left: -222px;
}
#showpage .fans_selection{
width: 130px;
}
.function input, .function input:active, .function input:focus{
width:330px;
}
#nav_friendslist ul li {
float: right;
cursor: pointer;
width: 100px;
padding-top: 10px;
padding-bottom: 10px;
list-style: none;
margin-left: 5px;
padding-left: 20px;
/* IE10 Consumer Preview */
background-image: -ms-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* Mozilla Firefox */
background-image: -moz-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* Opera */
background-image: -o-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* Webkit (Safari/Chrome 10) */
background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #8AFFB1), color-stop(1, #BCEFAA));
/* Webkit (Chrome 11+) */
background-image: -webkit-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* W3C Markup, IE10 Release Preview */
background-image: linear-gradient(to top, #8AFFB1 0%, #BCEFAA 100%);
}
#result > span, #showpage > span, section.search_output > span {
display: block;
padding: 5px 20px 5px 10px;
margin: -3px 0px -3px;
border: 1px solid transparent;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
-khtml-border-radius: 4px;
border-radius: 4px;
width: 100%;
}
section.search_output > span:hover, #result > span:hover, #showpage > span:hover {
border: 1px solid #EEE;
-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.9);
-moz-box-shadow: inset 0 1px 0 rgba(255,255,255,0.9);
-ms-box-shadow: inset 0 1px 0 rgba(255,255,255,0.9);
-o-box-shadow: inset 0 1px 0 rgba(255,255,255,0.9);
box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.9);
/* IE10 Consumer Preview */
background-image: -ms-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* Mozilla Firefox */
background-image: -moz-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* Opera */
background-image: -o-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* Webkit (Safari/Chrome 10) */
background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #8AFFB1), color-stop(1, #BCEFAA));
/* Webkit (Chrome 11+) */
background-image: -webkit-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
}

#showpage {
display: block;
text-align: center;
}
#showpage div.profile {
float: left;
display: block;
}
#showpage #search_friends .invite .payload {
display: none;
}
#container {
display: block;
clear: both;
height: 100%;
}
#topbar {
background-color: #E6E6E6;
position: relative;
width: 960px;
height: 50px;
text-align: center;
clear: both;
margin-top: 25px;
margin-left: 0px;
-o-box-shadow:0 0 0 1px #ffffff, 0 0 0 2px #ABABAB; /* Firefox 3.6 and earlier */
-moz-box-shadow:0 0 0 1px #ffffff, 0 0 0 2px #ABABAB; /* Firefox 3.6 and earlier */
-webkit-box-shadow:0 0 0 1px #ffffff, 0 0 0 2px #ABABAB; /* Safari and Chrome */
box-shadow: 0 0 0 1px #ffffff, 0 0 0 2px #ABABAB;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
}

#name_tag {
position: absolute;
display: inline-block;
left: 102px;
top: 15px;
font-size: 25px;
}
#role,  #lastupdate {
position: absolute;
font-size: 10px;
top: 5px;
line-height: 10px;
display: inline-block;
text-align: left;
border-left: 1px solid #D9D9D9;
padding-top: 10px;
padding-bottom: 10px;
padding-left: 25px;
}
#role {
left: 290px;
}
#role span:first-child{
color: #666;
}
#role span:last-child{
color: #409c0e;
}
#lastupdate {
left: 420px;
}
#lastupdate span:first-child{
color: #a1a1a1;
}
#lastupdate span:last-child{
color: #00a5e7;
}
#message_tab{
left: 630px;
top: -5px;
}
#request_tab {
left: 800px;
top: -5px;
}
#message_tab,
#request_tab {
line-height: 57px;
color: black;
position: absolute;
display: inline-block;
font-size: 18px;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
height: 60px;
width: 100px;
}
#request_tab .box .fans_selection.show{
display:block;
}
#request_tab .box .fans_selection{
display:none;
}
/*
#request_tab .fans_selection:hover{

}*/
#request_tab .box{
width: 300px;
height: auto;
position: absolute;
left: 45px;
top: -30px;
z-index: 1;
}
#request_tab .box ul{
display:block;
}
#request_tab .cbox{
width: 300px;
height: auto;
position: absolute;
left: -200px;
top: 60px;

-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;

background: #a9e4f7; /* Old browsers */
background: -moz-linear-gradient(-45deg,  #a9e4f7 0%, #0fb4e7 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,#a9e4f7), color-stop(100%,#0fb4e7)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(-45deg,  #a9e4f7 0%,#0fb4e7 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(-45deg,  #a9e4f7 0%,#0fb4e7 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(-45deg,  #a9e4f7 0%,#0fb4e7 100%); /* IE10+ */
background: linear-gradient(135deg,  #a9e4f7 0%,#0fb4e7 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a9e4f7', endColorstr='#0fb4e7',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

}
#topbar .n{
font-size:30px;
line-height: 59px;
color: white;
text-align:center;
position: absolute;
font-weight:bold;
left: 95px;
top: 0px;
width: 60px;
height: 60px;

-webkit-border-radius: 30px;
-moz-border-radius: 30px;
border-radius: 30px;
box-shadow: 0 0 0 3px white;

background: rgb(83,180,220); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(83,180,220,1) 50%, rgba(0,165,231,1) 50%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,rgba(83,180,220,1)), color-stop(50%,rgba(0,165,231,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(83,180,220,1) 50%,rgba(0,165,231,1) 50%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(83,180,220,1) 50%,rgba(0,165,231,1) 50%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(83,180,220,1) 50%,rgba(0,165,231,1) 50%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(83,180,220,1) 50%,rgba(0,165,231,1) 50%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#53b4dc', endColorstr='#00a5e7',GradientType=0 ); /* IE6-9 */

cursor:pointer;
}
/* fans request data */
#request_tab .fans_selection li>div{
float:left;
}
#request_tab .fans_selection li{
height:52px;
}
#request_tab .fans_selection li .left{
overflow:hidden;
}
#request_tab .fans_selection li .left img{
width:50px;
}
#request_tab .fans_selection li .middle{
white-space: pre;
font-size:20px;
text-transform:capitalize;
margin-left: 12px;
}
#request_tab .fans_selection li .sex{
position: relative;
float: right;
right: 1px;
}
#request_tab .fans_selection li .accept,
#request_tab .fans_selection li .reject{
text-transform: capitalize;
display: block;
position: relative;
top: 9px;
text-align: right;
float: right;
width: 110px;
border-top: 1px solid white;
padding-top: 4px;
padding-bottom: 4px;
}
#request_tab .fans_selection li .accept,
#request_tab .fans_selection li .reject,
#request_tab .fans_selection li span{
cursor:pointer !important;
}
#request_tab .fans_selection li .accept .mark,
#request_tab .fans_selection li .reject .mark{
width:20px;
height:20px;
background:url(<?php echo base_url(); ?>images/common/icons-accept.png) no-repeat 0 0;
}
#request_tab .fans_selection li .accept:hover .mark{
background-position:0 -20px;
}
#request_tab .fans_selection li .reject:hover .mark{
background-position:-20px -20px;
}
#request_tab .fans_selection li .accept>div,
#request_tab .fans_selection li .accept>span,
#request_tab .fans_selection li .reject>div,
#request_tab .fans_selection li .reject>span{
float:left;
}
#request_tab .fans_selection li .reject:hover,
#request_tab .fans_selection li .accept:hover{
background: -moz-linear-gradient(top,  rgba(255,255,255,0.3) 0%, rgba(255,255,255,0.25) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.3)), color-stop(100%,rgba(255,255,255,0.25))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(255,255,255,0.3) 0%,rgba(255,255,255,0.25) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(255,255,255,0.3) 0%,rgba(255,255,255,0.25) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(255,255,255,0.3) 0%,rgba(255,255,255,0.25) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(255,255,255,0.3) 0%,rgba(255,255,255,0.25) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4dffffff', endColorstr='#40ffffff',GradientType=0 ); /* IE6-9 */

}
#request_tab .fans_selection li .accept .mark{
right:0;
background-position:0 0;
}
#request_tab .fans_selection li .reject .mark{
right:30px;
background-position:-20px 0;
}
#request_tab .fans_selection li:hover{
background: rgb(0,165,216); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(0,165,216,1) 0%, rgba(98,154,201,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,165,216,1)), color-stop(100%,rgba(98,154,201,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(0,165,216,1) 0%,rgba(98,154,201,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(0,165,216,1) 0%,rgba(98,154,201,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(0,165,216,1) 0%,rgba(98,154,201,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(0,165,216,1) 0%,rgba(98,154,201,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00a5d8', endColorstr='#629ac9',GradientType=0 ); /* IE6-9 */
color:white;
}
#topbar, #triple_bann, #bottomsection,
#showpage,
#response {
text-align: center;
width: 960px;
}
#triple_bann {
margin-top: 50px;
clear: both;
position: relative;
height: 220px;
margin-bottom: 6px;

/*background-color: #CCC;*/
}
#triple_bann > div {
width: 210px;
/*background-color: #BABABA;*/
display: inline-block;
clear: both
}
.notice_num{
width:30px;
height:30px;
-webkit-border-radius: 15px;
-moz-border-radius: 15px;
border-radius: 15px;
background-color: #ABABAB;

}
#triple_bann > div > div.button_fd {
height: 191px;
width: 191px;
margin: 0 auto;
}
#triple_bann .bigtxt, #triple_bann .button_fd.active .txt {
font-size: 88px !important;
color: #FFF !important;
text-shadow: 1px 0px 5px rgba(210, 235, 231, 1) !important;
}
#triple_bann .button_fd div > *{
}
#triple_bann>div{
border-right: 1px solid #E0E0E0;
}
#triple_bann>div:last-child{
border-right: none;
}
#triple_bann div.button_fd > div.txt{
font-size: 53px;
text-align: center;
padding-top: 82px;
cursor: default;
text-shadow: 1px 0px 5px rgba(150, 150, 150, 1);
color: #A6A6A6;
line-height: 30px;
}
#triple_bann div > div.label {
margin: 0 auto;
text-transform: uppercase;
text-align: center;
font-size: 22px;
}
/* default settings and faces */
#triple_bann .button_fd{
background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat 0 0;
}
#triple_bann .button_fd:hover{
background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat 0 -194px;
}
#triple_bann .button_fd:active,
#triple_bann .button_fd.active{
background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat 0 -388px;
}
/* end */
#triple_bann #all > .button_fd{
background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat -388px 0;
}
#triple_bann #all > .button_fd:hover{
background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat -388px -194px;
}
#triple_bann #all > .button_fd:active,
#triple_bann #all > .button_fd.active {
background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat -388px -388px;
}
#triple_bann #device > .button_fd{
background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat -582px 0;
}
#triple_bann #device > .button_fd:hover{
background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat -582px -194px;
}
#triple_bann #device > .button_fd:active,
#triple_bann #device > .button_fd.active {
background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat -582px -388px;
}
#triple_bann #invite > .button_fd,
#triple_bann .button_fd.invite{
background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat -194px 0;
}
#triple_bann #invite > .button_fd:hover,
#triple_bann .button_fd.invite:hover {
background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat -194px -194px;
}
#triple_bann #invite > .button_fd:active,
#triple_bann #invite > .button_fd.active,
#triple_bann .button_fd.invite:active,
#triple_bann .button_fd.invite.active  {
background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat -194px -388px;
}
#triple_bann .button_fd.blur{
filter: url(filters.svg#grayscale); /* Firefox 3.5+ */
filter: gray; /* IE6-9 */
-webkit-filter: grayscale(1); /* Google Chrome & Safari 6+ */
opacity: 0.7;
}
/*

hesk HKM creation
starting the lower part of the tiles
for each individual block we have a style to apply

*/
/* botton area*/
.editarea .add,
.editarea .remove,
.editarea .unconnect,
.editarea .reconnect,
.editarea .view,
.editarea .checkout,
.editarea .report,
.editarea .sendrequest,
.editarea .invite {
cursor: pointer;
-webkit-border-radius: 6px;
-moz-border-radius: 6px;
border-radius: 6px;
background-color: #F3FDDC;
}
.editarea.display {
display: inline;
}
.editarea {
position: relative;
float: right;
/*display: none;*/
background: #F3F3F3;
}
.editarea>div:hover,
.editarea>div{
width:35px;
height:35px;
cursor:pointer;
}
.editarea .remove {
background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat 0 0;
}
.editarea .remove:hover, .editarea .remove:active {
background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat 0 -35px;
}
.editarea .remove.disabled {
background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat 0 -105px;
}
.editarea .add {
background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -35px 0;
}
.editarea .add:hover, .editarea .add:active {
background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -35px -35px;
}
.editarea .add.disabled {
background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -35px -105px;
}
.editarea .profile {
background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -70px 0;
}
.editarea .profile:hover, .editarea .profile:active {
background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -70px -35px;
}
.profile:hover .buttonlabel{
right: 60px !important;
}
.editarea .profile.disabled {
background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -70px -105px;
}
.editarea .cloud {
background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -105px 0;
}
.editarea .cloud:hover, .editarea .cloud:active {
background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -105px -35px;
}
.editarea .cloud.disabled {
background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -105px -105px;
}
.editarea .disabled{
cursor:default;
}
.editarea .buttonlabel{
-webkit-animation: fadeOutLeft .4s ease;
-moz-animation: fadeOutLeft .4s ease;
-ms-animation: fadeOutLeft .4s ease;
-o-animation: fadeOutLeft .4s ease;
animation: fadeOutLeft .4s ease;

background: #ffffff; /* Old browsers */
background: -moz-linear-gradient(top,  #ffffff 0%, #d9d9d9 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#d9d9d9)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #ffffff 0%,#d9d9d9 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #ffffff 0%,#d9d9d9 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #ffffff 0%,#d9d9d9 100%); /* IE10+ */
background: linear-gradient(to bottom,  #ffffff 0%,#d9d9d9 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#d9d9d9',GradientType=0 ); /* IE6-9 */

-webkit-border-radius: 6px;
-moz-border-radius: 6px;
border-radius: 6px;
height: 34px;
-webkit-box-shadow: 1px 1px 5px 2px #D9D9D9;
box-shadow: 1px 1px 5px 2px #D9D9D9;
font-size: 18px;
color: #409C0E;

top: 3px;
text-align: center;
line-height: 35px;
width: auto;
white-space: pre;
padding-left:3px;
padding-right:3px;
/*this need to set its right or left position in order to make it complete*/

display:none;
position: relative;
}
.editarea.shorted .buttonlabel{
left: 37px;
}
.editarea.shorted>div:hover .buttonlabel{
-webkit-animation: fadeInRight .4s ease;
-moz-animation: fadeInRight .4s ease;
-ms-animation: fadeInRight .4s ease;
-o-animation: fadeInRight .4s ease;
animation: fadeInRight .4s ease;
position: relative;
left: 37px;
}
.editarea>div:hover .buttonlabel{

-webkit-animation: fadeInLeft .4s ease;
-moz-animation: fadeInLeft .4s ease;
-ms-animation: fadeInLeft .4s ease;
-o-animation: fadeInLeft .4s ease;
animation: fadeInLeft .4s ease;
display:block;
}
.display_single.item {
margin: 0 auto;
padding: 0;
width: 680px;
}
.display_three.item {
margin: 0 auto;
padding: 0;
width: 390px;
}

.item .editarea{
-webkit-transition: 1s ease;
-moz-transition: 1s ease;
-o-transition: 1s ease;
-ms-transition: 1s ease;
transition: 1s ease;
}
.display_single.item .textblock {
width: 554px;
}
.display_three.item .textblock {
width: 390px;
}
.active.item {
background-color:
/* IE10 Consumer Preview */
background-image : -ms-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* Mozilla Firefox */
background-image: -moz-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* Opera */
background-image: -o-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* Webkit (Safari/Chrome 10) */
background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #8AFFB1), color-stop(1, #BCEFAA));
/* Webkit (Chrome 11+) */
background-image: -webkit-linear-gradient(bottom, #8AFFB1 0%, #BCEFAA 100%);
/* W3C Markup, IE10 Release Preview */
background-image: linear-gradient(to top, #8AFFB1 0%, #BCEFAA 100%);
-webkit-box-shadow: 1px 1px 5px 2px #32332;
box-shadow: 1px 1px 5px 2px #32332;
}
/* starting the #bottomsection */
#bottomsection{
margin-top: 30px;
}
.fill .item:first-child{
margin-top:10px;
}
.fill .item {
-webkit-transition: all 0.5s ease-in-out;
-moz-transition: all 0.5s ease-in-out;
transition: all 0.5s ease-in-out;
display: inline-block;
text-align: left;
color: #333333;
border-bottom: 1px solid #E0E0E0;
padding-bottom: 5px;
}
.fill .item .name {
text-transform: capitalize;
font-size: 19px;
}
.fill .item .k_man {
font-size: 16px;
}
.fill .item .k_man,  .fill .item .name {
display: inline-block;
float: left;
margin-right: 10px;
margin-left: 20px;
margin-top: 10px;
}
.fill .item div {
float: left;
}
.fill #result .item .editarea{
height: 100px;
float: right;
}
.fill .item .country {
font-size: 14px;
}
.fill .item .add_device,
.fill .item .issued,
.fill .item .location{
position: absolute;
right: 191px;
}
.fill .item .add_device,
.fill .item .issued{
right:141px;
}
.fill .item .profilepic {
height: 85px;
width: 85px;
-webkit-border-radius: 6px;
-moz-border-radius: 6px;
border-radius: 6px;
overflow:hidden;
-webkit-transition: all 0.5s ease-in;
-moz-transition: all 0.5s ease-in;
transition: all 0.5s ease-in;
}
a[trigger]{
	cursor:pointer;
}
.profilepic:hover{
}
/*
.fill .item .profilepic img{
width: 85px;
}*/
/* we have the text block started here and here we go @hesk */
.fill .item .textblock {
display: inline-block;
height: 85px;
margin-left: 5px;
overflow:hidden;
}
.fill .item.slidable .textblock {
-webkit-transition: height 0.6s ease;
-moz-transition: height 0.6s ease;
transition: height 0.6s ease;
}
/* TODO: this will be presented in a different look in ipad or touch pad that is not in the screen mod*/
@media screen{
.fill .item.slidable:hover .textblock{
-webkit-transition: height 0.6s ease;
-moz-transition: height 0.6s ease;
transition: height 0.6s ease;
height: 500px;
}
}
/*
.fill .item:hover .textblock .k_man.learmore{
-webkit-animation: flipInX 1s ease;
-moz-animation: flipInX 1s ease;
-ms-animation: flipInX 1s ease;
-o-animation: flipInX 1s ease;
animation: flipInX 1s ease;
}
.fill .item:hover .textblock .k_man{
height:auto;
-webkit-transition: all 0.5s ease-in-out;
-moz-transition: all 0.5s ease-in-out;
transition: all 0.5s ease-in-out;
}
.fill .item:hover{
height:auto;
-webkit-transition: all 0.5s ease-in-out;
-moz-transition: all 0.5s ease-in-out;
transition: all 0.5s ease-in-out;
}*/
.fill .item .textblock .top,  .fill .item .textblock .k_man {
clear: both;
}
.fill .item .editarea {
width: 35px;
height: 140px;
}
.view_manage .textblock{
-webkit-transition: width 1s ease;
-moz-transition: width 1s ease;
transition: width 1s ease;
overflow-y: hidden;
}
.item .textblock.shorted{
width: 400px;

}
.item .editarea.shorted{
width:190px;
}
.fill .hidebox{
display:none;
}
.fill .hidebox.show{
display: block;
white-space: pre;
float: left;
top: 6px;
position: relative;
-webkit-animation: fadeInDown 1s ease;
-moz-animation: fadeInDown 1s ease;
-ms-animation: fadeInDown 1s ease;
-o-animation: fadeInDown 1s ease;
animation: fadeInDown 1s ease;
}
.remove:hover .buttonlabel.right,
.add:hover .buttonlabel.right{
right:122px !important;
}
.add:hover[desc] .buttonlabel.right{
right:144px !important;
}
.remove:hover[desc] .buttonlabel.right{
right:157px !important;
}
.editarea .buttonlabel.right:before{
right: -20px;
top: 42%;
border-left: 10px solid rgba(101,215,255,1);
}
.hidebox.text{
text-align: center;
clear: both;
width: 100%;
}
#titlebar {
font-size: 21px;
padding-top: 3px;
text-align: left;
border-bottom: 1px solid #E0E0E0;
width: 680px;
margin: 0 auto;
display:block;
height:40px;
}
#titlebar>div{
float:left;
padding: 10px;
border-right: 2px solid #ABABAB;
cursor:pointer;
text-transform:capitalize;
}
#titlebar>div.active{
color:white;
}
#titlebar>div:hover,
#titlebar>div.active{

background: rgb(192,230,230); /* Old browsers */
background: -moz-linear-gradient(-45deg,  rgba(192,230,230,1) 0%, rgba(83,217,255,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(192,230,230,1)), color-stop(100%,rgba(83,217,255,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(-45deg,  rgba(192,230,230,1) 0%,rgba(83,217,255,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(-45deg,  rgba(192,230,230,1) 0%,rgba(83,217,255,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(-45deg,  rgba(192,230,230,1) 0%,rgba(83,217,255,1) 100%); /* IE10+ */
background: linear-gradient(135deg,  rgba(192,230,230,1) 0%,rgba(83,217,255,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c0e6e6', endColorstr='#53d9ff',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
}
#titlebar>div:last-child{
margin-right:0px;
border-right: none;
}
#bottomsection .fill.myfans, #bottomsection .fill {

}

#js_item_manage{
width: 680px;
margin: 0 auto;
}
#js_item_manage>div{
float:left;
}
.topwidebanner{
padding:23px;
height:auto;
clear:both;
border-bottom:none;
cursor:default;
text-align: center;
background: rgb(246,248,249); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(246,248,249,1) 0%, rgba(229,235,238,1) 50%, rgba(215,222,227,1) 51%, rgba(245,247,249,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(246,248,249,1)), color-stop(50%,rgba(229,235,238,1)), color-stop(51%,rgba(215,222,227,1)), color-stop(100%,rgba(245,247,249,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 50%,rgba(215,222,227,1) 51%,rgba(245,247,249,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 50%,rgba(215,222,227,1) 51%,rgba(245,247,249,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 50%,rgba(215,222,227,1) 51%,rgba(245,247,249,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(246,248,249,1) 0%,rgba(229,235,238,1) 50%,rgba(215,222,227,1) 51%,rgba(245,247,249,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6f8f9', endColorstr='#f5f7f9',GradientType=0 ); /* IE6-9 */
}
.item.kbox:first-child {
margin-top: 0px;
}
.item.kbox{
width: 90px;
height: 95px;
cursor: pointer;
overflow: hidden;
-moz-border-radius: 8px;
-webkit-border-radius: 8px;
border-radius: 8px;
}
.item.kbox .upperpart{
width:90px;
height:90px;
display:block;
margin-bottom: 10px;
margin-top: 10px;
-moz-border-radius: 8px;
-webkit-border-radius: 8px;
border-radius: 8px;
overflow:hidden;
}
.item.kbox .lowerpart{
position: absolute;
height: 40px;
top: 60px;
width: 100%;
color: white;

/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzAwMDAwMCIgc3RvcC1vcGFjaXR5PSIwIi8+CiAgICA8c3RvcCBvZmZzZXQ9Ijk4JSIgc3RvcC1jb2xvcj0iIzAwMDAwMCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMwMDAwMDAiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  rgba(0,0,0,0) 0%, rgba(0,0,0,1) 98%, rgba(0,0,0,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(98%,rgba(0,0,0,1)), color-stop(100%,rgba(0,0,0,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,1) 98%,rgba(0,0,0,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,1) 98%,rgba(0,0,0,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,1) 98%,rgba(0,0,0,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(0,0,0,1) 98%,rgba(0,0,0,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#000000',GradientType=0 ); /* IE6-8 */

-webkit-animation: fadeOutDown 0.1s ease;
-moz-animation: fadeOutDown 0.1s ease;
-ms-animation: fadeOutDown 0.1s ease;
-o-animation: fadeOutDown 0.1s ease;
animation: fadeOutDown 0.1s ease;
opacity: 0;
}
.item.kbox:hover .lowerpart{
-webkit-animation: fadeInUp 0.1s ease;
-moz-animation: fadeInUp 0.1s ease;
-ms-animation: fadeInUp 0.1s ease;
-o-animation: fadeInUp 0.1s ease;
animation: fadeInUp 0.1s ease;
opacity: 1.0;
}
.item.kbox .lowerpart .name{
font-size: 15px;
margin: 4px;
line-height: 15px;
bottom: 0px;
position: absolute;
overflow:hidden;
width: 90px;
height: 16px;
-webkit-animation: fadeIn 0.5s ease;
-moz-animation: fadeIn 0.5s ease;
-ms-animation: fadeIn 0.5s ease;
-o-animation: fadeIn 0.5s ease;
animation: fadeIn 0.5s ease;
}
.item.kbox .lowerpart .sex{
top: 0px;
right: 7px;
position: absolute;
}

</style>