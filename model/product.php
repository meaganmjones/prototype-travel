<?php

//provides a wrapper to the database
class Product{

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
    public function addProduct ($product_name, $product_size, $product_price, $product_quantity, $product_image) {
        $addSuccessful = false;
        $productTable = $this->productData;
        

        $stmt = $productTable->prepare("INSERT INTO product_lookup SET product_name = :ProductName, product_price = :productPrice, product_size = :productSize, product_quantity = :productQuantity, product_image = :productImage");
        

        $boundProduct = array(
            ":ProductName" => $product_name,
            ":productPrice" => $product_price,
            ":productSize" => $product_size,
            ":productQuantity" => $product_quantity,
            ":productImage" => $product_image
        );
        
        $addSuccessful = ($stmt->execute($boundProduct) && $stmt->rowCount() > 0);
        
        return $addSuccessful;
    }

    public function addCategory($category_type){
        $addSuccessful = false;
        $categoryTable = $this->categoryData;
        

        $stmt = $categoryTable->prepare("INSERT INTO category_lookup SET category_type = :categoryType");
        

        $boundCategory = array (
            ":categoryType" => $category_type
        );

        $addSuccessful = ($stmt->execute($boundCategory) && $stmt->rowCount() > 0);
        
        return $addSuccessful;

    } 

    public function addColor($color_hex, $color_desc){
        $addSuccessful = false;
        $colorTable = $this->colorData;

        $stmt = $colorTable->prepare("INSERT INTO color_lookup SET color_hex = :colorHex, color_desc = :colorDesc");

        $boundColor = array (
            ":colorHex" => $color_hex,
            ":colorDesc" => $color_desc
        );

        $addSuccessful = ($stmt->execute($boundColor) && $stmt->rowCount() > 0);

        return $addSuccessful;
    }
   
  


//update table into the database
    public function updateProduct ($product_id, $product_name, $product_price, $product_size, $product_quantity, $product_image)
    {
        $updateSuccessful = false;
        $productTable = $this->productData;
        
        $stmt = $productTable->prepare("UPDATE product_lookup SET product_name = :productName, product_price = :productPrice, product_size = :productSize, product_quantity = :productQuantity, product_image = :productImage WHERE product_id = :productID");

        $stmt->bindValue(':id', $product_id);
        $stmt->bindValue(':productName', $product_name);
        $stmt->bindvalue(':productPrice', $product_price);
        $stmt->bindValue(':productSize', $product_size);
        $stmt->bindValue(':productQuantity', $product_quantity);
        $stmt->bindValue(':productImage', $product_image);

        
    }

    public function updateCategory($category_id, $category_type){
        $updateSuccessful = false;
        $categoryTable = $this->CategoryDate;

        $stmt = $categoryTable->prepare("UPDATE category_lookup SET category_type = :categoryType WHERE category_id = :categoryID");

        $stmt->bindValue(':categoryID', $category_id);
        $stmt->bindValue(':categoryType', $category_type);

    }

    public function updateColor($color_id, $color_hex, $color_desc){
        $updateSuccessful = false;
        $colorTable = $this->categoryData;

        $stmt = $colorTable->prepare("UPDATE color_lookup SET color_hex = :colorHex, color_desc = :colorDesc WHERE color_id = :colorID");

        $stmt->bindvalue(':colorID', $color_id);
        $stmt->bindvalue(':colorHex', $color_hex);
        $stmt->bindvalue(':colorDesc', $color_desc);
    }


//Delete from the database
    public function deleteProduct ($product_id)
    {
        $deleteSuccessful = false;
        $productTable = $this->productData;

        $stmt = $productTable->prepare("DELETE FROM product_lookup WHERE product_id = :productID");

        $stmt->bindValue(':productID', $product_id);

        $deleteSuccessful = ($stmt->execute() && $stmt->rowCount() > 0);

        return $deleteSuccessful;
    }


//Get listing from the database
    public function getProduct ($product_id)
    {
        $results = [];
        $productTable = $this->productData;

        $stmt = $productTable->prepare("SELECT productID, productName, productPrice, productSize, productImage FROM product_lookup WHERE product_id = :productID");

        $stmt->bindValue(':productID', $product_id);

        if ($stmt->execute() && $stmt->rowCount() > 0)
        {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $results;
    }

    public function getColor($color_id){

        $results = [];
        $colorTable = $this->colorDate;

        $stmt = $colorTable->prepare("SELECT colorID, colorHex, colorDesc FROM color_lookup WHERE color_id = :colorID");

        $stmt->bindvalue(':colorID', $color_id);

        if($stmt->execute() && $stmt->rowcount() > 0)
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
