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
        $this->_view = new View('Register');
        $this->_view->generate(array('register' => NULL));
	}

    public function userReqRegister()
    {
        $this->_userManager = new UserManager();
        $res = $this->_userManager->register();
        if ($res)
        {
            $this->_view = new View('Register');
			$this->_view->generate(array('err' => $res));
        }
		else
		{
			$this->_view = new View('Login');
			$this->_view->generate(array('msg' => "Derniere etape avant de vous connecté, veuillez maintenant verifié votre adresse mail"));
		}
    }
}