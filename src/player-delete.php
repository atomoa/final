<?php
session_start();
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    if(count($_SESSION['player'])<2) {
        unset($_SESSION['player']);
    }else{
        unset($_SESSION['player'][$id]);
    }
}

header('Location: index.php');
exit();
?>