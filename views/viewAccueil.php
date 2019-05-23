	<?php
	if ($user)
	{
		session_start();
		$_SESSION['user'] = $user;
		// var_dump($user);
		// die();
		// session_start();
		// var_dump($_SESSION['user']);
		// die();
	}
	if ($images)
	{
     foreach($images as $img)
    {
        //  TODO GETUSRPOSTER
        // $usr = $img->getUsrPosted();
        // TODO GETCOMMENT
        // $comment = $img->getComment();
        // var_dump();
        // die();

        // var_dump($images->get_);
        // die();
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
                                                <img src="<?=$img->getImg()?>">
                                                <p class="has-text-weight-semibold">Aimé par <?=$img->getNbLike()?> personnes</p>
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
            ?>
    <?php    
    }
    else
    {
        ?>
    <p class="text-center">Il n'y as pas encore de photos publie la premiere photo 😎</p>
    <?php
    }
    ?>