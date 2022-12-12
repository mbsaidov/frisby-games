<?php require_once('../Connections/frisby.php'); ?>
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

$maxRows_oyunlistesi = 20;
$pageNum_oyunlistesi = 0;
if (isset($_GET['pageNum_oyunlistesi'])) {
  $pageNum_oyunlistesi = $_GET['pageNum_oyunlistesi'];
}
$startRow_oyunlistesi = $pageNum_oyunlistesi * $maxRows_oyunlistesi;

mysql_select_db($database_frisby, $frisby);
$query_oyunlistesi = "SELECT * FROM oyunlar ORDER BY oy_id DESC";
$query_limit_oyunlistesi = sprintf("%s LIMIT %d, %d", $query_oyunlistesi, $startRow_oyunlistesi, $maxRows_oyunlistesi);
$oyunlistesi = mysql_query($query_limit_oyunlistesi, $frisby) or die(mysql_error());
$row_oyunlistesi = mysql_fetch_assoc($oyunlistesi);

if (isset($_GET['totalRows_oyunlistesi'])) {
  $totalRows_oyunlistesi = $_GET['totalRows_oyunlistesi'];
} else {
  $all_oyunlistesi = mysql_query($query_oyunlistesi);
  $totalRows_oyunlistesi = mysql_num_rows($all_oyunlistesi);
}
$totalPages_oyunlistesi = ceil($totalRows_oyunlistesi/$maxRows_oyunlistesi)-1;

$queryString_oyunlistesi = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_oyunlistesi") == false && 
        stristr($param, "totalRows_oyunlistesi") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_oyunlistesi = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_oyunlistesi = sprintf("&totalRows_oyunlistesi=%d%s", $totalRows_oyunlistesi, $queryString_oyunlistesi);
?>
<?php include 'header.php'; ?>

<body>
<?php include 'sidebar.php'; ?>

<div id="icerik">
<h2>//Oyun <span>Listesi</span></h2>
<table width="850" border="0">

  <tr>
    <td height="38"><strong>Resim</strong></td>
    <td><strong>Oyun İsmi</strong></td>
    <td><strong>Düzenle</strong></td>
    <td><strong>Sil</strong></td>
  </tr>
  <?php do { ?>

    <tr>
    
      <td width="85"><img src="<?php echo $row_oyunlistesi['oy_img']; ?>" height="80" /></td>
      <td width="495"><h3>&nbsp;&nbsp;<?php echo $row_oyunlistesi['oy_adi']; ?></h3></td>
      <td width="94"><a href="oyunduzenle.php?oy_id=<?php echo $row_oyunlistesi['oy_id']; ?>">Düzenle</a></td>
      <td width="79"><a href="sil.php?oy_id=<?php echo $row_oyunlistesi['oy_id']; ?>">Sil</a></td>
      
  </tr><?php } while ($row_oyunlistesi = mysql_fetch_assoc($oyunlistesi)); ?>
    <tr>
      <td height="25">&nbsp;</td>
      <td height="25">&nbsp;
        <table border="0">
          <tr>
            <td><?php if ($pageNum_oyunlistesi > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_oyunlistesi=%d%s", $currentPage, 0, $queryString_oyunlistesi); ?>"><img src="First.gif" /></a>
                <?php } // Show if not first page ?></td>
            <td><?php if ($pageNum_oyunlistesi > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_oyunlistesi=%d%s", $currentPage, max(0, $pageNum_oyunlistesi - 1), $queryString_oyunlistesi); ?>"><img src="Previous.gif" /></a>
                <?php } // Show if not first page ?></td>
            <td><?php if ($pageNum_oyunlistesi < $totalPages_oyunlistesi) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_oyunlistesi=%d%s", $currentPage, min($totalPages_oyunlistesi, $pageNum_oyunlistesi + 1), $queryString_oyunlistesi); ?>"><img src="Next.gif" /></a>
                <?php } // Show if not last page ?></td>
            <td><?php if ($pageNum_oyunlistesi < $totalPages_oyunlistesi) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_oyunlistesi=%d%s", $currentPage, $totalPages_oyunlistesi, $queryString_oyunlistesi); ?>"><img src="Last.gif" /></a>
                <?php } // Show if not last page ?></td>
          </tr>
      </table></td>
      <td height="25">&nbsp;</td>
      <td height="25">&nbsp;</td>
    </tr>
  </table>


</div>

</body>
</html>
<?php
mysql_free_result($oyunlistesi);
?>
