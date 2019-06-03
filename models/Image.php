<?php

class Image 
{

    private $_idUsr;

    private $_idImg;

    private $_nbLike;

    private $_img;


    private $_description;


    public function __construct(array $data, $nbLike)
    {
        $this->hydrate($data, $nbLike);
    }

    public function hydrate(array $data, $nbLike)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
        $this->setNbLike($nbLike);
    }

// GETTER AND SETTER


    public function getUsrPosted($idUsr)
    {
        $image_manager = new ImageManager;
        return $image_manager->getUsrPostedImg($idUsr);
    }

    public function getAllComment($idImg)
    {
        $image_manager = new ImageManager;
        return $image_manager->getImgComment($idImg);
    }

    public function getIdUsr()
    {
        return $this->_idUsr;
    }

    public function setIdUsr($_idUsr)
    {
        $this->_idUsr = $_idUsr;

        return $this;
    }


    public function getIdImg()
    {
        return $this->_idImg;
    }


    public function setIdImg($_idImg)
    {
        $this->_idImg = $_idImg;

        return $this;
    }


    public function getNbLike()
    {
        return $this->_nbLike;
    }

 
    public function setNbLike($_nbLike)
    {
        $this->_nbLike = $_nbLike;

        return $this;
    }


    public function getImg()
    {
        return $this->_img;
    }


    public function setImg($_img)
    {
        $this->_img = $_img;

        return $this;
    }


    public function getDescription()
    {
        return $this->_description;
    }

    public function setDescription($_description)
    {
        $this->_description = $_description;

        return $this;
    }
}