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
            $this->_userManager = new UserManager();
            // $images = $this->_user->getImages();
            $this->_view = new View('ModifUser');
            $this->_view->generate(array('ModifUser' => NULL));
        }
    }
}