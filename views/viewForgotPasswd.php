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
		{?>
		<article class="message is-danger text-center">
		<div class="message-body">
			<?= $err ?>
		</div>
		</article>
		<?php
		}
		?>
<div class="container is-vcentered is-centered">
			<div class="columns is-centered">
			<article class="card is-rounded">
				<div class="card-content">
                <div class="field">
							<img src="<?=IMG?>icon.png">
						</div>
					<div class="field">
						<form method="post" action="<?=URL?>?url=forgotPasswd&submit=OK">
							<p class="control has-icons-left has-icons-right">
								<input class="input" type="email" placeholder="email" name="email" required>
								<span class="icon is-small is-left">
									<i class="fas fa-envelope"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<div class="buttons is-centered is-vcentered">
								<p class="control is-center">
									<button class="button is-primary" type="submit">
										Envoyé
									</button>
								</p>
							</div>
                        </div>
						</form>
                </div>
</article>
</div>
</div>