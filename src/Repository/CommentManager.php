<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Core\Database;
use PDO;

class CommentManager
{
    protected ?string $table;
    protected ?string $joinTable;
    protected $object;
    protected string $entity;
    protected string $comment;
    protected $bdd;

    public function __construct($table, $object, $joinTable = NULL)
    {
        $this->table = $table;
        $this->object = $object;
        $this->joinTable = $joinTable;
        $this->bdd = Database::getInstance();
    }

    /**
     * Retrieves all blog comments and titles of posts
     * 
     * @return mixed 
     */
    public function getAllComments()
    {
        $sql = 'SELECT ' . $this->table . '.id, ' . $this->table . '.username, ' . $this->table . '.content, ' . $this->table . '.creation_date, ' . $this->table . '.is_valid, ' . $this->joinTable . '.title FROM ' . $this->table . ' JOIN ' . $this->joinTable . ' WHERE ' . $this->joinTable . '.id = ' . $this->table . '.post_id';
        $query = $this->bdd->preparation($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Counts the number of validated comments
     * 
     * @return mixed
     */
    public function getValidatedComments()
    {
        $sql = "SELECT * FROM " . $this->table . ' WHERE is_valid = 1';
        $query = $this->bdd->preparation($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Finds all blog comments for a specific post
     * 
     * @param int $postId
     * 
     * @return mixed
     */
    public function getAllCommentsForABlogPost($postId)
    {
        $sql = 'SELECT * FROM '. $this->table . ' JOIN ' . $this->joinTable . ' ON ' . $this->joinTable . '.id = ' . $this->table . '.user_id ' . ' WHERE post_id = ?';
        $query = $this->bdd->preparation($sql);
        $query->execute([$postId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Adds a comment for a specific post
     * 
     * @param Comment $comment
     * @param User $user
     * @param Post $post
     * 
     * @return void 
     */
    public function postComment(Comment $comment, User $user, Post $post): void
    {
        $sql = 'INSERT INTO ' . $this->table . ' (username, content, creation_date, is_valid, user_id, post_id) VALUES (?, ?, NOW(), ?, ?, ?)';
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $comment->getUsername(),
            $comment->getContent(),
            $comment->getIsValid(),
            $user->getId(),
            $post->getId()
        ]);
    }

    /**
     * Validates a specific blog comment
     * 
     * @param int $commentInd
     * 
     * @return void
     */
    public function validateComment($commentId): void
    {
        $sql = 'UPDATE ' . $this->table . ' 
                SET is_valid = 1
                WHERE id = :id';
        $query = $this->bdd->preparation($sql);
        $query->bindValue(':id', $commentId);
        $query->execute();
    }

    /**
     * Invalidates a specific blog comment
     * 
     * @param int $commentId
     * 
     * @return void
     */
    public function invalidateComment($commentId): void
    {
        $sql = 'UPDATE ' . $this->table . ' 
                SET is_valid = 0
                WHERE id = :id';
        $query = $this->bdd->preparation($sql);
        $query->bindValue(':id', $commentId);
        $query->execute();
    }
}