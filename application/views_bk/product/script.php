<script>
	var loadjs = function(js_name) {
		var o = document.getElementsByTagName('head')[0];
		var wa = document.createElement('script');
		wa.type = 'text/javascript';
		wa.src = js_name;
		o.appendChild(wa);
	}
	//loadjs(fans_obj.jsbin + "fluxslide.js");
	//loadjs(fans_obj.jsbin + "jthumscroller.js");
	//loadjs("http://cssglobe.com/lab/easypaginate/js/easypaginate.js");
	/**!
	 $.getScript(fans_obj.jsbin + "fluxslide.js").done(function(script, textStatus) {
	 $("#flux_product").css("display", "block");
	 window.myFlux = new flux.slider('#flux_product', {
	 transitions : ['zip'],
	 autoplay : true,
	 delay : 10000,
	 onTransitionEnd : function(data) {
	 var img = data.currentImage;
	 // Do something with img...
	 }
	 });
	 }).fail(function(jqxhr, settings, exception) {
	 alert("flux_product");
	 $("#flux_product").css("display", "none");
	 });
	 */
</script>
<!--<script src="http://www.joelambert.co.uk/flux/js/flux.min.js"></script>-->
<script src="http://cssglobe.com/lab/easypaginate/js/easypaginate.js"></script>
<script>
	var h;
	var t = 0;
	var k = 0;
	var BillBoard = null;
	var afterThumbnailDelegate = false;
	var thumbnailscoller_setting = {
		//@source http://manos.malihu.gr/$-thumbnail-scroller
		scrollerType : "clickButtons",
		scrollerOrientation : "horizontal",
		scrollSpeed : 2,
		scrollEasing : "easeOutCirc",
		scrollEasingAmount : 600,
		acceleration : 4,
		scrollSpeed : 800,
		noScrollCenterSpace : 30,
		autoScrolling : 1,
		autoScrollingSpeed : 2000,
		autoScrollingEasing : "easeInOutQuad",
		autoScrollingDelay : 500
	};
	var rslider_setting = {
		// general options go gere
		autoScaleSlider : false,
		autoHeight : true,
		navigateByClick : false,
		sliderDrag : true,
		sliderTouch : true,
		imageScaleMode : 'fit-if-smaller',
		loop : true,
		loopRewind : true,
		controlNavigation : 'none',
		updateSliderSize : true,
		fullscreen : {
			// fullscreen options go gere
			enabled : false,
			native : false
		},
		autoPlay : {
			// autoplay options go gere
			enabled : false,
			pauseOnHover : false
		}
	};
	var $ = jQuery;
	function fill_stage_data(o) {
		//alert(o.img);
		if (o.setprice == 0) {
			var price = "TBA";
		} else {
			var price = o.setprice;
		}
		//var installations = o.mobile_app_install_url_json;
		if (typeof o.mobile_app_install_url_json != "undefined") {
			eval("var mobile_app_install_url_json = " + o.mobile_app_install_url_json + ";");
			console.log("mobile_app_install_url_json 86");
			console.log( typeof (mobile_app_install_url_json.ios));
			if ( typeof (mobile_app_install_url_json.ios) == "undefined") {
				$(".marketplace .appstore").hide();
			} else {
				$(".marketplace .appstore").show().children("a").attr("href", mobile_app_install_url_json.ios);
			}
			if ( typeof (mobile_app_install_url_json.android) == "undefined") {
				$(".marketplace .googleplay").hide();
			} else {
				$(".marketplace .googleplay").show().children("a").attr("href", mobile_app_install_url_json.android);
			}
		}
		var gallerybuffer = ""
		if (typeof o.gallery_url_json != "undefined") {
			eval("var gallery_url_json = " + o.gallery_url_json + ";");
			if (gallery_url_json.image.length > 0) {
				$.each(gallery_url_json, function(index, value) {
					gallerybuffer += "<div class=\"thumb\"><img src=\"" + value + "\"/></div>";
				});
				console.log(gallery_url_json);
			}
			$("ul.breadcum li").eq(2).show();
		} else {
			$("ul.breadcum li").eq(2).hide();
		}
		$("#gallerlist").html(gallerybuffer);
		$("#mainfeature_image_area").div_load_adjusted_image(o.image_url, 300)
		$(".tech_specs .right").html(o.spec_html);

		$(".imagelist").html(o.spec_html);
		$(".feature_detail .feature_text").shuffleLetters({
			"text" : o.product_name,
			"fps" : 33,
			"step" : eval_step(o.product_name)
		});
		$(".feature_subtext").shuffleLetters({
			"text" : o.product_model,
			"fps" : 33,
			"step" : eval_step(o.product_model)
		});
		$("span.amount").shuffleLetters({
			"text" : price,
			"fps" : 33,
			"step" : eval_step(price)
		});
		$(".remark span").shuffleLetters({
			"text" : o.product_name,
			"fps" : 33,
			"step" : eval_step(o.product_name)
		});
		$(".feature_small_comment").html(o.product_summary);
		$(".buy_it_now a").attr("href", o.buy_now_url);
		$(".product_main_img").attr('src', o.image_url);
		$(".gallery .feature_text").shuffleLetters({
			"text" : o.product_name,
			"fps" : 33,
			"step" : eval_step(o.product_name)
		});
	}

	//after initialization - we have this process
	var triggerslider_thumbnailScroller = function(r) {
		var objHTML = $(r);
		$(this).css("display", "none").fadeIn(2000);

		var slider_section_id = $(this).parent().parent().attr("id");
		$("#" + slider_section_id + '.jThumbnailScroller').thumbnailScroller(thumbnailscoller_setting);
        var default_pid = $("#product_related_load .box").eq(1).attr("data-id");
		if (!afterThumbnailDelegate && default_pid!=undefined) {
			afterThumbnailDelegate = true;
			var pid = getLastSlugVal("view") == -1 ? default_pid : getLastSlugVal("app");
			getSingleProduct(pid);
			//console.log(objHTML);
			//console.log("default_pid == "+default_pid);
		}

	};
	function review_lower_products(index) {
		$("#product_related_load .wrap .box").eq(index).getO();
	}

	function review_upper_products(index) {
		// $("#product_devices .wrap .box").eq(index).getO();
	}

	function build_breadcum(_list) {
		//["overview","spec","gallery"];
		var base = $("ul", {
			"class" : "breadcum"
		});
		$.each(_list, function(i, r) {
			var the_item_in_the_list = $("li", {
				"class" : r
			}).bind("click touchstart", function() {
				var Dis = $(this);
				$("ul.breadcum li").removeClass("active");
				Dis.addClass("active");
				// additional function after each button onclicked.
				BillBoard.goTo(Dis.index());
			});
			base.append(the_item_in_the_list);
		});

	}

	function apply_interactions() {
		//  console.log("apply_interactions");
		setTimeout(function() {
			$("#product_devices .wrap .box").each(function(index) {
				$(this).attr("href", "javascript:review_upper_products(" + index + ")");
			});
			$(".productdetailonstage").each(function(index) {
				$(this).attr("href", "javascript:review_lower_products(" + index + ")");
				//   console.log("productdetailonstage");
			});
		}, 3000);
		/*click(function(event) {
		$(this).parent().parent().parent().parent().getO();
		console.log("add");
		event.preventDefault();
		});*/
		//console.log("apply_interactions bind");
		$("ul.breadcum li").bind("click touchstart", function() {
			var Dis = $(this);
			$("ul.breadcum li").removeClass("active");
			Dis.addClass("active");
			// additional function after each button onclicked.
			BillBoard.goTo(Dis.index());
		});
		/*$("ul.breadcum li").live({
		click : function() {
		var Dis = $(this);
		$("ul.breadcum li").removeClass("active");
		Dis.addClass("active");
		// additional function after each button onclicked.
		BillBoard.goTo(Dis.index());
		}
		});*/
		// console.log("TEST");
	}

	//breadcum
	var initialization = function() {
		if ( typeof ($.fn.thumbnailScroller) != "object") {
			$.getScript(fans_obj.jsbin + "jthumscroller.js").done(function(script, textStatus) {
				$("#product_devices .wrap").load(fans_obj.interface + "product/related_topbar_items", triggerslider_thumbnailScroller);
				$("#product_related_load .wrap").load(fans_obj.interface + "product/related_features", triggerslider_thumbnailScroller);
				//$("#product_related .wrap").html(cmd);
				//$("#product_extra_b .wrap").load(fans_obj.interface + "product/related_features", triggerslider_thumbnailScroller);
			}).fail(function(jqxhr, settings, exception) {
				alert("product_extra_b");
				$("#product_extra_b").css("display", "none");
			});
		}
		h = $("#product_related .wrap>.box").length;
		// console.log("BillBoard TEST");
		BillBoard = $("#sliderK").royalSlider(rslider_setting).data('royalSlider');
		// after slider is initialized,
		//BillBoard.ev.on('rsAfterInit', apply_interactions);
		// triggers after slide change
		BillBoard.ev.on('rsAfterSlideChange', afterSlide);
		setTimeout(function() {
			enhanced_slide_height_0();
			apply_interactions();
		}, 500);
	}
	function afterSlide(event) {
		//http://help.dimsemenov.com/discussions
		var currentSlidID = BillBoard.currSlideId;
		$("ul.breadcum li").removeClass("active");
		$("ul.breadcum li").eq(currentSlidID).addClass("active");
		if (currentSlidID == 0)
			enhanced_slide_height_0();
	}

	function enhanced_slide_height_0() {
		var h_apply = $(".feature_detail").height() + 200;
		$("#sliderK .rsOverflow").css("height", h_apply + "px");
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
	var timer, k_init = 123456;
	//var numstring = k_init.toString();
	//split(numstring, ',');
	function getTimeR() {
		var delta = 5000;
		k_init++;
		var t = Math.floor(Math.random() * delta) + 150;
		$("#heskcoun").heskCounter(k_init.toString(), true);
		clearInterval(timer);
		timer = setInterval(getTimeR, t);
	}

	function getSingleProduct(id) {
		var productID = id;
		var producto = {};
		//starting product ajax
		var query = fans_obj.interface + "product/get_single_product_obj/" + productID;
		console.log("script 294 ajax get: "+query);
		$.ajax(query).done(function(jsonlocal) {
			eval("var o=" + jsonlocal + ";");
			console.log("script.php 297");
			console.log(o);
			fill_stage_data(o);
		});
	}


	$.fn.getO = function() {
		var Disbox = this;
		var productID = Disbox.find(".block .productname").attr("value");
		//get this data from the .box level
		//   var DisboxI=this.parent();
		getSingleProduct(productID);
		/*
		 producto.image_url = Disbox.find(".img img").attr("src");
		 producto.product_id = Disbox.find(".block .productname").attr("value");
		 producto.product_name = Disbox.find(".block .productname").html();
		 producto.product_model = Disbox.find(".block .model").html();
		 producto.product_summary = Disbox.find(".block .summary").html();
		 producto.setprice = "100";
		 fill_stage_data(producto);*/
	}
	$(function($) {
		console.log("script 320 "+fans_obj);
		if ( typeof (fans_obj) == "object") {
			initialization();
			getTimeR();
			console.log("script 323 ");
			
		} else {
			alert("TPL main layout configuration is missing.. program aborted.");
		}
		
	}); 
</script>