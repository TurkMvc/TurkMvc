<?php

namespace Core;


class Rota
{
    private $rotalar;

    public function __construct(array $rotalar)
    {
        $this->rotaBelirle($rotalar);
        $this->baslat();
    }

    private function rotaBelirle($rotalar)
    {
        foreach ($rotalar as $rota){
            $parcala = explode('@', $rota[1]);
            $r = [$rota[0], $parcala[0], $parcala[1]];
            $yeniRotalar[] = $r;
        }
        $this->rotalar = $yeniRotalar;
    }

    private function istekAl()
    {
        $nesne = new \stdClass;

        foreach ($_GET as $key => $value){
            $nesne->get->$key = $value;
        }

        foreach ($_POST as $key => $value){
            $nesne->post->$key = $value;
        }

        return $nesne;
    }

    private function urlAl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    private function baslat()
    {
        $url = $this->urlAl();
        $urlDizi = explode('/', $url);

        foreach ($this->rotalar as $rota) {
            $rotaDizi = explode('/', $rota[0]);
            $parametre = [];
            for($i = 0; $i < count($rotaDizi); $i++){
                if((strpos($rotaDizi[$i], "{") !==false) && (count($urlDizi) == count($rotaDizi))){
                    $rotaDizi[$i] = $urlDizi[$i];
                    $parametre[] = $urlDizi[$i];
                }
                $rota[0] = implode($rotaDizi, '/');
            }

            if($url == $rota[0]){
                $bulundu = true;
                $kontrol = $rota[1];
                $aksiyon = $rota[2];
                break;
            }
        }

        if($bulundu){
            $kontrol = Tasiyici::yeniKontrol($kontrol);
            switch (count($parametre)){
                case 1:
                    $kontrol->$aksiyon($parametre[0], $this->istekAl());
                    break;
                case 2:
                    $kontrol->$aksiyon($parametre[0], $parametre[1], $this->istekAl());
                    break;
                case 3:
                    $kontrol->$aksiyon($parametre[0], $parametre[1], $parametre[2], $this->istekAl());
                    break;
                default:
                    $kontrol->$aksiyon($this->istekAl());
                    break;
            }
        }else{
            Tasiyici::sayfaBulunamadi();
        }
    }

}