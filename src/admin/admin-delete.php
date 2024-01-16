<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>管理者画面</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    const SERVER = 'mysql220.phy.lolipop.lan';
    const DBNAME = 'LAA1517455-final';
    const USER = 'LAA1517455';
    const PASS = 'Pass0925';

    $connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';

    $id = $_GET['id']; // URLからIDを取得

    if (!empty($id)) {
        try {
            $pdo = new PDO($connect, USER, PASS);

            // 削除クエリを準備して実行
            $stmt = $pdo->prepare("DELETE FROM baseball WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            echo '<div class="rink">データが削除されました。</br>';
            echo '<a href="admin.php">管理者画面TOPに戻る</a>';
            echo '　｜　';
            echo '<a href="admin-update.php">選手一覧画面に戻る</a></div>';
        } catch (PDOException $e) {
            echo 'エラー: ' . $e->getMessage();
        } finally {
            $pdo = null;
        }
    } else {
        echo '削除するデータのIDが指定されていません。';
    }
    ?>
</body>
</html>
