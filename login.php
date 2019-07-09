<?php
    session_start();
    require_once("config.php");    
?>
<!doctype html>
<html>
<head>
    <title>FoodHub</title>

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <style type="text/css">
    body {
        background-image: url("images/back3.jpg");
        background-size: cover;
        margin: 0;
        padding: 0;
        font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
        
    }
    .login-form {
        width: 600px;
        margin: 5em auto;
        padding: 50px;
        background-color:transparent;
        border-radius: 1em;
    }

    h1 {
       color:hsl(0, 100%, 30%);
       margin-left: 20px;
    }

    </style>    
</head>

<body>
<div class=login-form>
    <h1>Login to FoodHub</h1>
    <form action="authenticatelogin.php" method="post">
        <div class ="form-group">
        <?php
        if ($_GET["auth"] == "empty"){
            echo "Username or Password cannot be empty";
        }
        else if ($_GET["auth"] == "incorrect"){
            echo "Username or Password incorrect";
        }
        ?>
            <input type="username" class="form-control" placeholder="Username" name="username" >
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password">
        </div>
        <div>
            <button type="submit" class="btn btn-primary btn-block" value="Login">Log in</button>
        </div>
    </form>
</div>
</body>
</html>