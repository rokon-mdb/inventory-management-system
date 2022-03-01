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
            var y = document.forms["saleForm"]["sUnit"].value;
            if(isNaN(y))
            {
                alert("Invalid Amount. \nAmount must be a number.");
                return false;
            }
            //var z = (int) y;
          //  var x = (int) "<?//php echo "$sdUnit"; ?>";
          //  if(z>x)
          //  {
         //       alert("Insufficient Stock.");
         //       return false;
          //  }
        }
    </script>
</head>
<body >
<div class="navbarC">
        <a href="home.php">Home</a>
        <a href="infoProduct.php">Product Information</a>
        <a href="purchase.php">Purchase</a>
        <a class="activeNB" href="sale.php">Sale</a>
        <a href="allReport.php">Transaction Report</a>
        <div class="lout">
            <a href="logout.php">Log Out</a>
        </div>

    </div>
    <div class = "rt">
    <h2>Please Enter New Sale Information</h2>
    <br>
    <form action="" name="saleForm" method="POST" onsubmit="return validationN()">
        
            <lable>Product Name:</lable>
            <input name="sName" type="text" required >
            <lable>Sale Date:</lable>
            <input name="sDate" type="date" required>
            <br><br>
            
            <lable>Sale Unit (Amount) :</lable>
            <input name="sUnit" type="text" required>
            
            <br>
            <button class="bs" type="submit" name="Ssale" >ADD</button>
        </div>
        

    </form>
    </div>

</body>

</html>



<?php

if(isset($_POST["Ssale"]))//&& $_POST["onsubmit"])
{
            
    //insert data
    $sqlpr = "INSERT INTO 
        Sales (
            _productName,
            _amountUnit,
            _saleDate ) 
        VALUES (
            '$_POST[sName]',  
            '$_POST[sUnit]',
            '$_POST[sDate]'           
        )";

    $sqlsu = "SELECT * FROM `Stock` 
    WHERE `Stock`.`_productName` = '$_POST[sName]'";
    $unt = mysqli_query($sqltb, $sqlsu);

    $data = mysqli_fetch_array($unt);
    $sdUnit = (INT) $data["_amountUnit"];
    $totalUnit = $sdUnit - (INT) $_POST['sUnit'] ;

    if($totalUnit<0)
    {
        echo "
            <script>    
                alert('Insufficient Stock.');
            </script>

        ";
    }
    else if (mysqli_query($sqltb, $sqlpr)) {
        
        
        //alert("Hello! I am an alert box!!");
        $_sql = "UPDATE `Stock` SET 
            `Stock`.`_amountUnit` = '$totalUnit'
            WHERE `Stock`.`_productName` = '$_POST[sName]' ";
        mysqli_query($sqltb, $_sql);

        echo "   Congratulation..! New record created successfully";
        header("refresh: 1; sale.php");    
    }
    else {
        echo "   Adding this sale data is failed.<br>";
        echo "   DATABASE ERROR: " . mysqli_error($sqltb);
        header("refresh: 3; sale.php");
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