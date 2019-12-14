<?php
    class Event{
        private $conn;
        private $table = 'event';

        public $id;
        public $client_name;
        public $email;
        public $phone;
        public $date;
        public $no_of_people;
        public $status = "P";
        public  $message = "Message is not set";

        public function __construct($db){
            $this->conn = $db;
        }
        public function read(){
             // Create query
        $query = 'SELECT * FROM ' . $this->table.' ORDER BY id ASC';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        return $stmt;
        }

        public function create(){
              // Create Query
        // $query = 'INSERT INTO '. $this->table . ' VALUES('$this->client_name','$this->email','$this->phone','$this->date','$this->no_of_people','$this->status');';
        // print($query);
        $query = "INSERT INTO ".$this->table." (client_name,email,phone,date,no_of_people,status,message)"." VALUES (:client_name, :email, :phone, :date, :no_of_people, :status,:message) RETURNING id";

        // Prepare Statement
        $stmt = $this->conn->prepare($query);
        $stmt-> bindParam(':client_name', $this->client_name);
        $stmt-> bindParam(':email', $this->email);
        $stmt-> bindParam(':phone', $this->phone);
        $stmt-> bindParam(':date', $this->date);
        $stmt-> bindParam(':no_of_people', $this->no_of_people);
        $stmt-> bindParam(':status', $this->status);
        $stmt-> bindParam(':message', $this->message);
        // Execute query
        if($stmt->execute()) {
            $this->id = $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->id['id'];
        }

        return 0;
        }




        public function check_date($id){
            
            $query = "SELECT * FROM event WHERE id = :id";
            $query_date = "SELECT * from approved_date WHERE date=:date"; 
           
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            if($stmt->execute()){
                $event = $stmt->fetch(PDO::FETCH_ASSOC);
                $date = $event['date'];
                print_r($event);
                $stmt_date = $this->conn->prepare($query_date);
                $stmt_date->bindParam(':date', $date);
                if($stmt_date->execute()){
                    $approved_dates = $stmt_date->fetch(PDO::FETCH_ASSOC);
                    print_r($approved_dates);
                   // print(gettype($approved_dates));
                    if($approved_dates){
                        return 0;
                    }else{
                       1;
                    }
                }             
            }
        }

        public function approve($id){
            $query = "UPDATE event SET  status='A' WHERE id=:id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam('id',$id);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function is_event($id){
            $query = "SELECT * FROM event WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            if($stmt->execute()){
                $event = $stmt->fetch(PDO::FETCH_ASSOC);
              
                if($event){
                    return 1;
                }else{
                    return 0;
                }
            }

        }

        public function check_for_int($id){
            if(is_int($id)){
                var_dump(is_int($id));
                return 1;
            }else{
                return 0;
            }
        }
    }