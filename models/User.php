<?php
class User
{
    /**
     * idUsr
     *
     * @var string
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
     * pp
     *
     * @var string
     */
    private $_pp;
    /**
     * bio
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
		foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
		}
    }
    
    public function getUserImages()
    {
        $user_manager = new UserManager;
        return $user_manager->getPicUsr($this->getIdUsr());
    }

// GETTER AND SETTER
	public function getIdUsr()
	{
		return $this->_idUsr;
	}


	public function setIdUsr(string $_idUsr)
	{
		$this->_idUsr = $_idUsr;

		return $this;
	}


 	public function getLogin()
	{
		return $this->_login;
	}


	public function setLogin(string $_login)
	{
		$this->_login = $_login;

		return $this;
	}

	
	public function getEmail()
	{
		return $this->_email;
	}

	
	public function setEmail(string $_email)
	{
		$this->_email = $_email;

		return $this;
	}

	
	public function getPasswd()
	{
		return $this->_passwd;
	}


	public function setPasswd(string $_passwd)
	{
		$this->_passwd = $_passwd;

		return $this;
	}

    /**
     * Get pp
     *
     * @return  string
     */ 
    public function getPp()
    {
        return $this->_pp;
    }

   
    public function setPp(string $_pp)
    {
        if (empty($_pp))
            $this->_pp = URL . "/img/default";
        else
            $this->_pp = $_pp;
        return $this;
    }

   
    public function getBio()
    {
        return $this->_bio;
    }

   
    public function setBio(string $_bio)
    {
        $this->_bio = $_bio;

        return $this;
    }
}