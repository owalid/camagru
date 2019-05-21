
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
