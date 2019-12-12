<?php 
  // Headers
//   public $id;
//   public $client_name;
//   public $email;
//   public $phone;
//   public $date;
//   public $no_of_people;
//   public $status;
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: GET');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  include_once '../../config/Database.php';
  include_once '../../models/Event.php';
  include_once '../../models/FoodItem.php';
  include_once '../../models/BandItem.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $event = new Event($db);
  $food_item = new FoodItem($db);
  $band_item = new BandItem($db);
  $client_name = $_GET['client_name'];
  $email = $_GET['email'];
  //$message = $_GET['message'];
  $no_of_people =intval($_GET['no_of_people']);
  $phone = $_GET['phone'];
  $date = $_GET['date'];
  $band_1 = $_GET['band'];
  $food_1=$_GET['food'];
 
  $food = array();
  $band = array();
  $band_1 = explode(',',$band_1);
 
  $food_1 = explode(',',$food_1);
 
    for($i=0;$i<count($food_1);$i++){
        $food[$i] = intval($food_1[$i]);
    }
    for($i=0;$i<count($band_1);$i++){
        $band[$i] = intval($food_1[$i]);
        
    }
    
    //Event data Assigning
    $event->client_name = $client_name;
    $event->email = $email;
    $event->phone = $phone;
    $event->date = $date;
    $event->no_of_people = $no_of_people;
    if(isset($_GET['message'])) $event->message = $_GET['message'];
    $food_item->food_array = $food;
    $band_item->band_array = $band;

if($id=$event->create()) {
     echo json_encode(
       array('message' => 'Client data Created')
     );
      $food_item->event_id = intval($id);
      $band_item->event_id = intval($id);
    if($food_item->create()){
        echo json_encode(
            array('message' => 'Food Items create')
        );
    }
    if ($band_item->create()){
        echo json_encode(
            array('message' => 'Band Items create')
        );
    }
  } else {
    echo json_encode(
      array('message' => 'Event Not Created')
    );
  }