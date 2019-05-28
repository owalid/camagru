<?php
session_start();
if ($msg)
{?>
<article class="message is-success text-center">
<div class="message-body">
    <?= $msg ?>
</div>
</article>
<?php
}
?>
<div class="container">
        <!-- card User -->
        <div class="hero is-medium is-bold">
            <div class="hero-body">
                    <article class="card is-rounded">
                        <div class="card-content">
                            <div class="columns is-centered">
                                <div class="column">
                                    <figure class="image is-128x128">
                                        <img class="is-rounded" src="<?=$_SESSION['user']->getPp()?>">
                                    </figure>
                                    <p class="subtitle text-center">
                                        <?= $_SESSION['user']->getBio()?>
                                    </p>
                                    <!-- <p> Nb publications: 50</p> -->
                                </div>
                                <div class="column">
                                    <p class="subtitle">
									<?= $_SESSION['user']->getLogin()?>
                                    </p>
                                </div>
                                <div class="column">
                                    <div class="buttons is-centered">                            
                                        <a class="button is-primary" href="<?=URL?>?url=modifUser">
                                            Modifier le profil
                                        </a>
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
                                            <li class="is-active" id="tab_photos"><a>Photos</a></li>
                                            <li id="tab_enr"><a>Enrengistrements</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="container column is-centered" id="photos">
                                <div class="columns is-centered">
                                <?php
                                    session_start();
                                    $imgUsr = $_SESSION['user']->getUserImages();
                                    if ($imgUsr)
                                    {
                                        $i = 0;
                                        foreach($imgUsr as $img)
                                        {
                                            if ($i % 3 == 0)
                                            {
                                                ?>
                                            </div>
                                            <div class="columns is-centered">
                                        <?php
                                            }
                                            ?> 
                                    <div class="column is-3">
                                        <div class="padding-20-bottom">
                                            <img class="image" src="<?= $img->getImg()?>">
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                    }
                                }
                                else
                                {
                                    
                                    ?>
                                    </div>
                                       <div class="column">
                                        <div class="hovereffect padding-20-bottom">
                                            <p>Pas encore de photos🤷‍♂️</p>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
							</div>
								<!-- Enrengistrement -->
                            <div class="container" id="enr" style="display:none">
                            <div class="columns is-centered">
                                    <?php
                                     $imgSaveUsr = $_SESSION['user']->getUserSaveImages();
                                    if ($imgSaveUsr)
                                    {
                                        $i = 0;
                                        foreach($imgSaveUsr as $save)
                                        {
                                            if ($i % 3 == 0)
                                            {
                                                ?>
                                            </div>
                                            <div class="columns is-centered">
                                                <?php
                                            }?> 
                                        <div class="column is-3">
                                            <div class="padding-20-bottom">
                                                <img class="image" src="<?= $save->getImg()?>">
                                            </div>
                                        </div>
                                        <?php
                                        $i++;
                                        }
                                    }
                                    else
                                    {   
                                        ?>
                                        </div>
                                        <div class="column">
                                            <div class="hovereffect padding-20-bottom">
                                                <p>Pas encore de photos🤷‍♂️</p>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
	</div>
	<script>



var tab_photos = document.getElementById('tab_photos');
var tab_enr = document.getElementById('tab_enr');
var tab_enr_content = document.getElementById('enr');
var tab_photos_content = document.getElementById('photos');

tab_photos.addEventListener('click', photo_to_enr);
tab_enr.addEventListener('click', enr_to_photo);

function photo_to_enr(e) {
	tab_photos.classList.add('is-active');
	tab_enr.classList.remove('is-active');
	tab_enr_content.style.display = 'none';
	tab_photos_content.style.display = '';
}

function enr_to_photo(e) {
	tab_enr.classList.add('is-active');
	tab_photos.classList.remove('is-active');
	tab_enr_content.style.display = '';
	tab_photos_content.style.display = 'none';
}
	</script>