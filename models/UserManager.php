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

    public function getLikeUser()
    {
        $this->getBdd();
        return ($this->getLike());
    }

    public function getComs()
    {
        $this->getBdd();
        return ($this->getCommentairesUsr());
    }

    public function getPicUsr($idUsr)
    {
        $this->getBdd();
        return ($this->getUsrImages($idUsr));
    }

    public function verifUsr()
    {
        $this->getBdd();
        return ($this->verifMail());
    }

    public function modifUserInfo()
    {

        $this->getBdd();
        return ($this->modifUsr());
    }
    
    public function modifUserPasswd()
    {
        $this->getBdd();
        return ($this->modifpasswd());
    }
}