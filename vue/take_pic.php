<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
<link rel="stylesheet" href="../style/style.css?ts=<?=time()?>">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
<header>
<?php
    require_once('component/navbar_top.html');
?>
</header>
    <section class="container padding-100-top">
        <div class="columns">
            <div class="column">

                <div class="hero is-fullheight is-medium is-black"></div>
                <div class="level">
                    <div class="level-left">
                        <button class="button is-primary">Prendre une photo</button>
                    </div>
                    <div class="level-right">
                        <button class="button is-primary">Importer une photo</button>
                    </div>
                </div>
            </div>
            <div class="column">
                <figure class="image">
                    <img src="https://bulma.io/images/placeholders/128x128.png">
                    <p class="has-text-weight-semibold">selectionner un filtre</p>
                </figure>
            </div>
        </div>
        <p class="has-text-weight-semibold">img.jpg
        <i class="fas fa-trash"></i> </p>
        <form action="">
            <input class="input" type="text-area" placeholder="Description" value="">
            <button class="button is-primary">Publier</button>
        </form>
    </section>
<footer>
<?php
    require_once('component/navbar_bottom.html');
?>
</footer>
</body>
<script src="../script/burger.js"></script>
</html>