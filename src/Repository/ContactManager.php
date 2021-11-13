<?php

namespace App\Repository;

use App\Entity\Contact;
use App\Services\Mailer;
use Core\BaseController;
use Core\Database;
use PDO;

class ContactManager extends BaseController
{
    protected ?string $table;
    protected ?string $secondTable;
    protected $object;
    protected string $entity;
    protected string $contact;
    protected $bdd;
    
    public function __construct($table, $object, $secondTable = NULL)
    {
        $this->table = $table;
        $this->object = $object;
        $this->secondTable = $secondTable;
        $this->bdd = Database::getInstance();
    }

    /**
     * Adds contact messages written from the blog into the database and sends a mail to the admin
     * 
     * @param Contact $contact
     * 
     * @return void
     */
    public function sendContact(Contact $contact): void
    {
        $mailer = new Mailer();

        $sql = "SELECT email FROM " . $this->secondTable . " WHERE role = 1 LIMIT 1";
        $query = $this->bdd->preparation($sql);
        $query->execute();
        $admin = $query->fetch();

        $subject = "Contact";
        $body = "<p>Bonjour,</p>Vous avez reçu le message suivant de : " . $contact->getAuthor() . "</p><p><strong>Adresse email</strong> : " . $contact->getEmailAddress() . "</p><p><strong>Sujet</strong> : " . $contact->getSubject() . "</p><p><strong>Contenu</strong> : " . $contact->getContent() . "</p><p>Connectez-vous sur l'interface d'administration pour y répondre,</p><p>Le blog de Marc Lassort</p>";

        $mailer->sendEmail($admin[0], $subject, $body);

        $sql = "INSERT INTO " . $this->table . " (author, creation_date, subject, content, email_address, is_handled, user_id) VALUES (?, NOW(), ?, ?, ?, 0, 22)";
        $query = $this->bdd->preparation($sql);
        $query->execute([
            $contact->getAuthor(),
            $contact->getSubject(),
            $contact->getContent(),
            $contact->getEmailAddress()
        ]);
    }

    /**
     * Gets the full list of contact messages sent from the blog
     * 
     * @return mixed
     */
    public function getContactList()
    {
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->bdd->preparation($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Gets a specific contact from an identifier
     * 
     * @param int $idContact
     * 
     * @return mixed
     */
    public function getContactById($idContact)
    {
        $sql = 'SELECT author, subject, email_address FROM '. $this->table . ' WHERE id = ?';
        $query = $this->bdd->preparation($sql);
        $query->execute([$idContact]);
        return $query->fetch();
    }

    /**
     * Validates a contact message from the admin section
     * 
     * @param int $idContact
     * 
     * @return void
     */
    public function validateContact($idContact): void
    {
        $sql = 'UPDATE ' . $this->table . ' 
                SET is_handled = 1
                WHERE id = :id';
        $query = $this->bdd->preparation($sql);
        $query->bindValue(':id', $idContact);
        $query->execute();
    }

    /**
     * Invalidates a contact message from the admin section
     * 
     * @param int $idContact
     * 
     * @return void
     */
    public function invalidateContact($idContact): void
    {
        $sql = 'UPDATE ' . $this->table . ' 
                SET is_handled = 0
                WHERE id = :id';
        $query = $this->bdd->preparation($sql);
        $query->bindValue(':id', $idContact);
        $query->execute();
    }

    /**
     * Answers to a contact message by sending an email from the admin section
     * 
     * @param int $idContact
     * 
     * @return void
     */
    public function sendEmail($idContact): void
    {
        $contactManager = new ContactManager('contact', 'Contact');

        $contactById = $contactManager->getContactById($idContact);
        
        if ($this->isSubmitted('mailInput'))
        {
            $mailer = new Mailer();

            $subject = "Réponse contact - " . $contactById['subject'];
            $body = "<p>Bonjour " . $contactById['author'] . ",</p><p>" . $_POST['textMail'] . "</p><p>Marc Lassort</p>";

            $mailer->sendEmail($contactById['email_address'], $subject, $body);
                        
            $this->redirect('gerer-les-contacts');
        } else 
        {
            $this->redirect('gerer-les-contacts');
        }
    }
}