<?php

class ActionNotFoundException extends Exception
{
    public function __construct($message = "Aucune action n'a été trouvée")
    {
        parent::__construct($message, "0005");
    }
}