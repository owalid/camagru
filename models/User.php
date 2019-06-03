<?php
class User
{
 
	private $_idUsr;

	private $_login;
	
	private $_email;

	private $_passwd;
	
    private $_pp;

    private $_notifCom;

    private $_notifLike;

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

    public function getUserSaveImages()
    {
        $user_manager = new UserManager;
        return $user_manager->getSave();

    }

// GETTER AND SETTER
	public function getIdUsr()
	{
		return $this->_idUsr;
	}


	public function setIdUsr($_idUsr)
	{
		$this->_idUsr = $_idUsr;

		return $this;
	}


 	public function getLogin()
	{
		return $this->_login;
	}


	public function setLogin($_login)
	{
		$this->_login = $_login;

		return $this;
	}

	
	public function getEmail()
	{
		return $this->_email;
	}

	
	public function setEmail($_email)
	{
		$this->_email = $_email;

		return $this;
	}

	
	public function getPasswd()
	{
		return $this->_passwd;
	}


	public function setPasswd($_passwd)
	{
		$this->_passwd = $_passwd;

		return $this;
	}

    public function getPp()
    {
        if (empty($this->_pp))
            return IMG . "default.png";
        return $this->_pp;
    }

    public function setPp($_pp)
    {
        if (empty($_pp))
            $this->_pp = IMG . "default.png";
        else
            $this->_pp = $_pp;
        return $this;
    }

    public function getBio()
    {
        return $this->_bio;
    }

    public function setBio($_bio)
    {
        $this->_bio = $_bio;

        return $this;
    }


    public function getNotifCom()
    {
        return $this->_notifCom;
    }


    public function setNotifCom($_notifCom)
    {
        $this->_notifCom = $_notifCom;

        return $this;
    }


    public function getNotifLike()
    {
        return $this->_notifLike;
    }


    public function setNotifLike($_notifLike)
    {
        $this->_notifLike = $_notifLike;

        return $this;
    }
}