<?php 

namespace Entity;

class Image 
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

    public function __construct(int $id, string $u, string $a, string $n)
    {
        $this->id = $id;
        $this->url = $u;
        $this->altText = $a;
        $this->name = $n;
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
}