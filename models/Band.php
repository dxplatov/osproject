<?php
    class Band{
        private $conn;
        private $table = 'band';

        public $id;
        public $band_name;
        public $price;
       
        
        public function __construct($db){
            $this->conn = $db;
        }
        public function read(){
             // Create query
        $query = 'SELECT * FROM ' . $this->table .' ORDER BY id ASC';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        return $stmt;
        }
    }