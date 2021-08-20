<?php

namespace App\Repository;

use App\Entity\Post;
use PDO;
use Core\Database;
use DateTime;

class PostManager
{
    protected $table;
    protected $object;
    protected $post;
    protected $bdd;
    public const SELECTQUERY = 'SELECT * FROM ';

    public function __construct($table, $object)
    {
        $this->table = $table;
        $this->object = $object;
        $this->bdd = Database::getInstance();
    }

    /**
     * Find all blog posts
     */
    public function getAllPosts()
    {
        $sql = self::SELECTQUERY . $this->table;
        $query = $this->bdd->preparation($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Find all blog posts according to a specific author 
     */
    public function getPostsbyAuthor($author)
    {
        $sql = self::SELECTQUERY . $this->table . ' WHERE author = ?';
        $query = $this->bdd->preparation($sql);
        $query->execute([$author]);
        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Find a specific blog posts
     */
    public function getPost($postId)
    {
        $sql = self::SELECTQUERY . $this->table . ' WHERE id = ?';
        $query = $this->bdd->preparation($sql);
        $query->execute([$postId]);
        $query->setFetchMode(PDO::FETCH_CLASS, '\App\Entity\\Post');
        return $query->fetch();
    }

    /**
     * Create a new blog post
     */
    public function createPost(Post $post)
    {
        $sql = 'INSERT INTO ' . $this->table . ' (title, blurb, creation_date, modif_date, content, author, user_id) VALUES (?, ?, NOW(), NULL, ?, ?, 1)';
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $post->getTitle(),
            $post->getBlurb(),
            $post->getContent(),
            $post->getAuthor()
        ]);
    }

    /**
     * Edit a specific blog post
     */
    public function editPost(Post $post): bool
    {
        $tables = implode(', ', $this->getTables($post));

        $sql = 'UPDATE ' . $this->table . ' SET ' . $tables . ' WHERE id = :id, title = :title, blurb = :blurb, modif_date = :modifDate, content = :content, author = :author';

        $dateTime = new \DateTime();
        var_dump($dateTime);

        $query = $this->bdd->preparation($sql);
        $query->bindValue(':id', $post->getId(), ':title', $post->getTitle(), ':blurb', $post->getBlurb(), ':modifDate', $dateTime, ':content', $post->getContent(), ':author', $post->getAuthor());
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Delete a specific blog post
     */
    public function deletePost($postId): void
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $query = $this->bdd->preparation($sql);
        $query->bindValue(':id', $postId);
        $query->execute();
    }

    /**
     * Retrieve an array of columns name to use in SQL queries 
     */
    protected function getTables(Post $properties): array
    {
        $tables = [];
        foreach ($properties as $table)
        {
            $tables[] = $this->table . '.' . $table;
        }

        return $this->tables;
    }

    /**
     * Retrieve an array of values to use in SQL queries
     */
    protected function getValues(array $properties): array
    {
        $values = [];
        foreach ($properties as $value)
        {
            $values[] = $this->table . '.' . $value;
        }

        return $this->values;
    }
}