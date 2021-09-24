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
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
        $date = strftime('%d %B %Y - %Hh%M');

        $session = new Session();

        $userManager = new UserManager('user', 'User');
        $user = $userManager->getByMail($session->get('email'));

        $postManager = new PostManager('post', 'Post');
        $post = $postManager->getPost($postId);

        $commentManager = new CommentManager('comment', 'Comment');
        $comments = $commentManager->getAllCommentsForABlogPost($postId);

        $username = $session->get('username');

        if ($session->get('id') != NULL && $session->get('email') != NULL)
        {
            $this->render('post/post.html.twig', [
                "post" => $post,
                "comments" => $comments,
                "username" => $username,
                "date" => $date,
                "user" => $user
            ]);
        } else
        {
            $this->render('post/post.html.twig', [
                "post" => $post,
                "date" => $date
            ]);
        }
    }

    // public function checkAdmin()
    // {
    //     $session = new Session();

    //     if ($session->get('id') != NULL && $session->get('email') != NULL && $session->get('admin') == 1)
    //     {
    //         $this->render('backend/admin.html.twig');
    //     } else
    //     {
    //         $this->redirect('');
    //         $this->render('frontend/home.html.twig');
    //     }
    // }
}