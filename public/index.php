<?php
session_start();

use Pecee\SimpleRouter\SimpleRouter;

define('CORE_DIR', realpath(dirname(__DIR__)));
define('CONF_DIR', realpath(dirname(__DIR__ )) . '/config');
define('SRC_DIR', realpath(dirname(__DIR__ )) . '/src');
define('CONTROLLER_DIR', realpath(dirname(__DIR__)) . '/src/Controller');
define('VIEW_DIR', realpath(dirname(__DIR__ )) . '/view');
define('PUBLIC_DIR', realpath(dirname(__DIR__)) . '/public');

require_once(CORE_DIR . '/vendor/autoload.php');
require_once(CONF_DIR . '/routes.php');
require_once(CONF_DIR . '/helpers.php');

SimpleRouter::setDefaultNamespace('\App\Controller');
SimpleRouter::start();