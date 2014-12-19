var button = jQuery(".obj.control .maincontrol"), disc = jQuery(".mediaplayer .obj.disc"), backb = jQuery(".obj.control .backward"), forwardb = jQuery(".obj.control .forward"), the_song_list = jQuery(".obj.content .item");
var songs_limit = 4;
function play_music() {
	button.attr('onclick', 'pause_music();');
	if (!disc.hasClass("spin"))
		disc.addClass("spin");
	jQuery(".obj.disc .status").css("display", "block");
	button.addClass("pause");
	button.removeClass("play");
	button.removeClass("jp-play");
	button.addClass("jp-pause");
	console.log("play now");
	updatealbum();
	jQuery("#jquery_jplayer_1").jPlayer('play');
}
/*
 * @param string 
 */
function changesong(a) {
	var j = false, q = jQuery(".obj.content .item");
	try {
		q.each(function(i) {
			if (jQuery(this).hasClass("active"))
				throw true;
		});
		if (!j)
			return
	} catch(e) {
		j = e
	}
	var b = jQuery(".obj.content .item.active").index();
	if (a == 1)
		b++;
	else if (a == 0)
		b--;
	var c = b % (songs_limit );
	if (c < 0)
		c = songs_limit -1;
	q.removeClass("active");
	q.eq(c).addClass("active");
	var d = q.eq(c).attr("src");
	if (d == undefined)
		return;
	jQuery("#jquery_jplayer_1").jPlayer("setMedia", {
		mp3 : d
	});
	//console.log("c play now");
	play_music();
}

function pause_music() {
	button.attr('onclick', 'play_music();');
	jQuery(".obj.disc .status").css("display", "none");
	if (disc.hasClass("spin"))
		disc.removeClass("spin");
	button.addClass("play");
	button.removeClass("pause");
	the_song_list.removeClass("active");
	button.addClass("jp-play");
	button.removeClass("jp-pause");
	jQuery("#jquery_jplayer_1").jPlayer('pause');
	console.log("pause now");
}
/*
 * 
 *	New song to be played and the item will be trigged as well.
 *  @param number a - the index item that is to be actived. When it is played it will also trigger this tab to be active
 */
function play_music_in(a) {
	var q = jQuery(".obj.content .item");
	var b = q.eq(a).attr("src");
	jQuery("#jquery_jplayer_1").jPlayer("setMedia", {
		mp3 : b
	});
	q.eq(a).addClass("active");
	play_music();
	//console.log("play_music_in now");
}
/*
 * this function is to update the album image when new song is changed or played
 */
function updatealbum() {
	var a = jQuery('.obj.content .item.active').attr("tsrc");
	jQuery(".obj.disc .vinyl img").attr("src", a)
}
/**
 *
 * Adding a cell meaning to add a new song tab
 *  
 * @param string a - the post title
 * @param string b - the URL of the post thats the mp3 song file uri
 * @param string c - the post id
 * @param string d - the name of the singer
 * @param string e - the image src of the album
 */
function addcell(a, b, c, d, e) {
	var f = "";
	f += '<div class="item" id="' + c + '" src="' + b + '" tsrc="' + e + '">';
	f += '<div class="play"></div><div class="wrapsong"><a class="song" href="javascript:;">';
	f += a;
	f += '</a></div><a class="singer">';
	f += d;
	f += '</a></div>';
	jQuery(".obj.content").append(f)
}
/*
 * this function will start working when the jplayer is started.
 * @param object self - the object element to be triggered
 */
function implementation(self) {
	var n = 0;
	var b = _.uniq(_.shuffle(wsm_base_obj.playlistRandom));
	for (var i = 0; i < b.length; i++) {
		var c = b[i].url, read_title = b[i].title, singer_name = b[i].singer, album_url = b[i].al_url;
		var d = /(http:\/\/)(www.)*([a-zA-Z0-9\.\-]*)(.*)/i;
		var f = c.match(d);
		if (c != "" && n < songs_limit) {
			addcell(read_title, c, n, singer_name, album_url);
			n++;
		}
	}
//	console.log(wsm_base_obj);
	jQuery('.obj.content .item').click(function() {
		var that = jQuery(this);
		jQuery("#jquery_jplayer_1").jPlayer("setMedia", {
			mp3 : that.attr("src")
		});
		jQuery('.obj.content .item').removeClass("active");
		that.addClass("active");
		play_music();
	});
	backb.click(function() {
		changesong(0)
	});
	forwardb.click(function() {
		changesong(1)
	});
	play_music_in(0);
	//search bar
	function searchtext() {
		var g = jQuery(this).text();
		if (g != "")
			jQuery(".sf_search .sf_input").val(g).keyup();
	}
	jQuery(".obj.content .item .singer").bind("click", searchtext);
	jQuery(".obj.content .item .singer").bind("ontouch", searchtext);
	jQuery(".stars span").bind("click", searchtext);
	jQuery(".stars span").bind("ontouch", searchtext);
	//jQuery(".title").bind("ontouch", searchtext);
	//jQuery(".title").bind("click", searchtext);
	//console.log(self);
}
/*
 * this is the initialization for the whole program for songs
 */
function ini_media() {
	jQuery('#jquery_jplayer_1').jPlayer({
		swfPath : wsm_base_obj.theme + '/lib/js/',
		solution : 'html, flash',
		supplied : 'mp3',
		preload : 'metadata',
		ready : implementation,
		volume : 0.8,
		muted : false,
		backgroundColor : '#000000',
		cssSelectorAncestor : '#jp_container_1',
		cssSelector : {
			videoPlay : '.jp-video-play',
			play : '.jp-play',
			pause : '.jp-pause',
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
		errorAlerts : false,
		warningAlerts : false
	})
	
	.bind(jQuery.jPlayer.event.play+'.jp-play', function(event) {
		console.log("jPlayer event play");
		//jQuery("#jquery_jplayer_1").jPlayer("stop");
	})
	.bind(jQuery.jPlayer.event.abort+'.jp-stop', function() {
		console.log("jPlayer event stop");
		//jQuery("#jquery_jplayer_1").jPlayer("stop");
	})
	.bind(jQuery.jPlayer.event.pause, function() {
		console.log("jPlayer event pause");
		//jQuery("#jquery_jplayer_1").jPlayer("stop");
	})
	.bind(jQuery.jPlayer.event.ended, function() {
			//console.log("end now");
			changesong(1);
	});
}