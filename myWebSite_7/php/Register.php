<?php

session_start();

session_cache_expire();

if (!empty($_POST["register"])) {
    $data = $_POST["register"];
    $_SESSION['mode'] = "register";
    $code = 0;
    for($i = 0; $i < 6; $i++) {
        $code += mt_rand(0,1000);
    }
    $_SESSION['email'] = $data[0];
    $_SESSION['name'] = $data[1];
    $_SESSION['password'] = $data[2];
    $_SESSION['code'] = $code;
    $json_authCode = json_encode($code);
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body id="lr">
        <div class="title_container">
            <h2>アカウント作成</h2>
        </div>
        <div class="container">
<?php
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
    } catch (PDOException $ex) {
        die('errorNo1 : ' . $ex->getMessage());
    }

    try {
        $pdo->beginTransaction();
        $sql = "INSERT INTO user (name, password, email) VALUES (:name, :password, :email)";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':name', $data[1], PDO::PARAM_STR);
        $stmh->bindValue(':password', $data[2], PDO::PARAM_STR);
        $stmh->bindValue(':email', $data[0], PDO::PARAM_STR);
        $stmh->execute();
        $pdo->commit();
    } catch (PDOException $ex) {
        $pdo->rollBack();
?>
            <div>
                <p>※このページは３秒後に切り替わります。<p>
            </div>
<?php
        echo "<p>", "アカウントを作成できません。", "</p>";
        echo "<p>", "メールアドレスがすでに登録されています。</p>";
        echo "<p>", "ログイン画面に移動します。", "</p>";
        $_SESSION = array();
        header("refresh:3;url=../html/login.html");
        exit;
    }
    echo "<p>", $data[1], "さん！登録ありがとうございます！まだアカウント作成はできていません！", "</p>";
    echo "<p>", $data[0], "&nbsp;に認証コードをお送りしました！（※未実装のためアラートでお送りします）", "</p>";
?>
            <form action="../php/Branch.php" method="post">
                <p>こちらに入力してください&nbsp;:&nbsp;<br><input type="text" placeholder="123456" name="authcode"></p>
                <div class="button_container">
                    <input class="button" type="submit" value="送信">
                    <input class="button" type="reset" value="リセット">
            </form>
        </div>
        <script>           
            let authCode = JSON.parse('<?php echo $json_authCode ?>');
            setTimeout(()=>{
                alert(authCode);
                console.log('認証コードをアラートしました : ' + authCode);
            }, 1000);
        </script>
    </body>
</html>
<?php
}