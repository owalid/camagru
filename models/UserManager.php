<?php

class UserManager extends Model
{
    public function register()
    {
		$this->getBdd();
		return $this->registerUser($_POST);
    }

    public function log()
    {
		$this->getBdd();
        return $this->logUser($_POST['login'], $_POST['passwd']);
    }

    public function logout()
    {
        session_start();

        if (isset($_SESSION['user']))
        {
            $_SESSION['user'] = NULL;
        }
    }
}