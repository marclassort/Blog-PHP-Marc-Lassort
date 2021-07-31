<?php 

namespace Entity;

use App\Core\Entity;

class Image extends Entity
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $altText;

    /**
     * @var string
     */
    private $name;

    /**
     * @param array $data Data used with the comment form 
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getAltText(): string
    {
        return $this->altText;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
     * @param string $url 
     * @return void 
     */
    public function setUrl($url)
    {
        $this->url = $url; 
    }

    /**
     * @param string $altText 
     * @return void 
     */
    public function setAltText($altText)
    {
        $this->altText = $altText; 
    }

    /**
     * @param string $name 
     * @return void 
     */
    public function setName($name)
    {
        $this->name = $name; 
    }
}