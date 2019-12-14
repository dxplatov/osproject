  
 <?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Event.php';

  $database = new Database();
  $db = $database->connect();
  $event = Event($db);
  $id = $_GET['id'];
  $id = intval($i);

  $event = new Event($db);
  $id = $_GET['id'];
  if(!$event->check_date($id)){
      die('date is booked');
  }else{
    die('date is free');
  }