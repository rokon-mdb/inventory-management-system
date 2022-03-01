
<!DOCTYPE html>

<?php
    session_start(); 
    if(isset($_SESSION['username']) && isset($_SESSION['password']))
    {
    include_once 'database.php';
    $sqltb = mysqli_connect($servername, $username, $password, $dbName);
    $allProducts = mysqli_query($sqltb,"SELECT * FROM Products");
?>

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
            var y = document.forms["updateForm"]["upUnitPrice"].value;
            if(isNaN(y))// value === 'number' && isFinite(value);
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
    <div class="rt">
        Path: <a href="infoProduct.php">Product Information</a> -> <a href="up2.php">Update Product info</a>
        <br>

        <?php
            //echo "hi " . $_GET['_productName'] ." bye";
            //echo $sqltb;
            $keyName = $_GET['_productName'];
            $uProduct = mysqli_query($sqltb,"SELECT * FROM `Products` WHERE `Products`.`_productName`='$keyName'");
            //echo "hi";
            $udata= mysqli_fetch_array($uProduct);
        ?>
        <form action="" name="updateForm" method="POST" onsubmit="return validationN()" >
        
                <lable>Product Name: </lable>
                <input name="upName" type="text" required value="<?php echo $keyName; ?>" >
                
                <lable>Product Description: </lable>
                <input name="upDescription" type="text" required value="<?php echo $udata['_productDescription']; ?>" >
                <br><br>
                <lable>Product Unit :  </lable>
                <select name="upUnit" id="upId" >
                    <option value="kg">Kilogram</option>
                    <option value="Gm">Gram</option>
                    <option value="Meter">Meter</option>
                    <option value="Litter">Litter</option>
                    <option value="Dozon">Dozon</option>
                    <option value="Piece">Piece</option>
                </select>
            
                <lable>Product Unit Price:  </lable>
                <input name="upUnitPrice" type="text" required value="<?php echo $udata['_unitPrice']; ?>">
                <br>
                <button class="bs" type="submit" name="submitup" >Update</button>
            

        </form>
    </div>


</body>

</html>



<?php

    if(isset($_POST["submitup"]))
    {   
        //$_iName = FORM["updateForm"]["upName"].value;
        $_iName = $_POST['upName'];
        $_iDesc = $_POST['upDescription'];
        $_iUnit = $_POST['upUnit'];
        $_iUnitPrice = $_POST['upUnitPrice'];
        
        
        //echo $_iName." ".$_iDesc." ".$_iUnit." ".$_iUnitPrice;
    
        $_sql = "UPDATE `Products` SET 
        `_productName` = '$_iName', 
        `_productDescription` = '$_iDesc',
        `_unit` = '$_iUnit', 
        `_unitPrice` = '$_iUnitPrice' 
        WHERE `Products`.`_productName` = '$keyName' ";

        $_ustock = "UPDATE `Stock` SET
            `_productName` = '$_iName'
            WHERE `Stock`.`_productName` = '$keyName' ";

        if (mysqli_query($sqltb, $_sql)) {
            
            mysqli_query($sqltb, $_ustock);

            echo "   Congratulation..! $keyName Updated successfully.<br>";
            echo "   The page will redirect to main page in 3 second.....<br>";
            echo "   . .. ...<br>";
            header("refresh: 3; infoProduct.php");
            
        }
        else {
            echo "   $keyName Updatation is failed.<br>";
            echo "   DATABASE ERROR: " . mysqli_error($sqltb);
        }
    
    }

    mysqli_close($cnt);
    mysqli_close($sqltb);
    }
    else
    {
        echo "<h2>Page is Not Working...!</h2>";
        echo "<h5>Please log in first.</h5>";
        header("refresh: 5; login.php");
    }
?>