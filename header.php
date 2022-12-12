<?php require_once('Connections/frisby.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "giris.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
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

mysql_select_db($database_frisby, $frisby);
$query_kategori = "SELECT * FROM kategoriler ORDER BY kat_adi ASC";
$kategori = mysql_query($query_kategori, $frisby) or die(mysql_error());
$row_kategori = mysql_fetch_assoc($kategori);
$totalRows_kategori = mysql_num_rows($kategori);
?>
<?php 

$sql="SELECT * FROM oyunlar where oy_id ORDER BY RAND() LIMIT 1"; 
$rastgeleisim="SELECT * FROM oyunlar where oy_adi ORDER BY RAND() LIMIT 1"; 

$sonuc=mysql_fetch_array(mysql_query($sql)); 

?>
<?php
$oyunsayi = mysql_query("SELECT * FROM oyunlar");
$toplam_oyun = mysql_num_rows($oyunsayi);
$katsayi = mysql_query("SELECT * FROM kategoriler");
$toplam_kat = mysql_num_rows($katsayi);
?>
<base href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/" />
<style type="text/css">
#yanduzenle {
	float: left;
	height: 400px;
	width: 16%;
}
#sidebarbg {
	background-color: #ffd771;
	background-image: url(resimler/sbg.png);
	float: left;
}
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src='js/nprogress.js'></script>
<link rel='stylesheet' href='sitil/nprogress.css'/>
<link href="sitil/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="SlickNav/slicknav.css" />
<script src="SlickNav/jquery.slicknav.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script>
	$(function(){
		$('#sidebar').slicknav();
	});
</script>
</head>
<body>
<div id="site">

    <div id="serit">
        <div id="header">
			<div id="logo"><a href="index.php"><img alt="logo" src="resimler/logo.png" height="60" /></a></div>
			<a href="oyun/<?php echo seo($sonuc['oy_adi']); ?>/<?php echo $sonuc['oy_id'];  ?>/"><div id="rastgele">Rastgele Oyun!</div></a>
            <a href="EnCokOynananlar"><div id="populer">En Çok Oynananlar</div></a>
			<div id="search">
            <?php $k_adi= @$_SESSION['MM_Username']; if($k_adi=="") { ?>
			<a href="uyeol.php"><div id="uyelik">Üye Ol</div></a>
			<a href="giris.php"><div id="giris">Giriş Yap</div></a>
			<?php } else { ?>
			<a href="Hesabim"><div id="uyelik">Profil Sayfası</div></a>
            <a href="<?php echo $logoutAction ?>"><div id="giris">Çıkış Yap</div></a>
			<?php } ?>
			<form id="searchform" method="get" action="ara.php">
				<input name="s" id="textfield" type="text" /><input type="submit" id="button" value="Ara" />
			</form>
			</div>
		</div>
        <div id="stats">
            <p>Hoşgeldin Oyuncu! Sitemizde <?php echo $toplam_kat; ?> Kategori Altında Toplam <?php echo $toplam_oyun; ?> Oyun Bulunmakta.Hemen üye olarak oyunlara yorum yapabilirsiniz.</p>
        </div>
    </div>
    
    <!-- Üst bölüm bitti, Sidebar alanı başlıyor. -->
    
	<div id="icerik">
		<div id="sidebar">
			<div id="sidebarbg">
            	<ul>
					<li>Kategoriler</li>
					<?php do { ?>
                    <li>»<a href="kategori/<?php echo seo($row_kategori['kat_adi']); ?>/<?php echo $row_kategori['kat_id']; ?>/"><?php echo $row_kategori['kat_adi']; ?></a></li>
				<?php } while ($row_kategori = mysql_fetch_assoc($kategori)); ?>
				</ul>
			</div>
        	<div id="yanduzenle"></div>
        </div>
<?php mysql_free_result($kategori); ?>
