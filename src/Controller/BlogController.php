<?php

namespace App\Controller;

use App\Core\Session;
use App\Repository\CommentManager;
use Core\BaseController;
use App\Repository\PostManager;
use App\Repository\ImageManager;
use App\Repository\UserManager;
use Cocur\Slugify\Slugify;
use App\Services\SessionHandler;

class BlogController extends BaseController 
{

    public function blog() 
    {
        $postManager = new PostManager('post', 'Post');
        $imageManager = new ImageManager('image', 'Image');

        $posts = $postManager->getAllPosts();
        $images = $imageManager->getAllImages();

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
        $session = new Session();

        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
        $date = strftime('%d %B %Y - %Hh%M');

        $userManager = new UserManager('user', 'User');
        $user = $userManager->getByMail($session->get('email'));

        $postManager = new PostManager('post', 'Post');
        $post = $postManager->getPost($postId);

        $commentManager = new CommentManager('comment', 'Comment', 'user');
        $comments = $commentManager->getAllCommentsForABlogPost($postId);

        $username = $session->get('username');

        $sessionHandler = new SessionHandler();

        $sessionHandler->checkSession($postId);

        if ($sessionHandler)
        {
            $this->render('post/post.html.twig', [
                "post" => $post,
                "comments" => $comments,
                "username" => $username,
                "date" => $date,
                "user" => $user
            ]);
        } else
        {
            $this->render('post/post.html.twig', [
                "post" => $post,
                "comments" => $comments,
                "date" => $date
            ]);
        }
    }
}