(function(a){a.fn.thumbnailScroller=function(b){var c={scrollerType:"hoverPrecise",scrollerOrientation:"horizontal",scrollEasing:"easeOutCirc",scrollEasingAmount:800,acceleration:2,scrollSpeed:600,noScrollCenterSpace:0,autoScrolling:0,autoScrollingSpeed:8000,autoScrollingEasing:"easeInOutQuad",autoScrollingDelay:2500};var b=a.extend(c,b);return this.each(function(){var i=a(this);var n=i.children(".jTscrollerContainer");var d=i.children(".jTscrollerContainer").children(".jTscroller");var f=i.children(".jTscrollerNextButton");var l=i.children(".jTscrollerPrevButton");if(b.scrollerOrientation=="horizontal"){n.css("width",999999);var e=d.outerWidth(true);n.css("width",e);}else{var e=d.outerWidth(true);}var s=d.outerHeight(true);if(e>i.width()||s>i.height()){var h;var g;var t;if(b.scrollerType=="hoverAccelerate"){var r;var q=8;i.hover(function(){i.mousemove(function(v){h=findPos(this);g=(v.pageX-h[1]);t=(v.pageY-h[0]);});clearInterval(r);r=setInterval(m,q);},function(){clearInterval(r);d.stop();});l.add(f).hide();}else{if(b.scrollerType=="clickButtons"){p();}else{h=findPos(this);i.mousemove(function(z){g=(z.pageX-h[1]);t=(z.pageY-h[0]);var y=g/i.width();if(y>1){y=1;}var x=t/i.height();if(x>1){x=1;}var w=Math.round(-((e-i.width())*(y)));var v=Math.round(-((s-i.height())*(x)));d.stop(true,false).animate({left:w,top:v},b.scrollEasingAmount,b.scrollEasing);});l.add(f).hide();}}if(b.autoScrolling>0){o();}}else{l.add(f).hide();}var j;var k;function m(){if((g<i.width()/2)&&(d.position().left>=0)){d.stop(true,true).css("left",0);}else{if((g>i.width()/2)&&(d.position().left<=-(e-i.width()))){d.stop(true,true).css("left",-(e-i.width()));}else{if((g<=(i.width()/2)-b.noScrollCenterSpace)||(g>=(i.width()/2)+b.noScrollCenterSpace)){j=Math.round(Math.cos((g/i.width())*Math.PI)*(q+b.acceleration));d.stop(true,true).animate({left:"+="+j},q,"linear");}else{d.stop(true,true);}}}if((t<i.height()/2)&&(d.position().top>=0)){d.stop(true,true).css("top",0);}else{if((t>i.height()/2)&&(d.position().top<=-(s-i.height()))){d.stop(true,true).css("top",-(s-i.height()));}else{if((t<=(i.height()/2)-b.noScrollCenterSpace)||(t>=(i.height()/2)+b.noScrollCenterSpace)){k=Math.cos((t/i.height())*Math.PI)*(q+b.acceleration);d.stop(true,true).animate({top:"+="+k},q,"linear");}else{d.stop(true,true);}}}}var u=0;function o(){d.delay(b.autoScrollingDelay).animate({left:-(e-i.width()),top:-(s-i.height())},b.autoScrollingSpeed,b.autoScrollingEasing,function(){d.animate({left:0,top:0},b.autoScrollingSpeed,b.autoScrollingEasing,function(){u++;if(b.autoScrolling>1&&b.autoScrolling!=u){o();}});});}function p(){l.hide();f.show();f.click(function(x){x.preventDefault();var z=d.position().left;var w=e+(z-i.width());var y=d.position().top;var v=s+(y-i.height());l.stop().show("fast");if(b.scrollerOrientation=="horizontal"){if(w>=i.width()){d.stop().animate({left:"-="+i.width()},b.scrollSpeed,b.scrollEasing,function(){if(w==i.width()){f.stop().hide("fast");}});}else{f.stop().hide("fast");d.stop().animate({left:i.width()-e},b.scrollSpeed,b.scrollEasing);}}else{if(v>=i.height()){d.stop().animate({top:"-="+i.height()},b.scrollSpeed,b.scrollEasing,function(){if(v==i.height()){f.stop().hide("fast");}});}else{f.stop().hide("fast");d.stop().animate({top:i.height()-s},b.scrollSpeed,b.scrollEasing);}}});l.click(function(x){x.preventDefault();var z=d.position().left;var w=e+(z-i.width());var y=d.position().top;var v=s+(y-i.height());f.stop().show("fast");if(b.scrollerOrientation=="horizontal"){if(z+i.width()<=0){d.stop().animate({left:"+="+i.width()},b.scrollSpeed,b.scrollEasing,function(){if(z+i.width()==0){l.stop().hide("fast");}});}else{l.stop().hide("fast");d.stop().animate({left:0},b.scrollSpeed,b.scrollEasing);}}else{if(y+i.height()<=0){d.stop().animate({top:"+="+i.height()},b.scrollSpeed,b.scrollEasing,function(){if(y+i.height()==0){l.stop().hide("fast");}});}else{l.stop().hide("fast");d.stop().animate({top:0},b.scrollSpeed,b.scrollEasing);}}});}});};})(jQuery);function findPos(a){var b=curtop=0;if(a.offsetParent){b=a.offsetLeft;curtop=a.offsetTop;while(a=a.offsetParent){b+=a.offsetLeft;curtop+=a.offsetTop;}}return[curtop,b];}