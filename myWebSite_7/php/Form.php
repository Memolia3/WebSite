<?php

if(!empty($_POST["form"])) {
    $check = true;
    $form = $_POST["form"];
    $formDb = new Form($form[0], $form[1], $form[2]);
    if($formDb->getEmail() == null || $formDb->getName() == null || $formDb->getMessage() == null) {
        $check = false;
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
        <title>お問い合わせ</title>
    </head>
    <body id="form">
        <div class="title_container">
            <h2>お問い合わせ</h2>
        </div>
        <div class="container">
            <p>※このページは３秒後に切り替わります。</p>
<?php
    if(!$check) {
        echo "<p>", "お問い合わせ内容の送信に失敗しました。", "<br>";
        echo "すべて入力してから再度、送信してください。", "<br>";
        echo "お問い合わせ画面に戻ります。", "</p>";
        header("refresh:3;url=../html/form.html");
        exit;
    } else {
        echo "<p>", "お問い合わせ内容を送信しました！", "<br>";
        echo "返信には１週間ほどかかる場合がございます、恐れ入りますがご了承ください。", "<br>";
        echo "ログイン画面に戻ります。", "</p>";
        header("refresh:3;url=../html/login.html");
        exit;
    }
?>
        </div>
    </body>
</html>
<?php
}

class Form {
    
    private String $email;
    private String $name;
    private String $message;
    
    public function __construct(String $email, String $name, String $message) {
        $this->email = $email;
        $this->name = $name;
        $this->message = $message;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getMessage() {
        return $this->message;
    }
}

