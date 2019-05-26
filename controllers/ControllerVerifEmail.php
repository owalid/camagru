<?php
require('views/View.php');

class ControllerVerifEmail
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
        throw new Exception("Page introuvable", 1);
        else
            $this->verifEmail();
    }
    
    private function verifEmail()
    {
        $this->_userManager = new UserManager();
        $msg = $this->_userManager->verifUsr();
        if ($msg == "OK")
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('msg' => "Votre adresse mail à été verifié 👍"));
        }
        else if ($msg == "VERIFIED")
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('msg' => "Votre adresse mail à déjâ été verifié 😎"));
        }
        else
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => "Une erreur est survenue lors de la verification de l'adresse mail 😭"));
        }
    }
}