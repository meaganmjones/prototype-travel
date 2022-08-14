<?php

    include_once __DIR__ . '/model/product.php';
    include_once __DIR__ . '/include/functions.php';

    // Set up configuration file and create database
    $configFile = __DIR__ . '/model/dbconfig.ini';

    // if (!loggedIn())
    // {
    //     header ('Location: login.php');
    // }

    try 
    {
        $productDatabase = new Product($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   
    // If POST, delete the requested car before listing all
    if (postRequest()) {
        $product_id = filter_input(INPUT_POST, 'productID');
        $productDatabase->deleteProduct($product_id);

    }
    $productList = $productDatabase->getProduct();
    
?>

<!--Creating a table for the products to be displayed in-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/3ed3e280c1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css.css">
    <title>Inventory</title>
</head>
<body>
    <div id="inventory">
        <div class="inv-btn">
            <a href="update.php?action=Add"><button class="btn" >Add Product</button></a>
            <a href="index.php"><button class="btn" >Site Home</button></a>
        </div><!--END OF INV-BTN-->
    </br>
    
        <a href="index.html"><image src="image/TravelLogo_2.jpg" class="top-img"></a>
    </br>
    <table class="inv_tbl">
    <thead>
        <tr>
            <th class="col_head">ID</th>
            <th class="col_head">Product Name</th>
            <th class="col_head">Category</th>
            <th class="col_head">Color</th>
            <th class="col_head">Size</th>
            <th class="col_head">Quantity</th>
            <th class="col_head"></th>
        </tr>
    </thead>
        <?php foreach ($productList as $row): ?>

        <tr>
            <td> 
                <form action="admin_portal.php" method="post">
            </td>                       
            <td class="col-data" style="contents: hidden;"><?php echo $row['productID']; ?></td>
            <td class="col-data"><a href="update.php?action=Update&productID=<?php echo $row['productID']; ?>" style="color: blue;"><?php echo $row['productName']; ?></a></td>
            <td class="col-data"><?php echo $row['categoryID']; ?></td>
            <td class="col-data"><?php echo $row['colorID'];?></td>
            <td class="col-data"><?php echo $row['productSize']; ?></td>
            <td class="col-data"><?php echo $row['productQuantity']; ?></td>
            <td class="col_data"><i class="fa-solid fa-trash-can"></i></td>
        </form><!--end post form-->   
                
        </tr>  
        <?php endforeach; ?>
    </table>


    
    </div><!--END OF INVENTORY-->
</body>
</html>