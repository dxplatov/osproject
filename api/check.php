<?php
    $message = array(
        "name_error"=>"no error",
        "email_error"=>"name",
        "phone_error"=>"no error",
        "date_error"=>"empty",
        "no_of_people"=>"empty"
    );
    
    echo json_encode($message);
    print_r($message);
    $messages = array();
    for($i=0;$i<count($message); $i++){
        array_push($messages,$message[$i]);
    }
    echo json_encode($messages);