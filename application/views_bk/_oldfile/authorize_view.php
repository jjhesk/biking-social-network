<!--
<a 
  target="_top" 
  href="
    https://www.facebook.com/dialog/oauth/?
     client_id=285010261575298
     &redirect_uri=http://www.facebook.com/pages/%E6%B1%BA%E7%AD%96%E6%A8%B9-Decision-Tree/354505774608035?sk=app_285010261575298
     &scope=user_about_me,user_activities,user_birthday,user_checkins,user_interests,user_likes,user_location,email,publish_stream">
Please Authenticate Me! (placeholder, supposed to be pop up onload)<br>
</a>
-->



<script>
  var oauth_url = 'https://www.facebook.com/dialog/oauth/';
  oauth_url += '?client_id=<?=$app_id?>';
  oauth_url += '&redirect_uri=' + encodeURIComponent('<?=$app_url?>');
  oauth_url += '&scope=user_about_me,user_activities,user_birthday,user_checkins,user_interests,user_likes,user_location,email,publish_stream'

  window.top.location = oauth_url;
</script>


