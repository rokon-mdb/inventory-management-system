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
    
    </script>
</head>
<body >
    <div class="navbarC" >
        <a href="home.php">Home</a>
        <a href="infoProduct.php">Product Information</a>
        <a href="purchase.php">Purchase</a>
        <a href="sale.php">Sale</a>
        <a class="activeNB"  href="allReport.php">Transaction Report</a>
        <div class="lout">
            <a href="logout.php">Log Out</a>
        </div>
    </div>

    
    
    <div class = "rt">
    <?php
        //purchase report
            $startDate = $_POST['sDate'];
            $endDate = $_POST['eDate'];
            echo "<h2>Purchase Report:</h2>";
            echo "From ". $startDate . " to " . $endDate . "<br>";
            $sk = "SELECT * FROM `Purchase`
                    WHERE 
                    `Purchase`.`_purchaseDate` >= '$startDate'
                    and
                    `Purchase`.`_purchaseDate` <= '$endDate' ";
            $purchaseP = mysqli_query($sqltb, $sk);
            $sum = 0;
            if (mysqli_num_rows($purchaseP) > 0) {
                ?>
                
                <table>
                    <tr>
                        <td>Purchase Id</td>
                        <td>Purchase Date</td>
                        <td>Product Name</td>
                        <td>Amount of Unit</td>
                        <td>Unit Price</td>
                        <td>Total Payment(tk)</td>
                    </tr>
                            <?php
                            $i = 0;
                            
                            while($row = mysqli_fetch_array($purchaseP)) {
                            ?>
                    <tr>
                        <td><?php echo $row["_purchaseId"]; ?></td>
                        <td><?php echo $row["_purchaseDate"]; ?></td>
                        <td><?php echo $row["_productName"]; ?></td>
                        <td><?php echo $row["_amountUnit"]; ?></td>
                        <td><?php echo $row["_pUnitPrice"]; ?></td>
                        <td><?php 
                            $payment = (INT) $row["_amountUnit"] *  (INT) $row["_pUnitPrice"];
                            echo $payment; ?></td>
                    </tr>
                        
                            <?php
                                $sum += $payment;
                                $i++;
                            }
                            ?>
            </table>
            <div class="lout">
            <?php
            echo "<br>  Total purchase product of ".$sum." Tk";
            ?>
            </div>
            <?php
            }
            else
            {
                echo "No Transaction found";
            }
            ?>

    <?php
        //sale report
            
            echo "<br><br> <h2>Sale Report:</h2>";
            echo "From ". $startDate . " to " . $endDate . "<br>";
            $sks = "SELECT * FROM `Sales`
                    WHERE 
                    `Sales`.`_saleDate` >= '$startDate'
                    and
                    `Sales`.`_saleDate` <= '$endDate' ";
            $saleP = mysqli_query($sqltb, $sks);
            $sumS = 0;
            if (mysqli_num_rows($saleP) > 0) {
                ?>
                
                <table>
                    <tr>
                        <td>Sale Id</td>
                        <td>Sale Date</td>
                        <td>Product Name</td>
                        <td>Amount of Unit</td>
                        <td>Unit Price</td>
                        <td>Total Price(tk)</td>
                    </tr>
                            <?php
                            $i = 0;
                            
                            while($row = mysqli_fetch_array($saleP)) {
                            ?>
                    <tr>
                        <td><?php echo $row["_saleId"]; ?></td>
                        <td><?php echo $row["_saleDate"]; ?></td>
                        <td><?php echo $row["_productName"]; ?></td>
                        <td><?php echo $row["_amountUnit"]; ?></td>
                        <td><?php 
                            $pname = $row["_productName"];
                            $sup = "SELECT `Products`.`_unitPrice` FROM `Products`
                                    WHERE `Products`.`_productName` = '$pname'";
                            $yup = mysqli_query($sqltb, $sup);
                            $up = mysqli_fetch_array($yup);
                           
                            $st = (INT) $up["_unitPrice"];
                            echo $st; 
                        ?></td>
                        <td><?php 
                                $tp = (INT) $row["_amountUnit"] *  (INT) $st;
                                echo $tp; ?></td>
                    </tr>
                        
                            <?php
                                $sumS += $tp;
                                $i++;
                            }
                            ?>
                </table>
                <div class="lout">
                    <?php
                        echo "<br>  Total sale product of ".$sumS." Tk";
                    ?>
                </div>
            <?php
            }
            else
            {
                echo "No sale found";
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