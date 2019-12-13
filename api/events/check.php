<?php
	//echo "works";

  $client_name = $_GET['client_name'];
  $email = $_GET['email'];
  $phone = $_GET['phone'];
  $date = $_GET['date'];
  $no_of_people =$_GET['no_of_people'];
  ///////////////////////////////////////////////////////////////////////////////////
  $client_name_pattern="/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/";
  $phone_pattern="/^[+]?[0-9]{7,12}$/";
  $date_pattern = "/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/";
  $no_of_people_pattern= "/^[0-9]*$/";
  /////////////////////////////////////////////////////////////////////////////////
  $errors=[
					'client_name_err'=>'',
					'email_err'=>'',
					'phone_err'=>'',
					'date_err'=>'',
					'no_of_people_err'=>''
					
		  ];
////////////////////////////////////// Client Name REGEX///////////////////
		if(empty($client_name))
		{
			$errors['client_name_err']=' * Name cannot be empty';
		}
		elseif(!(bool)preg_match($client_name_pattern,$client_name))
		{
		  	$errors['client_name_err']=' * Invalid type Name should content only letters';
	    }
	    else
	    {
		      $errors['client_name_err']='no error';
		}
////////////////////////////////////////////////////////////////////
/////////////////////// Email REGEX //////////////////////////////
		if(empty($email))
		{
			$errors['email_err']=' * Email cannot be empty';
		}
		elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
		  	$errors['email_err']=' * Invalid Email ';
	    }
	    else
	    {
		    $errors['email_err']='no error';
		}
///////////////////////////////////////////////////////////////////
///////////////////////////////// Phone validation//////////////////
		if(empty($phone))
		{
			$errors['phone_err']=' * Phone cannot be empty';
		}
		elseif(!(bool)preg_match($phone_pattern,$phone))
		{
		  	$errors['phone_err']=' * Invalid Phone type';
	    }
	    else
	    {
		      $errors['phone_err']='no error';
		}
////////////////////////////////////////////////////////////////////
/////////////////////////////////// Date Validation//////////////////
		if(empty($date))
		{
			$errors['date_err']=' * Date  cannot be empty';
		}
		elseif(!(bool)preg_match($date_pattern,$date))
		{
		  	$errors['date_err']=' * Invalid Date type';
	    }
	    else
	    {
		      $errors['date_err']='no error';
		}
////////////////////////////////////////////////////////////////////
/////////////////////////// Number of People validation ///////////////
		if(empty($no_of_people))
		{
			$errors['no_of_people_err']=' * Number of People  cannot be empty';
		}
		elseif(!(bool)preg_match($no_of_people_pattern,$no_of_people))
		{
		  	$errors['no_of_people_err']=' * Invalid Number ';
	    }
	    else
	    {
		      $errors['no_of_people_err']='no error';
		}
///////////////////////////////////////////////////////////////////////

		
		$json= json_encode($errors);
		$last="[".$json."]";
		echo $last;
		

		
		
?>