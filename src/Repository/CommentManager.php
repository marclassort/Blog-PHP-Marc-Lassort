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
        $sql = self::SELECTQUERY . $this->table . ' WHERE post_id = ?';
        $query = $this->bdd->preparation($sql);
        $query->execute([$postId]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Post a comment for a specific post
     */
    public function postComment(Comment $comment, User $user, Post $post)
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
     * Validate a specific blog comment
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
     * Invalidate a specific blog comment
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