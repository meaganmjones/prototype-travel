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
  
                  <input type="text" placeholder="Search" class="search_input">
                  <i class="fas fa-search fa-xs"></i>
              </div><!--END OF SEARCH-->
</div><!--END OF RNAV-->
          </div>
            


    </div><!--END OF NAV-->