- phpMyAdmin SQL Dökümü
- sürüm 4.5.1
- http://www.phpmyadmin.net
-
- Anamakine: 127.0.0.1
- Üretim Zamanı: 24 Şub 2017, 18:43:03
- Sunucu sürümü: 10.1.19-MariaDB
- PHP Sürümü: 5.6.28

SET SQL_MODE =  " NO_AUTO_VALUE_ON_ZERO " ;
SET time_zone =  " +00: 00 " ;


/ * ! 40101 SET @OLD_CHARACTER_SET_CLIENT = @@ CHARACTER_SET_CLIENT * / ;
/ * ! 40101 SET @OLD_CHARACTER_SET_RESULTS = @@ CHARACTER_SET_RESULTS * / ;
/ * ! 40101 SET @OLD_COLLATION_CONNECTION = @@ COLLATION_CONNECTION * / ;
/ * ! 40101 SET NAMES utf8mb4 * / ;

-
- Veritabanı: `turkmvc`
-

- ------------------------------------------------ --------

-
- Tablo için tablo yapısı `kategori`
-

CREATE  TABLE ` kategori` (
  ` KategoriId `  int ( 11 ) NULL ,
  ` KategoriAd `  varchar ( 255 ) utf8_turkish_ci COLLATE NULL ,
  ` KategoriAciklama `  metin utf8_turkish_ci COLLATE NOT NULL ,
  ` UstKategoriId `  int ( 11 ) NULL
) ENGINE = InnoDB VARSAYILAN CHARSET = utf8 COLLATE = utf8_turkish_ci;

- ------------------------------------------------ --------

-
- Tablo için tablo yapısı `konu`
-

CREATE  TABLE ` konu` (
  ` KonuId `  int ( 11 ) NULL ,
  ` KonuBaslik `  varchar ( 255 ) utf8_turkish_ci COLLATE NULL ,
  ` KonuAciklama `  metin utf8_turkish_ci COLLATE NOT NULL ,
  ` KullaniciId `  int ( 11 ) NULL ,
  ` KategoriId `  int ( 11 ) NULL ,
  ` Tarih ` datetime DEĞİL BOŞ DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB VARSAYILAN CHARSET = utf8 COLLATE = utf8_turkish_ci;

- ------------------------------------------------ --------

-
- Tablo için tablo yapısı `kullanici`
-

CREATE  TABLE ` kullanici '(
  ` KullaniciId `  int ( 11 ) NULL ,
  ` AdSoyad `  varchar ( 255 ) utf8_turkish_ci COLLATE NULL ,
  ` KullaniciAd `  varchar ( 255 ) utf8_turkish_ci COLLATE NULL ,
  ` Posta `  varchar ( 255 ) utf8_turkish_ci COLLATE NOT NULL ,
  ` Sifre `  varchar ( 255 ) utf8_turkish_ci COLLATE NULL ,
  ` Yetki `  int ( 11 ) NULL ,
  ` KTarih ` datetime NULL DEFAULT CURRENT_TIMESTAMP ,
  ` GTarih ` datetime DEĞİL BOŞ DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB VARSAYILAN CHARSET = utf8 COLLATE = utf8_turkish_ci;


-
- Tablo için tablo yapısı `yorum`
-

CREATE  TABLE ` yorum` (
  ` YorumId `  int ( 11 ) NULL ,
  ` KullaniciId `  int ( 11 ) NULL ,
  ` KonuId `  int ( 11 ) NULL ,
  ` Yorum yapıldı `  metin utf8_turkish_ci COLLATE NOT NULL ,
  ` ETarih ` datetime NULL DEFAULT CURRENT_TIMESTAMP ,
  ` GTarih ` datetime DEĞİL BOŞ DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB VARSAYILAN CHARSET = utf8 COLLATE = utf8_turkish_ci;

-
- Dökümü yapılmış tablolar için indeksler
-

-
- Tablo için indeksler `kategori`
-
Alter  TABLO  ` kategori '
  ADD birincil anahtar ( ' kategoriId ` );

-
- Tablo için indeksler `konu`
-
Alter  TABLO  ` konu `
  ADD birincil anahtar ( ' konuId ` );

-
- Tablo için indeksler 'kullanici`
-
Alter  TABLO  ` kullanici `
  ADD birincil anahtar ( ' kullaniciId ` );

-
- Tablo için indeksler 'yorum`
-
Alter  TABLO  ` Yorum `
  ADD birincil anahtar ( ' yorumId ` );

-
- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
-

-
- Tablo için AUTO_INCREMENT değeri `kategori`
-
Alter  TABLO  ` kategori '
  DEĞİŞTİREN ` kategoriId `  int ( 11 ) NULL AUTO_INCREMENT, AUTO_INCREMENT = 5 ;
-
- Tablo için AUTO_INCREMENT değeri `konu`
-
Alter  TABLO  ` konu `
  DEĞİŞTİREN ` konuId `  int ( 11 ) NULL AUTO_INCREMENT, AUTO_INCREMENT = 5 ;
-
- Tablo için AUTO_INCREMENT değeri `kullanici`
-
Alter  TABLO  ` kullanici `
  MODIFY ` kullanici '  int ( 11 ) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 4 ;

-
- Tablo için AUTO_INCREMENT değeri `yorum`
-
Alter  TABLO  ` Yorum `
  DEĞİŞTİREN ` yorumId `  int ( 11 ) NULL AUTO_INCREMENT;
/ * ! 40101 SET CHARACTER_SET_CLIENT = @ OLD_CHARACTER_SET_CLIENT * / ;
/ * ! 40101 SET CHARACTER_SET_RESULTS = @ OLD_CHARACTER_SET_RESULTS * / ;
/ * ! 40101 SET COLLATION_CONNECTION = @ OLD_COLLATION_CONNECTION * / ;