<?php

namespace App\Controller;

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
        $login = new LoginHandler();

        $login->createNewTokenAndSendEmailForNewPassword();
    }

    public function verifyEmailForNewPassword($token)
    {
        $login = new LoginHandler();

        $login->verifyEmailAddressForNewPassword($token);
    }

    public function sendEmailAndPasswordInformation()
    {
        $login = new LoginHandler();

        $login->createNewPassword();
    }

    public function newPasswordRegistered()
    {
        $login = new LoginHandler();

        $login->createNewPassword();
    }

    public function login()
    {
        $this->render('frontend/login.html.twig', []);
    }

    public function authenticate()
    {        
        $userManager = new UserManager('user', 'User');
        $user = $userManager->getByMail($_POST['email']);

        $login = new LoginHandler();

        $adminCheck = $login->checkLogin($user);

        if ($adminCheck)
        {
            $this->redirect('admin');
        }
    }
}