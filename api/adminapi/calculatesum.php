<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 include_once '../../config/Database.php';
 include_once '../../models/Event.php';

 $food_array = $_GET['food'];
 $no_of_people = intval($_GET['no_of_people']);
 $band = intval($_GET['band']);
 
 $query = "SELECT SUM(price) AS food_sum FROM food where id IN (".$food_array.")";

 $band_price = "SELECT price from band where id=".$band;
 $database = new Database();
 $db = $database->connect();
 $stmt = $db->prepare($query);
 $stmt1 = $db->prepare($band_price);
 if($stmt->execute()){
    $sum  = $no_of_people*$stmt->fetch(PDO::FETCH_ASSOC)['food_sum'];
    if($stmt1->execute()){
        $sum = $sum+$stmt1->fetch(PDO::FETCH_ASSOC)['price'];
        $sum_total = array(
            "total_sum"=>"$".(string)$sum
        );
        echo "[".json_encode($sum_total)."]";
    }else{
        die('Error executing query get band price');
    }
 }else{
     die('Error executing query get food sum');
 }
