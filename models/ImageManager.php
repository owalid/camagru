<?php

class ImageManager extends Model
{
    public function getImages()
    {
        $this->getBdd();
        return $this->getAllPicture('Image', 'Image');
    }

    public function sendImage()
    {
        $this->getBdd();
        $this->sendPicture();
    }

    public function getUsrPostedImg($idUsr)
    {
        $this->getBdd();
        // $req = self::$_bdd->prepare("SELECT *
        // FROM user
        // WHERE idUsr = $idUsr");
        // var_dump("ici");
        // die();
        // $req->execute();
        // $res = $req->fetch(PDO::FETCH_ASSOC);
        // return ($res);
        // $req->closeCursor();
        return ($this->getUsr($idUsr));
    }

    public function getImgComment($idImg)
    {
        $this->getBdd();

        return ($this->getComments($idImg));
    }
}