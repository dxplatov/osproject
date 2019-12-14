<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 include_once '../../config/Database.php';
 include_once '../../models/Food.php';

$database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $food = new Food($db);
  // Blog post query
  $result = $food->read();
  // Get row count
  $num = $result->rowCount();

  if($num > 0) {
    // Post array
    $foods = array();
    // $posts_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $food_item = array(
            'id' => $id,
            'food_name' => $food_name,
            'food_type' => $food_type,
            'price' => $price,
            
      );
      // Push to "data"
      array_push($foods, $food_item);
      // array_push($posts_arr['data'], $post_item);
    }
    // Turn to JSON & output
    echo json_encode($foods);
  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No foods found')
    );
  }