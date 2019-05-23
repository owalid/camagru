<?php

abstract class Model 
{
    private static $_bdd;

    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=localhost;dbname=camagru;charset:utf8mb4_unicode_ci', 'root', 'root');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        // return ($data);
        $res = new User($data);

        // {
        //     $var[] = new User($data);
        // }
        // if ($var == NULL)
		// return FALSE;
		// var_dump($var);
		// die();
        return $res;
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
        $req = self::$_bdd->prepare("SELECT *
                FROM commentaire
                WHERE id_img = $id_img");
                $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    public function sendPicture()
    {
        $img = $_POST['image'];
        // var_dump($img);
        // die();
        session_start();
        $usr = intval($_SESSION['user']['idUsr']);
        $description = $_POST['description'];
        $req = self::$_bdd->prepare("INSERT INTO image (img, nbLike, idUsr, description)
        VALUES ('$img', '0', '$usr', '$description')");
        // var_dump(self::$_bdd->errorInfo());
        // die();
        $req->execute();
        $req->closeCursor();
    }

    public function getUsr($idUsr)
    {
        $req = self::$_bdd->prepare("SELECT *
                    FROM user
                    WHERE idUsr = $idUsr");
        $req->execute();
        $res = $req->fetch(PDO::FETCH_ASSOC);
        $user = new User($res);
        return ($user);
        $req->closeCursor();
    }

    public function getComments($idImg)
    {
       
        $var = [];
        $req = self::$_bdd->prepare("SELECT user.pp, user.login, commentaire.commentaire
        FROM commentaire, user
        WHERE idImg = $idImg
        AND user.idUsr = commentaire.idUsr");
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = $data;
        }
        return ($var);
        $req->closeCursor();
    }

    public function postCommentaire($idImg)
    {
        $commentaire = htmlentities($_POST['commentaire']);
        session_start();
        $usr = intval($_SESSION['user']['idUsr']);
        // var_dump($usr)
        $req = self::$_bdd->prepare("INSERT INTO commentaire (commentaire, idImg, idUsr) VALUES (:commentaire, :idImg, :idUsr)");
        // $req = self::$_bdd->prepare("INSERT INTO commentaire (commentaire, idImg, idUsr)
        // VALUES ('$commentaire', '$idImg', '$usr')");
        $req->execute([':commentaire' => $commentaire,
                        ':idImg' => $idImg,
                        ':idUsr' => $usr]);
        $req->closeCursor();
    }

    public function getUsrImages()
    {
        //todo
    }
}