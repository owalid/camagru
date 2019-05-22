<?php

class Image 
{
    /**
     * id_image
     *
     * @var int
     */
    private $_idUsr;

    /**
     * img
     *
     * @var string
     */
    private $_login;

    /**
     * img
     *
     * @var string
     */
    private $_email;

    /**
     *  id_usr
     *
     * @var string
     */
    private $_passwd;

    /**
     *  id_usr
     *
     * @var string
     */
    private $_imgProfil;
    
    /**
     *  id_usr
     *
     * @var string
     */
    private $_bio;

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
     * Get img
     *
     * @return  string
     */ 
    public function get_login()
    {
        return $this->_login;
    }

    /**
     * Set img
     *
     * @param  string  $_login  img
     *
     * @return  self
     */ 
    public function set_login(string $_login)
    {
        $this->_login = $_login;

        return $this;
    }

    /**
     * Get img
     *
     * @return  string
     */ 
    public function get_email()
    {
        return $this->_email;
    }

    /**
     * Set img
     *
     * @param  string  $_email  img
     *
     * @return  self
     */ 
    public function set_email(string $_email)
    {
        $this->_email = $_email;

        return $this;
    }

    /**
     * Get id_usr
     *
     * @return  string
     */ 
    public function get_passwd()
    {
        return $this->_passwd;
    }

    /**
     * Set id_usr
     *
     * @param  string  $_passwd  id_usr
     *
     * @return  self
     */ 
    public function set_passwd(string $_passwd)
    {
        $this->_passwd = $_passwd;

        return $this;
    }

    /**
     * Get id_usr
     *
     * @return  string
     */ 
    public function get_imgProfil()
    {
        return $this->_imgProfil;
    }

    /**
     * Set id_usr
     *
     * @param  string  $_imgProfil  id_usr
     *
     * @return  self
     */ 
    public function set_imgProfil(string $_imgProfil)
    {
        $this->_imgProfil = $_imgProfil;

        return $this;
    }

    /**
     * Get id_usr
     *
     * @return  string
     */ 
    public function get_bio()
    {
        return $this->_bio;
    }

    /**
     * Set id_usr
     *
     * @param  string  $_bio  id_usr
     *
     * @return  self
     */ 
    public function set_bio(string $_bio)
    {
        $this->_bio = $_bio;

        return $this;
    }
}