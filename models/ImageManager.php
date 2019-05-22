<?php

class ImageManager extends Model
{
    public function getImages()
    {
        $this->getBdd();
        return $this->getAllPicture('Image', 'Images');
    }
}