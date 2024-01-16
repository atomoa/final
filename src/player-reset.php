<?php
session_start();
    if(isset($_SESSION['player'])) {
        unset($_SESSION['player']);
    }

header('Location: index.php');
exit();
?>