<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>管理者画面</title>
    </head>
    <body>
        <?php
            const SERVER = 'mysql220.phy.lolipop.lan';
            const DBNAME = 'LAA1517455-final';
            const USER = 'LAA1517455';
            const PASS = 'Pass0925';

            $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
        ?>

        <h1>管理者画面</h1>
        <hr>
            <div class="tuika"><a href="admin-insert.php">選手情報追加</a><div>
            <div class="henkou"><a href="admin-update.php">選手情報変更</a><div>            
            <div class="top"><a href="../index.php">ユーザー画面に戻る</a><div>            

    </body>
</html>
