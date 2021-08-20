<?php

namespace App\Controller;

use Core\BaseController;
use App\Repository\PostManager;
use App\Repository\ImageManager;

class BlogController extends BaseController 
{

    public function blog() 
    {
        $string = "Marc Lassort";

        $postManager = new PostManager('post', 'Post');
        $imageManager = new ImageManager('image', 'Image');

        $posts = $postManager->getAllPosts();
        $images = $imageManager->getImages();
        
        return $this->render('frontend/blog.html.twig', [
            "string" => $string,
            "posts" => $posts,
            "images" => $images
        ]);
    }
}