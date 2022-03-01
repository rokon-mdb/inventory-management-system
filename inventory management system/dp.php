<?php
    session_start(); 
    if(isset($_SESSION['username']) && isset($_SESSION['password']))
    {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap.min.css" type="text/css">
    <style>    
    
    </style>
    <script>
    
    </script>
</head>
<body >
    <div class="navbarC">
        <a href="home.php">Home</a>
        <a class="activeNB" href="infoProduct.php">Product Information</a>
        <a href="purchase.php">Purchase</a>
        <a href="sale.php">Sale</a>
        <a href="allReport.php">Transaction Report</a>
        <div class="lout">
            <a href="logout.php">Log Out</a>
        </div>

    </div>
    Path: <a href="infoProduct.php">Product Information</a> -> <a href="dp.php">Delete Product</a>
    <br>


    <div >
        <h2 >
        <?php
            include_once 'database.php';
            $sqltb = mysqli_connect($servername, $username, $password, $dbName);

            $key = $_GET['_productName'];
            $sqlDelete = "DELETE FROM `Products` WHERE `Products`.`_productName` = '$_GET[_productName]'";
            mysqli_query($sqltb, $sqlDelete);
            $sqlDStock = "DELETE FROM `Stock` WHERE `Stock`.`_productName` = '$_GET[_productName]'";
            mysqli_query($sqltb, $sqlDStock);

            echo "   Congratulation..! \"$key\" deleted successfully";  
            header("refresh: 2; infoProduct.php");

            //<a href="deleteProduct.php" >

            
        ?>
        </h2>
    </div>

</body>
</html>

<?php
    }
    else
    {
        echo "<h2>Page is Not Working...!</h2>";
        echo "<h5>Please log in first.</h5>";
        header("refresh:5; login.php");
    }
?>