<?php

include "Branch.php";
include "HomeInfo.php";

$info = new HomeInfo($_SESSION['email'], $_SESSION['name'], $_SESSION['password'], $_SESSION['mode']);

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
        <title>マイページ</title>
    </head>
    <body id="home">
        <header>
            <h1 class="title_container">マイページ</h1>
        </header>
<?php
if($info->getSessionMode() == "register") {
    $message = "アカウントを登録しました！はじめまして！" . $info->getName() . "さん！";
    $json_message = json_encode($message);
?>
        <script>
            let success = JSON.parse('<?php echo $json_message; ?>');
            setTimeout(() =>{
                alert(success);
                console.log("welcome!!!");
            }, 1000);
        </script>
<?php
} else {
    $message = "こんにちは！" . $info->getName() . "さん！";
    $json_message = json_encode($message);
?>
         <script>
             let success = JSON.parse('<?php echo $json_message; ?>');
             setTimeout(() =>{
                alert(success);
                console.log("welcome!!!");
            }, 1000);
         </script>
<?php
}
?>
    </body>
</html>
