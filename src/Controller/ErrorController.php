<?php

namespace App\Controller;

use Core\BaseController;

class ErrorController extends BaseController
{  

    public function error404()
    {
        $string = "Erreur";
        return $this->render('errors/404.html.twig', [
            "string" => $string
        ]);
    }

    public function error403()
    {
        $string = "Erreur";
        return $this->render('errors/403.html.twig', [
            "string" => $string
        ]);
    }

    public function error405()
    {
        $string = "Erreur";
        return $this->render('errors/405.html.twig', [
            "string" => $string
        ]);
    }

    public function error500()
    {
        $string = "Erreur";
        return $this->render('errors/500.html.twig', [
            "string" => $string
        ]);
    }

}