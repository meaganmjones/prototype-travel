<?php
    include_once __DIR__ . '/model/product.php';
    include_once __DIR__ . '/model/search.php';
    include_once __DIR__ . '/model/category.php';
    include_once __DIR__ . '/include/functions.php';

    $configFile = __DIR__ . '/model/dbconfig.ini';

    try 
    {
        $productDatabase = new Product($configFile);
        //$colorDatabase = new Color($configFile);
        $categoryDatabase = new Category($configFile);
        $searchDatabase = new ProductSearch($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   

    $searchString = "";

   if(postRequest()){
    if(isset($_POST['searchString']))
    {
      $searchString = filter_input(INPUT_POST, 'searchString');
      echo $searchString;
      //$searchResult = $searchDatabase->searchProducts($searchString);
    }
    else{
      echo 'no post request ig';
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
</head>

<div id="nav" class="navbar" style="align-items: center;">
    <div class="lnav" style="display: flex;">
        <div class="logo">
          <a href="index.php"><img src="image/TravelLogo_2.jpg" class="logoimg"></a>
        </div><!--END OF LOGO-->
        <div class="buttons">
          <div class="new">
            <button class="btn">New</button>
          </div><!--END OF NEW-->
          <div class="clothing">
            <button onclick="dropDown()" class="btn">Clothing</button>
            <div class="dropdown-content">
              <a href="all_products.php" class="menu">T Shirts</a>
              <a href="all_products.php" class="menu">Hoodies</a>
              <a href="all_products.php" class="menu">Socks</a>
              <a href="all_products.php" class="menu">Shop All</a>
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
</div><!--END OF LNAV-->
<div class="rnav">
            <div class="search">
              <div class="dropdown">
                <a style="text-decoration: none;" href="login.php" onclick="dropDown()"><i class="fa-solid fa-circle-user fa-2xl" style="color:#7C6990;"></i></a>
                <div class="dropdown-content">
                  <a href="#" class="menu">Account</a>
                  <a href="logoff.php" class="menu">Logout</a>
                </div><!--END OF DROPDOWN-CONTENT-->
              </div><!--END OF DROPDOWN-->
                <form action="header.php" method="POST">
                  <input type='search' id='search' placeholder="Search" class="search_input" name="searchString">
                  <a type="submit" class="fas fa-search fa-xs" id="searchbtn" href="header.php?query=<?php echo $searchString ?>"></a>
                </form>
              </div><!--END OF SEARCH-->
</div><!--END OF RNAV-->
          </div>
            


    </div><!--END OF NAV-->