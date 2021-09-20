<?php

namespace App\Controller;

use Core\BaseController;
use App\Entity\Post;   
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
        
        $this->render('backend/postForm.html.twig', []);
    }

    public function listPosts()
    {
        $postManager = new PostManager('post', 'Post');
        $imageManager = new ImageManager('image', 'Image');

        $posts = $postManager->getAllPosts();
        $images = $imageManager->getImages();

        $this->render('backend/postList.html.twig', [
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
            $post->setTitle($_POST['title']);
            $post->setBlurb($_POST['blurb']);
            $post->setContent($_POST['content']);
            $post->setAuthor($_POST['author']);
            $post->setImageName($_POST['imageName']);
            $post->setImageAlt($_POST['imageAlt']);
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

    public function deconnect()
    {
        session_destroy();
        header('Location: /');
        return $this->render('frontend/home.html.twig');
    }
}