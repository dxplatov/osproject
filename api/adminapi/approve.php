  
 <?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Event.php';

  $database = new Database();
  $db = $database->connect();
  $id = $_GET['id'];
  $id = intval($id);

  $event = new Event($db);
  $id = $_GET['id'];
  function error_adder($type, $content){
   $error = [
      $type=>$content
    ];
    return "[".json_encode($error)."]";
  }
 

  // if(filter_var($id, FILTER_SANITIZE_NUMBER_INT)){
  //   if($event->is_event($id)){
  //     if($event->check_date($id)){
  //       $event->approve($id);
  //   }else{
  //     $error = "Date is Booked";
  //     echo error_adder($error);
      
  //   }
  //   }else{
  //     $error = "Event does not exist";
  //     echo error_adder($error);
  //   }
    
  // }else{
  //   $error = "Enter Integer";
  //   echo error_adder($error);
  // }
 if (filter_var($id,FILTER_SANITIZE_NUMBER_INT) and $event->is_event($id)){
  if($event->check_date($id)){
      echo error_adder("success", "valid date");
  }else{
    echo error_adder("error", "Date is Booked");
  }
 }else{
   echo error_adder("error", "enter valid id");
 }