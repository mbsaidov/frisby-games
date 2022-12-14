-- MySQL dump 10.13  Distrib 5.5.42, for Linux (x86_64)
--
-- Host: localhost    Database: frisby_oyun
-- ------------------------------------------------------
-- Server version	5.5.42-cll

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `k_adi` varchar(255) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `k_adi`, `sifre`) VALUES (1,'msaid','msaid');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ayarlar`
--

DROP TABLE IF EXISTS `ayarlar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `siteadi` varchar(255) NOT NULL,
  `a_baslik` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `f_text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ayarlar`
--

LOCK TABLES `ayarlar` WRITE;
/*!40000 ALTER TABLE `ayarlar` DISABLE KEYS */;
INSERT INTO `ayarlar` (`id`, `siteadi`, `a_baslik`, `desc`, `f_text`) VALUES (1,'Frisby Oyun','Frisby Oyun En G??zel Oyunlar','Frisby oyun sitesinde onlarca kategoride y??zlerce oyun bulabilirsiniz.','2015 y??l??ndan g??n??m??ze kadar kesintisiz hizmet veren sitemiz kalite anlay??????n?? bozmadan her ge??en g??n geni??leyen oyun skalas?? ile yay??n hayat??na devam ediyor. Flash oyunlar??n yan?? s??ra g??n??m??z??n en ??ok oynanan oyun t??rleri aras??nda olan 3D oyunlara da yer verdi??imiz sitemizde Unity 3D ve Shockwave tabanl?? oyunlar da oynayabilirsiniz. Ayr??ca Friv, Araba Oyunlar??, K??z Oyunlar?? ve 3D Oyunlar gibi kategori sayfalar??m??z?? da takip edebilirsiniz. Sitemizdeki oyunlardan yap??mc??lar?? sorumludurlar.');
/*!40000 ALTER TABLE `ayarlar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategoriler`
--

DROP TABLE IF EXISTS `kategoriler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategoriler` (
  `kat_id` int(11) NOT NULL AUTO_INCREMENT,
  `kat_adi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `kat_desc` text COLLATE utf8_turkish_ci,
  PRIMARY KEY (`kat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategoriler`
--

LOCK TABLES `kategoriler` WRITE;
/*!40000 ALTER TABLE `kategoriler` DISABLE KEYS */;
INSERT INTO `kategoriler` (`kat_id`, `kat_adi`, `kat_desc`) VALUES (2,'Macera Oyunlar??','Macera Oyunlar?? a????klamas??'),(3,'Zeka Oyunlar??','Zeka Oyunlar?? a????klamas??'),(4,'Beceri Oyunlar??','beceri'),(6,'2 Ki??ilik','Arkada????n??zla beraber oynayabilece??iniz en iyi oyunlar bu b??l??mde sizleri bekliyor. 2 ki??ilik oyunlarda e??lenceli vakitler ge??irebilirsiniz. '),(7,'Araba Oyunlar??','Araba oyunu oynamay?? sevenler i??in en e??lenceli, en g??zel araba yar????lar??, araba park etme oyunlar??n?? araba oyunlar?? kategorimizde bir araya getirdik.'),(9,'Ben 10','Cartoon Network\'de yay??nlanan Ben 10 adl?? ??izgi film 2008 y??l??nda yay??na girmi??ti. Yay??na al??nd?????? g??nden itibaren milyonlarca ??ocu??un hayranl??????n?? kazanmay?? ba??aran Ben 10 internette de oyunlar?? ile ??ok fazla ilgi topluyor.'),(11,'??izgi Film Oyunlar??','Tom ve Jerry, Bugs Bunny, Duffy Duck, Tazmanya Canavar??, Batman, Spiderman ve daha bir??ok ??izgi filmin flash ve 3 boyutlu oyunlar??na bu kategori alt??ndan ula??abilirsiniz.'),(12,'??ocuk Oyunlar??','??ocuklar i??in hem e??itici hem de ????retici oyunlar?? burada sizlere sunuyoruz. Basit ve bir o kadar da zevkli olan bu oyunlarla s??per vakit ge??ireceksiniz.'),(13,'D??v???? Oyunlar??','Street Fighter, Mortal Kombat, Tekken gibi bir??ok d??v???? oyunu bu kategori alt??nda siz oyunkolu ziyaret??ileri i??in toplad??k.'),(14,'Futbol Oyunlar??','En heyecanl?? futbol oyunlar?? bu b??l??mde sizleri bekliyor. Futbolda kendinize g??veniyorsan??z sitemizdeki futbol oyunlar??n?? oynaman??z?? tavsiye ederiz. '),(15,'Giydirme Oyunlar??','Artist, sanat????, ??izgi karakter ve en g??zel hayvan giydirme oyunlar?? sizler i??in bu kategori alt??nda topland??.\r\n'),(16,'K??z Oyunlar??','K??zlar sizler i??in en sevdi??iniz ??izgi karakterlerin oyunlar??n?? ve daha bir??ok flash oyunu burada sizlerle bulu??turuyoruz.\r\n'),(17,'Komik Oyunlar','G??ndemdeki bir olay, ??izgi film ve filmlerin komik oyunlar?? ve daha bir ??ok komik oyunu burada sizlerle bulu??turuyoruz.'),(18,'Makyaj Oyunlar??','Arad??????n??z b??t??n makyaj yapma oyunlar??n?? burada bulabilirsiniz. ??izgi karakterler, artistler, sanat????lar, cici hayvanlar ve daha bir??ok makyaj oyununa buradan ula??abilirsiniz.'),(19,'Mario Oyunlar??','Unutamad??????m??z t??m S??per Mario oyunlar?? burada. S??per tesisat????n??n oyunlar??n?? oynarken keyifli dakikalar ge??ireceksiniz. Prensesi kurtarmak i??in kendini tehlikeye atan Mario\'ya yard??mc?? olmal??s??n??z.'),(20,'Motor Oyunlar??','En iyi motor oyunlar??n?? bu b??l??mde oynayabilirsiniz. Motoru ve motor oyunlar??n?? sevenlere ??zel bir b??l??m. S??per h??zl?? motorlarla yar??????rken m??kemmel dakikalar ge??irece??iniz temin ediyoruz. Her g??n sizler i??in en yeni motor oyunlar??n?? burada bulabilirsiniz.');
/*!40000 ALTER TABLE `kategoriler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oyunlar`
--

DROP TABLE IF EXISTS `oyunlar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oyunlar` (
  `oy_id` int(11) NOT NULL AUTO_INCREMENT,
  `oy_img` varchar(2555) CHARACTER SET latin1 NOT NULL,
  `oy_swf` text CHARACTER SET latin1 NOT NULL,
  `oy_kat` varchar(255) CHARACTER SET latin1 NOT NULL,
  `oy_desc` text COLLATE utf8_turkish_ci NOT NULL,
  `oy_adi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `hit` int(11) NOT NULL,
  PRIMARY KEY (`oy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oyunlar`
--

LOCK TABLES `oyunlar` WRITE;
/*!40000 ALTER TABLE `oyunlar` DISABLE KEYS */;
INSERT INTO `oyunlar` (`oy_id`, `oy_img`, `oy_swf`, `oy_kat`, `oy_desc`, `oy_adi`, `hit`) VALUES (2,'http://www.oyuncenneti.com/images/aya_seyahat_tr.jpg','http://www.oyuncenneti.com/oyunlar/aya_seyahat.swf','3','Tahta uzay gemisini geli??tire geli??tire aya seyahat edecek hale gelin. Ok tu??lar??yla ya da WASD ile arac?? kontrol edin. Havada ilerlerken bonuslar?? toplay??p para kazan??n. Kazand??????n??z paralarla uzay meki??ini geli??tirin. Dikkat balon, u??ak meteor gibi engellere ??arp??p meki??i d??????rmeyin.','Aya Seyehat',45),(3,'http://www.oyuncenneti.com/images/turuncu_pantolon_3_tr.jpg','http://media.jaludo.com/fancy_pants/FPAWorld32.swf','4','??ncelikle oyunun boyu ??ok b??y??k y??klenmesi uzun s??rebilir. Turuncu pantolon ile uzun bir maceraya ????k. Y??n tu??lar??yla hareket et. S tu??u ile z??pla. Oyunun ba????nda yapabilece??in hareketler i??in k??sa bir e??itim olacak. Yukar?? ????kmak i??in kar???? duvara z??play??p alttan platformun ??st??ne ????kabilirsin. Ko??arken a??a???? tu??una bas??p yerde kayarak al??ak yerlerden ge??ebilirsin. ??lerleyen b??l??mlerde kalemi bulunca onunla kendini koruyabilirsin. D????manlar??n ??zerine z??play??p yok edebilirsin.','Turuncu Pantolon 3',28),(4,'http://www.oyuncenneti.com/images/yeteneksiz_tr.jpg','http://www.oyuncenneti.com//oyunlar/yeteneksiz.swf','4','D??nyan??n en zor oyunlar??ndan birini oynamaya haz??r m??s??n? M??zi??in sesini sonuna kadar a??, d??nen tabloya odaklan yetene??ini konu??tur. Fare ile tabloda yanan renklerin ayn??s??n?? s??ra sana ge??ince tekrarla.','YetenekSiz',1),(5,'http://www.oyuncenneti.com/images/bina_yikici_tr.jpg','http://www.oyuncenneti.com/oyunlar/bina_yikici.swf','3','Verilen y??k??m toplar??n?? kullanarak binalar?? y??k. Fareyi kullanarak sa?? alt k????eden bir y??k??m topu al. Ald??????n top ile istedi??in yeri hedefleyerek yerle??tir ve serbest b??rak. D????en top binay?? par??alayacak. Aradaki beton bloklara dikkat.','Bina Y??k??c??',1),(6,'http://www.oyuncenneti.com/images/bola_futbol_tr.jpg','http://a.espncdn.com/arcade/prod/games/bola/2012_02_14/ActionGame.swf','4','D??nya kupas?? y??ld??zlar?? oyununu tak??m??n??z?? ??e??tikten sonra Play butonuna basarak oyunu ba??lat??n. Ma?? ba??lad??ktan sonra y??n tu??lar??n?? kullanarak k??ran k??rana bir ma?? yapabilirsiniz. ??ut ??ekmek i??in z tu??unu, pas vermek ve takipten top almak i??in X tu??unu kullanmal??s??n??z. ??yi oyunlar..','Bola Futbol',1),(7,'http://www.oyuncenneti.com/images/spartakus_tr.jpg','http://www.oyuncenneti.com/oyunlar/spartakus.swf','4','Arenada efsaneler kanla yaz??l??r... ????k ve t??m rakiplerini yen... Y??n tu??lar??yla hareket et. Z-X-C ve BO??LUK tu??lar??yla sald??r. Ko??mak i??in y??r??me tu??una h??zl??ca iki kez bas.','Spartak??s',1),(8,'http://www.oyuncenneti.com/images/oynata_tikla_tr.jpg','http://www.oyuncenneti.com/oyunlar/oynata_tikla.swf','2',' Sevilen oyun serisinin 3. oyununda yine oynat butonunun gizlendi??i yeri bulmaya ??al??????yoruz. Fare ile nesnelere t??klayarak hareket ettir, oynat butonunu bularak ona t??kla.','Oynat\'a T??kla',6),(9,'http://www.oyuncenneti.com/images/ben_gencken_tr.jpg','http://www.oyuncenneti.com/oyunlar/ben_gencken.swf','2','??htiyar dedeyi gen??lik zaman??na g??t??r. Y??n tu??lar?? ile hareket et. BO??LUK tu??u ile z??pla. Dede gen??le??tik??e daha y??kse??e z??play??p ??nceden ????kamad?????? yerlere ????kacak. Not: kar????ya atlamak i??in en ucuna kadar gelip ??yle atlay??n yoksa a??a???? d????ersiniz.','Ben Gen??ken',31),(10,'http://www.oyuncenneti.com/images/yonet_ve_fethet_2.jpg','http://www.oyuncenneti.com/oyunlar/yonet_ve_fethet_3.swf','4','Askerlerini y??net d????manlar??n?? yenip ??lkelerini fethet orduyu geli??tirip yenilmez yap. Oyun me??hur y??net ve fethet oyunuyla ayn?? ??ekilde oynan????a sahip. G??ndermek istedi??in asker tipine t??klay??p sonra da g??ndermek istedi??in yolu g??steren ok i??aretine t??kla.','Y??net Ve Fethet 2',19),(11,'http://www.oyuncenneti.com/images/super_savascilar.jpg','http://www.oyuncenneti.com/oyunlar/super_savascilar.swf','6','Biraz kavga etmeye haz??r m??s??n??z? S??per sava??????lar?? tek ki??i ya da iki ki??i kar????l??kl?? oynayabilirsiniz. Y??n tu??lar??yla hareket et. N-M-.-, tu??lar?? ya da 1-2-3-4 tu??lar??yla sald??r, ate?? et, bomba at, sa??l??k al. ileri y??r??rken a??a???? tu??a basarak yuvarlanabilirsin. Ardarda iki kez ileri tu??a basarak ko??abilir bu esnada a??a???? basarak kafa atabilirsin.','S??per Sava??????lar',7),(12,'http://www.oyuncenneti.com/images/silahli_arena.jpg','http://www.oyuncenneti.com/oyunlar/silahli_arena.swf','6','Bilgisayara kar???? veya 4 ki??i birlikte arenada m??cadele edin. Rakibi a??a???? g??nderen kazan??r. Y??n tu??lar??n?? kullanarak hareket et, a??a???? kata inmek i??in a??a???? tu??una bas, \'??\' ile ate?? et, \'??\' ile bomba at, ayr??ca t??m bu tu??lar?? ve di??er 3 ki??inin tu??lar??n?? \'Ayarlar\' b??l??m??nden de??i??tirebilirsiniz.','Silahl?? Arena',6),(13,'http://www.oyuncenneti.com/images/penguen_kardesler_2.jpg','http://www.oyuncenneti.com/oyunlar/penguen_kardesler_2.swf','6','K??t?? niyetli kutup ay??lar??n?? durdurmas?? i??in penguen karde??lere yard??mc?? ol. ??ki pengueni ayr?? ayr?? kontrol etmelisiniz. 1. pengueni ok tu??lar??yla hareket ettirin. 2. pengueni w-a-s-d tu??lar??yla hareket ettirin. ','Penguen Karde??ler 2',5),(14,'http://www.oyuncenneti.com/images/testereli_araclar.jpg','www.oyuncenneti.com/oyunlar/testereli_araclar.swf','7',' Z??rhl?? ve ??zel silahlarla donat??lm???? arac??nla yar?????? rakiplerinden ??nce tamamla. Y??n tu??lar??yla hareket et. Z tu??u ile z??play??p rakiplerini ez. X tu??u ile silah?? kullan. Havada takla atarak nitro kazan. Fini??e varmadan rakiplerini yok etmeye ??al????.','Testereli Ara??lar',8),(15,'http://www.oyuncenneti.com/images/catlak_planor.jpg','http://www.oyuncenneti.com/oyunlar/catlak_planor.swf','7','Y??ld??zlara ula??acak kadar plan??r??n?? g????lendir. Baz?? bilgisayarlarda oyun donup kalabiliyor bu y??zden arada bir oyunu kaydet yapman??z?? tavsiye ederiz. \'Haydi U??al??m\' butonuna bas??p u??u??a ba??layabilirsin. Her u??u??un sonunda kazand??????n para ile plan??r??n?? geli??tirebilirsin. ','??atlak Plan??r',35),(16,'http://www.oyuncenneti.com/images/sari_taksi.jpg','http://www.oyuncenneti.com/oyunlar/sari_taksi.swf','7','Sar?? taksine atla ve m????terileri istedikleri yere g??t??r. Y??n tu??lar??n?? kullanarak hareket et. \'R\' ile radyo kanal??n?? de??i??tir. \'H\' ile korna ??al. Etraf?? ye??il daire ile ??evrili m????teriye yana????p arabana al. Gitmek istedi??i yer soldaki mini haritada ok ile g??sterilecek. ','Sar?? Taksi',5),(17,'http://www.oyuncenneti.com/images/ben_10_ve_generator_rex.jpg','http://www.oyuncenneti.com/oyunlar/ben_10_ve_generator_rex.swf','9','Bir tarafta s??per kahraman Ben 10 di??er tarafta g????l?? Generator Rex. ??stedi??in kahraman?? se?? ve zorlu bir m??cadeleye ba??la. Y??n tu??lar??yla motoru hareket ettir. En ufak hatada rakibin seni ge??ebilir dikkat.','Ben 10 Generator Rex',3),(18,'http://www.oyuncenneti.com/images/ben_10_kamyon.jpg','/oyunlar/ben_10_kamyon.swf','9','Kamyonu kullanarak etrafa sa????lm???? g???? toplar??n?? topla. Y??n tu??lar??yla arac?? hareket ettir. Ye??il g???? toplar??n?? topla. Yarsalardan korunmak i??in BO??LUK tu??una basarak koruma kalkan??n?? a??.','Ben 10 Kamyon',3),(19,'http://www.oyunkuzusu.com/images/sinema_filmi.jpg','http://www.oyunkuzusu.com/oyunlar/sinema_filmi_secure.swf','11','Aksiyon dolu bir sinema filminin ba?? akt??r?? olarak zorlu ??ekimleri tamamla. Y??n tu??lar??yla hareket et. BO??LUK tu??uyla z??pla, motoru ??evir ya da arabay?? turbo h??za sok.','Sinema Filmi',104),(20,'http://www.oyuncenneti.com/images/kayip_sirinler.jpg','http://www.oyuncenneti.com/oyunlar/kayip_sirinler.swf','11','Kay??p ??irinleri bulmak i??in bisikletiyle yola koyulan korkusuz ??irine yard??mc?? olun. Y??n tu??lar??yla bisikleti hareket ettirip dengesini sa??lay??n.\r\n','Kay??p ??irinler',31),(21,'http://www.oyuncenneti.com/images/hayvan_kuaforu.jpg','http://www.oyuncenneti.com/oyunlar/hayvan_kuaforu.swf','12','M????terilerin isteklerini yerine getirin. Gelen m????teriye t??klay??p hayvan?? al??n. Onu bo?? bir koltu??a t??klay??p oturtun. Ba????n??n ??st??ndeki kutuda ne istedi??i g??z??kecek. ','Hayvan Kuafor??',1),(22,'http://www.oyuncenneti.com/images/sinema_bufe.jpg','http://www.oyuncenneti.com/oyunlar/sinema_bufe.swf','12','Sinemaya gelen m????terilere en iyi ??ekilde hizmet ver paralar?? kazan. Fare ile t??klayarak m????terilerin isteklerini yerine getir.','Sinema B??fe',14),(23,'http://www.oyuncenneti.com/images/mada_ve_saha.jpg','http://www.oyuncenneti.com/oyunlar/mada_ve_saha.swf','12','Mada ve Saha unutulmu?? karanl??k ormanda kaybolmu??lar geri d??nebilmeleri i??in sana ihtiya??lar?? var. Y??n tu??lar??yla hareket ettirin. Y??ld??zlar?? toplay??p belirtilen yerlere ula??maya ??al??????n. Mada ve Saha\'n??n bazen birbirlerine yard??m etmesi gerekebilir.','Mada ve Saha',22),(24,'http://www.oyuncenneti.com/images/son_utucu.jpg','http://www.oyuncenneti.com/oyunlar/son_utucu.swf','12','Son ??t??c?? olarak s??re dolmadan t??m giysileri ??t??le. Fare ile ??t??y?? k??r??????kl??klar??n ??zerine bas??l?? tutarak giysiyi ??t??le. S??re dolmadan yapabildi??in kadar ??ok giysiyi ??t??le.','Son ??t??c??',63),(25,'http://www.oyuncenneti.com/images/kucuk_bilim_adami.jpg','http://www.oyuncenneti.com/oyunlar/kucuk_bilim_adami.swf','12','Uzay gemisinin roketini bulmas?? i??in k??????k bilim adam??m??za yard??m et. Fare ile kullanabilece??in nesnelere t??kla. Bulmacalar?? ????z??nce k??????k bilim adam??na t??kla y??r??yerek devam edecek, y??r??mezse bulmacay?? hen??z tamamlamam????s??n demektir.','K??????k Bilim Adam??',21),(26,'http://www.oyuncenneti.com/images/sek_sek_sekerekten.jpg','www.oyuncenneti.com/oyunlar/sek_sek_sekerekten.swf','3','A??a???? d????meden gidebildi??in kadar uza??a git. \'BO??LUK\' tu??una basarak z??playabilirsin. Oyun gittik??e h??zlanacak dikkat et. Ayr??ca atlayamayaca????n kadar uzun mesafelerde ????kabilir bu durumda ??ans??na k??seceksin art??k :)','Sek Sek Sekerekten',33);
/*!40000 ALTER TABLE `oyunlar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reklamlar`
--

DROP TABLE IF EXISTS `reklamlar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reklamlar` (
  `id` varchar(11) NOT NULL,
  `oyunoncesi` text NOT NULL,
  `dikey` text NOT NULL,
  `yatay` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reklamlar`
--

LOCK TABLES `reklamlar` WRITE;
/*!40000 ALTER TABLE `reklamlar` DISABLE KEYS */;
INSERT INTO `reklamlar` (`id`, `oyunoncesi`, `dikey`, `yatay`) VALUES ('1','<img src=\"resimler/250reklam.png\" />\r\n','<img src=\"resimler/reklam-ornek.png\" width=\"160\" height=\"600\" />','<img src=\"resimler/leaderboard.gif\" width=\"728\" height=\"90\" />');
/*!40000 ALTER TABLE `reklamlar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uyeler`
--

DROP TABLE IF EXISTS `uyeler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uyeler` (
  `uy_id` int(11) NOT NULL AUTO_INCREMENT,
  `uy_adi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `uy_soyad` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `uy_mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `nick` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(255) NOT NULL,
  PRIMARY KEY (`uy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uyeler`
--

LOCK TABLES `uyeler` WRITE;
/*!40000 ALTER TABLE `uyeler` DISABLE KEYS */;
INSERT INTO `uyeler` (`uy_id`, `uy_adi`, `uy_soyad`, `uy_mail`, `nick`, `sifre`) VALUES (6,'Mehmet','Ba??kaya','msaidbaskaya@gmail.com','msaid','359msb359'),(7,'Ali','Demir','mail@mail.com','alidemir','359359359'),(9,'Hasan','??elik','hasan@celik.com','hasancelik','hasan'),(12,'Said','Ba??kaya','said@said.vom','said','359msb359');
/*!40000 ALTER TABLE `uyeler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yorumlar`
--

DROP TABLE IF EXISTS `yorumlar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yorumlar` (
  `y_id` int(11) NOT NULL AUTO_INCREMENT,
  `yorum` varchar(5555) NOT NULL,
  `oyun_id` varchar(255) NOT NULL,
  `uye_id` varchar(255) NOT NULL,
  PRIMARY KEY (`y_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yorumlar`
--

LOCK TABLES `yorumlar` WRITE;
/*!40000 ALTER TABLE `yorumlar` DISABLE KEYS */;
INSERT INTO `yorumlar` (`y_id`, `yorum`, `oyun_id`, `uye_id`) VALUES (2,'Oyun ??ok g??zellll ama ??ok','19','msaid'),(3,'Bu oyun ??ok g??zel','23','msaid'),(4,'Penguenler ??ok g??zel','13','msaid'),(5,'??irinler ??ok iyi','20','msaid'),(6,'oyunu bitirdim','3','msaid'),(7,'??ok kolay','3','msaid'),(8,'??ok h??zl?? araba','14','msaid'),(9,'oyun g??zel','14','msaid'),(10,'Oyunu ??ok sevdim','26','admin'),(11,'Oyun ??ok zevkli','24','admin'),(12,'Bencede g??zel','24','admin'),(13,'Te??ekk??r ederim','24','admin'),(14,'Oyun g??zel ger??ekten','24','admin'),(15,'Oyun kolay','24','admin');
/*!40000 ALTER TABLE `yorumlar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'frisby_oyun'
--

--
-- Dumping routines for database 'frisby_oyun'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-17 20:27:12
