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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['k_adi'])) {
  $loginUsername=$_POST['k_adi'];
  $password=$_POST['sifre'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "profil.php";
  $MM_redirectLoginFailed = "yanliss";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_frisby, $frisby);
  
  $LoginRS__query=sprintf("SELECT nick, sifre FROM uyeler WHERE nick=%s AND sifre=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $frisby) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    echo '<div style="font-size:13px;float:left;width:100%;height:37px;text-align:center;paddin-top:5px;">Hatalı Bilgi Girdiniz!</div>';
  }
}
?>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Giriş Yap</title>
<link href="sitil/style.css" rel="stylesheet" type="text/css" />
</head>
<?php include 'header.php'; ?>
<div id="beforebaslik">Giriş Yap</div>
<div id="beforegame">
	<div id="oyun-bilgileri">
     <form name="giris" action="<?php echo $loginFormAction; ?>" method="POST">
     	<input value="Kullanıcı Adınız" name="k_adi" type="text" />
        <input value="*******" name="sifre" type="password" />
        <input type="submit" value="Giriş" />
     </form>
	</div>
    <div id="reklam2"><img src="resimler/leaderboard.gif" width="728" height="90" /></div>
</div>
<div id="home-reklam"><img src="resimler/reklam-ornek.png" width="160" height="600" /></div>
</div>
<?php include 'footer.php'; ?>
