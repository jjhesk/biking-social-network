var $ = jQuery;
//developed by hesk 2012-8
//http://localhost/fanslivings//images/index/speed.png
function landfill(url) {	//this loads when ajax page loading is used.
	//this is the fill up the whole right side page
	$("#page_content").html(fans_obj.loading);
	$("#page_content .flickr-loader").attr("style", "margin: 12px auto;");
	$("#page_content").load(url, immediate_after_landfill);
}

function immediate_after_landfill() {
	$(".nyroModal").colorbox({
		iframe : true,
		href : $(this).attr("href"),
		innerWidth : 800,
		innerHeight : 600
	});
}

function custom_onload() {
	//$('html, body').css('overflow', 'hidden');
}

function custom_onclose() {
	//$('html, body').css('overflow', '');
}

function custom_loading_colorbox() {
	$("#cboxLoadingGraphic").css("background-image", "none");
	$("#cboxLoadingGraphic").css("margin-top", "48%");
	$("#cboxLoadingGraphic").html(fans_obj.loading);
}

function colorbox_fix(loc) {
	$.colorbox({
		href : loc,
		scrolling : false,
		width : "80%",
		height : 450,
		iframe : false,
		onOpen : custom_loading_colorbox,
		onLoad : custom_onload,
		onClose : custom_onclose
	});
}

function footerbox(item) {
	$.colorbox({
		href : basic + '/corporate_info/' + item,
		scrolling : true,
		width : 800,
		height : "100%",
		iframe : false,
		onOpen : custom_loading_colorbox,
		onLoad : custom_onload,
		onClose : custom_onclose
	});
}

function colorbox_cal(loc) {
	$.colorbox({
		href : loc,
		scrolling : false,
		width : 730,
		height : 450,
		iframe : false,
		onComplete : function() {
			$.colorbox.resize();
		},
		onOpen : custom_loading_colorbox,
		onLoad : custom_onload,
		onClose : custom_onclose
	});
}

function colorbox_i(loc) {
	if ((window.screen.width <= 480)) {
		//alert("tpl 140 "+window.screen.width);
		$.colorbox({
			iframe : true,
			href : loc,
			innerWidth : 480,
			innerHeight : 320,
			onOpen : custom_loading_colorbox,
			onLoad : custom_onload,
			onClose : custom_onclose
		});

	} else if ((window.screen.width <= 768)) {
		alert("tpl 140 " + window.screen.width);
		$.colorbox({
			iframe : true,
			href : loc,
			innerWidth : 768,
			innerHeight : 512,
			onOpen : custom_loading_colorbox,
			onLoad : custom_onload,
			onClose : custom_onclose
		});

	} else {
		//alert("tpl 152 "+window.screen.width);
		$.colorbox({
			iframe : true,
			href : loc,
			innerWidth : 800,
			innerHeight : 600,
			onOpen : custom_loading_colorbox,
			onLoad : custom_onload,
			onClose : custom_onclose
		});
	}
}

function pipeline(url) {
	//the main contoller area
	// this is to fill up the content under the tab page
	$("#profile_tab").html(fans_obj.loading);
	//alert("jq.main_header_controller 117 "+url);
	$.get(url, function(data){
		//$("#profile_tab").html(data);
		$(".container").html(data);
		scan_loading_block();
		$(".nyroModal").colorbox({
			iframe : true,
			href : $(this).attr("href"),
			innerWidth : 800,
			innerHeight : 600,
			fastIframe : false,
			onOpen : custom_loading_colorbox,
			onLoad : custom_onload,
			onClose : custom_onclose
		});
		//alert("<br/>jq main header controller 172 tooltip run");
		if(url.indexOf("profile")!=-1){
			$(".container").tooltip();
			scrollToRight();
			loadcount=activity_list_loadcount-5;
			$("#square_photo_area").scroll(function(){
				if(isScrolledIntoView('#last_10_activities_'+loadcount)){
					//alert('run in');
					activity_list_getcontent();
					activity_list_loadcount+=5;
				}
			});
		}
		//alert("jq.main_header_controller 131 "+$(".container").html());
		if ( typeof block_weight_analysis != "undefined"){
			//alert("jq.main_header_controller 134 "+typeof block_weight_analysis);
			block_weight_analysis();
		}
	});
}
var activity_list_loadcount=0;
function activity_list_getcontent(){
	//LV2	
	//tmp=parseInt(activity_list_loadcount)+1;
	$.get(fans_obj.domain+"/profile/ajax_activity_list/"+activity_list_loadcount,  function(data){
		if($.trim(data)!='')
			$("#square_photo_area").append(data);
	});
}
function isScrolledIntoView(elem)
{
	//LV3
	if($(elem).length > 0){
	    var docViewTop = $(window).scrollTop();
	    var docViewBottom = docViewTop + $(window).height();
	
	    var elemTop = $(elem).offset().top;
	    var elemBottom = elemTop + $(elem).height();
	
		return ( (elemTop <= docViewBottom));
	}else{
		return false;
	}
}

function scan_loading_block() {
	$(".load_on_profile_tab").each(function(index) {
		var Dis = $(this);
		Dis.click(function(event) {
			//alert("jq.main_header_controller 143 "+$(Dis).attr("href"));
			var f = Dis.hasClass('active');
			
			$(".load_on_profile_tab").removeClass('active');
				Dis.addClass('active');
				pipeline(Dis.attr("href"));
		
			/*if (!f) {
				$(".load_on_profile_tab").removeClass('active');
				Dis.addClass('active');
				pipeline(Dis.attr("href"));
			} else {
				alert("jq.main_header_controller 150 Dis does not active");
				return false;
				//alert("no load");
			}*/
			event.stopImmediatePropagation();
			event.preventDefault();
		});
	});
}

function findstore() {
	var storeplace;
	if ($(document).find("#profile_tab").html() != undefined) {
		//alert("block_logined 26 "+ $(document).find("#profile_tab").html());
		storeplace = $("#profile_tab");
	} else {
		//alert("block_logined 29");
		storeplace = $("#page_content");

	}
	storeplace.fadeOut(1000, function() {
		var img = new Image();

		storeplace.html("");
		var url = fans_obj.domain + 'images/index/screen-findastore.png';
		img.onload = function() {
			storeplace.html('<div class="sampledata">sample data</div><img src="' + url + '" />');
			storeplace.fadeIn(500);
		}
		storeplace.html(fans_obj.loading);
		img.src = url;
	});
}



$(document).ready(function() {
	//alert('page_javascript 179');
	scan_loading_block();
	var loc = document.location.href;
	//alert(loc+loc.indexOf("index.php/settings"));
	var slug_capture = ["product", "community", "profile", "news", "settings"];
	var i;
	$(".nav_menu").removeClass("active");
	for ( i = 0; i < slug_capture.length; i++) {
		var name_from_url = slug_capture[i];
		if (loc.indexOf("index.php/" + name_from_url) >= 0) {
			//alert("block navigation 6 "+$(".left_"+slug_capture[i]).html());
			if (name_from_url == "product")
				name_from_url = "devices";
			if (name_from_url == "news")
				name_from_url = "newsfeed";
			var ob = $(".nav_menu ." + name_from_url);
			if (!ob.hasClass("active")) {
				ob.addClass("active");
				ob.parent().parent().addClass("active");
			}
		}
	}
	// .each() is used to create a closure to store a cache of the query.
	$('.slidedowncontent_head').each(function() {
		//@ source: http://www.jacklmoore.com/notes/jquery-accordion-tutorial
		var $content = $(this).closest('li').find('.content');
		$(this).click(function(e) {
			e.preventDefault();
			$content.not(':animated').slideToggle();
		});
	});
	
	
	//$(document).tooltip();

});

