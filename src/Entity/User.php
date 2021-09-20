<?php 

namespace App\Entity;
use App\Core\Entity;

class User extends Entity
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
    public $password;

    /**
     * @var bool
     */
    private $role;

    /**
     * @var string
     */
    public $token;

    /**
     * @var bool
     */
    public $isActive;

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
    public function getFirstNameSQL(): string
    {
        return $this->first_name;
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
    public function getLastNameSQL(): string
    {
        return $this->last_name;
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
     * @return bool|null
     */
    public function getRole(): bool
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return bool|null
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
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
     * @param string $firstName 
     * @return void 
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName; 
    }

    /**
     * @param string $lastName 
     * @return void 
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName; 
    }

    /**
     * @param string $lastName 
     * @return void 
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber; 
    }

    /**
     * @param string $email 
     * @return void 
     */
    public function setEmail($email)
    {
        $this->email = $email; 
    }

    /**
     * @param string $password 
     * @return void 
     */
    public function setPassword($password)
    {
        $this->password = $password; 
    }

    /**
     * @param bool $role 
     * @return void 
     */
    public function setRole($role)
    {
        $this->role = $role; 
    }

    /**
     * @param string $token 
     * @return void 
     */
    public function setToken($token)
    {
        $this->token = $token; 
    }

    /**
     * @param bool $isActive 
     * @return void 
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive; 
    }
}