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
            $req = $this->getBdd()->prepare("SELECT user.pp, user.login, commentaire.commentaire, commentaire.idCommentaire, commentaire.idUsr
                                                FROM commentaire, user
                                                WHERE idImg = $idImg
                                                AND user.idUsr = commentaire.idUsr");
            $req->execute();
            while ($data = $req->fetch(PDO::FETCH_ASSOC))
            {
                if (empty($data['pp']))
                {
                    $data['pp'] = IMG . "default.png";
                }
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
                                                    VALUES (:idUsr, :idImg, :isLiked)");
                $req->execute([':idUsr' => $idUsr, ':idImg' => $idImg, ':isLiked' => true]);
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

    public function deleteImg()
    {
        session_start();
        if (isset($_GET) && !empty($_GET)
        && isset($_SESSION['user']) && !empty($_SESSION)
        && isset($_GET['idImg']) && !empty($_GET['idImg']))
        {
            $this->getBdd();
            $idUsr = $_SESSION['user']->getIdUsr();
            $idImg = $_GET['idImg'];
            $verif = $this->getBdd()->prepare("SELECT *
                                                FROM Image as i
                                                WHERE i.idUsr = '$idUsr'
                                                AND i.idImg = '$idImg'");
            $verif->execute();
            $ret = $verif->fetch(PDO::FETCH_ASSOC);
            if (isset($ret))
            {
                $like = $this->getBdd()->prepare("DELETE
                                                FROM `Like`
                                                WHERE idImg = :idImg");
                $like->execute([':idImg' => $idImg]);
                $save = $this->getBdd()->prepare("DELETE
                                                FROM ImgSaver
                                                WHERE idImg = :idImg");
                $save->execute([':idImg' => $idImg]);
                $com = $this->getBdd()->prepare("DELETE
                                                FROM commentaire
                                                WHERE idImg = :idImg");
                $com->execute([':idImg' => $idImg]);
                $req = $this->getBdd()->prepare("DELETE
                                                FROM Image
                                                WHERE idImg = :idImg");
                $req->execute([':idImg' => $idImg]);
                $req->closeCursor();
                $com->closeCursor();
                return (NULL);
            }
            else
                return ("ERR");
            $verif->closeCursor();
        }
	}
	
	public function deleteCom()
	{
		session_start();
		if (isset($_SESSION['user']) && !empty($_SESSION['user'])
		&& isset($_GET['id_com']) && !empty($_GET['id_com']))
		{
			$idCom = $_GET['id_com'];
			$req = $this->getBdd()->prepare("DELETE 
												FROM commentaire
												WHERE idCommentaire = :idCommentaire");
			$req->execute([':idCommentaire' => $idCom]);
			return ($req->rowCount());
		}
	}
}