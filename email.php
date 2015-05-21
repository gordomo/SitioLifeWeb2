<?php
include_once 'conf/conf.php';

switch ($_REQUEST['action'])
{
    case "contact":
            if($_REQUEST['first_name'] == '' || $_REQUEST['last_name'] == '' || $_REQUEST['email'] == '' || $_REQUEST['message'] == ''):
                echo "falta_algun_campo";
                break;
            endif;

            if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL))
            {
                echo "error_correo_invalido";
                break;
            }

            $to = 'contacto@lifeweb.com.ar';

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
                $con = conf::getConection("m2000364_mail");
                if($con)
                {
                    mysqli_query($con,"INSERT INTO email (mail, nombre, apellido) "
                                                . "VALUES ('".$_REQUEST['email']."','".$_REQUEST['first_name']."','".$_REQUEST['last_name']."')");
                    mysqli_close($con);
                }

                echo "ok";
                break;
            }

            echo "ko";
            
    break;
    
    case "newsletter":
            if($_REQUEST['email'] == '')
            {
                echo "falta_algun_campo";
                break;
            }

            if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL))
            {
                echo "error_correo_invalido";
                break;
            }

            $con = conf::getConection("mail");
            $correo = $_REQUEST['email'];
            
            $query = "INSERT INTO newsletter VALUES (null, '$correo')";
            //die(var_dump($con));
            
            if($con)
            {
                if($objMySqli = mysqli_query($con, $query))
                {
                    echo "ok";
                }
                else
                {
                    echo "correo_duplicado";
                }
                mysqli_close($con);
            }
            else
            {
                echo "ko";
            }
        
    break;
}

return;

    