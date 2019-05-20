<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
<link rel="stylesheet" href="../style/style.css?ts=<?=time()?>">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
<header>
<?php
    require_once('component/navbar_top.html');
?>
</header>
    <section class="container padding-100-top">
        <div class="columns">
            <div class="column">
				<video id="video"></video>
				<canvas id="canvas"></canvas>
				<canvas id='blank' style='display:none'></canvas>
					<button id="take_pic" class="button is-primary">Prendre une photo</button>
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
            <div class="column">
			<div class="container" id="filter" style='display:none'>
				<div class="columns is-3 is-mobile is-multiline">
					<div class="column">
						<div class="hovereffect padding-20-bottom">
								<img src="https://bulma.io/images/placeholders/320x480.png">
							</div>
						<div>
							<div class="hovereffect padding-20-bottom">
							<img src="https://bulma.io/images/placeholders/320x480.png">
							</div>
						</div>
					</div>
					<div class="column">
						<div>
						<div class="hovereffect padding-20-bottom">
								<img src="https://bulma.io/images/placeholders/320x480.png">
							</div>
						</div>
						<div>
							<div class="hovereffect padding-20-bottom">
							<img src="https://bulma.io/images/placeholders/320x480.png">
							</div>
						</div>
					</div>
					<div class="column">
						<div>
							<div class="hovereffect padding-20-bottom">
							<img src="https://bulma.io/images/placeholders/320x480.png">
							</div>
						</div>
						<div>
							<div class="hovereffect padding-20-bottom">
							<img src="https://bulma.io/images/placeholders/320x480.png">
							</div>
						</div>
					</div>
				</div>
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
        <form action="">
            <input class="input" type="text-area" placeholder="Description" value="">
			<button class="button is-primary" id="publi" disabled>Publier</button>
        </form>
    </section>
<footer>
<?php
    require_once('component/navbar_bottom.html');
?>
</footer>
</body>
<script src="../script/burger.js"></script>
<script src="../script/picture.js"></script>
</html>