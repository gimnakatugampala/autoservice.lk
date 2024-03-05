<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.autoservice.lk';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'no-reply@stations.autoservice.lk';                     //SMTP username
    $mail->Password   = '9922557gimna';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@stations.autoservice.lk', 'autoservice.lk');
    $mail->addAddress('gimnaktest@gmail.com');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment($email_invoice_path);         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = '[Invoice]['.$data_vehicle[0]['vehicle_number'].'] '.$data_station[0]["service_name"].'';
    $mail->Body    = '
            <head>
            <style>
            body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            }

            .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-sizing: border-box;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border:1px #BFC9CA solid;
            }

            h1 {
            color: #333333;
            }

            p {
            color: #666666;
            }

            .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #ffffff;
            text-decoration: none;
            border-radius: 3px;
            }

            .footer {
            margin-top: 20px;
            text-align: center;
            color: #999999;
            }

            #code{
                color:#E67E22;
            }
        </style>

        </head>

        <body>

            <div class="container">
            <h1>'.$data_station[0]["service_name"].'</h1>
            <h3>Dear '.$data_vehicle[0]["first_name"].' '.$data_vehicle[0]["last_name"].',</h3>

            <p>We hope this email finds you well. Attached to this email is the  invoice for the services provided by '.$data_station[0]["service_name"].'</p>
            <p>Please find the attached invoice details below. If you have any questions or concerns, feel free to contact our support team.</p>

         
            <p>Thank you for choosing '.$data_station[0]["service_name"].'.</p>
        </div>
        <div class="footer">
            <p>© '.date("Y").' '.$data_station[0]["service_name"].'</p>
        </div>
        </body>

        ';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->isHTML(true); 
    $mail->send();
    // echo 'success';

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}