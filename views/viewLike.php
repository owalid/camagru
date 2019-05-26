<section class=" container is-centered">

    <?php
    if ($likes)
    {
        ?>
                <h1 class="text-center is-size-2">Likes</h1>
                <?php
        foreach($likes as $like)
        {
            ?>
<div class="columns is-vcentered is-centered">
    <div class="column">
        
        <article class="card is-rounded">
            <div class="card-content">
                <div class="field">
                    <div class="columns is-vcentered">
                        <div class="column is-1 is-vcentered">
                            <figure class="image is-64x64">
                                <img class="is-rounded" src="<?= $like['pp'] ?>">
                            </figure>
                        </div>
                        <div class="column id-vcentered">
                            <p><?= $like['login']?> a aimé votre publication</p>
                        </div>
                        <div class="column is-1 is-vcentered">
                            <figure class="image is-64x64">
                                <img src="<?= $like['img'] ?>">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
<?php        
    }
    if ($commentaires)
    {
        ?>
        <h1 class="text-center is-size-2">Commentaires</h1>
        <?php
        foreach($commentaires as $com)
        {
            ?>
<div class="container columns is-vcentered">
    <div class="column">
        <article class="card is-rounded">
            <div class="card-content">
                <div class="field">
                    <div class="columns is-vcentered">
                        <div class="column is-1 is-vcentered">
                            <figure class="image is-64x64">
                                <img class="is-rounded" src="<?= $com['pp'] ?>">
                            </figure>
                        </div>
                        <div class="column id-vcentered">
                            <p><?= $com['login']?> a commenté: <?= $com['commentaire']?></p>
                        </div>
                        <div class="column is-1 is-vcentered">
                            <figure class="image is-64x64">
                                <img src="<?= $com['img'] ?>">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
<?php
        }
    }
}
if (empty($like) && empty($commentaires))
{
    ?>
    <p>Aucune activité</p>
    <?php
}
?>
</section>
