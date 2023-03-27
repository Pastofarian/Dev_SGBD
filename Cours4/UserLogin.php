<?php 

class UserLogin {
    public static function verify ($user) {
        $db_con = new PDO('mysql:host=localhost;dbname=phpHashExo', 'root', 'toto');
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $db_con->prepare("SELECT * FROM users WHERE email = ?");
        
        try {
            $statement->execute([$user->email]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                if (password_verify($user->password, $result["password"])) {
                    return true;
                } 
                return false;
            }
            return false;
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }
}






