<?php

class ViewNotFoundException extends Exception
{
    public function __construct($message = "Aucune vue n'a été trouvée")
    {
        parent::__construct($message, "0003");
    }
}