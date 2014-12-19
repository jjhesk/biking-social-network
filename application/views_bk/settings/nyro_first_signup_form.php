<style>
.fans_selection li.selected .radius,.fans_selection li:hover .radius,.fans_selection li:active .radius{
background:url(<?php echo base_url(); ?>images/common/radio-button.png) no-repeat 0 0;

}
.fans_selection li .radius, .fans_selection li.not_selected .radius{
background:url(<?php echo base_url(); ?>images/common/radio-button.png) no-repeat 0 -20px;
width:20px;
height:20px;
float: left;
margin-right:10px;
}
.fans_selection li span{
text-align:left;
float:left;
font-size:16px;
}
.fans_selection li{
height: 20px;
padding-top: 10px;
margin: 0;
list-style: none;
padding: 10px;
border-bottom: 1px solid white;
}
.fans_selection li:first-child{
/*	background-color:#4d4d4d;*/
border-radius-top:2px;
-moz-border-radius-topright: 2px;
border-top-right-radius:  2px;
-moz-border-radius-topleft:  2px;
border-top-left-radius:  2px;
}
.fans_selection li:last-child{
/*	background-color:#4d4d4d;*/
-moz-border-radius-bottomright: 2px;
border-bottom-right-radius:  2px;
-moz-border-radius-bottomleft:  2px;
border-bottom-left-radius:  2px;
border-bottom: none;
}
.fans_selection li:hover{
color:#00A5E7;
background-color:#adadad;
background: -moz-linear-gradient(top, rgba(255,255,255,0.6) 0%, rgba(255,255,255,0.6) 48%, rgba(255,255,255,0.3) 51%, rgba(255,255,255,0.3) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.6)), color-stop(48%,rgba(255,255,255,0.6)), color-stop(51%,rgba(255,255,255,0.3)), color-stop(100%,rgba(255,255,255,0.3))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(255,255,255,0.6) 0%,rgba(255,255,255,0.6) 48%,rgba(255,255,255,0.3) 51%,rgba(255,255,255,0.3) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(255,255,255,0.6) 0%,rgba(255,255,255,0.6) 48%,rgba(255,255,255,0.3) 51%,rgba(255,255,255,0.3) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(255,255,255,0.6) 0%,rgba(255,255,255,0.6) 48%,rgba(255,255,255,0.3) 51%,rgba(255,255,255,0.3) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(255,255,255,0.6) 0%,rgba(255,255,255,0.6) 48%,rgba(255,255,255,0.3) 51%,rgba(255,255,255,0.3) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#99ffffff', endColorstr='#4dffffff',GradientType=0 ); /* IE6-9 */
}
.fans_selection{
bottom: -23px;
left: -23px;
background-color: #444;
background-image: -moz-linear-gradient(top, #444, #444);
position: relative;
color: #eee;
padding: 0px;
border-radius: 3px;
margin: 25px;
min-height: 50px;
max-width:500px;
width: 100px;
float: left;
-o-box-shadow:0 0 0 2px #ffffff, 0 0 0 4px #D9D9D9; /* Firefox 3.6 and earlier */
-moz-box-shadow:0 0 0 2px #ffffff, 0 0 0 4px #D9D9D9; /* Firefox 3.6 and earlier */
-webkit-box-shadow:0 0 0 2px #ffffff, 0 0 0 4px #D9D9D9;; /* Safari and Chrome */
box-shadow: 0 0 0 2px #ffffff, 0 0 0 4px #D9D9D9;
/*	box-shadow: 0 1px 0 rgba(255, 255, 255, 0.2) inset;*/
background: rgb(101,215,255); /* Old browsers */
background: -moz-linear-gradient(top, rgba(101,215,255,1) 0%, rgba(0,174,235,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(101,215,255,1)), color-stop(100%,rgba(0,174,235,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(101,215,255,1) 0%,rgba(0,174,235,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(101,215,255,1) 0%,rgba(0,174,235,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(101,215,255,1) 0%,rgba(0,174,235,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(101,215,255,1) 0%,rgba(0,174,235,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#65d7ff', endColorstr='#00aeeb',GradientType=0 ); /* IE6-9 */
display:none;
-webkit-transition: 1s ease;
-moz-transition: 1s ease;
-o-transition: 1s ease;
-ms-transition: 1s ease;
transition: 1s ease;
}
.fans_selection.show{
display:block;
bottom: -23px;
z-index: 999;
}
.fans_selection::before {
content: "";
width: 0px;
height: 0px;
border: 10px solid transparent;
position: absolute;
}

.fans_selection.top::before {
left: 43%;
bottom: -20px;
border-top: 10px solid rgba(101,215,255,1);
}

.fans_selection.bottom::before {
left: 3px;
height: 14px;
top: -24px;
width: 16px;
/*border-bottom: 10px solid rgba(101,215,255,1);*/
background:url(<?php echo base_url(); ?>images/common/pointer-up.png) no-repeat 0 0;
}

.fans_selection.left::before {
right: -20px;
top: 42%;
border-left: 10px solid rgba(101,215,255,1);
}

.fans_selection.right::before {
left: -20px;
top: 42%;
border-right: 10px solid rgba(101,215,255,1);
}

.fans_selection.top-left::before {
left: 7px;
bottom: -20px;
border-top: 10px solid rgba(101,215,255,1);
}

.fans_selection.top-right::before {
right: 7px;
bottom: -20px;
border-top: 10px solid rgba(101,215,255,1);
}

.fans_button_search{
width: 45px;
height: 45px;
position: relative;
float: left;
top:2px;
background: url(<?php echo base_url(); ?>images/common/search-button.png) no-repeat 0 0;
}
.fans_button_search:hover,.fans_button_search.pressed{
background: url(<?php echo base_url(); ?>images/common/search-button.png) no-repeat 0 -45px;
}
.function{
	
	display:block;
}
.function label{
display: block;
line-height: 49px;
	color:#409C0E;

}
.function input,
.function input:active,.function input:focus{
position: relative;
float: left;
font-size: 33px;
width: 161px;
margin-top: 6px;
margin-left: 6px;
padding: 0px 9px;
vertical-align: middle;
-webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px;
background: none;
border: none;
color: #00A5E7;
}

.function input:active,.function input:focus{
	background: rgba(255,255,255,.89);
}
.function .face{
	height:50px;
	background: rgb(242,242,242); /* Old browsers */
background: -moz-linear-gradient(top, rgba(242,242,242,1) 0%, rgba(230,230,230,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(242,242,242,1)), color-stop(100%,rgba(230,230,230,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(242,242,242,1) 0%,rgba(230,230,230,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(242,242,242,1) 0%,rgba(230,230,230,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(242,242,242,1) 0%,rgba(230,230,230,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(242,242,242,1) 0%,rgba(230,230,230,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f2f2', endColorstr='#e6e6e6',GradientType=0 ); /* IE6-9 */

-webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px;

-o-box-shadow:0 0 0 2px #ffffff, 0 0 0 4px #D9D9D9; /* Firefox 3.6 and earlier */
-moz-box-shadow:0 0 0 2px #ffffff, 0 0 0 4px #D9D9D9; /* Firefox 3.6 and earlier */
-webkit-box-shadow:0 0 0 2px #ffffff, 0 0 0 4px #D9D9D9;; /* Safari and Chrome */
box-shadow: 0 0 0 2px #ffffff, 0 0 0 4px #D9D9D9;
}
.fans_inputbar{
  
}
.panel{width: 320px;}
.panel .title span,
.panel .function,
.panel .buttons{
	margin-left:40px;
	width: 220px;
}
.panel .title{
border-radius-top:10px;
-moz-border-radius-topright: 10px;
border-top-right-radius:  10px;
-moz-border-radius-topleft:  10px;
border-top-left-radius:  10px;
border-bottom:1px solid #A6A6A6;
font-size:32px;
background:#ccc;
}
.panel .title span{
line-height: 54px;
}

.panel .panelcontent{
border-radius-bottom:10px;
-moz-border-radius-bottomright: 10px;
border-bottom-right-radius:  10px;
-moz-border-radius-bottomleft:  10px;
border-bottom-left-radius:  10px;
background:#E6E6E6;
display: block;
height: 500px;
}
.panel .submit{
background: rgb(40,189,250); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(40,189,250,1) 0%, rgba(0,165,232,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(40,189,250,1)), color-stop(100%,rgba(0,165,232,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(40,189,250,1) 0%,rgba(0,165,232,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(40,189,250,1) 0%,rgba(0,165,232,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(40,189,250,1) 0%,rgba(0,165,232,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(40,189,250,1) 0%,rgba(0,165,232,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#28bdfa', endColorstr='#00a5e8',GradientType=0 ); /* IE6-9 */
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
-o-box-shadow:0 0 0 1px #7ed6fb, 0 0 0 2px #3172bb; /* Firefox 3.6 and earlier */
-moz-box-shadow:0 0 0 1px #7ed6fb, 0 0 0 2px #3172bb; /* Firefox 3.6 and earlier */
-webkit-box-shadow:0 0 0 1px #7ed6fb, 0 0 0 2px #3172bb, 0 2px 5px 3px #ccc; /* Safari and Chrome */
box-shadow: 0 0 0 1px #7ed6fb, 0 0 0 2px #3172bb, 0 2px 5px 3px #ccc;

text-align: center;
height: 30px;
line-height: 28px;
padding: 0;
margin: 30px;
margin-left: 40px;
text-transform: capitalize;
color: white;
font-size: 17px;
width: 127px;
}
.panel .submit:hover,.panel .submit:active,.panel .submit:focus{
}
body{
background: rgb(76,76,76); /* Old browsers */
background: -moz-linear-gradient(top, rgba(76,76,76,1) 0%, rgba(89,89,89,1) 12%, rgba(102,102,102,1) 25%, rgba(71,71,71,1) 39%, rgba(44,44,44,1) 50%, rgba(0,0,0,1) 51%, rgba(17,17,17,1) 60%, rgba(43,43,43,1) 76%, rgba(28,28,28,1) 91%, rgba(19,19,19,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(76,76,76,1)), color-stop(12%,rgba(89,89,89,1)), color-stop(25%,rgba(102,102,102,1)), color-stop(39%,rgba(71,71,71,1)), color-stop(50%,rgba(44,44,44,1)), color-stop(51%,rgba(0,0,0,1)), color-stop(60%,rgba(17,17,17,1)), color-stop(76%,rgba(43,43,43,1)), color-stop(91%,rgba(28,28,28,1)), color-stop(100%,rgba(19,19,19,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(76,76,76,1) 0%,rgba(89,89,89,1) 12%,rgba(102,102,102,1) 25%,rgba(71,71,71,1) 39%,rgba(44,44,44,1) 50%,rgba(0,0,0,1) 51%,rgba(17,17,17,1) 60%,rgba(43,43,43,1) 76%,rgba(28,28,28,1) 91%,rgba(19,19,19,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(76,76,76,1) 0%,rgba(89,89,89,1) 12%,rgba(102,102,102,1) 25%,rgba(71,71,71,1) 39%,rgba(44,44,44,1) 50%,rgba(0,0,0,1) 51%,rgba(17,17,17,1) 60%,rgba(43,43,43,1) 76%,rgba(28,28,28,1) 91%,rgba(19,19,19,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(76,76,76,1) 0%,rgba(89,89,89,1) 12%,rgba(102,102,102,1) 25%,rgba(71,71,71,1) 39%,rgba(44,44,44,1) 50%,rgba(0,0,0,1) 51%,rgba(17,17,17,1) 60%,rgba(43,43,43,1) 76%,rgba(28,28,28,1) 91%,rgba(19,19,19,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(76,76,76,1) 0%,rgba(89,89,89,1) 12%,rgba(102,102,102,1) 25%,rgba(71,71,71,1) 39%,rgba(44,44,44,1) 50%,rgba(0,0,0,1) 51%,rgba(17,17,17,1) 60%,rgba(43,43,43,1) 76%,rgba(28,28,28,1) 91%,rgba(19,19,19,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4c4c4c', endColorstr='#131313',GradientType=0 ); /* IE6-9 */
}
input[type="text"], input[type="password"], textarea, input[type="number"],input[type="email"]{ outline: none; }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
	var event_map_list_item_select = {
		click : function(event) {
			event.stopImmediatePropagation();
			var obj = $(this);
			//$(this).find("radius");
			var selected = obj.hasClass("selected");
			var the_list = obj.parent().parent().find(".fans_selection li");
		//	alert("144");
			if (!selected) {
			//	alert("146");
				the_list.removeClass("selected");
				obj.addClass("selected");
			} else {
				//obj.addClass("selected");
			}
			list_disappear($(this).parent().parent().find(".fans_selection"));
		}
	};
	var list_disappear = function(target){
		selected =target.hasClass("show");
		if(selected)target.removeClass("show");
	}
	var event_map_fans_button_search={
		click:function(event){
			//event.stopImmediatePropagation();
			// click on the select butto n what will happened?
			var obj = $(this);
			var list =obj.find(".fans_selection"); // the list panel
			var selected = obj.hasClass("pressed"); // it this button pressed
			if (!selected) {
				list.addClass("show");
				//obj.removeClass("pressed");
				obj.addClass("pressed");
			} else {
				obj.removeClass("pressed");
				list_disappear(list);
			}
		}
	};
	$(function() {
		//alert("155 loaded");
		$(".fans_selection li").live(event_map_list_item_select);
		$(".fans_button_search").live(event_map_fans_button_search);
	});
</script>
<div class="panel">
	<div class="title">
		<span>this is the title</span>
	</div>
	<div class="panelcontent">
		<div class="function">
			<label for="bw_123">Body weight</label>
			<div class="face">
			<input id="bw_123" placeholder="180" type="text" value="" />
			<div class="fans_button_search">
				<ul class="fans_selection bottom">
					<li>
						<div class="radius"></div><span>kg</span>
					</li>
					<li>
						<div class="radius"></div><span>lb</span>
					</li>
				</ul>
			</div>
			</div>
		</div>
		<div class="function">
			<label for="bw_124">Body height</label>
			<div class="face">
			<input id="bw_124" placeholder="230" type="text" value=""/>
			<div class="fans_button_search">
				<ul class="fans_selection bottom">
					<li>
						<div class="radius"></div><span>cm</span>
					</li>
					<li>
						<div class="radius"></div><span>ft</span>
					</li>
				</ul>
			</div>
			</div>
		</div>
		<div class="function">
			<label for="career_3322">Career</label>
			<div class="face">
			<input id="career_3322" placeholder="enter your job" type="text" value=""/>
			<div class="fans_button_search">
				<ul class="fans_selection bottom">
					<li>
						<div class="radius"></div><span>accountant</span>
					</li>
					<li>
						<div class="radius"></div><span>pilot</span>
					</li>
					<li>
						<div class="radius"></div><span>teacher</span>
					</li>
					<li>
						<div class="radius"></div><span>traveler</span>
					</li>
					<li>
						<div class="radius"></div><span>chief</span>
					</li>
				</ul>
			</div>
			</div>
		</div>
		<div class="submit">submit</div>
	</div>
</div>
