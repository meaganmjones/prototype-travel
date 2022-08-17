<?php

  include_once __DIR__ . '\model\product.php';

  include_once __DIR__ . '\model\category.php';

  include_once __DIR__ . '\model\color.php';

  include_once __DIR__ . '\include\functions.php';
  
  // Set up configuration file and create database
  $configFile = __DIR__ . '\model\dbconfig.ini';

  try 
  {
      $productData = new Product($configFile);
  } 
  catch ( Exception $error ) 
  {
      echo "<h2>" . $error->getMessage() . "</h2>";
  }   
   
  // If it is a GET, we are coming from admin_portal.php
  // let's figure out if we're doing update or add
  if (isset($_POST)) 
  {

    $productList = $productData->getProduct();
    // $product_name = $row['productName'];
    // $product_price = $row['productPrice'];
    // $product_image = $row['productImage'];

    $path = "upload/";


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
    <title>Products | Travel</title>
</head>
<body>
    <div id="container">
        <div id="nav">
            <div class="logo">
              <a href="index.html"><img src="image/TravelLogo_2.jpg" class="logoimg"></a>
            </div><!--END OF LOGO-->
            <div class="buttons">
            <div class="new">
                <button class="btn">New</button>
            </div><!--END OF NEW-->
            <div class="clothing">
                <button onclick="myFunction()" class="btn">Clothing</button>
                <div class="dropdown-content">
                    <a href="shirts.html" class="menu">T Shirts</a>
                    <a href="hoodies.html" class="menu">Hoodies</a>
                    <a href="socks.html" class="menu">Socks</a>
                    <a href="all_products.html" class="menu">Shop All</a>
                  </div><!--END OF DROPDOWN-CONTENT-->
              </div><!--END OF CLOTHING-->
              <div class="dropdown">
                  <button onclick="myFunction()" class="btn">Accessories</button>
                  <div class="dropdown-content">
                    <a href="#" class="menu">Hats</a>
                    <a href="#" class="menu">Bags</a>
                    <a href="#" class="menu">Stickers</a>
                  </div><!--END OF DROPDOWN-CONTENT-->
              </div><!--END OF DROPDOWN-->
              </div><!--END OF BUTTONS-->
            <div class="search">
                <div class="topnav">
                    <input type="text" placeholder="Search" class="input">
                    <i class="fas fa-search fa-xs" class="magnify"></i>
                </div><!--END OF TOPNAV-->
            </div><!--END OF SEARCH-->
        </div><!--END OF NAV-->
    </div><!--END OF CONTAINER-->
    <div id="main">
        <div class="hero">
            
        </div><!--END OF HERO-->

        <div class="prodTitle">
            <h1>All Products</h1>
        </div><!--END OF PRODTITLE-->
        <div class="prod">
            <?php foreach ($productList as $row): ?>
            <div class="prodResult">
            <div class="prodimg">
                <img src="<?php echo $path.$row['productImage']; ?>">
            </div><!--END OF PRODIMG-->
                <p><?php echo $row['productName']; ?></p>
                <p>$<?php echo $row['productPrice']; ?></p>
            </div><!--END OF PRODRESULT-->
            <?php endforeach ?>
        </div><!--END OF PROD-->
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
            <div class="ftinfo">
              <div class="info">
                <i class="fab fa-twitter-square" class="icon"></i>
                <i class="fab fa-instagram" class="icon"></i>
                <i class="fab fa-facebook-square" class="icon"></i>
              </div><!--END OF INFO-->
    
            <div class="copyright"></div>
              <p class="tiny">&copyTravel 2018</p>
          </div><!--END OF COPYRIGHT-->
          </div><!--END OF RIGHTFOOT-->
        </div><!--END OF FTINFO-->
        
    
    </footer><!--END OF FOOTER-->
    </div><!--END OF CONTAINER-->
    
</body>
</html>