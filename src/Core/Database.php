<?php

namespace Core;

use Exception;
use PDO;

class Database
{
    //----------------------------------------
    //SINGLETON
    //----------------------------------------
    private static $connect = null;
    private $bdd;

    public function __construct()
    {
        $strBddServeur = "localhost";
        $strBddLogin = "root";             
        $strBddPassword = "root";
        $strBddBase = "blog_marc_lassort";
            
            
        //Création d'un lien à la base de données de type PDO
        try
        {
            $this->bdd = new PDO('mysql:host=' .$strBddServeur. ';dbname=' .$strBddBase,$strBddLogin,$strBddPassword,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

    public static function getInstance() {
        if(is_null(self::$connect)) {
            self::$connect = new Database(); 
        }
        return self::$connect;
    }
    
    //----------------------------------------
    //FONCTIONS
    //----------------------------------------
        
    // Permet d'effectuer une requête SQL. Retourne le résultat (s'il y en a un) de la requête sous forme d'objet
    public function requete($req){
        $query = $this->bdd->query($req);
        return $query;
    }

    // Permet de préparer une requête SQL. Retourne la requête préparée sous forme d'objet
    public function preparation($req){
        $query = $this->bdd->prepare($req);
        return $query;
    }

    // Permet d'exécuter une requête SQL préparée. Retourne le résultat (s'il y en a un) de la requête sous forme d'objet
    public function execution($query, $tab){
        $req = $query->execute($tab);
        return $req;
    }

    // Retourne l'id de la dernière insertion par auto-incrément dans la base de données
    public function dernierIndex(){
        return $this->bdd->lastInsertId();
    }
}



// namespace Core;

// use Exception;
// use PDO;
// use PDOException;

// class Database
// {

//     private $_bdd;
//     private static $_instance;

//     public function getInstance($datasource)
//     {

//         if (empty(self::$_instance))
//         {
//             self::$_instance = new Database($datasource);
//         }
//         return self::$_instance->_bdd;
//     }

//     public function __construct($datasource)
//     {
        
//         $this->_bdd = new PDO("mysql:dbname=" . $datasource->database->dbname . ";host=" . $datasource->database->host, $datasource->database->user, $datasource->database->password);

//     }

//     public function getDatabase()
//     {

//         return $this->_bdd;

//     }

// }

//     private $database;
//     private array $config;

//     public function __construct()
//     {

//         $bdd = "'mysql:host=' . $this->config['DB_HOST'] . ';dbname=' . $this->config['DB_NAME'] . ';charset=utf8', $this->config['DB_USER'], $this->config['DB_PASSWORD'])";
//         $options = [
//             PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
//             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//             PDO::ATTR_EMULATE_PREPARES   => false,
//         ];
        
//         try
//         {
//             if ($this->database === null) 
//             {
//                 $this->database = new PDO($bdd, $options);
//             }
//         }
//         catch (PDOException $e)
//         {
//             throw new Exception('Erreur de connexion avec la base de données:' . $e->getMessage());
//         }

//     }

//     public function getDatabase()
//     {
//         return $this->database;
//     }

// }


// namespace Core;

// use PDO;

// class Database
// {
    
//     private static $instance;
//     private $database;

//     private function __construct($datasource)
//     {
//         $this->database = new PDO('mysql:dbname=' . $datasource->database->dbname . ';host=' . $datasource->database->host,
//         $datasource->database->user,
//         $datasource->database->password);
//     }

//     public static function getInstance($datasource)
//     {
//         if (empty(self::$instance))
//         {
//             self::$instance = new Database($datasource);
//         }
//         return self::$instance->bdd;
//     }

//     public function getDatabase()
//     {
//         return $this->database;
//     }

// }