
<?php
@require('../setup.php');

		$sql = "select * from cat_info order by phonenumber";
		$result1=mysql_query($sql);
		$count=mysql_num_rows($result1);
		for($i=0;$i<$count;$i++){
		$data=mysql_fetch_assoc($result1);
		$datas[$i]=$data;
		}
		if ($count >= 1)
		$json = array("listmenu"=>$datas);
		else
		$json = array ('listmenu'=>array ('data' => 'No',));
		echo json_encode($json);
		//header("location:{$_SERVER['PHP_SELF']}?action=create_menu");
?>

