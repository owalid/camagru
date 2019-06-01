<?php

class UserManager extends Model
{
    public function register()
    {
        if (isset($_POST) && !empty($_POST) 
            && isset($_POST['bio']) && !empty($_POST['bio'])
            && isset($_POST['passwd1']) && !empty($_POST['passwd1'])
            && isset($_POST['passwd2']) && !empty($_POST['passwd2'])
            && isset($_POST['login']) && !empty($_POST['login'])
            && isset($_POST['email']) && !empty($_POST['email']))
        {
            $err = [];
            $i = 0;
            $this->getBdd();
            if (strlen($_POST['bio']) >= 516)
                $err[$i++] = "Votre bio est trop longue";
            if (strlen($_POST['passwd1']) <= 8)
                $err[$i++] = "Veuillez rentré un mot de passe de plus de 8 caractere";
            if (strcmp($_POST['passwd1'], $_POST['passwd2']) != 0)
                $err[$i++] = "Les mots de passes ne correspondent pas";
            $passwd1 = hash("SHA512", $_POST['passwd1']);
            $passwd2 = hash("SHA512", $_POST['passwd2']);
            $login =  $this->filterString($_POST['login']);
            $email = $this->filterString($_POST['email']);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if  (strlen($login) >= 90)
                $err[$i++] = "Votre login est trop long";
            if ($email == FALSE || strlen($email) >= 90)
                $err[$i++] = "L'adresse mail entré n'est pas au bon format";
            if ($this->loginIsExist($login) != NULL)
                $err[$i++] = "Ce login existe deja";
            if ($this->emailIsExist($email) != NULL)
                $err[$i++] = "Cette adresse mail à existe dejà";
            if (isset($err) && !empty($err))
                return $err;
            else
            {
                $hash = md5(rand(0,10000));
                $pp = $_POST['pp'];
                $bio = htmlentities($_POST['bio']);
                $req = $this->getBdd()->prepare("INSERT INTO user (login, passwd, email, pp, bio, hash)
                                                    VALUES (:login, :passwd, :email, :pp, :bio, :hash)");
                if (!($this->sendMailVerif($email, $login, $hash)))
                {
                    $out = "Une erreur est survenue lors de l'envois du mail";
                    return $out;
                }
                $req->execute([':login' => $login, ':passwd' => $passwd1, ':email' => $email,
                ':pp' => $pp, ':bio' => $bio, ':hash' => $hash]);
                $req->closeCursor();
            }
        }
        return ("ERR");
    }

    public function log()
    {
        if (isset($_POST) && !empty($_POST)
            && isset($_POST['login']) && !empty($_POST['login'])
            && isset($_POST['passwd']) && !empty($_POST['passwd']))
        {
            $this->getBdd();
            $login = $this->filterString($_POST['login']);
            $passwd =  $this->filterString($_POST['passwd']);
            $passwd = hash("SHA512", $passwd);
            $req = $this->getBdd()->prepare("SELECT *
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
    }

    public function logout()
    {
        session_start();
        if (isset($_SESSION['user']))
        {
            $_SESSION['user'] = NULL;
        }
    }

    public function getLikeUser()
    {
        session_start();
        if (isset($_SESSION['user']) && !empty($_SESSION['user']))
        {
            $this->getBdd();
            $res = [];
            $idUsr = $_SESSION['user']->getIdUsr();
            $req = $this->getBdd()->prepare("SELECT image.img, user.login, user.pp
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
    }

    public function getComs()
    {
        session_start();
        if (isset($_SESSION['user']) && !empty($_SESSION['user']))
        {
            session_start();
            $res = [];
            if ($_SESSION['user'])
            {
                $idUsr = $_SESSION['user']->getIdUsr();
                $req = $this->getBdd()->prepare("SELECT image.img, user.login, user.pp, commentaire.commentaire
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
        }
    }

    public function getPicUsr($idUsr)
    {
        if (isset($idUsr) && !empty($idUsr))
        {
            $this->getBdd();
            $res = [];
            $req = $this->getBdd()->prepare("SELECT *
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
    }

    public function getSave()
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user']))
        {
            $this->getBdd();
            $res = [];
            session_start();
            if (isset($_SESSION['user']) && !empty($_SESSION))
            {
                $idUsr = $_SESSION['user']->getIdUsr();
    
                $req = $this->getBdd()->prepare("SELECT *
                                                    FROM ImgSaver as s, Image
                                                    WHERE s.idUsr = '$idUsr'
                                                    AND s.idImg = Image.idImg");
                $req->execute();
                while ($data = $req->fetch(PDO::FETCH_ASSOC))
                {
                    $nbLike = $this->getNbLike($data['idImg']);
                    $res[] = new Image($data, $nbLike);
                }
                return $res;
                $req->closeCursor();
            }
        }
    }

    public function verifUsr()
    {
        if (isset($_GET) && !empty($_GET)
            && isset($_GET['email']) && !empty($_GET['email'])
            && isset($_GET['hash']) && !empty($_GET['hash']))
        {
            $this->getBdd();
            $email = $this->filterString($_GET['email']);
            $hash = $this->filterString($_GET['hash']);
            $req = $this->getBdd()->prepare("SELECT *
                                                FROM user 
                                                WHERE email = '$email'
                                                AND hash = '$hash'");
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            if ($data == NULL)
                return "ERR";
            else if ($data['isVerif'] == false)
            {
                $req = $this->getBdd()->prepare("UPDATE user
                                                    SET isVerif = true
                                                    WHERE email = :email");
                $req->execute([':email' => $email]);
                return "OK";
            }
            else if ($data['isVerif'] == true)
                return "VERIFIED";
        }       
    }

    public function modifUserInfo()
    {
        session_start();
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])
            && isset($_POST) && !empty($_POST)
            && isset($_POST['login']) && !empty($_POST['login'])
            && isset($_POST['email']) && !empty($_POST['email']))
        {
            $err = [];
            $i = 0;
            $this->getBdd();
            $idUsr = $_SESSION['user']->getIdUsr();
            $login = $this->filterString($_POST['login']);
            $email = $this->filterString($_POST['email']);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            $bio = htmlentities($_POST['bio']);
            $bio = mb_convert_encoding($bio, 'HTML-ENTITIES', 'UTF-8');
            if ($email == FALSE || strlen($email) >= 90)
                $err[$i++] = "L'adresse mail entré n'est pas au bon format";
            if (strlen($bio) > 516)
                $err[$i++] = "Votre bio est trop longue";
            $verifEmail = $this->emailIsExist($email);
            $verifLogin = $this->loginIsExist($login);
            if ($verifLogin['idUsr'] != $idUsr && $verifLogin != NULL)
                $err[$i++] =  "Ce login existe deja";
            if ($verifEmail['idUsr'] != $idUsr && $verifEmail != NULL)
                $err[$i++] = "Cette adresse mail existe dejà";
            if (isset($err) && !empty($err))
                return $err;
            $newEmail = ($verifEmail['email'] != $_SESSION['user']->getEmail()
                                    || $verifEmail['isVerif'] == 0) ? 0 : 1;  
            $hash = ($verifEmail['email'] != $_SESSION['user']->getEmail()) ? md5(rand(0,10000)) : $verifEmail['hash'];
            $req = $this->getBdd()->prepare("UPDATE user
                                            SET login = :login,
                                                email = :email,
                                                bio = :bio,
                                                isVerif = :isVerif,
                                                hash = :hash
                                            WHERE idUsr = :idUsr");
            $req->execute([':login' => $login, ':email' => $email,
                            ':bio' => $bio, ':idUsr' => $idUsr,
                            ':isVerif' => $newEmail, ':hash' => $hash]);        
            $user = $this->getUsr($idUsr);
            $_SESSION['user'] = $user;
            if ($newEmail == 0 && $hash != $verifEmail['hash'])
            {
                $this->sendMailVerif($user->getEmail(), $user->getLogin(), $hash);
                return ("OK");
            }
            return NULL;
            $req->closeCursor();
        }
    }
    
    public function modifUserPasswd()
    {
        session_start();
        if (isset($_POST) && !empty($_POST)
            && isset($_SESSION['user']) && !empty($_SESSION)
            && isset($_POST['new1']) && !empty($_POST['new1'])
            && isset($_POST['new2']) && !empty($_POST['new2'])
            && isset($_POST['old']) && !empty($_POST['old']))
        {
            $this->getBdd();
            if (strcmp($_POST['new1'], $_POST['new2']) != 0)
                return ("Les mots de passe ne correspondent pas");
            if (strlen($_POST['new1']) <= 8)
                return ("Le nouveau mot de passe est trop court");
            $old = hash("SHA512", $this->filterString($_POST['old']));
            $new1 = hash("SHA512", $this->filterString($_POST['new1']));
            $new2 = hash("SHA512", $this->filterString($_POST['new2']));
            $idUsr = $_SESSION['user']->getIdUsr();
            $req = $this->getBdd()->prepare("SELECT *
                                                FROM user
                                                WHERE passwd = '$old'
                                                AND idUsr = '$idUsr'");
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            if (empty($data))
                return ("Mot de passe incorrect");
            else
            {
                $req = $this->getBdd()->prepare("UPDATE user
                                                    SET passwd = :passwd
                                                    WHERE idUsr = :idUsr");
                $req->execute([':passwd' => $new, ':idUsr' => $idUsr]);
            }
            $req->closeCursor();
        }
    }

    public function modifUserNotif()
    {
        session_start();
        if (isset($_POST) && !empty($_POST)
            && isset($_SESSION['user']) && !empty($_SESSION)
            && isset($_POST['com']) && !empty($_POST['com'])
            && isset($_POST['like']) && !empty($_POST['like']))
        {
            $this->getBdd();
            $usrNotifCom = (bool)$_SESSION['user']->getNotifCom();
            $usrNotifLike = (bool)$_SESSION['user']->getNotifLike();
            (int)$com = (!empty($_POST['com'])) ? (int)$usrNotifCom : (int)!$usrNotifCom;
            (int)$like = (!empty($_POST['like'])) ? (int)$usrNotifLike : (int)!$usrNotifLike;
            $idUsr = $_SESSION['user']->getIdUsr();
            $req = $this->getBdd()->prepare("UPDATE user
                                                SET notifCom = :notifCom,
                                                    notifLike = :notifLike
                                                WHERE idUsr = '$idUsr'");
            $req->execute([':notifCom' => $com, ':notifLike' => $like]);
            $req->closeCursor();
        }
    }

    public function forgotReqPasswd()
    {
        if (isset($_POST) && !empty($_POST)
            && isset($_POST['email']) && !empty($_POST['email']))
        {
            $this->getBdd();
            $email = $this->filterString($_POST['email']);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if ($email == FALSE)
                return ("L'adresse email n'est pas au bon format");
            $hash = md5(rand(0,10000));
            $req = $this->getBdd()->prepare("SELECT *
                                            FROM user 
                                            WHERE email = '$email'");
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            if ($data == NULL)
                return "Cet email est rataché a aucun utilisateur";
            else if ($data['isVerif'] == '0')
                return "Vous devez d'abord verifié votre adresse email";
            else
            {
                $req = $this->getBdd()->prepare("UPDATE user 
                                                    SET hash = :hash
                                                    WHERE email = :email");
                $req->execute([':hash' => $hash, ':email' => $email]);
                if (!($this->sendMailReset($email, $hash)))
                    return ("Une erreur est survenue lors de l'envois du mail");
            }
        }
    }

    public function resetReqPasswd()
    {
        if (isset($_POST) && !empty($_POST)
            && isset($_POST['passwd1']) && !empty($_POST['passwd1'])
            && isset($_POST['passwd2']) && !empty($_POST['passwd2']))
        {
            $this->getBdd();
            if (strcmp($_POST['passwd1'], $_POST['passwd2']) != 0)
                return "Les mots de passes de correspondent pas";
            $passwd1 =  hash("SHA512", $this->filterString($_POST['passwd1']));
            $passwd2 =  hash("SHA512", $this->filterString($_POST['passwd2']));
            $email = $this->filterString($_POST['email']);
            $hash = $this->filterString($_POST['hash']);
            $req = $this->getBdd()->prepare("SELECT *
                                                FROM user 
                                                WHERE email = '$email'
                                                AND hash = '$hash'");
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            if ($data == NULL)
                return "ERR";
            else
            {
                $req = $this->getBdd()->prepare("UPDATE user
                                                    SET passwd = :passwd,
                                                        hash = ''
                                                    WHERE email = :email");
                $req->execute([':passwd' => $passwd1, ':email' => $email]);
                return "OK";
            }
        }
    }
}