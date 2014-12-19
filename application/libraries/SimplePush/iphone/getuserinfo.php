<?php

@require('../setup.php');

$con =@mysql_connect("192.168.1.182", "fung", "147") or die(mysql_error());
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }


echo aa;

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
//echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';

mysql_close($con);
?>
