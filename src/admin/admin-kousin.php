<!DOCTYPE html>
<html lang="ja">
    <head>
	<meta charset="UTF-8">
	<title>管理者画面</title>
    <link rel="stylesheet" href="css/style-kousin.css">
    </head>
    <body>
    <?php
        const SERVER = 'mysql220.phy.lolipop.lan';
        const DBNAME = 'LAA1517455-final';
        const USER = 'LAA1517455';
        const PASS = 'Pass0925';

        $connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
    ?>
    <h1>選手情報変更</h1>
    <p><a href="admin.php">戻る</a></p><hr>
    <?php
        $pdo = new PDO($connect, USER, PASS);
    
        $sql = $pdo->prepare('select * from baseball where id = ?');
        $sql->execute([$_GET['id']]);

        $row = $sql->fetch(PDO::FETCH_ASSOC);

        echo '<form action="admin-kousin-output.php" method="post">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '　選手名：';
        echo '<input type="text" name="name" value="', $row['name'] , '">';
        echo '　チーム名：';
        echo '<select name="team">
                <option value="tigers">阪神タイガース</option>
                <option value="baystars">横浜DeNAベイスターズ</option>
                <option value="carp">広島東洋カープ</option>
                <option value="gians">読売ジャイアンツ</option>
                <option value="swallows">東京ヤクルトスワローズ</option>
                <option value="dragons">中日ドラゴンズ</option>
                <option value="buffaloes">オリックス・バファローズ</option>
                <option value="marines">千葉ロッテマリーンズ</option>
                <option value="hawks">福岡ソフトバンクホークス</option>
                <option value="eagles">東北楽天ゴールデンイーグルス</option>
                <option value="lions">埼玉西武ライオンズ</option>
                <option value="fighters">北海道日本ハムファイターズ</option>
            </select>';
        echo '　ポジション名：';
        echo '<select name="position">
                <option value="catcher">捕手</option>
                <option value="infielder">内野手</option>
                <option value="outfielder">外野手</option>
                <option value="pitcher">投手</option>
            </select>';
        echo '</br>';
        echo '<input type="submit" value="確定">';
        echo '</form>';
    ?>
    </body>
</html>