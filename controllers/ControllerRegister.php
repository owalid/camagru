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
        else if ($_GET['submit'] === 'OK')
            $this->userReqRegister();
        else
            $this->userRegister();
    }
    
    private function userRegister()
    {
        $this->_userManager = new UserManager();
        // $images = $this->_user->getImages(0, 3);;
        $this->_view = new View('Register');
        $this->_view->generate(array('register' => NULL));
	}

    public function userReqRegister()
    {
        $this->_userManager = new UserManager();
		$result = $this->_userManager->register();
		if ($result == "LOGIN")
		{
			$this->_view = new View('Register');
			$this->_view->generate(array('err' => "Ce login existe deja"));
		}
		else if ($result == "EMAIL")
		{
			$this->_view = new View('Register');
			$this->_view->generate(array('err' => "Cette adresse mail à existe dejà"));
		}
		else
		{
			$this->_view = new View('Login');
			$this->_view->generate(array('msg' => "Derniere etape avant de vous connecté, veuillez maintenant verifié votre adresse mail"));
		}
    }
}