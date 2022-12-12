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
  $insertSQL = sprintf("INSERT INTO kategoriler (kat_adi, kat_desc) VALUES (%s, %s)",
                       GetSQLValueString($_POST['kat_adi'], "text"),
                       GetSQLValueString($_POST['kat_desc'], "text"));

  mysql_select_db($database_frisby, $frisby);
  $Result1 = mysql_query($insertSQL, $frisby) or die(mysql_error());

  $insertGoTo = "kategoriler.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<?php include 'header.php'; ?>

<body>
<?php include 'sidebar.php'; ?>

<div id="icerik">
<h2>//Kategori <span>Ekle</span></h2>
<form name="form" action="<?php echo $editFormAction; ?>" method="POST">
<input placeholder="Kategori Adı" id="isim" name="kat_adi" type="text" />
<textarea placeholder="Kategpri Açıklaması (SEO İçin Önemli)" name="kat_desc" cols="" rows=""></textarea>
<input name="ekle" type="submit" id="ekle" value="Ekle" />
<input type="hidden" name="MM_insert" value="form" />
</form>
</div>

</body>
</html>