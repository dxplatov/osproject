<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 include_once '../../config/Database.php';
 include_once '../../models/Band.php';

$database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $band = new Band($db);
  // Blog post query
  $result = $band->read();
  // Get row count
  $num = $result->rowCount();

  if($num > 0) {
    // Post array
    $bands = array();
    // $posts_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $band_item = array(
            'id' => $id,
            'food_name' => $band_name,
            'price' => $price,
            
      );
      // Push to "data"
      array_push($bands, $band_item);
      // array_push($posts_arr['data'], $post_item);
    }
    // Turn to JSON & output
    echo json_encode($bands);
  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No bands found')
    );
  }