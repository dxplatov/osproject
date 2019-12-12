<?php
class Database{
    private $host = 'ec2-54-243-208-234.compute-1.amazonaws.com';
    private $db_name = 'd1o427hid21kl9';
    private $user = 'ireurrtyhghnwl';
    private $password = 'f51bbf6a7902e3c12f2b04fc01e060b427d3c5d8d3419d8e71291100a4a4c245';
    private $conn;
    public function connect(){
        $this->conn = null;
        try{
            $this->conn = new PDO('pgsql:host=' . $this->host . ';dbname=' . $this->db_name, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }
      return $this->conn;
    }
}
