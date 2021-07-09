<?php

namespace App\Controller;

use Core\BaseController;

class UserController extends BaseController {

    public function register()
    {
        return $this->render('frontend/register.html.twig');
    }

    public function password()
    {
        return $this->render('frontend/forgot-password.html.twig');
    }

    public function login()
    {
        return $this->render('frontend/login.html.twig');
    }

    public function authenticate($login, $password)
    {
        $this->UserManager->getByMail($login, $password);
    }
    
}