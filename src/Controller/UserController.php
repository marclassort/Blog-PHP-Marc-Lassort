<?php

namespace App\Controller;

use App\Core\Session;
use App\Repository\UserManager;
use App\Services\LoginHandler;
use Core\BaseController;

class UserController extends BaseController {

    public function registerMyAccount()
    {
        $register = new LoginHandler();
        
        $register->register();
    }

    public function registered()
    {
        $this->render('frontend/registered.html.twig', []);
    }
    
    public function verifyEmailAddress($token)
    {
        $verify = new LoginHandler();

        $verify->verifyEmailAddress($token);
    }

    public function password()
    {
        $this->render('frontend/forgot-password.html.twig', []);
    }

    public function sendEmailForNewPassword()
    {
        $sendEmail = new LoginHandler();

        $sendEmail->createNewTokenAndSendEmailForNewPassword();
    }

    public function createNewPassword($token)
    {
        $createNewPassword = new LoginHandler();

        $createNewPassword->createNewPassword($token);
    }

    public function login()
    {
        $this->render('frontend/login.html.twig', []);
    }

    public function authenticate()
    {        
        $userManager = new UserManager('user', 'User');
        $user = $userManager->getByMail($_POST['email']);

        $authenticate = new LoginHandler();

        $adminCheck = $authenticate->checkLogin($user);

        if ($adminCheck)
        {
            $this->redirect('admin');
        }
    }

    public function profile()
    {
        $userManager = new UserManager('user', 'User');
        $session = new Session();
        $mail = $session->get('email');
        $user = $userManager->getByMail($mail);

        if ($this->isSubmitted('profileInput'))
        {
            $user->setUsername($_POST['username']);
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->setFirstName($_POST['first-name']);
            $user->setLastName($_POST['last-name']);
            $user->setPhoneNumber($_POST['phone']);

            if (isset($_POST['image']) && !empty($_POST['image']))
            {
                $user->setImage($_POST['image']);
            }
            $userManager->editUser($user);
            $this->redirect('profil');
        } 
        $this->render('frontend/profile.html.twig', [
            "user" => $user
        ]);
    }

    public function deconnect()
    {
        session_destroy();
        $this->redirect('');
    }
}