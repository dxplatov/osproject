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
        $query = 'SELECT * FROM ' . $this->table;
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        return $stmt;
        }

        public function create(){
              
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
            
            $query = "SELECT * FROM event WHERE id = :id AND date IN (SELECT date FROM approved_date)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
           if($stmt->execute()){
               $num = $stmt->rowCount();
               
                if($num>0){
                    return 0;
                }else{
                    return 1;
                }
           }
        }

        public function approve($id){
            $query = "UPDATE event SET  status='A' WHERE id=:id RETURNING date";
            $query_date = "INSERT INTO approved_date(date,event_id) VALUES (:date,:id)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id',$id);
            if($stmt->execute()){
                $date = $stmt->fetch(PDO::FETCH_ASSOC)['date'];
                $stmt_1 = $this->conn->prepare($query_date);
                $stmt_1->bindParam(':date', $date);
                $stmt_1->bindParam(':id', $id);

               if($stmt_1->execute()){
                return 1;
               }else{
                   return 0;
               }
                
            }else{
                return 0;
            }
        }

        public function is_event($id){
            $query = "SELECT * FROM event WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            if($stmt->execute()){
                $num = $stmt->rowCount();
                if($num>0){
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