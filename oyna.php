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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "yorum")) {
  $insertSQL = sprintf("INSERT INTO yorumlar (yorum, oyun_id, uye_id) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['yorum'], "text"),
                       GetSQLValueString($_POST['oyun'], "text"),
                       GetSQLValueString($_POST['uye'], "text"));

  mysql_select_db($database_frisby, $frisby);
  $Result1 = mysql_query($insertSQL, $frisby) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_oyna = "-1";
if (isset($_GET['id'])) {
  $colname_oyna = $_GET['id'];
}
mysql_select_db($database_frisby, $frisby);
$query_oyna = sprintf("SELECT * FROM oyunlar WHERE oy_id = %s", GetSQLValueString($colname_oyna, "int"));
$oyna = mysql_query($query_oyna, $frisby) or die(mysql_error());
$row_oyna = mysql_fetch_assoc($oyna);
$totalRows_oyna = mysql_num_rows($oyna);

$maxRows_benzer = 6;
$pageNum_benzer = 0;
if (isset($_GET['pageNum_benzer'])) {
  $pageNum_benzer = $_GET['pageNum_benzer'];
}
$startRow_benzer = $pageNum_benzer * $maxRows_benzer;

$colname_benzer = "-1";
if (isset($_GET['kat'])) {
  $colname_benzer = $_GET['kat'];
}
mysql_select_db($database_frisby, $frisby);
$query_benzer = sprintf("SELECT * FROM oyunlar WHERE oy_kat = %s ORDER BY hit DESC", GetSQLValueString($colname_benzer, "text"));
$query_limit_benzer = sprintf("%s LIMIT %d, %d", $query_benzer, $startRow_benzer, $maxRows_benzer);
$benzer = mysql_query($query_limit_benzer, $frisby) or die(mysql_error());
$row_benzer = mysql_fetch_assoc($benzer);

if (isset($_GET['totalRows_benzer'])) {
  $totalRows_benzer = $_GET['totalRows_benzer'];
} else {
  $all_benzer = mysql_query($query_benzer);
  $totalRows_benzer = mysql_num_rows($all_benzer);
}
$totalPages_benzer = ceil($totalRows_benzer/$maxRows_benzer)-1;

$maxRows_yorumlar = 10;
$pageNum_yorumlar = 0;
if (isset($_GET['pageNum_yorumlar'])) {
  $pageNum_yorumlar = $_GET['pageNum_yorumlar'];
}
$startRow_yorumlar = $pageNum_yorumlar * $maxRows_yorumlar;

$colname_yorumlar = "-1";
if (isset($_GET['id'])) {
  $colname_yorumlar = $_GET['id'];
}
mysql_select_db($database_frisby, $frisby);
$query_yorumlar = sprintf("SELECT * FROM yorumlar WHERE oyun_id = %s ORDER BY y_id DESC", GetSQLValueString($colname_yorumlar, "text"));
$query_limit_yorumlar = sprintf("%s LIMIT %d, %d", $query_yorumlar, $startRow_yorumlar, $maxRows_yorumlar);
$yorumlar = mysql_query($query_limit_yorumlar, $frisby) or die(mysql_error());
$row_yorumlar = mysql_fetch_assoc($yorumlar);

if (isset($_GET['totalRows_yorumlar'])) {
  $totalRows_yorumlar = $_GET['totalRows_yorumlar'];
} else {
  $all_yorumlar = mysql_query($query_yorumlar);
  $totalRows_yorumlar = mysql_num_rows($all_yorumlar);
}
$totalPages_yorumlar = ceil($totalRows_yorumlar/$maxRows_yorumlar)-1;

mysql_select_db($database_frisby, $frisby);
$query_reklam = "SELECT * FROM reklamlar";
$reklam = mysql_query($query_reklam, $frisby) or die(mysql_error());
$row_reklam = mysql_fetch_assoc($reklam);
$totalRows_reklam = mysql_num_rows($reklam);

mysql_select_db($database_frisby, $frisby);
$query_siteadi = "SELECT siteadi FROM ayarlar";
$siteadi = mysql_query($query_siteadi, $frisby) or die(mysql_error());
$row_siteadi = mysql_fetch_assoc($siteadi);
$totalRows_siteadi = mysql_num_rows($siteadi);
?>
<?php 
$randhit = rand(3,5); 
$hitle = mysql_query("UPDATE oyunlar SET hit=hit+1 WHERE oy_id = $_GET[id]"); 
?>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row_oyna['oy_adi']; ?> » <?php echo $row_siteadi['siteadi']; ?></title>
<link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/sitil/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#yanduzenle {  height: 20px!important;}
</style>
<?php include 'header.php'; ?>

<!-- Üst bölüm ve Sidebar bölünü bitti, Oyun alanı başlıyor -->

<div id="beforebaslik">Oyun > <?php echo $row_oyna['oy_adi']; ?></div>
<div id="beforegame" style="width: 83%!important;max-width:980px!important;">

    <div id="oyunswf">
    
    
    <script type=text/javascript> 
		setTimeout('gizle()',10000); 
		function gizle() { 
		var x=document.getElementById('birinci').style; 
		var y=document.getElementById('ikinci').style; 
		if(x.display=='block') { x.display='none'; y.display='block'; } 
		else { x.display='block'; y.display='none'; } 
		} 
		</script> 
        <div id="birinci" style="width:250px;margin-top:40px;margin-left:auto;margin-right:auto;display:block">
            <?php echo $row_reklam['oyunoncesi']; ?>
            <img id="load" src="resimler/loader.gif" width="95" />
            <h3>Oyun Yükleniyor....</h3>
        </div> 
        <div style="clear:both"></div>
        <div id="ikinci" style="display:none"><embed src="<?php echo $row_oyna['oy_swf']; ?>" width="650" height="450"> </embed></div>
        
    </div>
    <div id="benzer">
    	<ul><?php do { ?>
        	<div class="oitem">
            	<a href="oyun/<?php echo seo($row_benzer['oy_adi']); ?>/<?php echo $row_benzer['oy_id']; ?>/"><img src="<?php echo $row_benzer['oy_img']; ?>" width="138" height="98" /><?php echo $row_benzer['oy_adi']; ?></a>
			</div>
			<?php } while ($row_benzer = mysql_fetch_assoc($benzer)); ?></ul>
	</div>
   			 <!-- Oyun oynama alanı bitti, SWF altı alan başlıyor. -->
<ul>
	<li>
		<a href="pop_up" onClick="window.name='hazirkod'; window.open('tamekran.php?id=<?php echo $row_oyna['oy_id']; ?>','pop_up', 'toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=1000,height=700'); return false;">
			<div class="ozellikler">
            	Tam Ekran Oyna!
			</div>
		</a>
	</li>
	<li>
		<a href="kaydet.php">
        	<div class="ozellikler" style="width:90px!important;">
				Oyunu İndir!
			</div>
		</a>
	</li>
	<li>
		<a href="http://www.facebook.com/share.php?u=<?php echo "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."";?>">
			<div class="ozellikler" style="width:150px!important;">
				<img style="margin-left: 10px;float: left;" src="resimler/fbwhite-icon.png"  height="14" />&nbsp;Facebook'da Paylaş 
			</div>
		</a>
    </li>
	<li>
    	<div class="ozellikler" style="width:100px!important;">
			<?php echo $row_oyna['hit']; ?> Kişi Oynadı
		</div>
	</li>
	<li>
    	<a href="" onClick="location.reload(true);"> 
        	<div class="ozellikler" style="width:122px!important;border:none!important;">
        		Yeniden Başla
			</div>
		</a>
	</li>
</ul>
<?php $k_adi = @$_SESSION['MM_Username']; if($k_adi=="") { ?>
<div id="yorum">
	<div id="yorumbaslik">Yorum Yapmak İçin Üye Olun veya Giriş Yapın!</div>
    <?php if($row_yorumlar['uye_id'] != ""){ ?>
    <?php do { ?>
    <div class="yorumlar">
		<h3>"<?php echo $row_yorumlar['uye_id']; ?>" demiş ki;</h3>
        <p><?php echo $row_yorumlar['yorum']; ?></p>
	</div>
    <?php } while ($row_yorumlar = mysql_fetch_assoc($yorumlar)); ?>
    <?php } else { ?>
	<div class="yorumlar">
		<h3>Henüz Hiç Yorum Yok :(</h3>
	</div>
	<?php } ?>
</div>
<?php } else { ?>
<?php $yorumsayi = mysql_query("SELECT * FROM yorumlar"); $toplam_yorum = mysql_num_rows($yorumsayi); ?> 
<div id="yorum">
	<div id="yorumbaslik">Yorum Yap!</div>
	<form action="<?php echo $editFormAction; ?>" method="POST" name="yorum">    
		<textarea name="yorum" cols="" rows=""></textarea>
		<div style="height:200px;width:2%;float:left;"></div>
		<input name="uye" type="hidden" value="<?php echo $_SESSION['MM_Username']; ?>" />
        <input name="oyun" type="hidden" value="<?php echo $row_oyna['oy_id']; ?>" />
        <input type="submit" value="Gönder!" />
        <input type="hidden" name="MM_insert" value="yorum" />
    </form>
      <?php if($row_yorumlar['uye_id'] != ""){ ?>
	  <?php do { ?>
      <div class="yorumlar">
        <h3>"<?php echo $row_yorumlar['uye_id']; ?>" demiş ki;</h3>
        <p><?php echo $row_yorumlar['yorum']; ?></p>
      </div>
      <?php } while ($row_yorumlar = mysql_fetch_assoc($yorumlar)); ?>
      <?php } else { ?>
        <div class="yorumlar">
        <h3>Henüz Hiç Yorum Yok :(</h3>
      </div>
      <?php } ?>
<div style="clear:both;"></div>
</div>
<?php } ?>

<div id="reklam2"><?php echo $row_reklam['yatay']; ?></div>    
</div>
</div>
</div>
<?php include 'footer.php'; 
mysql_free_result($oyna);
mysql_free_result($benzer); ?>
<?php
mysql_free_result($yorumlar);

mysql_free_result($reklam);

mysql_free_result($siteadi);
?>
