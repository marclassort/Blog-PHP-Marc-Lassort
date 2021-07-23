<?php

namespace Repository;

use Core\Database;
use Exception;
use PDO;

class Manager
{
//----------------------------------------
    //SINGLETON
    //----------------------------------------
    private static $connect = null;
    protected $bdd;

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