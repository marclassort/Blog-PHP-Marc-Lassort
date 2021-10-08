<?php

namespace App\Controller;

use App\Core\Session;
use App\Entity\Comment;
use App\Entity\Post;
use Core\BaseController;
use App\Repository\CommentManager;
use App\Repository\UserManager;

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

    public function postComment()
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
        }

        $this->render('frontend/post.html.twig', [
            
        ]);
    }

    public function validateComment($idComment)
    {
        $commentManager = new CommentManager('comment', 'Comment');
        $commentManager->validateComment($idComment);

        $this->redirect('gerer-commentaires');
    }

    public function invalidateComment($idComment)
    {
        $commentManager = new CommentManager('comment', 'Comment');
        $commentManager->invalidateComment($idComment);

        $this->redirect('gerer-commentaires');
    }
}