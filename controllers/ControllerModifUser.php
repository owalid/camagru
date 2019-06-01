<?php
require('views/View.php');

Class ControllerModifUser 
{
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
        throw new Exception("Page introuvable", 1);
        else if($_GET['modif'] == "yes")
            $this->modifInfoUser();
        else if ($_GET['passwd'] == "yes")
            $this->modifPasswd();
        else if ($_GET['notif'] == "yes")
            $this->modifNotif();
        else
            $this->modifUser();
    }
    
    private function modifUser()
    {
        session_start();
        if ($_SESSION['user'] == NULL)
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => "Vous devez vous connecté"));
        }
        else
        {

            $this->_view = new View('ModifUser');
            $this->_view->generate(array('ModifUser' => NULL));
        }
    }

    private function modifInfoUser()
    {
        // $res = [];
        $this->_userManager = new UserManager();
        $res = $this->_userManager->modifUserInfo();

        if ($res == "OK" || $res == NULL)
        {
            // $this->_view = new View('User');
            $out = ($res == "OK") ?  "Vous devez verifier votre nouvelle adresse mail ✅" : NULL;
            echo json_encode(array('success' => '1', 'res' => $out));
            // $this->_view->generate(array('User' => $out));
        }
        else
        {
            echo json_encode($res);
        }
    }

    private function modifPasswd()
    {
        $this->_userManager = new UserManager();
        $res = $this->_userManager->modifUserPasswd();
        if (empty($res))
        {
            echo json_encode(array('success' => '1', 'res' => "Votre mot de passe à été modifié avec succés"));
        }
        else
        {
            echo json_encode(array('success' => '0', 'res' => $res));
        }
    }

    private function modifNotif()
    {
        $this->_userManager = new UserManager();
        $res = $this->_userManager->modifUserNotif();
        $this->_view = new View('User');
        $this->_view->generate(array('User' => NULL));
    }
}