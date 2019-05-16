<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <link rel="stylesheet" href="style/style.css?ts=<?=time()?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<header>
    <?php
    //verif si l'user est log
    require_once('vue/component/navbar_top.html');
    ?>
</header>
<section class="section text-center">
    <div class="container">
            <h1 class="title">
                Bienvenu sur Camagru
            </h1>
            <p class="subtitle">
                Veuillez vous connectez ou créer un compte 😎
            </p>
            <div class="buttons padding-50-top is-centered is-vcentered">
                <a class="button is-primary ">
                    <strong>Se connecter</strong>
                </a>
                <a class="button is-primary">
                    <strong>Créer un compte</strong>
                </a>
            </div>
</div>
  </section>
<footer>
<?php
//verif si l'user est log
    require_once('vue/component/navbar_bottom.html');
?>
</footer>
</body>
</html>