<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>NPB TeamMade</title>
</head>
<body>
<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1517455-final';
const USER = 'LAA1517455';
const PASS = 'Pass0925';

$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
?>

<h1>自分好みのオーダーを組もう！</h1>
<p>使い方は簡単！選手一覧から選手を追加するだけ！</p>
<p>・選手情報は2023シーズン終了時のものになります</p>
<p>・選手は各チームの支配下選手のみとなります</p>
<p>・すでに同選手が追加されているか9人を超えている場合は追加されません</p>
<p><a href="admin/admin.php">・選手管理ページ</a></p>
<?php
if (isset($_SESSION['player'])) {
    echo '<table id="table-select" class="select">';
    echo '<thead><tr><th>選手名</th><th>ポジション</th><th>打順</th><th>削除</th></tr></thead>';
    echo '<tbody id="select-tbody">';
    foreach ($_SESSION['player'] as $id => $player) {
        echo '<tr><td>', $player['name'], '</td>';
        echo '<td><select onchange="changeList(this);">';
        echo '<option>選択してください</option><option>投手</option><option>捕手</option><option>一塁手</option><option>二塁手</option>';
        echo '<option>三塁手</option><option>遊撃手</option><option>左翼手</option><option>中堅手</option><option>右翼手</option><option>指名打者</option></select>';
        echo '</td><td><button onclick="upList(this)">↑</button><button onclick="downList(this)">↓</button></td>';
        echo '<td><a href="player-delete.php?id=', $id, '">削除</a></td></tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<h2>選手を追加してください</h2>';
}
?>
<form method="post" action="index.php">
    <input type="text" name="keyword" placeholder="選手名を入力">
    <button type="submit">検索</button>
</form>
<form action="index.php" method="post">
    <select name="team">
    <option value="">すべてのチーム</option>
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
    <select name="position">
        <option value="">すべてのポジション</option>
        <option value="catcher">捕手</option>
        <option value="infielder">内野手</option>
        <option value="outfielder">外野手</option>
        <option value="pitcher">投手</option>
    </select>
    <input type="submit" value="検索">
</form>
<hr>
<?php
echo '<table>';
echo '<tr><th>選手名</th><th>チーム</th><th>ポジション</th></tr>';
$pdo = new PDO($connect, USER, PASS);

if (isset($_POST['keyword'])) {
    $sql = $pdo->prepare('select * from baseball where name like ?');
    $sql->execute(['%' . $_POST['keyword'] . '%']);
} else if (isset($_POST['team']) || isset($_POST['position'])) {
    $sql = $pdo->prepare('select * from baseball where teamcode = ? and positioncode = ?');
    $sql->execute([$_POST['team'], $_POST['position']]);
} else {
    $sql = $pdo->query('select * from baseball');
}
foreach ($sql as $row) {
    $id = $row['id'];
    echo '<tr>';
    echo '<td>', $row['name'], '</td>';
    echo '<td>', $row['team'], '</td>';
    echo '<td>', $row['position'], '</td>';
    echo '<td><a href="player-insert.php?id=', $id, '">追加</a></td></tr>';
    echo '</tr>';
}
echo '</table>';
?>
        <script>
            function upList(obj) {
                // tbody要素に指定したIDを取得し、変数「tbody」に代入
                var tbody = document.getElementById('select-tbody');
                // objの親の親のノードを取得し（つまりtr要素）、変数「tr」に代入
                var tr = obj.parentNode.parentNode;

                // もし「tr」の直前の兄弟ノード名が「TR」だった場合
                // （上に「行」が存在している場合）
                if(tr.previousSibling.nodeName === 'TR') {
                    // 「tr」を直前の兄弟ノードの上に挿入
                    tbody.insertBefore(tr, tr.previousSibling);
                }
            }
            function downList(obj) {
                // tbody要素に指定したIDを取得し、変数「tbody」に代入
                var tbody = document.getElementById('select-tbody');
                // objの親の親のノードを取得し（つまりtr要素）、変数「tr」に代入
                var tr = obj.parentNode.parentNode;

                // もし「tr」の直前の兄弟ノード名が「TR」だった場合
                // （上に「行」が存在している場合）
                if(tr.nextSibling.nodeName === 'TR'){
                    // 「tr」を直後の兄弟ノードの上に挿入
                    tbody.insertBefore(tr.nextSibling, tr);
                }
            }
            function changeList(obj) {
                // 選択したオプションの値を取得し、変数「type」に代入
                var type = obj.value;
                // objの親の親のノードを取得し（つまりtr要素）、変数「tr」に代入
                var tr = obj.parentNode.parentNode;
                // 「tr」の2番目のセルを指定し、変数「td」に代入
                var td = tr.childNodes[1];

                // 新たにtd要素を作成し、変数「cell」に代入
                var cell = document.createElement('td');
                // 「cell」内のHTMLを「type」に置き換え
                cell.innerHTML = type;
                // 「td」を「cell」に置き換え
                tr.replaceChild(cell, td);
            }
        </script>
    </body>
</html>    