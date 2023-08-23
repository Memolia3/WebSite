<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ</title>
    </head>
</html>
<?php

include "Login.php";

if (!empty($_POST["authcode"])) {
    
    include "Register.php";
    
    $sessionMode = $_SESSION['mode'];
    
    if($sessionMode == "register") {
        $authCode = $_SESSION['code'];
    
        $yourAuthCode = $_POST["authcode"];
    
        if(strcmp($authCode, $yourAuthCode) == 0) {
            $email = $_SESSION['email'];
            $name = $_SESSION['name'];
            $password = $_SESSION['password'];
            header("Location:Home.php");
        } else {
            $_SESSION = array();
            header("Location:../html/register.html");
            exit;
        }
    }
}

