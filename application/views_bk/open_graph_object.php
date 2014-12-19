			<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
			<head>
			<link rel="shortcut icon" type="image/png" href="http://www.fansliving.com/images/colorbox/fansliving_32x32.png">

			<meta property="fb:app_id" content="<?=$fb_app_id?>" /> 
			<meta property="fb:admins" content="<?=$fb_admins?>" /> 
			<meta content="fansliving.com" property="og:title" />
			<meta property="og:type"   content="object" /> 
			<meta content="fansliving.com" property="og:site_name" />
			<meta content="en" property="og:language" />

			<? 	foreach($open_graph_object['open_graph_object_data'] as $key=>$val){ ?>
					<meta property="<?=$open_graph_object['open_graph_object_property'][$key]?>" content="<?=$val?>" />	
			<? 	} ?>
			</head>
			<body>
			<script>
				top.location.href='<?=$open_graph_object['returnurl']?>';
			</script>
			</body> 
			</html>
			  