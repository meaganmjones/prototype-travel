<?php


class Color{

    private $colorData;

    public function __construct($configFile){

        if ($ini = parse_ini_file($configFile)){
            
            $colorPDO = new PDO ("mysql:host=" .$ini['servername'] . ";port=" .$ini['port'] . ";dbname=" . $ini['dbname'], $ini['username'], $ini['password']);

            //dont emulate prepare statements
            $colorPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            //throw exceptions if there is a database error
            $colorPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //set our database to be newly created PDO
            $this->colorData = $colorPDO;
        }
        else{
            //things didnt go well, trow exception
            throw new Exception("<h2>Creation of database object failed!</h2>", 0, null);
        }
    }//end constructor

    public function getAllColor(){
        //$results = [];
        $colorTable = $this->colorData;

        $stmt = $colorTable->prepare("SELECT * FROM color_lookup");

        if($stmt->execute() && $stmt->rowCount() > 0){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $results;
    }

    public function getColor($id) {
        $results = [];
        $colorTable = $this->colorData;

        $stmt = $colorTable->prepare("SELECT colorID, colorHex, colorDesc FROM color_lookup WHERE colorID = :id");

        $stmt->bindValue(":id", $id);
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
        {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 
         }
         
         return ($results);
    }

     public function addColor($color_hex, $color_desc){
        $addSuccessful = false;
        $colorTable = $this->colorData;

        $stmt = $colorTable->prepare("INSERT INTO color_lookup SET colorHex = :color_hex, colorDesc = :color_desc");

        $boundColor = array (
            ":color_hex" => $color_hex,
            ":color_desc" => $color_desc
        );

        $addSuccessful = ($stmt->execute($boundColor) && $stmt->rowCount() > 0);

        return $addSuccessful;
    }

    public function updateColor($color_id, $color_hex, $color_desc){
        $updateSuccessful = false;
        $colorTable = $this->categoryData;

        $stmt = $colorTable->prepare("UPDATE color_lookup SET color_hex = :colorHex, color_desc = :colorDesc WHERE color_id = :colorID");

        $stmt->bindvalue(':colorID', $color_id);
        $stmt->bindvalue(':colorHex', $color_hex);
        $stmt->bindvalue(':colorDesc', $color_desc);
    }

    // public function getColor($color_id){

    //     $results = [];
    //     $colorTable = $this->colorDate;

    //     $stmt = $colorTable->prepare("SELECT colorID, colorHex, colorDesc FROM color_lookup WHERE color_id = :colorID");

    //     $stmt->bindvalue(':colorID', $color_id);

    //     if($stmt->execute() && $stmt->rowcount() > 0)
    //     {
    //         $results = $stmt->fetch(PDO::FETCH_ASSOC);
    //     }
    //     return $results;
    // }

    public function getOneColor($color_hex){
        $results = [];
        $colorTable = $this->colorData;

        $stmt = $colorTable->prepare("SELECT * FROM color_lookup WHERE colorHex = :color_hex");
        
        $stmt->bindValue(':color_hex', $color_hex);

        if($stmt->execute() && $stmt->rowCount() > 0){
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $results;

    }

    protected function getDatabaseRef()
    {
        return $this->colorData;
    }
}
?>