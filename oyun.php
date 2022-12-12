<?php require_once('Connections/frisby.php'); ?>
<?php include 'functions.php'; ?> 
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

mysql_select_db($database_frisby, $frisby);
$query_reklam = "SELECT * FROM reklamlar";
$reklam = mysql_query($query_reklam, $frisby) or die(mysql_error());
$row_reklam = mysql_fetch_assoc($reklam);
$totalRows_reklam = mysql_num_rows($reklam);

mysql_select_db($database_frisby, $frisby);
$query_siteadi = "SELECT siteadi FROM ayarlar";
$siteadi = mysql_query($query_siteadi, $frisby) or die(mysql_error());
$row_siteadi = mysql_fetch_assoc($siteadi);
$totalRows_siteadi = mysql_num_rows($siteadi);

$colname_oyunsayfa = "-1";
if (isset($_GET['oy_id'])) {
  $colname_oyunsayfa = $_GET['oy_id'];
}
mysql_select_db($database_frisby, $frisby);
$query_oyunsayfa = sprintf("SELECT * FROM oyunlar WHERE oy_id = %s", GetSQLValueString($colname_oyunsayfa, "int"));
$oyunsayfa = mysql_query($query_oyunsayfa, $frisby) or die(mysql_error());
$row_oyunsayfa = mysql_fetch_assoc($oyunsayfa);
$totalRows_oyunsayfa = mysql_num_rows($oyunsayfa); ?>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row_oyunsayfa['oy_adi']; ?> » <?php echo $row_siteadi['siteadi']; ?></title>
<link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/sitil/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#yanduzenle {  height: 20px!important;}
</style>
<?php include 'header.php'; ?>
  <div id="beforebaslik">Oyun > <?php echo $row_oyunsayfa['oy_adi']; ?></div>
  <div id="beforegame">
    <div id="oyun-bilgileri">
      <div id="oyunafis"> <a href="oyna/<?php echo seo($row_oyunsayfa['oy_adi']); ?>/<?php echo $row_oyunsayfa['oy_id']; ?>/<?php echo $row_oyunsayfa['oy_kat']; ?>/"> <img src="<?php echo $row_oyunsayfa['oy_img']; ?>" alt="<?php echo $row_oyunsayfa['oy_adi']; ?>" height="170" /> <img src="resimler/basla.png" /></a> </div>
      <div id="oyundesc"> <span>»<?php echo $row_oyunsayfa['oy_adi']; ?></span>
        <p><?php echo $row_oyunsayfa['oy_desc']; ?></p>
      </div>
    </div>
    <div id="reklam2"><?php echo $row_reklam['yatay']; ?></div>
  </div>
  <div id="home-reklam"><?php echo $row_reklam['dikey']; ?></div>
</div>
<?php include 'footer.php'; 
mysql_free_result($reklam);

mysql_free_result($oyunsayfa);
?>
<?php
mysql_free_result($siteadi);
?>
