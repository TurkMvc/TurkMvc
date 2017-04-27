<?php

namespace Core;

use PDO;

abstract class Model
{
    private $pdo;
    protected $tablo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function hepsi()
    {
        $sorgu = "SELECT * FROM {$this->tablo}";
        $stmt = $this->pdo->prepare($sorgu);
        $stmt->execute();
        $sonuc = $stmt->fetchAll();
        $stmt->closeCursor();
        return $sonuc;
    }

    public function bul($Id)
    {
        $sorgu = "SELECT * FROM {$this->tablo} WHERE Id=:Id";
        $stmt = $this->pdo->prepare($sorgu);
        $stmt->bindValue(":Id", $Id);
        $stmt->execute();
        $sonuc = $stmt->fetch();
        $stmt->closeCursor();
        return $sonuc;
    }

    public function ekle(array $veri)
    {
        $veri = $this->veriEkle($veri);
        $sorgu = "INSERT INTO {$this->tablo} ({$veri[0]}) VALUES ({$veri[1]})";
        $stmt = $this->pdo->prepare($sorgu);
        for($i = 0; $i < count($veri[2]); $i++){
            $stmt->bindValue("{$veri[2][$i]}", $veri[3][$i]);
        }
        $sonuc = $stmt->execute();
        $stmt->closeCursor();
        return $sonuc;
    }

    private function veriEkle(array $veri)
    {
        $strAnahtarlar = "";
        $strBaglar = "";
        $Baglar = [];
        $Degerler = [];

        foreach ($veri as $anahtar => $deger){
            $strAnahtarlar = "{$strAnahtarlar},{$anahtar}";
            $strBaglar = "{$strBaglar},:{$anahtar}";
            $Baglar[] = ":{$anahtar}";
            $Degerler[] = $deger;
        }
        $strAnahtarlar = substr($strAnahtarlar, 1);
        $strBaglar = substr($strBaglar, 1);

        return [$strAnahtarlar, $strBaglar, $Baglar, $Degerler];
    }

    public function duzenle(array $veri, $Id)
    {
        $veri = $this->veriGuncelle($veri);
        $sorgu = "UPDATE {$this->tablo} SET {$veri[0]}  WHERE Id=:Id";
        $stmt = $this->pdo->prepare($sorgu);
        $stmt->bindValue(":Id", $Id);
        for($i = 0; $i < count($veri[1]); $i++){
            $stmt->bindValue("{$veri[1][$i]}", $veri[2][$i]);
        }
        $sonuc = $stmt->execute();
        $stmt->closeCursor();
        return $sonuc;
    }

    private function veriDuzenle(array $veri)
    {
        $strAnahtarBaglanti = "";
        $Baglar = [];
        $degerler = [];

        foreach ($veri as $anahtar => $deger){
            $strAnahtarBaglanti = "{$strAnahtarBaglanti},{$anahtar}=:{$anahtar}";
            $Baglar[] = ":{$Baglar}";
            $Degerler[] = $deger;
        }
        $strAnahtarBaglanti = substr($strAnahtarBaglanti, 1);

        return [$strAnahtarBaglanti, $Baglar, $degerler];
    }

    public function sil($Id)
    {
        $sorgu = "DELETE FROM {$this->tablo} WHERE Id=:Id";
        $stmt = $this->pdo->prepare($sorgu);
        $stmt->bindValue(":Id", $Id);
        $sonuc = $stmt->execute();
        $stmt->closeCursor();
        return $sonuc;
    }

}
