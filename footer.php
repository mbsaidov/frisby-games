<?php require_once('Connections/frisby.php'); ?>
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
$query_footertext = "SELECT f_text FROM ayarlar";
$footertext = mysql_query($query_footertext, $frisby) or die(mysql_error());
$row_footertext = mysql_fetch_assoc($footertext);
$totalRows_footertext = mysql_num_rows($footertext);
?>
<style type="text/css">
#footer-ortala img {
	float: left;
}
#socials {
	clear: both;
	float: right;
	margin-top: 20px;
}
#socials img {
	margin-left: 5px;
}
</style>
<div id="footer"></div>
<div id="footer-icerik">
	<div id="footer-ortala">
    	<img src="resimler/logo.png" height="70px;" />
        <div id="footer-yazi"><?php echo $row_footertext['f_text']; ?></div>
        <div id="socials"> 
        	<a href="#" target="blank"><img src="resimler/facebook.png" alt="facebook" width="47" height="46" /></a>
            <a href="#" target="blank"><img src="resimler/twitter.png" alt="twitter" width="47" height="46" /></a>
            <a href="#" target="blank"><img src="resimler/google+.png" alt="google+" width="47" height="46" /></a>
            <a href="#" target="blank"><img src="resimler/rss.png" alt="rss" width="47" height="46" /></a>
		</div>
    </div>
</div>

</div>
</div>
</body>
</html><?php
mysql_free_result($footertext);
?>
