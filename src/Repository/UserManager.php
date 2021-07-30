<?php

namespace Repository;

use Core\Database;
use PDO;

class UserManager
{

    protected $bdd;

    public function __construct($table)
    {
        $this->table = $table;
        $this->bdd = Database::getInstance();
    }

    public function getByMail($mail, $password)
    {
        $sql = "SELECT * FROM user WHERE mail=?";
        $query = $this->bdd->preparation($sql);
        $query->execute(array($mail, $password));
        return $query->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_PROPS_LATE, "User");
    }
}