<?php

namespace App\Repository;

use App\Entity\Contact;
use Core\Database;
use PDO;

class ContactManager
{
    protected ?string $table;
    protected $object;
    protected string $entity;
    protected string $contact;
    protected $bdd;
    
    public function __construct($table, $object)
    {
        $this->table = $table;
        $this->object = $object;
        $this->bdd = Database::getInstance();
    }

    public function sendContact(Contact $contact)
    {
        $sql = "INSERT INTO " . $this->table . " (author, creation_date, subject, content, email_address, is_handled, user_id) VALUES (?, NOW(), ?, ?, ?, 0, 22)";
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $contact->getAuthor(),
            $contact->getSubject(),
            $contact->getContent(),
            $contact->getEmailAddress()
        ]);
    }

    public function getContactList()
    {
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->bdd->preparation($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS);
    }
}