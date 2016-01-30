<?php require_once('./config/sql.php'); ?>
<?php
mysql_select_db($database_link, $link);
$query_admin01 = "SELECT * FROM `admin`";
$admin01 = mysql_query($query_admin01, $link) or die(mysql_error());
$row_admin01 = mysql_fetch_assoc($admin01);
$totalRows_admin01 = mysql_num_rows($admin01);

mysql_select_db($database_link, $link);
$query_linkpw01 = "SELECT * FROM link WHERE `id` = '".$_GET['id']."' and `pw` = '".$_POST['pw']."'";
$linkpw01 = mysql_query($query_linkpw01, $link) or die(mysql_error());
$row_linkpw01 = mysql_fetch_assoc($linkpw01);
$totalRows_linkpw01 = mysql_num_rows($linkpw01);
if($row_linkpw01['url']==""){

}else{
header("Location: ".stripslashes(str_replace(",", "%2C", $row_linkpw01['url'])));
}
?><!DOCTYPE HTML>
<html>
	<head>
		<title>請輸入密碼 - <?php echo $row_admin01['title']; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="<?php echo $row_admin01['nsme']; ?>" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

			<header id="header">
				<h1><a href="<?php echo $row_admin01['url']; ?>"><?php echo $row_admin01['title']; ?></a></h1>
				<p><?php echo $row_admin01['nsme']; ?></p>
			</header>

			<form id="form1" name="form1" method="post" action="">
				<input name="pw" type="password" id="pw" placeholder="此網址受密碼保護，請輸入通關密碼。"/><br/>
				<input type="submit" name="Submit" value="通關>>" />
			</form>

			<footer id="footer">
				<ul class="copyright">
					<li><?php echo date("Y"); ?> &copy; <?php echo $row_admin01['title']; ?> All Right Reserved.</li>
					<li>Design by <a href="https://www.facebook.com/5790gg6" target="_blank">PingWei</a></li>
				</ul>
			</footer>

			<script src="assets/js/main.js"></script>

	</body>
</html>