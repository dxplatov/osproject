<?php


class BandItem
{



    private $conn;
    private $table = 'band_item';
    public $event_id;
    public $band_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        // Create query
        $query = 'SELECT * FROM ' . $this->table;
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        
        $query = "INSERT INTO " . $this->table . " (event_id,band_id) VALUES (:event_id,:band_id)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':event_id', $this->event_id);
        $stmt->bindParam(':band_id',$this->band_id);
        print($query);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        return 0;
    }
}

