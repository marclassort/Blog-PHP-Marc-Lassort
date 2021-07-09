<?php

namespace Core;

use Pecee\SimpleRouter\SimpleRouter;

class Router extends SimpleRouter
{
    public static function start(): void
    {
        require_once CONF_DIR . '/helpers.php';
        require_once CONF_DIR . '/routes.php';
        parent::start();
    }
}