<!-- fb comment js init at tpl_main-->
        <div id="fb-root"></div>	<!-- facebook comments -->
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=513818161967291";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments" data-href="<?=$fb_comments_url?>" data-width="480" data-num-posts="2"></div>
