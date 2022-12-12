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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO oyunlar (oy_img, oy_swf, oy_kat, oy_desc, oy_adi) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['oy_img'], "text"),
                       GetSQLValueString($_POST['oy_swf'], "text"),
                       GetSQLValueString($_POST['kat'], "text"),
                       GetSQLValueString($_POST['oy_desc'], "text"),
                       GetSQLValueString($_POST['oy_adi'], "text"));

  mysql_select_db($database_frisby, $frisby);
  $Result1 = mysql_query($insertSQL, $frisby) or die(mysql_error());

  $insertGoTo = "oyunlar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_frisby, $frisby);
$query_oyunekle = "SELECT * FROM oyunlar";
$oyunekle = mysql_query($query_oyunekle, $frisby) or die(mysql_error());
$row_oyunekle = mysql_fetch_assoc($oyunekle);
$totalRows_oyunekle = mysql_num_rows($oyunekle);

mysql_select_db($database_frisby, $frisby);
$query_kategorioe = "SELECT * FROM kategoriler";
$kategorioe = mysql_query($query_kategorioe, $frisby) or die(mysql_error());
$row_kategorioe = mysql_fetch_assoc($kategorioe);
$totalRows_kategorioe = mysql_num_rows($kategorioe);
?>
<?php include 'header.php'; ?>

<body>
<?php include 'sidebar.php'; ?>

<div id="icerik">
<h2>//Oyun <span>Ekle</span></h2>
<form name="form" action="<?php echo $editFormAction; ?>" method="POST">
<input placeholder="Oyun Adı" id="isim" name="oy_adi" type="text" />
<textarea placeholder="Oyun Açıklaması" name="oy_desc" cols="" rows=""></textarea>
<input  id="img" name="oy_img" type="text" />
<input placeholder="Oyun SWF Linki" id="swf" name="oy_swf" type="text" />

  <select name="kat"><?php do { ?><option value="<?php echo $row_kategorioe['kat_id']; ?>"><?php echo $row_kategorioe['kat_adi']; ?></option><?php } while ($row_kategorioe = mysql_fetch_assoc($kategorioe)); ?></select>
  
<input name="ekle" type="submit" id="ekle" value="Ekle" />
<input name="hiddenField" type="hidden" id="hiddenField" value="<?php echo $row_oyunekle['oy_id']; ?>" />
<input type="hidden" name="MM_insert" value="form" />
</form>
</div>

</body>
</html>
<?php
mysql_free_result($oyunekle);

mysql_free_result($kategorioe);
?>
