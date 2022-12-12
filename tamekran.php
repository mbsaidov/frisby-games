<head><META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"></head>
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

$colname_tamekran = "-1";
if (isset($_GET['id'])) {
  $colname_tamekran = $_GET['id'];
}
mysql_select_db($database_frisby, $frisby);
$query_tamekran = sprintf("SELECT * FROM oyunlar WHERE oy_id = %s", GetSQLValueString($colname_tamekran, "int"));
$tamekran = mysql_query($query_tamekran, $frisby) or die(mysql_error());
$row_tamekran = mysql_fetch_assoc($tamekran);
$totalRows_tamekran = mysql_num_rows($tamekran);

mysql_free_result($tamekran);
?>

<embed src="<?php echo $row_tamekran['oy_swf']; ?>" width="100%" height="100%"> </embed>
