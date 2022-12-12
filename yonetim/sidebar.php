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
<div id="sidebar">
	<div id="logo"><a href="index.php"><img src="logoadmin.png" height="43"></a></div>
    <ul>
        <a href="ayarlar.php"><li>Site Ayarları</li></a>
		<a href="oyunlar.php"><li>Oyun Listesi</li></a>
		<a href="oyunekle.php"><li>Oyun Ekle</li></a>
		<a href="kategoriler.php"><li>Kategoriler</li></a>
		<a href="katekle.php"><li>Kategori Ekle</li></a>
		<a href="uyeler.php"><li>Üye Listesi</li></a>
		<a href="yorumlar.php"><li>Yorumlar</li></a>
		<a href="reklam.php"><li>Reklam Ayarları</li></a>
		<a href="profilayarlari.php"><li>Profil Ayarları</li></a>
        <a href="sunucu.php"><li>Sunucu Bilgileri</li></a>
        <a href="<?php echo $logoutAction ?>"><li>Çıkış Yap</li></a>
    </ul>
</div>
<div id="ust"></div>