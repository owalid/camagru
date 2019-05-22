<?php

Class CommentaireManager extends Model
{
    public function getCommentaire($id_img)
    {
        $this->getBdd();
        return $this->getAllCommentaire($id_img);
    }
}