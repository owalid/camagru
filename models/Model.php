<?php

abstract class Model 
{
    private static $_bdd;

    private static function setBdd()
    {
        require('config/database.php');
        self::$_bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        // self::$_bdd = new PDO('mysql:host=localhost;dbname=camagru;charset:utf8mb4_unicode_ci', 'root', 'root');
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
        $subject = 'Inscription | Verification'; // Give the email a subject 
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

        Merci ' . $login . ' pour votre inscription
        
        ------------------------
        
        Vous devez verifié votre adresse mail pour pouvoir vous connectez:
        '. URL .'?url=verifemail&email='. $email . '&hash=' . $hash . '
        
        '; // Our message above including the link
                            
        $headers = 'From:noreply@camagru.com' . "\r\n"; // Set from headers
        return (mail($to, $subject, $message, $headers));
    }

    protected function sendMailReset($email, $hash)
    {
        $to      = $email; // Send email to our user
        $subject = 'Reenitialisatiion | mot de passe'; // Give the email a subject 
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

        Voici le lien pour reenitialisé votre mot de passe:
        '. URL .'?url=forgotPasswdForm&email='. $email . '&hash=' . $hash . '
        
        ------------------------
        
        
        '; 
                            
        $headers = 'From:noreply@camagru.com' . "\r\n";
        return (mail($to, $subject, $message, $headers));
    }

    protected function sendMailLikeCom($email, $loginUsrLiked, $loginUsrLike, $likeCom)
    {
        $to      = $email; // Send email to our user
        $subject =  $likecom . ' | Camagru'; // Give the email a subject 
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
        return (mail($to, $subject, $message, $headers));
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

    public function getUsr($idUsr)
    {
        $req = self::$_bdd->prepare("SELECT *
                    FROM user
                    WHERE idUsr = $idUsr");
        $req->execute();
        $res = $req->fetch(PDO::FETCH_ASSOC);
       
        $user = new User($res);
        return ($user);
        $req->closeCursor();
    }

    protected function filterString($string)
    {
        // Match Emoticons
        $regex_emoticons = '/[\x{1F600}-\x{1F64F}]/u';
        $clear_string = preg_replace($regex_emoticons, '', $string);
    
        // Match Miscellaneous Symbols and Pictographs
        $regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
        $clear_string = preg_replace($regex_symbols, '', $clear_string);
    
        // Match Transport And Map Symbols
        $regex_transport = '/[\x{1F680}-\x{1F6FF}]/u';
        $clear_string = preg_replace($regex_transport, '', $clear_string);
    
        // Match Miscellaneous Symbols
        $regex_misc = '/[\x{2600}-\x{26FF}]/u';
        $clear_string = preg_replace($regex_misc, '', $clear_string);
    
        // Match Dingbats
        $regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
        $clear_string = preg_replace($regex_dingbats, '', $clear_string);
        
        $clear_string = htmlentities($clear_string);
        return $clear_string;
    }
}