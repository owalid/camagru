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
        return ($this->getUsr($idUsr));
    }

    public function getImgComment($idImg)
    {
        $this->getBdd();

        return ($this->getComments($idImg));
    }

    public function like($idImg)
    {
        $this->getBdd();
        return ($this->sendLike($idImg));
    }

    public function saveImg()
    {
        $this->getBdd();
        return ($this->saveImage());
    }
}