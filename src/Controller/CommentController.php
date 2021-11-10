<?php

namespace App\Controller;

use App\Core\Session;
use App\Entity\Comment;
use App\Entity\Post;
use Core\BaseController;
use App\Repository\CommentManager;
use App\Repository\PostManager;
use App\Repository\UserManager;
use App\Services\SessionHandler;

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

        $postManager = new PostManager('post', 'Post');
        $post = $postManager->getPost($postId);

        $commentManager = new CommentManager('comment', 'Comment', 'user');
        $comments = $commentManager->getAllCommentsForABlogPost($postId);

        $username = $session->get('username');

        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
        $date = strftime('%d %B %Y - %Hh%M');

        $userManager = new UserManager('user', 'User');
        $user = $userManager->getByMail($session->get('email'));

        if (!empty($_POST))
        {
            $comment = new Comment($_POST);
            $post = new Post($_POST);

            $commentManager = new CommentManager('comment', 'Comment');
            $commentManager->postComment($comment, $user, $postId);

            $sessionHandler = new SessionHandler();

            $sessionHandler->checkSession();

            if ($sessionHandler)
            {
                echo "Votre commentaire va être soumis à validation";
                $this->redirect('blog');
            } 
        }
        
        $this->render('post/post.html.twig', [
            "post" => $post,
            "comments" => $comments,
            "username" => $username,
            "date" => $date,
            "user" => $user
        ]);
    }

    public function validateComment()
    {
        if ($_SESSION['token'] == $_POST['token'])        
        {
            $commentManager = new CommentManager('comment', 'Comment');
            $commentManager->validateComment($_POST['idComment']);

            $this->redirect('gerer-commentaires');
        } else
        {
            $this->redirect('403');
        }  
    }

    public function invalidateComment()
    {
        if ($_SESSION['token'] == $_POST['token'])
        {
            $commentManager = new CommentManager('comment', 'Comment');
            $commentManager->invalidateComment($_POST['idComment']);

            $this->redirect('gerer-commentaires');
        } else
        {
            $this->redirect('403');
        }  
    }
}