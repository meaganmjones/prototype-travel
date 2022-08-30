<?php

    // Include helper utility functions
    include_once __DIR__ . '/include/functions.php';

    // Include user database definitions
    include_once __DIR__ . '/model/admin_login.php';

    // set logged in to false
    $_SESSION['loggedIn'] = false;
    
    // If this is a POST, check to see if user credentials are valid.
    // First we need to gab the crednetials form the form 
    //      and create a user database object
    $message = "";

    if (postRequest()) 
    {
        //echo "made it";
        // get _POST form fields
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        //echo "made it 5";
        // Set up configuration file and create database
        $configFile = __DIR__ . '/model/dbconfig.ini';
        try 
        {
            $loginData = new AdminLogin($configFile);
            //echo "made it 6";
        } 
        catch ( Exception $error ) 
        {
            //echo "made it 4";
            echo "<h2>" . $error->getMessage() . "</h2>";
        }   
    
        
        // Now we can check to see if use credentials are valid.
        if ($loginData->validateCredentials($username, $password))
        {
            //echo "made it 2";
            // If so, set logged in to TRUE
            $_SESSION['loggedIn'] = true;
            // Redirect to team list page
            header ('Location: admin_portal.php');
        } 
        else 
        {
            //echo "made it 3";
           // Whoops! Incorrect login. Tell user and stay on this page.
           $message = "You did not enter the correct login credentials.";
        }
    }

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
                <input class="login-input" type="password" name="password" required> 
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