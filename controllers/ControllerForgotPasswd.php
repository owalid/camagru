<?php
require('views/View.php');

Class ControllerForgotPasswd
{
    private $_userManager;
    private $_imageManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception("Page introuvable", 1);
        else if ($_GET['submit'] == 'OK')
            $this->userReqForg();
        else
            $this->forgotPasswd();

    }

    private function forgotPasswd()
    {
        $this->_view = new View('forgotPasswd');
        $this->_view->generate(array('images' => NULL));
    }

    private function userReqForg()
    {
      
        $this->_userManager = new UserManager();
        $res = $this->_userManager->forgotReqPasswd();
        if ($res == "MAIL")
        {
            $this->_view = new View('forgotPasswd');
            $this->_view->generate(array('err' => "Cet email est rataché a aucun utilisateur"));
        }
        else if ($res == "VERIF")
        {
            $this->_view = new View('forgotPasswd');
            $this->_view->generate(array('err' => "Vous devez d'abord verifié votre adresse email"));
        }
        else
        {
            $this->_view = new View('forgotPasswd');
            $this->_view->generate(array('msg' => "Un email vous à été envoyez pour réenitialiser votre mot de passe"));
        }
    }
}