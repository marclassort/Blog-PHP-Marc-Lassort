<?php

namespace App\Repository;

use Core\Database;
use PDO;

class CommentManager
{
    protected ?string $table;
    protected $object;
    protected string $entity;
    protected string $comment;
    protected $bdd;
    public const SELECTQUERY = 'SELECT * FROM ';

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
        $sql = self::SELECTQUERY . $this->table;
        $query = $this->bdd->preparation($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find all blog comments for a specific post
     */
    public function getAllCommentsForABlogPost($postId)
    {
        $sql = self::SELECTQUERY . $this->table . ' WHERE id = ?';
        $query = $this->bdd->preparation($sql);
        $query->execute([$postId]);
        $query->setFetchMode(PDO::FETCH_CLASS, '\App\Entity\\Comment');
        return $query->fetch();
    }
}