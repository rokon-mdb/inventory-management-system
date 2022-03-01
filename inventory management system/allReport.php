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
        function validDate(){
            var x = document.forms["Tform"]["sDate"].value;
            var y = document.forms["Tform"]["eDate"].value;
            
            if(x>y)
            {
                alert("Invalid End Date.");
                return false;
            }
            
        }
    
    </script>
</head>
<body >
    <div class="navbarC">
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

    <h2>Transaction Report:</h2>
    
    <form action="reportDataBase.php" name="Tform" method="POST" onsubmit="return validDate()">

        <lable>Start Date:</lable>
        <input name="sDate" type="date" required >

        <lable class="to"> To </lable>

        <lable>End Date:</lable>
        <input name="eDate" type="date" required >
           
        <br>
        <button class="bs" type="submit" name="sReport" >Show Report</button>
        
        

    </form>
    <div>
</body>

</html>
<?php
    }
    else
    {
        echo "<h2>Page is Not Working...!</h2>";
        echo "<h5>Please log in first.</h5>";
        header("refresh: 5; login.php");
    }
?>