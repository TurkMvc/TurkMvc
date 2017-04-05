<?php

namespace Core;


class Tasiyici
{
    public static function yeniKontrol($kontrol)
    {
        $kontrolNesne = "App\\Controllers\\" . $kontrol;
        return new $kontrolNesne;
    }

    public static function modelAl($model)
    {
        $modelNesne = "\\App\\Models\\" . $model;
        return new $modelNesne(Veritabani::veritabaniAl());
    }

    public static function sayfaBulunamadi()
    {
        if(file_exists(__DIR__ . "/../app/Views/404.phtml")){
            return require_once __DIR__ . "/../app/Views/404.phtml";
        }else{
            echo "Hata 404: Sayfa Bulunamadı!";
        }
    }

}