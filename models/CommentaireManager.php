<?php

Class CommentaireManager extends Model
{
    public function getCommentaire($id_img)
    {
        if (isset($id_img) && !empty($id_img))
        {
            $this->getBdd();
            $var = [];
            $req = $this->getBdd()->prepare("SELECT *
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
    }

    public function sendCommentaire($idImg)
    {
        if (isset($_POST) && !empty($_POST) && isset($idImg) && !empty($idImg))
        {
            $this->getBdd();
            $commentaire = htmlentities($_POST['commentaire']);
            session_start();
            if ($_SESSION['user'] == NULL)
                return ("LOGIN");
            else
            {
                $usr = intval($_SESSION['user']->getIdUsr());
                $req = $this->getBdd()->prepare("INSERT INTO commentaire (commentaire, idImg, idUsr)
                                            VALUES (:commentaire, :idImg, :idUsr)");
                $req->execute([':commentaire' => $commentaire,
                ':idImg' => $idImg,
                ':idUsr' => $usr]);
                $userCommented = $this->getUsrPhoto($idImg);
                if ((bool)$userCommented['notifCom'])
                {
                    $this->sendMailLikeCom($userCommented['email'], $userCommented['login'],
                                    $_SESSION['user']->getLogin(), "commenté");
                }
                $req->closeCursor();
            } 
        }
    }
}