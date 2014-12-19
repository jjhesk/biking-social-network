 <html>
    <head>
      <title>My Facebook Login Page</title>
    </head>
    <body>
<!--  <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '285010261575298',
            status     : true, 
//			cookie     : true,
            xfbml      : true,
//			oauth      : true,
          });
          
//		FB.Event.subscribe('auth.login', function () {
//        window.location = "https://apps.imusictech.com/dev-gary/index.php/admin/index/";
          
        };
        (function(d){
           var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           d.getElementsByTagName('head')[0].appendChild(js);
         }(document));

FB.api('/me', function(response) {
  alert('Your name is ' + response.name);
});

      </script>
      <div class="fb-login-button">Login with Facebook</div>    -->
  
  
  
    
      
  <script src="https://connect.facebook.net/en_US/all.js">
  </script>
  <script>
      FB.init({
          appId: '<?=$app_id?>', cookie: true,
          status: true, xfbml: true
      });
      FB.Event.subscribe('auth.login', function () {
          window.location = "<?=site_url('admin/index/')?>";
      });
  </script>
  
  
  <h3>Decisiontree Control Panel</h3>
  
  Please login with your facebook account<br><br>
  <fb:login-button>
     Login
  </fb:login-button>
  
  
      


<!--	<?
			$params = array
			(
			//	'scope' => 'read_stream, friends_likes',
				'redirect_uri' => site_url('admin/index')
			);		
			$loginUrl = $this->facebook->getLoginUrl($params); 
//			echo $loginUrl.'<br>';
		?>

		<a href="<?=$loginUrl?>"> login </a> -->

    </body>
 </html>

