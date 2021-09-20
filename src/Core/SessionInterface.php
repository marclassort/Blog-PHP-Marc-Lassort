<?php

namespace App\Core;

interface SessionInterface
{
    public function get(string $key, $default = null);

    public function set(string $key, $value);
    
    public function delete(string $key);
}