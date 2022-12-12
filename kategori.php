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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_kategorioyun = 30;
$pageNum_kategorioyun = 0;
if (isset($_GET['pageNum_kategorioyun'])) {
  $pageNum_kategorioyun = $_GET['pageNum_kategorioyun'];
}
$startRow_kategorioyun = $pageNum_kategorioyun * $maxRows_kategorioyun;

$colname_kategorioyun = "-1";
if (isset($_GET['kat'])) {
  $colname_kategorioyun = $_GET['kat'];
}
mysql_select_db($database_frisby, $frisby);
$query_kategorioyun = sprintf("SELECT * FROM oyunlar WHERE oy_kat = %s ORDER BY oy_id DESC", GetSQLValueString($colname_kategorioyun, "text"));
$query_limit_kategorioyun = sprintf("%s LIMIT %d, %d", $query_kategorioyun, $startRow_kategorioyun, $maxRows_kategorioyun);
$kategorioyun = mysql_query($query_limit_kategorioyun, $frisby) or die(mysql_error());
$row_kategorioyun = mysql_fetch_assoc($kategorioyun);

if (isset($_GET['totalRows_kategorioyun'])) {
  $totalRows_kategorioyun = $_GET['totalRows_kategorioyun'];
} else {
  $all_kategorioyun = mysql_query($query_kategorioyun);
  $totalRows_kategorioyun = mysql_num_rows($all_kategorioyun);
}
$totalPages_kategorioyun = ceil($totalRows_kategorioyun/$maxRows_kategorioyun)-1;

mysql_select_db($database_frisby, $frisby);
$query_siteadi = "SELECT siteadi FROM ayarlar";
$siteadi = mysql_query($query_siteadi, $frisby) or die(mysql_error());
$row_siteadi = mysql_fetch_assoc($siteadi);
$totalRows_siteadi = mysql_num_rows($siteadi);

$queryString_kategorioyun = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_kategorioyun") == false && 
        stristr($param, "totalRows_kategorioyun") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_kategorioyun = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_kategorioyun = sprintf("&totalRows_kategorioyun=%d%s", $totalRows_kategorioyun, $queryString_kategorioyun);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row["kat_adi"]; ?> » <?php echo $row_siteadi['siteadi']; ?></title>
<link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/sitil/style.css" rel="stylesheet" type="text/css" />
<meta name="description" content="<?php echo $row["kat_desc"]; ?>">
<?php include 'header.php'; ?>

	<div id="oyunlistesi">
    	<div id="baslik"><?php $kategoriID = $row_kategorioyun['oy_kat']; $query = mysql_query("SELECT * FROM kategoriler INNER JOIN oyunlar ON oyunlar.oy_id = kategoriler.kat_id WHERE kat_id = '$kategoriID'"); if($row = mysql_fetch_array($query))	{ ?><?php echo $row["kat_adi"]; } else echo 'Henüz oyun yok :(';    ?> </div>
    	    <?php do { ?><div class="oitem"><a href="oyun.php?oy_id=<?php echo $row_kategorioyun['oy_id']; ?>"><img src="<?php echo $row_kategorioyun['oy_img']; ?>" width="138" height="98" /><?php echo $row_kategorioyun['oy_adi']; ?></a></div>
    	    <?php } while ($row_kategorioyun = mysql_fetch_assoc($kategorioyun)); ?>
            <table border="0">
              <tr>
                <td><?php if ($pageNum_kategorioyun > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_kategorioyun=%d%s", $currentPage, 0, $queryString_kategorioyun); ?>"><img src="First.gif" /></a>
                    <?php } // Show if not first page ?></td>
                <td><?php if ($pageNum_kategorioyun > 0) { // Show if not first page ?>
                    <a href="<?php printf("%s?pageNum_kategorioyun=%d%s", $currentPage, max(0, $pageNum_kategorioyun - 1), $queryString_kategorioyun); ?>"><img src="Previous.gif" /></a>
                    <?php } // Show if not first page ?></td>
                <td><?php if ($pageNum_kategorioyun < $totalPages_kategorioyun) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_kategorioyun=%d%s", $currentPage, min($totalPages_kategorioyun, $pageNum_kategorioyun + 1), $queryString_kategorioyun); ?>"><img src="Next.gif" /></a>
                    <?php } // Show if not last page ?></td>
                <td><?php if ($pageNum_kategorioyun < $totalPages_kategorioyun) { // Show if not last page ?>
                    <a href="<?php printf("%s?pageNum_kategorioyun=%d%s", $currentPage, $totalPages_kategorioyun, $queryString_kategorioyun); ?>"><img src="Last.gif" /></a>
                    <?php } // Show if not last page ?></td>
              </tr>
            </table>
    </div>
    <div id="home-reklam"><img src="resimler/reklam-ornek.png" width="160" height="600" /></div>
</div>
<?php include 'footer.php'; ?>
<?php
mysql_free_result($kategorioyun);

mysql_free_result($siteadi);
?>
