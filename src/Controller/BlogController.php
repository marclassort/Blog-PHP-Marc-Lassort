<?php

namespace App\Controller;

use Core\BaseController;
use App\Repository\PostManager;
use App\Repository\ImageManager;
use Cocur\Slugify\Slugify;
use App\Services\SessionHandler;

class BlogController extends BaseController 
{

    public function blog() 
    {
        $postManager = new PostManager('post', 'Post');
        $imageManager = new ImageManager('image', 'Image');

        $posts = $postManager->getAllPosts();
        $images = $imageManager->getImages();

        $titles = array_column($posts, 'title');

        $slugify = new Slugify();
        $slugs = array();

        foreach ($titles as $title) {
            $slugs[] = $slugify->slugify($title, '-');
        }
        
        $this->render('frontend/blog.html.twig', [
            "posts" => $posts,
            "images" => $images,
            "slugs" => $slugs
        ]);
    }

    public function openPost($postId)
    {
        $sessionHandler = new SessionHandler();
        $sessionHandler->checkSession($postId);
    }
}