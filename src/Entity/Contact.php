<?php 

namespace App\Entity;
use App\Core\Entity;

class Contact extends Entity
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $author;

    /**
     * @var mixed
     */
    private $creationDate;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var bool
     */
    private $isHandled;

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
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getCreationDate(): mixed
    {
        return $this->creationDate;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
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
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @return bool
     */
    public function getIsHandled(): bool
    {
        return $this->isHandled;
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
     * @param string $author 
     * @return void 
     */
    public function setAuthor($author)
    {
        $this->author = $author; 
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
     * @param string $subject 
     * @return void 
     */
    public function setSubject($subject)
    {
        $this->subject = $subject; 
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
     * @param string $emailAddress 
     * @return void 
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress; 
    }

    /**
     * @param bool $isHandled 
     * @return void 
     */
    public function setIsHandled($isHandled)
    {
        $this->isHandled = $isHandled; 
    }

}