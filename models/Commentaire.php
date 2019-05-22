<?php

Class Commentaire
{
        /**
     * id_image
     *
     * @var int
     */
    private $_idUsr;
        /**
     * id_image
     *
     * @var int
     */
    private $_idImg;
    /**
     * id_image
     *
     * @var int
     */
    private $_idCommentaire;
        /**
     * id_image
     *
     * @var string
     */
    private $_commenataire;

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

    /**
     * Get id_image
     *
     * @return  int
     */ 
    public function get_idUsr()
    {
        return $this->_idUsr;
    }

    /**
     * Set id_image
     *
     * @param  int  $_idUsr  id_image
     *
     * @return  self
     */ 
    public function set_idUsr(int $_idUsr)
    {
        $this->_idUsr = $_idUsr;

        return $this;
    }

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
     * Get id_image
     *
     * @return  int
     */ 
    public function get_idCommentaire()
    {
        return $this->_idCommentaire;
    }

    /**
     * Set id_image
     *
     * @param  int  $_idCommentaire  id_image
     *
     * @return  self
     */ 
    public function set_idCommentaire(int $_idCommentaire)
    {
        $this->_idCommentaire = $_idCommentaire;

        return $this;
    }

    /**
     * Get id_image
     *
     * @return  string
     */ 
    public function get_commenataire()
    {
        return $this->_commenataire;
    }

    /**
     * Set id_image
     *
     * @param  string  $_commenataire  id_image
     *
     * @return  self
     */ 
    public function set_commenataire(string $_commenataire)
    {
        $this->_commenataire = $_commenataire;

        return $this;
    }
}