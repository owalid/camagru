
<section>
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
						<form method="post" action="<?=URL?>?url=login&submit=OK">
							<p class="control has-icons-left has-icons-right">
								<input class="input" type="text" placeholder="Login" name="login" required>
								<span class="icon is-small is-left">
									<i class="fas fa-envelope"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<p class="control has-icons-left">
								<input class="input" type="password" placeholder="Password" name="passwd" required>
								<span class="icon is-small is-left">
									<i class="fas fa-lock"></i>
								</span>
							</p>
						</div>
						<div class="field">
							<div class="buttons is-centered is-vcentered">
								<p class="control is-center">
									<button class="button is-primary" type="submit">
										Login
									</button>
								</p>
							</div>
							<a  href="<?=URL?>?url=forgotPasswd" class="is-primary">
									Mot de passe oublié
							</a>
						</form>
					</div>
				</div>
			</article>
			</div>
		</div>
</section>
