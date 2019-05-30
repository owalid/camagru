<?php

class UserManager extends Model
{
    public function register()
    {
        if (isset($_POST) && !empty($_POST))
        {
            $this->getBdd();
            $passwd1 = hash("SHA512", $_POST['passwd1']);
            $passwd2 = hash("SHA512", $_POST['passwd2']);
            if ($passwd1 != $passwd2)
            return ("PASS");
            $login =  htmlentities($_POST['login']);
            $email = htmlentities($_POST['email']);
            if ($this->loginIsExist($login) != NULL)
                return ("LOGIN");
            if ($this->emailIsExist($email) != NULL)
                return ("EMAIL");
            $hash = md5(rand(0,10000));
            $pp = $_POST['pp'];
            $bio = htmlentities($_POST['bio']);
            $req = $this->getBdd()->prepare("INSERT INTO user (login, passwd, email, pp, bio, hash)
                                        VALUES (:login, :passwd, :email, :pp, :bio, :hash)");
            $this->sendMailVerif($email, $login, $hash);
            $req->execute([':login' => $login, ':passwd' => $passwd1, ':email' => $email,
            ':pp' => $pp, ':bio' => $bio, ':hash' => $hash]);
            $req->closeCursor();
        }
    }

    public function log()
    {
        if (isset($_POST) && !empty($_POST))
        {
            $this->getBdd();
            $login = htmlentities($_POST['login']);
            $passwd =  htmlentities($_POST['passwd']);
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
            $req = $this->getBdd()->prepare("SELECT  image.img, user.login, user.pp
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
        if (isset($_GET) && !empty($_GET))
        {
            $this->getBdd();
            $email = htmlentities($_GET['email']);
            $hash = htmlentities($_GET['hash']);
            $req = $this->getBdd()->prepare("SELECT *
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
        if (isset($_SESSION['user']) && !empty($_SESSION) && isset($_POST) && !empty($_POST))
        {
            $this->getBdd();
            $idUsr = $_SESSION['user']->getIdUsr();
            $login = htmlentities($_POST['login']);
            $email = htmlentities($_POST['email']);
            $bio = htmlentities($_POST['bio']);
            $verifEmail = $this->emailIsExist($email);
            $verifLogin = $this->loginIsExist($login);
            if ($verifLogin['idUsr'] != $idUsr && $verifLogin != NULL)
                return ("LOGIN");
            if ($verifEmail['idUsr'] != $idUsr && $verifEmail != NULL)
                return ("EMAIL");
            $newEmail = ($verifEmail['email'] != $_SESSION['user']->getEmail()
                                    || $verifEmail['isVerif'] == 0) ? 0 : 1;
            $hash = ($verifEmail['email'] != $_SESSION['user']->getEmail()) ? md5(rand(0,10000)) : $verifEmail['hash'];
            $req = $this->getBdd()->prepare("UPDATE user
                                        SET     login = :login,
                                                email = :email,
                                                bio = :bio,
                                                isVerif = :isVerif,
                                                hash = :hash
                                        WHERE   idUsr = :idUsr");
            $req->execute([':login' => $login, ':email' => $email,
                            ':bio' => $bio, ':idUsr' => $idUsr,
                            ':isVerif' => $newEmail, ':hash' => $hash]);
            $user = $this->getUsr($idUsr);
            $_SESSION['user'] = $user;
            if ($newEmail == 0 && $hash != $verifEmail['hash'])
            {
                $this->sendMailVerif($user->getEmail(), $user->getLogin(), $hash);
                return ("NEW");
            }
            return NULL;
            $req->closeCursor();
        }
    }
    
    public function modifUserPasswd()
    {
        session_start();
        if (isset($_POST) && !empty($_POST) && isset($_SESSION['user']) && !empty($_SESSION))
        {
            $this->getBdd();
            $old = hash("SHA512", htmlentities($_POST['old']));
            $new = hash("SHA512", htmlentities($_POST['new']));
            $idUsr = $_SESSION['user']->getIdUsr();
            $req = $this->getBdd()->prepare("SELECT *
                                        FROM user
                                        WHERE passwd = '$old'
                                        AND idUsr = '$idUsr'");
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            if (empty($data))
                return ("ERR");
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
        if (isset($_POST) && !empty($_POST) && isset($_SESSION['user']) && !empty($_SESSION))
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
        if (isset($_POST) && !empty($_POST))
        {
            $this->getBdd();
            $email = htmlentities($_POST['email']);
            $hash = md5(rand(0,10000));
            $req = $this->getBdd()->prepare("SELECT *
            FROM user 
            WHERE email = '$email'");
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            if ($data == NULL)
                return "MAIL";
            else if ($data['isVerif'] == '0')
                return "VERIF";
            else
            {
                $req = $this->getBdd()->prepare("UPDATE user 
                                            SET hash = :hash
                                            WHERE email = :email");
                $req->execute([':hash' => $hash, ':email' => $email]);
            $this->sendMailReset($email, $hash);
            }
        }
    }

    public function resetReqPasswd()
    {
        if (isset($_POST) && !empty($_POST))
        {
            $this->getBdd();
            $passwd1 =  hash("SHA512", htmlentities($_POST['passwd1']));
            $passwd2 =  hash("SHA512", htmlentities($_POST['passwd2']));
            if ($passwd1 != $passwd2)
                return "Les mots de passes de correspondent pas";
            $email = htmlentities($_POST['email']);
            $hash = htmlentities($_POST['hash']);
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