<?php

class Controller
{
    public function getRoute(string $action): string
    {
        $path = 'resources/views/' . $action . '.php';

        if (file_exists($path)) {
            return $path;
        }

        return 'resources/views/create.php';
    }
}
