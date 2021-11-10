<?php

namespace App\Services;

use App\Core\Session;
use Core\BaseController;

class SessionHandler extends BaseController
{
    public function checkSession()
    {
        $session = new Session();

        if ($session->get('id') != NULL && $session->get('email') != NULL)
        {
            return true;
        } 
        
        return false;
    }

    public function checkAdmin()
    {
        $session = new Session();

        if ($session->get('id') != NULL && $session->get('email') != NULL && $session->get('isActive') == 1)
        {
            return true;
        } 

        return false;
    }
}