<?php

class MultipleRouteFoundException extends Exception
{
    public function __construct($message = "Plus d'une route a été trouvée")
    {
        parent::__construct($message, "0001");
    }
}