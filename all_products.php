<?php

  include_once __DIR__ . '\model\product.php';

  include_once __DIR__ . '\model\category.php';

  include_once __DIR__ . '\model\color.php';

  include_once __DIR__ . '\include\functions.php';

  //include_once __DIR__ . '\model\search.php';

  include_once 'header.php';
  
  // Set up configuration file and create database
  $configFile = __DIR__ . '\model\dbconfig.ini';

  try 
  {
      $productData = new Product($configFile);

      //$searchData = new ProductSearch($configFile);
  } 
  catch ( Exception $error ) 
  {
      echo "<h2>" . $error->getMessage() . "</h2>";
  }  
  
  $path = "upload/";

//if(getRequest()){
    if(isset ($_GET['query'])){
        $query = filter_input(INPUT_GET, 'query');

        if($query == ''){
          
          $productList = $productData->getProduct();
          
        }
        else{

          $productList = $productData->searchProducts($query);
          //var_dump($productList);
          
        }
    }
//}
   
//elseif((postRequest())){
  if(isset($_POST)) 
  {

    $productList = $productData->getProduct();

    $path = "upload/";


  }
//}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jss.js"></script>
    <script src="https://kit.fontawesome.com/3ed3e280c1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css.css">
    <title>Products | Travel</title>
</head>
<body>
    <div id="main">
        <div class="hero">
            
        </div><!--END OF HERO-->

        <div class="prodTitle">
            <h1>All Products</h1>
        </div><!--END OF PRODTITLE-->
        <div class="prod">
            <?php foreach ($productList as $row): ?>
            <a href="singleprod.php?action=view&productID=<?php echo $row['productID'] ?>">
            <div class="prodResult">
            <div class="prodimg">
                <img src="<?php echo $path.$row['productImage']; ?>" >
            </div><!--END OF PRODIMG-->
                <p style="color: black;"><?php echo $row['productName']; ?></p>
                <p style="color: black;"><?php echo '$'.$row['productPrice']; ?></p>
            </div><!--END OF PRODRESULT-->
            </a>
            <?php endforeach ?>
        </div><!--END OF PROD-->
    </div><!--END OF MAIN-->
    </div><!--END OF CONTAINER-->
</body>
</html>
<?php
include_once 'footer.php';
?>