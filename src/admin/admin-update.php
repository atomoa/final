<!DOCTYPE html>
<html lang="ja">
    <head>
	<meta charset="UTF-8">
	<title>管理者画面</title>
    </head>
    <body>
    <?php
        const SERVER = 'mysql220.phy.lolipop.lan';
        const DBNAME = 'LAA1517455-final';
        const USER = 'LAA1517455';
        const PASS = 'Pass0925';

        $connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
    ?>
    <h1>選手一覧</h1>
    <p><a href="admin.php">戻る</a></p>
    <hr>
    <form method="post" action="">
        選手名で検索する：
        <input type="text" name="keyword" placeholder="選手名を入力">
        <button type="submit">検索</button>
    </form>
    <form action="index.php" method="post">
    チームで検索する：
    <select name="team">
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
    </select>
    <input type="submit" value="検索">
    </form>
    <form action="" method="post">
    ポジションで検索する：
    <select name="position">
        <option value="catcher">捕手</option>
        <option value="infielder">内野手</option>
        <option value="outfielder">外野手</option>
        <option value="pitcher">投手</option>
    </select>
    <input type="submit" value="検索">
    </form>
    <?php 
    echo '<table>';
    echo '<tr><th>選手名</th><th>チーム</th><th>ポジション</th><th>更新</th><th>削除</th></tr>';
    $pdo = new PDO($connect, USER, PASS);
    
    if (isset($_POST['keyword'])) {
        $sql = $pdo->prepare('select * from baseball where name like ?');
        $sql->execute(['%' . $_POST['keyword'] . '%']);
    } else if (isset($_POST['team'])) {
        $sql = $pdo->prepare('select * from baseball where teamcode = ?');
        $sql->execute([$_POST['team']]);
    } else if (isset($_POST['position'])) {
        $sql = $pdo->prepare('select * from baseball where positioncode = ?');
        $sql->execute([$_POST['position']]);
    } else {
        $sql = $pdo->query('select * from baseball');
    }
    foreach ($sql as $row) {
        $id = $row['id'];
        echo '<tr>';
        echo '<td>', $row['name'], '</td>';
        echo '<td>', $row['team'], '</td>';
        echo '<td>', $row['position'], '</td>';
        echo '<td><a href="admin-kousin.php?id=',$id,'">更新</a></td>';
        echo '<td><a href="admin-delete.php?id=', $id, '">削除</a></td>';

        echo '</tr>';
    }
    echo '</table>';
    
    ?>


    </body>
</html>