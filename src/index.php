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
<p>※選手情報は2023シーズン終了時のものになります</p>
<p>※選手は各チームの支配下選手のみとなります</p>
<form action="index.php" method="post">
    選手検索
    <input type="text" name="keyword">
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