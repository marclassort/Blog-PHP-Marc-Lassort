<?php
namespace App\Core;

use AltoRouter;

class Router
{
    /**
     * @var string
     */
    private $viewPath;

    /**
     * @var AltoRouter
     */
    private $router;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new AltoRouter();
    }

    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);
        return $this;
    }

    public function run(): self
    {
        // require_once CONF_DIR . '/routes.php';
        $match = $this->router->match();
        if(is_array($match)) {
            $view = $match['target'];
            ob_start();
            $content = ob_get_clean();
            require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.html.twig';
            return $this;
        } else {
            require $this->viewPath . DIRECTORY_SEPARATOR . 'templates/template.html.twig';
            return $this;
        }
        return $this;

    }
}