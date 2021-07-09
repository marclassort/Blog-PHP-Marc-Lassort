<?php

namespace App\Controller;

use Core\BaseController;
use Repository\PostManager;

class PostController extends BaseController
{

    private PostManager $postManager;

    public function post(string $slug = 1) {

        $post = $this->postManager->getPost($slug);

        return $this->render('frontend/blog.html.twig', [
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
            return $this->render('errors/404.html.twig');
        }
    }
    
}