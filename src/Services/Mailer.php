<?php

namespace App\Services;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    public function sendEmail($email, $subject, $body)
    {
        $databaseJsonFileContents = file_get_contents("../config/mailConfig.json");
        $array = json_decode($databaseJsonFileContents, true);

        $mail = new PHPMailer(true);

        try 
        {
            // Server settings
            $mail->isSMTP();
            $mail->Host = $array["Host"];
            $mail->SMTPAuth = $array["SMTPAuth"];
            $mail->Username = $array["Username"];
            $mail->Password = $array["Password"];
            $mail->SMTPSecure = $array["SMTPSecure"];
            $mail->Port = $array["Port"];
            $mail->CharSet = $array["Charset"];

            // Recipients
            $mail->setFrom($array["SetFrom"], "Marc Lassort");
            $mail->addAddress($email);
            $mail->addReplyTo($array["ReplyAddress"]);

            // Content
            $mail->isHTML(true);
            $mail->Subject = "$subject";
            $mail->Body = "$body";
            $mail->send();
        } catch (Exception $e)
        {
            echo "Le message n'a pas pu être envoyé. Erreur du service de courriel : {$mail->ErrorInfo}";
        }   
    }
}