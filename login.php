<?php


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <script src="jss.js"></script>
    <script src="https://kit.fontawesome.com/3ed3e280c1.js" crossorigin="anonymous"></script>
    <title>Admin Login</title>
</head>
<body>
    <div id="login">
    </br>
    <div>
        <a href="index.html"><img src="image/TravelLogo_2.jpg"></a>
        <form class="login">

            <p class="login-text">
                <label class="login-lbl" for="">Username: </label>  
                <input class="login-input" type="text" name="username"> 
            </p>
            </br>

            <p class="login-text">
                <label class="login-lbl" for="">Category: </label> 
                <input class="login-input" type="password" name="password"> 
            </p>
            </br>


            <div class="login-btn">
                <button type="submit" class="login-btn">Login</button> 
                <a href="admin_portal.html" style="color:blue">PROTOTYPE LOGIN</a>
                <a href="index.html" class="login-home" style="color:#7C6990"><p>Site Home</p></a>
            </div><!--END OF LOGIN-BTN-->
        </form><!--END OF FORM-->
        
    </div>
    </div><!--END OF LOGIN-->
    
</body>
</html>