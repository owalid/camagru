<?php
require('views/View.php');

Class ControllerImage
{
    private $_image;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
        throw new Exception("Page introuvable", 1);
        else if ($_GET['like'] != NULL)
            $this->like();
        else if ($_GET['comment'] != NULL)
            $this->comment();
        else
            $this->image();
    }
    
    private function image()
    {
        $this->_userManager = new UserManager();
        $this->_view = new View('Image');
        $this->_view->generate(array('image' => NULL));
    }
}