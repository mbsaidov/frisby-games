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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "profil")) {
  $updateSQL = sprintf("UPDATE `admin` SET k_adi=%s, sifre=%s WHERE id=%s",
                       GetSQLValueString($_POST['kadi'], "text"),
                       GetSQLValueString($_POST['sifre'], "text"),
                       GetSQLValueString($_POST['kadid'], "int"));

  mysql_select_db($database_frisby, $frisby);
  $Result1 = mysql_query($updateSQL, $frisby) or die(mysql_error());

  $updateGoTo = "cikis.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_frisby, $frisby);
$query_admin = "SELECT * FROM `admin`";
$admin = mysql_query($query_admin, $frisby) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin);
$totalRows_admin = mysql_num_rows($admin);
?>
<?php include 'header.php'; ?>

<body>
<?php include 'sidebar.php'; ?>

<div id="icerik">
<h2>//K.Adı, Şifre <span>Değiştirme</span></h2>
<form name="profil" action="<?php echo $editFormAction; ?>" method="POST">
<input name="kadi" type="text" id="isim" value="<?php echo $row_admin['k_adi']; ?>" placeholder="Kullanıcı Adı" />
<input name="sifre" type="text" id="isim" value="<?php echo $row_admin['sifre']; ?>" placeholder="Şifre" />
<input type="hidden" name="kadid" value="1" />
<input name="ekle" type="submit" id="ekle" value="Güncelle" />
<input type="hidden" name="MM_update" value="profil" />
</form>
</div>

</body>
</html>
<?php
mysql_free_result($admin);
?>
