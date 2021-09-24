<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Core\BaseController;
use App\Repository\CommentManager;

class CommentController extends BaseController
{

    public function comment() 
    {
        $commentManager = new CommentManager('comment', 'Comment');

        $comments = $commentManager->getAllComments();
        
        return $this->render('frontend/comment.html.twig', [
            "comments" => $comments
        ]);
    }

    public function postComment()
    {
        $comment = new Comment($_POST);
        $user = new User($_POST);
        $post = new Post($_POST);

        if (!empty($_POST))
        {
            $commentManager = new CommentManager('comment', 'Comment');
            $commentManager->postComment($comment, $user, $post);
        }

        return $this->render('frontend/comment.html.twig', []);
    }
}