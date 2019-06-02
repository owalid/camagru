<?php
if ($err)
{
	foreach($err as $e)
	{
		?>
			<article class="message is-danger text-center">
				<div class="message-body">
					<?= $e ?>
				</div>
			</article>
			<?php
		}
	}
?>
<article style="display:none;" id="article-succ" class="message is-success text-center">
<div class="message-body" id="success">
</div>
</article>
<article style="display:none;" id="article-err" class="message is-danger text-center">
<div class="message-body" id="error">
	</div>
</article>
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
							<form method="POST" action="<?=URL?>?url=ModifUser&modif=yes" onSubmit="sendModifProfil();" enctype="multipart/form-data">
									<div class="field">
										<label class="label">Login</label>
										<div class="control">
											<input id="login" class="input" type="text" name="login" placeholder="Text input" value=<?= $_SESSION['user']->getLogin()?>>
										</div>
									</div>
									<div class="field">
										<label class="label">Email</label>
										<div class="control has-icons-left has-icons-right">
											<input id="email" class="input" type="email" name="email" placeholder="Email input" value="<?= $_SESSION['user']->getEmail()?>">
											<span class="icon is-small is-left">
												<i class="fas fa-envelope"></i>
											</span>
										</div>
									</div>
									<div class="field">
										<label class="label">Bio</label>
										<div class="control">
											<textarea id="bio" class="textarea" name="bio" placeholder="Textarea"><?= $_SESSION['user']->getBio()?></textarea>
										</div>
									</div>
									<div class="field">
									<label class="label">Photo de profil</label>
										<div class="columns  is-centered is-vcentered">
											<div class="column is-5">
											<label class="label">Photo de profil actuelle:</label>
											</div>
											<div class="column">
												<img src="<?= $_SESSION['user']->getPp()?>" id="pp" alt="">
											</div>

										</div>
									</div>
									<div class="field">
										<div class="columns is-centered is-vcentered">
											<div class="column is-3">
												<video id="video"></video>
											</div>
											<div class="column is-4">
											
												<canvas id="canvas"></canvas>
												<canvas id='blank' style='display:none'></canvas>
											</div>
										</div>
									</div>
									<div class="field">

									<div class="columns is-centered is-vcentered">
										<div class="column">
											<div class="buttons is-centered is-vcentered">
												<button id="take_pic" type="button" class="button is-primary is-centered is-vcentered">Prendre une photo</button>
											</div>
										</div>
										<div class="column">
											<div class="file has-name is-primary">
												<label class="file-label ">
													<input class="file-input" type="file" id="import_file" name="pp" accept="image/png">
													<span class="file-cta">
														<span class="file-icon">
															<i class="fas fa-upload"></i>
														</span>
														<span class="file-label is-primary">
															Choisir une image
														</span>
													</span>
													<span class="file-name" id="file_name">
														Aucune image importée
													</span>
												</label>
											</div>
										</div>
									</div>
									</div>
									<div class="field">

								<div class="columns is-centered is-vcentered">
									<div class="column">
										<p class="has-text-weight-semibold" id="file_name2">Aucune image</p>
									</div>
									<div class="column is-10">
										<i class="fas fa-trash" id="trash"></i>
									</div>
								</div>
								<div class="container" id="filter" style='display:none'></div>
								<input id="inp_img" name="pp" type="hidden">
								</div>
								<div class="field is-grouped">
									<div class="control">
										<button class="button is-primary"  id="publi" type="submit">Modif</button>
									</div>
								</div>
						</form>
					</div>
					<div id="passwd" style="display:none;">

						<form onSubmit="sendModifPasswd();" method="post">
								<div class="field">
									<p class="control has-icons-left">
										<input id="old" class="input" type="password" name="old" placeholder="Old password">
										<span class="icon is-small is-left">
											<i class="fas fa-lock"></i>
										</span>
									</p>
								</div>
								<div class="field">
									<p class="control has-icons-left">
										<input id="new1" class="input" type="password" name="new1" placeholder="New Password">
										<span class="icon is-small is-left">
											<i class="fas fa-lock"></i>
										</span>
									</p>
								</div>
								<div class="field">
									<p class="control has-icons-left">
										<input id="new2" class="input" type="password" name="new2" placeholder="New Password">
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
											<input id="inputCom" class="checkbox" type="checkbox" name="com" value="<?=(bool)$_SESSION['user']->getNotifCom()?>">
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
	// var take_pic = document.getElementById('take_pic');
	// var trash = document.getElementById('trash');
	// var pp = document.getElementById('pp');

	// trash.addEventListener('click', () => {
	// 	pp.style.display = '';
	// })
	// take_pic.addEventListener('click', () => {
	// 	pp.style.display = 'none';
	// })
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

	function sendModifProfil()
	{
		var canvas = document.getElementById('canvas');
    	var blank = document.getElementById('blank');
		if (canvas.toDataURL() != blank.toDataURL())
			document.getElementById('inp_img').value = canvas.toDataURL();
		// var email = document.getElementById('email').value;
		// var login = document.getElementById('login').value;
		// var bio = document.getElementById('bio').value;
		// var pp = document.getElementById('inp_img').value || document.getElementById('import_file').value || "";
		// var error = document.getElementById('error');
		// var article_err = document.getElementById('article-err');
		// var success = document.getElementById('success');
		// var article_succ = document.getElementById('article-succ');
		// pp1 = pp.substring(0, 7000);
		// pp2 = pp.substring(7000);
		// event.preventDefault();
		// var xhr = new XMLHttpRequest();
		// xhr.responseType = 'json';
		// xhr.overrideMimeType("application/json");
		// xhr.open('POST', '<?phpURL?>?url=ModifUser&modif=yes');
		// xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		// xhr.addEventListener('readystatechange', () => {
		// 	if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
		// 		var res = xhr.response;
		// 		if (res.success == 1)
		// 		{
		// 			success.innerHTML = '';
		// 			article_err.style.display = 'none';
		// 			article_succ.style.display = '';
		// 			success.innerHTML = (res.res == null) ? 'Votre compte à bien été modifier' : res.res;
		// 		}
		// 		else
		// 		{
		// 			var output;
		// 			error.innerHTML = '';
		// 			for (var r in res)
		// 			error.innerHTML += res[r] + "</br>";
		// 			article_err.style.display = '';
		// 			article_succ.style.display = 'none';
		// 		}
		// 	}
		// });
		// xhr.send(`email=${email}&login=${login}&bio=${bio}&pp=${pp1}${pp2}`);
	}

	function sendModifPasswd()
	{
	
		var old = document.getElementById('old').value;
		var new2 = document.getElementById('new2').value;
		var new1 = document.getElementById('new1').value;
		var error = document.getElementById('error');
		var article_err = document.getElementById('article-err');
		var success = document.getElementById('success');
		var article_succ = document.getElementById('article-succ');

		event.preventDefault();
		var xhr = new XMLHttpRequest();
		xhr.responseType = 'json';
		xhr.overrideMimeType("application/json");
		xhr.open('POST', '<?=URL?>?url=ModifUser&passwd=yes');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
			var res = xhr.response;
			if (res.success == 1)
			{
					success.innerHTML = '';
					success.innerHTML = res.res;
					article_err.style.display = 'none';
					article_succ.style.display = '';
			}
			else
			{
				var output;
				error.innerHTML = '';
                error.innerHTML += res.res;
				article_err.style.display = '';
				article_succ.style.display = 'none';
			}
        }
    });
    xhr.send(`old=${old}&new1=${new1}&new2=${new2}`);
	}

</script>