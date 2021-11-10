<?php
namespace App\Core;

use Pecee\SimpleRouter\SimpleRouter;

class Router
{
    /**
     * @var string
     */
    private $controllerPath;

    /**
     * @var SimpleRouter
     */
    private $router;

    /**
     * @param string $viewPath
     */
    public function __construct(string $controllerPath)
    {
        $this->controllerPath = $controllerPath;
        $this->router = new SimpleRouter();
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

    public function run(): self
    {
        require CONF_DIR . DIRECTORY_SEPARATOR . 'routes.php';
        $match = $this->router->match();
        
        if(is_array($match)) {
            $view = $match['target'];
            require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.html.twig';
            return $this;
        } else {
            require $this->controllerPath . DIRECTORY_SEPARATOR . 'HomeController.php';
            return $this;
        }
        return $this;
    }

    public function runFunction()
    {
        require CONF_DIR . DIRECTORY_SEPARATOR . 'routes.php';
        return $this->router->match();
    }
}