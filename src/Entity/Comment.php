<?php 

namespace Entity;

class Comment 
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

    public function __construct(int $id, string $u, string $c, mixed $cd, bool $i) 
    {
        $this->id = $id;
        $this->username = $u;
        $this->content = $c;
        $this->creationDate = $cd;
        $this->isValid = $i;
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
}