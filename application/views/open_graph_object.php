			<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
			<head>
			<link rel="shortcut icon" type="image/png" href="<?=base_url()?>images/icon_32x32.png">
			<meta property="og:type" content="website" />
			<meta property="fb:app_id" content="<?=$fb_app_id?>"> 
			<meta property="fb:admins" content="<?=$fb_admins?>"> 
    		<? 	foreach($open_graph_object['open_graph_object_data'] as $key=>$val){ ?>
			<meta property="<?=$open_graph_object['open_graph_object_property'][$key]?>" content="<?=$val?>" />	
			<? 	} ?>
			<? /*
			<meta property="og:title" content="The Ninja"/>
		    <meta property="og:type" content="movie"/>
		    <meta property="og:url" content="http://www.nin.ja"/>
		    <meta property="og:image" content="<?=base_url()?>images/icon_32x32.png"/>
		    <meta property="og:site_name" content="Ninja"/>
		    <meta property="og:description"
          			content="Superhuman or supernatural powers were often
                   	associated with the ninja. Some legends include
                   	flight, invisibility and shapeshifting..."/>
            */ ?>
            <meta property="og:locale" content="en_US" />
			</head>
			<body>
			<script>
				//top.location.href='<?=$open_graph_object['returnurl']?>';
			</script>
			</body> 
			</html>