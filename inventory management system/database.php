<?php
    session_start(); 
    if(isset($_SESSION['username']) && isset($_SESSION['password']))
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "IMS";
        $cnt = mysqli_connect($servername, $username, $password);
    
        if (!$cnt) {
            die("   Database Connection Error: " . mysqli_connect_error());
        }
    }
    else
    {
        echo "<h2>Database connection error...!</h2>";
        echo "<h5>Please log in first.</h5>";
        header("refresh: 5; login.php");
    }
?>