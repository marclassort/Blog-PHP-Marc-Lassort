<?php 

namespace App\Entity;
use App\Core\Entity;

class Comment extends Entity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $content;

    /**
     * @var mixed
     */
    private $creationDate;

    /**
     * @var bool
     */
    private $isValid;

    /**
     * @param array $data Data used with the comment form 
     */
    public function __construct(array $data = []) 
    {
        parent::__construct($data);
        $this->isValid = false;
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getCreationDate(): mixed
    {
        return $this->creationDate;
    }

    /**
     * @return bool
     */
    public function getIsValid(): bool
    {
        return $this->isValid;
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
     * @param string $username 
     * @return void 
     */
    public function setUsername($username)
    {
        $this->username = $username; 
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
     * @param mixed $creationDate 
     * @return void 
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate; 
    }

    /**
     * @param bool $isValid 
     * @return void 
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid; 
    }
}