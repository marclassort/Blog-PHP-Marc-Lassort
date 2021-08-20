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
     * Find all images
     */
    public function getImages()
    {
        $sql = self::SELECTQUERY . $this->table;
        $query = $this->bdd->preparation($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Find a specific image
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
     * Insert a new image during the creation of a blog post
     */
    public function setImage(Image $image, $postId)
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