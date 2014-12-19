<script>
	/**!
	 Developed by Heskeyo Kam
	 @license    creativecommons / 2012 HKM
	 @author     Heskeyo Kam
	 @dependencies   royalslider shuffleLetters.js, thumbnailScroller.js, $, layout settings data
	 */
	var h;
	var t = 0;
	var k = 0;
	var community = "";
	/**
     *
     *  DATA AND WIDGET VISUALIZATION
     *  This part of the template is all started from [render_widget_] + extended function name space.
     *  This is started from the first part of the data visualization
     *  @param obj_data
     *  @author Heskeyo Kam
     */
    function render_widget_max_record(obj_data) {
        var maxspeed = obj_data.param.maxspeed;
        var myprofilepic = obj_data.param.userprofilepicture;
        var username = obj_data.param.username;
        var buffer = "<div id=\"" + obj_data.widget + "\" class=\"bar1\"><div class=\"part_b\">" + obj_data.param.title + "</div><div id=\"maxspeed\" class=\"part_e\">" + maxspeed + "</div><div id=\"unit\" class=\"part_f\">km/h</div><div id=\"profile_pic\"></div><div id=\"name_tag\" class=\"blue_txt\">" + username + "<span id=\"role\"><br></span></div></div>";
        $(".rightsideproductinfo").append(buffer);
        $("#profile_pic").div_load_adjusted_image(myprofilepic, 85);
    }

    function render_widget_total_users_around_the_world(obj_data) {
        var data2 = "product/view/4";
        var data1 = "TOTAL meters<br>around the world";
        var buffer = "<div id=\"" + obj_data.widget + "\" class=\"bar2\"><div class=\"part_b\">";
        buffer += data1 + "</div><div id=\"heskcoun\" class=\"part_c\"></div><div class=\"more\">";
        buffer += "<ul class=\"blue_txt fastlink\"><li><a href=" + fans_obj.interface + data2;
        buffer += ">Learn more</a></li></ul></div></div>";
        $(".rightsideproductinfo").append(buffer);
        $("#heskcoun").heskCounter(k.toString());
        getTimeR();
    }
    function render_widget_petnfans_missing_pet_list(obj_data) {
        console.log(obj_data);
        //var maxspeed = obj_data.param.maxspeed;
        //var myprofilepic = obj_data.param.userprofilepicture;
        //var username = obj_data.param.username;
        var buffer = //"<div id=\"" + obj_data.widget + "\" class=\"bar1\"><div class=\"part_b\"> Missing Pets </div><div id=\"maxspeed\" class=\"part_e\">" + "</div><div id=\"unit\" class=\"part_f\">km/h</div><div id=\"profile_pic\"></div></div>";
        '<div class="bar1" style="position: relative; ">'  +
		'<a href="<?=site_url('community/petnfans_missing_pets')?>"><img style="position: absolute; bottom:0; right:0" border="0" src="<?=base_url()?>/images/petnfans/banner_missing_pets.png"/></a>'+        
        '</div>' 
        ;
        
        //var buffer = "petnfans missing pet";
        $(".rightsideproductinfo").append(buffer);
        //$("#profile_pic").div_load_adjusted_image(myprofilepic, 85);
    }
    
    function render_widget_vote(obj_data) {
    	console.log(obj_data);

		var votee_json = eval(obj_data.votee.custom_data_json);
		console.log(votee_json);

		var buffer = //"<div id=\"" + obj_data.widget + "\" class=\"bar1\"><div class=\"part_b\"> Missing Pets </div><div id=\"maxspeed\" class=\"part_e\">" + "</div><div id=\"unit\" class=\"part_f\">km/h</div><div id=\"profile_pic\"></div></div>";
        '<div class="bar1">'  +
        '<div class="part_b"><span style="text-transform:uppercase;">'  +
        obj_data.vote.vote_name+
        '</span><br>'+ obj_data.vote.vote_description +'</div>'  +

        '<div class="part_e">'  +
	        obj_data.votee.vote_count+
        '</div>'  + 
        '<div class="part_f">likes</div>'  +

        '<div id="profile_pic"></div>' +  
        '<div class="blue_txt">' + obj_data.votee.name + '<br>'+ votee_json[0].Breed +'</div>' +

        '</div>'        
        ;

		$(".rightsideproductinfo").append(buffer);
		$("#profile_pic").div_load_adjusted_image(obj_data.votee.image, 85);
	}

    
    
	var done_loading = function(r) {
		if (r == "0") {
			$(this).css("display", "none").fadeIn(2000);
		} else {

			$(".nyroModal").click(function(event) {
				var Dis_url = $(this).attr("href");
				localnyrocall(Dis_url);
			});
			var t = $(this).parent().parent().attr("id");
			$.getScript(burl_jqlib + "jthumscroller.js").done(function(script, textStatus) {

				$("#" + t).thumbnailScroller({
					// documentation on http://manos.malihu.gr/$-thumbnail-scroller
					scrollerType : "clickButtons",
					scrollerOrientation : "horizontal",
					scrollSpeed : 2,
					scrollEasing : "easeOutCirc",
					scrollEasingAmount : 600,
					acceleration : 4,
					scrollSpeed : 800,
					noScrollCenterSpace : 30,
					autoScrolling : 0,
					autoScrollingSpeed : 2000,
					autoScrollingEasing : "easeInOutQuad",
					autoScrollingDelay : 500
				});
			}).fail(function(jqxhr, settings, exception) {
				alert("product_extra_b");
				$("#product_extra_b").css("display", "none");
			});
		}
	};

	var initialization = function() {
		var pid = getLastSlugVal("app")===-1?2:getLastSlugVal("app");
		if ( typeof (fans_obj) == "object") {
			fans_obj.current_app_id = pid;
		}
		loc = fans_obj.interface + "community/api_getstack/" + pid;
		$.ajax(loc).done(function(jsonlocal) {
			eval("var o=" + jsonlocal + ";");
			var data_stack = o.app_data;
			$(".rightsideproductinfo span.big.blue_txt").shuffleLetters({
				"text" : o.product_name,"fps":33,"step":eval_step(o.product_name)
			});
			$("#bannertext_community").shuffleLetters({
				"text" : o.product_name + " Community", "fps":33,"step":eval_step(o.product_name)
			});
			$(".rightsideproductinfo span.small").shuffleLetters({
				"text" : o.product_summary,"fps":33,"step":eval_step(o.product_name)
			});
			//console.log("object from the top stack");
			//console.log(o);
			//console.log(fans_obj.external_imgbin);
			//fans_obj.external_imgbin +
			$(".producticon").div_load_adjusted_image(o.product_image_url, 300);
			$(".appicon").div_load_adjusted_image(o.product_appicon, 100);
			$(".blue_txt").html(o.product_name);
			if (data_stack.result == "no data") {
				//console.log(data_stack);
			} else {
			    init_widgets(2, data_stack);
			}
		});
	}
	/**!
	 * TRIGGER AND START THE WIDGET RENDERING PROCESS FROM JSON DATA
	 * @param limit - what is the limitation of the total widgets that will be rendered.
	 * @param data - this is the input for the json data.
	 * @author Heskeyo Kam
	 */
	function init_widgets(limit, data) {
		for (var i = 0; i < limit; i++) {
			var function_name = data[i].widget;
			var dataobj = data[i];
			eval("render_widget_"+function_name+"(dataobj);");
		}
	}


	//controls: 'pagination',
	var localnyrocall = function(url) {
		$('.nyroModal').colorbox({
			iframe : true,
			href : url,
			innerWidth : 800,
			innerHeight : 600
		});
	}
	var timer, k_init = 255155;
	function getTimeR() {
		var delta = 5000;
		k_init++;
		var t = Math.floor(Math.random() * delta) + 150;
		$("#heskcoun").heskCounter(k_init.toString(), true);
		clearInterval(timer);
		timer = setInterval(getTimeR, t);
	}

	//================DISCUSSION PART =====================

	function ini_discussion() {
		var sectiondiscussion = $("<section>", {
			"class" : "discussion"
		}).html(fans_obj.loading);
		var topic_box_send = $("<button>", {
			"class" : "sendbutton"
		}).html("POST");
		var topic_box_input = $("<textarea>", {
			"type" : "text",
			"placeholder" : "Write here...",
			"name" : "topic_box_input"
		});
		// $(".rightsideproductinfo span.big.blue_txt").text();
		//   var span = community+" community";
		//  console.log(span);
		var community_text = $("<div>", {
			"class" : "community_txt bigbluetxt",
			"id" : "bannertext_community"
		});
		var section_need_to_login = $("<section>", {
			"class" : "login_n_discuss cruv_feature"
		}).html("Please login and leave your comments.");
		var section_login_comment = $("<section>", {
			"class" : "login_n_discuss cruv_feature replybox"
		}).append(topic_box_input, topic_box_send);
		if (fans_obj.islogin) {
			$("#page_content").append(community_text, section_login_comment, sectiondiscussion);
		} else {
			$("#page_content").append(community_text, section_need_to_login, sectiondiscussion);
		}
		var loc = fans_obj.interface + "community/api_get_comment_discussion/" + fans_obj.current_app_id;
		$.ajax(loc).done(function(jsonlocal) {
			eval("var o=" + jsonlocal + ";");
			//console.log(o)
			var discussioncontent = $("<section>", {
				"class" : "discussion"
			}).html(fans_obj.loading);
			$("section.discussion").attr("discussionid", o.discussion_id);
			var html = "";
			if (o.comments_array == "no data found") {
				console.log("there is no data found");
				html = "Start your disscussion here."
			} else {
				if (o.comments_array.length > 0) {
					$.each(o.comments_array, function(key, value) {
						html += comment_detail_render(value);
					});

				}
			}
			$("section.discussion").html(html);
			//console.log(html);
			application_ini();
		});
	}

	function subcomments_detail(single_sub) {
		//  console.log(single_sub);
		var name = $("<div>", {
			"class" : "subcomments_displayname"
		}).html(single_sub.firstname + " " + single_sub.lastname + ":");
		var update = $("<div>", {
			"class" : "subcomments_timestamp"
		}).html(fanslivingDateHesk(single_sub.last_updated));
		var content_text = $("<div>", {
			"class" : "subcomments_comment"
		}).html(single_sub.comment_text);
		var arrow = $("<div>", {
			"class" : "subcomments_arrow"
		});

		var likedislike = ranking_likedislike_component(single_sub);
		var ranking = ranking_component(single_sub);
		return ToHTML($("<div>", {
			"class" : "sub",
			"sub_comment_id" : single_sub.comment_id
		}).append(arrow, name, content_text, update, likedislike, ranking, "<br>"));
	}

	//this is expected to be the array
	function sub_comment_component(single_subcomments) {
		var limit_subcomments_each_page = 10;
		var total_paginations = 10;
		var subcomment_html = "";
		var discussion_id = single_subcomments.comment_id;
		if (single_subcomments.subcomment_count > 0) {
			$.each(single_subcomments.subcomment_array.reverse(), function(key, value) {
				if (key > limit_subcomments_each_page) {
					return;
				} else {
					subcomment_html += subcomments_detail(value);
				}
			});
			if (single_subcomments.subcomment_count > limit_subcomments_each_page) {
				var do_page = "", control_pages;
				var total_pages = Math.ceil(single_subcomments.subcomment_count / limit_subcomments_each_page);
				if (total_pages > total_paginations) {
					control_pages = total_paginations;
				} else {
					control_pages = total_pages;
				}
				for (var i = 0; i < control_pages; i++) {
					var display_i = i + 1;
					do_page += "<li><a href='javascript:dp(" + i + "," + discussion_id + ")'>" + display_i + "</a></li>";
				}
				if (total_pages > total_paginations) {
					do_page += "<li>...<a href='javascript:dp(" + total_pages + "," + discussion_id + ")'>" + total_pages + "</a></li><li><a href='javascript:dpnextpage(" + discussion_id + ")'>next</a></li>";
				}
				subcomment_html += "to read more...<br><ul class='rowbuttons pagination'>" + do_page + "</ul>";
			}
		}
		return subcomment_html;
	}

	function ranking_likedislike_component(data_object_likedislike) {
		//this is only triggered on intialization and regenerations of new html part
		console.log(data_object_likedislike);
		var input_data = {
			self_like_dislike : data_object_likedislike.self_like_dislike,
			num_likes : data_object_likedislike.statistic.like[0],
			num_dislikes : data_object_likedislike.statistic.like[1]
		}
		var data = $.extend({
			num_likes : 0,
			num_dislikes : 0,
			self_like_dislike : -1
		}, input_data);
		var like_icon = $("<div>", {
			"class" : "like_icon"
		});
		var like_active = "", dislike_active = "";
		if (parseInt(data.self_like_dislike) == 0) {
			dislike_active = "active";
		}
		if (parseInt(data.self_like_dislike) == 1) {
			like_active = "active";
		}
		var like = $("<li>", {
			"class" : "num_likes " + like_active
		}).append(like_icon, "<span>" + data.num_likes + "</span>");
		var dislike_icon = $("<div>", {
			"class" : "dislike_icon"
		});
		var dislike = $("<li>", {
			"class" : "num_dislikes " + dislike_active
		}).append(dislike_icon, "<span>" + data.num_dislikes + "</span>");
		return $("<ul>", {
			"class" : "rowbuttons likedis"
		}).append(like, dislike);
	}

	function ranking_component(data_object_emot) {
		//this is only triggered on intialization and regenerations of new html part
		//data is expected to be an object
		var dataset = {
			self_face : (data_object_emot.self_face == null) ? -1 : data_object_emot.self_face,
			countface : data_object_emot.statistic.face
		};
		
		var self_smile_active = "", self_sad_active = "", self_oops_active = "", self_blank_active = "";
		var selecting_which_face = parseInt(dataset.self_face);
		//console.log(dataset)
		if (selecting_which_face === 0) {
			self_smile_active = " active";
		}else if (selecting_which_face === 1) {
			self_sad_active = " active";
		}else if (selecting_which_face === 2) {
			self_oops_active = " active";
		}else if (selecting_which_face === 3) {
			self_blank_active = " active";
		}
		var buffer = "<li class='smile" + self_smile_active;
		buffer += "'><div class='emot_smile'></div><span>" + dataset.countface[0];
		buffer += "</span></li><li class='sad" + self_sad_active;
		buffer += "'><div class='emot_sad'></div><span>" + dataset.countface[1];
		buffer += "</span></li><li class='oops" + self_oops_active;
		buffer += "'><div class='emot_oops'></div><span>" + dataset.countface[2];
		buffer += "</span></li><li class='blank" + self_blank_active + "'><div class='emot_blank'></div><span>";
		buffer += dataset.countface[3] + "</span></li>";
		return $("<ul>", {
			"class" : "rowbuttons emotface"
		}).html(buffer);
	}

	function comment_detail_render(single_thread_data) {
		var img_1 = $("<img>", {
			"src" : single_thread_data.profile_image
		});
		var img = $("<div>", {
			"class" : "comm_img",
			"user" : single_thread_data.user_inhouse_id
		}).append(img_1);
		/*
		 var img_self = $("<img>", {
		 "src" : single_thread_data.profile_image
		 });*/
		var name = $("<div>", {
			"class" : "name"
		}).html(single_thread_data.display_name);
		var update = $("<div>", {
			"class" : "timestamp"
		}).html(fanslivingDateHesk(single_thread_data.last_updated));
		var content_text = $("<div>", {
			"class" : "comment_main_text"
		}).html(single_thread_data.comment_text);

		var likedislike = ranking_likedislike_component(single_thread_data);
		var listing_score = ranking_component(single_thread_data);
		var subcomments = $("<section>", {
			"class" : "subcomments"
		}).html(sub_comment_component(single_thread_data));
		var reply_box_send = $("<button>", {
			"class" : "sendbutton"
		}).html("REPLY");
		var reply_box_input = $("<input>", {
			"type" : "text",
			"placeholder" : "Write a comment...",
			"name" : "reply_box_input",
			"id" : "subcomment:" + single_thread_data.comment_id
		});
		var reply_box = $("<section>", {
			"class" : "replybox"
		}).append(reply_box_input, reply_box_send);
		//reply_box_send
		var contentpart = $("<div>", {
			"class" : "content"
		});
		if (fans_obj.islogin) {
			contentpart.append(name, content_text, update, likedislike, listing_score, reply_box, subcomments);
		} else {
			contentpart.append(name, content_text, update, likedislike, listing_score, subcomments);
		}
		var article = $("<article>", {
			"class" : "comment cruv_feature",
			"id" : single_thread_data.comment_id
		}).append(img, contentpart);
		return ToHTML(article);
	}

	var statistic_data_default = {
		like : [0, 0],
		face : [0, 0, 0, 0]
	}
	function sub_success_callback(data) {
		var predata = {
			firstname : fans_obj.webview.user_1,
			lastname : fans_obj.webview.user_2,
			last_updated : "right now",
			comment_text : htmlEntities(data.comment_text),
			comment_id : data.comment_id,
			statistic : statistic_data_default,
			self_like_dislike : -1,
			self_face : -1
		}
		var query_base = "article[id=" + data.discussion_id + "]";
		$(query_base + " section.replybox input").attr("disabled", false).val("");
		$(query_base + " section.subcomments").prepend(subcomments_detail(predata));

		var feedback_face = $(query_base + " section.subcomments .sub ul.emotface>li");
		var feedback_like = $(query_base + " section.subcomments .sub ul.likedis>li");

		feedback_like.on("click touchstart", function(event) {
			objdata_ranking_abstract($(this), "thread", "like");
			event.preventDefault();
		});
		feedback_face.on("click touchstart", function(event) {
			objdata_ranking_abstract($(this), "thread", "face");
			event.preventDefault();
		});

	}

	function topic_success_callback(data) {
		var predata = {
			display_name : fans_obj.webview.user_name,
			last_updated : "right now",
			comment_text : htmlEntities(data.comment_text),
			comment_id : data.comment_id,
			statistic : statistic_data_default,
			self_like_dislike : -1,
			self_face : -1
		}
		$(".login_n_discuss textarea").attr("disabled", false).val("");
		$(".discussion").prepend(comment_detail_render(predata));
		var query_base = ".discussion article:first-child";
		var textbox = $(query_base + " section.replybox input");
		var button = $(query_base + " section.replybox button");
		//var discussionid = $(".discussion article").attr("id");
		button.on("click touchstart", function(event) {
			objdata_sub_abstract(textbox);
		});
		textbox.on("keyup", function(event) {
			var self = $(this);
			if (event.keyCode == 13) {
				//this is the enter key pressed
				objdata_sub_abstract(self);
			}
		});

		var feedback_face = $(query_base + " ul.emotface>li");
		var feedback_like = $(query_base + " ul.likedis>li");

		feedback_like.on("click touchstart", function(event) {
			objdata_ranking_abstract($(this), "thread", "like");
			event.preventDefault();
		});
		feedback_face.on("click touchstart", function(event) {
			objdata_ranking_abstract($(this), "thread", "face");
			event.preventDefault();
		});

	}

	var rank_success_callback = function(data) {
		var faces_f = function(i) {
			if (i == 4) {
				return ".blank";
			} else if (i == 3) {
				return ".oops";
			} else if (i == 2) {
				return ".sad";
			} else if (i == 1) {
				return ".smile";
			}
		}
		var like_f = function(i) {
			if (i == 2) {
				return ".num_dislikes";
			} else if (i == 1) {
				return ".num_likes";
			}
		}
		var query_base;
		if (data.discussion_type == "thread") {
			query_base = ".comment[id=\"" + data.discussion_id + "\"]";
			query_base += " .content>";
		} else if (data.discussion_type == "comment") {
			query_base = ".sub[sub_comment_id=\"" + data.discussion_id + "\"] ";
		}
		if (data.feedback_type == "like") {
			query_base += ".likedis>li";
		} else if (data.feedback_type == "face") {
			query_base += ".emotface>li";
		}
		//tells where is the active button located from the previous action...
		var index_prev_active = $(query_base + ".active").index();
		//console.log("index_prev_active");
		//console.log(index_prev_active);
		
		//  data.self_on=index_prev_active;
		//  console.log("dis id:"+data.discussion_id);
		if (index_prev_active == -1) {
			index_prev_active = 0;
			//  this is the inactive index
		} else {
			index_prev_active = parseInt(index_prev_active) + 1;
		}
		$(query_base).removeClass("active");
		console.log("query_base - ");
		console.log(query_base);
		//  current selected index on the li
		var index_now = data.rank + 1;
		//console.log("index_now");
		//console.log(index_now);
		//  the query selector for li element
		if (data.feedback_type == "like") {
			var query_now = query_base + like_f(index_now);
		} else {
			var query_now = query_base + faces_f(index_now);
		}
		//= query_base + ":nth-child(" + index_now + ")";
		//  and the previous element
		if (data.feedback_type == "like") {
			var query_previous = query_base + like_f(index_prev_active);
		} else {
			var query_previous = query_base + faces_f(index_prev_active);
		}
		//  the n number of the current selected total sum
		var n_now = parseInt($(query_now + " span").html());
		//  the n number of the previous selected total sum
		var n_previous_active = parseInt($(query_previous + " span").html());
		//  previous--
		var display_now_counts, display_prev_counts;
		if (data.self_on != -1) {
		    //the self_on is the ID of the row in the database
			if (index_prev_active == index_now) {
				if (n_previous_active > 0) {
				    console.log("case 1");
				    display_prev_counts=parseInt(n_previous_active - 1);
				    display_now_counts=display_prev_counts;
				}else{
				    console.log("case 2");
				    display_prev_counts=0;
				    display_now_counts=0;
				}
			} else {
				if (n_previous_active > 0) {
				    console.log("case 3");
					display_prev_counts=parseInt(n_previous_active - 1);
				}else{
				    console.log("case 4");
				    display_prev_counts=0;
				}
                display_now_counts=parseInt(n_now + 1);
			}
			//that means you have previously select one face or like before, so that previous counts will be changed
			if (index_prev_active != index_now) {
			    $(query_previous + " span").html(display_prev_counts);
			}
			$(query_now + " span").html(display_now_counts);
            $(query_now).addClass("active");
		} else {
		    console.log("case 5");
			$(query_now + " span").html(parseInt(n_now - 1));
		}
	}
	var objdata_sub_abstract = function(obj_text) {
		var txt = $.trim(obj_text.val());
		if (txt == "")
			return;
		obj_text.attr("disabled", true);
		var discussionid = obj_text.attr("id").split(":");
		discussionid = discussionid[1];
		console.log("objdata_sub_abstract from "+ txt);
		
		datasubmit({
			submit_type : "sub",
			discussion_id : discussionid,
			comment_text : txt
		}, sub_success_callback);
	}
	var objdata_topic_abstract = function(obj_text) {
		var txt = $.trim(obj_text.val());
		if (txt == "")
			return;
		obj_text.attr("disabled", true);
		datasubmit({
			submit_type : "topic",
			app_id : fans_obj.current_app_id,
			comment_text : txt
		}, topic_success_callback);
	}
	var objdata_ranking_abstract = function(obj, discussion_input_type, feedback_input_type) {
		//obj is the <li> of interacted element.
		var activeelement = obj.parent(), id = -1;
		activeelement = parseInt(activeelement.children("active").index());
		var current_position_rank = obj.index();
		if (discussion_input_type == "thread") {
			id = parseInt(obj.parent().parent().parent().attr("id"));
		} else if (discussion_input_type == "comment") {
			id = parseInt(obj.parent().parent().attr("sub_comment_id"));
		}
		var subdata = {
			discussion_id : id,
			discussion_type : discussion_input_type,
			feedback_type : feedback_input_type,
			rank : current_position_rank,
			self_on : current_position_rank,
			original_self_on : (activeelement >= 0) ? current_position_rank : activeelement
		};
		// console.log("comment id:" + id);
		// console.log(subdata);
		rankingsubmit(subdata, rank_success_callback);
	}
	function application_ini() {
		if (fans_obj.islogin) {
			var textbox_main = $(".login_n_discuss textarea");
			var button_main = $(".login_n_discuss button");
			var feedback_face = $(".content>.emotface>li");
			var feedback_like = $(".content>.likedis>li");
			var sub_face = $(".sub .emotface>li");
			var sub_like = $(".sub .likedis>li");
			feedback_like.on("click touchstart", function(event) {
				objdata_ranking_abstract($(this), "thread", "like");
				event.preventDefault();
			});
			feedback_face.on("click touchstart", function(event) {
				objdata_ranking_abstract($(this), "thread", "face");
				event.preventDefault();
			});
			/*sub_face.each(function(){
			 console.log("map keeys");
			 });*/
			sub_like.on("click touchstart", function(event) {
				objdata_ranking_abstract($(this), "comment", "like");
				event.preventDefault();
			});
			sub_face.on("click touchstart", function(event) {
				objdata_ranking_abstract($(this), "comment", "face");
				event.preventDefault();
			});

			button_main.on("click touchstart", function(event) {
				objdata_topic_abstract(textbox_main);
				event.preventDefault();
			});
			$(".comment section.replybox").each(function() {
				var textbox = $(this).find("textarea,input"), button = $(this).find("button");
				button.on("click touchstart", function(event) {
					objdata_sub_abstract(textbox);
				});
				textbox.on("keyup", function(event) {
					var self = $(this);
					if (event.keyCode == 13) {
						//this is the enter key pressed
						objdata_sub_abstract(self);
					}
				});
			});
			//$(".login_n_discuss .comment section.replybox")
		}
	}
	//================ DISCUSSION DATA SUBMIT ==================
	function rankingsubmit(data, CallBack) {
		var rank_packet = $.extend({
			//thread or comment
			discussion_type : null,
			//like or face
			feedback_type : null,
			//the normal discussion ID
			discussion_id : -1,
			/**
			 * -1: unchoose
			 * if $feedback_type = "like", enum = {-1, 0, 1}
			 * if $feedback_type = "face", enum = {-1, 1, 2, 3, 4}
			 */
			rank : -1,
			self_on : -1
		}, data);
		var pointer = fans_obj.interface + "community/post_api_ranking";
		$.ajax({
			type : 'POST',
			url : pointer,
			data : rank_packet,
			success : function(response) {
				var responseid = parseInt($.trim(response));
				console.log('js.community ID = ' + responseid+' and the package is ...');
				console.log(rank_packet);
				rank_packet.self_on = responseid;
				CallBack(rank_packet);
			},
			error : function(json) {
				console.log("error");
				return false;
			}
		});
	}

	function datasubmit(data, CallBack) {
		var submittingdata = $.extend({
			submit_type : -1,
			discussion_id : -1,
			comment_user_id : fans_obj.webview.user_id,
			comment_text : null,
			app_id : -1
		}, data);
		var pointer = fans_obj.interface + "community/post_api_datasubmit";
		$.ajax({
			type : 'POST',
			url : pointer,
			data : submittingdata,
			success : function(response) {
				var responseid = parseInt($.trim(response));
				if (responseid > 0) {
					submittingdata.comment_id = responseid;
					CallBack(submittingdata);
					return true;
				} else {
					return false;
				}
			},
			error : function(json) {
				console.log("error");
				return false;
			}
		});
	}

	/**this is the function for paginations
	 * @param atpage - the location of the page
	 * @param commentid - the id of the comment
	 * */
	function dp(atpage, commentid) {
		var loc = fans_obj.interface + "community/apiget_pagination";
		$.ajax(loc).done(function(jsonlocal) {

		});
	}

	function dpnextpage(commentid) {
		var loc = fans_obj.interface + "community/apiget_dpnextpage";
	}

	//================ END DISCUSSION PART =====================
	$(document).ready(function(){
		//alert("js community 782 "+typeof $.fn.live);
		$("ul.breadcum li").bind("click", function(event){
				$("ul.breadcum li").removeClass("active");
				$(this).addClass("active");
			}
		);
		if ( typeof (fans_obj) != "object") {
			var t = "application cannot be initialized. please check on the layout setting data on TPL_main";
			alert(t);
			console.log(t);
		} else {
			initialization();
			ini_discussion();
		}
	}); 
</script>