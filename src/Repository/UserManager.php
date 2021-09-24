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

    public function getAllUsers()
    {
        $sql = self::SELECTQUERY . $this->table;
        $query = $this->bdd->preparation($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    public function getLastUserAdded()
    {
        $sql = self::SELECTQUERY . $this->table . " ORDER BY ID DESC LIMIT 1";
        $query = $this->bdd->preparation($sql);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'App\Entity\User');
        return $query->fetch();
    }

    public function getByMail($email)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = ?";
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $email  
        ]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'App\Entity\User');
        return $query->fetch();
    }

    public function getToken()
    {
        $token = Uuid::uuid4();
        $token->toString();

        return $token;
    }

    public function getUserByToken($token)
    {
        $sql = self::SELECTQUERY . $this->table . ' WHERE token = ?';
        $query = $this->bdd->preparation($sql);
        $query->execute([$token]);
        $query->setFetchMode(PDO::FETCH_CLASS, '\App\Entity\User');
        return $query->fetch();
    }

    public function addUser(User $user)
    {
        $sql = "INSERT INTO " . $this->table . " (username, first_name, last_name, phone_number, email, password, role, token, isActive) VALUES (?, ?, ?, ?, ?, ?, 0, ?, 0)";
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $user->getUsername(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getPhoneNumber(),
            $user->getEmail(),
            $user->getPassword(),
            $this->getToken()
        ]);
    }

    public function setActiveModeForUser(User $user)
    {
        $sql = self::UPDATEQUERY . $this->table . " SET isActive = 1 WHERE id = ?";
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $user->getId()
        ]);
    }

    public function createNewTokenForUser(User $user)
    {        
        $sql = self::UPDATEQUERY . $this->table . " SET token = ? WHERE id = ?";
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $this->getToken(),
            $user->getId()
        ]);
    }

    public function setNewPassword(User $user)
    {
        $sql = self::UPDATEQUERY . $this->table . " SET password = ? WHERE id = ?";
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $user->getPassword(),
            $user->getId()
        ]);
    }
}