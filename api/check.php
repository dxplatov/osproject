<?php
    $message = array(
        "name_error"=>"no error",
        "email_error"=>"name",
        "phone_error"=>"no error",
        "date_error"=>"empty",
        "no_of_people"=>"empty"
    );
    $messages1 = array(
        "name_error"=>"no error",
        "email_error"=>"name",
        "phone_error"=>"no error",
        "date_error"=>"empty",
        "no_of_people"=>"empty"
    );
    
    echo json_encode($message);
    $messages = array();
    
        array_push($messages,$message);
        array_push($messages,$messages1);

    echo json_encode($messages);