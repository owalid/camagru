<?php
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
		{
			?>
			<article class="message is-danger text-center">
		<div class="message-body">
			<?= $err ?>
		</div>
		</article>
		<?php
		}
		?>
<div class="container">
    <div class="hero is-medium is-bold">
        <div class="hero-body">
            <article class="card is-rounded">
                    <div class="card-content">
                        <div class="tabs">
                            <ul>
                                <li class="is-active" id="tab_modif"><a>Modifier le profil</a></li>
								<li id="tab_passwd"><a>Changer de mot de passe</a></li>
								<li id="tab_notif"><a>Notif</a></li>
                            </ul>
						</div>
						<?php
						session_start();
						?>
						<div id="modif">
							<form action="<?=URL?>?url=modifUser&modif=yes" method="post">
									<div class="field">
										<label class="label">Login</label>
										<div class="control">
											<input class="input" type="text" name="login" placeholder="Text input" value=<?= $_SESSION['user']->getLogin()?>>
										</div>
									</div>
									<div class="field">
										<label class="label">Email</label>
										<div class="control has-icons-left has-icons-right">
											<input class="input" type="email" name="email" placeholder="Email input" value="<?= $_SESSION['user']->getEmail()?>">
											<span class="icon is-small is-left">
												<i class="fas fa-envelope"></i>
											</span>
										</div>
									</div>
									<div class="field">
										<label class="label">Bio</label>
										<div class="control">
											<textarea class="textarea" name="bio" placeholder="Textarea"><?= $_SESSION['user']->getBio()?></textarea>
										</div>
									</div>
									<div class="field is-grouped">
										<div class="control">
											<button class="button is-primary" type="submit">Modif</button>
										</div>
									</div>
								</form>
					</div>
					<div id="passwd" style="display:none;">

						<form action="<?=URL?>?url=ModifUser&passwd=yes" method="post">
								<div class="field">
									<p class="control has-icons-left">
										<input class="input" type="password" name="old" placeholder="Old password">
										<span class="icon is-small is-left">
											<i class="fas fa-lock"></i>
										</span>
									</p>
								</div>
								<div class="field">
									<p class="control has-icons-left">
										<input class="input" type="password" name="new1" placeholder="New Password">
										<span class="icon is-small is-left">
											<i class="fas fa-lock"></i>
										</span>
									</p>
								</div>
								<div class="field">
									<p class="control has-icons-left">
										<input class="input" type="password" name="new2" placeholder="New Password">
										<span class="icon is-small is-left">
											<i class="fas fa-lock"></i>
										</span>
									</p>
								</div>
								<div class="field is-grouped">
									<div class="control">
										<button class="button is-primary" type="submit">Modifier</button>
									</div>
								</div>
							</form>
							</div>
						<div id="notif" style="display:none">
							<form action="<?=URL?>?url=ModifUser&notif=yes" method="post">
									<div class="field">
										<label class="checkbox">
											Notification commentaire:
											<input id="inputCom" class="checkbox" type="checkbox" name="com" value="<?=(bool)$_SESSION['user']->getNotifLike()?>">
										</label>
									</div>
									<div class="field">
											<label class="checkbox">
												Notification like:
												<input id="inputLike" class="checkbox" type="checkbox" name="like" value="<?=(bool)$_SESSION['user']->getNotifLike()?>">
											</label>
										</p>
									</div>
									<div class="field is-grouped">
										<div class="control">
											<button class="button is-primary" type="submit">Modif</button>
										</div>
									</div>
							</form>
						</div>
						</div>
					</article>
				</div>
			</div>
		</div>
<script>
	//							MODIF
	var tab_modif = document.getElementById('tab_modif');
	var tab_modif_content = document.getElementById('modif');
	//							PASSWD
	var tab_passwd = document.getElementById('tab_passwd');
	var tab_passwd_content = document.getElementById('passwd');
	//							NOTIF
	var tab_notif = document.getElementById('tab_notif');
	var tab_notif_content = document.getElementById('notif');
	
	tab_modif.addEventListener('click', modif);
	tab_passwd.addEventListener('click', passwd);
	tab_notif.addEventListener('click', notif);
	
	function modif(e) {
		tab_modif.classList.add('is-active');
		tab_passwd.classList.remove('is-active');
		tab_notif.classList.remove('is-active');
		tab_passwd_content.style.display = 'none';
		tab_notif_content.style.display = 'none';
		tab_modif_content.style.display = '';
	}
	
	function passwd(e) {
		tab_passwd.classList.add('is-active');
		tab_modif.classList.remove('is-active');
		tab_notif.classList.remove('is-active');
		tab_passwd_content.style.display = '';
		tab_modif_content.style.display = 'none';
		tab_notif_content.style.display = 'none';
	}

	function notif(e) {
		var inputCom = document.getElementById('inputCom');
		var inputLike = document.getElementById('inputLike');
		if (inputCom.value == true)
			inputCom.checked = true;
		if (inputLike.value == true)
			inputLike.checked = true;
		tab_notif.classList.add('is-active');
		tab_passwd.classList.remove('is-active');
		tab_modif.classList.remove('is-active');
		tab_notif_content.style.display = '';
		tab_modif_content.style.display = 'none';
		tab_passwd_content.style.display = 'none';
	}


</script>