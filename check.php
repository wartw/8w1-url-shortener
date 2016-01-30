<?php require_once('./config/sql.php'); ?>
<?php
mysql_select_db($database_link, $link);
$query_admin01 = "SELECT * FROM `admin`";
$admin01 = mysql_query($query_admin01, $link) or die(mysql_error());
$row_admin01 = mysql_fetch_assoc($admin01);
$totalRows_admin01 = mysql_num_rows($admin01);

if($_POST['ck']==$row_admin01['ck']){
///////////////////////////////////////////////////////////////////////////
function generatorPassword()
{
    $password_len = 6;
    $password = '';

    // remove o,0,1,l
    $word = 'qwertyuiopasdfghjklzxcvbnm123456789';
    $len = strlen($word);

    for ($i = 0; $i < $password_len; $i++) {
        $password .= $word[rand() % $len];
    }

    return $password;
}
$shortlinkid=generatorPassword();
///////////////////////////////////////////////////////////////////////////
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="index.php?no=no";
  $loginUsername = $shortlinkid;
  $LoginRS__query = "SELECT id FROM link WHERE id='" . $loginUsername . "'";
mysql_select_db($database_link, $link);
  $LoginRS=mysql_query($LoginRS__query, $link) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}
///////////////////////////////////////////////////////////////////////////

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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "shortlink01")) {
  $insertSQL = sprintf("INSERT INTO link (url, pw, id) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['url'], "text"),
                       GetSQLValueString($_POST['pw'], "text"),
                       GetSQLValueString($shortlinkid, "text"));


mysql_select_db($database_link, $link);
  $Result1 = mysql_query($insertSQL, $link) or die(mysql_error());

  $insertGoTo = "get.php?id=".$shortlinkid;
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
//////////////////////////////////////////////////////////////////
}
?><!DOCTYPE HTML>
<html>
	<head>
		<title>發生錯誤 - <?php echo $row_admin01['title']; ?></title>
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

			<form id="signup-form" method="post" action="#">
				<h2><?php 
		if($_POST['ck']<>$row_admin01['ck']){
		echo "驗證錯誤，請返回謝謝";
		}else{
		echo "發生錯誤，請稍後再試。";
		}
		?></h2>
		<input type ="button" onclick="history.back()" value="回到上一頁"></input>
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