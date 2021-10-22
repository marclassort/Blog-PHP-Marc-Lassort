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
    private $first_name; 

    /**
     * @var string
     */
    private $last_name; 

    /**
     * @var string
     */
    private $phone_number; 

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
     * @var string
     */
    public $image;

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
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phone_number;
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
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
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
     * @param string $first_name 
     * @return void 
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name; 
    }

    /**
     * @param string $lastName 
     * @return void 
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name; 
    }

    /**
     * @param string $lastName 
     * @return void 
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number; 
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
     * @param string $image
     * @return void
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
}