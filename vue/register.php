<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <link rel="stylesheet" href="../../style/style.css?ts=<?=time()?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <article class="card is-rounded">
        <div class="card-content">
            <div class="field">
                <p>Inscrivez-vous pour voir les photos et vidéos de vos amis.</p>
            </div>
            <hr />
            <div class="field">
                <div class="buttons is-centered is-vcentered">
                    <p class="control is-center">
                        <button class="button is-primary">
                            Se connecter avec Facebook
                        </button>
                    </p>
                </div>
            </div>
                <hr />
                <form>
                    <div class="field">
                        <p class="control has-icons-left has-icons-right">
                            <input class="input" type="email" placeholder="Email">
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left has-icons-right">
                            <input class="input" type="login" placeholder="login">
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                            <input class="input" type="password" placeholder="Password">
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icons-left">
                            <input class="input" type="password" placeholder="Password">
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                        </p>
					</div>
					<video id="video"></video>
				<canvas id="canvas"></canvas>
				<canvas id='blank' style='display:none'></canvas>
				<div class="columns">
					<div class="column">
						<button id="take_pic" class="button is-primary">Prendre une photo</button>
					</div>
					<div class="column">
						<div class="file has-name is-primary">
							<label class="file-label ">
								<input class="file-input" type="file" id="import_file" name="resume">
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
					<div class="columns">
			<div class="column">
				<p class="has-text-weight-semibold" id="file_name2">Aucune image</p>
			</div>
			<div class="column is-10">
				<i class="fas fa-trash" id="trash"></i>
			</div>
		</div>
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
</body>
<script src="../script/picture.js"></script>
</html>