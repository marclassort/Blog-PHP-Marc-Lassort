<?php

namespace App\Controller;

use Core\BaseController;

class ProjectsController extends BaseController 
{

    public function projects() {
        return $this->render('frontend/projets.html.twig');
    }

}