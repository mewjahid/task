<?php


class Db
{

    public static function getConnection()
    {
        $paramPath = ROOT . '/config/db_params.php';
        $params = include($paramPath);

        $dsn = "mysql:host = {$params['host']}; dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password'] ,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        return $db;
    }

}