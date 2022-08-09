<?php

    include_once __DIR__ . '/model/product.php';
    include_once __DIR__ . '/include/functions.php';

    // Set up configuration file and create database
    $configFile = __DIR__ . '/model/dbconfig.ini';

    if (!loggedIn())
    {
        header ('Location: login.php');
    }

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
            <a href="update.html"><button class="btn" >Add Product</button></a>
            <a href="index.html"><button class="btn" >Site Home</button></a>
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
            <th class="col_head">Image</th>
            <th class="col_head">Update</th>
            <th class="col_head">Delete</th>
        </tr>

        <tr>
            <td class="col_data">this</td>
            <td class="col_data">is</td>
            <td class="col_data">all</td>
            <td class="col_data">placeholder</td>
            <td class="col_data">data</td>
            <td class="col_data">no</td>
            <td class="col_data">value</td>
            <td class="col_data"><a href="update.html" style="color: red;">Edit</a></td>
            <td class="col_data"><a href="#" style="color: red;">Delete</a></td>
        </tr>
    </table>


    </div>
    </div><!--END OF INVENTORY-->
</body>
</html>