<?php

namespace App\Repository;

use App\Entity\Post;
use Core\Database;
use PDO;

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
     * Finds all blog posts
     * 
     * @return mixed
     */
    public function getAllPosts()
    {
        $sql = self::SELECTQUERY . $this->table;
        $query = $this->bdd->preparation($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Finds all blog posts according to a specific author 
     * 
     * @param mixed $author
     * 
     * @return mixed
     */
    public function getPostsbyAuthor($author)
    {
        $sql = self::SELECTQUERY . $this->table . ' WHERE author = ?';
        $query = $this->bdd->preparation($sql);
        $query->execute([$author]);
        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Finds a specific blog posts
     * 
     * @param int $postId
     * 
     * @return mixed
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
     * Creates a new blog post
     * 
     * @param Post $post
     * 
     * @return void
     */
    public function createPost(Post $post): void
    {
        $sql = 'INSERT INTO ' . $this->table . ' (title, blurb, creation_date, modif_date, content, author, user_id, imageName, imageAlt) VALUES (?, ?, NOW(), NULL, ?, ?, ?, ?, ?)';
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $post->getTitle(),
            $post->getBlurb(),
            $post->getContent(),
            $post->getAuthor(),
            $post->getAuthor(),
            $post->getImageName(),
            $post->getImageAlt()
        ]);
    }

    /**
     * Edits a specific blog post
     * 
     * @param Post $post
     * 
     * @return void
     */
    public function editPost(Post $post): void
    {
        $sql = "UPDATE post
                SET title = ?, blurb = ?, modif_date = NOW(), content = ?, author = ?, user_id = ?, imageName = ?, imageAlt = ?
                WHERE id = ?";
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $post->getTitle(),
            $post->getBlurb(),
            $post->getContent(),
            $post->getAuthor(),
            $post->getAuthor(),
            $post->getImageName(),
            $post->getImageAlt(),
            $post->getId()
        ]);
    }

    /**
     * Deletes a specific blog post
     * 
     * @param int $postId
     * 
     * @return void
     */
    public function deletePost($postId): void
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $query = $this->bdd->preparation($sql);
        $query->bindValue(':id', $postId);
        $query->execute();
    }

    /**
     * Retrieves an array of columns name to use in SQL queries 
     * 
     * @param Post $properties
     * 
     * @return array
     */
    protected function getTables(Post $properties): array
    {
        $this->tables = [];
        $array = (array)$properties;
        foreach ($array as $table)
        {
            $this->tables[] = $this->table . '.' . $table;
        }

        return $this->tables;
    }

    /**
     * Retrieves an array of values to use in SQL queries
     * 
     * @param array $properties
     * 
     * @return array
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