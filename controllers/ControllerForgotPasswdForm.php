<?php
require('views/View.php');

Class ControllerForgotPasswdForm
{
    private $_userManager;
    private $_imageManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception("Page introuvable", 1);
        else if ($_GET['submit'] == 'OK')
            $this->userReqReset();
        else
            $this->resetForm();

    }

    private function resetForm()
    {
        $this->_view = new View('forgotPasswdForm');
        $this->_view->generate(array('images' => NULL));
    }

    private function userReqReset()
    {
        $this->_userManager = new UserManager();
        $res = $this->_userManager->resetReqPasswd();
        if ($res == "OK")
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('msg' => "Votre mot de passe à été modifié avec succés"));
        }
        else
        {
            $this->_view = new View('forgotPasswdForm');
            $this->_view->generate(array('err' => "Erreur, votre requete à espiré"));
        }
    }
}