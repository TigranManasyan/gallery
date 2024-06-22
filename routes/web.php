<?php
    use App\Controllers\LoginController;
    use App\Controllers\RegisterController;
    use App\Controllers\ProfileController;
    use App\Controllers\ImageController;
    use App\Routes\Router;

    $router = new Router();

    $router->get('/', LoginController::class, "index");
    $router->post('/login/post', LoginController::class, "login");
    $router->get('/register', RegisterController::class, "index");
    $router->post('/register/post', RegisterController::class, "register");

    if(isset($_SESSION['user'])) {
        $router->post('/photos/store', ImageController::class, "store");
        $router->get('/profile', ProfileController::class, "index");
        $router->get('/photos', ImageController::class, "index");
        $router->get('/getPhotos', ImageController::class, "get_images");

        //for ajax


        $router->get('/logout', LoginController::class, "logout");
    }
    $router->dispatch();