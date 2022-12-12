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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "reklam")) {
  $updateSQL = sprintf("UPDATE reklamlar SET oyunoncesi=%s, dikey=%s, yatay=%s WHERE id=%s",
                       GetSQLValueString($_POST['oyunoncesi'], "text"),
                       GetSQLValueString($_POST['dikey'], "text"),
                       GetSQLValueString($_POST['yatay'], "text"),
                       GetSQLValueString($_POST['id'], "text"));

  mysql_select_db($database_frisby, $frisby);
  $Result1 = mysql_query($updateSQL, $frisby) or die(mysql_error());

  $updateGoTo = "#";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_frisby, $frisby);
$query_reklam = "SELECT * FROM reklamlar";
$reklam = mysql_query($query_reklam, $frisby) or die(mysql_error());
$row_reklam = mysql_fetch_assoc($reklam);
$totalRows_reklam = mysql_num_rows($reklam);
?>
<?php include 'header.php'; ?>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include 'sidebar.php'; ?>

<div id="icerik">
<h2>//Reklam <span>Kodları</span></h2>
<form action="<?php echo $editFormAction; ?>" method="POST" name="reklam" id="form1">
	<h4>Oyun Öncesi Reklam (250x250)</h4>
 	<textarea name="oyunoncesi" cols="" rows=""><?php echo $row_reklam['oyunoncesi']; ?></textarea>
    <h4>Yatay Reklam (728x90)</h4>
	<textarea name="yatay" cols="" rows=""><?php echo $row_reklam['yatay']; ?></textarea>
    <h4>Dikey Reklam (160x600)</h4>
	<textarea name="dikey" cols="" rows=""><?php echo $row_reklam['dikey']; ?></textarea>
	<input name="id" type="hidden" value="1" />
<input type="submit"  id="ekle" value="Gönder" />
<input type="hidden" name="MM_update" value="reklam" />
</form>
<p>&nbsp;</p>
</div>

</body>
</html>
<?php
mysql_free_result($reklam);
?>
