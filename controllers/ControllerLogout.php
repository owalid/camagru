<?php
require('views/View.php');

Class ControllerLogout
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception("Page introuvable", 1);
        else
            $this->userLogout();
    }
    
    private function userLogout()
    {
        session_start();
        $this->_userManager = new UserManager();
		$this->_userManager->logout();

        $this->_view = new View('Login');
        $this->_view->generate(array('msg' => "à bientôt 👋"));
    }
}