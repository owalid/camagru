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
    <?php
        if ($images)
        {
    ?>
        <section class="columns">
            <div class="column"></div>
            <div class="column">
                <article class="card is-rounded">
                    <div class="card-content">
                        <div class="field">
                            <div class="">
                                <div class="hovereffect padding-20-bottom">
                                    <div class="columns is-gapless">
                                        <div class="column is-vcentered">
                                            <figure class="image is-32x32">
                                                <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                                            </figure>
                                        </div>
                                        <div class="column is-11 is-vcentered">
                                            <p>Lorem</p>
                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="padding-20-bottom">
                                    <div class="columns">
                                        <div class="column">
                                            <figure class="image">
                                                <img src="https://bulma.io/images/placeholders/128x128.png">
                                                <p class="has-text-weight-semibold">Aimé par 100 personnes</p>
                                            </figure>
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing 
                                                elit. Rem ut nihil ipsa quidem. Vitae ratione, 
                                                voluptates sequi architecto odio aliquam alias 
                                                itaque? Culpa, nesciunt sequi? Sunt architecto 
                                                praesentium deserunt dolor?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hero-foot">
                                        <div class="columns is-gapless">
                                        <div class="column is-vcentered">
                                            <figure class="image is-32x32">
                                                <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png">
                                            </figure>
                                        </div>
                                        <div class="column is-11 is-vcentered">
                                            <span class="has-text-weight-semibold">lorem</span> lorem lorem lorem lorem lorem</p>
                                        </div>
                                        </div>
                                      
                                        <hr />
                                        <form action="">
                                            <div class="field has-addons">
                                                <div class="control is-expanded">
                                                    <input class="input is-rounded is-fullwidth" type="text" name="" id="" placeholder="Ajouter  un commentaire....">
                                                </div>
                                                <div class="control">
                                                    <button class="button is-rounded is-primary" type="submit">Publier</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="column"></div>
                </section>
    <?php    
    }
    else
    {
    ?>
    <p class="text-center">Il n'y as pas encore de photos publie la premiere photo 😎</p>
    <?php
    }
    ?>
</body>
</html>