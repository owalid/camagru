
    <section class="container padding-100-top">
	<form method="post" id="formRegister" action="<?=URL?>?url=takePicture&submit=OK" onSubmit="prepareImg();">
				<div class="columns is-centered is-vcentered">
					<div class="column is-6">
						<video id="video"></video>
					</div>
					<div class="column">
						<canvas id="canvas"></canvas>
						<canvas id='blank' style='display:none'></canvas>
					</div>
				</div>
				<button id="take_pic" class="button is-primary">Prendre une photo</button>
				<div class="file has-name is-primary">
					<label class="file-label ">
						<input class="file-input" type="file" id="import_file" name="resume" accept="image/png">
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
		<div class="columns">
            <div class="column">
			<div class="container" id="filter" style='display:none'>
				<div class="columns is-3 is-mobile is-multiline">
					<div class="column">
						<div class="hovereffect padding-20-bottom">
								<img onclick="addFilter(event)" id="memes1" src="<?=IMG?>memes1.png">
							</div>
							<div>
								<div class="hovereffect padding-20-bottom">
								<img onclick="addFilter(event)" id="memes2" src="<?=IMG?>memes2.png">
							</div>
						</div>
					</div>
					<div class="column">
						<div>
						<div class="hovereffect padding-20-bottom">
							<img onclick="addFilter(event)" id="memes2" src="<?=IMG?>memes4.png">
						</div>
					</div>
					<div>
						<div class="hovereffect padding-20-bottom">
							<img onclick="addFilter(event)" id="memes2" src="<?=IMG?>memes5.png">
						</div>
					</div>
				</div>
				<div class="column">
					<div>
						<div class="hovereffect padding-20-bottom">
								<img onclick="addFilter(event)" id="memes2" src="<?=IMG?>memes6.png">
							</div>
						</div>
					</div>
				</div>
			</div>
            </div>
		</div>
		<input id="inp_img" name="image" type="hidden" value="">
		<div class="columns">
			<div class="column">
				<p class="has-text-weight-semibold" id="file_name2">Aucune image</p>
			</div>
			<div class="column is-10">
				<i class="fas fa-trash" id="trash"></i>
			</div>
		</div>
            <input class="input" type="text-area" placeholder="Description" name="description" value="">
			<button class="button is-primary" id="publi" disabled>Publier</button>
        </form>
	</section>
	<script>

function prepareImg() {
	var canvas = document.getElementById('canvas');
	var blank = document.getElementById('blank');

	if (canvas.toDataURL() != blank.toDataURL())
		{
		document.getElementById('inp_img').value = canvas.toDataURL();
		}
	}
</script>
