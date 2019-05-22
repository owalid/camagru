<?php
class User
{
    /**
     * idUsr
     *
     * @var int
     */
	private $_idUsr;
	
    /**
     * login
     *
     * @var string
     */
	private $_login;
	
    /**
     * email
     *
     * @var string
     */
	private $_email;
	
    /**
     * passwd
     *
     * @var string
     */
	private $_passwd;
	
    /**
     * imgProfil
     *
     * @var string
     */
    private $_imgProfil;

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
	public function get_idUsr()
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
	public function set_idUsr(int $_idUsr)
	{
		$this->_idUsr = $_idUsr;

		return $this;
	}

	/**
	 * Get login
	 *
	 * @return  string
	 */ 
	public function get_login()
	{
		return $this->_login;
	}

	/**
	 * Set login
	 *
	 * @param  string  $_login  login
	 *
	 * @return  self
	 */ 
	public function set_login(string $_login)
	{
		$this->_login = $_login;

		return $this;
	}

	/**
	 * Get email
	 *
	 * @return  string
	 */ 
	public function get_email()
	{
		return $this->_email;
	}

	/**
	 * Set email
	 *
	 * @param  string  $_email  email
	 *
	 * @return  self
	 */ 
	public function set_email(string $_email)
	{
		$this->_email = $_email;

		return $this;
	}

	/**
	 * Get passwd
	 *
	 * @return  string
	 */ 
	public function get_passwd()
	{
		return $this->_passwd;
	}

	/**
	 * Set passwd
	 *
	 * @param  string  $_passwd  passwd
	 *
	 * @return  self
	 */ 
	public function set_passwd(string $_passwd)
	{
		$this->_passwd = $_passwd;

		return $this;
	}

    /**
     * Get imgProfil
     *
     * @return  string
     */ 
    public function get_imgProfil()
    {
        return $this->_imgProfil;
    }

    /**
     * Set imgProfil
     *
     * @param  string  $_imgProfil  imgProfil
     *
     * @return  self
     */ 
    public function set_imgProfil(string $_imgProfil)
    {
        $this->_imgProfil = $_imgProfil;

        return $this;
    }
}