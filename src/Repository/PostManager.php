<?php

namespace App\Repository;

use Entity\Post;
use PDO;
use App\Repository\Manager;

class PostManager
{
    protected $table;
    protected $post;
    protected $bdd;

    public function __construct($table)
    {
        $this->table = $table;
        $this->bdd = Manager::getInstance();
    }

    /**
     * Find all blog posts
     */
    public function getAllPosts()
    {
        $sql = 'SELECT * FROM ' . $this->table;
        $query = $this->bdd->preparation($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find all blog posts according to a specific author 
     */
    public function getPostsbyAuthor($author)
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE author = ?';
        $query = $this->bdd->preparation($sql);
        $query->execute([$author]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find a specific blog posts
     */
    public function getPost($postId)
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';
        $query = $this->bdd->preparation($sql);
        $query->execute([$postId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new blog post
     */
    public function createPost(Post $post)
    {
        $sql = 'INSERT INTO ' . $this->table . ' (title, blurb, creation_date, content, author) VALUES (?, ?, NOW(), ?, ?)';
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $post->getTitle(),
            $post->getBlurb(),
            $post->getContent(),
            $post->getAuthor()
        ]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    // public function createPost($post): bool
    // {
    //     $properties[] = array_values($this->getTables($post));

    //     $tables = implode(', ', $this->getTables($post[0]));
    //     $values = implode(', ', $this->getValues($post[0]));

    //     $sql = 'INSERT INTO ' . $this->table . '(' . $tables . ') VALUES (' . $values . ')';
    //     $query = $this->bdd->preparation($sql);
    //     $query->execute();
    //     return $query->fetchAll(PDO::FETCH_ASSOC);
    // }

    /**
     * Edit a specific blog post
     */
    public function editPost($post): bool
    {
        $tables = implode(', ', $this->getTables($post));

        $sql = 'UPDATE ' . $this->table . ' SET ' . $tables . ' WHERE id = :id';
        $query = $this->bdd->preparation($sql);
        $query->bindValue(':id', $post->getId());
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Delete a specific blog post
     */
    public function deletePost($postId): bool
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE id = ?';
        $query = $this->bdd->preparation($sql);
        $query->execute([$postId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieve an array of columns name to use in SQL queries 
     */
    protected function getTables(array $properties): array
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