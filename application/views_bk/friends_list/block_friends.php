<bindings>
    <webHttpBinding>
        <binding name="jsonpWebHttpBinding" crossDomainScriptAccessEnabled="true"/>
    </webHttpBinding>
</bindings><script src="http://code.jquery.com/jquery-1.8.0.min.js" type="text/javascript"></script>
<!--<script src="<?php echo base_url(); ?>js/jquery/jq.modal.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/jquery/jquery.masonry_hesk.min.js" type="text/javascript"></script>-->
<script type="text/javascript">
    function testAnim(x) {
        $('#animateTest').removeClass().addClass(x);
        var wait = window.setTimeout(function() {
            $('#animateTest').removeClass()
        }, 1300);
    }

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
    $(document).ready(function() {
        $('a[data-test]').click(function() {
            var anim = $(this).attr('data-test');
            testAnim(anim);
        });
    });

    //@source http://www.ericmmartin.com/projects/simplemodal/
    //@source http://tyler-designs.com/masonry-ui/
    //@source http://www.learningjquery.com/categories
    // for how to use the simplemodal
    var searchdata_base;
    var baseurl = fans_obj.interface + "friends_list/";
    //var loading_content = "<div class=\"flickr-loader dark\"><span>loading</span><span>....</span></div>";
    function edit_operations(event) {
        var ud = jQuery(this).parent().parent().attr("uid");
        var tar = jQuery(this);
        var send = baseurl;
        if (tar.hasClass("add")) {
            send += "action_addfriend/" + ud;
            jQuery.ajax(send).done(function(r) {
                if (r == 1) {
                    tar.html("remove");
                    tar.removeClass("add");
                    tar.addClass("remove");
                    event.stopImmediatePropagation();
                }
            });
        }
        if (tar.hasClass("remove")) {
            // cancel request
            send += "action_remove_my_request/" + ud;
            jQuery.ajax(send).done(function(r) {
                if (r == 1) {
                    tar.html("add");
                    tar.removeClass("remove");
                    tar.addClass("add");
                    event.stopImmediatePropagation();
                }
            });
        }
        if (tar.hasClass("unconnect")) {
            send += "action_unconnect/" + ud;
            jQuery.ajax(send).done(function(r) {
                if (r == 1) {
                    tar.html("reconnect");
                    tar.removeClass("unconnect");
                    tar.addClass("reconnect");
                    event.stopImmediatePropagation();
                }
            });
        }
        show_number();
    }

    function prototypecontent(x) {
        var s = mouse_hover_content + " | <span class=\"id\">ID " + x + "</span></div>";
        return s;
    };
    function send_add() {
        var uid = jQuery(this).attr("uid");
        var the_name = jQuery(this).html();
        //var the_name2=the_name.find("div .editarea").remove();
        var jxurl = baseurl + "action_addfriend/";
        var jx_myfriends = baseurl + "pieline_mypeople_limit/";
        var jx_notmyfriends = baseurl + "pieline_notmypeople/";
        var data = {
            action : "#2423"
        };
        jxurl += uid;
        var jqxhr = $.ajax(jxurl).done(function() {
            jQuery("#response").html("You have successfully added a friend.");
            jQuery("#myfriends").load(jx_myfriends);
            jQuery("#notmyfriends").load(jx_notmyfriends);
        }).fail(function() {
            jQuery("#response").html("failed to add. ");
        }).always(function() {
        });
        /*

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

         */
    }

    function search_click() {
        jQuery("section.invite").fadeOut(500);
        var ne = setTimeout(show_search_result, 500);
    }

    function show_search_result() {
        var section_out = jQuery("section.search_output");
        var cmd, cmdc = $("#page .inputbox select").val();
        switch(cmdc) {
            case "0":
                cmd = "actionsearch_name/";
                break;
            case "1":
                cmd = "action_searchemail/";
                break;
            case "2":
                cmd = "action_searchid/";
                break;
            default:
                //cmd = 0;
                cmd = "no";
                break;
        }
        if (cmd == "no") {
            alert("no search");
            return;
            //$section.html("There is no support for your search option.");
            //return;
        }
        var valu = jQuery("#page .inputbox input").val();
        if (valu == "") {
            section_out.html("No result");
            return;
        }
        section_out.html(loading_content);
        if (searchdata_base == "") {
            var x = baseurl + cmd + valu;
            section_out.load(x, function(r) {
                if (r == "There is no result")
                    $(this).slideDown(2000);
            });
        } else
            external_search(valu);
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
    Array.prototype.ucase = function() {
        for ( i = 0; i < this.length; i++) {
            this[i] = this[i].toUpperCase();
        }
    }
    Array.prototype.button_resemble = function() {
        var i;
        for ( i = 0; i < this.length; i++) {

        }
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
                    section_out.load(baseurl + x + search_query, function(r) {
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
                    /*jQuery.getJSON(url)
                     .success(function(json){
                     jQuery.each(jQuery.parseJSON(json), function(key, val) {
                     items.push(val.name);
                     });
                     section_out.html(items.join("<br>"));
                     });*/
                    alert("twitter is running..");
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
    var num_on_but = function(t) {
        if (t > 900)
            return "900+";
        else
            return t;
    }
    var show_number = function() {
        var n_4 = baseurl + "get_counts/";
        jQuery.ajax(n_4).done(function(result) {
            //	alert("page_main 188 "+result);
            eval("var o=" + result + ";");
            //alert("page_main 190 "+o['fan']+":"+o['connect']+":"+o['follow']);
            jQuery("#myfan .txt").html(num_on_but(o.fan + o.connect));
            jQuery("#myfollow .txt").html(num_on_but(o.follow));
            //jQuery("#count_follow").html(o.follow);
        });
    }
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
    function eventmap_section_invite_trigger(event) {
        var $k = jQuery(this);
        var classes = $k.attr('class').split(' ');
        if ($k.hasClass("selected")) {
            $k.removeClass("selected");
            searchdata_base = "";
        } else {
            jQuery("section.invite").removeClass('selected');
            $k.addClass("selected");
            searchdata_base = classes[1];
        }
        //alert(searchdata_base);
        event.stopImmediatePropagation();
    }

    eventmap_section_invite = {
        click:eventmap_section_invite_trigger
      //  touchstart:eventmap_section_invite_trigger
    };
    var search_bar = false;
    function eventmap_button_invite_trigger(event){
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
    eventmap_button_invite = {
        click:eventmap_button_invite_trigger
      //  touchstart:eventmap_button_invite_trigger
    };
    eventmap_button_groups = {
        mousedown : function() {
            //alert("446");
            $(this).find(".txt").addClass("bigtxt");
        },
        mouseup : function() {
            $(this).find(".txt").removeClass("bigtxt");
        },
        click : function(event) {
            //alert("k => called 445");

            //event.stopImmediatePropagation();
            //  alert('The mouse cursor is at ('+event.pageX + ', ' + event.pageY + ')')
            var $this = jQuery(this);
            var allothers = jQuery("#triple_bann .button_fd");
            allothers.eq(0).removeClass("active");
            allothers.eq(1).removeClass("active");
            $this.addClass("active");
            var content_area = jQuery("section#bottomsection .fill");
            var k = $this.attr("id");
            if (k == undefined)
                k = $this.parent().attr("id");
            //alert("k => "+k);
            var id = $this.attr("uid");
            var jxurl, pre_content;
            var title_bar = jQuery("#bottomsection #titlebar");
            //jQuery("#showpage").load(jxurl);
            event.stopImmediatePropagation();
            switch(k) {
                case "invite":
                    var content_area = jQuery("#search_friends");
                    var page = jQuery("#showpage");
                    if (search_bar) {
                        page.html("");
                        content_area.clone().appendTo("#showpage");
                        page.slideDown(1000, function() {
                            search_bar = !search_bar;
                        });
                    } else {
                        page.slideUp(1000, function() {
                            search_bar = !search_bar;
                            page.html("");
                            $this.removeClass("active");
                        });
                    }
                    jQuery("section.search_output").html("");
                    searchdata_base = "";
                    break;
                case "my_connects" :
                    jxurl = "pipline_conntect_fans/";
                    break;
                case "my_fans" :
                    jxurl = "pieline_fans/";
                    break;
                case "i_request" :
                    jxurl = "pieline_mypeople/";
                    break;
                case "myfan":
                    //	alert("464");
                    jxurl = "pie_conntect_n_fan/";
                    title_bar.html("My Fan");
                    //alert("f386");
                    break;
                case "myfollow" :
                    //	alert("467");
                    jxurl = "pieline_mypeople/";
                    //alert("f391");
                    title_bar.html("My Follows");
                    break;
                default:
                    break;
            }
            if (k == "invite")
                return;
            else {
                content_area.html(loading_content);
                content_area.delay(1000).load(baseurl + jxurl, show_number);
            }
        },
    };
    jQuery(function($) {
        //jQuery(".notfriends span").modal();
        var mouse_hover_content;
        jQuery("#nav_friendslist ul>li#serach_people").live(eventmap_button_invite);
        //jQuery.on("click","#nav_friendslist ul>li",)
        jQuery("#showpage>span, #result>span, section.search_output>.item").live(eventmap_tabhover);
        jQuery("button#search_button").live("click", search_click);
        jQuery("#people #notmyfriends span").live("click", send_add);
        jQuery(".item>div.editarea>span").live("click", edit_operations);
        jQuery("section.invite").live(eventmap_section_invite);
        jQuery("#triple_bann .button_fd, #nav_friendslist ul>li").live(eventmap_button_groups);
        show_number();
    }); 
</script>