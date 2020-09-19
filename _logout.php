<?php
    session_start();
    echo 'plese wait you are log out....';
    session_destroy();
    header("location:/fourm_website/index.php");
?>