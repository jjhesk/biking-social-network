//	set_domain();
	function set_domain() {
        var this_host = location.host;
        var this_path = location.pathname;
        
        //skip forums
        if(this_path.indexOf('/forums') < 0) {
            if(this_host == 'blogazine.beautyexchange.com.hk'
                || this_host == 'beta.beautyexchange.com.hk'
                || this_host == 'www.beautyexchange.com.hk') {
                document.domain="beautyexchange.com.hk";
            } else {
                document.domain="beautyexchange.com";
            }
        }
	}
	
	function explode( delimiter, string, limit ) {
	    // http://kevin.vanzonneveld.net
	    // +     original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	    // +     improved by: kenneth
	    // +     improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	    // +     improved by: d3x
	    // +     bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	    // *     example 1: explode(' ', 'Kevin van Zonneveld');
	    // *     returns 1: {0: 'Kevin', 1: 'van', 2: 'Zonneveld'}
	    // *     example 2: explode('=', 'a=bc=d', 2);
	    // *     returns 2: ['a', 'bc=d']
	 
	    var emptyArray = { 0: '' };
	    
	    // third argument is not required
	    if ( arguments.length < 2
	        || typeof arguments[0] == 'undefined'
	        || typeof arguments[1] == 'undefined' )
	    {
	        return null;
	    }
	 
	    if ( delimiter === ''
	        || delimiter === false
	        || delimiter === null )
	    {
	        return false;
	    }
	 
	    if ( typeof delimiter == 'function'
	        || typeof delimiter == 'object'
	        || typeof string == 'function'
	        || typeof string == 'object' )
	    {
	        return emptyArray;
	    }
	 
	    if ( delimiter === true ) {
	        delimiter = '1';
	    }
	    
	    if (!limit) {
	        return string.toString().split(delimiter.toString());
	    } else {
	        // support for limit argument
	        var splitted = string.toString().split(delimiter.toString());
	        var partA = splitted.splice(0, limit - 1);
	        var partB = splitted.join(delimiter.toString());
	        partA.push(partB);
	        return partA;
	    }
	}

	function isInteger(n) {
    	result=( /^-?\d+$/.test(n+''));
    	return result;
	}

	function isEmpty(inputStr) {
	  var regexp = / /g;
	
	  sourceString = inputStr;
	
		inputStr=sourceString.replace( regexp , "");
	
		if (inputStr == null || inputStr == "") {
			return true;
		}
		return false;
	}
	
	//	/	/	/	/	/	/	/	/	/	/	/	dojo animation /	/	/	/	/	/	
	var delayAnims = function(obj,id,delayTime,durations){
		console.log('yo');
		var delay = 0;
		var _anims = [];

		dojo.query("."+id).forEach(function(n){
			_anims.push(
				dojox.fx.wipeTo(dojo.mixin({ node:n, delay:(delay+=delayTime),duration:durations  },obj))
			);
		});
		console.log(_anims);
		dojo.fx.combine(_anims).play();
		
	}
	
	// /	/	/	/	/	/	/	searchPanel Animation /	/	/	/	
	var searchPanelOpen=0;
	var searchPanelLock=0;
	function clickSearchPanel (panelHeight) {
		if (searchPanelOpen==0 && searchPanelLock==0) {
			openSearchPanel(panelHeight);
		}else if (searchPanelOpen==1 && searchPanelLock==0){
			closeSearchPanel();
		}
	}
	
	function openSearchPanel (panelHeight) {
		if (searchPanelOpen==0){
			delayAnims({ height: panelHeight },'searchPanel',200,300);
			//delayAnims({ width: document.body.clientWidth*0.80 },'searchPanel',200,300);
			document.getElementById('searchPanel').style.display="block";
			searchPanelOpen=1;
		}
	}
	
	function closeSearchPanel() {
		if (searchPanelOpen==1){
			delayAnims({ height: 0 },'searchPanel',200,300);
			//delayAnims({ width: document.body.clientWidth*0.80 },'searchPanel',200,300);
			document.getElementById('searchPanel').style.display="block";
			searchPanelOpen=0;
		}
	}
	//	/	/	/	/	/	/	/	/	/	/	/	/	/	/	
	
	
	
	
	//highslide -- popup
	var dialogObj;
	function openPhoto(aHref) {
	
		return hs.expand(aHref);
	}
	
	function openDialog (aHref,frameWidth, frameHeight) {
		//alert("called");
		//dialogObj=aHref;
		//alert(frameWidth+",  "+frameHeight );
		//dimmingOpacity: 0.5,
		//obj=document.getElementById("top_banner");
		//obj.style.display="none";
		
		return hs.htmlExpand(aHref, { objectType: 'iframe',dimmingOpacity: 0.7, objectLoadTime:'after', objectWidth:frameWidth, objectHeight:frameHeight, width:frameWidth, minWidth:frameWidth, minHeight:frameHeight, height:frameHeight, preserveContent:false } )
	//	return hs.htmlExpand(aHref, { objectType: 'iframe',dimmingOpacity: 0.7, width:frameWidth, minWidth:frameWidth, minHeight:frameHeight, height:frameHeight, preserveContent:false } )
	//	return hs.htmlExpand(aHref, { objectType: 'iframe',dimmingOpacity: 0.7, preserveContent:false } )
		
	}
	function closeDialog() {
        var this_host=parent.location.host;
		hs.close();
		if(this_host.indexOf('blogazine') >= 0) {
            parent.location.reload();
		}
	}

    //trimming functions
	function trim(stringToTrim) {
	    return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	function ltrim(stringToTrim) {
	    return stringToTrim.replace(/^\s+/,"");
	}
	function rtrim(stringToTrim) {
	    return stringToTrim.replace(/\s+$/,"");
	}
	
	//get string length for mostly english chars
    function strlen_en(str)
    {
        var counter;
        var i;
        counter=0;
        for(i=0;i<str.length;i++)
        {
            while(str.charAt(i)==' '||str.charCodeAt(i)>255||str.charAt(i)=='\n') i++;
            if(str.charAt(i+1)==' '||str.charAt(i+1)=='\n'||str.charCodeAt(i+1)>255||i==str.length-1) counter++;
        }
        return counter;
    }
    
    //get string length for mostly NON-english chars
    function strlen_non_en(str)
    {
        var counter;
        var i;
        counter=0;
        for(i=0;i<str.length;i++)
        {
            if(str.charCodeAt(i)>255)
            {
                counter++;
            }
        }
        return counter;
    }

	function set_highline(id) {
			
		obj=document.getElementById(id);
		if (obj) {
			obj.focus();
			obj.select();
		}

	}
	
	function Set_Cookie( name, value, expires, path, domain, secure )
	{
		// set time, it's in milliseconds
		var today = new Date();
		today.setTime( today.getTime() );
		
		/*
		if the expires variable is set, make the correct
		expires time, the current script below will set
		it for x number of days, to make it for hours,
		delete * 24, for minutes, delete * 60 * 24
		*/
		if ( expires ) {
			expires = expires * 1000 * 60 * 60 * 24;
		}
		var expires_date = new Date( today.getTime() + (expires) );
		
		document.cookie = name + "=" +escape( value ) +
		( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
		( ( path ) ? ";path=" + path : "" ) +
		( ( domain ) ? ";domain=" + domain : "" ) +
		( ( secure ) ? ";secure" : "" );
	}
	
	function Get_Cookie( check_name ) {
		// first we'll split this cookie up into name/value pairs
		// note: document.cookie only returns name=value, not the other components
		var a_all_cookies = document.cookie.split( ';' );
		var a_temp_cookie = '';
		var cookie_name = '';
		var cookie_value = '';
		var b_cookie_found = false; // set boolean t/f default f
	
		for ( i = 0; i < a_all_cookies.length; i++ )
		{
			// now we'll split apart each name=value pair
			a_temp_cookie = a_all_cookies[i].split( '=' );
			// and trim left/right whitespace while we're at it
			cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');
			// if the extracted name matches passed check_name
			if ( cookie_name == check_name )	{
				b_cookie_found = true;
				// we need to handle case where cookie has no value but exists (no = sign, that is):
				if ( a_temp_cookie.length > 1 )	{
					cookie_value = unescape( a_temp_cookie[1].replace(/^\s+|\s+$/g, '') );
				}
				// note that in cases where cookie is initialized but no value, null is returned
				return cookie_value;
				break;
			}
			a_temp_cookie = null;
			cookie_name = '';
		}
		if ( !b_cookie_found )
		{
			return null;
		}
	}	
	
	
