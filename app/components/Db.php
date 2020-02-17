<?php

class Db
{
    public static function getConnection()
    {
        $paramsPath = ROOT . '/app/config/db_params.php';
        $params = include($paramsPath);
        $host = $params['host'];
        $dbname = $params['dbname'];
        $user = $params['user'];
        $password = $params['password'];
        
        try
        {
        $db = new PDO("mysql:host=$host; dbname=$dbname", $user, $password);
        } 
        catch (PDOException $e)
        {
            print "ERROR: Нет соединения с базой данных";
            die();
        }
 
        return $db;
    }
}
