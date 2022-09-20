<?php 

include_once __DIR__ . '\model\product.php';

include_once __DIR__ . '\model\category.php';

include_once __DIR__ . '\model\color.php';

include_once __DIR__ . '\include\functions.php';

include_once 'header.php';

// Set up configuration file and create database
$configFile = __DIR__ . '\model\dbconfig.ini';

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
// let's figure out if we're doing update or add
if (isset($_GET['action'])) 
{
    $action = filter_input(INPUT_GET, 'action');
    //echo $action;
    $product_id = filter_input(INPUT_GET, 'productID', );
     
    //echo $product_id;

      $row = $productData->getOneProduct($product_id);          
      $product_name = $row['productName'];
      $product_price = $row['productPrice'];
      $product_size = $row['productSize'];
      $category_id = $row['categoryID'];
      $color_id = $row['colorID'];
      $product_quantity = $row['productQuantity'];
      $product_image = $row['productImage'];

      $path = "upload/";
      $color = $colorData->getColor($color_id);
      $color_hex = $color['colorHex'];
    //else it is Add and the user will enter info
} // end if GET
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
    <script src="sweetalert2.all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Travel</title>
</head>
<body>
<div id="container">
<div id="pp-main">
    <div class="desc">
        <div class="prod-pg-left">
            <div class="pic">
                <img src="<?php echo $path.$product_image; ?>" class="prod-pic">
            </div><!--END OF PIC-->
        </div><!--END OF PROD-PG-LEFT-->
        <div class="prod-pg-right">
            <div class="text">
                <h2 class="prod-title"><?php echo $product_name; ?></h2>
                <h3 class="prod-price"><?php echo "$".$product_price; ?></h3>
                <div class="colorpick">
                    <p class="pick">Choose A Color</p>
                    <button class="fas fa-circle fa-lg" style="color: <?php echo $color_hex?>"></button>
                    <i class="fas fa-circle fa-lg" style="color: "></i>
                    <i class="fas fa-circle fa-lg" style="color: "></i>
                </div><!--END OF COLORPICK-->
                <div class="sizepick">
                    <button class="size">XS</button>
                    <button class="size">S</button>
                    <button class="size">M</button>
                    <button class="size">L</button>
                    <button class="size">XL</button>
                </div><!--END OF SIZEPICK-->
                <div class="addbtn">
                    <script>
                    function addToCart(){
                        Swal.fire('Successfully Added to Cart')
                    };
                    </script>
                <button onclick="addToCart()">Add To Cart</button>


                    
                    
                </div><!--END OF ADDBTN-->
            </div><!--END OF TEXT-->
        </div><!--END OF PROD-PG-RIGHT-->
    </div><!--END OF DESC-->
</div><!--END OF MAIN-->
</div><!--END OF CONTAINER-->

</body>
<?php
include_once 'footer.php';
?>
</html>