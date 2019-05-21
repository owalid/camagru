<?php

class Image 
{
    /**
     * id_image
     *
     * @var int
     */
    private $_idImg;

    /**
     * img
     *
     * @var string
     */
    private $_img;

    /**
     * img
     *
     * @var int
     */
    private $_nbLike;

    /**
     *  id_usr
     *
     * @var int
     */
    private $_idUsr;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }

// GETTER AND SETTER

    /**
     * Get id_image
     *
     * @return  int
     */ 
    public function get_idImg()
    {
        return $this->_idImg;
    }

    /**
     * Set id_image
     *
     * @param  int  $_idImg  id_image
     *
     * @return  self
     */ 
    public function set_idImg(int $_idImg)
    {
        $this->_idImg = $_idImg;

        return $this;
    }

    /**
     * Get img
     *
     * @return  string
     */ 
    public function get_img()
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
    public function set_img(string $_img)
    {
        $this->_img = $_img;

        return $this;
    }

    /**
     * Get img
     *
     * @return  int
     */ 
    public function get_nbLike()
    {
        return $this->_nbLike;
    }

    /**
     * Set img
     *
     * @param  int  $_nbLike  img
     *
     * @return  self
     */ 
    public function set_nbLike(int $_nbLike)
    {
        $this->_nbLike = $_nbLike;

        return $this;
    }

    /**
     * Get id_usr
     *
     * @return  int
     */ 
    public function get_idUsr()
    {
        return $this->_idUsr;
    }

    /**
     * Set id_usr
     *
     * @param  int  $_idUsr  id_usr
     *
     * @return  self
     */ 
    public function set_idUsr(int $_idUsr)
    {
        $this->_idUsr = $_idUsr;

        return $this;
    }
}