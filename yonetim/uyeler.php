<?php require_once('../Connections/frisby.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_uyeler = 25;
$pageNum_uyeler = 0;
if (isset($_GET['pageNum_uyeler'])) {
  $pageNum_uyeler = $_GET['pageNum_uyeler'];
}
$startRow_uyeler = $pageNum_uyeler * $maxRows_uyeler;

mysql_select_db($database_frisby, $frisby);
$query_uyeler = "SELECT * FROM uyeler ORDER BY uy_id DESC";
$query_limit_uyeler = sprintf("%s LIMIT %d, %d", $query_uyeler, $startRow_uyeler, $maxRows_uyeler);
$uyeler = mysql_query($query_limit_uyeler, $frisby) or die(mysql_error());
$row_uyeler = mysql_fetch_assoc($uyeler);

if (isset($_GET['totalRows_uyeler'])) {
  $totalRows_uyeler = $_GET['totalRows_uyeler'];
} else {
  $all_uyeler = mysql_query($query_uyeler);
  $totalRows_uyeler = mysql_num_rows($all_uyeler);
}
$totalPages_uyeler = ceil($totalRows_uyeler/$maxRows_uyeler)-1;

$queryString_uyeler = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_uyeler") == false && 
        stristr($param, "totalRows_uyeler") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_uyeler = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_uyeler = sprintf("&totalRows_uyeler=%d%s", $totalRows_uyeler, $queryString_uyeler);
?>
<?php include 'header.php'; ?>
<body>

<?php include 'sidebar.php'; ?>

<div id="icerik">
<h2>//Üye <span>Listesi</span></h2>
<table width="850" border="0">

  <tr>
    <td height="38"><strong>Üye ID</strong></td>
    <td><strong>Üye Adı - Soyadı</strong></td>
    <td><strong>Üye Nicki</strong></td>
    <td><strong>Üye Mail</strong></td>
    <td><strong>Sil</strong></td>
  </tr>
  <?php do { ?>
  <tr>
    <td width="180" height="41"><?php echo $row_uyeler['uy_id']; ?></td>
    <td width="467"><?php echo $row_uyeler['uy_adi']; ?> <?php echo $row_uyeler['uy_soyad']; ?></td>
    <td width="100"><a href="#"><?php echo $row_uyeler['nick']; ?></a></td>
    <td width="100"><a href="#"><?php echo $row_uyeler['uy_mail']; ?></a></td>
    <td width="85"><a href="sil.php?uy_id=<?php echo $row_uyeler['uy_id']; ?>">Sil</a></td>
  </tr>
  <?php } while ($row_uyeler = mysql_fetch_assoc($uyeler)); ?>
</table>
<table border="0">
  <tr>
    <td><?php if ($pageNum_uyeler > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_uyeler=%d%s", $currentPage, 0, $queryString_uyeler); ?>"><img src="First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_uyeler > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_uyeler=%d%s", $currentPage, max(0, $pageNum_uyeler - 1), $queryString_uyeler); ?>"><img src="Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_uyeler < $totalPages_uyeler) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_uyeler=%d%s", $currentPage, min($totalPages_uyeler, $pageNum_uyeler + 1), $queryString_uyeler); ?>"><img src="Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_uyeler < $totalPages_uyeler) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_uyeler=%d%s", $currentPage, $totalPages_uyeler, $queryString_uyeler); ?>"><img src="Last.gif" /></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</div>

</body>
</html>
<?php
mysql_free_result($uyeler);
?>
