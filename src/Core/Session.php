<?php

namespace App\Core;

class Session implements SessionInterface
{
    private function isSessionActive()
    {
        if (session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
    }

    public function get(string $key, $default = null)
    {
        if (array_key_exists($key, $_SESSION))
        {
            return $_SESSION[$key];
        }
        return $default;
    }

    public function set(string $key, $value)
    {
        $this->isSessionActive();
        $_SESSION[$key] = $value;
    }

    public function delete(string $key)
    {
        $this->isSessionActive();
        unset($_SESSION[$key]);
    }
}