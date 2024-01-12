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
            <div class="insert"><a href="admin-insert.php"><button>選手情報追加<button></a><div>
            <div class="update"><a href="admin-update.php"><button>選手情報更新<button></a><div>
            <div class="delete"><a href="admin-delete.php"><button>選手情報削除<button></a><div>
            

    </body>
</html>
