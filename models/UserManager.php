<?php

class UserManager extends Model
{
    public function register(array $argv)
    {
        $this->getBdd();
        return $this->registerUser($argv);
    }

    public function log($login, $passwd)
    {
        $this->getBdd();
        return $this->logUser($login, $passwd);
    }
    
    // public function register(array $argv)
    // {
    //     $this->getBdd();
    //     return $this->registerUser($login, $passwd);
    // }
}