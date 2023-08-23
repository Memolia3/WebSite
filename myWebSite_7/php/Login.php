<?php

session_start();

session_cache_expire();

if (!empty($_POST["login"])) {
    $data = $_POST["login"];
    
    $db_user = "root";
    $db_pass = "Memoli4z@3y3+";
    $db_host = "localhost";
    $db_name = "mywebsite_php";
    $db_type = "mysql";

    $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";
    
    try {
        $pdo = new PDO($dsn, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (Exception $ex) {
        die('errorNo1 : ' . $ex->getMessage());
    }
    
    $search_email = $data[0];
    $search_name = $data[1];
    $search_password = $data[2];
    
    try {
        $sql = "SELECT * FROM user WHERE email = :email AND name = :name AND password = :password";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(":email", $search_email, PDO::PARAM_STR);
        $stmh->bindValue(":name", $search_name, PDO::PARAM_STR);
        $stmh->bindValue(":password", $search_password, PDO::PARAM_STR);
        $stmh->execute();
        $count = $stmh->rowCount();
    } catch (Exception $ex) {
        die('errorNo2 : ' . $ex->getMessage());
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
        <title>ログイン</title>
    </head>
    <body id="lr">
        <div class="title_container">
            <h2>アカウントログイン</h2>
        </div>
        <div class="container">
            <p>※このページは３秒後に切り替わります。<p>
<?php
    if($count < 1) {
        echo "<p>", "ログインできませんでした。", "<br>";
        echo "メールアドレス、ユーザ名およびパスワードを間違えています。", "<br>";
        echo "ログイン画面に戻ります。" ,"</p>";
        $_SESSION = array();
        header("refresh:3;url=../html/login.html");
        exit;
    }else {
        $_SESSION = array();
        $_SESSION['mode'] = "login";
        $_SESSION['email'] = $search_email;
        $_SESSION['name'] = $search_name;
        $_SESSION['password'] = $search_password;
        echo "<p>", "ログインに成功しました。". "<p>";
        header("refresh:3;url=Home.php");
        exit;
    }
?>
        </div>
    </body>
<?php
}
?>
</html>


