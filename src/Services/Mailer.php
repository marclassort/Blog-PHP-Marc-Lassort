<?php

namespace App\Services;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    const URL = "http://localhost:8888";

    public function sendEmailCreation($email, $firstName, $lastName, $token)
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
            $mail->Subject = "Confirmation d'inscription au blog de Marc Lassort";
            $mail->Body = "<p>Bonjour " . $firstName . ' ' . $lastName . ",</p><p>Pour valider votre inscription, vous devez prouver que vous disposez d'une adresse courriel valide :</p><a href='" . self::URL . "/verification/" . $token . "'><button>Cliquez ici pour vérifier mon adresse</button></a></p><p>Merci pour votre confiance,</p><p>Marc Lassort</p>";
            $mail->send();
        } catch (Exception $e)
        {
            echo "Le message n'a pas pu être envoyé. Erreur du service de courriel : {$mail->ErrorInfo}";
        }   
    }

    public function sendEmailForNewPassword($email, $firstName, $lastName, $token)
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
            $mail->Subject = "Blog Marc Lassort - Création d'un nouveau mot de passe";
            $mail->Body = "<p>Bonjour " . $firstName . ' ' . $lastName . ",</p><p>Pour créer un nouveau mot de passe, vous devez valider la procédure via ce courriel :</p><a href='" . self::URL . "/verification-password/" . $token . "'><button>Cliquez ici pour recréer mon mot de passe</button></a></p><p>Merci pour votre confiance,</p><p>Marc Lassort</p>";
            $mail->send();
        } catch (Exception $e)
        {
            echo "Le message n'a pas pu être envoyé. Erreur du service de courriel : {$mail->ErrorInfo}";
        }   
    }
}