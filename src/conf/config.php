<?php

    $pdoOptions    = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
                           \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION);
    try {
        $pdoConnection = new  \PDO('mysql:host=127.0.0.1;dbname=maloron', 'root', '', $pdoOptions);
    } catch (Exception $e){
        die($e->getMessage());
    }


    $config        = array(
        'siteTitle' => 'Mes bonnes recettes',
        'dataBase'         => $pdoConnection
    );

    return $config;