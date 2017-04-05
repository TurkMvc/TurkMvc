<?php

namespace App\Controllers;

use Core\Kontrol;

class HomeController extends Kontrol
{
    public function index(){
        $this->sayfabaslikAyarla('Ana Sayfa');
        $this->tasarimOlustur('home/index', 'sablon');
    }

}