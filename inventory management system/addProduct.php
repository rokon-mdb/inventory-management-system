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
        function addValid(){
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
        <a class="activeNB" href="infoProduct.php">Product Information</a>
        <a href="purchase.php">Purchase</a>
        <a href="sale.php">Sale</a>
        <a href="allReport.php">Transaction Report</a>
        <div class="lout">
            <a href="logout.php">Log Out</a>
        </div>

    </div>
    
    <br> 
    <div class = "rt">
    Path: <a href="infoProduct.php">Product Information</a> -> <a href="addProduct.php">Add Product info</a>
        <br>
    <h2>Please Enter New Product Information:</h2>
    <br>
    <form action="" name="Tform" method="POST" onsubmit="return addValid()" >
        

        <lable>Product Name:</lable>
        <input name="pName" type="text" required >
        
        <lable>Product Description:</lable>
        <input name="pDescription" type="text" required >
        <br><br>

        <lable>Product Unit :  </lable>
            <select name="pUnit" >
                <option value="kg">Kilogram</option>
                <option value="Gm">Gram</option>
                <option value="Meter">Meter</option>
                <option value="Litter">Litter</option>
                <option value="Dozon">Dozon</option>
                <option value="Piece">Piece</option>
            </select>

        <lable>Product Unit Price:</lable>
        <input name="pUnitPrice" type="text" required >
        <br>
        <button class="bs" type="submit" name="submitadd" >ADD</button>
        <br>
    </form>

    </div>
</body>

</html>



<?php

        if(isset($_POST["submitadd"]))//&& $_POST["onsubmit"])
        {
                    
            //insert data
            $sqladd = "INSERT INTO 
                Products (
                    _productName,
                    _productDescription,
                    _unit,
                    _unitPrice ) 
                VALUES (
                    '$_POST[pName]', 
                    '$_POST[pDescription]', 
                    '$_POST[pUnit]',
                    '$_POST[pUnitPrice]'           
                )";
                
            if (mysqli_query($sqltb, $sqladd)) {
                //insert data in stock
                $sqlstock = "INSERT INTO 
                Stock (
                    _productName,
                    _amountUnit ) 
                VALUES (
                    '$_POST[pName]',
                    '0'           
                )";
                mysqli_query($sqltb, $sqlstock);
                echo "   Congratulation..! New record created successfully";
                header("refresh: 1; addProduct.php");    
            }
            else {
                echo "   Adding this product is failed.<br>";
                echo "   DATABASE ERROR: " . mysqli_error($sqltb);
                header("refresh: 3; addProduct.php");
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