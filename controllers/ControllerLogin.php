<?php
require('views/View.php');

Class ControllerLogin
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception("Page introuvable", 1);
        else if ($_GET['submit'] === 'ok')
            $this->userReqLogin();
        else
            $this->userLogin();

    }
    
    private function userLogin()
    {
        // $this->_userManager = new UserManager();
        // $images = $this->_user->getImages();
        $this->_view = new View('Login');
        $this->_view->generate(array('login' => NULL));
    }

    public function userReqLogin()
    {
        $this->_userManager = new UserManager();
        $this->_userManager->register($_POST);
        $this->_view = new View('Accueil');
    }
}