<?php

namespace App\Services;

use App\Core\Session;
use App\Repository\CommentManager;
use App\Repository\PostManager;
use App\Repository\UserManager;
use Core\BaseController;

class SessionHandler extends BaseController
{
    public function checkSession($postId)
    {
        $session = new Session();

        if ($session->get('id') != NULL && $session->get('email') != NULL)
        {
            return true;
        } else
        {
            return false;
        }
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