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

mysql_select_db($database_frisby, $frisby);
$query_kategoriler = "SELECT * FROM kategoriler ORDER BY kat_id DESC";
$kategoriler = mysql_query($query_kategoriler, $frisby) or die(mysql_error());
$row_kategoriler = mysql_fetch_assoc($kategoriler);
$totalRows_kategoriler = mysql_num_rows($kategoriler);
?>
<?php include 'header.php'; ?>

<body>
<?php include 'sidebar.php'; ?>

<div id="icerik">
<h2>//Kategori <span>Listesi</span></h2>
<table width="850" border="0">

  <tr>
    <td height="38"><strong>Kategori Adı</strong></td>
    <td><strong>Kategori Açıklaması</strong></td>
    <td><strong>Düzenle</strong></td>
    <td><strong>Sil</strong></td>
  </tr>
  <?php do { ?><tr>
      
        <td width="180" height="41"><?php echo $row_kategoriler['kat_adi']; ?></td>
  <td width="467"><?php echo $row_kategoriler['kat_desc']; ?></td>
        <td width="100"><a href="#">Düzenle</a></td>
        <td width="85"><a href="sil.php?kat_id=<?php echo $row_kategoriler['kat_id']; ?>">Sil</a></td>
       
  </tr> <?php } while ($row_kategoriler = mysql_fetch_assoc($kategoriler)); ?>
  </table>
<?php
mysql_free_result($kategoriler);
?>
