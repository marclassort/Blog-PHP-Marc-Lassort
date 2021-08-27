<?php 

namespace App\Entity;
use App\Core\Entity;

class Post extends Entity
{

    /**
     * @var int
     */
    public $id;

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
    private $creation_date;

    /**
     * @var mixed 
     */
    private $modif_date;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $imageName;

    /**
     * @var string
     */ 
    private $imageAlt;

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
        return $this->creation_date;
    }

    /**
     * @return string|null
     */
    public function getModifDate(): ?string
    {
        return $this->modif_date;
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
     * @return string
     */
    public function getImageName(): string
    {
        return $this->imageName;
    }

    /**
     * @return string
     */
    public function getImageAlt(): string
    {
        return $this->imageAlt;
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
     * @param mixed $creation_date 
     * @return void 
     */
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date; 
    }

    /**
     * @param mixed $modif_date 
     * @return void 
     */
    public function setModifDate($modif_date)
    {
        $this->modif_date = $modif_date; 
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

    /**
     * @param string $imageName 
     * @return void 
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName; 
    }

    /**
     * @param string $imageAlt 
     * @return void 
     */
    public function setImageAlt($imageAlt)
    {
        $this->imageAlt = $imageAlt; 
    }
}