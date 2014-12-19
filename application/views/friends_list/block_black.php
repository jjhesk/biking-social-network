<style>
	/* loading component  start here HESK */
	.flickr-loader {
		width: 58px;
		height: 27px;
		margin: 50px auto;
		position: relative;
		z-index: 5;
		-moz-border-radius: 12px;
		border-radius: 12px;
	}
	.flickr-loader.dark {
		background: #000;
		-webkit-box-shadow: 0 0 9px rgba(0,0,0,.3);
		-moz-box-shadow: 0 0 9px rgba(0,0,0,.3);
		box-shadow: 0 0 9px rgba(0,0,0,.3);
	}
	.flickr-loader.light {
		background: #eee;
	}
	.flickr-loader span {
		text-indent: -9999px;
		height: 12px;
		width: 12px;
		position: absolute;
		top: 8px;
		-moz-border-radius: 20px;
		border-radius: 20px;
		background: #ccc;
		left: 16px;
		z-index: 1;
		-webkit-animation: pink 2.2s infinite;
		-moz-animation: pink 2.2s infinite;
		-ms-animation: pink 2.2s infinite;
		animation: pink 2.2s infinite;
	}
	.flickr-loader span:nth-of-type(2) {
		background: #999;
		left: 30px;
		z-index: 2;
		-webkit-animation: blue 2.2s infinite;
		-moz-animation: blue 2.2s infinite;
		-ms-animation: blue 2.2s infinite;
		animation: blue 2.2s infinite;
	}
	@-webkit-keyframes pink {
	0% { left: 16px; z-index: 1;}
	50% { left: 29px; }
	100% { z-index: 3; left: 13px; }
	}
	@-webkit-keyframes blue {
	0% {  left: 30px; z-index: 2; }
	50% { left: 16px; }
	100% { z-index: 1; left: 30px; }
	}
	@-moz-keyframes pink {
	0% { left: 16px; z-index: 1;}
	50% { left: 29px; }
	100% { z-index: 3; left: 13px; }
	}
	@-moz-keyframes blue {
	0% {  left: 30px; z-index: 2; }
	50% { left: 16px; }
	100% { z-index: 1; left: 30px; }
	}
	@-ms-keyframes pink {
	0% { left: 16px; z-index: 1;}
	50% { left: 29px; }
	100% { z-index: 3; left: 13px; }
	}
	@-ms-keyframes blue {
	0% {  left: 30px; z-index: 2; }
	50% { left: 16px; }
	100% { z-index: 1; left: 30px; }
	}
	@keyframes pink {
	0% { left: 16px; z-index: 1;}
	50% { left: 29px; }
	100% { z-index: 3; left: 13px; }
	}
	@keyframes blue {
	0% {  left: 30px; z-index: 2; }
	50% { left: 16px; }
	100% { z-index: 1; left: 30px; }
	}
	/* loading component ends here*/
	* {
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: -moz-none;
		-o-user-select: none;
		user-select: none;
	}
	input[type='text'] {
		-webkit-user-select: text;
		-khtml-user-select: text;
		-moz-user-select: text;
		-o-user-select: text;
		user-select: text;
	}
	p, h1, h2, h3, h4, h5 {
		-webkit-user-select: text;
		-khtml-user-select: text;
		-moz-user-select: text;
		-o-user-select: text;
		user-select: text;
	}
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
		display: block;
		float: left;
		margin-left: 8px;
	}
	#search_friends section.facebook {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat 0 0;
	}
	#search_friends section.facebook:hover {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat 0 -65px;
	}
	#search_friends section.facebook:active, #search_friends section.facebook.selected {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat 0 -130px;
	}
	#search_friends section.yahoo {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -65px 0;
	}
	#search_friends section.yahoo:hover {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -65px -65px;
	}
	#search_friends section.yahoo:active, #search_friends section.yahoo.selected {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -65px -130px;
	}
	#search_friends section.google {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -130px 0;
	}
	#search_friends section.google:hover {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -130px -65px;
	}
	#search_friends section.google:active, #search_friends section.google.selected {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -130px -130px;
	}
	#search_friends section.bing {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -195px 0;
	}
	#search_friends section.bing:hover {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -195px -65px;
	}
	#search_friends section.bing:active, #search_friends section.bing.selected {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -195px -130px;
	}
	#search_friends section.twitter {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -260px 0;
	}
	#search_friends section.twitter:hover {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -260px -65px;
	}
	#search_friends section.twitter:active, #search_friends section.twitter.selected {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -260px -130px;
	}
	#search_friends section.instagram {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -325px 0;
	}
	#search_friends section.instagram:hover {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -325px -65px;
	}
	#search_friends section.instagram:active, #search_friends section.instagram.selected {
		background: url(<?php echo base_url(); ?>images/friends_list/social-button.png) no-repeat -325px -130px;
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
	/* botton area*/
	#page .editarea .add, #page .editarea .remove, #page .editarea .unconnect, #page .editarea .reconnect, #page .editarea .view, #page .editarea .checkout, #page .editarea .report, #page .editarea .sendrequest, #page .editarea .invite {
		cursor: pointer;
		padding: 5px;
		-webkit-border-radius: 6px;
		-moz-border-radius: 6px;
		border-radius: 6px;
		background-color: #F3FDDC;
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
		border: 1px solid #ABABAB;
		position: relative;
		width: 90%;
		height: 50px;
		text-align: center;
		clear: both;
		margin-top: 25px;
		margin-left: 50px;
	}
	#topbar:before {
		position: absolute;
		display: block;
		content: '';
		border: 1px solid #FFF;
		box-sizing: border-box;
		-moz-box-sizing: border-box;
		-webkit-box-sizing: border-box;
		height: 100%;
		width: 100%;
	}
	#topbar #profile_pic {
		width: 85px;
		height: 85px;
		border: 7px solid #ffffff;
		box-shadow: 2px 3px 6px rgba(154, 154, 154, 0.75);
		-moz-box-shadow: 2px 3px 6px rgba(154, 154, 154, 0.75);
		-webkit-box-shadow: 2px 3px 6px rgba(154, 154, 154, 0.75);
		position: relative;
		top: -25px;
		left: -7px;
		background-color: #000;
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 5px;
	}
	#topbar #name_tag {
		position: absolute;
		display: inline-block;
		left: 150px;
		top: 15px;
		font-size: 25px;
	}
	#topbar #role, #topbar #lastupdate {
		position: absolute;
		font-size: 15px;
		top: 5px;
		display: inline-block;
	}
	#topbar #role {
		left: 390px;
	}
	#topbar #lastupdate {
		left: 560px;
	}
	#topbar #message_tab {
		position: absolute;
		display: inline-block;
		left: 350px;
		top: 15px;
		font-size: 25px;
	}
	#topbar #request_tab {
		position: absolute;
		display: inline-block;
		left: 450px;
		top: 15px;
		font-size: 25px;
	}
	section#topbar, section#triple_bann, section#bottomsection {
		text-align: center;
	}
	#triple_bann {
		margin: 25px auto;
		clear: both;
		position: relative;
		width: 910px;
		margin-bottom: 6px;
		/*background-color: #CCC;*/
	}
	#triple_bann > div {
		width: 300px;
		/*background-color: #BABABA;*/
		display: inline-block;
		clear: both
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
	#triple_bann #myfan, #triple_bann #myfollow {
		border-right: 1px solid #E0E0E0;
	}
	#triple_bann #myfan > div.button_fd > div.txt, #triple_bann #myfollow > div.button_fd > div.txt {
		font-size: 53px;
		text-align: center;
		padding-top: 82px;
		cursor: default;
		text-shadow: 1px 0px 5px rgba(150, 150, 150, 1);
		color: #A6A6A6;
	}
	#triple_bann div > div.label {
		margin: 0 auto;
		text-transform: uppercase;
		text-align: center;
		font-size: 22px;
	}
	#triple_bann #myfan > div.button_fd, #triple_bann #myfollow > div.button_fd {
		background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat 0 0;
	}
	#triple_bann #myfan > div.button_fd:hover, #triple_bann #myfollow > div.button_fd:hover {
		background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat 0 -190px;
	}
	#triple_bann #myfan > div.button_fd:active, #triple_bann #myfollow > div.button_fd:active, #triple_bann #myfan > div.button_fd.active, #triple_bann #myfollow > div.button_fd.active {
		background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat 0 -380px;
	}
	#triple_bann #invite > div.button_fd {
		background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat -190px 0;
	}
	#triple_bann #invite > div.button_fd:hover {
		background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat -190px -190px;
	}
	#triple_bann #invite > div.button_fd:active, #triple_bann #invite > div.button_fd.active {
		background: url(<?php echo base_url(); ?>images/friends_list/button_fd.png) no-repeat -190px -380px;
	}
	/* hesk HKM creation
	 starting the lower part of the tiles
	 for each individual block we have a style to apply
	 */
	.editarea.display {
		display: inline;
	}
	.editarea {
		position: relative;
		float: right;
		/*display: none;*/
		background: #F3F3F3;
	}
	.editarea div{
		width:35px;
		height:35px;
	}
	.editarea .add {
		background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat 0 0;
	}
	.editarea .add:hover, .editarea .add:active {
		background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat 0 -35px;
	}
	.editarea .remove {
		background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -35px 0;
	}
	.editarea .remove:hover, .editarea .remove:active {
		background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -35px -35px;
	}
	.editarea .profile {
		background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -70px 0;
	}
	.editarea .profile:hover, .editarea .profile:active {
		background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -70px -35px;
	}
	.editarea .cloud {
		background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -105px 0;
	}
	.editarea .cloud:hover, .editarea .cloud:active {
		background: url(<?php echo base_url(); ?>images/friends_list/small-button.png) no-repeat -105px -35px;
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
	#bottomsection .fill .item {
		-webkit-transition: all 0.5s ease-in-out;
		-moz-transition: all 0.5s ease-in-out;
		transition: all 0.5s ease-in-out;
		display: inline-block;
		text-align: left;
		color: #700707;
		border-bottom: 1px solid #E0E0E0;
		padding-bottom: 5px;
	}
	#bottomsection .fill .item .name {
		text-transform: capitalize;
		font-size: 19px;
	}
	#bottomsection .fill .item .k_man {
		font-size: 16px;
	}
	#bottomsection .fill .item .k_man, #bottomsection .fill .item .name {
		display: inline-block;
		float: left;
		margin-right: 10px;
	}
	#bottomsection .fill .item div {
		float: left;
	}
	#bottomsection .fill .item .country {
		font-size: 14px;
	}
	#bottomsection .fill .item .profilepic {
		height: 85px;
		width: 85px;
		-webkit-border-radius: 6px;
		-moz-border-radius: 6px;
		border-radius: 6px;
		background-color: #ABABAB;
	}
	/* we have the text block started here and here we go @hesk */
	#bottomsection .fill .item .textblock {
		display: inline-block;
		height: 85px;
		margin-left: 5px;
	}
	#bottomsection .fill .item .textblock .top, #bottomsection .fill .item .textblock .k_man {
		clear: both;
	}
	#bottomsection .fill .item .editarea {
		width: 35px;
		height: 140px;
	}
	#bottomsection #titlebar {
		font-size: 21px;
		padding-top: 3px;
		padding-bottom: 3px;
		text-align: left;
		border-bottom: 1px solid #E0E0E0;
		width: 680px;
		margin: 0 auto;
	}
	#bottomsection .fill.myfans, #bottomsection .fill {

	}
</style>