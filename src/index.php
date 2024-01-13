<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>NPB TeamMade</title>
    </head>
<?php
    const SERVER = 'mysql220.phy.lolipop.lan';
    const DBNAME = 'LAA1517455-final';
    const USER = 'LAA1517455';
    const PASS = 'Pass0925';

    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>

<h1>自分好みのオーダーを組もう！</h1>
<p>使い方は簡単！選手一覧から選手を追加するだけ！</p>
<p>・選手情報は2023シーズン終了時のものになります</p>
<p>・選手は各チームの支配下選手のみとなります</p>
<p>・すでに同選手が追加されているか9人を超えている場合は追加されません</p>
<?php
if(isset($_SESSION['player'])){
    echo '<table id="table-select" class="select">';
    echo '<thead><tr><th>選手名</th><th>ポジション</th><th>打順</th><th>削除</th></tr></thead>';
    foreach($_SESSION['player'] as $id => $player){
        echo '<tbody id="select-tbody"><tr><td>',$player['name'],'</td>';
        echo '<td><select onchange="changeList(this);">';
        echo '<option>選択してください</option><option>投手</option><option>捕手</option><option>一塁手</option><option>二塁手</option>';
        echo '<option>三塁手</option><option>遊撃手</option><option>左翼手</option><option>中堅手</option><option>右翼手</option><option>指名打者</option></select>';
        echo '</td><td><button onclick="upList(this)">↑</button><button onclick="downList(this)">↓</button></td>';
        echo '<td><a href="cart-delete.php?id=<?php echo $id; ?>">削除</a></td></tr>'
    }
    echo '</table>';

}else{
    echo '<h2>選手を追加してください</h2>';
}
    ?>
<form method="get" action="index.php">
    <input type="text" name="keyword" placeholder="選手名を入力">
    <select name="team">
        <option value="">すべてのチーム</option>
        <option value="tigers">阪神タイガース</option>
        <option value="baystars">横浜DeNAベイスターズ</option>
        <option value="carp">広島東洋カープ</option>
        <option value="gians">巨人</option>
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
$pdo =new PDO($connect,USER,PASS);

if(isset($_POST['keyword'])){
    $sql=$pdo->prepare('select * from baseball where name like ?');
    $sql->execute(['%'.$_POST['keyword'].'%']);
}else{
    $sql=$pdo->query('select * from baseball');
}
foreach($sql as $row){
    $id=$row['id'];
    echo '<tr>';
    echo '<td>',$row['name'],'</td>';
    echo '<td>',$row['team'],'</td>';
    echo '<td>', $row['position'],'</td>';
    echo '</tr>';
}
echo '</table>';
?>