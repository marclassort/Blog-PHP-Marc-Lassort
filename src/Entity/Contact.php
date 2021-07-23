<?php 

namespace Entity;

class Contact 
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

    public function __construct(int $id, string $a, mixed $cd, string $s, string $c, string $e, bool $i) 
    {
        $this->id = $id;
        $this->author = $a;
        $this->creationDate = $cd;
        $this->subject = $s;
        $this->content = $c;
        $this->emailAddress = $e;
        $this->isHandled = $i;
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