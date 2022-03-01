<?php

    $un = $_POST["username"];
    $pw = $_POST["pw"];


    if ($un == "admin" && $pw == "admin")
    {
        session_start();
        $_SESSION['username'] = $un;
        $_SESSION['password'] = $pw;
        header("refresh:0; home.php");
    }
    else
    {
        echo "Invalid username or password...!";
        header("refresh:3; login.php");
    }
?>

