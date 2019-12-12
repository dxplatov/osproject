<?php
    // Headers

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Event.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $event = new Event($db);
  // Blog post query
  $result = $event->read();
  // Get row count
  $num = $result->rowCount();

  if($num > 0) {
    // Post array
    $events = array();
    // $posts_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $events_item = array(
            'id' => $id,
            'client_name' => $client_name,
            'email' => $email,
            'phone' => $phone,
            'date' => $date,
            'no_of_people' => $no_of_people,
            'message' =>$message,
            'status' =>$status,


      );
      // Push to "data"
      array_push($events, $events_item);
      // array_push($posts_arr['data'], $post_item);
    }
    // Turn to JSON & output
    echo json_encode($events);
  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Evets Found')
    );
  }