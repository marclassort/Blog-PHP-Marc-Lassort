<?php

namespace App\Controller;

use Core\BaseController;
use App\Repository\PostManager;

class PostController extends BaseController
{

    private PostManager $postManager;

    public function post(string $slug) {

        $post = $this->postManager->getPost($slug);

        $this->render('frontend/blog.html.twig', [
            "post" => $post
        ]);
    }

    public function registerPost($form)
    {
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->redirect('/');
        } else 
        {
            $this->render('errors/404.html.twig');
        }
    }
    
}