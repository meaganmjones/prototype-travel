<?php

    include_once __DIR__ . '/model/product.php';
    include_once __DIR__ . '/model/color.php';
    include_once __DIR__ . '/include/functions.php';

    // Set up configuration file and create database
    $configFile = __DIR__ . '/model/dbconfig.ini';

    if (!isLoggedIn())
    {
        header ('Location: login.php');
    }

    try 
    {
        $productDatabase = new Product($configFile);
        $colorDatabase = new Color($configFile);
    } 
    catch ( Exception $error ) 
    {
        echo "<h2>" . $error->getMessage() . "</h2>";
    }   
    // If POST, delete the requested car before listing all
    if(postRequest()){
        if(isset($_POST['delete'])){
            $product_id = filter_input(INPUT_POST, 'productID');
            
            $productDatabase->deleteProduct($product_id);

            $productDatabase->getProduct();
            
        }
    }else{
        $productList = $productDatabase->getProduct();
        //echo "No Post Request";
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
                      
                <td class="col-data"><a href="update.php?action=Update&productID=<?php echo $row['productID']; ?>" style="color: blue;"><?php echo $row['productName']; ?></a></td>
                <td class="col-data"><?php     
            if($row['categoryID'] == 1){
                $category_desc = "shirt";
            }
            elseif($row['categoryID'] == 2){
                $category_desc = "hoodie";
            }
            elseif($row['categoryID'] == 3){
                $category_desc = "socks";
            }
            elseif($row['categoryID'] == 4){
                $category_desc = "bag";
            }
            elseif($row['categoryID'] == 5){
                $category_desc = "hat";
            }
            elseif($row['categoryID'] == 6){
                $category_desc = "sticker";
            }
            else{
                $category_desc = "";
            }
            echo $category_desc; ?></td>
            <td class="col-data"><?php     
                $colorList = $colorDatabase->getColor($row['colorID']);
                foreach($colorList as $colorRow):
                    $colorDesc = $colorRow['colorDesc'];
                    echo $colorDesc;
                endforeach;    
                ?></td>
            <td class="col-data"><?php echo $row['productSize']; ?></td>
            <td class="col-data"><?php echo $row['productQuantity']; ?></td>
            <td class="col_data">
                <form action="admin_portal.php" method="post">
                    <input type="hidden" name="productID" value="<?php echo $row['productID']; ?>">
                    <button class="fa-solid fa-trash-can" type="submit" name="delete"></button>
                    </form><!--end post form-->   
            </td>
        </tr>  
        <?php endforeach; ?>
    </table>


    
    </div><!--END OF INVENTORY-->
</body>
</html>