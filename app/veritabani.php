<?php

return [

    /**
     * 2 Seçenek Mevcut (mysql, sqlite)
     */
    'driver' => 'sqlite',

    'sqlite' => [
        'host' => 'database.db'
    ],

    'mysql' => [
        'host' => 'localhost',
        'database' => 'turkmvc',
        'user' => 'root',
        'pass' => 'root',
        'charset' => 'utf8',
        'collation' => 'utf8_turkish_ci'
    ]
];