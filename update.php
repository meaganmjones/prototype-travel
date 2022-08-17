<?php

  include_once __DIR__ . '\model\product.php';

  include_once __DIR__ . '\model\category.php';

  include_once __DIR__ . '\model\color.php';

  include_once __DIR__ . '\include\functions.php';
  
  include_once __DIR__ . '\include\header.php';

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
          $category_id = "";
          $color_id = "";
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
      $category_id = filter_input(INPUT_POST, 'categoryID');
      $color_id = filter_input(INPUT_POST, 'colorID');
      $product_size = filter_input(INPUT_POST, 'productSize');
      $product_quantity = filter_input(INPUT_POST, 'productQuantity');
      $product_image = filter_input(INPUT_POST, 'productImage');
      echo("made it 2");

      if ($action == "Add") 
      {
        echo("made it 4");
        $result = $productData->addProduct($product_name, $product_price, $category_id, $color_id, $product_size, $product_quantity, $product_image);
      } 
      elseif ($action == "Update") 
      {
          
        $result = $productData->updateProduct($product_id, $product_name, $product_price, $category_id, $color_id, $product_size, $product_quantity, $product_image);
        
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

<div id="pp-main">
    <div class="desc">
        <div class="prod-pg-left">
            <div class="pic">              

              <div class="container">
                <form action="update.php" class="form-horizantal" method="POST">
                  <div class="form-group">
                    <p><label for="productImage" style="cursor: pointer;">Upload Image</label></p>
                    <p><input type="file"  accept="image/*" name="productImage" id="productImage"  onchange="loadFile(event)" style="display: none;"></p>
                    <p style="color: grey;"><img id="output" width="200" /></p>

                    <script>
                        var loadFile = function(event) {
	                          var image = document.getElementById('output');
	                          image.src = URL.createObjectURL(event.target.files[0]);
                          };
                      </script>
             
                      <img src="<?php echo $product_image?>" name="productImage" id="productImage" class="prod-pic form-control" alt="<?php echo $product_name?>">              
              </div><!--END OF PIC-->
          </div><!--END OF PROD-PG-LEFT-->
        <div class="prod-pg-right">

          <div class="text">
            <div class="form-group">

              <p><label for="productID">ID:</label></p>
              <h2 class="prod-id"  ><input name="productID" id="productID" class="form-control" value=<?php echo $product_id?>></h2>
            </div>
              <!-- <h2 class="action"><input value=<?php echo $action?>></h2> -->

            <div class="form-group">
              <p><label for="productName">Name</label></p>
              <h2 class="prod-title"><input placeholder="Title" type="text" class="form-control" name="productName" id="productName" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value=<?php echo $product_name; ?>></h2>
            </div>

            <div class="form-group">
              <p><label for="productPrice">Price</label></p>
              <h3 class="prod-price">$<input placeholder="Price" class="form-control" name="productPrice" id="productPrice"  style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value=<?php echo $product_price; ?>></h3>
            </div>

            <div class="form-group">
              <p><label for="productSize">Size</label></p>
              <h3 class="prod-size"><input placeholder="Size" name="productSize" class="form-control" id="productSize" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value=<?php echo $product_size; ?>></h3>
            </div><!--END OF FORM GROUP-->

            <div class="form-group">
              <p><label for="productQuantity">Quantity</label></p>
              <h3 class="prod-quantity"><input placeholder="Quantity" class="form-control" name="productQuantity" id="productQuantity" style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value=<?php echo $product_quantity; ?>></h3>
            </div><!--END OF FORM GROUP-->

            <div class="form-group">
              <p><label for="categoryID">Category</label></p>
              <h3 class="prod-price"><input placeholder="Category" class="form-control" name="categoryID" id="categoryID"  style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value=<?php echo $category_id; ?>></h3>
            </div>

            <div class="form-group">
              <p><label for="colorID">Color</label></p>
              <h3 class="prod-price"><input placeholder="Color" class="form-control" name="colorID" id="colorID"  style="font-size: 26px; font-family: 'Courier New', Courier, monospace;" value=<?php echo $color_id; ?>></h3>
            </div>

                <!-- <div class="colorpick">
                  <p>Color: <?php //echo $color['colorDesc']; ?></p>
                <div class="dropdown">
                    <button onclick="dropDown()">Choose Color</button>
                    <div class="dropdown-content">

                      <a href="#" class="menu">White</a>
                      <a href="#" class="menu">Grey</a>
                      <a href="#" class="menu">Black</a>
                      <a href="#" class="menu" name="colorID" id="colorID" value=<?php echo $color_id;?>></a>
                    </div>END OF DROPDOWN-CONTENT -->

                <!-- </div>END OF COLORPICK -->

                <!-- <div class="sizepick">
                    <button class="size">XS</button>
                    <button class="size">S</button>
                    <button class="size">M</button>
                    <button class="size">L</button>
                    <button class="size">XL</button> -->
                <!-- </div>END OF SIZEPICK -->
                <div class="form-group">
                  <div class="addbtn">
                    <button type="submit" class="btn btn-default"><?php echo $action; ?></button>
                    <input type="hidden" class="form-control" name="action" value="<?php echo $action; ?>">
                    
                </form><!--END OF FORM-->
                  </div><!--END OF ADDBTN-->
                </div><!--END of FORM GROUP-->
          </div><!--END OF TEXT-->
        </div><!--END OF PROD-PG-RIGHT-->
    </div><!--END OF DESC-->
</div><!--END OF MAIN-->

</div><!--END OF CONTAINER-->
</body>
</html>
<?php include_once __DIR__ . '\include\footer.php';?>