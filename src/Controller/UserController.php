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

    public function deconnect()
    {
        session_destroy();
        $this->redirect('');
    }
}