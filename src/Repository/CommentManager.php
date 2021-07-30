<?php

namespace Repository;

use PDO;
use Repository\Manager;

class CommentManager
{
    protected ?string $table;
    protected string $entity;
    protected string $post;
    protected $bdd;

    public function __construct($table)
    {
        $this->table = $table;
        $this->bdd = Manager::getInstance();
    }

    /**
     * Find all blog posts
     */
    public function getAllComments()
    {
        $sql = 'SELECT * FROM ' . $this->table;
        $query = $this->bdd->preparation($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}