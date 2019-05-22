<?php
require('views/View.php');

Class ControllerTakePicture 
{
    private $_pictureManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
        throw new Exception("Page introuvable", 1);
        else
        $this->takePicture();
    }
    
    private function takePicture()
    {
        $this->_view = new View('TakePicture');
        $this->_view->generate(array('TakePicture' => NULL));
    }
}