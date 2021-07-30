<?php

namespace App\Controller;

use Core\BaseController;
use App\Repository\CommentManager;

class CommentController extends BaseController
{

    public function comment() 
    {
        $string = "Marc Lassort";

        $postManager = new CommentManager('comment', 'Comment');

        $comments = $postManager->getAllComments();
        
        return $this->render('frontend/comment.html.twig', [
            "string" => $string,
            "comments" => $comments
        ]);
    }
}