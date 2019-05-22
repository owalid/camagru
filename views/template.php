<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $t ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
<link rel="stylesheet" href="style/style.css?ts=<?=time()?>">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
<header class="padding-150-bottom">
<?php
    require_once('component/navbar_top.php');
?>
</header>
<?= $content ?>
<footer>
<?php
    require_once('component/navbar_bottom.php');
?>
</footer>
</body>
<script src="./script/burger.js"></script>
<script src="./script/picture.js"></script>
</html>