<?php
session_start();
if (!isset($_SESSION['player'])) {
    $_SESSION['player'] = [];
}

// 'item_id' キーが POST に存在し、かつカートに追加されていない
if (isset($_GET['id']) && (!in_array($_GET['id'], array_column($_SESSION['player'], 'id'))) || count($_SESSION['player']) < 10) {
    $id = $_GET['id'];

    $_SESSION['item'][$id] = [
        'id' => $id,
        'name' => $_GET['player-name']
    ];
    header('Location: index.php');
    exit();
} else {
    header('Location: index.php');
    exit();
}
?>