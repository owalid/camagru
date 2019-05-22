<?php

abstract class Model 
{
    private static $_bdd;

    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=localhost;dbname=camagru', 'root', 'root');
    }

    protected function getBdd()
    {
        if (self::$_bdd == NULL)
            self::setBdd();
        return self::$_bdd;
    }

    protected function getAllPicture($table, $obj)
    {
        $var = [];
        $req = self::$_bdd->prepare('SELECT * FROM ' . $table);
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function registerUser(array $argv)
    {
        $passwd = hash("SHA512", $argv['passwd']);
		$login =  $argv['login'];
		$email = $argv['email'];
		// var_dump($argv);
		// die();
		if ($this->loginIsExist($login) == TRUE)
		{
			return ("LOGIN");
		}
		if ($this->emailIsExist($email) == TRUE)
			return ("EMAIL");
		$pp = $argv['pp'];
		// if ($pp == NULL)
			// $pp = NULL;
        $bio = $argv['bio'];
        $req = self::$_bdd->prepare("INSERT INTO user (login, passwd, email, pp, bio)
        VALUES ('$login', '$passwd', '$email', '$pp', '$bio')");
        $req->execute();
        $req->closeCursor();
    }
    
    protected function logUser($login, $passwd)
    {
        // if (loginIsExist($login) == TRUE)
		//     return (FALSE);
		// $user = [];
		// $var = [];
        $passwd = hash("SHA512", $passwd);
        $req = self::$_bdd->prepare("SELECT *
            FROM user 
            WHERE login = '$login'
            AND passwd = '$passwd'");
        $req->execute();
		$data = $req->fetch(PDO::FETCH_ASSOC);
        // {
        //     $var[] = new User($data);
        // }
        // if ($var == NULL)
		// return FALSE;
		// var_dump($var);
		// die();
        return $data;
		// var_dump($data);
		// die();
		// $user[] = new User($data);
        // return $user;
        $req->closeCursor();
    }

    protected function loginIsExist($login)
    {
        $req = self::$_bdd->prepare("SELECT login
        FROM user 
        WHERE login = '$login'");
        $req->execute();
		$data = $req->fetch(PDO::FETCH_ASSOC);
		// var_dump($data);
		// die();
        if ($data == NULL)
            return FALSE;
        return TRUE;
        $req->closeCursor();
	}

    protected function EmailIsExist($email)
    {
        $req = self::$_bdd->prepare("SELECT email
        FROM user 
        WHERE email = '$email'");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        if ($data == NULL)
            return FALSE;
        return TRUE;
        $req->closeCursor();
    }

    protected function update_user(array $argv)
    {
        $login = $argv['login'];
        $email = $argv['email'];
        $bio = $argv['bio'];
        $pp = $argv['pp'];
        $req = "UPDATE user 
                SET login = '$login',
                    email = '$email',
                    bio = '$bio',
                    pp = '$pp'
                WHERE id_usr = '$id_login'";
        $req->execute();
        $req->closeCursor();
    }

    public function getAllCommentaire($id_img)
    {
        $var = [];
        $req = "SELECT *
                FROM commentaire
                WHERE id_img = $id_img";
                $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }
}