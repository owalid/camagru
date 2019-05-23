<?php

Class CommentaireManager extends Model
{
    public function getCommentaire($id_img)
    {
        $this->getBdd();
        return $this->getAllCommentaire($id_img);
    }

    public function sendCommentaire($idImg)
    {
       
        $this->getBdd();
        return $this->postCommentaire($idImg);
    }
}