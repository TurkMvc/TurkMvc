<?php

namespace Core;

use PDO;
use PDOException;

class Veritabani
{
    public static function veritabaniAl()
    {
        $yapilandir = include_once __DIR__ . "/../app/veritabani.php";

        if($yapilandir['driver'] == 'sqlite'){

            $sqlite = __DIR__ . "/../storage/database/" . $yapilandir['sqlite']['host'];
            $sqlite = "sqlite:" . $sqlite;

            try{
                $pdo = new PDO($sqlite);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                return $pdo;
            }catch (PDOException $e){
                echo $e->getMessage();
            }

        }elseif($yapilandir['driver'] == 'mysql'){

            $host = $yapilandir['mysql']['host'];
            $db = $yapilandir['mysql']['database'];
            $user = $yapilandir['mysql']['user'];
            $pass = $yapilandir['mysql']['pass'];
            $charset = $yapilandir['mysql']['charset'];
            $collation = $yapilandir['mysql']['collation'];

            try {
                $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES '$charset' COLLATE '$collation'");
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                return $pdo;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

}