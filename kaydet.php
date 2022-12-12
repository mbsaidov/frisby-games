<?php 
$sayfa_adresi = $_SERVER["HTTP_REFERER"];  
$icerik = "[InternetShortcut]\r\n";  
$icerik .= "URL=$sayfa_adresi";  
echo $icerik;  
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=oyun.url");  
?>