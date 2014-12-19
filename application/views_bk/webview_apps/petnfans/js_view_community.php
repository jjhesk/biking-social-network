<script id="jsview_community">
	jQuery(function($) {
		//console.log(jQuery("#communityView"));
		//console.log(fans_obj.webview);
		console.log("run");
		/*var flag = false;
		 jQuery("#mainpage article .readmore").each(function() {
		 jQuery(this).bind('touchstart click', function() {
		 console.log("run");
		 if (!flag) {
		 flag = true;
		 setTimeout(function() {
		 flag = false;
		 }, 100);
		 var id = jQuery(this).attr("comment_id");
		 console.log("id get to "+id)
		 LoadDiscussion(id);
		 }
		 return false;
		 });
		 });*/
		
		the_id_of_the_slider_view="communityView";
		LoadTopics(fans_obj.webview.ajaxtopics, template_article_topic,true);
	});
/*      DESIGN */
	var template_article_topic = function(obj_res) {
		var article = "<article class=\"communityTopic\">";
		article += "<div class=\"Q\">Q</div>";
		article += "<div class=\"wrapper\">";
		article += "<section class=\"question\">" + obj_res.comment_text;
		if (obj_res.subcomment_count > 0) {
		    var temp = obj_res.subcomment_array;
		    var thelastanswer=temp.slice(-1);
		  // console.log(thelastanswer);
           article +="<br><span class=\"answer\">Last answer: " + substrmix(thelastanswer[0].comment_text,30) + "</span>";
		}
		//console.log(obj_res);
		article +="<br><span class=\"updatetime\">" + obj_res.last_updated + "</span>";
		article +="</section>";
		//article += "<section class=\"smallanswer\">" + obj_res.last_updated + "</section>";
		article += "</div>";
		article += "<div class=\"bubble\">" + obj_res.subcomment_count + "</div>";
		//if (obj_res.subcomment_count > 0) {
		article += "<a comment_id=" + obj_res.comment_id + " href=\"javascript:LoadDiscussion('" + obj_res.comment_id + "')\" class=\"readmore\"></a>";
		//}
		article += "</article>";
		return article;
	}

	var template_article_discussion = function(obj_res) {
		var article = "<article class=\"discussionThread\">";
		article += "<div class=\"username\">" + obj_res.firstname +" "+obj_res.lastname + ":</div>";
		article += "<section class=\"updatetime\">" + obj_res.last_updated + "</section>";
		article += "<div class=\"wrapper\">";
		article += "<section class=\"response\">" + obj_res.comment_text + "</section>";
		article += "</div>";
		//console.log(obj_res.comment_id);
		//article += "<div class=\"bubble\">" + obj_res.subcomment_count + "</div>";
		//article += "<a comment_id=" + obj_res.comment_id + " class=\"readmore\"></a>";
		article += "</article>";
		return article;
	}
</script>