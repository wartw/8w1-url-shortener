<?php require_once('./config/sql.php'); ?>
<?php
mysql_select_db($database_link, $link);
$query_admin01 = "SELECT * FROM `admin`";
$admin01 = mysql_query($query_admin01, $link) or die(mysql_error());
$row_admin01 = mysql_fetch_assoc($admin01);
$totalRows_admin01 = mysql_num_rows($admin01);

$colname_linkck01 = "-1";
if (isset($_GET['id'])) {
  $colname_linkck01 = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_link, $link);
$query_linkck01 = sprintf("SELECT * FROM link WHERE id = '%s'", $colname_linkck01);
$linkck01 = mysql_query($query_linkck01, $link) or die(mysql_error());
$row_linkck01 = mysql_fetch_assoc($linkck01);
$totalRows_linkck01 = mysql_num_rows($linkck01);
?><!DOCTYPE HTML>
<html>
	<head>
		<title>網址縮短成功 - <?php echo $row_admin01['title']; ?></title>
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

			<form id="signup-form" method="post">
				<h2>您的短網址為：</h2>
				<input name="url" type="text" id="url" value="<?php echo $row_admin01['url']; ?>?<?php echo $row_linkck01['id']; ?>" />
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