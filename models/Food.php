<?php
    class Food{
        private $conn;
        private $table = 'food';

        public $id;
        public $food_name;
        public $price;
        public $food_type;
        
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