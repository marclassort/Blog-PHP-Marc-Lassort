<?php

namespace App\Controller;

use Core\BaseController;
use App\Repository\PostManager;

class HomeController extends BaseController 
{

    public function home() 
    {
        $postManager = new PostManager('post', 'Post');

        $posts = $postManager->getAllPosts();
        
        return $this->render('frontend/home.html.twig', [
            "posts" => $posts
        ]);
    }

    public function aPropos()
    {
        $this->render('frontend/a-propos.html.twig', []);
    }
}