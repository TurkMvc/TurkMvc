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
        $stranahtars = "";
        $strBinds = "";
        $binds = [];
        $values = [];

        foreach ($veri as $anahtar => $value){
            $stranahtars = "{$stranahtars},{$anahtar}";
            $strBinds = "{$strBinds},:{$anahtar}";
            $binds[] = ":{$anahtar}";
            $values[] = $value;
        }
        $stranahtars = substr($stranahtars, 1);
        $strBinds = substr($strBinds, 1);

        return [$stranahtars, $strBinds, $binds, $values];
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
        $baglar = [];
        $degerler = [];

        foreach ($veri as $anahtar => $deger){
            $strAnahtarBaglanti = "{$strAnahtarBaglanti},{$anahtar}=:{$anahtar}";
            $baglar[] = ":{$anahtar}";
            $degerler[] = $deger;
        }
        $strAnahtarBaglanti = substr($strAnahtarBaglanti, 1);

        return [$strAnahtarBaglanti, $baglar, $degerler];
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