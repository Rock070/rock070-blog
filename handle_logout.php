<?php
    require('conn.php');
    session_start();
    session_destroy();

    header('Location: index.php');
?>
