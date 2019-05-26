<?php
require('views/View.php');

Class ControllerUser 
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
        throw new Exception("Page introuvable", 1);
        else
            $this->userProfil();
    }
    
    private function userProfil()
    {
        session_start();
        if ($_SESSION['user'] == NULL)
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => "Vous devez vous connecté"));
        }
        else
        {
            $this->_view = new View('User');
            $this->_view->generate(array('User' => NULL));
        }
    }
}