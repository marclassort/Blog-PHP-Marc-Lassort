<?php 

namespace App\Entity;
use App\Core\Entity;

class Post extends Entity
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $blurb;

    /**
     * @var mixed
     */
    private $creationDate;

    /**
     * @var mixed 
     */
    private $modifDate;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $author;

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBlurb(): string
    {
        return $this->blurb;
    }

    /**
     * @return string|null
     */
    public function getCreationDate(): ?string
    {
        return $this->creationDate;
    }

    /**
     * @return string|null
     */
    public function getModifDate(): ?string
    {
        return $this->modifDate;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }
}