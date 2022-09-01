<?php

  include_once __DIR__ . '\model\product.php';

  include_once __DIR__ . '\model\category.php';

  include_once __DIR__ . '\model\color.php';

  include_once __DIR__ . '\include\functions.php';
  
  include_once 'header.php';

  // Set up configuration file and create database
  $configFile = __DIR__ . '\model\dbconfig.ini';

  // if (!loggedIn())
  //   {
  //       header ('Location: login.php');
  //   }

  try 
  {
      $categoryData = new Category($configFile);
      $productData = new Product($configFile);
      $colorData = new Color($configFile);
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
          $category_id = "";
          $color_id = "";
          $product_size = "";
          $product_quantity = "";
          $product_image = "";
      }
    } // end if GET

  }

// Check if image file is a actual image or fake image

  

  // If it is a POST, we are coming from update.php
  // we need to determine action, then return to admin_portal.php
  elseif (postRequest()){

    if (isset($_POST['action'])) 
    {

      echo "made it";

      define("UPLOAD_DIRECTORY", "upload");
      
      if(isset($_FILES['fileToUpload']))
      {
        var_dump($_FILES);

        $path = getcwd() . DIRECTORY_SEPARATOR . UPLOAD_DIRECTORY;

        $tmpName = $_FILES['fileToUpload']['tmp_name'];

        $targetFileName = $path . DIRECTORY_SEPARATOR . $_FILES['fileToUpload']['name'];

        move_uploaded_file($tmpName, $targetFileName);

        echo "made it 2";
      }

      //echo("made it");
      $action = filter_input(INPUT_POST, 'action');
      //echo $action;
      $product_id = filter_input(INPUT_POST, 'productID');
      $product_name = filter_input(INPUT_POST, 'productName');
      $product_price = filter_input(INPUT_POST, 'productPrice');
      $category_id = filter_input(INPUT_POST, 'category');
      $color_hex = filter_input(INPUT_POST, 'color');
      $color_desc = filter_input(INPUT_POST, 'colorDesc');
      $product_size = filter_input(INPUT_POST, 'size');
      $product_quantity = filter_input(INPUT_POST, 'productQuantity');
      $product_image = filter_input(INPUT_POST, 'productImage');

      
      //echo("made it 2");

      //echo $color_id;

    //   if($category_id == "shirt"){
    //     $$category_id = 1;
    // }
    // elseif($category_id == "hoodie"){
    //     $$category_id = 2;
    // }
    // elseif($category_id == "socks"){
    //   $category_id = 3;
    // }
    // elseif($category_id == "bag"){
    //     $category_id = 4;
    // }
    // elseif($category_id == "hat"){
    //     $category_id = 5;
    // }
    // elseif($category_id == "sticker"){
    //   $category_id = 7;
    // }
    // else{
    //     $category_id = 8;
    // }

      if ($action == "Add") 
      {
        $color = $colorData->getAllColor();
        //var_dump($color);
        //echo $color[0]['colorDesc'];

        
    
        foreach($color as $colorRow):
          if($colorRow['colorHex'] == $color_hex){
            $color_id = $colorRow['colorID'];
          }
        endforeach;  
          $addColor = $colorData->addColor($color_hex, $color_desc);
          $oneColor = $colorData->getOneColor($color_hex);
          $color_id = $oneColor['colorID'];
          $result = $productData->addProduct($product_name, $product_price, $category_id, $color_id, $product_size, $product_quantity, $product_image);
        }
        else{
          $oneColor = $colorData->getOneColor($color_hex);
          $color_id = $oneColor['colorID'];
          $result = $productData->addProduct($product_name, $product_price, $category_id, $color_id, $product_size, $product_quantity, $product_image);
        }

      } 
      elseif ($action == "Update") 
      {

        
          
        $result = $productData->updateProduct($product_id, $product_name, $product_price, $category_id, $color_id, $product_size, $product_quantity, $product_image);
        
      }
      
      // Redirect to admin_portal page
      //header('Location: admin_portal.php');
      
    } // end if POST

  
  

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
 <form action="Update.php" method="post">


    <script>
      var loadFile = function(event) {
	      var image = document.getElementById('output');
	      image.src = URL.createObjectURL(event.target.files[0]);
      };
      
    </script>

    <p><input type="file" name="fileToUpload" id="file" enctype="multipart/form-data" onchange="loadFile(event)" style="display: none;"></p>
    <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
    <p style="color: grey;"><img id="output" width="200" /></p>

              <img src="<?php echo $product_image; ?>" class="prod-pic" alt="<?php echo $product_name?>">              
            </div><!--END OF PIC-->
        </div><!--END OF PROD-PG-LEFT-->
        <div class="prod-pg-right">
            <div class="text">
              <input name="productID" value="<?php echo $product_id; ?>">
              <h2 class="prod-title"><input placeholder="Title" name="productName" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value="<?php echo $product_name; ?>"></h2>
              
              <h3 class="prod-price"><input placeholder="Price" name="productPrice" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value="<?php echo $product_price; ?>"></h3>
              <h2><input placeholder="Quantity" name="productQuantity" style="font-size: 20px; font-family: 'Courier New', Courier, monospace;" value="<?php echo $product_quantity; ?>"> </h2>
              
              <div class='category'>
              <span>Choose a Cateogry</span>
                    <input type='checkbox' class="category" name="category" value=1>Shirt
                    <input type='checkbox' class="category" name="category" value=2>Hoodie
                    <input type='checkbox' class="category" name="category" value=3>Socks
                    <input type='checkbox' class="category" name="category" value=4>Misc
              </div>

              <div class="colorpick">
                <input type='color' name='color'><span>Click here to select color</span>
  </br>
  </br>
                <input type='text' name='colorDesc'><span>Color Description</span>
                  <!--<p>Color: <?php //echo $color['colorDesc']; ?></p>-->
                <!-- <div class="dropdown">
                    <button onclick="dropDown()">Choose Color</button>
                    <div class="dropdown-content">
                    <?php //foreach($colorList as $colorRow):
                        //$colorDesc = $colorRow['colorDesc']; ?>
                        <a class="menu" ><?php //echo $colorDesc; ?></a>
                    <?php   
                       // endforeach;  
                    ?> 
                    </div>END OF DROPDOWN-CONTENT -->
                    
                </div><!--END OF COLORPICK-->
                    </br>
                <span>Select Size</span>
                <div class="sizepick">
                    <input type='checkbox' value='XS' class="size" name="size">XS
                    <input type='checkbox' value='S' class="size" name="size">S
                    <input type='checkbox' value='M' class="size" name="size">M
                    <input type='checkbox' value='L' class="size" name="size">L
                    <input type='checkbox' value='XL' class="size" name="size">XL
                </div><!--END OF SIZEPICK-->
                <div class="addbtn">
                    <button type="submit"><?php echo $action; ?></button>
  
                </div><!--END OF ADDBTN-->
            </div><!--END OF TEXT-->
        </div><!--END OF PROD-PG-RIGHT-->
    </div><!--END OF DESC-->
</div><!--END OF MAIN-->
</form><!--END OF FORM-->

<?php
include_once 'footer.php';
?>
</div><!--END OF CONTAINER-->
</body>
</html>