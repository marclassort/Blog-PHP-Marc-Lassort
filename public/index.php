<?php
require '../vendor/autoload.php';

define('CORE_DIR', realpath(dirname(__DIR__)));
define('CONF_DIR', realpath(dirname(__DIR__ )) . '/config');
define('SRC_DIR', realpath(dirname(__DIR__ )) . '/src');
define('CONTROLLER_DIR', realpath(dirname(__DIR__)) . '/src/Controller');
define('VIEW_DIR', realpath(dirname(__DIR__ )) . '/view');
define('PUBLIC_DIR', realpath(dirname(__DIR__)) . '/public');

$router = new App\Core\Router(dirname(__DIR__) . '/view');
$router->get('/blog', 'post/index', 'blog')
        ->get('/blog/category', 'category/show', 'category')
        ->get('/', 'templates/template', '')
        ->get('/home', 'frontend/home', 'home')
        ->run();