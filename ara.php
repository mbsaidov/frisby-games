<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();
?>
<?php require_once('Connections/frisby.php'); ?>
<?php include 'functions.php'; ?> 
<?php 
			$arama=$_GET["s"];
			$veri = mysql_query("SELECT * FROM frisby_oyun.oyunlar WHERE oy_adi LIKE '%$arama%' ");
			echo mysql_error();
			$sayi=mysql_num_rows($veri);
			if ($sayi<1) { echo "Aramanızla ilgili sonuç bulunamadı <a href='index.php'> Geri Dön</a>";exit();}
			else {
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Arama Sonuçları</title>
<?php include 'header.php'; ?>

	<div id="oyunlistesi">
    	<div id="baslik">Arama Sonuçları</div>
    	    <?php while($cikart = mysql_fetch_array($veri)) { ?><div class="oitem"><a href="oyun/<?php echo seo($cikart["oy_adi"]); ?>/<?php echo $cikart["oy_id"]; ?>/"><img src="<?php echo $cikart["oy_img"]; ?>" width="138" height="98" /><?php echo $cikart["oy_adi"]; ?></a></div><?php }} ?>
    </div>
			
    <div id="home-reklam"><img src="resimler/reklam-ornek.png" width="160" height="600" /></div>
</div>
<?php include 'footer.php'; ?>