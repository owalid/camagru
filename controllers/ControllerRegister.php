<?php
require('views/View.php');

Class ControllerRegister 
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception("Page introuvable", 1);
        else if ($_GET['submit'] === 'ok')
            $this->userReqRegister();
        else
            $this->userRegister();

    }
    
    private function userRegister()
    {
        $this->_userManager = new UserManager();
        // $images = $this->_user->getImages();
        $this->_view = new View('Register');
        $this->_view->generate(array('register' => NULL));
    }

    public function userReqRegister()
    {
        $this->_userManager = new UserManager();
        $this->_userManager->register($_POST);
        $this->_view = new View('Accueil');
    }
}