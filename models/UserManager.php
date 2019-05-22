<?php

class UserManager extends Model
{
    public function register()
    {
		$this->getBdd();
		$user = new User($_POST);
		if ($this->registerUser($_POST))
			return $user;
		return FALSE;
    }

    public function log()
    {
		// var_dump("ici\n");
		// var_dump($_POST);
		// die();
		$this->getBdd();
        return $this->logUser($_POST['login'], $_POST['passwd']);
    }
    
    // public function register(array $argv)
    // {
    //     $this->getBdd();
    //     return $this->registerUser($login, $passwd);
    // }
}