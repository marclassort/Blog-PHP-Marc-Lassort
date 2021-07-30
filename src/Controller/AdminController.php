<?php

namespace App\Controller;

use Core\BaseController;
use Entity\Post;
use Repository\CommentManager;
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
        // $string = "Blog pro de Marc Lassort";

        // $post = new Post();
        // $this->hydrate($post, $_POST);

        // return $this->render('backend/postForm.html.twig', [
        //     "string" => $string
        // ]);

        // if (!empty($_POST))
        // {
        //     $this->postManager->createPost($_POST);
        // }
        
        return $this->render('backend/postForm.html.twig', []);
    }

    public function listPosts()
    {
        $postManager = new PostManager('post', 'Post');

        $posts = $postManager->getAllPosts();

        return $this->render('backend/postList.html.twig', [
            "posts" => $posts
        ]);
    }

    public function editPost($idPost)
    {
        // récupérer en BDD le post à modifier (stocker dans la variable $post et le passer au render)
        $postManager = new PostManager('post', 'Post');
        $post = $postManager->getPost($idPost);
        
        // vérifier que le formulaire a été soumis et valide (méthodes de BaseController) -> if 
        if ($this->isValid($post) && $this->isSubmitted('editInput'))
        {
            // on rentre dans le if, il faut hydrater l'objet avec les nouvelles valeurs du form 
            // je set le contenu, le titre, etc. 
            $post->setContent();

            // envoyer ces valeurs en BDD
            
            // Appeler sa méthode pour update en base de données et faire passer le $post en paramètre 
            // return à la fin du if et redirect du BaseController vers le tableau des posts (? message flash)
            return $this->redirect('liste-articles');
        }

        return $this->render('backend/postEdit.html.twig', [
            "post" => $post
        ]);
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