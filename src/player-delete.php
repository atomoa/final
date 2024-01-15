<?php
session_start();
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    if(isset($_SESSION['player'][$id])) {
        unset($_SESSION['player'][$id]);
    }
}

header('Location: index.php');
exit();
?>