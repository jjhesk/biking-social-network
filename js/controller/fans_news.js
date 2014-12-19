var content_area, debug = true, title_bar;
function testAnim(x) {
	$('#animateTest').removeClass().addClass(x);
	var wait = window.setTimeout(function() {
		$('#animateTest').removeClass()
	}, 1300);
}

var news_url = fans_obj.interface + "news/", view_url = fans_obj.interface + "profile/view/", pure_url = fans_obj.interface;
/*$(function() {
$pos = $('.sandbox').offset().top - 0;
$(window).on('scroll', function() {
if ($(window).scrollTop() >= $pos) {
$('.sandbox').addClass('fixed');
} else {
$('.sandbox').removeClass('fixed');
}
});
});*/
/*
* sample
$(document).ready(function() {
$('a[data-test]').click(function() {
var anim = $(this).attr('data-test');
testAnim(anim);
});
});
*/
//@source http://www.ericmmartin.com/projects/simplemodal/
//@source http://tyler-designs.com/masonry-ui/
//@source http://www.learningjquery.com/categories
// for how to use the simplemodal
var searchdata_base;
$.fn.hasDesc = function(tagfunction) {
	if (this.attr("desc") == undefined)
		return false;
	return k = (this.attr("desc").toLowerCase() == tagfunction) ? true : false;
}
var profileView = function(id) {
	var send = view_url + id;
	window.location.href = send;
}
var eventmap_event = {
	/*
	 * the map is mainly dealing with the listed below:
	 * 1) add friend - done
	 * 2) remove friend
	 * 3) send messages
	 * 4) view the profile - done
	 * 5) report the friend
	 */
	click : function(event) {
		var send, uid = jQuery(this).parent().parent().attr("uid"), ob = jQuery(this);
		var g = function(send) {
			jQuery.ajax(send).done(function(r) {
				if (parseInt(r) == 1) {
					ob.addClass("disabled");
				} else if (parseInt(r) == 0) {
				}
			});
		}
		var p = function(cmd) {
			send = frdsurl + cmd + "/" + uid;
			g(send);
		}
		if (ob.hasDesc("profile"))
			profileView(uid);
		if (ob.hasDesc("add from search")) {
			p("action_addfan");
		}
		if (ob.hasDesc("unconnect")) {
			p("action_unconnect");
		}
		if (ob.hasDesc("cancel the request")) {
			p("action_remove_my_request");
		}
		//initialization();
		//pieline_user_data_packet();
		//event.stopImmediatePropagation();
		//alert(event);
		event.preventDefault();
	}
};
// add friends and remove friends
function removefriend() {
	var ob = jQuery(this);
	var uid = ob.parent().parent().attr("uid");
	var send = frdsurl + "action_remove/" + uid;
	jQuery.ajax(send).done(function(r) {
		if (parseInt(r) == 1) {
			ob.addClass("disabled");
			pieline_user_data_packet();
		} else if (parseInt(r) == 0) {
		}
	});
}

function prototypecontent(x) {
	var s = mouse_hover_content + " | <span class=\"id\">ID " + x + "</span></div>";
	return s;
};
/*
 function send_add() {
 var uid = jQuery(this).attr("uid");
 var the_name = jQuery(this).html();
 //var the_name2=the_name.find("div .editarea").remove();
 var jxurl = frdsurl + "action_addfriend/";
 var jx_myfriends = frdsurl + "pieline_mypeople_limit/";
 var jx_notmyfriends = frdsurl + "pieline_notmypeople/";
 var data = {
 action : "#2423"
 };
 jxurl += uid;
 var jqxhr = $.ajax(jxurl).done(function() {
 jQuery("#response").html("You have successfully added a friend.");
 jQuery("#myfriends").load(jx_myfriends).done(time_convert);
 jQuery("#notmyfriends").load(jx_notmyfriends).done(time_convert);
 }).fail(function() {
 jQuery("#response").html("failed to add. ");
 }).always(function() {
 });

 jQuery.post({
 jxurl,
 data,
 function(r){
 if (r=="1"){
 jQuery("#response").html("You have successfully added "+the_name+" as your friend.");
 }else{
 jQuery("#response").html("failed to add. ");
 }
 }, "text"});

 }
 */
function search_click() {
	jQuery("section.invite").fadeOut(500);
	var ne = setTimeout(show_search_result, 500);
}

getJSONP = function(location, callback) {
	jQuery.ajax({
		url : location,
		dataType : 'JSONP',
		success : function(json) {
			callback(json);
		},
		error : function() {
			//handler error
		}
	})
}
row_resemble = function(a, b, c) {
	var h = "<span uid='";
	h += a;
	h += "'>";
	h += b;
	h += "<div class=\"editarea\"><span class=\"invite\">invite to my friends</span></div></span>";
	return h;
}
function external_search(search_query) {
	var section_out = jQuery("section.search_output");
	if (searchdata_base != "") {
		var x, cmdc = $("#page .inputbox select").val();
		if (cmdc != 0) {
			section_out.html("You can only search by name. ");
			return;
		}
		switch(searchdata_base) {
			case "facebook":
				x = "facebook_external/";
				section_out.load(frdsurl + x + search_query, function(r) {
					if ($.trim(r) == "0")
						section_out.html("There is no result found from " + searchdata_base);
				});
				break;
			case "twitter":
				var url = "https://api.twitter.com/1/users/search.json?q=";
				url += encodeURI(search_query);
				var items = [];
				getJSONP(url, function(json) {
					jQuery.each(jQuery.parseJSON(json), function(key, val) {
						items.push(val.name);
					});
					section_out.html(items.join("<br>"));
				});
				break;
			case "instagram":
				x = "facebook_external/";
				break;
			case "google":
				x = "facebook_external/";
				break;
			case "yahoo":
				x = "facebook_external/";
				break;
			case "bing":
				x = "facebook_external/";
				break;
		}
	}
};

eventmap_tabhover = {
	mouseenter : function(event) {
		var id = jQuery(this).attr("uid");
		//jQuery(prototypecontent(id)).appendTo(this);
		jQuery(this).find("div.editarea").addClass("display");
		event.stopImmediatePropagation();
	},
	mouseleave : function(event) {
		//jQuery(this).find("div.editarea").remove();
		jQuery(this).find("div.editarea").removeClass("display");
		event.stopImmediatePropagation();
	}
};
eventmap_section_invite = {
	click : function() {
		var Dis = jQuery(this);
		var all_social_networks = jQuery("section.invite");
		var classes = Dis.attr('class').split(' ');
		if (Dis.hasClass("selected")) {
			Dis.removeClass("selected");
			searchdata_base = "";
		} else {
			all_social_networks.removeClass('selected');
			Dis.addClass("selected");
			searchdata_base = classes[1];
		}
		////alert(searchdata_base);
		event.stopImmediatePropagation();
	}
};
eventmap_button_invite = {
	click : function(event) {
		var content_area = jQuery("#search_friends");
		var page = jQuery("#showpage");
		event.stopImmediatePropagation();
		if (search_bar) {
			page.html("");
			content_area.clone().appendTo("#showpage");
			page.slideDown(1000, function() {
				search_bar = !search_bar;
				//jQuery("section.invite").addClass("flipInX").delay(1300).removeClass("flipInX");
			});
			//searcharea.animate({
			// height: "toggle", opacity: "toggle"}, { duration: "slow" });
			//searcharea.addClass("flipInX").delay(1300).removeClass("flipInX");
			//jQuery("section.invite").fadeIn(1000);
		} else {
			page.slideUp(1000, function() {
				search_bar = !search_bar;
				page.html("");
			});
		}

		jQuery("section.search_output").html("");
		searchdata_base = "";
		//jQuery("#search_friends").accordion();
	}
};

var trigger_big_button_invite = function() {
	draw_out_search();
	if (!content_area.hasClass("explore"))
		content_area.html(fans_obj.loading);
	if (!search_bar)
		random_people();
	title_bar.html('<div class="random_people active">find friends</div><div class="mypendings">pendings</div>');
}
var trigger_big_button_news = function() {

	processurl(news_url + "getnews");
	title_bar.html('<div class="all_news active">most recent</div><div class="view_frds">friends news</div><div class="view_devices">devices news</div>');
}
var trigger_big_button_myfriends = function() {
	title_bar.html('<div class="my_frds active">my friends</div><div class="random_people">Explore</div><div class="add">Search Friends ( show )</div><div class="mypendings">my pendings</div>');
	//processurl(frdsurl + "pipeline_friends");
	my_frds();
}
var trigger_big_button_device = function() {
	processurl(news_url + "device_installed/" + userob.mylogin);
	title_bar.html('<div class="my_frds active">My Device</div>');
}
eventmap_button_groups = {
	mouseup : function(event) {
		////alert("k => called 445");
		$(this).find(".txt").removeClass("bigtxt");
		//event.stopImmediatePropagation();
		//  //alert('The mouse cursor is at ('+event.pageX + ', ' + event.pageY + ')')
		var Dis = jQuery(this);
		var allothers = jQuery("#triple_bann .button_fd");
		allothers.removeClass("active");
		Dis.addClass("active");
		var this_id = Dis.attr("id");
		if (this_id == undefined)
			this_id = Dis.parent().attr("id");
		////alert("this_id => "+this_id);
		var id = Dis.attr("uid");
		var jxurl, pre_content;
		//rename the title bar
		event.stopImmediatePropagation();
		event.preventDefault();
		switch(this_id) {
			case "device" :
				trigger_big_button_device();
				break;
			case "myfriends" :
				if (Dis.hasClass("invite")) {
					trigger_big_button_invite();
					return;
				} else {
					trigger_big_button_myfriends();
				}
				break;
			case "all" :
				// from the news
				trigger_big_button_news();
				break;
			default:
				break;
		}
		if (this_id != "invite") {
			//bug fix from draw out the search bar
			var c = jQuery("#myfriends .button_fd").hasClass("active");
			if (search_bar) {
				draw_out_search();
			};
			return false;
		}
		if (this_id == "invite") {
			return false;
		}

	},
	mousedown : function(event) {
		////alert("446");
		event.preventDefault();
		$(this).find(".txt").addClass("bigtxt");
	},
};

var ini_show = function() {
	content_area.html(fans_obj.loading);
	content_area.delay(1000).load(news_url + "getnews", initialization);
}
var output_string_area_main = function(stringContent, title) {
	var title_bar = jQuery("#bottomsection #titlebar");
	var content_area = jQuery("#bottomsection .fill");
	title_bar.html(title);
	//if(debug)//alert("line 397: dump content:" + stringContent);
	content_area.fadeOut(500, function() {
		content_area.html(fans_obj.loading);
		//if(debug)//alert("line 400: loading:" + stringContent);
		content_area.html(stringContent)
		content_area.delay(500).fadeIn();
	});
}
var output_area_main = function(url, title) {
	var title_bar = jQuery("#bottomsection #titlebar");
	title_bar.html(title);

	enter_loading_jax(url, "#bottomsection .fill");
}
/* enter the loading screen for the */
var enter_loading_jax = function(url, target_area_selector) {
	var content_area = jQuery(target_area_selector);
	content_area.fadeOut(500, function() {
		content_area.html(fans_obj.loading);
		content_area.delay(500).load(url, function(r) {
			if (parseInt(r) == 0)
				$(this).css("display", "none").slideDown(300);
			else {
				$(this).find("img").imgProfileAdjustment(85);
				$(this).css("display", "none")
				//display nothing
				.css("height", "auto")
				//set auto height
				.slideDown(300, initialization);
			}
		});
	});
}
var search_requirement;
/*execute search button event*/
var exe_search = function() {
	if (search_requirement == "")
		search_requirement = 0;
	//if(debug)//alert("line 462: execute search ");
	var placehold = jQuery("#search_friends input");
	var cmd, base, valu = placehold.val(), placeholder = placehold.attr("placeholder");
	/* to show what search options is taken*/
	switch(search_requirement) {
		case 0:
			cmd = "actionsearch_name/";
			placeholder.val("enter a name");
			break;
		case 1:
			cmd = "action_searchemail/";
			placeholder.val("enter an email");
			break;
		case 2:
			cmd = "action_searchid/";
			placeholder.val("enter an email");
			break;
		default:
			cmd = "actionsearch_name/";
			break;
	}
	/* to detect what external search on the social networks */
	switch(searchdata_base) {
		case 0:
			base = "actionsearch_name/";
			break;
		case 1:
			base = "action_searchemail/";
			break;
		case 2:
			base = "action_searchid/";
			break;
		default:
			break;
	}
	if (valu == "")
		return;
	if (search_requirement >= 0 && search_requirement < 3) {
		var k = frdsurl + cmd + escape(valu);
		output_area_main(k, "<div class='active'>Search Result</div>");
	} else {
		var k = frdsurl + cmd + escape(valu);
		//if(debug)//alert("line 510:\n"+k);
		output_area_main(k, "<div class='active'>Search Result</div>");
		//output_string_area_main("You may want to check it again.","No Result")
	}
	//	output_area_main(frdsurl+,"Search Result");
	//$options_search = array("by name", "by email", "by ID", "by gender", "by age");
};
/* call back from the UI*/
var select_from_list = function(listname, value) {
	//this is the object name from listname,
	//value to be selected
	if (listname == "searchRequirement") {
		search_requirement = value;
		//if(debug)//alert('line 517 search_requirement:'+search_requirement);
	}
}
/*
 *
 *
 * this is the start of a short library
 *
 * filter the numbers when the certain number is getting too big
 *
 *
 */
var num_constrian = function(t, limit) {
	var numbr = parseInt(t);
	var limit = parseInt(limit);
	return (numbr > limit) ? limit + "+" : numbr;
}
var printimg = function(url) {
	return '<img src="' + url + '"/>';
}
//news_url + 'getnews';
/* UI */
var event_map_list_item_select = {
	click : function(event) {
		event.stopImmediatePropagation();
		// the object of this .fans_selection
		var obj = $(this);
		//$(this).find("radius");
		var selected = obj.hasClass("selected");
		var the_list = obj.parent().parent().find(".fans_selection li");
		////alert("144");
		if (!selected) {
			////alert("146");
			the_list.removeClass("selected");
			obj.addClass("selected");
			//if(debug)//alert('search_requirement:'+the_list.parent().attr("value")+'  value: '+obj.children("span").attr("value"));
			select_from_list(the_list.parent().attr("value"), obj.children("span").attr("value"));
		} else {
			//obj.addClass("selected");
		}
		list_disappear($(this).parent().parent().find(".fans_selection"));
	}
};
var list_disappear = function(target) {
	selected = target.hasClass("show");
	if (selected)
		target.removeClass("show");
}
var key_enter_pressed = function(event) {
	if (event.keyCode == 13) {
		exe_search();
	}
}
var event_presskey = {
	keyup : key_enter_pressed
}
var event_map_fans_button_search = {
	click : function(event) {
		//event.stopImmediatePropagation();
		// click on the select butto n what will happened?
		var obj = $(this);
		var list = obj.find(".fans_selection");
		// the list panel
		var selected = obj.hasClass("pressed");
		// it this button pressed
		////alert("488");
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
var event_map_friend_action = {
	click : function(event) {
		ob = $(this);
		var c = ob.attr("class"), uid = ob.parent().attr("uid");
		// c can be "accept" or "reject"
		var q = frdsurl + "action_" + c + "/" + uid;
		// c can be reject or accept
		////alert(q);
		/*   show the command url here
		-> action_accept
		-> action_reject

		model
		-> accept_newfriend +ids
		-> reject_newfriend +ids

		*/
		jQuery.ajax(q).done(function(r) {
			if (parseInt(r) == 1) {
				ob.parent().fadeOut();
				initialization();
				//this action is successfully submitted
			} else if (parseInt(r) == 0) {
				//alert("there is an error.. it could be fatal. please report to our team.");
			}
		});
		event.stopImmediatePropagation();
	}
}
var draw_out_search = function() {
	//display and draw out the friend search area
	var title_bar = jQuery("#titlebar");
	var page = jQuery("#showpage");
	var Dis = jQuery("#myfriends .button_fd.invite");
	var DisButton = jQuery("#titlebar .add");
	if (!search_bar) {
		page.slideDown(500, function() {
			search_bar = !search_bar;
			DisButton.html("Search Friends");
		});
	} else {
		page.slideUp(500, function() {
			DisButton.html("Search Friends ( show )");
			search_bar = !search_bar;
			if (Dis != null)
				Dis.removeClass("active");
		});
	}
	jQuery("section.search_output").html("");
	searchdata_base = "";
}
var all_news = function() {
	var requested_url = news_url + "getnews";
	processurl(requested_url);

}
var view_frds = function() {
	var requested_url = news_url + "getnews/user";

	processurl(requested_url);
}
var view_devices = function() {
	var requested_url = news_url + "getnews/app";
	processurl(requested_url);

}
var add = function() {
	draw_out_search();
}
var callback_masonry = function() {
	jQuery("#js_item_manage img").imgProfileAdjustment(90);
	jQuery('#js_item_manage').masonry({
		itemSelector : '.item.kbox',
		columnWidth : 113,
		animationOptions : {
			duration : 400
		}
	});
	jQuery("#js_item_manage").masonry('reloadItems');
	jQuery('.item.kbox[uid]').click(function() {
		profileView(jQuery(this).attr("uid"));
	});
}
var random_people = function() {
	content_area.addClass("explore");
	var requested_url = frdsurl + "random_friends_related";
	processurl(requested_url, {
		callback : callback_masonry
	});
}
var mypendings = function() {
	content_area.addClass("pending");
	var requested_url = frdsurl + "pending_friends_ajax";
	processurl(requested_url, {
		callback : callback_masonry
	});
}
var processurl = function(url, extraoptions) {
	extraoptions = jQuery.extend({
		callback : null,
		callfore : null,
		init : true
	}, extraoptions);
	content_area.fadeOut(500, function() {
		content_area.css('display', 'block');
		content_area.html(fans_obj.loading);
		//content_area.fadeOut(500, function() {
		//alert("658");
		content_area.load(url, function() {

			if (extraoptions.init) {
				//alert("660");
				initialization();
			}
			if (extraoptions.callback != null) {
				//alert("665");
				extraoptions.callback.call();
			}
			//content_area.fadeIn(100);
			//alert("667");
		});
		//});
	});
};
var my_frds = function() {
	processurl(frdsurl + "pipeline_friends", {
		callback : function() {
			content_area.addClass("view_manage");
			content_area.viewmanage();
			//content_area.find(".view_manage")
			//.viewmanage();
			//alert("675");
		}
	});
}
jQuery.fn.viewmanage = function() {
	var D = this;
	var DD = D.find('.item .profilepic');
	DD.wrap('<a trigger="" />');
	DD.click(function() {
		var ob = $(this).parent().parent().find(".textblock");
		var obd = $(this).parent().parent().find(".editarea");
		var obs = $(this).parent().parent().find(".hidebox");
		var classed_shorted = obs.hasClass("show");
		//alert("classed shorted:" + classed_shorted);
		if (classed_shorted) {
			ob.removeClass("shorted");
			obd.removeClass("shorted");
			obs.removeClass("show");
		} else {
			ob.addClass("shorted");
			obd.addClass("shorted");
			setTimeout(function() {
				obs.addClass("show");
			}, 1000);
		}
	})
}
jQuery.fn.titletab = function(callback) {
	var arr = ["manage_friends", "random_people"];
	if (!this.hasClass("active")) {
		jQuery("#titlebar>div").removeClass("active");
		this.addClass("active");
		/* fix bugs in logics */
		if (search_bar && (!this.hasClass("add") || !this.hasClass("random_people"))) {
			draw_out_search();
		}
		if (callback != "my_frds") {
			content_area.removeClass("view_manage");
		}
		if (jQuery.inArray(callback, arr) == -1) {

		} else {
			//return false;
		}
		eval(callback + '();');
		return true;
	} else
		return false;
}
/* updates from the server when any action is taken on the front end */
var pieline_user_data_packet = function() {
	jQuery.ajax(frdsurl + "get_user_datapack").done(function(jsonlocal) {
		//if(debug)//alert("page_main 188 "+jsonlocal);
		eval("var o=" + jsonlocal + ";");
		//if(debug)//alert("page_main 190 "+o['totalfrds']+":"+o['myname']+":"+o['total_frd_requests']);
		//var obb = jQuery("#myfriends").find(".button_fd");

		var obb = jQuery("#myfriends .button_fd"), all_buttons = jQuery("#triple_bann .button_fd");

		if (parseInt(o.totalfrds) == 0) {
			if (!obb.hasClass("invite"))
				obb.addClass("invite");
			jQuery("#myfriends .txt").html("");
			jQuery("#myfriends label").html("Get Friends");
			trigger_big_button_invite();
		} else {
			if (obb.hasClass("invite"))
				obb.removeClass("invite");
			jQuery("#myfriends .txt").html(num_constrian(o.totalfrds, 900));
			jQuery("#myfriends label").html("Friends");
			ini_show();
		}
		jQuery("#name_tag").html(o.myname);
		//if(debug)//alert("#profile_pic - this is the one");
		if (parseInt(o.total_frd_requests) > 0) {
			jQuery("#request_tab .n").html(num_constrian(o.total_frd_requests, 99));
			//this is the titlebar actions for all buttons
			jQuery("#request_tab").live({
				//mouseover
				//click on this tab and a list of friends request will show on the top bar where you will able to see accept friends or reject friends
				click : function(event) {
					var ob = jQuery(this).find(".fans_selection");
					if (ob.hasClass("show")) {
						ob.removeClass("show");
					}
					var nfriend = jQuery(this).find(".n").html();
					if (parseInt(nfriend) == 0)
						return false;
					ob.html('<li class="textlines">' + fans_obj.loading + '</li>');
					ob.addClass("show");
					var send = frdsurl + "pieline_friendsrequestpanel/";
					//show a list of friend requests
					////alert("data sent:" + send);
					jQuery.ajax(send).done(function(r) {
						pieline_user_data_packet();
						//alert("loop me 758");
						if (parseInt(r) == 0) {
							ob.html('<li class="textlines">You have no friend request</li>');
							event.stopImmediatePropagation();
						} else {
							//this is coming from pieline_friendsrequestpanel friends_list.php
							ob.html(r);
						}
					});

				}
			});
			// DISPLAY THE FRIEND REQUEST NUMBER ON THE TOP
		} else {
			jQuery("#request_tab").css("display", "none");
		}
		//jQuery("#profile_pic").html(printimg(o.myprofilepic));
		//jQuery("#topbar img").imgProfileAdjustment(99);
		jQuery("#profile_pic").div_load_adjusted_image(o.myprofilepic, 85);
		var job = (o.work == null) ? "" : o.work;
		var location = (o.location == null) ? "" : o.location;
		//no work
		jQuery("#role").html("<span>" + location + "</span><br><span>" + job + "</span>");
		// role is the country and location
		jQuery("#lastupdate").html("<span>Last updated on</span><br><span>" + fanslivingDateHesk(o.lastupdate) + "</span>");
		//jQuery("#lastupdate").html(num_on_but(o.myname));
		//jQuery("#count_follow").html(o.follow);
		userob = o;
	});
}
var initialization = function() {
	//this will triggered after finsihed loading from the search result from friends.
	//var timeloc_1 = jQuery(".hidebox .text").attr("since");
	jQuery(".text.hidebox").each(function() {
		var Dis = jQuery(this);
		if (Dis.attr("since") === undefined) {
			return true;
			////alert("called each undefined");
		}
		////alert("called time_convert_children");
		Dis.time_convert_children("span");
	});
	jQuery(".textblock .issued").each(function(event) {
		var Dis = jQuery(this);
		Dis.time_convert_inline("Issued since");
	});
	jQuery(".textblock .add_device").each(function(event) {
		var Dis = jQuery(this);
		Dis.time_convert_inline("Installed since");
	});
	jQuery(".textblock").each(function(event) {
		var charlen = jQuery(this).text().length;
		var item = jQuery(this).parent();
		if (charlen > 146) {
			item.addClass('slidable');
		}
	});
	jQuery(".profilepic img").imgProfileAdjustment(85);
}
//jQuery.noConflict();
jQuery(function($) {
	search_bar = false;
	title_bar = jQuery("#titlebar")
	content_area = jQuery("#bottomsection .fill");
	//jQuery(".notfriends span").modal();
	var mouse_hover_content;
	pieline_user_data_packet();
	initialization();
	//jQuery("#nav_friendslist ul>li#serach_people").live(eventmap_button_invite);
	//jQuery.on("click","#nav_friendslist ul>li",)
	jQuery("#nav_friendslist ul>li").live(eventmap_button_groups);
	jQuery("section.search_output>.item,#showpage>span,#result>span").live(eventmap_tabhover);
	jQuery("button#search_button").live("click", search_click);
	//jQuery("#people #notmyfriends span").live("click", send_add);
	jQuery("section.invite").live(eventmap_section_invite);
	jQuery("#triple_bann .button_fd").live(eventmap_button_groups);
	//the add friend button
	jQuery(".hidebox.show.remove").live("click", removefriend);
	//when pressing the buttons for adding friends from the search result
	jQuery(".item>.editarea>div:not('.disabled')").live(eventmap_event);
	var content_area_for_clone = jQuery("#search_friends");
	content_area_for_clone.clone().appendTo("#showpage");
	jQuery("#showpage").css("display", "none");
	jQuery("#search_friends .search_submit").live({
		click : function() {
			jQuery("#search_friends input").val("").focus();
		}
	});
	jQuery(".fans_selection li").live(event_map_list_item_select);
	jQuery(".fans_button_search").live(event_map_fans_button_search);
	jQuery("#search_friends input").live(event_presskey);
	jQuery("#request_tab .accept").live(event_map_friend_action);
	jQuery("#request_tab .reject").live(event_map_friend_action);
	jQuery("#titlebar>div").live({
		//trigger the title tab from here
		click : function(event) {
			var DisClass = jQuery(this).attr('class').split(' ');
			jQuery(this).titletab(DisClass[0]);
			event.stopImmediatePropagation();
		}
	});

	//alert(hitEvent+' event is supported. line 876');
});
