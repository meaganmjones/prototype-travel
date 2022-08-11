<?php

    include_once __DIR__ . '\model\product.php';
    include_once __DIR__ . '\model\category.php';
    include_once __DIR__ . '\model\color.php';
    include_once __DIR__ . '\include\functions.php';
    //include_once __DIR__ . '\include\login.php';

    // if (!loggedIn())
    // {
    //     header ('Location: login.php');
    // }

    include_once __DIR__ . '\model\search.php';
    // Set up configuration file and create database
    $configFile = __DIR__ . '\model\dbconfig.ini';

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
    <div>
        <a href="index.html"><image src="image/TravelLogo_2.jpg" class="top-img"></a>
    </br>
    <table class="inv_tbl">
        <tr>
            <th class="col_head">ID</th>
            <th class="col_head">Product Name</th>
            <th class="col_head">Category</th>
            <th class="col_head">Color</th>
            <th class="col_head">Size</th>
            <th class="col_head">Quantity</th>
            <th class="col_head">Update</th>
            <th class="col_head">Delete</th>
        </tr>
        <?php foreach ($productList as $row): ?>
            <tr>
                <td>
                    <form action="admin_portal.php" method="post">
                                             
                </td>
                <td class="col-data"><?php echo $row['productID']; ?></td>
                <td class="col-data"><?php echo $row['productName']; ?></td>
                <td class="col-data"><?php echo $row['categoryID']; ?></td>
                <td class="col-data"><?php echo $row['colorID'];?></td>
                <td class="col-data"><?php echo $row['productSize']; ?></td>
                <td class="col-data"><?php echo $row['productQuantity']; ?></td>
                <td class="col-data"><?php echo $row['productImage']; ?></td>
                <td><a href="update.php?action=Update&productID=<?= $row['productID'] ?>" style="color: red;">Edit</a></td> 
                <td class="col_data"><a href="#"  style="color: red;">Delete</a></td>
                </form> 
                <!--Removed links-->
                
                
            </tr>
        <?php endforeach; ?>
        <tr>
            <td class="col_data">this</td>
            <td class="col_data">is</td>
            <td class="col_data">all</td>
            <td class="col_data">placeholder</td>
            <td class="col_data">data</td>
            <td class="col_data">no</td>
            <td class="col_data"><a href="update.php" style="color: red;">Edit</a></td>
            <td class="col_data"><a href="#" style="color: red;">Delete</a></td>
        </tr>
    </table>


    </div>
    </div><!--END OF INVENTORY-->
</body>
</html>
