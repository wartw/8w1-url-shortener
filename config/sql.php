<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_link = "localhost";
$database_link = "db_name";
$username_link = "db_user";
$password_link = "db_pass";
$link = mysql_connect($hostname_link, $username_link, $password_link) or trigger_error(mysql_error(),E_USER_ERROR); 
?>