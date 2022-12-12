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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE oyunlar SET oy_img=%s, oy_swf=%s, oy_desc=%s, oy_adi=%s WHERE oy_id=%s",
                       GetSQLValueString($_POST['oy_img'], "text"),
                       GetSQLValueString($_POST['oy_swf'], "text"),
                       GetSQLValueString($_POST['oy_desc'], "text"),
                       GetSQLValueString($_POST['oy_adi'], "text"),
                       GetSQLValueString($_POST['hiddenField'], "int"));

  mysql_select_db($database_frisby, $frisby);
  $Result1 = mysql_query($updateSQL, $frisby) or die(mysql_error());

  $updateGoTo = "oyunlar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE oyunlar SET oy_img=%s, oy_swf=%s, oy_kat=%s, oy_desc=%s, oy_adi=%s WHERE oy_id=%s",
                       GetSQLValueString($_POST['oy_img'], "text"),
                       GetSQLValueString($_POST['oy_swf'], "text"),
                       GetSQLValueString($_POST['oy_kat'], "text"),
                       GetSQLValueString($_POST['oy_desc'], "text"),
                       GetSQLValueString($_POST['oy_adi'], "text"),
                       GetSQLValueString($_POST['oy_id'], "int"));

  mysql_select_db($database_frisby, $frisby);
  $Result1 = mysql_query($updateSQL, $frisby) or die(mysql_error());

  $updateGoTo = "oyunlar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_oyunduzenle = "-1";
if (isset($_GET['oy_id'])) {
  $colname_oyunduzenle = $_GET['oy_id'];
}
mysql_select_db($database_frisby, $frisby);
$query_oyunduzenle = sprintf("SELECT * FROM oyunlar WHERE oy_id = %s", GetSQLValueString($colname_oyunduzenle, "int"));
$oyunduzenle = mysql_query($query_oyunduzenle, $frisby) or die(mysql_error());
$row_oyunduzenle = mysql_fetch_assoc($oyunduzenle);
$totalRows_oyunduzenle = mysql_num_rows($oyunduzenle);
?>
<?php include 'header.php'; ?>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include 'sidebar.php'; ?>

<div id="icerik">
<h2>//Oyun <span>Düzenle</span></h2>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <input placeholder="Oyun Adı" id="isim" name="oy_adi" type="text"  value="<?php echo htmlentities($row_oyunduzenle['oy_adi'], ENT_COMPAT, 'utf-8'); ?>"  />
  <textarea placeholder="Oyun Açıklaması" name="oy_desc" cols="" rows=""><?php echo $row_oyunduzenle['oy_desc']; ?></textarea>
<input  id="img" name="oy_img" type="text"  value="<?php echo htmlentities($row_oyunduzenle['oy_img'], ENT_COMPAT, 'utf-8'); ?>"  />
<input placeholder="Oyun SWF Linki" id="swf" name="oy_swf" type="text"  value="<?php echo htmlentities($row_oyunduzenle['oy_swf'], ENT_COMPAT, 'utf-8'); ?>"  />
<input type="submit"  id="ekle" value="Gönder" />
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="oy_id" value="<?php echo $row_oyunduzenle['oy_id']; ?>" value="<?php echo htmlentities($row_oyunduzenle['oy_desc'], ENT_COMPAT, 'utf-8'); ?>"   />
</form>
<p>&nbsp;</p>
</div>

</body>
</html>
<?php
mysql_free_result($oyunduzenle);
?>
