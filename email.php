<?php
include_once 'conf/conf.php';

    if($_REQUEST['first_name'] == '' || $_REQUEST['last_name'] == '' || $_REQUEST['email'] == '' || $_REQUEST['message'] == ''):
        return "error";
    endif;
		
    if (filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)):
    // receiver email address
    $to = 'contacto@lifeweb.com';
			
    // prepare header
    $header = 'From: '. $_REQUEST['first_name'] .' '. $_REQUEST['last_name']. ' <'. $_REQUEST['email'] .'>'. "\r\n";
    $header .= 'Reply-To:  '. $_REQUEST['first_name'] .' '. $_REQUEST['last_name']. ' <'. $_REQUEST['email'] .'>'. "\r\n";
    // $header .= 'Cc:  ' . 'example@domain.com' . "\r\n";
    // $header .= 'Bcc:  ' . 'example@domain.com' . "\r\n";
    $header .= 'X-Mailer: PHP/' . phpversion();
    // Contact Subject
    $subject = $_REQUEST['subject'];
    // Contact Message
    $message = $_REQUEST['message'];
    // Send contact information
    $mail = mail( $to, $subject , $message, $header );
    
    if($mail)
    {
        $con = conf::getConection("m2000364_pruebas");
        if($con)
        {
            mysqli_query($con,"INSERT INTO email (mail, nombre, apellido) "
                                        . "VALUES ('".$_REQUEST['email']."','".$_REQUEST['first_name']."','".$_REQUEST['last_name']."')");
            mysqli_close($con);
        }
    
        return "success";
    }
    return "error";
    else:
        return "error";
    endif;



