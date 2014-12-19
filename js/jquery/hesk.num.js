/*
Hesk Counter v1.0.4

Copyright 2011, Heskemo K.
Free to use under the MIT license.
http://www.opensource.org/licenses/mit-license.php

======================================
This is LV3 general class...
======================================

*/
function randomChar(c){var b="";if(c=="lowerLetter"){b="abcdefghijklmnopqrstuvwxyz0123456789"}else{if(c=="upperLetter"){b="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"}else{if(c=="symbol"){b=",.?/\\(^)![]{}*&^%$#'\""}}}var a=b.split("");return a[Math.floor(Math.random()*a.length)]};
function substrmix(f,b){if(!f||!b){return""}var c=0;var e=0;var d="";for(e=0;e<f.length;e++){if(f.charCodeAt(e)>255){c+=2}else{c++}if(c>b){return d+"..."}d+=f.charAt(e)}return f};
function getLastSlugVal(SecondLastSlug) {
	var loc = document.location.href;
	var End = loc.length;
	var dashEnd = (loc.substr(loc.length-1, loc.length) == "/")?true:false;
	var SecondLastSlugWithDash =SecondLastSlug+ "/";
	var slugLength=SecondLastSlug.length;
	var slugLengthDash = slugLength+1;
	var startDash = loc.indexOf(SecondLastSlugWithDash) + slugLengthDash;
	var start = loc.indexOf(SecondLastSlug) + slugLength;
	if(loc.substr(startDash, End)=="" || loc.substr(start, End)==""){
		//console.log("1 conditionat");
		return -1;
	}else{
		//console.log("no");
		//var pid = dashEnd?loc.substr(startDash, End-1):loc.substr(startDash, End);
		return parseInt(dashEnd?loc.substr(startDash, End-1):loc.substr(startDash, End));
	}
}
function ToHTML(obj) {
		return jQuery("<div>").append(obj).html();
}
function htmlEntities(str) {
	return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
String.prototype.replaceAt = function(index, char) {
    return this.substr(0, index) + char + this.substr(index + char.length);
}
String.prototype.fanslivingTime = function() {
    return fanslivingDateHesk(this);
};
Array.prototype.ucase = function() {
    for ( i = 0; i < this.length; i++) {
        this[i] = this[i].toUpperCase();
    }
    return this;
}
if ( typeof $ != "undefined")
    $(function($) {
        /*TODO: this function will able to adjust your picture into a defined square size */
        $.fn.div_load_adjusted_image = function(src, dimension) {
            var printimg = function(url) {
                return '<img src="' + url + '"/>';
            }
            this.html(printimg(src))
            //load up the src file
            .find("img")
            //find the image object
            .imgProfileAdjustment(dimension);
            //fade out
            //this.fadeIn();
        }
        $.fn.imgProfileAdjustment = function(dimension) {
            function doAjust() {
                //alert("triggered."+$(this).width());
                if ($(this).width() > $(this).height()) {
                    $(this).attr('height', dimension + 'px');
                } else {
                    $(this).attr('width', dimension + 'px');
                }
                $(this).unbind('load');
            }


            this.one('load', doAjust).each(function() {
                /*if (this.complete) {
                 $(this).load(doAjust);
                 }else{
                 doAjust();
                 }*/
            });
        }
        $.fn.heskCounter = function(number_raw_input, commafied) {
        	
            if (commafied == undefined) {
                commafied = false;
            }
            var defaultopt = {
                width : '24',
                height : '39',
                start : '666666', // the color without #
                end : '000000', //the color without #
                url : 'http://www.fansliving.com/images/common/counter-numbers.png'
            };
            var Dis = this;
            var additional_comma_char = function(number_hesk_level2) {
                return Math.floor((parseInt(number_hesk_level2.toString().length) - 1) / 3);
            }
            var div_size = function() {
                var l, cssob;
                if (commafied)
                    l = additional_comma_char(number_raw_input) + number_raw_input.length;
                else {
                    //alert(number_raw_input);
                    l = number_raw_input.length;
                }
                cssob = {
                    'width' : parseInt(defaultopt.width * l + l + 1 + 'px'),
                    'height' : parseInt(defaultopt.height * 1 + 2) + 'px'
                }
            };
            var charcss = {
                'width' : defaultopt.width + 'px',
                'height' : defaultopt.height + 'px',
                'background-image' : 'url(' + defaultopt.url + ')',
                'background-repeat' : 'no-repeat',
                'float' : 'left',
                'margin' : '1px',
                'margin-right' : '0px'
            };
            var lastcharcss = {
                'width' : defaultopt.width + 'px',
                'height' : defaultopt.height + 'px',
                'background-image' : 'url(' + defaultopt.url + ')',
                'background-repeat' : 'no-repeat',
                'float' : 'left',
                'margin' : '1px',
            };
            /*this.css('filter', 'progid:DXImageTransform.Microsoft.gradient(startColorstr=\'' + defaultopt.start + '\', endColorstr=\'#' + defaultopt.end + '\', gradientType=1)');
             this.css('background-image', '-webkit-gradient(linear, left top, right bottom, color-stop(0.1, #' + defaultopt.start + '), color-stop(0.99, #' + defaultopt.end + '))');
             this.css('background-image', '-moz-linear-gradient(top left, #' + defaultopt.start + ' 0%, #' + defaultopt.end + ' 100%)');
             this.css('background-image', '-o-linear-gradient(top left, #' + defaultopt.start + ' 0%, #' + defaultopt.end + ' 100%)');*/
            var commafy = function(number_hesk) {
                var str;
                if ( typeof number_hesk === 'string')
                    str = number_hesk.split('.');
                else if ( typeof number_hesk === 'number')
                    str = number_hesk.toString().split('.');
                if (str[0].length >= 5) {
                    str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
                    //adding comma on the appropriate place
                }
                if (str[1] && str[1].length >= 5) {
                    str[1] = str[1].replace(/(\d{3})/g, '$1 ');
                }
                return str.join('.');
            }
            var pad = function(number_hesk, size) {
                var s = number_hesk + "";
                while (s.length < size)
                s = "0" + s;
                return s;
            }
            var bgpos = function(number_hesk) {
                //t is your digit
                var g = 10;
                switch(number_hesk) {
                    case '.':
                        g = 10;
                        break;
                    case ',':
                        g = 11;
                        break;
                    case ':':
                        g = 12;
                        break;
                    default:
                        if ( typeof parseInt(number_hesk) === 'number') {
                            g = parseInt(number_hesk);
                        }
                        break;
                }
                var b = defaultopt.width * g * (-1);
                return b + "px";
            }
            this.html("");
            var l, number_start_process, temp_dump = "";
            //alert(number_raw_input);s
            if (commafied) {
                number_start_process = commafy(number_raw_input);
                l = number_raw_input.length;
            } else {
                number_start_process = number_raw_input;
                l = number_raw_input.length - 1;
            }
            for (var i = 0; i <= l; i++) {
                var c = number_start_process.charAt(i);
                temp_dump += '<div style="background-position: ' + bgpos(c) + ' 0"></div>';
            }
            this.html(temp_dump);
            this.addClass("heskCounterFrame");
            this.children('div').css(charcss);
            div_size();
            this.children('div:last-child').css(lastcharcss);
            console.log("hesk.num.js 192 load review_lower_products");
            review_lower_products(4);
        };
        /*
        Dates in javascript are numeric values of milliseconds since January 1, 1970. Facebook dates (at least creation_time and update_time in the stream table) are in seconds since January 1, 1970 so you need to multiply by 1000. Here is some code doing it for a post on my wall earlier today:
        */
        // Takes an ISO time and returns a string representing how
        // long ago the date represents.
        humandate = function(date_str) {
            var time_formats = [[60, 'just now', 1], // 60
            [120, '1 minute ago', '1 minute from now'], // 60*2
            [3600, 'minutes', 60], // 60*60, 60
            [7200, '1 hour ago', '1 hour from now'], // 60*60*2
            [86400, 'hours', 3600], // 60*60*24, 60*60
            [172800, 'yesterday', 'tomorrow'], // 60*60*24*2
            [604800, 'days', 86400], // 60*60*24*7, 60*60*24
            [1209600, 'last week', 'next week'], // 60*60*24*7*4*2
            [2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
            [4838400, 'last month', 'next month'], // 60*60*24*7*4*2
            [29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
            [58060800, 'last year', 'next year'], // 60*60*24*7*4*12*2
            [2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
            [5806080000, 'last century', 'next century'], // 60*60*24*7*4*12*100*2
            [58060800000, 'centuries', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
            ];
            var time = ('' + date_str).replace(/-/g, "/").replace(/[TZ]/g, " ").replace(/^\s\s*/, '').replace(/\s\s*$/, '');
            if (time.substr(time.length - 4, 1) == ".")
                time = time.substr(0, time.length - 4);
            var seconds = (new Date - new Date(time)) / 1000;
            var token = 'ago', list_choice = 1;
            if (seconds < 0) {
                seconds = Math.abs(seconds);
                token = 'from now';
                list_choice = 2;
            }
            var i = 0, format;
            while ( format = time_formats[i++])
            if (seconds < format[0]) {
                if ( typeof format[2] == 'string')
                    return format[list_choice];
                else
                    return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
            }
            return time;
        };
        fanslivingDateHesk = function(t, logincheck) {
            if (t == undefined) {
                //alert("t is undefined");
                return false;
            }
            if (logincheck == undefined) {
                logincheck = false;
            }
            if (jQuery.trim(t) == '0000-00-00 00:00:00' || humandate(t).indexOf('just now') != -1 && logincheck) {
                return "First Time Log In";
            } else {
                var k = t.replaceAt(10, "T") + "Z";
                return humandate(k);
            }

        }
        //humandate("2008-01-28T20:24:17Z"); // => "2 hours ago
        // If jQuery is included in the page, adds a jQuery plugin to handle it as well
        // under timetag
        $.fn.time_convert_inline = function(before) {
            var val = this.html();
            if (before != undefined)
                this.html(before + " " + fanslivingDateHesk(val));
            else
                this.html(fanslivingDateHesk(val));
        }
        $.fn.time_convert_children = function(selector) {
            var val = this.attr('since');
            if (selector == null)
                alert("doesnt work.. ");
            else
                this.children(selector).html(fanslivingDateHesk(val));
        }
        // done here
        // a small program for CSS animations that requires CSS in plugins from somewhere else.
        // developed and tested by Heskeyo Kam
        $.fn.animCss = function(animation_name, timeout, callback) {
            if (animation_name == null || timeout == null)
                return false;
            var callbacks = jQuery.Callbacks("unique memory");
            function callback_default() {
                this.removeClass();
            }

            if (callback != null)
                callbacks.add(callback);
            if (this.hasClass(animation_name))
                this.removeClass(animation_name);
            else
                this.addClass(animation_name);
            callbacks.add(callback_default);
            var wait = window.setTimeout(function() {
                callbacks.fire();
            }, timeout);
        }
    });

//@source: http://www.meiocodigo.com/projects/meiomask/
(function(b){var c=(window.orientation!=null);var a=((b.browser.opera||(b.browser.mozilla&&parseFloat(b.browser.version.substr(0,3))<1.9))?"input":"paste");var d=function(e){e=b.event.fix(e||window.event);e.type="paste";var f=e.target;setTimeout(function(){b.event.dispatch.call(f,e)},1)};b.event.special.paste={setup:function(){if(this.addEventListener){this.addEventListener(a,d,false)}else{if(this.attachEvent){this.attachEvent("on"+a,d)}}},teardown:function(){if(this.removeEventListener){this.removeEventListener(a,d,false)}else{if(this.detachEvent){this.detachEvent("on"+a,d)}}}};b.extend({mask:{rules:{z:/[a-z]/,Z:/[A-Z]/,a:/[a-zA-Z]/,"*":/[0-9a-zA-Z]/,"@":/[0-9a-zA-ZçÇáàãâéèêíìóòôõúùü]/},keyRepresentation:{8:"backspace",9:"tab",13:"enter",16:"shift",17:"control",18:"alt",27:"esc",33:"page up",34:"page down",35:"end",36:"home",37:"left",38:"up",39:"right",40:"down",45:"insert",46:"delete",116:"f5",123:"f12",224:"command"},iphoneKeyRepresentation:{10:"go",127:"delete"},signals:{"+":"","-":"-"},options:{attr:"alt",mask:null,type:"fixed",maxLength:-1,defaultValue:"",signal:false,textAlign:true,selectCharsOnFocus:true,autoTab:true,setSize:false,fixedChars:"[(),.:/ -]",onInvalid:function(){},onValid:function(){},onOverflow:function(){}},masks:{phone:{mask:"(99) 9999-9999"},"phone-us":{mask:"(999) 999-9999"},cpf:{mask:"999.999.999-99"},cnpj:{mask:"99.999.999/9999-99"},date:{mask:"39/19/9999"},"date-us":{mask:"19/39/9999"},cep:{mask:"99999-999"},time:{mask:"29:59"},cc:{mask:"9999 9999 9999 9999"},integer:{mask:"999.999.999.999",type:"reverse"},decimal:{mask:"99,999.999.999.999",type:"reverse",defaultValue:"000"},"decimal-us":{mask:"99.999,999,999,999",type:"reverse",defaultValue:"000"},"signed-decimal":{mask:"99,999.999.999.999",type:"reverse",defaultValue:"+000"},"signed-decimal-us":{mask:"99,999.999.999.999",type:"reverse",defaultValue:"+000"}},init:function(){if(!this.hasInit){var g=this,f,e=(c)?this.iphoneKeyRepresentation:this.keyRepresentation;this.ignore=false;for(f=0;f<=9;f++){this.rules[f]=new RegExp("[0-"+f+"]")}this.keyRep=e;this.ignoreKeys=[];b.each(e,function(h){g.ignoreKeys.push(parseInt(h,10))});this.hasInit=true}},set:function(e,h){var i=this,g=b(e),f="maxLength";h=h||{};this.init();return g.each(function(){if(h.attr){i.options.attr=h.attr}var o=b(this),m=b.extend({},i.options),p=o.attr(m.attr),l="";l=(typeof h=="string")?h:(p!=="")?p:null;if(l){m.mask=l}if(i.masks[l]){m=b.extend(m,i.masks[l])}if(typeof h=="object"&&h.constructor!=Array){m=b.extend(m,h)}if(b.metadata){m=b.extend(m,o.metadata())}if(m.mask!=null){m.mask+="";if(o.data("mask")){i.unset(o)}var k=m.defaultValue,j=(m.type==="reverse"),q=new RegExp(m.fixedChars,"g");if(m.maxLength===-1){m.maxLength=o.attr(f)}m=b.extend({},m,{fixedCharsReg:new RegExp(m.fixedChars),fixedCharsRegG:q,maskArray:m.mask.split(""),maskNonFixedCharsArray:m.mask.replace(q,"").split("")});if((m.type=="fixed"||j)&&m.setSize&&!o.attr("size")){o.attr("size",m.mask.length)}if(j&&m.textAlign){o.css("text-align","right")}if(this.value!==""||k!==""){var n=i.string((this.value!=="")?this.value:k,m);this.defaultValue=n;o.val(n)}if(m.type=="infinite"){m.type="repeat"}o.data("mask",m);o.removeAttr(f);o.bind("keydown.mask",{func:i._onKeyDown,thisObj:i},i._onMask).bind("keypress.mask",{func:i._onKeyPress,thisObj:i},i._onMask).bind("keyup.mask",{func:i._onKeyUp,thisObj:i},i._onMask).bind("paste.mask",{func:i._onPaste,thisObj:i},i._onMask).bind("focus.mask",i._onFocus).bind("blur.mask",i._onBlur).bind("change.mask",i._onChange)}})},unset:function(e){var f=b(e);return f.each(function(){var g=b(this);if(g.data("mask")){var h=g.data("mask").maxLength;if(h!=-1){g.attr("maxLength",h)}g.unbind(".mask").removeData("mask")}})},string:function(e,i){this.init();var f={};if(typeof e!="string"){e=String(e)}switch(typeof i){case"string":if(this.masks[i]){f=b.extend(f,this.masks[i])}else{f.mask=i}break;case"object":f=i}if(!f.fixedChars){f.fixedChars=this.options.fixedChars}var j=new RegExp(f.fixedChars),h=new RegExp(f.fixedChars,"g");if((f.type==="reverse")&&f.defaultValue){if(typeof this.signals[f.defaultValue.charAt(0)]!="undefined"){var g=e.charAt(0);f.signal=(typeof this.signals[g]!="undefined")?this.signals[g]:this.signals[f.defaultValue.charAt(0)];f.defaultValue=f.defaultValue.substring(1)}}return this.__maskArray(e.split(""),f.mask.replace(h,"").split(""),f.mask.split(""),f.type,f.maxLength,f.defaultValue,j,f.signal)},_onFocus:function(e){var f=b(this),g=f.data("mask");g.inputFocusValue=f.val();g.changed=false;if(g.selectCharsOnFocus){f.select()}},_onBlur:function(e){var f=b(this),g=f.data("mask");if(g.inputFocusValue!=f.val()&&!g.changed){f.trigger("change")}},_onChange:function(e){b(this).data("mask").changed=true},_onMask:function(g){var e=g.data.thisObj,f={};f._this=g.target;f.$this=b(f._this);f.data=f.$this.data("mask");if(f.$this.attr("readonly")||!f.data){return true}f[f.data.type]=true;f.value=f.$this.val();f.nKey=e.__getKeyNumber(g);f.range=e.__getRange(f._this);f.valueArray=f.value.split("");return g.data.func.call(e,g,f)},_onKeyDown:function(f,e){this.ignore=b.inArray(e.nKey,this.ignoreKeys)>-1||f.ctrlKey||f.metaKey||f.altKey;if(this.ignore){var g=this.keyRep[e.nKey];e.data.onValid.call(e._this,g||"",e.nKey)}return c?this._onKeyPress(f,e):true},_onKeyUp:function(f,e){if(e.nKey===9||e.nKey===16){return true}if(e.repeat){this.__autoTab(e);return true}return this._onPaste(f,e)},_onPaste:function(f,e){if(e.reverse){this.__changeSignal(f.type,e)}var g=this.__maskArray(e.valueArray,e.data.maskNonFixedCharsArray,e.data.maskArray,e.data.type,e.data.maxLength,e.data.defaultValue,e.data.fixedCharsReg,e.data.signal);e.$this.val(g);if(!e.reverse&&e.data.defaultValue.length&&(e.range.start===e.range.end)){this.__setRange(e._this,e.range.start,e.range.end)}if((b.browser.msie||b.browser.safari)&&!e.reverse){this.__setRange(e._this,e.range.start,e.range.end)}if(this.ignore){return true}this.__autoTab(e);return true},_onKeyPress:function(h,o){if(this.ignore){return true}if(o.reverse){this.__changeSignal(h.type,o)}var g=String.fromCharCode(o.nKey),e=o.range.start,k=o.value,m=o.data.maskArray;if(o.reverse){var l=k.substr(0,e),i=k.substr(o.range.end,k.length);k=l+g+i;if(o.data.signal&&(e-o.data.signal.length>0)){e-=o.data.signal.length}}var f=k.replace(o.data.fixedCharsRegG,"").split(""),n=this.__extraPositionsTill(e,m,o.data.fixedCharsReg);o.rsEp=e+n;if(o.repeat){o.rsEp=0}if(!this.rules[m[o.rsEp]]||(o.data.maxLength!=-1&&f.length>=o.data.maxLength&&o.repeat)){o.data.onOverflow.call(o._this,g,o.nKey);return false}else{if(!this.rules[m[o.rsEp]].test(g)){o.data.onInvalid.call(o._this,g,o.nKey);return false}else{o.data.onValid.call(o._this,g,o.nKey)}}var j=this.__maskArray(f,o.data.maskNonFixedCharsArray,m,o.data.type,o.data.maxLength,o.data.defaultValue,o.data.fixedCharsReg,o.data.signal,n);if(!o.repeat){o.$this.val(j)}return(o.reverse)?this._keyPressReverse(h,o):(o.fixed)?this._keyPressFixed(h,o):true},_keyPressFixed:function(f,e){if(e.range.start==e.range.end){if((e.rsEp===0&&e.value.length===0)||e.rsEp<e.value.length){this.__setRange(e._this,e.rsEp,e.rsEp+1)}}else{this.__setRange(e._this,e.range.start,e.range.end)}return true},_keyPressReverse:function(f,e){if(b.browser.msie&&((e.range.start===0&&e.range.end===0)||e.range.start!=e.range.end)){this.__setRange(e._this,e.value.length)}return false},__autoTab:function(e){if(e.data.autoTab&&((e.$this.val().length>=e.data.maskArray.length&&!e.repeat)||(e.data.maxLength!=-1&&e.valueArray.length>=e.data.maxLength&&e.repeat))){var f=this.__getNextInput(e._this,e.data.autoTab);if(f){e.$this.trigger("blur");f.focus().select()}}},__changeSignal:function(f,e){if(e.data.signal!==false){var g=(f==="paste")?e.value.charAt(0):String.fromCharCode(e.nKey);if(this.signals&&(typeof this.signals[g]!=="undefined")){e.data.signal=this.signals[g]}}},__getKeyNumber:function(e){return(e.charCode||e.keyCode||e.which)},__maskArray:function(f,k,l,i,n,h,e,g,m){if(i==="reverse"){f.reverse()}f=this.__removeInvalidChars(f,k,i==="repeat"||i==="infinite");if(h){f=this.__applyDefaultValue.call(f,h)}f=this.__applyMask(f,l,m,e);switch(i){case"reverse":f.reverse();return(g||"")+f.join("").substring(f.length-l.length);case"infinite":case"repeat":var j=f.join("");return(n!==-1&&f.length>=n)?j.substring(0,n):j;default:return f.join("").substring(0,l.length)}return""},__applyDefaultValue:function(f){var h=f.length,g=this.length,e;for(e=g-1;e>=0;e--){if(this[e]==f.charAt(0)){this.pop()}else{break}}for(e=0;e<h;e++){if(!this[e]){this[e]=f.charAt(e)}}return this},__removeInvalidChars:function(f,g,i){for(var h=0,e=0;h<f.length;h++){if(g[e]&&this.rules[g[e]]&&!this.rules[g[e]].test(f[h])){f.splice(h,1);if(!i){e--}h--}if(!i){e++}}return f},__applyMask:function(f,h,e,i){if(typeof e=="undefined"){e=0}for(var g=0;g<f.length+e;g++){if(h[g]&&i.test(h[g])){f.splice(g,0,h[g])}}return f},__extraPositionsTill:function(e,g,h){var f=0;while(h.test(g[e++])){f++}return f},__getNextInput:function(e,o){var p=e.form;if(p==null){return null}var l=p.elements,m=b.inArray(e,l)+1,j=l.length,g=null,k;for(k=m;k<j;k++){g=b(l[k]);if(this.__isNextInput(g,o)){return g}}var q=document.forms,n=b.inArray(e.form,q)+1,h,i,f=q.length;for(h=n;h<f;h++){i=q[h].elements;j=i.length;for(k=0;k<j;k++){g=b(i[k]);if(this.__isNextInput(g,o)){return g}}}return null},__isNextInput:function(e,g){var f=e.get(0);return f&&(f.offsetWidth>0||f.offsetHeight>0)&&f.nodeName!="FIELDSET"&&(g===true||(typeof g=="string"&&e.is(g)))},__setRange:function(f,e,h){if(typeof h=="undefined"){h=e}if(f.setSelectionRange){f.setSelectionRange(e,h)}else{var g=f.createTextRange();g.collapse();g.moveStart("character",e);g.moveEnd("character",h-e);g.select()}},__getRange:function(f){if(!b.browser.msie){return{start:f.selectionStart,end:f.selectionEnd}}var e={start:0,end:0},g=document.selection.createRange();e.start=0-g.duplicate().moveStart("character",-100000);e.end=e.start+g.text.length;return e},unmaskedVal:function(e){return b(e).val().replace(b.mask.fixedCharsRegG,"")}}});b.fn.extend({setMask:function(e){return b.mask.set(this,e)},unsetMask:function(){return b.mask.unset(this)},unmaskedVal:function(){return b.mask.unmaskedVal(this[0])}})})(jQuery);
/*flip counter v1.2
@source: http://bloggingsquared.com/jquery/flipcounter/
*/
//source: http://www.codingjack.com/textfx/docs.html
/*!
 * @name		Shuffle Letters
 * @author		Martin Angelov
 * @version 	1.0
 * @url			http://tutorialzine.com/2011/09/shuffle-letters-effect-jquery/
 * @license		MIT License
 */
/*
 Hesk Counter v1.0.4
 Now this is the bundle of all plugins
 Copyright 2011, Heskemo K.
 Free to use under the MIT license.
 http://www.opensource.org/licenses/mit-license.php
 */


jQuery.fn.div_load_adjusted_image = function(src, dimension) {
    this.html('<img src="' + src + '"/>')
    //load up the src file
    .find("img")
    //find the image object
    .imgProfileAdjustment(dimension);
    //fade out
    //this.fadeIn();
};
jQuery.fn.imgProfileAdjustment = function(dimension) {
    function doAjust() {
        //alert("triggered."+$(this).width());
        if ($(this).width() > $(this).height()) {
            $(this).attr('height', dimension + 'px');
        } else {
            $(this).attr('width', dimension + 'px');
        }
        $(this).unbind('load');
    }


    this.one('load', doAjust).each(function() {
        if (this.complete) {
            $(this).load(doAjust);
        } else {
            doAjust();
        }
    });
};
jQuery.fn.heskCounter = function(number_raw_input, commafied) {
    if (commafied == undefined) {
        commafied = false;
    }
    var defaultopt = {
        width : '24',
        height : '39',
        start : '666666', // the color without #
        end : '000000', //the color without #
        url : 'http://www.fansliving.com/images/common/counter-numbers.png'
    };
    var Dis = this;
    var additional_comma_char = function(number_hesk_level2) {
        return Math.floor((parseInt(number_hesk_level2.toString().length) - 1) / 3);
    }
    var div_size = function() {
        var l, cssob;
        if (commafied)
            l = additional_comma_char(number_raw_input) + number_raw_input.length;
        else {
            //alert(number_raw_input);
            l = number_raw_input.length;
        }
        cssob = {
            'width' : parseInt(defaultopt.width * l + l + 1 + 'px'),
            'height' : parseInt(defaultopt.height * 1 + 2) + 'px'
        }
    };
    var charcss = {
        'width' : defaultopt.width + 'px',
        'height' : defaultopt.height + 'px',
        'background-image' : 'url(' + defaultopt.url + ')',
        'background-repeat' : 'no-repeat',
        'float' : 'left',
        'margin' : '1px',
        'margin-right' : '0px'
    };
    var lastcharcss = {
        'width' : defaultopt.width + 'px',
        'height' : defaultopt.height + 'px',
        'background-image' : 'url(' + defaultopt.url + ')',
        'background-repeat' : 'no-repeat',
        'float' : 'left',
        'margin' : '1px',
    };
    /*this.css('filter', 'progid:DXImageTransform.Microsoft.gradient(startColorstr=\'' + defaultopt.start + '\', endColorstr=\'#' + defaultopt.end + '\', gradientType=1)');
     this.css('background-image', '-webkit-gradient(linear, left top, right bottom, color-stop(0.1, #' + defaultopt.start + '), color-stop(0.99, #' + defaultopt.end + '))');
     this.css('background-image', '-moz-linear-gradient(top left, #' + defaultopt.start + ' 0%, #' + defaultopt.end + ' 100%)');
     this.css('background-image', '-o-linear-gradient(top left, #' + defaultopt.start + ' 0%, #' + defaultopt.end + ' 100%)');*/
    var commafy = function(number_hesk) {
        var str;
        if ( typeof number_hesk === 'string')
            str = number_hesk.split('.');
        else if ( typeof number_hesk === 'number')
            str = number_hesk.toString().split('.');
        if (str[0].length >= 5) {
            str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
            //adding comma on the appropriate place
        }
        if (str[1] && str[1].length >= 5) {
            str[1] = str[1].replace(/(\d{3})/g, '$1 ');
        }
        return str.join('.');
    };
    var pad = function(number_hesk, size) {
        var s = number_hesk + "";
        while (s.length < size)
        s = "0" + s;
        return s;
    };
    var bgpos = function(number_hesk) {
        //t is your digit
        var g = 10;
        switch(number_hesk) {
            case '.':
                g = 10;
                break;
            case ',':
                g = 11;
                break;
            case ':':
                g = 12;
                break;
            default:
                if ( typeof parseInt(number_hesk) === 'number') {
                    g = parseInt(number_hesk);
                }
                break;
        }
        var b = defaultopt.width * g * (-1);
        return b + "px";
    };
    this.html("");
    var l, number_start_process, temp_dump = "";
    //alert(number_raw_input);s
    if (commafied) {
        number_start_process = commafy(number_raw_input);
        l = number_raw_input.length;
    } else {
        number_start_process = number_raw_input;
        l = number_raw_input.length - 1;
    }
    for (var i = 0; i <= l; i++) {
        var c = number_start_process.charAt(i);
        temp_dump += '<div style="background-position: ' + bgpos(c) + ' 0"></div>';
    };
    this.html(temp_dump);
    this.addClass("heskCounterFrame");
    this.children('div').css(charcss);
    div_size();
    this.children('div:last-child').css(lastcharcss);
};
/*
Dates in javascript are numeric values of milliseconds since January 1, 1970. Facebook dates (at least creation_time and update_time in the stream table) are in seconds since January 1, 1970 so you need to multiply by 1000. Here is some code doing it for a post on my wall earlier today:
*/
// Takes an ISO time and returns a string representing how
// long ago the date represents.
humandate = function(date_str) {
    var time_formats = [[60, 'just now', 1], // 60
    [120, '1 minute ago', '1 minute from now'], // 60*2
    [3600, 'minutes', 60], // 60*60, 60
    [7200, '1 hour ago', '1 hour from now'], // 60*60*2
    [86400, 'hours', 3600], // 60*60*24, 60*60
    [172800, 'yesterday', 'tomorrow'], // 60*60*24*2
    [604800, 'days', 86400], // 60*60*24*7, 60*60*24
    [1209600, 'last week', 'next week'], // 60*60*24*7*4*2
    [2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
    [4838400, 'last month', 'next month'], // 60*60*24*7*4*2
    [29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
    [58060800, 'last year', 'next year'], // 60*60*24*7*4*12*2
    [2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
    [5806080000, 'last century', 'next century'], // 60*60*24*7*4*12*100*2
    [58060800000, 'centuries', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
    ];
    var time = ('' + date_str).replace(/-/g, "/").replace(/[TZ]/g, " ").replace(/^\s\s*/, '').replace(/\s\s*$/, '');
    if (time.substr(time.length - 4, 1) == ".")
        time = time.substr(0, time.length - 4);
    var seconds = (new Date - new Date(time)) / 1000;
    var token = 'ago', list_choice = 1;
    if (seconds < 0) {
        seconds = Math.abs(seconds);
        token = 'from now';
        list_choice = 2;
    };
    var i = 0, format;
    while ( format = time_formats[i++])
    if (seconds < format[0]) {
        if ( typeof format[2] == 'string')
            return format[list_choice];
        else
            return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
    };
    return time;
};
fanslivingDateHesk = function(t, logincheck) {
    if (t == undefined) {
        //alert("t is undefined");
        return false;
    }
    if (logincheck == undefined) {
        logincheck = false;
    }
    if (jQuery.trim(t) == '0000-00-00 00:00:00' || humandate(t).indexOf('just now') != -1 && logincheck) {
        return "First Time Log In";
    } else {
        var k = t.replaceAt(10, "T") + "Z";
        return humandate(k);
    }

};
//humandate("2008-01-28T20:24:17Z"); // => "2 hours ago
// If jQuery is included in the page, adds a jQuery plugin to handle it as well
// under timetag
jQuery.fn.time_convert_inline = function(before) {
    var val = this.html();
    if (before != undefined)
        this.html(before + " " + fanslivingDateHesk(val));
    else
        this.html(fanslivingDateHesk(val));
};
jQuery.fn.time_convert_children = function(selector) {
    var val = this.attr('since');
    if (selector == null)
        alert("doesnt work.. ");
    else
        this.children(selector).html(fanslivingDateHesk(val));
};
// done here
// a small program for CSS animations that requires CSS in plugins from somewhere else.
// developed and tested by Heskeyo Kam
jQuery.fn.animCss = function(animation_name, timeout, callback) {
    if (animation_name == null || timeout == null)
        return false;
    var callbacks = jQuery.Callbacks("unique memory");
    function callback_default() {
        this.removeClass();
    }

    if (callback != null)
        callbacks.add(callback);
    if (this.hasClass(animation_name))
        this.removeClass(animation_name);
    else
        this.addClass(animation_name);
    callbacks.add(callback_default);
    var wait = window.setTimeout(function() {
        callbacks.fire();
    }, timeout);
};
/*
Dates in javascript are numeric values of milliseconds since January 1, 1970. Facebook dates (at least creation_time and update_time in the stream table) are in seconds since January 1, 1970 so you need to multiply by 1000. Here is some code doing it for a post on my wall earlier today:
*/
humandate=function(a){var f=[[60,"just now",1],[120,"1 minute ago","1 minute from now"],[3600,"minutes",60],[7200,"1 hour ago","1 hour from now"],[86400,"hours",3600],[172800,"yesterday","tomorrow"],[604800,"days",86400],[1209600,"last week","next week"],[2419200,"weeks",604800],[4838400,"last month","next month"],[29030400,"months",2419200],[58060800,"last year","next year"],[2903040000,"years",29030400],[5806080000,"last century","next century"],[58060800000,"centuries",2903040000]];var e=(""+a).replace(/-/g,"/").replace(/[TZ]/g," ").replace(/^\s\s*/,"").replace(/\s\s*$/,"");if(e.substr(e.length-4,1)=="."){e=e.substr(0,e.length-4)}var h=(new Date-new Date(e))/1000;var c="ago",g=1;if(h<0){h=Math.abs(h);c="from now";g=2}var b=0,d;while(d=f[b++]){if(h<d[0]){if(typeof d[2]=="string"){return d[g]}else{return Math.floor(h/d[2])+" "+d[1]+" "+c}}}return e};fanslivingDateHesk=function(b,c){if(b==undefined){return false}if(c==undefined){c=false}if(jQuery.trim(b)=="0000-00-00 00:00:00"||humandate(b).indexOf("just now")!=-1&&c){return"First Time Log In"}else{var a=b.replaceAt(10,"T")+"Z";return humandate(a)}};
//humandate("2008-01-28T20:24:17Z"); // => "2 hours ago
// If jQuery is included in the page, adds a jQuery plugin to handle it as well
// under timetag
jQuery.fn.time_convert_inline=function(a){var b=this.html();if(a!=undefined){this.html(a+" "+fanslivingDateHesk(b))}else{this.html(fanslivingDateHesk(b))}};jQuery.fn.time_convert_children=function(a){var b=this.attr("since");if(a==null){alert("doesnt work.. ")}else{this.children(a).html(fanslivingDateHesk(b))}};
// done here
// a small program for CSS animations that requires CSS in plugins from somewhere else.
// developed and tested by Heskeyo Kam
jQuery.fn.animCss=function(d,c,f){if(d==null||c==null){return false}var b=jQuery.Callbacks("unique memory");function a(){this.removeClass()}if(f!=null){b.add(f)}if(this.hasClass(d)){this.removeClass(d)}else{this.addClass(d)}b.add(a);var e=window.setTimeout(function(){b.fire()},c)};
/**
 * @name		Shuffle Letters
 * @author		Martin Angelov
 * @version 	1.0
 * @url			http://tutorialzine.com/2011/09/shuffle-letters-effect-jquery/
 * @license		MIT License
 */
function eval_step(str){
	if(typeof str !="undefined"){
		console.log("hesk_num.js 572 "+str);
		var k = str.length;
	    if(k<10)k=10;
	    var h = Math.floor(100/k);
	    if(h>60)h=60;
	    return h;
	}else{
		console.log("hesk_num.js 580 str undefined");
	}	

}
$.fn.shuffleLetters=function(b){var a=$.extend({step:8,fps:25,text:"",callback:function(){}},b);return this.each(function(){var g=$(this),h="";if(g.data("animated")){return true}g.data("animated",true);if(a.text){h=a.text.split("")}else{h=g.text().split("")}var d=[],j=[];for(var c=0;c<h.length;c++){var f=h[c];if(f==" "){d[c]="space";continue}else{if(/[a-z]/.test(f)){d[c]="lowerLetter"}else{if(/[A-Z]/.test(f)){d[c]="upperLetter"}else{d[c]="symbol"}}}j.push(c)}g.html("");(function e(n){var m,k=j.length,l=h.slice(0);if(n>k){g.data("animated",false);a.callback(g);return}for(m=Math.max(n,0);m<k;m++){if(m<n+a.step){l[j[m]]=randomChar(d[j[m]])}else{l[j[m]]=""}}g.text(l.join(""));setTimeout(function(){e(n+1)},1000/a.fps)})(-a.step)})};