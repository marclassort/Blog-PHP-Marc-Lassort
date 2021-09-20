<?php

namespace App\Controller;

use App\Repository\CommentManager;
use Core\BaseController;
use App\Repository\PostManager;
use App\Repository\ImageManager;
use Cocur\Slugify\Slugify;

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
        
        return $this->render('frontend/blog.html.twig', [
            "posts" => $posts,
            "images" => $images,
            "slugs" => $slugs
        ]);
    }

    public function openPost($postId)
    {
        $postManager = new PostManager('post', 'Post');
        $commentManager = new CommentManager('comment', 'Comment');

        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
        $date = strftime('%d %B %Y - %Hh%M');

        $post = $postManager->getPost($postId);
        $comments = $commentManager->getAllCommentsForABlogPost($postId);

        return $this->render('post/post.html.twig', [
            "post" => $post,
            "comments" => $comments,
            "date" => $date
        ]);
    }
}