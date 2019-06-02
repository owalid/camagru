<?php
?>
		<article style="display:none;" id="article-err" class="message is-danger text-center">
		    <div class="message-body" id="error">
		    </div>
		</article>

        <div class="container is-vcentered is-centered">
			<div class="columns is-centered">
        <article class="card is-rounded">
        <div class="card-content">
            <div class="field text-center">
                    <img src="<?=IMG?>icon.png">
                <p>Inscrivez-vous pour voir les photos et vidéos de vos amis.</p>
            </div>
            <hr />
                <hr />
                <form id="formRegister" method="POST" onSubmit="prepareImg();" enctype="multipart/form-data">
                    <div class="field">
                        <p class="control has-icons-left has-icons-right">
                            <input id="email" class="input" type="email" placeholder="Email" name="email" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left has-icons-right">
                            <input id="login" class="input" type="login" placeholder="login" name="login" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                            <input id="passwd1" class="input" type="password" placeholder="Password" name="passwd1" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                            <input id="passwd2" class="input" type="password" placeholder="Password" name="passwd2" required>
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                        </p>
					</div>
                    <div class="field">
                        <p class="control has-icons-left">
                            <textarea id="bio" class="textarea" placeholder="Bio" name="bio" maxlength="516"></textarea>
                        </p>
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
				<div class="columns is-centered is-vcentered">
                    <div class="column">
                        <div class="buttons is-centered is-vcentered">
                            <button id="take_pic" class="button is-primary is-centered is-vcentered">Prendre une photo</button>
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
					<div class="columns is-centered is-vcentered">
			<div class="column">
				<p class="has-text-weight-semibold" id="file_name2">Aucune image</p>
			</div>
			<div class="column is-10">
				<i class="fas fa-trash" id="trash"></i>
			</div>
		</div>
		<input id="inp_img" name="pp" type="hidden" value="">
		<div class="container" id="filter" style='display:none'></div>
                    <div class="field">
                        <div class="buttons is-centered is-vcentered">
                            <p class="control is-center">
                                <button class="button is-primary" id="publi" type="submit">
                                    Créer un compte
                                </button>
                            </p>
                        </div>
                        <hr />
                        <div class="field">
                            <p>En vous inscrivant, vous acceptez nos Conditions générales.
                                Découvrez comment nous recueillons, utilisons et partageons vos
                                données en lisant notre Politique d’utilisation des données et comment
                                nous utilisons les cookies et autres technologies similaires en
                                consultant notre Politique d’utilisation des cookies.</p>
                    </div>
                </form>
            </div>
        </div>
    </article>
    </div>
    </div>
	<script>

function prepareImg() {
	var canvas = document.getElementById('canvas');
    var blank = document.getElementById('blank');
    var error = document.getElementById('error');
    var article_err = document.getElementById('article-err');
    
    if (canvas.toDataURL() != blank.toDataURL())
        document.getElementById('inp_img').value = canvas.toDataURL();
    var email = document.getElementById('email').value;
    var login = document.getElementById('login').value;
    var passwd1 = document.getElementById('passwd1').value;
    var passwd2 = document.getElementById('passwd2').value;
    var bio = document.getElementById('bio').value;
    var inp_img = document.getElementById('inp_img').value;
    var import_file = document.getElementById('import_file').value;
    var pp = inp_img || import_file || "";
    
    event.preventDefault();
	
    var xhr = new XMLHttpRequest();
    xhr.responseType = 'json';
    xhr.overrideMimeType("application/json");
    xhr.open('POST', '<?=URL?>register');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
            var res = xhr.response;
            var output;
            error.innerHTML = '';
            for (var r in res)
                error.innerHTML += res[r] + "</br>";
            article_err.style.display = '';
        }
    });
    xhr.send(`email=${email}&login=${login}&passwd1=${passwd1}&passwd2=${passwd2}&bio=${bio}&pp=${pp}`);
}
</script>