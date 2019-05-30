<?php

class ImageManager extends Model
{
    public function getImages($offset, $limit)
    {

        $this->getBdd();
        return $this->getAllPicture($offset, $limit);
    }

    public function sendImage()
    {
        if (isset($_POST))
        {
            $this->getBdd();
            $img = $_POST['image'];
            session_start();
            $usr = intval($_SESSION['user']->getIdUsr());
            $description = $_POST['description'];
            $req = $this->getBdd()->prepare("INSERT INTO image (img, nbLike, idUsr, description)
            VALUES (:img, :nbLike, :usr, :description)");
            $req->execute([':img' => $img, ':nbLike' => 0, ':usr' => $usr, ':description' => $description]);
            $req->closeCursor();
        }
    }

    public function getUsrPostedImg($idUsr)
    {
        if (isset($idUsr) && !empty($idUsr))
        {
            $this->getBdd();
            $req = $this->getBdd()->prepare("SELECT *
                    FROM user
                    WHERE idUsr = $idUsr");
            $req->execute();
            $res = $req->fetch(PDO::FETCH_ASSOC);
            $user = new User($res);
            return ($user);
            $req->closeCursor();
        }
    }

    public function getImgComment($idImg)
    {
        if (isset($idImg) && !empty($idImg))
        {
            $this->getBdd();
            $var = [];
            $req = $this->getBdd()->prepare("SELECT user.pp, user.login, commentaire.commentaire
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
    }

    public function like($idImg)
    {
        session_start();
        if ($_SESSION['user'] == NULL)
        return ("LOGIN");
        else
        {
            $this->getBdd();
            $idUsr = $_SESSION['user']->getIdUsr();
            $verif = $this->getBdd()->prepare("SELECT *
                                    FROM `like`
                                    WHERE idUsr = '$idUsr'
                                    AND idImg = '$idImg'");
            $verif->execute();
            $ret = $verif->fetch(PDO::FETCH_ASSOC);
            if ($ret == FALSE)
            {
                $req = $this->getBdd()->prepare("INSERT INTO `Like` (idUsr, idImg, isLiked)
                                        VALUES (:idUsr, ;idImg, :isLiked)");
                $req->execute([':idUsr' => $idUsr, ':iidImg' => $idImg, ':isLiked' => true]);
                $userLiked = $this->getUsrPhoto($idImg);
                if ((bool)$userLiked['notifLike'])
                {
                    $this->sendMailLikeCom($userLiked['email'], $userLiked['login'], $_SESSION['user']->getLogin(), "liké");
                    $req->closeCursor();
                }
            }
            else
                return ("vous avez déjà aimé cette photo");
        }
    }

    public function saveImg()
    {
        session_start();
        if (isset($_GET) && !empty($_GET) && isset($_SESSION['user']) && !empty($_SESSION))
        {
            $this->getBdd();
            $idUsr = $_SESSION['user']->getIdUsr();
            $idImg = $_GET['idImg'];
            $verif = $this->getBdd()->prepare("SELECT *
                                        FROM ImgSaver as s
                                        WHERE s.idUsr = '$idUsr'
                                        AND s.idImg = '$idImg'");
            $verif->execute();
            $ret = $verif->fetch(PDO::FETCH_ASSOC);
            if (empty($ret))
            {
                $req = $this->getBdd()->prepare("INSERT INTO ImgSaver (idUsr, idImg)
                                        VALUES (:idUsr, :idImg)");
                $req->execute([':idUsr' => $idUsr, ':idImg' => $idImg]);
                $req->closeCursor();
            }
            else
                return ("ERR");
            $verif->closeCursor();
        }
    }
}