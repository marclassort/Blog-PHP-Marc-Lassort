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
        $string = "Blog pro de Marc Lassort";

        return $this->render('backend/admin.html.twig', [
            "string" => $string
        ]);
    }

    public function createPost()
    {
        $post = new Post($_POST);
        // $image = new Image($_POST);

        if (!empty($_POST))
        {
            $postManager = new PostManager('post', 'Post');
            $postManager->createPost($post);

            // $imageManager = new ImageManager('image', 'Image');
            // $imageManager->setImage($image, 1);

            return $this->redirect('liste-articles');
        }
        
        return $this->render('backend/postForm.html.twig', []);
    }

    public function listPosts()
    {
        $string = "Blog pro de Marc Lassort";

        $postManager = new PostManager('post', 'Post');
        $imageManager = new ImageManager('image', 'Image');

        $posts = $postManager->getAllPosts();
        $images = $imageManager->getImages();

        return $this->render('backend/postList.html.twig', [
            "string" => $string,
            "posts" => $posts,
            "images" => $images
        ]);
    }

    public function editPost($idPost)
    {
        // récupérer en BDD le post à modifier (stocker dans la variable $post et le passer au render)
        $postManager = new PostManager('post', 'Post');
        $post = $postManager->getPost($idPost);
        $imageManager = new ImageManager('image', 'Image');
        $image = $imageManager->getImage($idPost);

        // vérifier que le formulaire a été soumis et valide (méthodes de BaseController) -> if 
        if ($this->isSubmitted('editInput') && $this->isValid($post))
        {   
            $postManager->editPost($post);
            // je set le contenu, le titre, etc. 
            // $post->setTitle($idPost)
            //     ->setBlurb()
            //     ->setContent()
            //     ->setAuthor();

            // envoyer ces valeurs en BDD

            
            // Appeler sa méthode pour update en base de données et faire passer le $post en paramètre 
            // return à la fin du if et redirect du BaseController vers le tableau des posts (? message flash)
            return $this->redirect('liste-articles');
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

        return $this->redirect('liste-articles');
    }

    public function manageComments()
    {
        $string = "Blog pro de Marc Lassort";

        $commentManager = new CommentManager('comment', 'Comment');

        $comments = $commentManager->getAllComments();

        return $this->render('backend/manageComments.html.twig', [
            "string" => $string,
            "comments" => $comments
        ]);
    }

    public function profile()
    {
        return $this->render('backend/profile.html.twig');
    }
}