<?php
    session_start();
    header("Access-Control-Allow-Origin: *");
    require "../autoload.php";
    require "./../app/Helpers.php";
    require "../config/database.php";
    require "../config/views.php";
    $views_path = VIEWS_PATH;
    $router = require '../routes/web.php';