<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $data['title']; ?></title>

        <link rel="stylesheet" href="./css/style.css">
        <script src="./js/jQuery.js"></script>

    </head>
    <body>
        <header>
            <?php
                if(isset($_SESSION['user'])) {
                    require "_nav_bar.php";
                }
            ?>
        </header>