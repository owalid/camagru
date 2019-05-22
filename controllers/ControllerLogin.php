<?php
require('views/View.php');

Class ControllerLogin
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
		// var_dump($_POST);
		// die();
        if (isset($url) && count($url) > 1)
            throw new Exception("Page introuvable", 1);
        else if ($_GET['submit'] === 'OK')
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
		// var_dump($var);
		// die();
		$this->_userManager = new UserManager();
		$user = $this->_userManager->log();
		if ($user == TRUE)
		{
			$this->_view = new View('Accueil');
			$this->_view->generate(array('user' => $user));
		}
		else
		{
			$this->_view = new View('Login');
			$this->_view->generate(array('err' => 'Votre mot de passe ou votre login est incorrect.'));
		}
    }
}