<?php
    session_start(); 
    if(isset($_SESSION['username']) && isset($_SESSION['password']))
    {
    include_once 'database.php';
    $sqltb = mysqli_connect($servername, $username, $password, $dbName);
    $allProducts = mysqli_query($sqltb,"SELECT * FROM Products");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="up.css" type="text/css">
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
    <div class = "rt">
    <h2>Product List</h2>
    <button> <a href="addProduct.php">Add a New Product</a></button>
    
    <br><br>

    <?php
    if (mysqli_num_rows($allProducts) > 0) {
        ?>
        <table class="table table-striped">
            <tr>
                <td>Serial</td>
                <td>Product Name</td>
                <td>Product Description</td>
                <td>Unit</td>
                <td>Unit Price</td>
                <td colspan="2">Actions</td>
            </tr>
            <?php
                $i=0;
                while($data = mysqli_fetch_array($allProducts)) {
            ?>
                <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $data["_productName"]; ?></td>
                    <td><?php echo $data["_productDescription"]; ?></td>
                    <td><?php echo $data["_unit"]; ?></td>
                    <td><?php echo $data["_unitPrice"]; ?></td>
                    <td><button ><a href="up2.php?_productName=<?php echo $data["_productName"]; ?>">UPDATE</a></button></td>
                    <td><button ><a href="dp.php?_productName=<?php echo $data["_productName"]; ?>">DELETE</a></button></td>
                </tr>
                
            <?php
                $i++;
            }
            ?>
    </table>
    <?php
    }
    else
    {
        echo "No Row found in \"Products\" Table";
    }
    ?>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="endpg">
        <h5>____End of Page____</h5>
    </div>
    <br>
    <br>
</body>

</html>



<?php

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