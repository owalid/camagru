<?php
Class ControllerAccueil 
{
    private $_imageManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
        throw new Exception("Page introuvable", 1);
        else
        $this->images();
        
    }
    
    private function images()
    {
        $this->_imageManager = new ImageManager();
        $images = $this->_imageManager->getImages();
        require_once('views/viewAccueil.php');
    }
}