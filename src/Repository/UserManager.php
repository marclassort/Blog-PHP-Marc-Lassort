<?php

namespace App\Repository;

use App\Entity\User;
use Core\Database;
use PDO;
use Ramsey\Uuid\Uuid;

class UserManager
{
    protected ?string $table;
    protected $object;
    protected string $entity;
    protected string $user;
    protected $bdd;
    
    public const SELECTQUERY = 'SELECT * FROM ';
    public const UPDATEQUERY = 'UPDATE ';

    public function __construct($table, $object)
    {
        $this->table = $table;
        $this->object = $object;
        $this->bdd = Database::getInstance();
    }

    /**
     * Retrieves the list of all registered users 
     * 
     * @return mixed
     */
    public function getAllUsers()
    {
        $sql = self::SELECTQUERY . $this->table;
        $query = $this->bdd->preparation($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Retrives the last user who registered to the blog
     * 
     * @return mixed
     */
    public function getLastUserAdded()
    {
        $sql = self::SELECTQUERY . $this->table . " ORDER BY ID DESC LIMIT 1";
        $query = $this->bdd->preparation($sql);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'App\Entity\User');
        return $query->fetch();
    }

    /**
     * Retrieves a specific user with his email address
     * 
     * @param string $email
     * 
     * @return mixed
     */
    public function getByMail($email)
    {
        $sql = self::SELECTQUERY . $this->table . " WHERE email = ?";
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $email  
        ]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'App\Entity\User');
        return $query->fetch();
    }

    /**
     * Returns a new random token 
     * 
     * @return Uuid
     */
    public function getToken()
    {
        $token = Uuid::uuid4();
        $token->toString();

        return $token;
    }

    /**
     * Retrieves a specific user from his token
     * 
     * @param string $token
     * 
     * @return mixed
     */
    public function getUserByToken($token)
    {
        $sql = self::SELECTQUERY . $this->table . ' WHERE token = ?';
        $query = $this->bdd->preparation($sql);
        $query->execute([$token]);
        $query->setFetchMode(PDO::FETCH_CLASS, '\App\Entity\User');
        return $query->fetch();
    }

    /**
     * Adds a new user 
     * 
     * @param User $user
     * 
     * @return void
     */
    public function addUser(User $user): void
    {
        $sql = "INSERT INTO " . $this->table . " (username, first_name, last_name, phone_number, email, password, role, token, isActive, image) VALUES (?, ?, ?, ?, ?, ?, 0, ?, 0, ?)";
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $user->getUsername(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getPhoneNumber(),
            $user->getEmail(),
            $user->getPassword(),
            $this->getToken(),
            $user->getImage()
        ]);
    }

    /**
     * Edits information about a specific user
     * 
     * @param User $user
     * 
     * @return void
     */
    public function editUser(User $user): void
    {
        $sql = self::UPDATEQUERY . $this->table . " SET username = ?, first_name = ?, last_name = ?, phone_number = ?, email = ?, password = ?, image = ? WHERE id = ?";
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $user->getUsername(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getPhoneNumber(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getImage(),
            $user->getId()
        ]);
    }

    /**
     * Changes the status of a specific user into active
     * 
     * @param User $user
     * 
     * @return void
     */
    public function setActiveModeForUser(User $user): void
    {
        $sql = self::UPDATEQUERY . $this->table . " SET isActive = 1 WHERE id = ?";
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $user->getId()
        ]);
    }

    /**
     * Creates a new token for a specific user
     * 
     * @param User $user
     * 
     * @return void
     */
    public function createNewTokenForUser(User $user): void
    {        
        $sql = self::UPDATEQUERY . $this->table . " SET token = ? WHERE id = ?";
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $this->getToken(),
            $user->getId()
        ]);
    }

    /**
     * Changes a specific user's password
     * 
     * @param User $user
     * 
     * @return void
     */
    public function setNewPassword(User $user): void
    {
        $sql = self::UPDATEQUERY . $this->table . " SET password = ?, token = NULL WHERE id = ?";
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $user->getPassword(),
            $user->getId()
        ]);
    }
}