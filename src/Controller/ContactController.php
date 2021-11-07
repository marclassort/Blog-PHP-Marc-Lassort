<?php

namespace App\Controller;

use App\Core\Session;
use App\Entity\Contact;
use App\Repository\CommentManager;
use App\Repository\ContactManager;
use Core\BaseController;

class ContactController extends BaseController 
{

    public function contact() 
    {
        $contactManager = new ContactManager('contact', 'Contact');
        $contact = new Contact($_POST);

        if ($this->isSubmitted('contactInput') && $this->isValid($contact))
        {
            $contact->setAuthor($_POST['name']);
            $contact->setEmailAddress($_POST['email']);
            $contact->setSubject($_POST['subject']);
            $contact->setContent($_POST['message']);
            $contactManager->sendContact($contact);
            $this->redirect('');
        }

        $this->render('frontend/contact.html.twig', []);
    }

    public function answerContact($idContact)
    {
        $contactManager = new ContactManager('contact', 'Contact');
        $contactManager->sendEmail($idContact);

        $this->redirect('gerer-les-contacts');
    }

    public function displayContactList()
    {
        $contactManager = new ContactManager('contact', 'Contact');
        $contacts = $contactManager->getContactList();

        $commentManager = new CommentManager('comment', 'Comment', 'post');
        $comments = $commentManager->getAllComments();

        $this->render('backend/manageContacts.html.twig', [
            "contacts" => $contacts,
            "comments" => $comments
        ]);
    }

    public function validateContact($idContact, $token)
    {
        $session = new Session();
        $tokenCheck = $session->get('token');

        if ($token == $tokenCheck)
        {
            $contactManager = new ContactManager('contact', 'Contact');
            $contactManager->validateContact($idContact);

            $this->redirect('gerer-les-contacts');
        } else
        {
            $this->redirect('403');
        }
    }

    public function invalidateContact($idContact, $token)
    {
        $session = new Session();
        $tokenCheck = $session->get('token');

        if ($token == $tokenCheck)
        {
            $contactManager = new ContactManager('contact', 'Contact');
            $contactManager->invalidateContact($idContact);

            $this->redirect('gerer-les-contacts');
        } else
        {
            $this->redirect('403');
        }
    }
}