<?php
namespace App\Core;

use AltoRouter;

class Router
{
    /**
     * @var string
     */
    private $controllerPath;

    /**
     * @var AltoRouter
     */
    private $router;

    /**
     * @param string $viewPath
     */
    public function __construct(string $controllerPath)
    {
        $this->controllerPath = $controllerPath;
        $this->router = new AltoRouter();
    }

    /**
     * @param string $route
     * @param mixed $target
     * @param $name
     */
    public function get(string $route, mixed $target, ?string $name = null): self
    {
        $this->router->map('GET', $route, $target, $name);
        return $this;
    }

    public function setBasePath()
    {
        $this->router->setBasePath('/');
        return $this;
    }

    /**
     * @param string $name
     * @return string
     */
    private function getControllerName(string $name): string
    {
        $controllerName = ucfirst($name) . 'Controller';
        $namespace = 'App\\Controller\\';

        return $namespace . $controllerName;
    }

    private function getController($route)
    {
        $controller = $this->getControllerName($route); 
        return $controller;
    }

    private function manageRoute()
    {

    }

    public function run(): self
    {
        require_once CONF_DIR . DIRECTORY_SEPARATOR . 'routes.php';
        $match = $this->router->match();
        
        if(is_array($match)) {
            $view = $match['target'];
            // require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.html.twig';
            return $this;
        } else {
            require $this->controllerPath . DIRECTORY_SEPARATOR . 'HomeController.php';
            return $this;
        }
        return $this;
    }

    public function runFunction()
    {
        require_once CONF_DIR . DIRECTORY_SEPARATOR . 'routes.php';
        return $this->router->match();
    }
}