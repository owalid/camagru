<?php
    session_start();
    if ($_SESSION['user'])
    {
        ?>
<nav class="navbar is-primary is-fixed-bottom" role="navigation">
    <div class="navbar-brand"
    style="flex-grow: 1; justify-content: center;">
    <a class="navbar-item is-expanded is-block has-text-centered" href="<?=URL?>">
            <span class="icon">
                <i class="fas fa-home"></i>
            </span>
        </a>
        <a class="navbar-item is-expanded is-block has-text-centered" href="<?=URL?>?url=takePicture">
                <span class="icon">
                    <i class="fas fa-camera"></i>
                </span>
            </a>
            <a class="navbar-item is-expanded is-block has-text-centered" href="<?=URL?>?url=like">
                    <i class="fa fa-heart"></i>
                </a>
                <a class="navbar-item is-expanded  is-block has-text-centered" href="<?=URL?>?url=user">
                        <i class="fa fa-user"></i>
                    </a>
                </div>
            </nav>
<?php
    }
?>