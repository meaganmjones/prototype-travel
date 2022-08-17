<?php

include_once __DIR__ . '\model\product.php';

  include_once __DIR__ . '\model\category.php';

  include_once __DIR__ . '\model\color.php';

  include_once __DIR__ . '\include\functions.php';
  
  include_once __DIR__ . '\header.php';

  // Set up configuration file and create database
  $configFile = __DIR__ . '\model\dbconfig.ini';

  // if (!loggedIn())
  //   {
  //       header ('Location: login.php');
  //   }

  try 
  {
      //$categoryData = new Category($configFile);
      $productData = new Product($configFile);
      //$colorData = new Color($configFile);
  } 
  catch ( Exception $error ) 
  {
      echo "<h2>" . $error->getMessage() . "</h2>";
  }   
   
  // If it is a GET, we are coming from admin_portal.php
  // update or add
  if (getRequest()){

    if (isset($_GET['action'])) 
    {
      $action = filter_input(INPUT_GET, 'action');
      //echo $action;
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

          //$color = $colorData->getColor($color_id);
          //var_dump($color[2]);
      } 
      //else it is Add and the user will enter info
      else 
      {
          $product_name = "";
          $product_price = "";
          $product_size = "";
          $product_quantity = "";
          $product_image = "";
      }
    } // end if GET

  }
  

  // If it is a POST, we are coming from update.php
  // we need to determine action, then return to admin_portal.php
  elseif (postRequest()){

    if (isset($_POST['action'])) 
    {

      echo("made it");
      $action = filter_input(INPUT_POST, 'action');
      //echo $action;
      $product_id = filter_input(INPUT_POST, 'productID');
      $product_name = filter_input(INPUT_POST, 'productName');
      $product_price = filter_input(INPUT_POST, 'productPrice');
      //$category_id = filter_input(INPUT_POST, 'categoryID');
      $category_id = 1;
      //$color_id = filter_input(INPUT_POST, 'colorID');
      $color_id = 1;
      //$product_size = filter_input(INPUT_POST, 'productSize');
      $product_size = "L";
      $product_quantity = filter_input(INPUT_POST, 'productQuantity');
      $product_image = filter_input(INPUT_POST, 'productImage');

      echo("made it 2");

      if ($action == "Add") 
      {
        echo("made it 4");
        $result = $productData->addProduct($product_name, $product_size, $category_id, $color_id, $product_price, $product_quantity, $product_image);
      } 
      elseif ($action == "Update") 
      {
        echo("made it 3");   
        $result = $productData->updateProduct($product_id, $product_name, $product_price, $category_id, $color_id, $product_size, $product_quantity, $product_image);
        var_dump($result);
      }
      
      // Redirect to admin_portal page
      header('Location: admin_portal.php');
      
    } // end if POST

  }
  

  // If it is neither POST nor GET, we go to admin_portal.php
  // This page should not be loaded directly
  else
  {
    //echo ("skipped if's");
    //var_dump($results);
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
<div id="container">

<div id="pp-main">
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
 <form action="Update.php" method="post">

    <p><input type="file"  accept="image/*" name="productImage" id="file"  onchange="loadFile(event)" style="display: none;"></p>
    <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
    <p style="color: grey;"><img id="output" width="200" /></p>

    <script>
    var loadFile = function(event) {
	  var image = document.getElementById('output');
	  image.src = URL.createObjectURL(event.target.files[0]);
    };
    </script>

              <img src="<?php echo $product_image; ?>" class="prod-pic" alt="<?php echo $product_name?>">              
            </div><!--END OF PIC-->
        </div><!--END OF PROD-PG-LEFT-->
        <div class="prod-pg-right">
            <div class="text">
              <input name="action" value="<?php echo $action; ?>">
              <input name="productID" value="<?php echo $product_id; ?>">
              <h2 class="prod-title"><input placeholder="Title" name="productName" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value="<?php echo $product_name; ?>"></h2>
              
              <h3 class="prod-price"><input placeholder="Price" name="productPrice" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value="<?php echo $product_price; ?>"></h3>
              <h2><input placeholder="Quantity" name="productQuantity" style="font-size: 20px; font-family: 'Courier New', Courier, monospace;" value="<?php echo $product_quantity; ?>"> </h2>
              
              <div class="colorpick">
                  <!--<p>Color: <?php //echo $color['colorDesc']; ?></p>-->
                <div class="dropdown">
                    <button onclick="dropDown()">Choose Color</button>
                    <div class="dropdown-content">

                      <a href="#" class="menu">White</a>
                      <a href="#" class="menu">Grey</a>
                      <a href="#" class="menu">Black</a>
                      <a href="#" class="menu" value=<?php //echo $color_id;?>></a>
                    </div><!--END OF DROPDOWN-CONTENT-->

                </div><!--END OF COLORPICK-->

                <div class="sizepick">
                    <button class="size">XS</button>
                    <button class="size">S</button>
                    <button class="size">M</button>
                    <button class="size">L</button>
                    <button class="size">XL</button>
                </div><!--END OF SIZEPICK-->
                <div class="addbtn">
                    <button type="submit"><?php echo $action; ?></button>
  </form><!--END OF FORM-->
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