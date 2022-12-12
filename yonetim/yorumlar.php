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

$maxRows_yorumlar = 20;
$pageNum_yorumlar = 0;
if (isset($_GET['pageNum_yorumlar'])) {
  $pageNum_yorumlar = $_GET['pageNum_yorumlar'];
}
$startRow_yorumlar = $pageNum_yorumlar * $maxRows_yorumlar;

mysql_select_db($database_frisby, $frisby);
$query_yorumlar = "SELECT * FROM yorumlar ORDER BY y_id DESC";
$query_limit_yorumlar = sprintf("%s LIMIT %d, %d", $query_yorumlar, $startRow_yorumlar, $maxRows_yorumlar);
$yorumlar = mysql_query($query_limit_yorumlar, $frisby) or die(mysql_error());
$row_yorumlar = mysql_fetch_assoc($yorumlar);

if (isset($_GET['totalRows_yorumlar'])) {
  $totalRows_yorumlar = $_GET['totalRows_yorumlar'];
} else {
  $all_yorumlar = mysql_query($query_yorumlar);
  $totalRows_yorumlar = mysql_num_rows($all_yorumlar);
}
$totalPages_yorumlar = ceil($totalRows_yorumlar/$maxRows_yorumlar)-1;

$queryString_yorumlar = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_yorumlar") == false && 
        stristr($param, "totalRows_yorumlar") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_yorumlar = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_yorumlar = sprintf("&totalRows_yorumlar=%d%s", $totalRows_yorumlar, $queryString_yorumlar);
?>
<?php include 'header.php'; ?>
<body>

<?php include 'sidebar.php'; ?>

<div id="icerik">
<h2>//Yorum <span>Listesi</span></h2>
<table width="850" border="0">

  <tr>
    <td height="38"><strong>Yorum ID</strong></td>
    <td><strong>Yorum </strong></td>
    <td><strong>Sil</strong></td>
  </tr>
  <?php do { ?>
  <tr>
    <td width="135" height="41"><?php echo $row_yorumlar['y_id']; ?></td>
    <td width="601"><?php echo $row_yorumlar['yorum']; ?></td>
    <td width="100"><a href="sil.php?yorum_id=<?php echo $row_yorumlar['y_id']; ?>">Sil</a></td>
  </tr>
  <?php } while ($row_yorumlar = mysql_fetch_assoc($yorumlar)); ?>
  <table border="0">
    <tr>
      <td><?php if ($pageNum_yorumlar > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_yorumlar=%d%s", $currentPage, 0, $queryString_yorumlar); ?>"><img src="First.gif" /></a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_yorumlar > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_yorumlar=%d%s", $currentPage, max(0, $pageNum_yorumlar - 1), $queryString_yorumlar); ?>"><img src="Previous.gif" /></a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_yorumlar < $totalPages_yorumlar) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_yorumlar=%d%s", $currentPage, min($totalPages_yorumlar, $pageNum_yorumlar + 1), $queryString_yorumlar); ?>"><img src="Next.gif" /></a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_yorumlar < $totalPages_yorumlar) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_yorumlar=%d%s", $currentPage, $totalPages_yorumlar, $queryString_yorumlar); ?>"><img src="Last.gif" /></a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
</table>
</div>

</body>
</html>
<?php
mysql_free_result($yorumlar);
?>
