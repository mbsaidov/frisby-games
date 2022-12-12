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
INSERT INTO `ayarlar` (`id`, `siteadi`, `a_baslik`, `desc`, `f_text`) VALUES (1,'Frisby Oyun','Frisby Oyun En Güzel Oyunlar','Frisby oyun sitesinde onlarca kategoride yüzlerce oyun bulabilirsiniz.','2015 yılından günümüze kadar kesintisiz hizmet veren sitemiz kalite anlayışını bozmadan her geçen gün genişleyen oyun skalası ile yayın hayatına devam ediyor. Flash oyunların yanı sıra günümüzün en çok oynanan oyun türleri arasında olan 3D oyunlara da yer verdiğimiz sitemizde Unity 3D ve Shockwave tabanlı oyunlar da oynayabilirsiniz. Ayrıca Friv, Araba Oyunları, Kız Oyunları ve 3D Oyunlar gibi kategori sayfalarımızı da takip edebilirsiniz. Sitemizdeki oyunlardan yapımcıları sorumludurlar.');
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
INSERT INTO `kategoriler` (`kat_id`, `kat_adi`, `kat_desc`) VALUES (2,'Macera Oyunları','Macera Oyunları açıklaması'),(3,'Zeka Oyunları','Zeka Oyunları açıklaması'),(4,'Beceri Oyunları','beceri'),(6,'2 Kişilik','Arkadaşınızla beraber oynayabileceğiniz en iyi oyunlar bu bölümde sizleri bekliyor. 2 kişilik oyunlarda eğlenceli vakitler geçirebilirsiniz. '),(7,'Araba Oyunları','Araba oyunu oynamayı sevenler için en eğlenceli, en güzel araba yarışları, araba park etme oyunlarını araba oyunları kategorimizde bir araya getirdik.'),(9,'Ben 10','Cartoon Network\'de yayınlanan Ben 10 adlı çizgi film 2008 yılında yayına girmişti. Yayına alındığı günden itibaren milyonlarca çocuğun hayranlığını kazanmayı başaran Ben 10 internette de oyunları ile çok fazla ilgi topluyor.'),(11,'Çizgi Film Oyunları','Tom ve Jerry, Bugs Bunny, Duffy Duck, Tazmanya Canavarı, Batman, Spiderman ve daha birçok çizgi filmin flash ve 3 boyutlu oyunlarına bu kategori altından ulaşabilirsiniz.'),(12,'Çocuk Oyunları','Çocuklar için hem eğitici hem de öğretici oyunları burada sizlere sunuyoruz. Basit ve bir o kadar da zevkli olan bu oyunlarla süper vakit geçireceksiniz.'),(13,'Dövüş Oyunları','Street Fighter, Mortal Kombat, Tekken gibi birçok dövüş oyunu bu kategori altında siz oyunkolu ziyaretçileri için topladık.'),(14,'Futbol Oyunları','En heyecanlı futbol oyunları bu bölümde sizleri bekliyor. Futbolda kendinize güveniyorsanız sitemizdeki futbol oyunlarını oynamanızı tavsiye ederiz. '),(15,'Giydirme Oyunları','Artist, sanatçı, çizgi karakter ve en güzel hayvan giydirme oyunları sizler için bu kategori altında toplandı.\r\n'),(16,'Kız Oyunları','Kızlar sizler için en sevdiğiniz çizgi karakterlerin oyunlarını ve daha birçok flash oyunu burada sizlerle buluşturuyoruz.\r\n'),(17,'Komik Oyunlar','Gündemdeki bir olay, çizgi film ve filmlerin komik oyunları ve daha bir çok komik oyunu burada sizlerle buluşturuyoruz.'),(18,'Makyaj Oyunları','Aradığınız bütün makyaj yapma oyunlarını burada bulabilirsiniz. Çizgi karakterler, artistler, sanatçılar, cici hayvanlar ve daha birçok makyaj oyununa buradan ulaşabilirsiniz.'),(19,'Mario Oyunları','Unutamadığımız tüm Süper Mario oyunları burada. Süper tesisatçının oyunlarını oynarken keyifli dakikalar geçireceksiniz. Prensesi kurtarmak için kendini tehlikeye atan Mario\'ya yardımcı olmalısınız.'),(20,'Motor Oyunları','En iyi motor oyunlarını bu bölümde oynayabilirsiniz. Motoru ve motor oyunlarını sevenlere özel bir bölüm. Süper hızlı motorlarla yarışırken mükemmel dakikalar geçireceğiniz temin ediyoruz. Her gün sizler için en yeni motor oyunlarını burada bulabilirsiniz.');
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
INSERT INTO `oyunlar` (`oy_id`, `oy_img`, `oy_swf`, `oy_kat`, `oy_desc`, `oy_adi`, `hit`) VALUES (2,'http://www.oyuncenneti.com/images/aya_seyahat_tr.jpg','http://www.oyuncenneti.com/oyunlar/aya_seyahat.swf','3','Tahta uzay gemisini geliştire geliştire aya seyahat edecek hale gelin. Ok tuşlarıyla ya da WASD ile aracı kontrol edin. Havada ilerlerken bonusları toplayıp para kazanın. Kazandığınız paralarla uzay mekiğini geliştirin. Dikkat balon, uçak meteor gibi engellere çarpıp mekiği düşürmeyin.','Aya Seyehat',45),(3,'http://www.oyuncenneti.com/images/turuncu_pantolon_3_tr.jpg','http://media.jaludo.com/fancy_pants/FPAWorld32.swf','4','Öncelikle oyunun boyu çok büyük yüklenmesi uzun sürebilir. Turuncu pantolon ile uzun bir maceraya çık. Yön tuşlarıyla hareket et. S tuşu ile zıpla. Oyunun başında yapabileceğin hareketler için kısa bir eğitim olacak. Yukarı çıkmak için karşı duvara zıplayıp alttan platformun üstüne çıkabilirsin. Koşarken aşağı tuşuna basıp yerde kayarak alçak yerlerden geçebilirsin. İlerleyen bölümlerde kalemi bulunca onunla kendini koruyabilirsin. Düşmanların üzerine zıplayıp yok edebilirsin.','Turuncu Pantolon 3',28),(4,'http://www.oyuncenneti.com/images/yeteneksiz_tr.jpg','http://www.oyuncenneti.com//oyunlar/yeteneksiz.swf','4','Dünyanın en zor oyunlarından birini oynamaya hazır mısın? Müziğin sesini sonuna kadar aç, dönen tabloya odaklan yeteneğini konuştur. Fare ile tabloda yanan renklerin aynısını sıra sana geçince tekrarla.','YetenekSiz',1),(5,'http://www.oyuncenneti.com/images/bina_yikici_tr.jpg','http://www.oyuncenneti.com/oyunlar/bina_yikici.swf','3','Verilen yıkım toplarını kullanarak binaları yık. Fareyi kullanarak sağ alt köşeden bir yıkım topu al. Aldığın top ile istediğin yeri hedefleyerek yerleştir ve serbest bırak. Düşen top binayı parçalayacak. Aradaki beton bloklara dikkat.','Bina Yıkıcı',1),(6,'http://www.oyuncenneti.com/images/bola_futbol_tr.jpg','http://a.espncdn.com/arcade/prod/games/bola/2012_02_14/ActionGame.swf','4','Dünya kupası yıldızları oyununu takımınızı şeçtikten sonra Play butonuna basarak oyunu başlatın. Maç başladıktan sonra yön tuşlarını kullanarak kıran kırana bir maç yapabilirsiniz. Şut çekmek için z tuşunu, pas vermek ve takipten top almak için X tuşunu kullanmalısınız. İyi oyunlar..','Bola Futbol',1),(7,'http://www.oyuncenneti.com/images/spartakus_tr.jpg','http://www.oyuncenneti.com/oyunlar/spartakus.swf','4','Arenada efsaneler kanla yazılır... Çık ve tüm rakiplerini yen... Yön tuşlarıyla hareket et. Z-X-C ve BOŞLUK tuşlarıyla saldır. Koşmak için yürüme tuşuna hızlıca iki kez bas.','Spartaküs',1),(8,'http://www.oyuncenneti.com/images/oynata_tikla_tr.jpg','http://www.oyuncenneti.com/oyunlar/oynata_tikla.swf','2',' Sevilen oyun serisinin 3. oyununda yine oynat butonunun gizlendiği yeri bulmaya çalışıyoruz. Fare ile nesnelere tıklayarak hareket ettir, oynat butonunu bularak ona tıkla.','Oynat\'a Tıkla',6),(9,'http://www.oyuncenneti.com/images/ben_gencken_tr.jpg','http://www.oyuncenneti.com/oyunlar/ben_gencken.swf','2','İhtiyar dedeyi gençlik zamanına götür. Yön tuşları ile hareket et. BOŞLUK tuşu ile zıpla. Dede gençleştikçe daha yükseğe zıplayıp önceden çıkamadığı yerlere çıkacak. Not: karşıya atlamak için en ucuna kadar gelip öyle atlayın yoksa aşağı düşersiniz.','Ben Gençken',31),(10,'http://www.oyuncenneti.com/images/yonet_ve_fethet_2.jpg','http://www.oyuncenneti.com/oyunlar/yonet_ve_fethet_3.swf','4','Askerlerini yönet düşmanlarını yenip ülkelerini fethet orduyu geliştirip yenilmez yap. Oyun meşhur yönet ve fethet oyunuyla aynı şekilde oynanışa sahip. Göndermek istediğin asker tipine tıklayıp sonra da göndermek istediğin yolu gösteren ok işaretine tıkla.','Yönet Ve Fethet 2',19),(11,'http://www.oyuncenneti.com/images/super_savascilar.jpg','http://www.oyuncenneti.com/oyunlar/super_savascilar.swf','6','Biraz kavga etmeye hazır mısınız? Süper savaşçıları tek kişi ya da iki kişi karşılıklı oynayabilirsiniz. Yön tuşlarıyla hareket et. N-M-.-, tuşları ya da 1-2-3-4 tuşlarıyla saldır, ateş et, bomba at, sağlık al. ileri yürürken aşağı tuşa basarak yuvarlanabilirsin. Ardarda iki kez ileri tuşa basarak koşabilir bu esnada aşağı basarak kafa atabilirsin.','Süper Savaşçılar',7),(12,'http://www.oyuncenneti.com/images/silahli_arena.jpg','http://www.oyuncenneti.com/oyunlar/silahli_arena.swf','6','Bilgisayara karşı veya 4 kişi birlikte arenada mücadele edin. Rakibi aşağı gönderen kazanır. Yön tuşlarını kullanarak hareket et, aşağı kata inmek için aşağı tuşuna bas, \'Ğ\' ile ateş et, \'Ü\' ile bomba at, ayrıca tüm bu tuşları ve diğer 3 kişinin tuşlarını \'Ayarlar\' bölümünden değiştirebilirsiniz.','Silahlı Arena',6),(13,'http://www.oyuncenneti.com/images/penguen_kardesler_2.jpg','http://www.oyuncenneti.com/oyunlar/penguen_kardesler_2.swf','6','Kötü niyetli kutup ayılarını durdurması için penguen kardeşlere yardımcı ol. İki pengueni ayrı ayrı kontrol etmelisiniz. 1. pengueni ok tuşlarıyla hareket ettirin. 2. pengueni w-a-s-d tuşlarıyla hareket ettirin. ','Penguen Kardeşler 2',5),(14,'http://www.oyuncenneti.com/images/testereli_araclar.jpg','www.oyuncenneti.com/oyunlar/testereli_araclar.swf','7',' Zırhlı ve özel silahlarla donatılmış aracınla yarışı rakiplerinden önce tamamla. Yön tuşlarıyla hareket et. Z tuşu ile zıplayıp rakiplerini ez. X tuşu ile silahı kullan. Havada takla atarak nitro kazan. Finişe varmadan rakiplerini yok etmeye çalış.','Testereli Araçlar',8),(15,'http://www.oyuncenneti.com/images/catlak_planor.jpg','http://www.oyuncenneti.com/oyunlar/catlak_planor.swf','7','Yıldızlara ulaşacak kadar planörünü güçlendir. Bazı bilgisayarlarda oyun donup kalabiliyor bu yüzden arada bir oyunu kaydet yapmanızı tavsiye ederiz. \'Haydi Uçalım\' butonuna basıp uçuşa başlayabilirsin. Her uçuşun sonunda kazandığın para ile planörünü geliştirebilirsin. ','Çatlak Planör',35),(16,'http://www.oyuncenneti.com/images/sari_taksi.jpg','http://www.oyuncenneti.com/oyunlar/sari_taksi.swf','7','Sarı taksine atla ve müşterileri istedikleri yere götür. Yön tuşlarını kullanarak hareket et. \'R\' ile radyo kanalını değiştir. \'H\' ile korna çal. Etrafı yeşil daire ile çevrili müşteriye yanaşıp arabana al. Gitmek istediği yer soldaki mini haritada ok ile gösterilecek. ','Sarı Taksi',5),(17,'http://www.oyuncenneti.com/images/ben_10_ve_generator_rex.jpg','http://www.oyuncenneti.com/oyunlar/ben_10_ve_generator_rex.swf','9','Bir tarafta süper kahraman Ben 10 diğer tarafta güçlü Generator Rex. İstediğin kahramanı seç ve zorlu bir mücadeleye başla. Yön tuşlarıyla motoru hareket ettir. En ufak hatada rakibin seni geçebilir dikkat.','Ben 10 Generator Rex',3),(18,'http://www.oyuncenneti.com/images/ben_10_kamyon.jpg','/oyunlar/ben_10_kamyon.swf','9','Kamyonu kullanarak etrafa saçılmış güç toplarını topla. Yön tuşlarıyla aracı hareket ettir. Yeşil güç toplarını topla. Yarsalardan korunmak için BOŞLUK tuşuna basarak koruma kalkanını aç.','Ben 10 Kamyon',3),(19,'http://www.oyunkuzusu.com/images/sinema_filmi.jpg','http://www.oyunkuzusu.com/oyunlar/sinema_filmi_secure.swf','11','Aksiyon dolu bir sinema filminin baş aktörü olarak zorlu çekimleri tamamla. Yön tuşlarıyla hareket et. BOŞLUK tuşuyla zıpla, motoru çevir ya da arabayı turbo hıza sok.','Sinema Filmi',104),(20,'http://www.oyuncenneti.com/images/kayip_sirinler.jpg','http://www.oyuncenneti.com/oyunlar/kayip_sirinler.swf','11','Kayıp şirinleri bulmak için bisikletiyle yola koyulan korkusuz şirine yardımcı olun. Yön tuşlarıyla bisikleti hareket ettirip dengesini sağlayın.\r\n','Kayıp Şirinler',31),(21,'http://www.oyuncenneti.com/images/hayvan_kuaforu.jpg','http://www.oyuncenneti.com/oyunlar/hayvan_kuaforu.swf','12','Müşterilerin isteklerini yerine getirin. Gelen müşteriye tıklayıp hayvanı alın. Onu boş bir koltuğa tıklayıp oturtun. Başının üstündeki kutuda ne istediği gözükecek. ','Hayvan Kuaforü',1),(22,'http://www.oyuncenneti.com/images/sinema_bufe.jpg','http://www.oyuncenneti.com/oyunlar/sinema_bufe.swf','12','Sinemaya gelen müşterilere en iyi şekilde hizmet ver paraları kazan. Fare ile tıklayarak müşterilerin isteklerini yerine getir.','Sinema Büfe',14),(23,'http://www.oyuncenneti.com/images/mada_ve_saha.jpg','http://www.oyuncenneti.com/oyunlar/mada_ve_saha.swf','12','Mada ve Saha unutulmuş karanlık ormanda kaybolmuşlar geri dönebilmeleri için sana ihtiyaçları var. Yön tuşlarıyla hareket ettirin. Yıldızları toplayıp belirtilen yerlere ulaşmaya çalışın. Mada ve Saha\'nın bazen birbirlerine yardım etmesi gerekebilir.','Mada ve Saha',22),(24,'http://www.oyuncenneti.com/images/son_utucu.jpg','http://www.oyuncenneti.com/oyunlar/son_utucu.swf','12','Son ütücü olarak süre dolmadan tüm giysileri ütüle. Fare ile ütüyü kırışıklıkların üzerine basılı tutarak giysiyi ütüle. Süre dolmadan yapabildiğin kadar çok giysiyi ütüle.','Son Ütücü',63),(25,'http://www.oyuncenneti.com/images/kucuk_bilim_adami.jpg','http://www.oyuncenneti.com/oyunlar/kucuk_bilim_adami.swf','12','Uzay gemisinin roketini bulması için küçük bilim adamımıza yardım et. Fare ile kullanabileceğin nesnelere tıkla. Bulmacaları çözünce küçük bilim adamına tıkla yürüyerek devam edecek, yürümezse bulmacayı henüz tamamlamamışsın demektir.','Küçük Bilim Adamı',21),(26,'http://www.oyuncenneti.com/images/sek_sek_sekerekten.jpg','www.oyuncenneti.com/oyunlar/sek_sek_sekerekten.swf','3','Aşağı düşmeden gidebildiğin kadar uzağa git. \'BOŞLUK\' tuşuna basarak zıplayabilirsin. Oyun gittikçe hızlanacak dikkat et. Ayrıca atlayamayacağın kadar uzun mesafelerde çıkabilir bu durumda şansına küseceksin artık :)','Sek Sek Sekerekten',33);
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
INSERT INTO `uyeler` (`uy_id`, `uy_adi`, `uy_soyad`, `uy_mail`, `nick`, `sifre`) VALUES (6,'Mehmet','Başkaya','msaidbaskaya@gmail.com','msaid','359msb359'),(7,'Ali','Demir','mail@mail.com','alidemir','359359359'),(9,'Hasan','Çelik','hasan@celik.com','hasancelik','hasan'),(12,'Said','Başkaya','said@said.vom','said','359msb359');
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
INSERT INTO `yorumlar` (`y_id`, `yorum`, `oyun_id`, `uye_id`) VALUES (2,'Oyun çok güzellll ama çok','19','msaid'),(3,'Bu oyun çok güzel','23','msaid'),(4,'Penguenler çok güzel','13','msaid'),(5,'Şirinler çok iyi','20','msaid'),(6,'oyunu bitirdim','3','msaid'),(7,'çok kolay','3','msaid'),(8,'çok hızlı araba','14','msaid'),(9,'oyun güzel','14','msaid'),(10,'Oyunu çok sevdim','26','admin'),(11,'Oyun çok zevkli','24','admin'),(12,'Bencede güzel','24','admin'),(13,'Teşekkür ederim','24','admin'),(14,'Oyun güzel gerçekten','24','admin'),(15,'Oyun kolay','24','admin');
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
