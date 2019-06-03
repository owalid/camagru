<?php
require('views/View.php');

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
        if (!$_GET)
        {
            $images = $this->_imageManager->getImages(0, 3);
            $this->_view = new View('Accueil');
            $this->_view->generate(array('images' => $images));
        }
        else
        {
            $images = $this->_imageManager->getImages($_GET['offset'], $_GET['limit']);
            if ($images)
            {
                extract($images);
                ob_start();
                require 'views/viewAccueil.php';
                $data = ob_get_clean();
                echo $data;
            }
            else
            {
                echo json_encode(array('finish' => 1));
            }
        }
    }
}