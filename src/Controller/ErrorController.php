<?php

namespace App\Controller;

use Core\BaseController;

class ErrorController extends BaseController
{

    // public function show($exception)
    // {
    //     $this->addParam("exception", $exception);
    // }

    public function error()
    {
        $string = "Erreur";
        return $this->render('errors/404.html.twig', [
            "string" => $string
        ]);
    }

}