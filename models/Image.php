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
     *  desc
     *
     * @var string
     */
    private $_desc;


    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }

// GETTER AND SETTER


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
     * Get desc
     *
     * @return  string
     */ 
    public function getDesc()
    {
        return $this->_desc;
    }

    /**
     * Set desc
     *
     * @param  string  $_desc  desc
     *
     * @return  self
     */ 
    public function setDesc(string $_desc)
    {
        $this->_desc = $_desc;

        return $this;
    }
}