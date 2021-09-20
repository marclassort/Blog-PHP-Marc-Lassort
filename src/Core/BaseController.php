<?php

namespace Core;

use Core\Response\Response;
use ViewNotFoundException;

require CORE_DIR . '/vendor/autoload.php';

class BaseController
{
    protected $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(VIEW_DIR . '//');
        $this->twig = new \Twig\Environment($loader, ['debug' => true]);
    }

    protected function render($filename, $array = [])
	{
		if (file_exists(VIEW_DIR . '//' . $filename))
		{
            $this->twig->addGlobal('Session', $_SESSION);
            $view = $this->twig->load($filename);
            $content = $view->render($array);
            $response = new Response($content);
            
            return $response->send();
            
		} else
		{
			throw new ViewNotFoundException();	
		}
	}

    public function redirect(string $path)
    {
        header("Location: /" . $path);
        exit();
    }

    public function isSubmitted(string $submit)
    {
        if (isset($_POST[$submit]))
        {
            return true;
        }
        return false;
    }

    public function isValid(object $data)
    {
        $isValid = true;

        foreach ($data as $value)
        {
            if ($value == NULL || !isset($value) || empty($value))
            {
                $isValid = false;
            }
        }
        return $isValid;
    }

    public function hydrate($object, $values = null)
    {
        if ($values != null)
        {
            foreach ($values as $key => $value)
            {
                $elements = explode('_', $key);
                $newKey = '';

                foreach ($elements as $element)
                {
                    $newKey .= ucfirst($element);
                }
                $method = 'set' . ucfirst($newKey);

                if (method_exists($object, $method))
                {
                    $object->$method($value);
                }
            }
            return $this;
        }
        return false;
    }
}