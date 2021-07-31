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

    /**
     * @param array $data Data used with the comment form 
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
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

    /**
     * @param int $id 
     * @return void 
     */
    public function setId($id)
    {
        $this->id = $id; 
    }

    /**
     * @param string $title 
     * @return void 
     */
    public function setTitle($title)
    {
        $this->title = $title; 
    }

    /**
     * @param string $blurb 
     * @return void 
     */
    public function setBlurb($blurb)
    {
        $this->blurb = $blurb; 
    }

    /**
     * @param mixed $creationDate 
     * @return void 
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate; 
    }

    /**
     * @param mixed $modifDate 
     * @return void 
     */
    public function setModifDate($modifDate)
    {
        $this->modifDate = $modifDate; 
    }

    /**
     * @param string $content 
     * @return void 
     */
    public function setContent($content)
    {
        $this->content = $content; 
    }

    /**
     * @param string $author 
     * @return void 
     */
    public function setAuthor($author)
    {
        $this->author = $author; 
    }
}