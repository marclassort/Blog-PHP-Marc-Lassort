<?php

namespace App\Controller;

use Core\BaseController;
use App\Repository\PostManager;

class HomeController extends BaseController 
{

    public function home() 
    {
        $string = "Marc Lassort";

        // $postManager = new PostManager('post', 'Post');

        // $posts = $postManager->getAllPosts();
        
        return $this->render('frontend/home.html.twig', [
            "string" => $string//,
            // "posts" => $posts
        ]);
    }

    public function aPropos()
    {
        $string = "Marc Lassort";

        return $this->render('frontend/a-propos.html.twig', [
            "string" => $string
        ]);
    }
}