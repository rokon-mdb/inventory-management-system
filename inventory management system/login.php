<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="bootstrap.min.css" type="text/css">
    <style>    
        h4{
            text-align: center;
        }
        input,label{
            margin-left: 10px;
        }
        button{
            color: blue;
            margin-left: 40%;
        }
        
    </style>
    <script>

    
    </script>
</head>
<body>
    <div class="navbarC">
        <a class="active" href="login.php">login</a>
    </div>
    <br>
    <div class="wlc">
        <h3>Welcome to Gram Bazar Inventory </h3>
    </div>
    <div class="loginT">
        <form action="logindb.php" name="loginForm" method="POST">
            <h4>Log In to Inventory Admin</h4>
            <br>
            <label> username: </label>
            <input type="text" name="username" placeholder="admin" required>
            <br>
            <label> password: </label>
            <input type="password" name="pw" placeholder="********" required>
            <br>
            <br>
            <button type="submit" name="login" >log in </button>
            
            
        </form>


    </div>

    
</body>

</html>



<?php
    mysqli_close($cnt);
    mysqli_close($sqltb);
?>