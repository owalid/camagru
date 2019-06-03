<?php

Class CommentaireManager extends Model
{
    public function sendCommentaire($idImg)
    {
        if (isset($_POST) && !empty($_POST) && isset($idImg) && !empty($idImg))
        {
            $this->getBdd();
            $commentaire = htmlentities($_POST['commentaire']);
            $commentaire = mb_convert_encoding($commentaire, 'HTML-ENTITIES', 'UTF-8');
            if (strlen($commentaire) >= 16777215)
                return ("COM");
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