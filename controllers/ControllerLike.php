<?php
require('views/View.php');

Class ControllerLike
{
    private $_likeManager;
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
        // $this->_userManager = new UserManager();
        // $images = $this->_user->getImages();
        $this->_view = new View('Like');
        $this->_view->generate(array('like' => NULL));
    }
}