<?php
error_reporting(E_ALL);

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php'; 

function phpEmailMailerFunc($recipientEmailAddress=null, $subject=null, $body=null) {
    require __DIR__. '/../credentials.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;   // Enable verbose debug output
        $mail->SMTPDebug = 0; // Enable verbose debug output
        $mail->isSMTP();      // Send using SMTP
        $mail->Host       = $mailHost; // Set the SMTP server to send through
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = $mailUsername; // SMTP username
        $mail->Password   = $mailPassword; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = $mailPort;
        $mail->Priority = 1; // Important

        // Recipients
        $mail->setFrom($sentFromAddress, $sentFromName);

        for($i = 0; $i < count($recipientEmailAddress); $i++) {
            $mail->addAddress($recipientEmailAddress[$i][0], $recipientEmailAddress[$i][1]);
        }

        $mail->addReplyTo($replyToEmail, $replyToName);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('', '');     //Add a recipient


        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        return [true, 1];
    } catch (Exception $e) {
        return $mail->ErrorInfo;
        return [false, $mail->ErrorInfo];
    }
}