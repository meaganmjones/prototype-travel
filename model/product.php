<?php

    
//provides a wrapper to the database
class Product
{

    //might nedd seperate classes for category and color but unsure

    private $productData;

    public function __construct($configFile){

        if ($ini = parse_ini_file($configFile)){
            
            $productPDO = new PDO ("mysql:host=" .$ini['servername'] . ";port=" .$ini['port'] . ";dbname=" . $ini['dbname'], $ini['username'], $ini['password']);

            //dont emulate prepare statements
            $productPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            //throw exceptions if there is a database error
            $productPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //set our database to be newly created PDO
            $this->productData = $productPDO;
        }
        else{
            //things didnt go well, trow exception
            throw new Exception("<h2>Creation of database object failed!</h2>", 0, null);
        }
    }//end constructor

    
    // Get listing from the database
    public function getProduct() {
        $results = [];
        $productTable = $this->productData;

        $stmt = $productTable->prepare("SELECT productID, productName, productPrice, categoryID, colorID, productSize, productQuantity, productImage FROM product_lookup ORDER BY productID");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
        {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
        }
         
         return ($results);
    }

    //Add to database
    public function addProduct ($product_name, $product_price, $category_id, $color_id, $product_size, $product_quantity, $product_image)
    {
        $addSuccessful = false;
        $productTable = $this->productData;
        

        $stmt = $productTable->prepare("INSERT INTO product_lookup SET product_name = :productName, product_price =: productPrice, category_id = :categoryID, color_id = :colorID, product_size= :productSize, product_quantity = :productQuantity, product_image = :productImage");
        
        

        $boundProduct = array(
            ":ProductName" => $product_name,
            ":productPrice" => $product_price,
            ":categoryID" => $category_id,
            ":colorID" => $color_id,
            ":productSize" => $product_size,
            ":productQuantity" => $product_quantity,
            ":productImage" => $product_image
        );
        
        $addSuccessful = ($stmt->execute($boundProduct) && $stmt->rowCount() > 0);
        
        return $addSuccessful;
    }
  


//update table into the database
    public function updateProduct ($product_id, $product_name, $product_price, $category_id, $color_id, $product_size, $product_quantity, $product_image)
    {
        $updateSuccessful = false;
        $productTable = $this->productData;
        
        $stmt = $productTable->prepare("UPDATE product_lookup SET productName = :productName, productPrice = :productPrice, categoryID = categoryID, colorID = :colorID, productSize = :productSize, productQuantity = :productQuantity, productImage = :productImage WHERE productID = :productID");

        $stmt->bindValue(':productID', $product_id);
        $stmt->bindValue(':productName', $product_name);
        $stmt->bindvalue(':productPrice', $product_price);
        $stmt->bindvalue(':categoryID', $category_id);
        $stmt->bindvalue(':colorID', $color_id);
        $stmt->bindValue(':productSize', $product_size);
        $stmt->bindValue(':productQuantity', $product_quantity);
        $stmt->bindValue(':productImage', $product_image);

        $updateSuccessful = ($stmt->execute() && $stmt->rowCount() > 0);

        return $updateSuccessful;

    }

//Delete from the database
    public function deleteProduct ($product_id)
    {
        $deleteSuccessful = false;
        $productTable = $this->productData;

        $stmt = $productTable->prepare("DELETE FROM product_lookup WHERE productID = :productID");

        $stmt->bindValue(':productID', $product_id);

        $deleteSuccessful = ($stmt->execute() && $stmt->rowCount() > 0);

        return $deleteSuccessful;
    }


//Get listing from the database
    public function getOneProduct ($product_id)
    {
        $results = [];
        $productTable = $this->productData;

        $stmt = $productTable->prepare("SELECT productID, productName, productPrice, categoryID, colorID, productSize, productQuantity, productImage FROM product_lookup WHERE productID = :productID");

        $stmt->bindValue(':productID', $product_id);

        if ($stmt->execute() && $stmt->rowCount() > 0)
        {
            
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $results;
    }

    //special function accessible to derived classes
    //allows children to make queries to the database
    protected function getDatabaseRef()
    {
        return $this->productData;
    }


}//end product class
?>

