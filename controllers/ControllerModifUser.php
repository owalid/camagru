<?php
require('views/View.php');

Class ControllerModifUser 
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
        throw new Exception("Page introuvable", 1);
        else if($_GET['modif'] == "yes")
        {
            $this->modifInfoUser();
        }
        else if ($_GET['passwd'] == "yes")
            $this->modifPasswd();
        else
            $this->modifUser();
    }
    
    private function modifUser()
    {
        session_start();
        if ($_SESSION['user'] == NULL)
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => "Vous devez vous connecté"));
        }
        else
        {

            $this->_view = new View('ModifUser');
            $this->_view->generate(array('ModifUser' => NULL));
        }
    }

    private function modifInfoUser()
    {
        $this->_userManager = new UserManager();
       
        $res = $this->_userManager->modifUserInfo();
        if (empty($res))
        {
            $this->_view = new View('User');
            $this->_view->generate(array('User' => NULL));
        }
        else if ($res == "LOGIN")
        {
            $this->_view = new View('ModifUser');
            $this->_view->generate(array('err' => "Ce login existe deja"));
        }
        else if ($res == "EMAIL")
        {
            $this->_view = new View('ModifUser');
            $this->_view->generate(array('err' => "Cette adresse mail existe dejà"));
        }
        else if ($res == "NEW")
        {
            $this->_view = new View('User');
            $this->_view->generate(array('msg' => "Vous devez verifier votre nouvelle adresse mail ✅"));
        }
    }

    private function modifPasswd()
    {
        $this->_userManager = new UserManager();
        $res = $this->_userManager->modifUserPasswd();
        if ($res == "ERR")
        {
            $this->_view = new View('ModifUser');
            $this->_view->generate(array('err' => "Mot de passe incorrect"));
        }
        else
        {
            $this->_view = new View('User');
            $this->_view->generate(array('User' => NULL));
        }
    }
}