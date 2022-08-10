<?php

  // include_once __DIR__ . '/model/product.php';

  // include_once __DIR__ . '/include/functions.php';
  
  // // Set up configuration file and create database
  // $configFile = __DIR__ . '/model/dbconfig.ini';

  // if (!loggedIn())
  //   {
  //       header ('Location: login.php');
  //   }

  // try 
  // {
  //     $productData = new Product($configFile);
  // } 
  // catch ( Exception $error ) 
  // {
  //     echo "<h2>" . $error->getMessage() . "</h2>";
  // }   
   
  // // If it is a GET, we are coming from admin_portal.php
  // // let's figure out if we're doing update or add
  // if (isset($_GET['action'])) 
  // {
  //     $action = filter_input(INPUT_GET, 'action');
  //     $product_id = filter_input(INPUT_GET, 'productID', );
  //     if ($action == "Update") 
  //     {
  //         $row = $productData->getProduct($product_id);
  //         $product_name = $row['productName'];
  //         $product_price = $row['productPrice'];
  //         $product_size = $row['productSize'];
  //         $product_quantity = $row['productQuantity'];
  //         $product_image = $row['productImage'];
  //     } 
  //     //else it is Add and the user will enter info
  //     else 
  //     {
  //         $product_name = "";
  //         $product_price = "";
  //         $product_size = "";
  //         $product_quantity = "";
  //         $product_image = "";
  //     }
  // } // end if GET

  // // If it is a POST, we are coming from update.php
  // // we need to determine action, then return to admin_portal.php
  // elseif (isset($_POST['action'])) 
  // {
  //     $action = filter_input(INPUT_POST, 'action');
  //     $product_id = filter_input(INPUT_POST, 'productID');
  //     $product_name = filter_input(INPUT_POST, 'productName');
  //     $product_price = filter_input(INPUT_POST, 'productPrice');
  //     $product_size = filter_input(INPUT_POST, 'productSize');
  //     $product_quantity = filter_input(INPUT_POST, 'productQuantity');
  //     $product_image = filter_input(INPUT_POST, 'productImage');

  //     if ($action == "Add") 
  //     {
  //         $result = $productData->addProduct ($product_name, $product_size, $product_price, $product_quantity, $product_image);
  //     } 
  //     elseif ($action == "Update") 
  //     {
  //         $result = $productData->updateProduct ($product_id, $product_name, $product_price, $product_size, $product_quantity, $product_image);
  //     }

  //     // Redirect to admin_portal page
  //     header('Location: admin_portal.php');
  // } // end if POST

  // // If it is neither POST nor GET, we go to admin_portal.php
  // // This page should not be loaded directly
  // else
  // {
  //   header('Location: admin_portal.php');  
  // }
      
?>
    <!--Creating the form to be used to update or add a product to the database-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <script src="jss.js"></script>
    <script src="https://kit.fontawesome.com/3ed3e280c1.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>EDIT | Travel</title>
</head>
<body>
<div id="container">
  <div id="nav" class="navbar">
    <div class="logo">
      <a href="index.html"><img src="image/TravelLogo_2.jpg" class="logoimg"></a>
    </div><!--END OF LOGO-->
    <div class="buttons">
      <div class="new">
        <button class="btn">New</button>
      </div><!--END OF NEW-->
      <div class="clothing">
        <button onclick="dropDown()" class="btn">Clothing</button>
        <div class="dropdown-content">
          <a href="shirts.html" class="menu">T Shirts</a>
          <a href="hoodies.html" class="menu">Hoodies</a>
          <a href="socks.html" class="menu">Socks</a>
          <a href="all_products.html" class="menu">Shop All</a>
        </div><!--END OF DROPDOWN-CONTENT-->
    </div><!--END OF CLOTHING-->
    <div class="dropdown">
        <button onclick="dropDown()" class="btn">Accessories</button>
        <div class="dropdown-content">
          <a href="#" class="menu">Hats</a>
          <a href="#" class="menu">Bags</a>
          <a href="#" class="menu">Stickers</a>
        </div><!--END OF DROPDOWN-CONTENT-->
      </div><!--END OF DROPDOWN-->
      </div><!--END OF BUTTONS-->

      <div class="account">
        <div class="dropdown">
          <a style="text-decoration: none;" href="login.php" onclick="dropDown()"><i class="fa-solid fa-circle-user fa-2xl" style="color:#7C6990;"></i></a>
          <!-- <button onclick="dropDown()" class="btn">Accessories</button> -->
          <div class="dropdown-content">
            <a href="#" class="menu">Account</a>
            <a href="#" class="menu">Logout</a>
            <!-- <a href="#" class="menu"></a> -->
          </div><!--END OF DROPDOWN-CONTENT-->
        </div><!--END OF DROPDOWN-->
      </div><!--END OF ACCOUNT-->


    <div class="search">
        <div class="topnav">
            <input type="text" placeholder="Search" class="search_input">
            <i class="fas fa-search fa-xs"></i>

            
          </div><!--END OF TOPNAV-->
        </div><!--END OF SEARCH-->


</div><!--END OF NAV-->
<div id="pp-main">
    <div class="desc">
        <div class="prod-pg-left">
            <div class="pic">
                <img src="#" class="prod-pic">
            </div><!--END OF PIC-->
        </div><!--END OF PROD-PG-LEFT-->
        <div class="prod-pg-right">
            <div class="text">
              <h2 class="prod-title"><input placeholder="Title" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;"></h2>
              
              <h3 class="prod-price"><input placeholder="Price" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;"></h3>
                <!-- <div class="colorpick">
                    <p class="pick">Choose A Color</p>
                    <label class="edit_color">pink
                        <input type="radio" name="rdo_color">
                        <span class="checkmark"></span>
                    </label>
                    <label class="edit_color">grey
                      <input type="radio" name="rdo_color">
                      <span class="checkmark"></span>
                  </label>
                  <label class="edit_color">blue
                    <input type="radio" name="rdo_color">
                    <span class="checkmark"></span>
                </label> -->
                    <!-- <i class="fas fa-circle fa-lg" style="color: hotpink;"></i>
                    <i class="fas fa-circle fa-lg" style="color: grey;"></i>
                    <i class="fas fa-circle fa-lg" style="color: black;"></i> -->
                <div class="dropdown">
                    <button onclick="dropDown()">Choose Color</button>
                      <!-- <button onclick="dropDown()" class="btn">Accessories</button> -->
                    <div class="dropdown-content">
                      <a href="#" class="menu">White</a>
                      <a href="#" class="menu">Grey</a>
                      <a href="#" class="menu">Black</a>
                    </div><!--END OF DROPDOWN-CONTENT-->

                <!-- </div>END OF COLORPICK -->

                <div class="sizepick">
                    <button class="size">XS</button>
                    <button class="size">S</button>
                    <button class="size">M</button>
                    <button class="size">L</button>
                    <button class="size">XL</button>
                </div><!--END OF SIZEPICK-->
                <div class="addbtn">
                    <button onclick="cartBtn()">Add To Cart</button>
                </div><!--END OF ADDBTN-->
            </div><!--END OF TEXT-->
        </div><!--END OF PROD-PG-RIGHT-->
    </div><!--END OF DESC-->
</div><!--END OF MAIN-->

<footer>
    <div class="ftwords">
      <div class="ftleft">
        <a href="#" class="bold">Get Help</a>
        <a href="#" class="sml">Order Status</a>
        <a href="#" class="sml">Customer Service</a>
        <a href="#" class="sml">Shipping & Delivery</a>
        <a href="#" class="sml">Returns</a>
      </div><!--END OF FTLEFT-->
      <div class="ftright">
        <a href="#" class="bold">About Us</a>
        <a href="#" class="sml">Contact Us</a>
        <a href="#" class="sml">About Travel</a>
        <a href="#" class="sml">The Blog</a>
        <a href="#" class="sml">Travel Team Page</a>
      </div><!--END OF RIGHT-->
    </div><!--END OF FTWORDS-->
      <div class="rightfoot">
        <p>Connect With Us</p>
        <div class="connect">
          <input type="text" placeholder="Email">
          <!--<button class="emailbtn">Submit</button>-->
          <i class="fas fa-check-square" class="check"></i>
        </div><!--END OF CONNECT-->
        
          <div class="info">
            <i class="fab fa-twitter-square" class="icon"></i>
            <i class="fab fa-instagram" class="icon"></i>
            <i class="fab fa-facebook-square" class="icon"></i>
          </div><!--END OF INFO-->

          <p class="tiny">&copyTravel 2018</p>
    
      </div><!--END OF RIGHTFOOT-->

</footer><!--END OF FOOTER-->
</div><!--END OF CONTAINER-->
</body>
</html>