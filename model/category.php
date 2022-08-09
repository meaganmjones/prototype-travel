<?php

class Category{


    private $categoryData;

    public function __construct($configFile){

        if ($ini = parse_ini_file($configFile)){
            
            $categoryPDO = new PDO ("mysql:host=" .$ini['servername'] . ";port=" .$ini['port'] . ";dbname=" . $ini['dbname'], $ini['username'], $ini['password']);

            //dont emulate prepare statements
            $categoryPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            //throw exceptions if there is a database error
            $categoryPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //set our database to be newly created PDO
            $this->categoryData = $categoryPDO;
        }
        else{
            //things didnt go well, trow exception
            throw new Exception("<h2>Creation of database object failed!</h2>", 0, null);
        }
    }

    public function getCategory() {
        $results = [];
        $categoryTable = $this->categoryData;

        $stmt = $categoryTable->prepare("SELECT categoryID, categoryType FROM category_lookup ORDER BY categoryID");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
        {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
         }
         
         return ($results);
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

    public function updateCategory($category_id, $category_type){
        $updateSuccessful = false;
        $categoryTable = $this->CategoryDate;

        $stmt = $categoryTable->prepare("UPDATE category_lookup SET category_type = :categoryType WHERE category_id = :categoryID");

        $stmt->bindValue(':categoryID', $category_id);
        $stmt->bindValue(':categoryType', $category_type);

    }

    // public function getCategory($category_id)
    // {
    //     $results = [];
    //     $categoryTable = $this->categoryData;

    //     $stmt = $categoryTable->prepare("SELECT categoryID, categoryType FROM category_lookup WHERE category_id = :categoryID");

    //     $stmt->bindValue(':categoryID', $category_id);

    //     if ($stmt->execute() && $stmt->rowCount() > 0)
    //     {
    //         $results = $stmt->fetch(PDO::FETCH_ASSOC);
    //     }
    //     return $results;
    // }

    protected function getDatabaseRef()
    {
        return $this->categoryData;
    }
}

?>