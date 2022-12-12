<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();
?>
<?php require_once('Connections/frisby.php'); ?>
<?php include 'functions.php'; ?> 
<?php
if ( isset($_POST['guvenlikKodu']) && $_POST['guvenlikKodu'] ){
 $guvenlikKontrol = false;
 if ( $_POST['guvenlikKodu'] == $_SESSION['guvenlikKodu'] ){
 $guvenlikKontrol = true;
 }
 
 if ( $guvenlikKontrol ){
 echo '.';
 } else {
 echo '<meta http-equiv="refresh" content="0;URL=uyeol.php">';
 exit; 
 }
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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="&basarisiz";
  $loginUsername = $_POST['nick'];
  $LoginRS__query = sprintf("SELECT nick FROM uyeler WHERE nick=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_frisby, $frisby);
  $LoginRS=mysql_query($LoginRS__query, $frisby) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO uyeler (uy_adi, uy_soyad, uy_mail, nick, sifre) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['isim'], "text"),
                       GetSQLValueString($_POST['soyisim'], "text"),
                       GetSQLValueString($_POST['mail'], "text"),
                       GetSQLValueString($_POST['nick'], "text"),
                       GetSQLValueString($_POST['pass'], "text"));

  mysql_select_db($database_frisby, $frisby);
  $Result1 = mysql_query($insertSQL, $frisby) or die(mysql_error());

  $insertGoTo = "&basarili";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  echo '<div style="font-size:13px;float:left;width:100%;height:37px;text-align:center;paddin-top:5px;">Başarıyla Kayıt Oldunuz</div>';
}

mysql_select_db($database_frisby, $frisby);
$query_uyeol = "SELECT * FROM uyeler";
$uyeol = mysql_query($query_uyeol, $frisby) or die(mysql_error());
$row_uyeol = mysql_fetch_assoc($uyeol);
$totalRows_uyeol = mysql_num_rows($uyeol);
?>

<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Üye Ol</title>
<link href="sitil/style.css" rel="stylesheet" type="text/css" />
</head>
<?php include 'header.php'; ?>
<div id="beforebaslik">Üye Ol</div>
<div id="beforegame">
	<div id="oyun-bilgileri">
		<form name="form" action="<?php echo $editFormAction; ?>" method="POST">
        	<input value="Adınız" name="isim" type="text" />
            <input name="soyisim" type="text" value="Soyadınız" />
            <input name="mail" type="text" value="Mail Adresiniz" />
            <input name="nick" type="text" value="Kullanıcı Adı" />
            <input name="pass" type="password" value="**********" />
            <img src="guvenlik-kodu.php" />
            <input value="Güvenlik kodu" type="text" name="guvenlikKodu" id="guvenlikKodu" required />
            <input name="Submit" type="submit" value="Üye Ol" />
            <input type="hidden" name="MM_insert" value="form" />
        </form>
 
	</div>
    <div id="reklam2"><img src="resimler/leaderboard.gif" width="728" height="90" /></div>
</div>
<div id="home-reklam"><img src="resimler/reklam-ornek.png" width="160" height="600" /></div>
</div>
<?php include 'footer.php'; ?>
<?php
mysql_free_result($uyeol);
?>
