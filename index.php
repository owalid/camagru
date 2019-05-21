<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
<link rel="stylesheet" href="/style/style.css?ts=<?=time()?>">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
<header>
<?php
    require_once('views/component/navbar_top.html');
?>
</header>
    <?php
        require_once('controllers/Router.php');
        $router = new Router();
        $router->routeReq();
        // require_once('vue/index_not_logged.php');
        // require_once('vue/index_logged.php');
    ?>
<footer>
<?php
    require_once('views/component/navbar_bottom.html');
?>
</footer>
</body>
<script src="./script/burger.js"></script>
<script src="./script/picture.js"></script>
</html>