<?php require_once('./config/sql.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "adminlogin.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "adminc01")) {
  $updateSQL = sprintf("UPDATE admin SET id=%s, pw=%s, title=%s, nsme=%s, ck=%s, url=%s WHERE n=%s",
                       GetSQLValueString($_POST['id'], "text"),
                       GetSQLValueString($_POST['pw'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['nsme'], "text"),
                       GetSQLValueString($_POST['ck'], "text"),
                       GetSQLValueString($_POST['url'], "text"),
                       GetSQLValueString($_POST['n'], "int"));

  mysql_select_db($database_link, $link);
  $Result1 = mysql_query($updateSQL, $link) or die(mysql_error());

  $updateGoTo = "adminpanel.php?ok1=ok";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_link, $link);
$query_admin01 = "SELECT * FROM `admin`";
$admin01 = mysql_query($query_admin01, $link) or die(mysql_error());
$row_admin01 = mysql_fetch_assoc($admin01);
$totalRows_admin01 = mysql_num_rows($admin01);
?><!DOCTYPE HTML>

<html>
	<head>
		<title>管理中心  - <?php echo $row_admin01['title']; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="<?php echo $row_admin01['nsme']; ?>" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

			<header id="header">
				<h1><a href="<?php echo $row_admin01['url']; ?>"><?php echo $row_admin01['title']; ?></a></h1>
				<p><?php echo $row_admin01['title']; ?>管理中心</p>
			</header>

			<form id="adminc01" name="adminc01" method="POST" action="<?php echo $editFormAction; ?>">
			<input name="n" type="hidden" id="n" value="1" />
			<?php 
			  if($_GET['ok1']<>""){
			  echo "儲存完成";
			  }
			   ?><br><br>
				<input name="id" type="text" id="id" value="<?php echo $row_admin01['id']; ?>" placeholder="管理員帳號"/><br>
				<input name="pw" type="password" id="pw" value="<?php echo $row_admin01['pw']; ?>" placeholder="管理員密碼"/><br>
				<input name="title" type="text" id="title" value="<?php echo $row_admin01['title']; ?>" placeholder="網站標題"/><br>
				<input name="nsme" type="text" id="nsme" value="<?php echo $row_admin01['nsme']; ?>" placeholder="網站敘述"/><br>
				<input name="url" type="text" id="url" value="<?php echo $row_admin01['url']; ?>" placeholder="網站網址(最後要有 / 符號)"/><br>
				<input type="submit" name="Submit" value="儲存設定" />　<a href="<?php echo $logoutAction ?>" class="style3">登出</a>
				<input type="hidden" name="MM_update" value="adminc01">
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