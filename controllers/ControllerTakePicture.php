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
        else if ($_GET['submit'] == 'OK')
            $this->sendPicture();
        else
            $this->takePicture();
    }
    
    private function takePicture()
    {
        $this->_view = new View('TakePicture');
        $this->_view->generate(array('TakePicture' => NULL));
    }

    private function sendPicture()
    {
        $this->_pictureManager = new ImageManager();
        $this->_pictureManager->sendImage();
        $this->_view = new View('Accueil');
        $this->_view->generate(array('TakePicture' => NULL));
        // var_dump("ici");
        // die();
    }
}