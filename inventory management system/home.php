<?php
    session_start(); 

    if(isset($_SESSION['username']) && isset($_SESSION['password']))
    {
        

    include_once 'database.php';
    

    // Create database
    $sql = "CREATE DATABASE $dbName";
    mysqli_query($cnt, $sql);
     
    $sql_tb = mysqli_connect($servername, $username, $password, $dbName);
    $allProducts = mysqli_query($sql_tb,"SELECT * FROM Stock");
     // sql to create table
         
     $sqlProducts = "CREATE TABLE IF NOT EXISTS Products(
         _productName varchar(20) NOT NULL,
         _productDescription varchar(30) NOT NULL,
         _unit varchar(15) NOT NULL,
         _unitPrice FLOAT NOT NULL,
         UNIQUE (_productName)
         )";
 
     mysqli_query($sql_tb, $sqlProducts);

     //sale table
     $sqlPurchase = "CREATE TABLE IF NOT EXISTS Purchase(
         _purchaseId INT NOT NULL AUTO_INCREMENT,
         _productName varchar(20) NOT NULL,
         _amountUnit INT NOT NULL,
         _pUnitPrice FLOAT NOT NULL,
         _purchaseDate Date NOT NULL,
         PRIMARY KEY (_purchaseId)
         )";
 
     mysqli_query($sql_tb, $sqlPurchase);

     //sale table
     $sqlSale = "CREATE TABLE IF NOT EXISTS Sales(
         _saleId INT NOT NULL AUTO_INCREMENT,
         _productName varchar(20) NOT NULL,
         _amountUnit INT NOT NULL,
         _saleDate Date NOT NULL,
         PRIMARY KEY (_saleId)
         )";
 
     mysqli_query($sql_tb, $sqlSale);

     $sqlStock = "CREATE TABLE IF NOT EXISTS Stock(
         _productName varchar(20) NOT NULL,
         _amountUnit INT NOT NULL,
         PRIMARY KEY (_productName)
         )";
 
     mysqli_query($sql_tb, $sqlStock);

?>

<!DOCTYPE html>
<html>
<head>
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
            <a class="activeNB" href="home.php">Home</a>
            <a href="infoProduct.php">Product Information</a>
            <a href="purchase.php">Purchase</a>
            <a href="sale.php">Sale</a>
            <a href="allReport.php">Transaction Report</a>
            <div class="lout">
                <a href="logout.php">Log Out</a>
            </div>

        </div>

        <div class = "rt">

        <h1 class="hd">Welcome To</h1>
        <h1 class="hd">Gram Bazar Inventory </h1>

        <h2>Stock Status</h2>    
        <br><br>

        <?php
        if (mysqli_num_rows($allProducts) > 0) {
            ?>
            <table class="table table-striped">
                <tr>
                    <td>Serial</td>
                    <td>Product Name</td>
                    <td>Product Amount of Unit</td>
                    <td>Unit</td>
                </tr>
                <?php
                    $i=0;
                    while($data = mysqli_fetch_array($allProducts)) {
                ?>
                    <tr>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $data["_productName"]; ?></td>
                        <td><?php echo $data["_amountUnit"]; ?></td>
                        <td> <?php
                                $pname = $data["_productName"];
                                
                                $sup = "SELECT `Products`.`_unit` FROM `Products`
                                        WHERE `Products`.`_productName` = '$pname'";
                                $yp = mysqli_query($sql_tb, $sup);
                                
                                $up = mysqli_fetch_array($yp);
                                
                                $st = $up["_unit"];
                                echo $st;
                            ?>
                        </td>
                    </tr>
                    
                <?php
                    $i++;
                }
                ?>
        </table>
        <?php
        }
        ?>
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
    mysqli_close($sql_db);

    }
    else
    {
        echo "<h2>Page is Not Working...!</h2>";
        echo "<h5>Please log in first.</h5>";
        header("refresh: 5; login.php");
    }
    
?>