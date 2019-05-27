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
										<input class="input" type="password" name="new" placeholder="New Password">
										<span class="icon is-small is-left">
											<i class="fas fa-lock"></i>
										</span>
									</p>
								</div>
								<div class="field">
									<p class="control has-icons-left">
										<input class="input" type="password" placeholder="New Password">
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
						</div>
					</article>
				</div>
			</div>
		</div>
		<script>
var tab_photos = document.getElementById('tab_modif');
	var tab_enr = document.getElementById('tab_passwd');
	var tab_enr_content = document.getElementById('passwd');
	var tab_photos_content = document.getElementById('modif');
	
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