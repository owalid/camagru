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
            $nbLike = $this->getNbLike($data['idImg']);
            $var[] = new $obj($data, $nbLike);
        }
        return $var;
        $req->closeCursor();
    }

    protected function registerUser(array $argv)
    {
        $passwd = hash("SHA512", $argv['passwd']);
		$login =  $argv['login'];
        $email = $argv['email'];
		if ($this->loginIsExist($login) == TRUE)
        return ("LOGIN");
		if ($this->emailIsExist($email) == TRUE)
        return ("EMAIL");
        $hash = md5(rand(0,10000));
		$pp = $argv['pp'];
        $bio = $argv['bio'];
        $req = self::$_bdd->prepare("INSERT INTO user (login, passwd, email, pp, bio, hash)
        VALUES ('$login', '$passwd', '$email', '$pp', '$bio', '$hash')");
        $this->sendMail($email, $login, $hash);
        $req->execute();
        $req->closeCursor();
    }
    
    protected function sendMail($email, $login, $hash)
    {
        $to      = $email; // Send email to our user
        $subject = 'Signup | Verification'; // Give the email a subject 
        $message = '
        
         _____                                              
        /  __ \                                             
        | /  \/  __ _  _ __ ___    __ _   __ _  _ __  _   _ 
        | |     / _  ||  _   _ \  / _  | / _  | __ | | | |
        | \__/\| (_| || | | | | || (_| || (_| || |   | |_| |
         \____/ \__,_||_| |_| |_| \__,_| \__, ||_|    \__,_|
                                          __/ |             
                                         |___/              
        
        
        ------------------------

        Thanks you ' . $login . ' for signing up!
        
        ------------------------
        
        Please click this link to activate your account:
        '. URL .'?url=verifemail&email='. $email . '&hash=' . $hash . '
        
        '; // Our message above including the link
                            
        $headers = 'From:noreply@camagru.com' . "\r\n"; // Set from headers
        mail($to, $subject, $message, $headers);
    }

    protected function logUser($login, $passwd)
    {
        $passwd = hash("SHA512", $passwd);
        $req = self::$_bdd->prepare("SELECT *
            FROM user 
            WHERE login = '$login'
            AND passwd = '$passwd'");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        if ($data['isVerif'] == "0" && isset($data['login']))
            return "VERIF";
        if (empty($data['login']))
            return "LOG";
        $res = new User($data);
        return $res;
        $req->closeCursor();
    }

    protected function loginIsExist($login)
    {
        $req = self::$_bdd->prepare("SELECT login
        FROM user 
        WHERE login = '$login'");
        $req->execute();
		$data = $req->fetch(PDO::FETCH_ASSOC);
        if ($data == NULL)
            return FALSE;
        return TRUE;
        $req->closeCursor();
	}

    protected function emailIsExist($email)
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
        session_start();
        $usr = intval($_SESSION['user']->getIdUsr());
        $description = $_POST['description'];
        $req = self::$_bdd->prepare("INSERT INTO image (img, nbLike, idUsr, description)
        VALUES ('$img', '0', '$usr', '$description')");
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
        if ($_SESSION['user'] == NULL)
        return ("LOGIN");
        else
        {
            $usr = intval($_SESSION['user']->getIdUsr());
            $req = self::$_bdd->prepare("INSERT INTO commentaire (commentaire, idImg, idUsr)
                                        VALUES (:commentaire, :idImg, :idUsr)");
            $req->execute([':commentaire' => $commentaire,
            ':idImg' => $idImg,
            ':idUsr' => $usr]);
            $req->closeCursor();
        }
    }

    public function getUsrImages($idUsr)
    {
        $res = [];
        $req = self::$_bdd->prepare("SELECT *
                                    FROM image
                                    WHERE idUsr = '$idUsr'");
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $nbLike = $this->getNbLike($data['idImg']);
            $res[] = new Image($data, $nbLike);
        }
        return $res;
        $req->closeCursor();
    }

    public function getNbLike($idImg)
    {
        $req = self::$_bdd->prepare("SELECT count(`like`.idLike) as nbLike
                                    FROM `like`
                                    WHERE idImg = '$idImg'");
        $req->execute();
        $var = $req->fetch(PDO::FETCH_ASSOC);
        return $var["nbLike"];
        $req->closeCursor();
    }

    public function sendLike($idImg)
    {
        
        session_start();
        if ($_SESSION['user'] == NULL)
            return ("LOGIN");
        else
        {
            $idUsr = $_SESSION['user']->getIdUsr();
            $verif = self::$_bdd->prepare("SELECT *
                                    FROM `like`
                                    WHERE idUsr = '$idUsr'
                                    AND idImg = '$idImg'");
            $verif->execute();
            $ret = $verif->fetch(PDO::FETCH_ASSOC);
            if ($ret == FALSE)
            {
                $req = self::$_bdd->prepare("INSERT INTO `Like` (idUsr, idImg, isLiked)
                                        VALUES ('$idUsr', '$idImg', true)");
                $req->execute();
                $req->closeCursor();
            }
            else
                return ("vous avez déjà aimé cette photo");
        }
    }

    public function getLike()
    {
        session_start();
        $res = [];
        $idUsr = $_SESSION['user']->getIdUsr();
        $req = self::$_bdd->prepare("SELECT  image.img, user.login, user.pp
                                     FROM `like` as l, image, user
                                     WHERE l.idImg = image.idImg
                                     AND image.idUsr = '$idUsr'
                                     AND l.idUsr = User.idUsr");
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $res[] = $data;
        }
        return ($res);
        $req->closeCursor();
    }

    public function getCommentairesUsr()
    {
     
        session_start();
        $res = [];
        $idUsr = $_SESSION['user']->getIdUsr();
        $req = self::$_bdd->prepare("SELECT image.img, user.login, user.pp, commentaire.commentaire
                                     FROM commentaire, image, user
                                     WHERE commentaire.idImg = image.idImg
                                     AND image.idUsr = '$idUsr'
                                     AND commentaire.idUsr = User.idUsr");

        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $res[] = $data;
        }
        return ($res);
        $req->closeCursor();
    }

    public function verifMail()
    {
        $email = $_GET['email'];
        $hash = $_GET['hash'];
        $req = self::$_bdd->prepare("SELECT *
        FROM user 
        WHERE email = '$email'
        AND hash = '$hash'
        ");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        if ($data == NULL)
            return "ERR";
        else if ($data['isVerif'] == false)
        {
            $req = self::$_bdd->prepare("UPDATE user
            SET isVerif = true
            WHERE email = '$email'");
            $req->execute();
            return "OK";
        }
        else if ($data['isVerif'] == true)
            return "VERIFIED";
    }
}