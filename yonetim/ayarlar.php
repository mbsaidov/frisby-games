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
  $updateSQL = sprintf("UPDATE ayarlar SET siteadi=%s, a_baslik=%s, `desc`=%s, f_text=%s WHERE id=%s",
                       GetSQLValueString($_POST['siteadi'], "text"),
                       GetSQLValueString($_POST['baslik'], "text"),
                       GetSQLValueString($_POST['desc'], "text"),
                       GetSQLValueString($_POST['footer'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

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
$query_ayarlar = "SELECT * FROM ayarlar";
$ayarlar = mysql_query($query_ayarlar, $frisby) or die(mysql_error());
$row_ayarlar = mysql_fetch_assoc($ayarlar);
$totalRows_ayarlar = mysql_num_rows($ayarlar);
?>
<?php include 'header.php'; ?>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include 'sidebar.php'; ?>

<div id="icerik">
<h2>//Site <span>Ayarları</span></h2>
<form action="<?php echo $editFormAction; ?>" method="POST" name="reklam" id="form1">
	<h4>Site Adı</h4>
 	<input name="siteadi" type="text" value="<?php echo $row_ayarlar['siteadi']; ?>" />
    <h4>Anasayfa Başlık</h4>
	<input name="baslik" type="text" value="<?php echo $row_ayarlar['a_baslik']; ?>" />
    <h4>Anasayfa Açıklaması (Goolge'da görünecek, 160 karakterden az olmalı)</h4>
	<textarea name="desc" cols="" rows=""><?php echo $row_ayarlar['desc']; ?></textarea>
    <h4>Footer Yazısı</h4>
    <textarea name="footer" cols="" rows=""><?php echo $row_ayarlar['f_text']; ?></textarea>
	<input name="id" type="hidden" value="1" />
<input type="submit"  id="ekle" value="Güncelle" />
<input type="hidden" name="MM_update" value="reklam" />
</form>
<p>&nbsp;</p>
</div>

</body>
</html>
<?php
mysql_free_result($ayarlar);
?>
