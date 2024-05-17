<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once(dirname(__FILE__).'/../assets/PHPMailer/src/Exception.php');
require_once(dirname(__FILE__).'/../assets/PHPMailer/src/PHPMailer.php');
require_once(dirname(__FILE__).'/../assets/PHPMailer/src/SMTP.php');
class SendMail{



        //Send email function
        function send_mail($email, $message){

            $mail = new PHPMailer(true);                                // Passing `true` enables exceptions
            try {
                //Server settings
                //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                        // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                                 // Enable SMTP authentication
                $mail->Username = 'phpmailer2455';                       // SMTP username
                $mail->Password = 'phpmailer123';                       // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                       // TCP port to connect to

                //Recipients
                $mail->setFrom('no-reply@info.com', 'ELETRO');
                $mail->addAddress($email);

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                //Content
                $mail->isHTML(true);                                    // Set email format to HTML
                $mail->Subject = 'Facture';
                $mail->Body = $message;
                //$mail->Body    = "You have beed registered successfully. Click the link below to verify your accout: <br><br>
                //                <a href='http://localhost/ExtensionApp_Vol_2/confirmation_lec.php?email=$email'>Click here to verify</a>";
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                $mail->send();
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
        }
}
?>