<?php

abstract class Model 
{
    private static $_bdd;

    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=localhost;dbname=camagru;charset:utf8mb4_unicode_ci', 'root', 'root');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$_bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    protected function getBdd()
    {
        if (self::$_bdd == NULL)
            self::setBdd();
        return self::$_bdd;
    }

    protected function getUsrPhoto($idImg)
    {
        $req = self::$_bdd->prepare("SELECT user.email, user.login, user.notifCom, user.notifLike
                                    FROM user, image
                                    WHERE user.idUsr = image.idUsr
                                    AND image.idImg = '$idImg'");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data);
        $req->closeCursor();
    }

    protected function getAllPicture($offset, $limit)
    {
        $limit = (int)$limit;
        $offset = (int)$offset;
        $var = [];
        $req = self::$_bdd->prepare("SELECT * 
                                    FROM Image
                                    ORDER BY idImg DESC
                                    LIMIT $limit OFFSET $offset");
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $nbLike = $this->getNbLike($data['idImg']);
            $var[] = new Image($data, $nbLike);
        }
        return $var;
        $req->closeCursor();
    }
    
    protected function sendMailVerif($email, $login, $hash)
    {
        $to      = $email; // Send email to our user
        $subject = 'Signup | Verification'; // Give the email a subject 
        $message = '
        
         _____                                              
        /  __ \                                             
        | /  \/  __ _  _ __ ___    __ _   __ _  _ __  _   _ 
        | |     / _  ||  _   _ \  / _  | / _  | __ | | | |
        | \__/\| (_| || | | | | || (_| || (_| || |   | |_| |
         \____/ \__,_||_| |_| |_| \__,_| \__, ||_|    \__,_|
                                          __/ |             
                                         |___/              
        
        
        ------------------------

        Thanks you ' . $login . ' for signing up!
        
        ------------------------
        
        Please click this link to activate your account:
        '. URL .'?url=verifemail&email='. $email . '&hash=' . $hash . '
        
        '; // Our message above including the link
                            
        $headers = 'From:noreply@camagru.com' . "\r\n"; // Set from headers
        mail($to, $subject, $message, $headers);
    }

    protected function sendMailReset($email, $hash)
    {
        $to      = $email; // Send email to our user
        $subject = 'Reset | Passwd'; // Give the email a subject 
        $message = '
        
         _____                                              
        /  __ \                                             
        | /  \/  __ _  _ __ ___    __ _   __ _  _ __  _   _ 
        | |     / _  ||  _   _ \  / _  | / _  | __ | | | |
        | \__/\| (_| || | | | | || (_| || (_| || |   | |_| |
         \____/ \__,_||_| |_| |_| \__,_| \__, ||_|    \__,_|
                                          __/ |             
                                         |___/              
        
        
        ------------------------

        Please click this link to reset your password:
        '. URL .'?url=forgotPasswdForm&email='. $email . '&hash=' . $hash . '
        
        ------------------------
        
        
        '; 
                            
        $headers = 'From:noreply@camagru.com' . "\r\n";
        mail($to, $subject, $message, $headers);
    }

    protected function sendMailLikeCom($email, $loginUsrLiked, $loginUsrLike, $likeCom)
    {
        $to      = $email; // Send email to our user
        $subject = 'Signup | Verification'; // Give the email a subject 
        $message = '
        
         _____                                              
        /  __ \                                             
        | /  \/  __ _  _ __ ___    __ _   __ _  _ __  _   _ 
        | |     / _  ||  _   _ \  / _  | / _  | __ | | | |
        | \__/\| (_| || | | | | || (_| || (_| || |   | |_| |
         \____/ \__,_||_| |_| |_| \__,_| \__, ||_|    \__,_|
                                          __/ |             
                                         |___/              
        
        
        ------------------------

        Coucou ' . $loginUsrLiked . "\n" .
        
        $loginUsrLike . ' à ' . $likeCom . ' votre photo
        ------------------------';
                            
        $headers = 'From:noreply@camagru.com' . "\r\n";
        mail($to, $subject, $message, $headers);
    }

    protected function loginIsExist($login)
    {
        $req = self::$_bdd->prepare("SELECT *
        FROM user 
        WHERE login = '$login'");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data);
        if ($data == NULL)
            return FALSE;
        return TRUE;
        $req->closeCursor();
	}

    protected function emailIsExist($email)
    {
        $req = self::$_bdd->prepare("SELECT *
        FROM user 
        WHERE email = '$email'");
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return ($data);
        $req->closeCursor();
    }

    public function getNbLike($idImg)
    {
        $req = self::$_bdd->prepare("SELECT count(`like`.idLike) as nbLike
                                    FROM `like`
                                    WHERE idImg = '$idImg'");
        $req->execute();
        $var = $req->fetch(PDO::FETCH_ASSOC);
        return $var["nbLike"];
        $req->closeCursor();
    }
}