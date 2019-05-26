<?php
require('views/View.php');

Class ControllerLike
{
    private $_likeManager;
    private $_userManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
            throw new Exception("Page introuvable", 1);
        else
            $this->like();
    }
    
    private function like()
    {
        session_start();
        if ($_SESSION['user'] == NULL)
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => "Vous devez vous connecté"));
        }
        else
        {
            $this->_userManager = new UserManager();
            $likes = $this->_userManager->getLikeUser();
            $commentaires = $this->_userManager->getComs();
            $this->_view = new View('Like');
            $this->_view->generate(array('likes' => $likes, 'commentaires' => $commentaires));
        }
    }
}