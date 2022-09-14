<?php

class Controller
{
    public function getRoute(string $page, string $action): string
    {
        $path = 'resources/views/' .$page.'/' . $action . '.php';

        if (file_exists($path)) {
            return $path;
        }

        return 'resources/views/properties/index.php';
    }
}