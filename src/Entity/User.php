<?php 

namespace Entity;

class User 
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
    private $firstName; 

    /**
     * @var string
     */
    private $lastName; 

    /**
     * @var string
     */
    private $phoneNumber; 

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var array
     */
    private $role;

    public function __construct(string $un, string $fn, string $ln, string $pn, string $e, string $p, array $r)
    {

        $this->username = $un;
        $this->firstName = $fn;
        $this->lastName = $ln;
        $this->phoneNumber = $pn;
        $this->email = $e;
        $this->password = $p;
        $this->role = $r;

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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function getRole(): array
    {
        return $this->role;
    }
}