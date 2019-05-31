<?php
	if ($user)
	{
		session_start();
        $_SESSION['user'] = $user;
	}
	if ($images)
	{
    if ($msg)
    {?>
        <article class="message is-success text-center">
        <div class="message-body">
            <?= $msg ?>
        </div>
        </article>
        <?php
    }
    if ($err)
    {?>
        <article class="message is-danger text-center">
        <div class="message-body">
            <?= $err ?>
        </div>
        </article>
        <?php
    }
        foreach($images as $img)
        {
            $usr = $img->getUsrPosted($img->getIdUsr());
            $comment = $img->getAllComment($img->getIdImg());
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
                                            <figure class="image is-64x64">
                                                <img class="is-rounded" src="<?=$usr->getPp()?>">
                                            </figure>
                                        </div>
                                        <div class="column is-7 is-vcentered">
                                            <p><?= $usr->getLogin() ?></p>
                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="padding-20-bottom">
                                    <div class="columns">
                                        <div class="column">
                                            <figure class="image">
                                                <img ondblclick="like(<?= $img->getIdImg()?>)" src="<?=$img->getImg()?>">
                                            </figure>
                                                <div class="buttons is-centered is-vcentered padding-10-top">
                                                    <a class="button is-rounded" href="<?=URL?>?url=image&like=yes&idImg=<?=$img->getIdimg()?>">
                                                    <span class="icon has-text-danger is-small">
                                                        <i class="fas fa-heart"></i>
                                                    </span>
                                                    </a>
                                                    <a class="button is-rounded" href="#comment<?=$img->getIdImg()?>">
                                                    <span class="icon is-small">
                                                        <i class="fas fa-comment-alt"></i>
                                                    </span>
                                                    </a>
                                                    <a class="button is-rounded" href="<?=URL?>?url=image&save=yes&idImg=<?=$img->getIdImg()?>">
                                                    <span class="icon is-small">
                                                        <i class="fas fa-bookmark"></i>
                                                    </span>
                                                    </a>
                                               </div>
                                                    <p class="has-text-weight-semibold">Aimé par <?=$img->getNbLike()?> personnes</p>
                                            <p><span class="has-text-weight-semibold"><?= $usr->getLogin() ?></span>: <?= $img->getDescription()?></p>
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
                                                <div class="columns is-gapless is-vcentered">
                                                <div class="column is-vcentered">
                                                    <figure class="image is-32x32">
                                                        <img class="is-rounded" src="<?= $com['pp']?>">
                                                    </figure>
                                                </div>
                                        <div class="column is-10 is-vcentered">
                                            <span class="has-text-weight-semibold"><?= $com['login']?>: </span><?=  $com['commentaire'] ?></p>
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
                                                    <input class="input is-rounded is-fullwidth" type="text" name="commentaire" id="comment<?=$img->getIdImg()?>" placeholder="Ajouter un commentaire...." required>
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
<script>
    function like(idImg)
    {
        window.location.href = "<?=URL?>?url=image&like=yes&idImg=" + idImg;
    }
    var flag = 3;
    var finish = 0;
    window.onscroll = function() {
        if (window.scrollY >= document.body.clientHeight - window.innerHeight && finish == 0)
        {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '<?=URL?>?url=accueil&offset=' + flag + '&limit=3');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            flag += 3;
            xhr.addEventListener('readystatechange', () => {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    try
                    {
                        finish = (JSON.parse(xhr.response).finish);
                    }
                    catch(e) {
                        document.body.innerHTML += xhr.response;
                    }
                }
            });
            xhr.send();
        }
    }

</script>