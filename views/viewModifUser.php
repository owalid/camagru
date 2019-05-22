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
                        require_once('component/modif_profil_user.html');
                        // require_once('component/modif_passwd.html');
                        // require_once('component/modif_notif_mail.html');
						?>
                    </div>
            </article>
        </div>
    </div>
</div>