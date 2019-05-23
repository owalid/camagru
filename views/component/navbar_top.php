    <nav class="navbar is-fixed-top " role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
                <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
            </a>
            
            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start"
            style="flex-grow: 1; justify-content: center;">
            <a class="navbar-item" href="<?=URL?>">
                Home
			</a>
			<?php
			session_start();
			if ($_SESSION['user'])
			{?>

            <a class="navbar-item">

                <?=$_SESSION['user']->getLogin()?>
            </a>
			<?php
			}
			?>
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                <?php
    session_start();
    if ($_SESSION['user'])
    {
        ?>
                    <a class="button is-primary" href="<?=URL?>?url=logout">
                        <strong>Log out</strong>
                    </a>
                   <?php
    }
    else
    {
?>
                   <a class="button is-primary" href="<?=URL?>?url=login">
                        <strong>Log in</strong>
                    </a>
                   <a class="button is-primary" href="<?=URL?>?url=register">
                        <strong>Register</strong>
                    </a>
<?php
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</nav>