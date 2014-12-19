<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn = "192.168.1.182";
$database_conn = "fungdb";
$username_conn = "fung";
$password_conn = "147";
$conn = mysql_connect($hostname_conn, $username_conn, $password_conn) or trigger_error(mysql_error(),E_USER_ERROR);

if (!$conn) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db($database_conn);
?>