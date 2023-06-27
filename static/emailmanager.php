<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'tools/PHPMailer/Exception.php';
    require 'tools/PHPMailer/PHPMailer.php';
    require 'tools/PHPMailer/SMTP.php';


    class emailmanager{
        static function sendEmail($toEmailaddress, $Subject, $Body){
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.strato.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'student@computercampus.nl';                     //SMTP username
                $mail->Password   = 'Sp@mmenmagniet!';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('student@computercampus.nl', 'Student Koen');
                $mail->addAddress($toEmailaddress);     //Add a recipient
                
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $Subject;
                $mail->Body    = $Body;

                $mail->send();
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        }
    }

?>