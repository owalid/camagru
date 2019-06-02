<?php
require('views/View.php');

Class ControllerImage
{
    private $_image;
    private $_commentaire;
    private $_like;
    private $_save;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count($url) > 1)
        throw new Exception("Page introuvable", 1);
        else if ($_GET['like'] == 'yes')
            $this->sendLike();
        else if ($_GET['comment'] == 'yes')
            $this->comment();
        else if ($_GET['save'] == 'yes')
            $this->save();
        else if ($_GET['delete'] == 'yes')
            $this->delete();
        else
            $this->image();
    }
    
    private function image()
    {
        $this->_image =  new ImageManager();
        $this->_view = new View('Image');
        $this->_view->generate(array('image' => NULL));
    }

    private function delete()
    {
        $this->_image = new ImageManager();
        $res = $this->_image->deleteImg();
        if ($res != NULL)
        {
            echo json_encode(["success" => 0, "res" => $res]);
        }
        else
        {
            echo json_encode(["success" => 1]);
        }
    }

    private function comment()
    {
        $this->_commentaire = new CommentaireManager();
        $err = $this->_commentaire->sendCommentaire($_GET['idImg']);
        if ($err == "LOGIN")
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => "Vous devez vous connecté pour pouvoir commenté une photo"));
        }
        else
        {
            $this->_image = new ImageManager();
            $images = $this->_image->getImages(0, 3);
            $this->_view = new View('Accueil');
            $this->_view->generate(array('images' => $images));
        }
    }

    private function save()
    {
        session_start();
        if ($_SESSION['user'] == NULL)
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => "Vous devez vous connecté pour pouvoir enrengistré une photo"));
        }
        else
        {   
            $this->_image = new ImageManager();
            $images = $this->_image->getImages(0, 3);;
            $res = $this->_image->saveImg();
            $this->_view = new View('Accueil');
            if ($res == "ERR")
               $this->_view->generate(array('images' => $images, 'err' => "Photo deja dans vos enrengistrement"));
            else
                $this->_view->generate(array('images' => $images, 'msg' => "Photo ajouté a vos enrengistrement avec succées"));
        }   
    }

    private function sendLike()
    {
        $this->_like = new ImageManager();
        $err = $this->_like->like($_GET['idImg']);
       
        if ($err == "LOGIN")
        {
            $this->_view = new View('Login');
            $this->_view->generate(array('err' => "Vous devez vous connecté pour pouvoir liké"));
        }
        else 
        {
            $this->_image = new ImageManager();
            $images = $this->_image->getImages(0, 3);;
            $this->_view = new View('Accueil');
            $this->_view->generate(array('images' => $images, 'err' => $err));
        }
    }
}