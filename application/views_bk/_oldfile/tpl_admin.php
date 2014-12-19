
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administration</title>

<style>
body, table, th, td{
	color:#333333;
	font-size:11px;
	font-family: Verdana, Arial, sans-serif;
	font: Verdana, Arial, sans-serif;
}

p{
color:#333333;
	font-size:11px;
	font-family: Verdana, Arial, sans-serif;
	font: Verdana, Arial, sans-serif;
}

th, td{
	/*border: 1px solid #cccccc;*/
	border: #cccccc;
	padding: 3px;
}
span{
color:#333333;
	font-size:11px;
	font-family: Verdana, Arial, sans-serif;
	font: Verdana, Arial, sans-serif;
	font-weight:bold;
}
</style>

<script type="text/javascript">
function hide_manage_quiz() 
{
	document.getElementById("manage_quiz").style.display = 'none';
}

function show_manage_quiz() 
{
	document.getElementById("manage_quiz").style.display = 'block';
}
</script>




</head>



<body>
<table width="100%" border=0 valign="top">
<tr>
<td width="200px" valign="top">

<a href = "<?=site_url("admin/index")?>">Manage users</a><br><br>
Action list<br>

- <a href = "<?=site_url("admin/action_list_users")?>">users</a><br>
- Post to wall (coming soon, pls use the one on manage user for now)<br>
- Email (waiting for SMTP info)

<br>
<!--<a href = "<?=site_url("admin/manage_quiz")?>" onclick = "show_manage_quiz()">-->Manage quiz<!--</a>--><br>

	-&nbsp;<a href="<?=site_url("admin/quiz_list")?>">quiz list</a><br>
	-&nbsp;<a href="<?=site_url("admin/create_quiz")?>">create quiz</a><br><br>
<!--<a href="<?=site_url("admin/create_quiz_step2")?>">- step 2</a><br>
	<a href="<?=site_url("admin/create_quiz_step3")?>">- step 3</a><br>
<br>	-->

<!--<a href = "<?=site_url("admin/statistics")?>">Statistics</a><br><br>-->


<?
//$params = array( 'next' => 'http://fb-quiz.imusictech.com/index.php/admin/test_logout' );
//	site_url("admin/index")

//	$params = array( 'next' => site_url("admin/index/") );
//	$logoutUrl = $this->facebook->getLogoutUrl($params); 
	$logoutUrl = $this->facebook->getLogoutUrl(array('next' => site_url("admin/logout/") ));

//echo $logoutUrl;

?>


<a href="<?=$logoutUrl?>">logout</a><br>



<!--<a href = "<?=site_url("admin/logout")?>">log</a>-->
</td>

<td>
<?php 
	if(isset($msg)) 
		echo "<p style='color:red'>$msg</p>";
?>

<?php include("admin/{$content}.php");?></td>

</tr>

</table>

</body>