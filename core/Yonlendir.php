<?php

namespace Core;


class Yonlendir
{
    public static function rota($url)
    {
        return header("location:$url");
    }
}