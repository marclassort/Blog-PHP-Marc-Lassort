<?php

class PropertyNotFoundException extends Exception
{
    private $className;
    private $property;

    public function __construct($className, $property, $message = "Aucune propriété n'a été trouvée")
    {
        $this->className = $className;
        $this->property = $property;
        parent::__construct($message, "0004");
    }

    public function getMoreDetail()
    {
        return "La propriété " . $this->property . " n'existe pas dans la classe " . $this->className;
    }
}