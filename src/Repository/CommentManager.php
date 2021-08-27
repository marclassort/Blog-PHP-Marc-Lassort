<?php

namespace App\Repository;

use PDO;
use Core\Database;

class CommentManager
{
    protected ?string $table;
    protected $object;
    protected string $entity;
    protected string $comment;
    protected $bdd;

    public function __construct($table, $object)
    {
        $this->table = $table;
        $this->object = $object;
        $this->bdd = Database::getInstance();
    }

    /**
     * Find all blog comments
     */
    public function getAllComments()
    {
        $sql = 'SELECT * FROM ' . $this->table;
        $query = $this->bdd->preparation($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}