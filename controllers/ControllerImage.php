<?php
require('views/View.php');

Class ControllerImage
{
    private $_image;
    private $_commentaire;
    private $_like;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
        throw new Exception("Page introuvable", 1);
        else if ($_GET['like'] == 'yes')
        {
            $this->sendLike();
        }
        else if ($_GET['comment'] == 'yes')
            $this->comment();
        else
            $this->image();
    }
    
    private function image()
    {
        $this->_image =  new ImageManager();
        $this->_view = new View('Image');
        $this->_view->generate(array('image' => NULL));
    }

    private function comment()
    {
        $this->_commentaire = new CommentaireManager();
        $this->_commentaire->sendCommentaire($_GET['idImg']);
        $this->_image = new ImageManager();
        $images = $this->_image->getImages();
        $this->_view = new View('Accueil');
        $this->_view->generate(array('images' => $images));
    }

    private function sendLike()
    {
        $this->_like = new ImageManager();
        $msg = $this->_like->like($_GET['idImg']);
        $this->_image = new ImageManager();
        $images = $this->_image->getImages();
        $this->_view = new View('Accueil');
        $this->_view->generate(array('images' => $images, 'err' => $err));
    }
}