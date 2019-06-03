<?php
require('views/View.php');

Class ControllerLogin
{
    private $_userManager;
    private $_imageManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception("Page introuvable", 1);
        else if ($_GET['submit'] == 'OK')
            $this->userReqLogin();
        else
            $this->userLogin();

    }
    
    private function userLogin()
    {
        session_start();
        if ($_SESSION['user'])
        {
            $this->_imageManager = new ImageManager();
            $images = $this->_imageManager->getImages(0, 3);;
            $this->_view = new View('Accueil');
            $this->_view->generate(array('images' => $images));
        }
        else
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('login' => NULL));
        }
    }

    public function userReqLogin()
    {
		$this->_userManager = new UserManager();
        $user = $this->_userManager->log();
        
        if ($user == "VERIF")
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => 'Vous n\'avez pas verifié votre adresse mail.'));
        }
        else if ($user == "LOG")
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => 'Votre mot de passe ou votre login est incorrect.'));
        }
		else
		{
            $this->_imageManager = new ImageManager();
            $images = $this->_imageManager->getImages(0, 3);
			$this->_view = new View('Accueil');
			$this->_view->generate(array('user' => $user, 'images' => $images, 'msg' => "Bon retour parmis nous " . $user->getLogin()));
		}
    }
}