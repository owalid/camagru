<?php

class ImageManager extends Model
{
    public function getImages()
    {
        $this->getBdd();
        return $this->getAllPicture('Image', 'Images');
    }

    public function sendImage()
    {
        $this->getBdd();
        $this->sendPicture();
       
    }
}