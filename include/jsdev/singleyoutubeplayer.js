/*
* 		Music Player.
*/

//make the albums to show up
var songs_limit = 1;
function implementation() {
	var button = jQuery("<a>", {
		"class" : "buttons_mp3j",
		"id" : "playpause_mp3j_0",
		"style" : "display:block;position:relative;margin-left:213px;height:30px;width:30px;",
		"onclick" : "_fontend_player_play()"
	}).html("----");
	var ua = $.browser, style_mp3player = "display:block;font-size:25px;height:30px;line-height:25px;margin-left:490px;top:13px;position:relative; width: 310px;";
	if (ua.mozilla) {
		style_mp3player = "display:block;font-size:25px;height:30px;line-height:25px;margin-left:490px;top:-5px;position:relative; width: 310px;";
	}
	var title = jQuery("<div>", {
		"class" : "buttons_mp3j",
		"id" : "digit_title_bar",
		"style" :style_mp3player
	}).html("----");
	jQuery("#frontendmusicplayer").append(button, title).css("height", "60px").css("width", "600px");
	var b = _.uniq(_.shuffle(wsm_base_obj.playlistRandom)), n = 0;
	for (var i = 0; i < b.length; i++) {
		var c = b[i].url, read_title = b[i].title, singer_name = b[i].singer, album_url = b[i].al_url;
		var d = /(http:\/\/)(www.)*([a-zA-Z0-9\.\-]*)(.*)/i;
		var f = c.match(d);
		if (c != "" && n < songs_limit) {
			//addcell(read_title, c, n, singer_name, album_url);
			jQuery("#digit_title_bar").html(read_title + " - " + singer_name);
			jQuery("#frontendmusicplayer").jPlayer("setMedia", {
				mp3 : c
			});
			n++;
		}
	}
	jQuery("#frontendmusicplayer").jPlayer("play");
}

function _fontend_player_play() {
	jQuery("#playpause_mp3j_0").attr("class", "buttons_mp3jpause");
	jQuery("#frontendmusicplayer").jPlayer("play");
	jQuery("#playpause_mp3j_0").attr("onclick", "_fontend_player_pause()");
	pauseVideo();
}

function _fontend_player_pause() {
	jQuery("#frontendmusicplayer").jPlayer("pause");
	jQuery("#playpause_mp3j_0").attr("onclick", "_fontend_player_play()");
	jQuery("#playpause_mp3j_0").attr("class", "buttons_mp3j");
}

function ini_fontend_player() {
	// "player wsm_big_width";
	jQuery("#frontendmusicplayer").jPlayer({
		swfPath : wsm_base_obj.theme + '/lib/js/',
		solution : 'html, flash',
		supplied : 'mp3',
		preload : 'metadata',
		ready : implementation,
		volume : 0.8,
		muted : false,
		/*play : function() {
		 alert("load_content.js 67");
		 jQuery("#playpause_mp3j_0").attr("class", "buttons_mp3jpause");
		 jQuery("#frontendmusicplayer").jPlayer("play");
		 pauseVideo();
		 },
		 pause : function() {
		 jQuery("#frontendmusicplayer").jPlayer("pause");
		 jQuery("#playpause_mp3j_0").attr("class", "buttons_mp3j");
		 },*/
		cssSelector : {
			videoPlay : '.jp-video-play',
			play : '.buttons_mp3j',
			pause : '.buttons_mp3jpause',
			stop : '.jp-stop',
			seekBar : '.jp-seek-bar',
			playBar : '.jp-play-bar',
			mute : '.jp-mute',
			unmute : '.jp-unmute',
			volumeBar : '.jp-volume-bar',
			volumeBarValue : '.jp-volume-bar-value',
			volumeMax : '.jp-volume-max',
			fullScreen : '.jp-full-screen',
			restoreScreen : '.jp-restore-screen',
			repeat : '.jp-repeat',
			repeatOff : '.jp-repeat-off',
			gui : '.jp-gui',
			noSolution : '.jp-no-solution'
		},
	})
	// =========================
	.bind(jQuery.jPlayer.event.play, function() {
		jQuery("#playpause_mp3j_0").attr("onclick", "_fontend_player_pause()");
		jQuery("#playpause_mp3j_0").attr("class", "buttons_mp3jpause");
		pauseVideo();
	}).bind(jQuery.jPlayer.event.ended, function() {
		jQuery("#playpause_mp3j_0").attr("class", "buttons_mp3j");
		playVideo();
	});
}

/*
 * Chromeless player has no controls.
 */
var wsmSingleYTplaya;
// Update a particular HTML element with a new value
function updateHTML(elmId, value) {
	//document.getElementById(elmId).innerHTML = value;
}

// This function is called when an error is thrown by the player
function onPlayerError(errorCode) {
	alert("An error occured of type:" + errorCode);
}

// This function is called when the player changes state
function onPlayerStateChange(newState) {
	if (newState == 1) {
		//playing
		//if (PKL_Pause != undefined) {
		//PKL_Pause("PKL_PLAYER");
		_fontend_player_pause();
		if (!jQuery("#info_bank_yt_status").hasClass("play")) {
			jQuery("#info_bank_yt_status").addClass("play");
			//}
			jQuery("#info_bank_yt_status").attr("onclick", "pauseVideo()");
		}
	}
	if (newState == 2) {
		//stopped
		if (jQuery("#info_bank_yt_status").hasClass("play"))
			jQuery("#info_bank_yt_status").removeClass("play");
	}
	if (newState == -1 && !wsm_base_obj.ishome) {
		//the video is just loaded
		wsmSingleYTplaya.playVideo();
		if (height_cal != undefined)
			height_cal();
	}
	//updateHTML("info_bank_yt_cell1", newState);
}

// Display information about the current state of the player
function updatePlayerInfo() {
	// Also check that at least one function exists since when IE unloads the
	// page, it will destroy the SWF before clearing the interval.
	if (wsmSingleYTplaya && wsmSingleYTplaya.getDuration) {
		/*
		 updateHTML("videoDuration", wsmSingleYTplaya.getDuration());
		 updateHTML("videoCurrentTime", wsmSingleYTplaya.getCurrentTime());
		 updateHTML("bytesTotal", wsmSingleYTplaya.getVideoBytesTotal());
		 updateHTML("startBytes", wsmSingleYTplaya.getVideoStartBytes());
		 updateHTML("bytesLoaded", wsmSingleYTplaya.getVideoBytesLoaded());
		 updateHTML("volume", wsmSingleYTplaya.getVolume());

		 */
	}
}

// Allow the user to set the volume from 0-100
function setVideoVolume() {
	var volume = parseInt(document.getElementById("volumeSetting").value);
	if (isNaN(volume) || volume < 0 || volume > 100) {
		alert("Please enter a valid volume between 0 and 100.");
	} else if (wsmSingleYTplaya) {
		wsmSingleYTplaya.setVolume(volume);
	}
}

function playVideo() {
	if (wsmSingleYTplaya) {
		if (wsmSingleYTplaya.getPlayerState() == 2 || wsmSingleYTplaya.getPlayerState() == -1) {
			//if (PKL_Pause != undefined) {
			//PKL_Pause("PKL_PLAYER");
			wsmSingleYTplaya.playVideo();
			//}
		}
	}
}

function pauseVideo() {
	if (wsmSingleYTplaya) {
		wsmSingleYTplaya.pauseVideo();
	}
	if (!jQuery("#info_bank_yt_status").hasClass("play")) {
		jQuery("#info_bank_yt_status").removeClass("play");
		//}
		jQuery("#info_bank_yt_status").attr("onclick", "playVideo()");
	}
}

function muteVideo() {
	if (wsmSingleYTplaya) {
		wsmSingleYTplaya.mute();
	}
}

function unMuteVideo() {
	if (wsmSingleYTplaya) {
		wsmSingleYTplaya.unMute();
	}
}

var ytplayer_current_ID_single;

// This function is automatically called by the player once it loads
function onYouTubePlayerReady(playerId) {
	wsmSingleYTplaya = document.getElementById("ytPlayer_index");
	// This causes the updatePlayerInfo function to be called every 250ms to
	// get fresh data from the player
	setInterval(updatePlayerInfo, 250);
	updatePlayerInfo();
	wsmSingleYTplaya.addEventListener("onStateChange", "onPlayerStateChange");
	wsmSingleYTplaya.addEventListener("onError", "onPlayerError");
	//Load an initial video into the player
	//WyuO_LcE7hM
	//k5yCwmEBCEA
	if (wsm_base_obj.ishome) {
		var mv_h = wsm_base_obj.playlistYtRandom.length;
		if (mv_h == 0)
			ytplayer_current_ID_single = "WyuO_LcE7hM";
		else {
			//var current = wsm_base_obj.playlistYtRandom[Math.round(Math.random() * (mv_h - 1))];
			//alert("onYouTubePlayerReady");
			ytplayer_current_ID_single = what_is_the_first_song();
		}
	} else {
		ytplayer_current_ID_single = jQuery(".mv_list li.active").attr("data-youtube-url");
	}
	getYouTubeInfo(ytplayer_current_ID_single);
	wsmSingleYTplaya.setLoop(true);
	wsmSingleYTplaya.cueVideoById(ytplayer_current_ID_single);
	//wsmSingleYTplaya.cuePlaylist("UUeYYbcwcpz7wN9k6asB0hOw");
	/*wsmSingleYTplaya.cuePlaylist({
	listType:"user_uploads",
	list:"UUeYYbcwcpz7wN9k6asB0hOw",
	index:Math.round(Math.random() * (mv_h - 1))
	});*/
	//wsmSingleYTplaya.setShuffle(true);
	//getYouTubeInfo(ytplayer_current_ID_single);
	//alert(wsmSingleYTplaya.getId())

}

// The "main method" of this sample. Called when someone clicks "Run".
function ytPlayer_index_loadPlayer() {
	// Lets Flash from another domain call JavaScript
	var params = {
		allowScriptAccess : "always",
		wmode : "gpu"
	};
	// The element id of the Flash embed
	var atts = {
		id : "ytPlayer_index"
	};
	// All of the magic handled by SWFObject (http://code.google.com/p/swfobject/)
	if (wsm_base_obj.ishome) {
		swfobject.embedSWF("http://www.youtube.com/apiplayer?" + "version=3&enablejsapi=1&playerapiid=player1", "viewer_video", "395", "242", "9", null, null, params, atts);
	} else {
		swfobject.embedSWF("http://www.youtube.com/apiplayer?" + "version=3&enablejsapi=1&playerapiid=player1", "viewer_video", "460", "274", "9", null, null, params, atts);
	}
}

function what_is_the_first_song() {
	var longs = wsm_base_obj.playlistRandom.length;
	var show_at = Math.round(Math.random() * (longs - 1));
	var vid = wsm_base_obj.playlistRandom[show_at].ytid;
	//alert(vid);
	if (vid != null)
		return vid;
	else
		return "WyuO_LcE7hM";
}

// ADDITIONAL YOUTUBE API
function getYouTubeInfo(ID) {
	jQuery.ajax({
		url : "http://gdata.youtube.com/feeds/api/videos/" + ID + "?v=2&alt=json",
		dataType : "jsonp",
		success : function(data) {
			parseresults(data);
		}
	});
}

function parseresults(data) {
	var title = data.entry.title.$t;
	var description = data.entry.media$group.media$description.$t;
	var viewcount = data.entry.yt$statistics.viewCount;
	var author = data.entry.author[0].name.$t;
	//jQuery('#info_bank_yt_cell1').html(title);
	jQuery("#info_bank_yt_cell1").html(title);
	/*
	jQuery('#description').html('<b>Description</b>: ' + description);
	jQuery('#extrainfo').html('<b>Author</b>: ' + author + '<br/><b>Views</b>: ' + viewcount);
	*/
	//getComments(data.entry.gd$comments.gd$feedLink.href + '&max-results=50&alt=json', 1);
}

function getComments(commentsURL, startIndex) {
	jQuery.ajax({
		url : commentsURL + '&start-index=' + startIndex,
		dataType : "jsonp",
		success : function(data) {
			$.each(data.feed.entry, function(key, val) {
				$('#comments').append('<br/>Author: ' + val.author[0].name.$t + ', Comment: ' + val.content.$t);
			});
			if ($(data.feed.entry).size() == 50) {
				getComments(commentsURL, startIndex + 50);
			}
		}
	});
}

/*
 $(document).ready(function() {
 getYouTubeInfo();
 });*/
/*
 function _run() {
 loadPlayer();
 }*/