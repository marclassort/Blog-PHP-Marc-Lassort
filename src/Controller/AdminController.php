<?php

namespace App\Controller;

use Core\BaseController;
use App\Entity\Post;   
use App\Entity\Image;
use App\Repository\CommentManager;
use App\Repository\ImageManager;
use App\Repository\PostManager;

class AdminController extends BaseController
{

    public function admin() 
    {

        return $this->render('backend/admin.html.twig', []);
    }

    public function createPost()
    {
        $post = new Post($_POST);

        if (!empty($_POST))
        {
            $postManager = new PostManager('post', 'Post');
            $postManager->createPost($post);

            $this->redirect('liste-articles');
        }
        
        return $this->render('backend/postForm.html.twig', []);
    }

    public function listPosts()
    {
        $postManager = new PostManager('post', 'Post');
        $imageManager = new ImageManager('image', 'Image');

        $posts = $postManager->getAllPosts();
        $images = $imageManager->getImages();

        return $this->render('backend/postList.html.twig', [
            "posts" => $posts,
            "images" => $images
        ]);
    }

    public function editPost($idPost)
    {
        $postManager = new PostManager('post', 'Post');
        $post = $postManager->getPost($idPost);
        $imageManager = new ImageManager('image', 'Image');
        $image = $imageManager->getImage($idPost);

        if ($this->isSubmitted('editInput') && $this->isValid($post))
        {   
            $postManager->editPost($post);
            $this->redirect('liste-articles');
        }

        return $this->render('backend/postEdit.html.twig', [
            "post" => $post,
            "image" => $image
        ]);
    }

    public function deletePost($idPost)
    {
        $postManager = new PostManager('post', 'Post');
        $postManager->deletePost($idPost);

        $this->redirect('liste-articles');
    }

    public function manageComments()
    {
        $commentManager = new CommentManager('comment', 'Comment');

        $comments = $commentManager->getAllComments();

        return $this->render('backend/manageComments.html.twig', [
            "comments" => $comments
        ]);
    }

    public function profile()
    {
        return $this->render('backend/profile.html.twig');
    }
}