<!DOCTYPE html>
<<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <link rel="stylesheet" href="../style/style.css?ts=<?=time()?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<header>
        <?php
            require_once('component/navbar_top.html');
        ?>
</header>
<div class="container">
    <div class="hero is-medium is-bold">
        <div class="hero-body">
            <article class="card is-rounded">
                    <div class="card-content">
                        <div class="tabs">
                            <ul>
                                <li class="is-active"><a>Modifier le profil</a></li>
                                <li><a>Changer de mot de passe</a></li>
                                <li><a>Notifications E-mail</a></li>
                            </ul>
                        </div>
                       <?php
                        // require_once('component/modif_profil_user.html');
                        // require_once('component/modif_passwd.html');
                        require_once('component/modif_notif_mail.html');
                       ?>
                    </div>
            </article>
        </div>
    </div>
</div>
<footer>
<?php
    require_once('component/navbar_bottom.html');
?>
</footer>
</body>
</html>