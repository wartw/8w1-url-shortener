<?php require_once('./config/sql.php'); ?>
<?php
mysql_select_db($database_link, $link);
$query_admin01 = "SELECT * FROM `admin`";
$admin01 = mysql_query($query_admin01, $link) or die(mysql_error());
$row_admin01 = mysql_fetch_assoc($admin01);
$totalRows_admin01 = mysql_num_rows($admin01);

mysql_select_db($database_link, $link);
$query_linkgoto01 = "SELECT * FROM link WHERE `id` = '".$_SERVER['QUERY_STRING']."'";
$linkgoto01 = mysql_query($query_linkgoto01, $link) or die(mysql_error());
$row_linkgoto01 = mysql_fetch_assoc($linkgoto01);
$totalRows_linkgoto01 = mysql_num_rows($linkgoto01);
if($row_linkgoto01['id']<>""){
	if($row_linkgoto01['pw']==""){
header("Location: ".stripslashes(str_replace(",", "%2C", $row_linkgoto01['url'])));
	}else{
header("Location: pass.php?id=".$row_linkgoto01['id']);
	}
}
	
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $row_admin01['title']; ?> - <?php echo $row_admin01['nsme']; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="<?php echo $row_admin01['nsme']; ?>" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

			<header id="header">
				<h1><a href="<?php echo $row_admin01['url']; ?>"><?php echo $row_admin01['title']; ?></a></h1>
				<p><?php echo $row_admin01['nsme']; ?></div></p>
			</header>

			<form form id="form1" name="form1" method="post" action="check.php">
				<input name="url" type="text" id="url" placeholder="輸入網址 (需要有 http:// 開頭)" /><br>
				<input name="pw" type="password" id="pw" placeholder="設定密碼 (可選)"/><br>
				<input type="submit" name="Submit" value="產生>>" />
				<input type="hidden" name="MM_insert" value="shortlink01" />
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