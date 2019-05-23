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
        $usr = $img->getUsrPosted($img->getIdUsr());
        // $usr = $img->getUsrPosted();
        // TODO GETCOMMENT
        $comment = $img->getAllComment($img->getIdImg());
        // var_dump($comment);
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
                                                <img class="is-rounded" src="<?= $usr['pp']  ?>">
                                            </figure>
                                        </div>
                                        <div class="column is-11 is-vcentered">
                                            <p><?= $usr['login'] ?></p>
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
                                            </figure>
                                            <!-- <div class="columns padding-10">
                                                <div class="column is-7"> -->
                                                <div class="buttons is-centered is-vcentered padding-10-top">
                                                    <a class="button is-rounded">
                                                    <span class="icon has-text-danger is-small">
                                                        <i class="fas fa-heart"></i>
                                                    </span>
                                                </a>
                                                    <a class="button is-rounded">
                                                    <span class="icon is-small">
                                                        <i class="fas fa-comment-alt"></i>
                                                    </span>
                                                </a>
                                               </div>
                                                <!-- <div class="column"> --> 
                                                    <p class="has-text-weight-semibold">Aimé par <?=$img->getNbLike()?> personnes</p>
                                                <!-- </div> -->
                                            <!-- </div> -->
                                            <p><span class="has-text-weight-semibold"><?= $usr['login'] ?></span>: <?= $img->getDescription()?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="hero-foot">
                                       
                                        <?php
                                        if ($comment)
                                        {
                                            foreach($comment as $com)
                                            {
                                                ?>
                                                <div class="columns is-gapless">
                                                <div class="column is-vcentered">
                                            <figure class="image is-32x32">
                                                <img class="is-rounded" src="<?= $com['pp']?>">
                                            </figure>
                                        </div>
                                        <div class="column is-11 is-vcentered">
                                            <span class="has-text-weight-semibold"><?= $com['user']?></span><?=  $com['commentaire'] ?></p>
                                        </div>
                                        <br />
                                        </div>
                                        <?php 
                                         }
                                        }
                                        else
                                        {
                                            ?>
                                        <div class="column is-11 is-vcentered">
                                            <span class="has-text-weight-semibold">Pas de commentaire 🤷‍♂️</p>
                                        </div>
                                        <?php
                                        }
                                            ?>
                                        <hr />
                                        <form method="post" action="<?=URL?>?url=image&comment=yes&idImg=<?=$img->getIdImg()?>">
                                            <div class="field has-addons">
                                                <div class="control is-expanded">
                                                    <input class="input is-rounded is-fullwidth" type="text" name="commentaire" id="" placeholder="Ajouter un commentaire...." required>
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