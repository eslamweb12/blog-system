<?php

class User
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo=$pdo;
    }

    public function register($username,$email,$password)
    {
        $erorrs=array();

        if(empty($username))
        {
            $erorrs[]="plese enter a username";
        }
        if(empty($email))
        {
            $erorrs[]="plese enter a email address.";
        }
        if(empty($password))
        {
            $erorrs[]="plese enter a password.";
        }                
        //validate if variable $email are email
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $erorrs[]="plese enter a valid email.";
        }


        //check if email or username are use or no

        $stmt=$this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username=:username or email=:email");

        $stmt->execute(array(':username' => $username, ':email' => $email));
        
        $count=$stmt->fetchColumn();

        if($count>0)
        {
            $erorrs[]="email or username alrady used.";
        }

        if(empty($erorrs))
        {
            $hash=password_hash($password,PASSWORD_DEFAULT);    
            $stmt=$this->pdo->prepare("INSERT INTO users (username,email,password) VALUES (:username,:email,:password)");

            $stmt->execute(array(':username' => $username, ':email' => $email, ':password' => $hash));

                return true; }
        else
        {
            return $erorrs;
        }
    }

    public function login($email,$password)
    {
        //check if email or username are use or no

        $stmt=$this->pdo->prepare("SELECT * FROM users WHERE  email=:email");

        $stmt->execute(array(':email' => $email));
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']))
        {
            $_SESSION['user_id']=$user['id'];
            $_SESSION['username']=$user['username'];
            $_SESSION['email']=$user['email'];
            // header('Location: home1.php');
            // return true;
            // exit;
        }
        else
        {
            return "the email or passwoer is incorect";
        }
    }

}








?>