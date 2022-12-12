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

if (isset($_POST['k_Adi'])) {
  $loginUsername=$_POST['k_Adi'];
  $password=$_POST['sifre'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "giris.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_frisby, $frisby);
  
  $LoginRS__query=sprintf("SELECT k_adi, sifre FROM `admin` WHERE k_adi=%s AND sifre=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "int")); 
   
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
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<style type="text/css">
body {
	background-image: url(sbg.png);
	background-color: #DE7824;
}
#form1 {
	text-align:center;
	width: 400px;
	margin-top: 165px;
	margin-right: auto;
	margin-left: auto;
	background-color: #3EAB8C;
	background-image: url(../resimler/sbg.png);
	padding-top: 35px;
	padding-right: 25px;
	padding-bottom: 40px;
	padding-left: 25px;
	border: 2px dashed #217A5C;
}
#form1 p #button {
	background-color: #DA6B1A;
	color: #EFFBFB;
}
#form1 p input {
	width: 350px;
	height: 40px;
	background-image: url(../resimler/sbg.png);
	background-color: #15566C;
	border: 1px dashed #014769;
	font-size: 15px;
	color: #FFF;
	padding-left: 15px;
}
</style>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<body>
<form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
<img src="logoadmin.png" width="180" />
<p>
    <label for="k_Adi"></label>
    <input type="text" name="k_Adi" id="k_Adi" />
  </p>
  <p>
    <label for="sifre"></label>
    <input type="password" name="sifre" id="sifre" />
  </p>
  <p>
    <input type="submit" name="button" id="button" value="GİRİŞ" />
  </p>
</form>
</body>