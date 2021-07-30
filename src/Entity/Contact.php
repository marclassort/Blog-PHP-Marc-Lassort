<?php 

namespace Entity;

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

}