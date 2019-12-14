<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 include_once '../../config/Database.php';
 include_once '../../models/Event.php';

 $food_array = $_GET['food'];
 $no_of_people = $_GET['no_of_people'];
 $band_array = $_GET['band'];
 $sum = ["sum"=>"21"];
 echo "[".json_encode($sum)."]";
