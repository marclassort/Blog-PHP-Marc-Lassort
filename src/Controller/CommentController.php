<?php

namespace App\Controller;

use App\Core\Session;
use App\Entity\Comment;
use App\Entity\Post;
use Core\BaseController;
use App\Repository\CommentManager;
use App\Repository\UserManager;
use App\Services\SessionHandler as ServicesSessionHandler;

class CommentController extends BaseController
{

    public function comment() 
    {
        $commentManager = new CommentManager('comment', 'Comment');

        $comments = $commentManager->getAllComments();
        
        $this->render('frontend/comment.html.twig', [
            "comments" => $comments
        ]);
    }

    public function postComment($postId)
    {
        $session = new Session();

        $userManager = new UserManager('user', 'User');
        $user = $userManager->getByMail($session->get('email'));

        $comment = new Comment($_POST);
        $post = new Post($_POST);

        if (!empty($_POST))
        {
            $commentManager = new CommentManager('comment', 'Comment');
            $commentManager->postComment($comment, $user, $post);

            echo 'Votre commentaire va être soumis à validation';
        }

        $sessionHandler = new ServicesSessionHandler();
        $sessionHandler->checkSession($postId);
    }

    public function validateComment($idComment, $token)
    {
        $session = new Session();
        $tokenCheck = $session->get('token');

        if ($token == $tokenCheck)
        {
            $commentManager = new CommentManager('comment', 'Comment');
            $commentManager->validateComment($idComment);

            $this->redirect('gerer-commentaires');
        } else
        {
            $this->redirect('403');
        }  
    }

    public function invalidateComment($idComment, $token)
    {
        $session = new Session();
        $tokenCheck = $session->get('token');

        if ($token == $tokenCheck)
        {
            $commentManager = new CommentManager('comment', 'Comment');
            $commentManager->invalidateComment($idComment);

            $this->redirect('gerer-commentaires');
        } else
        {
            $this->redirect('403');
        }  
    }
}