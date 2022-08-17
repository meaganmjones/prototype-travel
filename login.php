<?php

<<<<<<<<< Temporary merge branch 1:login.php
=========
    // Include functions
    include_once __DIR__ . '/include/functions.php';

    // include AdminLogin Class
    include_once __DIR__ . '/model/admin_login.php';

    // set logged in to false
    $_SESSION['loggedIn'] = false;
    
    
    $message = "";
    if (postRequest()) 
    {
        // get _POST form fields
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        
        // Set up configuration file and create database
        $configFile = __DIR__ . '/model/dbconfig.ini';
        try 
        {
            $loginLookup = new AdminLogin($configFile);
            
        } 
        catch ( Exception $error ) 
        {
            
            echo "<h2>" . $error->getMessage() . "</h2>";
        }   
    
        
        // check to see if user credentials are valid.
        if ($loginLookup->validateCredentials($username, $password))
        {
            
            // set logged in to TRUE
            $_SESSION['loggedIn'] = true;
            // Redirect to admin_portal page
            header ('Location: admin_portal.html');
        } 
        else 
        {
            
           // error message
           $message = "You did not enter the correct login credentials.";
        }
    }
>>>>>>>>> Temporary merge branch 2:login.html

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
                <input class="login-input" type="text" name="username" required> 
            </p>
            </br>

            <p class="login-text">
                <label class="login-lbl" for="">Password: </label> 
                <input class="login-input" type="password" name="password"> 
                <a onclick="#">Show Password</a>
            </p>
            </br>


            <div class="login-btn">
                <button type="submit" class="login-btn">Login</button> 
                <a href="admin_portal.php" style="color:blue">PROTOTYPE LOGIN</a>
                <a href="index.html" class="login-home" style="color:#7C6990"><p>Site Home</p></a>
            </div><!--END OF LOGIN-BTN-->
        </form><!--END OF FORM-->
        
    </div>
    </div><!--END OF LOGIN-->
    
</body>
</html>