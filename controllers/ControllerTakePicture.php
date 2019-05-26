<?php
require('views/View.php');

Class ControllerTakePicture 
{
    private $_imageManager;
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
        session_start();
        if ($_SESSION['user'] == NULL)
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => "Vous devez vous connecté"));
        }
        else
        {
            $this->_view = new View('TakePicture');
            $this->_view->generate(array('TakePicture' => NULL));
        }
    }

    private function sendPicture()
    {
        session_start();
        if ($_SESSION['user'] == NULL)
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => "Vous devez vous connecté"));
        }
        else
        {
            $this->_imageManager = new ImageManager();
            $this->_imageManager->sendImage();
            $images = $this->_imageManager->getImages();
            $this->_view = new View('Accueil');
            $this->_view->generate(array('images' => $images, 'msg' => 'Votre publication à bien été postée'));
        }
    }
}