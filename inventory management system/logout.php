<?php
    SESSION_START();
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    SESSION_DESTROY();
    header("location: login.php");
?>