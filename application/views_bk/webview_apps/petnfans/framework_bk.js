var petsnfans_data = null;
var panel = null;
// the panel controller
var the_id_of_the_slider_view = null;
var flag = false;
function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
var $=jQuery;
$.fn.map_input_interface = function() {
    var text = this.children(".textinput");
    var button = this.children(".sendinput");
    var discussion_id = this.parent().find("#discussions").attr("disid");
    var discuss_stage = this.parent().find("#discussions");
    var thread = null, getPostText = null;
    //console.log(discussion_id);
    button.bind('touchstart click', function() {
        if (!flag) {
            flag = true;
            setTimeout(function() {
                flag = false;
            }, 100);
            // do something
            remove_input();
            var content = $.trim(text.val());
            if (content == "") {
                return false;
            } else {
                actionPost(htmlEntities(content));
            }
        }
        return false
    });
    function actionPost(postContentText) {
        var predata = {
            "discussion_id" : discussion_id,
            "comment_text" : postContentText
        };
        $.ajax({
            type : 'POST',
            url : fans_obj.webview.ajaxCommunityPost,
            data : predata,
            success : function(response) {
                var response_id = parseInt($.trim(response));
                if (response_id > 0) {
                    postSuccess($.extend({
                        sub_comment_id : response_id
                    }, predata));
                    console.log("yes");
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

    function postSuccess(dataObj) {
        thread = {
            "comment_id" : dataObj.sub_comment_id,
            "comment_text" : dataObj.comment_text,
            "comment_user_id" : 0,
            "firstname" : fans_obj.webview.user_1,
            "lastname" : fans_obj.webview.user_2,
            "profile_image" : "",
            "last_updated" : "right now!"
            //"profile_image" : fans_obj.webview.user_image
        }
        var key_obj = find_topic_id_at(discussion_id);
        console.log("find a key");
        console.log(key_obj);
        petsnfans_data[key_obj].subcomment_count++;
        if ( typeof (petsnfans_data[key_obj].subcomment_array) == "object") {
            petsnfans_data[key_obj].subcomment_array.push(thread);
        } else {
            petsnfans_data[key_obj]['subcomment_array'] = [];
            petsnfans_data[key_obj]['subcomment_array'][0] = thread;
        }
        discuss_stage.append(template_article_discussion(thread));
        //if ( typeof (panel) == "object") {
        panel.updateSliderSize(true);
        setTimeout(function() {
            $("body").scrollTo('max', 500, {
                axis : 'y'
            });
            panel.updateSliderSize(true);
        }, 800);
        //}
        //console.log(template_article_discussion(thread));
        //panel.prev();  // prev slide
        //or scoll to the bottom
    }

}
function build_slider_init() {
    if (the_id_of_the_slider_view == null) {
        console.log("error, cannot initialize rslider - missing slider ID (the_id_of_the_slider_view)");
        return false;
    }
    /* -royalSlider configuration
     * {
        // general options go gere
        autoScaleSlider : false,
        autoHeight : true,
        navigateByClick : false,
        controlNavigation : 'none',
        fullscreen : {
            // fullscreen options go gere
            enabled : true,
            native : true
        },
        autoPlay : {
            // autoplay options go gere
            enabled : false,
            pauseOnHover : true
        }
    }
     */
    $("#" + the_id_of_the_slider_view).royalSlider(fans_obj.jcomponent_royal_slider_petsnfan);
    panel = $("#" + the_id_of_the_slider_view).data('royalSlider');
    panel.ev.on('rsAfterSlideChange', function(event) {
        callback_after_slider(panel.currSlideId);
    });
}

/*
 only for community
 */
function find_topic_id(id) {
    var returnob = null
    $.each(petsnfans_data, function(key, value) {
        if (value.comment_id == id) {
            returnob = value;
        }
    });
    return returnob;
}

function find_topic_id_at(id) {
    var returnob = false, k = 0;
    $.each(petsnfans_data, function(key, value) {
        if (value.comment_id == id) {
            returnob = k;
        }
        k++;
    });
    return returnob;
}

function refresh() {
    LoadTopics(fans_obj.webview.ajaxtopics, template_article_topic, false);
}

function remove_input() {
    if ($("#response_input_community").size() > 0) {
        $("#response_input_community").remove();
    }
}

function callback_after_slider(currSlideId) {
    if (currSlideId == 0) {
        //triggers when it goes back to the main page
        if ( typeof (panel) == "object")
            //console.log("back to main page");
            $("body").scrollTo('min', 10, {
                axis : 'y'
            });
        setTimeout(function() {
            panel.updateSliderSize();
        }, 800);
        remove_input();
        refresh();
    } else if (currSlideId == 1 && $("#communityView").size() > 0) {
        //triggers when it goes to the discussion page
        if ($("#response_input_community").size() == 0) {
            genInput();
            if ( typeof (panel) == "object") {
                panel.updateSliderSize();
                setTimeout(function() {
                    $("#communityView").scrollTo('max', 500, {
                        axis : 'y'
                    });
                }, 800);
            }
        }

    }
}

function genInput() {
    var input_field = $("<input>", {
        "class" : "textinput",
        "id" : "input_field",
        "watermark" : "input your response here",
        "type" : "text"
    });
    var input_button = $("<input>", {
        "class" : "sendinput",
        "id" : "input_send",
        "value" : "send",
        "type" : "submit"
    });
    var input_response = $("<section>", {
        "class" : "responseInput wrapper",
        "id" : "response_input_community"
    }).append(input_field, input_button);
    $(".page-wrap").append(input_response);
    $(".page-wrap .responseInput").map_input_interface();
}

function LoadDiscussion(id_from_the_topic) {
    //console.log(fans_obj.webview.ajaxdiscussions);
    //console.log("run the discussion");
    /*$.ajax({
     type : 'POST',
     url : fans_obj.webview.ajaxdiscussions,
     data : {
     "sodnf" : 34
     },
     success : function(json) {
     var jresponse = eval("(" + json + ")");
     console.log(jresponse);
     },
     error : function(json) {
     console.log("error");
     }
     });*/
    if ($("section#discussions") != null) {
        panel.removeSlide(1);
    }
    var topic = find_topic_id(id_from_the_topic);
    var discussion_count = topic.subcomment_count;
    var discussion_content = "";
    var thelisting = null;
    var discussions = [];
    if (discussion_count > 0) {
        discussions = topic.subcomment_array;
    } else {
        //return "#";
    }
    if (discussions.length > 0) {
        if (discussions.length > 20) {
            thelisting = discussions.splice(-20, 20);
            discussion_content = "<div class=\"topbanner\">Show More...</div>";
        } else {
            thelisting = discussions;
        }
        $.each(thelisting, function(key, discussion) {
            discussion.last_updated = fanslivingDateHesk(discussion.last_updated);
            discussion_content += template_article_discussion(discussion);
        });
    } else {
        thelisting = [];
        discussion_content = "<div class=\"topbanner\">Leave your comments here...</div>";
    }

    var HTML_obj = $("<section>", {
        "id" : "discussions",
        "class" : "rsContent",
        "disID" : topic.comment_id,
        "update" : topic.last_updated,
        "profile" : topic.profile_image
    }).append(discussion_content);
    //.html();
    //HTML_obj.html(discussion_content);
    //console.log(HTML_obj);
    panel.appendSlide(HTML_obj);
    panel.next();
    //.next();
    //panel.appendSlide(HTML_jQuery_object, index(optional));
    //panel.removeSlide(index(optional));
}

/**!
 *
 *  @param  get_ajax_url : the http request for the data object
 *  @param  callback     : the callback function of the tamplate
 *  @param  is_initial: boolean (whether the function is triggered with slider initialization or not)
 *  @author heskemo oyen
 *
 */
function LoadTopics(get_ajax_url, callback, is_initial) {
    //   console.log("initialize loading topics");
    //console.log(fans_obj.webview.ajaxtopics);
    $.ajax({
        type : 'POST',
        url : get_ajax_url,
        data : {
            //  "limit" : 10
        },
        success : function(json) {
            /*if(parseInt(json)==505){
             console.log("please login first");
             return;
             }*/
            var jresponse = eval("(" + json + ")");
            petsnfans_data = jresponse;
            //console.log("found obj");
            console.log(petsnfans_data);
            var length = jresponse.length;
            var section_topics_content = "";
            if (jresponse.result == "no data") {

            } else {
                if (length > 0) {
                    $.each(jresponse, function(key, value) {
                        value.last_updated = fanslivingDateHesk(value.last_updated);
                        section_topics_content += callback(value);
                        //console.log("initialize D");
                        //console.log(value);
                    })
                }
                if (section_topics_content != "") {
                    $("section#mainpage").html("");
                    $("section#mainpage").append(section_topics_content);
                    if (is_initial)
                        build_slider_init();
                    //console.log(section_topics_content);
                }
            }

        },
        error : function(json) {
            console.log("error");
        }
    });
}
