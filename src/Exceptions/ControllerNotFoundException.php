<?php

class ControllerNotFoundException extends Exception
{
    private $httpRequest; 

    public function __construct($httpRequest, $message = "Aucun contrôleur n'a été trouvé")
    {
        $this->httpRequest = $httpRequest;
        parent::__construct($message, "0006");
    }

    public function getMoreDetail()
    {
        return "Le contrôleur '" . $this->httpRequest->getUrl() . "' n'a pas été trouvé avec la méthode '" . $this->httpRequest->getMethod() . "'"; 
    }
}