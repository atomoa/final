<!DOCTYPE html>
<html lang="ja">
    <head>
	<meta charset="UTF-8">
	<title>管理者画面</title>
    </head>
    <body>
        <h1>選手追加</h1>
        <p><a href="admin.php">戻る</a></p>
        <hr>
        <p>追加したい選手の情報を入力してください</p>
        <form action="admin-insert-after.php" method="post">
            選手名：<input type="text" name="name">
            チーム名：
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
            ポジション：
            <select name="position">
                <option value="catcher">捕手</option>
                <option value="infielder">内野手</option>
                <option value="outfielder">外野手</option>
                <option value="pitcher">投手</option>
            </select>
            <button type="submit">追加</button>
        </form>
    </body>
</html>