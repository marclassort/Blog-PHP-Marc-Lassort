<?php

namespace App\Repository;

use App\Entity\Image;
use PDO;
use Core\Database;

class ImageManager
{
    protected $table;
    protected $object;
    protected $image;
    protected $bdd;
    public const SELECTQUERY = 'SELECT * FROM ';

    public function __construct($table, $object)
    {
        $this->table = $table;
        $this->object = $object;
        $this->bdd = Database::getInstance();
    }

    /**
     * Finds all images
     * 
     * @return mixed
     */
    public function getAllImages()
    {
        $sql = self::SELECTQUERY . $this->table;
        $query = $this->bdd->preparation($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Finds a specific image
     * 
     * @param int $postId
     * 
     * @return mixed
     */
    public function getImage($postId)
    {
        $sql = self::SELECTQUERY . $this->table . ' WHERE post_id = ?';
        $query = $this->bdd->preparation($sql);
        $query->execute([$postId]);
        $query->setFetchMode(PDO::FETCH_CLASS, '\App\Entity\\Image');
        return $query->fetch();
    }

    /**
     * Inserts a new image during the creation of a blog post
     * 
     * @param Image $image
     * @param int $postId
     * 
     * @return void
     */
    public function setImage(Image $image, $postId): void
    {
        $sql = 'INSERT INTO ' . $this->table . ' (url, alt_text, name, post_id) VALUES (?, ?, ?, ?)';
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $image->getUrl(),
            $image->getAltText(),
            $image->getName(),
            $postId
        ]);
    }
}