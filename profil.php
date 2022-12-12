<?php require_once('Connections/frisby.php'); ?>
<?php include 'functions.php'; ?> 
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

$MM_restrictGoTo = "giris.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE uyeler SET uy_adi=%s, uy_soyad=%s, sifre=%s WHERE nick=%s",
                       GetSQLValueString($_POST['adi'], "text"),
                       GetSQLValueString($_POST['soyisim'], "text"),
                       GetSQLValueString($_POST['sifre'], "text"),
                       GetSQLValueString($_POST['nick'], "text"));

  mysql_select_db($database_frisby, $frisby);
  $Result1 = mysql_query($updateSQL, $frisby) or die(mysql_error());

  $updateGoTo = "profil.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_profil = "-1";
if (isset($_SESSION['nick'])) {
  $colname_profil = $_SESSION['nick'];
}
mysql_select_db($database_frisby, $frisby);
$query_profil = sprintf("SELECT * FROM uyeler WHERE nick = %s", GetSQLValueString($colname_profil, "text"));
$profil = mysql_query($query_profil, $frisby) or die(mysql_error());
$row_profil = mysql_fetch_assoc($profil);
$totalRows_profil = mysql_num_rows($profil);


$k_adi= $_SESSION["MM_Username"];


?>
<?php
$uid = $_SESSION['MM_Username']; // Session daki kullanıcı adı
$sorgu = mysql_query("select * from uyeler where nick='$uid'");
$veri= mysql_fetch_array($sorgu);
$soyad = $veri["uy_soyad"]; 
$password = $veri["sifre"];
$adi = $veri["uy_adi"];
?>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Üye Profil Sayfası</title>
<link href="sitil/style.css" rel="stylesheet" type="text/css" />
</head>
<?php include 'header.php'; ?>
<div id="beforebaslik">Profil Sayfası</div>
<div id="beforegame">
	<div id="oyun-bilgileri">
    	<div id="uyebilgileri">
        	<h2><?php echo "//Hoşgeldin; ".$k_adi; ?></h2>
          <form name="form" action="<?php echo $editFormAction; ?>" method="POST">
            <input name="adi" type="text" value="<?php echo $adi; ?>"  />
            <input name="soyisim" type="text" value="<?php echo $soyad; ?>" />
            <input name="sifre" type="password" value="<?php echo $password; ?>"  />
            <input name="" type="submit" value="Güncelle" /><input name="nick" type="hidden" value="<?php echo $_SESSION['MM_Username']; ?>" />
            <input type="hidden" name="MM_update" value="form" />
          </form>
        </div>
	</div>
    <div id="reklam2"><img src="resimler/leaderboard.gif" width="728" height="90" /></div>
</div>
<div id="home-reklam"><img src="resimler/reklam-ornek.png" width="160" height="600" /></div>
</div>
<?php include 'footer.php'; ?>
<?php
mysql_free_result($profil);
?>
