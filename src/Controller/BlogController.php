<?php

namespace App\Controller;

use Core\BaseController;
use App\Repository\PostManager;

class BlogController extends BaseController 
{

    public function blog() 
    {
        $string = "Marc Lassort";

        $postManager = new PostManager('post', 'Post');

        $posts = $postManager->getAllPosts();
        
        return $this->render('frontend/blog.html.twig', [
            "string" => $string,
            "posts" => $posts
        ]);
    }
}