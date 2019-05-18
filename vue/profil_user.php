<!DOCTYPE html>
<html lang="en">
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
        <!-- card User -->
        <div class="hero is-medium is-bold">
            <div class="hero-body">
                    <article class="card is-rounded">
                        <div class="card-content">
                            <div class="columns is-centered">
                                <div class="column">
                                    <figure class="image is-128x128">
                                        <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                                    </figure>
                                    <p> Nb publications: 50</p>
                                </div>
                                <div class="column">
                                    <p class="subtitle">
                                        name
                                    </p>
                                    <p class="subtitle">
                                        Bio: Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure 
                                        harum corrupti ratione animi enim eius, saepe quia tenetur nisi 
                                        sequi consequuntur porro aperiam nesciunt similique, earum ab 
                                        suscipit blanditiis at.
                                    </p>
                                </div>
                                <div class="column">
                                    <div class="buttons is-centered">                            
                                        <button class="button is-primary">
                                            Modifier le profil
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </article>
            </div>
        </div>
        <div class="hero">
            <div class="hero-body">
                    <article class="card is-rounded">
                        <div class="card-content">
                            <div class="columns is-centered">
                                <div class="column">
                                    <div class="tabs">
                                        <ul>
                                            <li class="is-active"><a>Photos</a></li>
                                            <li><a>Enrengistrements</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="columns is-3 is-mobile is-multiline">
                                    <div class="column">
                                        <div>
                                        <div class="hovereffect padding-20-bottom">
                                                <img src="https://bulma.io/images/placeholders/320x480.png">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="hovereffect padding-20-bottom">
                                            <img src="https://bulma.io/images/placeholders/320x480.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div>
                                        <div class="hovereffect padding-20-bottom">
                                                <img src="https://bulma.io/images/placeholders/320x480.png">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="hovereffect padding-20-bottom">
                                            <img src="https://bulma.io/images/placeholders/320x480.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <div>
                                            <div class="hovereffect padding-20-bottom">
                                            <img src="https://bulma.io/images/placeholders/320x480.png">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="hovereffect padding-20-bottom">
                                            <img src="https://bulma.io/images/placeholders/320x480.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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