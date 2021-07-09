<?php

namespace App\Controller;

use Core\BaseController;
use Repository\PostManager;

class HomeController extends BaseController 
{

    public function home() 
    {
        $string = "Marc Lassort";

        $postManager = new PostManager('post', 'Post');

        $posts = $postManager->getAllPosts();
        
        return $this->render('frontend/home.html.twig', [
            "string" => $string,
            "posts" => $posts
        ]);
    }

}