<?php

class Image 
{
    /**
     * idUsr
     *
     * @var int
     */
    private $_idUsr;

    /**
     * idImg
     *
     * @var int
     */
    private $_idImg;

    /**
     * nbLike
     *
     * @var int
     */
    private $_nbLike;

    /**
     *  img
     *
     * @var string
     */
    private $_img;

    /**
     *  description
     *
     * @var string
     */
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

    /**
     * Get idUsr
     *
     * @return  int
     */ 
    public function getIdUsr()
    {
        return $this->_idUsr;
    }

    /**
     * Set idUsr
     *
     * @param  int  $_idUsr  idUsr
     *
     * @return  self
     */ 
    public function setIdUsr(int $_idUsr)
    {
        $this->_idUsr = $_idUsr;

        return $this;
    }

    /**
     * Get idImg
     *
     * @return  int
     */ 
    public function getIdImg()
    {
        return $this->_idImg;
    }

    /**
     * Set idImg
     *
     * @param  int  $_idImg  idImg
     *
     * @return  self
     */ 
    public function setIdImg(int $_idImg)
    {
        $this->_idImg = $_idImg;

        return $this;
    }

    /**
     * Get nbLike
     *
     * @return  int
     */ 
    public function getNbLike()
    {
        return $this->_nbLike;
    }

    /**
     * Set nbLike
     *
     * @param  int  $_nbLike  nbLike
     *
     * @return  self
     */ 
    public function setNbLike(int $_nbLike)
    {
        $this->_nbLike = $_nbLike;

        return $this;
    }

    /**
     * Get img
     *
     * @return  string
     */ 
    public function getImg()
    {
        return $this->_img;
    }

    /**
     * Set img
     *
     * @param  string  $_img  img
     *
     * @return  self
     */ 
    public function setImg(string $_img)
    {
        $this->_img = $_img;

        return $this;
    }

    /**
     * Get description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Set description
     *
     * @param  string  $_description  description
     *
     * @return  self
     */ 
    public function setDescription(string $_description)
    {
        $this->_description = $_description;

        return $this;
    }
}