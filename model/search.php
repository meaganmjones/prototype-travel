<?php

include_once __DIR__ . '/product.php';

// Extending the class to use the other file
class ProductSearch extends Product
{

    // Allows user to search
    function searchProducts ($product_name, $category_type) 
    {
        
        $results = array();             
        $binds = array();               
        $productTable = $this->getDatabaseRef();   

        // Create base SQL statement that we can append
        // specific restrictions to
        $sqlQuery =  "SELECT * FROM  product_lookup     ";
        $sqlQuery2 = "SELECT * FROM category_lookup     ";
$isFirstClause = true;
        // if the user has input, then append the value and bind the parameter
        if ($product_name != "" || $category_type != "") {
            if ($isFirstClause)
            {
                $sqlQuery .=  " WHERE ";
                $sqlQuery2 .= " WHERE ";
                $isFirstClause = false;
            }
            // else
            // {
            //     $sqlQuery2 .= " WHERE ";
            //     $isFirstClause = false;
            // }
            // $sqlQuery .= "  carYear LIKE :carYear";
            // $binds['carYear'] = '%'.$carYear.'%';
        }


        // if ($carMake != "") {
        //     if ($isFirstClause)
        //     {
        //         $sqlQuery .=  " WHERE ";
        //         $isFirstClause = false;
        //     }
        //     else
        //     {
        //         $sqlQuery .= " AND ";
        //     }
        //     $sqlQuery .= "  carMake LIKE :carMake";
        //     $binds['carMake'] = '%'.$carMake.'%';
        // }
    
        
        // if ($carModel != "") {
        //     if ($isFirstClause)
        //     {
        //         $sqlQuery .=  " WHERE ";
        //         $isFirstClause = false;
        //     }
        //     else
        //     {
        //         $sqlQuery .= " AND ";
        //     }
        //     $sqlQuery .= "  carModel LIKE :carModel";
        //     $binds['carModel'] = '%'.$carModel.'%';
        // }
        
        // if ($carTrans != ""){
        //     if ($isFirstClause){
        //         $sqlQuery .= " WHERE ";
        //         $isFirstClause = false;
        //     }
        //     else{
        //         $sqlQuery .= " AND ";
        //     }
        //     $sqlQuery .= " carTrans LIKE :carTrans";
        //     $binds['carTrans'] = '%'.$carTrans.'%';
        // }

        // if ($carColor != "") {
        //     if ($isFirstClause)
        //     {
        //         $sqlQuery .=  " WHERE ";
        //         $isFirstClause = false;
        //     }
        //     else
        //     {
        //         $sqlQuery .= " AND ";
        //     }
        //     $sqlQuery .= "  carColor LIKE :carColor";
        //     $binds['carColor'] = '%'.$carColor.'%';
        // }

        // Create query object from the table
        $stmt = $productTable->prepare($sqlQuery);

        // Perform query on the database
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) 
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // Return results of the query
        return $results;
    } // end search
}

?>