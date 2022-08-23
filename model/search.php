<?php

include_once __DIR__ . '/product.php';

// Extending the class to use the other file
class ProductSearch extends Product
{
    // private $searchData;

    // public function __construct($configFile){

    //     if ($ini = parse_ini_file($configFile)){
            
    //         $searchPDO = new PDO ("mysql:host=" .$ini['servername'] . ";port=" .$ini['port'] . ";dbname=" . $ini['dbname'], $ini['username'], $ini['password']);

    //         //dont emulate prepare statements
    //         $searchPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    //         //throw exceptions if there is a database error
    //         $searchPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //         //set our database to be newly created PDO
    //         $this->searchData = $searchPDO;
    //     }
    //     else{
    //         //things didnt go well, trow exception
    //         throw new Exception("<h2>Creation of database object failed!</h2>", 0, null);
    //     }
    // }

    // Allows user to search
    function searchProducts ($searchString) 
    {
        
        $results = [];                         
        $productTable = $this->getDatabaseRef();   

        $stmt = $productTable->prepare("SELECT * FROM product_lookup, category_lookup WHERE productName LIKE '%:searchString%' OR categoryType LIKE '%:searchString%'");

        //$stmt = $productTable->prepare($sqlQuery);

        $stmt->bindValue(':searchString', $searchString);

        if ($stmt->execute() && $stmt->rowCount() > 0) 
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $results;
        }

} // end search

?>