<?php

namespace Core;


abstract class Kontrol
{
    protected $tasarim;
    private $tasarimYol;
    private $sablonYol;
    private $sayfaBaslik = null;

    public function __construct()
    {
        $this->tasarim = new \stdClass;
    }

    protected function tasarimOlustur($tasarimYol, $sablonYol = null)
    {
        $this->tasarimYol = $tasarimYol;
        $this->sablonYol = $sablonYol;
        if ($sablonYol) {
            $this->sablon();
        } else {
            $this->icerik();
        }
    }

    protected function icerik()
    {
        if (file_exists(__DIR__ . "/../app/Views/{$this->tasarimYol}.phtml")) {
            require_once __DIR__ . "/../app/Views/{$this->tasarimYol}.phtml";
        } else {
            echo "Hata: Tasarım Bulunamadı!";
        }
    }

    protected function sablon()
    {
        if (file_exists(__DIR__ . "/../app/Views/{$this->sablonYol}.phtml")) {
            require_once __DIR__ . "/../app/Views/{$this->sablonYol}.phtml";
        } else {
            echo "Hata: Şablon Bulunamadı!";
        }
    }

    protected function sayfabaslikAyarla($sayfaBaslik)
    {
        $this->sayfaBaslik = $sayfaBaslik;
    }

    protected function sayfabaslikAl($ayrac = null)
    {
        if ($ayrac) {
            echo $this->sayfaBaslik . " " . $ayrac . " ";
        } else {
            echo $this->sayfaBaslik;
        }
    }
}