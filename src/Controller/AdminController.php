<?php

namespace App\Controller;

use App\Core\Session;
use Core\BaseController;
use App\Entity\Post;   
use App\Repository\CommentManager;
use App\Repository\ContactManager;
use App\Repository\ImageManager;
use App\Repository\PostManager;
use App\Repository\UserManager;
use App\Services\SessionHandler;

class AdminController extends BaseController
{

    public function admin() 
    {
        $session = new SessionHandler();
        $checkAdmin = $session->checkAdmin();

        if (!$checkAdmin)
        {
            $this->redirect('');
        }

        $postManager = new PostManager('post', 'Post');
        $posts = $postManager->getAllPosts();
        $imageManager = new ImageManager('image', 'Image');
        $images = $imageManager->getAllImages();
        $userManager = new UserManager('user', 'User');
        $users = $userManager->getAllUsers();
        $contactManager = new ContactManager('contact', 'Contact');
        $contacts = $contactManager->getContactList();
        $commentManager = new CommentManager('comment', 'Comment', 'post');
        $comments = $commentManager->getAllComments();
        $validatedComments = $commentManager->getValidatedComments();

        $this->render('backend/admin.html.twig', [
            "posts" => $posts,
            "images" => $images,
            "users" => $users,
            "contacts" => $contacts,
            "comments" => $comments,
            "validatedComments" => $validatedComments
        ]);
    }

    public function createPost()
    {
        $post = new Post($_POST);
        $userManager = new UserManager('user', 'User');
        $users = $userManager->getAllUsers();

        if ($this->isSubmitted('createInput') && $this->isValid($post))
        {
            $postManager = new PostManager('post', 'Post');
            $postManager->createPost($post);

            $this->redirect('liste-articles');
        }

        $contactManager = new ContactManager('contact', 'Contact');
        $contacts = $contactManager->getContactList();
        $commentManager = new CommentManager('comment', 'Comment', 'post');
        $comments = $commentManager->getAllComments();

        $this->render('backend/postForm.html.twig', [
            "contacts" => $contacts,
            "comments" => $comments,
            "users" => $users
        ]);
    }

    public function listPosts()
    {
        $postManager = new PostManager('post', 'Post');
        $imageManager = new ImageManager('image', 'Image');

        $posts = $postManager->getAllPosts();
        $images = $imageManager->getAllImages();

        $contactManager = new ContactManager('contact', 'Contact');
        $contacts = $contactManager->getContactList();
        $commentManager = new CommentManager('comment', 'Comment', 'post');
        $comments = $commentManager->getAllComments();

        $this->render('backend/postList.html.twig', [
            "contacts" => $contacts,
            "comments" => $comments,
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
        $userManager = new UserManager('user', 'User');
        $users = $userManager->getAllUsers();

        if ($this->isSubmitted('editInput') && $this->isValid($post))
        {   
            $post->setTitle($_POST['title']);
            $post->setBlurb($_POST['blurb']);
            $post->setContent($_POST['content']);
            $post->setAuthor($_POST['author']);
            $post->setUserId($_POST['author']);
            $post->setImageName($_POST['imageName']);
            $post->setImageAlt($_POST['imageAlt']);
            $postManager->editPost($post);
            $this->redirect('liste-articles');
        }

        $contactManager = new ContactManager('contact', 'Contact');
        $contacts = $contactManager->getContactList();
        $commentManager = new CommentManager('comment', 'Comment', 'post');
        $comments = $commentManager->getAllComments();

        $this->render('backend/postEdit.html.twig', [
            "post" => $post,
            "image" => $image,
            "users" => $users,
            "contacts" => $contacts,
            "comments" => $comments
        ]);
    }

    public function deletePost($idPost, $token)
    {
        $session = new Session();
        $tokenCheck = $session->get('token');

        if ($token == $tokenCheck)
        {
            $postManager = new PostManager('post', 'Post');
            $postManager->deletePost($idPost);
    
            $this->redirect('liste-articles');
        } else
        {
            $this->redirect('403');
        }
    }

    public function manageComments()
    {
        $commentManager = new CommentManager('comment', 'Comment', 'post');
        $comments = $commentManager->getAllComments();

        $contactManager = new ContactManager('contact', 'Contact');
        $contacts = $contactManager->getContactList();

        $this->render('backend/manageComments.html.twig', [
            "comments" => $comments,
            "contacts" => $contacts
        ]);
    }
}