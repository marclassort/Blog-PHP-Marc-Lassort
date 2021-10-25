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
        $session = new Session();
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

        $this->render('frontend/contact.html.twig', [
            "session" => $session
        ]);
    }

    public function manageContacts()
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

}