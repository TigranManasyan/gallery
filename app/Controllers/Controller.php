<?php

namespace App\Controllers;

class Controller
{
    protected function render($view, $data = []) {
        extract($data);
//        set_include_path(__DIR__ . "/../");

        include("./../views/$view.php");
    }
}