<?php

namespace Core;

use Exception;
use PDO;

class Database
{
    private static $connect = null;
    private $bdd;

    public function __construct()
    {
        $databaseJsonFileContents = file_get_contents("../config/config.json");
        $array = json_decode($databaseJsonFileContents, true);

        $server = $array["database"]["server"];
        $login = $array["database"]["user"];             
        $password = $array["database"]["password"];
        $dbname = $array["database"]["dbname"];
            
        try
        {
            $this->bdd = new PDO('mysql:host=' .$server. ';dbname=' .$dbname,$login,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    public static function getInstance() 
    {
        if (is_null(self::$connect))
        {
            self::$connect = new Database(); 
        }
        return self::$connect;
    }
    
    // Allows to perform a SQL query. Returns the result (if any) of the query as an object
    public function requete($req)
    {
        return $this->bdd->query($req);
    }

    // Allows to prepare a SQL query. Returns the prepared query as an object
    public function preparation($req)
    {
        return $this->bdd->prepare($req);
    }

    // Allows to execute a prepared SQL query. Returns the result (if any) of the query as an object
    public function execution($query, $tab)
    {
        return $query->execute($tab);
    }

    // Returns the id of the last auto-increment insertion in the database
    public function lastIndex()
    {
        return $this->bdd->lastInsertId();
    }
}