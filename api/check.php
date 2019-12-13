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