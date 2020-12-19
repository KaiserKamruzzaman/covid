<?php
   

    /**
    * 
    */
    class Database 
    {
        protected $con;

        protected $servername = "localhost";
        protected $username = "root";
        protected $password = "";
        protected $dbname = "covid_app";
        public function __construct()
        {
        
	        try 
	        {
                  $this->con = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
	    
	             $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 // echo "Connected successfully";                  
	        }
	        catch (Exception $e)
	        {
	             echo "Error: " . $e->getMessage();
	            
	        }
        }
    }


    ?>
