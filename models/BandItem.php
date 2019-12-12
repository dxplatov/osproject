<?php


class BandItem
{



    private $conn;
    private $table = 'band_item';
    public $event_id;
    public $band_array;

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
        $array = "";
        for ($i = 0; $i < count($this->band_array); $i++) {
            $array = $array . $this->band_array[$i] . ",";
        };
        $array = substr_replace($array, "", -1);
        $array = $array . "]";
        $array = "[" . $array;
        $query = "INSERT INTO " . $this->table . " (event_id,band_id)" . " VALUES (:event_id,UNNEST(" . "array" . $array . ")" . ")";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':event_id', $this->event_id);
        print($query);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        return 0;
    }
}

