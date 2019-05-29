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
						<form method="post" action="<?=URL?>?url=forgotPasswdForm&submit=OK">
                        <div class="field">
							<p class="control has-icons-left">
								<input class="input" type="password" placeholder="Password" name="passwd1" required>
								<span class="icon is-small is-left">
									<i class="fas fa-lock"></i>
								</span>
							</p>
						</div>
                        <div class="field">
							<p class="control has-icons-left">
								<input class="input" type="password" placeholder="Password" name="passwd2" required>
								<span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
								</span>
							</p>
						</div>
                        <input class="input" type="password" name="email" value="<?=$_GET['email']?>" style="display:none">
                        <input class="input" type="password" name="hash" value="<?=$_GET['hash']?>" style="display:none">
						</div>
						<div class="field">
							<div class="buttons is-centered is-vcentered">
								<p class="control is-center">
									<button class="button is-primary" type="submit">
										Reset
									</button>
								</p>
							</div>
                        </div>
						</form>
                </div>
    </article>
    </div>
    </div>