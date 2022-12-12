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

if ((isset($_GET['oy_id'])) && ($_GET['oy_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM oyunlar WHERE oy_id=%s",
                       GetSQLValueString($_GET['oy_id'], "int"));

  mysql_select_db($database_frisby, $frisby);
  $Result1 = mysql_query($deleteSQL, $frisby) or die(mysql_error());

  $deleteGoTo = "oyunlar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

if ((isset($_GET['kat_id'])) && ($_GET['kat_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM kategoriler WHERE kat_id=%s",
                       GetSQLValueString($_GET['kat_id'], "int"));

  mysql_select_db($database_frisby, $frisby);
  $Result1 = mysql_query($deleteSQL, $frisby) or die(mysql_error());

  $deleteGoTo = "kategoriler.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

if ((isset($_GET['uy_id'])) && ($_GET['uy_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM uyeler WHERE uy_id=%s",
                       GetSQLValueString($_GET['uy_id'], "int"));

  mysql_select_db($database_frisby, $frisby);
  $Result1 = mysql_query($deleteSQL, $frisby) or die(mysql_error());

  $deleteGoTo = "uyeler.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

if ((isset($_GET['yorum_id'])) && ($_GET['yorum_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM yorumlar WHERE y_id=%s",
                       GetSQLValueString($_GET['yorum_id'], "int"));

  mysql_select_db($database_frisby, $frisby);
  $Result1 = mysql_query($deleteSQL, $frisby) or die(mysql_error());

  $deleteGoTo = "yorumlar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
