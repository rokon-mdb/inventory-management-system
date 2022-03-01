<?php
    session_start(); 
    if(isset($_SESSION['username']) && isset($_SESSION['password']))
    {
    include_once 'database.php';
    $sqltb = mysqli_connect($servername, $username, $password, $dbName);
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
        function validationN(){
            var y = document.forms["purchaseForm"]["paUnit"].value;
            if(isNaN(y))
            {
                alert("Invalid Amount. \nAmount must be a number.");
                return false;
            }
            var x = document.forms["purchaseForm"]["puPrice"].value;
            if(isNaN(x))
            {
                alert("Invalid Unit Price. \nUnit Price must be a number.");
                return false;
            }
        }
    </script>
</head>
<body >
<div class="navbarC">
        <a href="home.php">Home</a>
        <a href="infoProduct.php">Product Information</a>
        <a class="activeNB" href="purchase.php">Purchase</a>
        <a href="sale.php">Sale</a>
        <a href="allReport.php">Transaction Report</a>
        <div class="lout">
            <a href="logout.php">Log Out</a>
        </div>

    </div>

    <div class = "rt">
    <h2>Please Enter New Product Information</h2>
    <br>
    <form action="" name="purchaseForm" method="POST" onsubmit="return validationN()">
        
            <lable>Product Name:</lable>
            <input name="pName" type="text" required >
            <lable>Purchase Date:</lable>
            <input name="pDate" type="date" required>
            <br><br>
            <lable>Purchase Unit(Amount) :</lable>
            <input name="paUnit" type="text" required>
            
            <lable>Purchase Unit Price :</lable>
            <input name="puPrice" type="text" required>
            
            <br>
            <button class="bs" type="submit" name="Spurchase" >Purchase</button>
        </div>
        

    </form>
    </div>

</body>

</html>



<?php

if(isset($_POST["Spurchase"]))
{
            
    //insert data
    $sqlpr = "INSERT INTO 
        Purchase (
            _productName,
            _amountUnit,
            _pUnitPrice,
            _purchaseDate ) 
        VALUES (
            '$_POST[pName]',  
            '$_POST[paUnit]',
            '$_POST[puPrice]',
            '$_POST[pDate]'           
        )";
        
    if (mysqli_query($sqltb, $sqlpr)) {
        
        $sqlsu = "SELECT * FROM `Stock` 
        WHERE `Stock`.`_productName` = '$_POST[pName]'";
        $unt = mysqli_query($sqltb, $sqlsu);
        $data = mysqli_fetch_array($unt);
        $tu = (INT) $_POST['paUnit'];
        $ht = mysqli_num_rows($unt);
        #echo "un: ".$tu." row: ".$ht;
        if ($ht > 0){
            $totalUnit = $tu + (INT) $data["_amountUnit"];
            //echo "hiecho $totalUnit unit";
            
            $_sql = "UPDATE `Stock` SET 
                `Stock`.`_amountUnit` = '$totalUnit'
                WHERE `Stock`.`_productName` = '$_POST[pName]' ";
            mysqli_query($sqltb, $_sql);
            #echo "hi";
        }
        else{
            #echo "bye";
            $sqlstock = "INSERT INTO 
            Stock (
                _productName,
                _amountUnit ) 
            VALUES (
                '$_POST[pName]',
                '$tu'           
                )";
            mysqli_query($sqltb, $sqlstock);
        }
        echo "   Congratulation..! New record created successfully";
        header("refresh: 1; purchase.php");    
    }
    else {
        echo "   Adding this purchase data is failed.<br>";
        echo "   DATABASE ERROR: " . mysqli_error($sqltb);
        header("refresh: 3; purchase.php");
    }


    mysqli_close($cnt);
    mysqli_close($sqltb);
}
}
else
{
    echo "<h2>Page is Not Working...!</h2>";
    echo "<h5>Please log in first.</h5>";
    header("refresh: 5; login.php");
}
?>