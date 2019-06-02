<?php
session_start();
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
        <article style="display:none;" id="article-succ" class="message is-success text-center">
		<div class="message-body" id="success">
		</div>
		</article>
		<article style="display:none;" id="article-err" class="message is-danger text-center">
		<div class="message-body" id="error">
		</div>
		</article>
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
                                            <div class="field">
                                                <figure class="image">
                                                    <img src="<?=$img->getImg()?>">
                                                </figure>
                                                <div class="buttons is-centered is-vcentered padding-10-top">
                                                    <a class="button is-rounded" onclick="deleteImg(<?=$img->getIdimg()?>);">
                                                    <span class="icon is-xsmall">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                    }
                                    if ($i % 3 != 0)
                                    ?>
                                    </div>
                                    <?php
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
                                        if ($i % 3 != 0)
                                        ?>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {   
                                        ?>
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

function deleteImg(idImg)
{
    if (confirm("Vous désirez vraiment supprimé cette photo ?")) {
		var error = document.getElementById('error');
		var article_err = document.getElementById('article-err');
		var success = document.getElementById('success');
		var article_succ = document.getElementById('article-succ');

		event.preventDefault();
		var xhr = new XMLHttpRequest();
		xhr.responseType = 'json';
		xhr.overrideMimeType("application/json");
		xhr.open('GET', '<?=URL?>?url=image&delete=yes&idImg=' + idImg);
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
			var res = xhr.response;
			if (res.success == 1)
			{
					success.innerHTML = '';
					success.innerHTML = "Votre photo à bien été supprimé";
					article_err.style.display = 'none';
					article_succ.style.display = '';
			}
			else
			{
				var output;
				error.innerHTML = '';
                error.innerHTML = res.res;
				article_err.style.display = '';
				article_succ.style.display = 'none';
			}
        }
    });
    xhr.send();
    }
}
</script>