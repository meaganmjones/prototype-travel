<?php

// This class provides a wrapper for the database 
// All methods work on the login_lookup table

class AdminLogin
{
    // This data field represents the database
    private $loginData;

    // Used to salt user password
    const PASSWORD_SALT = "school-salt";

    
    public function __construct($configFile) 
    {
        // Parse config file, throw exception if it fails
        if ($ini = parse_ini_file($configFile))
        {
            // Create PHP Database Object
            $loginPDO = new PDO( "mysql:host=" . $ini['servername'] . 
                                ";port=" . $ini['port'] . 
                                ";dbname=" . $ini['dbname'], 
                                $ini['username'], 
                                $ini['password']);

            // Don't emulate (pre-compile) prepare statements
            $loginPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            // Throw exceptions if there is a database error
            $loginPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Set our database to be the newly created PDO
            $this->loginData = $loginPDO;
        }
        else
        {
            // Things didn't go well, throw exception!
            throw new Exception( "<h2>Creation of database object failed!</h2>", 0, null );
        }

    } // end constructor

    // Get listing of all users

    public function getAllLogin() 
    {
        $results = [];                 
        $loginLookup = $this->loginData;  

        
        return $results;
    }

   

    // Delete specified user from table

    public function deleteLogin ($id) 
    {
        $deleteSucessful = false;       
        $loginLookup = $this->loginData;   

        // Return status to client           
        return $deleteSucessful;
    }
 
    // Get one user and place it into an associative array
    public function getLogin($id) 
    {
        $results = [];                  
        $loginKookup = $this->loginData;   

        
        return $results;
    }

    // Special function accessible to derived classes
    // Allows children to make database queries.
    public function getDatabaseRef()
    {
        return $this->loginData;
    }

    // Validates credentials user entered on form
    function validateCredentials($username, $password)
    {
        $validUser = false;
        $loginLookup = $this->loginData;   

        // Create query object with username and password
        $stmt = $loginLookup->prepare("SELECT userPassword, loginSalt FROM login_lookup WHERE username = :userName");
 
        // Bind query parameter values
        $stmt->bindValue(':userName', $username);

        $foundUser = ($stmt->execute() && $stmt->rowCount() > 0);

        if ($foundUser)
        {
            $results = $stmt->fetch(PDO::FETCH_ASSOC); 
            $hashedPassword = sha1( $results['loginSalt'] . $password);
            $validUser = ($hashedPassword == $results['userPassword']);
        }
        
        return $validUser;
    }
 
} // end class AdminLogin
?>