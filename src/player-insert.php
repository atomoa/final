<?php
session_start();

if (!isset($_SESSION['player'])) {
    $_SESSION['player'] = [];
}

// POSTで送られてきたデータを検証して追加
if (isset($_POST['id']) && !in_array($_POST['id'], array_column($_SESSION['player'], 'id')) && count($_SESSION['player']) < 9) {
    $id = $_POST['id'];

    $_SESSION['player'][$id] = [
        'id' => $id,
        'order' => count($_SESSION['player'])+1,
        'name' => $_POST['name']
    ];
    header('Location: index.php');
    exit();
} else {
    header('Location: index.php');
    exit();
}
?>
