<?php

class UserManager extends Model
{
    public function register()
    {
		$this->getBdd();
		// var_dump("coucou");
		// die();
		// $user = new User($_POST);
		return $this->registerUser($_POST);
    }

    public function log()
    {
		$this->getBdd();
        return $this->logUser($_POST['login'], $_POST['passwd']);
    }
}