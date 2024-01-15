<?php
session_start();
if (!isset($_SESSION['player'])) {
    $_SESSION['player'] = [];
}

// 'item_id' キーが POST に存在し、かつカートに追加されていない
if (isset($_POST['id']) && (!in_array($_POST['id'], array_column($_SESSION['player'], 'id'))) || count($_SESSION['player']) < 10) {
    $id = $_POST['id'];

    $_SESSION['item'][$id] = [
        'id' => $id,
        'name' => $_POST['player-name']
    ];
    header('Location: index.php');
    exit();
} else {
    header('Location: index.php');
    exit();
}
?>