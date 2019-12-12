<?php
class Database{
    private $host = 'ec2-107-21-93-51.compute-1.amazonaws.com';
    private $db_name = 'd11i774lo4gk7c';
    private $user = 'jupvoqbdrwfiaf';
    private $password = 'fe916be09259358782ba360dc71eb0ef4e04fa302d7e5c2cd65389cf5d2f538a';
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
