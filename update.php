<?php

  include_once __DIR__ . '\model\product.php';

  include_once __DIR__ . '\model\category.php';

  include_once __DIR__ . '\model\color.php';

  include_once __DIR__ . '\include\functions.php';

  
  // Set up configuration file and create database
  $configFile = __DIR__ . '\model\dbconfig.ini';

  // if (!loggedIn())
  //   {
  //       header ('Location: login.php');
  //   }

  try 
  {
      //$colorData = new Color($configFile);
      //$categoryData = new Category($configFile);
      $productData = new Product($configFile);
  } 
  catch ( Exception $error ) 
  {
      echo "<h2>" . $error->getMessage() . "</h2>";
  }   
   
  // If it is a GET, we are coming from admin_portal.php
  // let's figure out if we're doing update or add
  if (isset($_GET['action'])) 
  {
      $action = filter_input(INPUT_GET, 'action');
      echo $action;
      $product_id = filter_input(INPUT_GET, 'productID', );
       
      
      if ($action == "Update") 
      {
          $row = $productData->getOneProduct($product_id);          
          $product_name = $row['productName'];
          $product_price = $row['productPrice'];
          $product_size = $row['productSize'];
          $category_id = $row['categoryID'];
          $color_id = $row['colorID'];
          $product_quantity = $row['productQuantity'];
          $product_image = $row['productImage'];
          //var_dump($row['product_id']);
      } 
      //else it is Add and the user will enter info
      else 
      {
          $product_name = "";
          $product_price = "";
          $product_size = "";
          $category_id = "";
          $color_id = "";
          $product_quantity = "";
          $product_image = "";
      }
  } // end if GET

  // If it is a POST, we are coming from update.php
  // we need to determine action, then return to admin_portal.php
  elseif (isset($_POST['action'])) 
  {
      $action = filter_input(INPUT_POST, 'action');
      $product_id = filter_input(INPUT_POST, 'productID');
      $product_name = filter_input(INPUT_POST, 'productName');
      $product_price = filter_input(INPUT_POST, 'productPrice');
      $category_id = filter_input(INPUT_POST, 'categoryID');
      $color_id = filter_input(INPUT_POST, 'colorID');
      $product_size = filter_input(INPUT_POST, 'productSize');
      $product_quantity = filter_input(INPUT_POST, 'productQuantity');
      $product_image = filter_input(INPUT_POST, 'productImage');

      if ($action == "Add") 
      {
          $result = $productData->addProduct ($product_name, $product_price, $category_id, $color_id, $product_size, $product_quantity, $product_image);
      } 
      elseif ($action == "Update") 
      {
          $result = $productData->updateProduct ($product_id, $product_name, $product_price, $category_id, $color_id, $product_size, $product_quantity, $product_image);
      }



      // Redirect to admin_portal page
      header('Location: admin_portal.php');
  } // end if POST

  // If it is neither POST nor GET, we go to admin_portal.php
  // This page should not be loaded directly
  else
  {
    header('Location: admin_portal.php');  
  } 
 
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
<div product_id="container">
  <div product_id="nav" class="navbar">
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
<div product_id="pp-main">
    <div class="desc">
        <div class="prod-pg-left">
            <div class="pic">              

              <!-- need to add slashes to the image file when it comes out of the database -->
<!-- $file = addslashes(file_get_contents($_FILES["productImage"]["tmp_name"]));  
$stmt = "INSERT INTO product_lookup (productImage) VALUES ('$file') WHERE productID = :productID";
<script>  
 $(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }   
           }  
      });  
 });  
 </script> -->
 <form action="update.php" method="post">
  <h2 class="form-group"><input class="form-control" placeholder="Image" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value=<?php echo $product_image; ?>></h2>
    <!-- <p><input type="file"  folder="image/*" name="image" product_id="file"  onchange="loadFile(event)" style="display: none;"></p>
    <p><label for="file" style="cursor: pointer;">Upload Image</label></p> -->

    <!-- <script>
    var loadFile = function(event) {
	  var image = document.getElementById('output');
	  image.src = URL.createObjectURL(event.target.files[0]);
    };
    </script> -->
      

              
            </div><!--END OF PIC-->
        </div><!--END OF PROD-PG-LEFT-->
        <div class="form-group">
      <label class="control-label col-sm-2" for="productID">ID:</label>
      <div class="col-sm-10">
        <input type=" " value="<?= $product_id; ?>">
        </div>
        <div class="form-group">
            <div class="text">
              <h2 class="form-group"><input class="form-control" placeholder="Title" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value=<?php echo $product_name; ?>></h2>
              
              <h3 class="form-group">$<input class="form-control" placeholder="Price" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value=<?php echo $product_price; ?>></h3>

              <!-- <h3 class="prod-price"><input placeholder="Category" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value=<?php echo $category_id; ?>></h3> -->
                <!-- <div class="colorpick"> -->

                  <!-- <h2 class="prod-color"><input placeholder="Color" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value=<?php echo $color_id; ?>></h2> -->
                    <p class="form-group">Choose A Color</p>
                    <label class="form-control">pink
                        <input type="radio" name="rdo_color">
                        <span class="checkmark"></span>
                    </label>
                    <label class="form-control">grey
                      <input type="radio" name="rdo_color">
                      <span class="checkmark"></span>
                  </label>
                  <label class="form-control">blue
                    <input type="radio" name="rdo_color">
                    <span class="checkmark"></span>
                </label>
                     <i class="fas fa-circle fa-lg" style="color: hotpink;"></i>
                    <i class="fas fa-circle fa-lg" style="color: grey;"></i>
                    <i class="fas fa-circle fa-lg" style="color: black;"></i>
                <div class="dropdown">
                    <button onclick="dropDown()">Choose Color</button>
                       <!-- <button onclick="dropDown()" class="btn">Accessories</button> -->
                    <div class="form-group">
                      <a href="#" class="menu">White</a>
                      <a href="#" class="menu">Grey</a>
                      <a href="#" class="menu">Black</a>
                      <a href="#" class="menu" value=<?php echo $color_id;?>></a>
                    </div><!--END OF DROPDOWN-CONTENT -->

                </div><!--END OF COLORPICK-->

                <div class="form-group">
                    <h3 class="prod-size"><input class="form-control" type="text" placeholder="Size" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value=<?php echo $product_size; ?>></h3>
                </div><!--END OF SIZEPICK-->
                <div>
                  <h3 class="form-group"><input class="form-control" type="number" placeholder="Quantity" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value=<?php echo $product_quantity; ?>></h3>
                
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-default"><?php echo $action; ?> Product</button>
                  <input type="hidden" name="action" value="<?php $action;?>">
  
                </div><!--END OF ADDBTN-->
            </div><!--END OF TEXT-->
        </div><!--END OF PROD-PG-RIGHT-->
    </div><!--END OF DESC-->
</div><!--END OF MAIN-->
</form>
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