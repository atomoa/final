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

        $connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
    ?>
    <?php
        $id = $_POST['id'];
        $name = $_POST['name'];
        $teamcode = $_POST['team'];
        $positioncode = $_POST['position'];

        $teamCodes = array(
            'tigers' => '阪神タイガース',
            'baystars' => '横浜DeNAベイスターズ',
            'carp' => '広島東洋カープ',
            'gians' => '読売ジャイアンツ',
            'swallows' => '東京ヤクルトスワローズ',
            'dragons' => '中日ドラゴンズ',
            'buffaloes' => 'オリックス・バファローズ',
            'marines' => '千葉ロッテマリーンズ',
            'hawks' => '福岡ソフトバンクホークス',
            'eagles' => '東北楽天ゴールデンイーグルス',
            'lions' => '埼玉西武ライオンズ',
            'fighters' => '北海道日本ハムファイターズ',
        );

        $positionCodes = array(
            'catcher' => '捕手',
            'infielder' => '内野手',
            'outfielder' => '外野手',
            'pitcher' => '投手',
        );

        $pdo = new PDO($connect, USER, PASS);

        // プリペアドステートメントの設定
        $stmt = $pdo->prepare("UPDATE baseball SET name=:name, team=:team, teamcode=:teamcode, position=:position, positioncode=:positioncode WHERE id=:id");

        // チームとポジションに関連するコードを取得
        $team = getTeamCode($teamcode);
        $position = getPositionCode($positioncode);

        // パラメータのバインド
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':team', $team);
        $stmt->bindParam(':teamcode', $teamcode);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':positioncode', $positioncode);

        // クエリの実行
        $stmt->execute();

        echo 'データが更新されました</br>';
        echo '<a href="admin.php">管理者画面TOPに戻る</a>';
        echo '　｜　';
        echo '<a href="admin-insert.php">選手一覧画面に戻る</a>';

        $pdo = null;

        // チーム名からチームコードを取得する関数
        function getTeamCode($teamName) {
            global $teamCodes;
        
            // チームコードが存在する場合は返す。存在しない場合は空文字を返す。
            return isset($teamCodes[$teamName]) ? $teamCodes[$teamName] : '';
        }

        // ポジションからポジションコードを取得する関数
        function getPositionCode($positionName) {
            global $positionCodes;
    
            return isset($positionCodes[$positionName]) ? $positionCodes[$positionName] : '';
        }
    ?>
</body>
</html>
