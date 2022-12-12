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

$maxRows_oyunlar = 25;
$pageNum_oyunlar = 0;
if (isset($_GET['pageNum_oyunlar'])) {
  $pageNum_oyunlar = $_GET['pageNum_oyunlar'];
}
$startRow_oyunlar = $pageNum_oyunlar * $maxRows_oyunlar;

mysql_select_db($database_frisby, $frisby);
$query_oyunlar = "SELECT * FROM oyunlar ORDER BY oy_id DESC";
$query_limit_oyunlar = sprintf("%s LIMIT %d, %d", $query_oyunlar, $startRow_oyunlar, $maxRows_oyunlar);
$oyunlar = mysql_query($query_limit_oyunlar, $frisby) or die(mysql_error());
$row_oyunlar = mysql_fetch_assoc($oyunlar);

if (isset($_GET['totalRows_oyunlar'])) {
  $totalRows_oyunlar = $_GET['totalRows_oyunlar'];
} else {
  $all_oyunlar = mysql_query($query_oyunlar);
  $totalRows_oyunlar = mysql_num_rows($all_oyunlar);
}
$totalPages_oyunlar = ceil($totalRows_oyunlar/$maxRows_oyunlar)-1;

$maxRows_populerhome = 20;
$pageNum_populerhome = 0;
if (isset($_GET['pageNum_populerhome'])) {
  $pageNum_populerhome = $_GET['pageNum_populerhome'];
}
$startRow_populerhome = $pageNum_populerhome * $maxRows_populerhome;

mysql_select_db($database_frisby, $frisby);
$query_populerhome = "SELECT * FROM oyunlar ORDER BY hit DESC";
$query_limit_populerhome = sprintf("%s LIMIT %d, %d", $query_populerhome, $startRow_populerhome, $maxRows_populerhome);
$populerhome = mysql_query($query_limit_populerhome, $frisby) or die(mysql_error());
$row_populerhome = mysql_fetch_assoc($populerhome);

if (isset($_GET['totalRows_populerhome'])) {
  $totalRows_populerhome = $_GET['totalRows_populerhome'];
} else {
  $all_populerhome = mysql_query($query_populerhome);
  $totalRows_populerhome = mysql_num_rows($all_populerhome);
}
$totalPages_populerhome = ceil($totalRows_populerhome/$maxRows_populerhome)-1;

mysql_select_db($database_frisby, $frisby);
$query_reklam = "SELECT * FROM reklamlar";
$reklam = mysql_query($query_reklam, $frisby) or die(mysql_error());
$row_reklam = mysql_fetch_assoc($reklam);
$totalRows_reklam = mysql_num_rows($reklam);

mysql_select_db($database_frisby, $frisby);
$query_baslik = "SELECT a_baslik, `desc` FROM ayarlar";
$baslik = mysql_query($query_baslik, $frisby) or die(mysql_error());
$row_baslik = mysql_fetch_assoc($baslik);
$totalRows_baslik = mysql_num_rows($baslik);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row_baslik['a_baslik']; ?></title>
<meta name="description" content="<?php echo $row_baslik['desc']; ?>">
<link href="sitil/style.css" rel="stylesheet" type="text/css" />
<?php include 'header.php'; ?>

	<div id="oyunlistesi">
    	<div id="baslik">EN SON EKLENENLER</div>
    	<?php do { ?>
    	  <div class="oitem"><a href="oyun/<?php echo seo($row_oyunlar['oy_adi']); ?>/<?php echo $row_oyunlar['oy_id']; ?>/"><img src="<?php echo $row_oyunlar['oy_img']; ?>" width="138" height="98" /><span><?php echo $row_oyunlar['oy_adi']; ?></span></a></div>
    	  <?php } while ($row_oyunlar = mysql_fetch_assoc($oyunlar)); ?>
          
    </div>
	<div id="oyunlistesi">
   	  <div id="baslik">EN ÇOK OYNANANLAR</div>
    	<?php do { ?>
    	  <div class="oitem"><a href="oyun/<?php echo seo($row_populerhome['oy_adi']); ?>/<?php echo $row_populerhome['oy_id']; ?>/"><img src="<?php echo $row_populerhome['oy_img']; ?>" width="138" height="98" /><span><?php echo $row_populerhome['oy_adi']; ?></span></a></div>
    	  <?php } while ($row_populerhome = mysql_fetch_assoc($populerhome)); ?>
    </div>
    
    <div id="home-reklam"><?php echo $row_reklam['dikey']; ?></div>
     <div style="clear:both;"></div>
</div>
<?php include 'footer.php'; ?> 
<?php
mysql_free_result($oyunlar);

mysql_free_result($populerhome);

mysql_free_result($reklam);

mysql_free_result($baslik);
?>
