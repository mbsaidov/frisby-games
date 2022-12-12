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

$maxRows_populer = 30;
$pageNum_populer = 0;
if (isset($_GET['pageNum_populer'])) {
  $pageNum_populer = $_GET['pageNum_populer'];
}
$startRow_populer = $pageNum_populer * $maxRows_populer;

mysql_select_db($database_frisby, $frisby);
$query_populer = "SELECT * FROM oyunlar ORDER BY hit DESC";
$query_limit_populer = sprintf("%s LIMIT %d, %d", $query_populer, $startRow_populer, $maxRows_populer);
$populer = mysql_query($query_limit_populer, $frisby) or die(mysql_error());
$row_populer = mysql_fetch_assoc($populer);

if (isset($_GET['totalRows_populer'])) {
  $totalRows_populer = $_GET['totalRows_populer'];
} else {
  $all_populer = mysql_query($query_populer);
  $totalRows_populer = mysql_num_rows($all_populer);
}
$totalPages_populer = ceil($totalRows_populer/$maxRows_populer)-1;

mysql_select_db($database_frisby, $frisby);
$query_siteadi = "SELECT siteadi FROM ayarlar";
$siteadi = mysql_query($query_siteadi, $frisby) or die(mysql_error());
$row_siteadi = mysql_fetch_assoc($siteadi);
$totalRows_siteadi = mysql_num_rows($siteadi);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>En Çok Oynanan Oyunlar » <?php echo $row_siteadi['siteadi']; ?></title>
<link href="sitil/style.css" rel="stylesheet" type="text/css" />
</head>

<?php include 'header.php'; ?>
	<div id="oyunlistesi">
    	<div id="baslik">EN POPÜLER OYUNLAR </div>
    	    <?php do { ?>
    	      <div class="oitem"><a href="oyun.php?oy_id=<?php echo $row_populer['oy_id']; ?>"><img src="<?php echo $row_populer['oy_img']; ?>" width="138" height="98" /><?php echo $row_populer['oy_adi']; ?></a></div>
    	      <?php } while ($row_populer = mysql_fetch_assoc($populer)); ?>
    </div>
    <div id="home-reklam"><img src="resimler/reklam-ornek.png" width="160" height="600" /></div>
</div>
<?php include 'footer.php'; ?>
<?php
mysql_free_result($populer);

mysql_free_result($siteadi);
?>
