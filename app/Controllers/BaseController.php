<?php
namespace App\Controllers;

class BaseController
{
    public function renderView($viewName, $data = [])
    {
        $viewPath = __DIR__ . "/../Views/{$viewName}.phtml";
        if (file_exists($viewPath)) {
            require_once $viewPath;
        }
    }
}
