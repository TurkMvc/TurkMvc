<?php

use PDO;

abstract class Model {
	
	private $pdo;
    protected $tablo;
    
    public function sec($sorgu, $veri = array(), $fetchStyle = PDO::FETCH_ASSOC) {
        $sonuc = $this->prepare($sorgu);
        foreach ($veri as $anahtar => $deger) {
            $sonuc->bindParam($anahtar, $deger);   
        }
        $sonuc->execute();
        return $sonuc->fetchAll($fetchStyle);
    }    
    public function ekle($tablo, $veri) {
        $values   = implode(",", array_keys($veri));
        $keys = ":" .implode(", :", array_keys($veri));        
        $sorgu    = "insert into $tablo($values) values($keys)";
        $sonuc   = $this->prepare($sorgu);        
        foreach ($veri as $key => $value) {
            $sonuc->bindParam(":$key", $value);   
        }
        return $sonuc->execute();
        return $this->load->view("kategori_ekle");
    }    
    public function guncelle($tablo, $veri, $cond) {
        $anahtarGuncelle = NULL;
        foreach ($veri as $key => $value) {
            $anahtarGuncelle  .=  "$key=:$value,";
        }
        $anahtarGuncelle = rtrim($anahtarGuncelle, ",");
        
        $sorgu   =    "update $tablo set $anahtarGuncelle where $cond";
        $sonuc   = $this->prepare($sorgu);
        
        foreach ($veri as $anahtar => $deger) {
            $sonuc->bindParam(":$anahtar", $deger);   
        }
        return $sonuc->execute();
    }
    public function sil($tablo, $cond, $limit = 1) {
        $sorgu    = "delete from $tablo where $cond limit $limit";
        return $this->exec($sorgu);
    }
}
