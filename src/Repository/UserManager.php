<?php

namespace Repository;

use PDO;
use Repository\Manager;

class UserManager
{

    protected $bdd;

    public function __construct($table)
    {
        $this->table = $table;
        $this->bdd = Manager::getInstance();
    }

    // public function __construct($datasource)
    // {
    //     parent::__construct("user", "User", $datasource);
    // }

    public function getByMail($mail, $password)
    {
        $sql = "SELECT * FROM user WHERE mail=?";
        $query = $this->bdd->preparation($sql);
        $query->execute(array($mail, $password));
        return $query->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE, "User");

        // $query = $this->database->prepare();
        // $req->execute(array($mail, $password));
        // $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "User");
        // return $req->fetch();
    }
}