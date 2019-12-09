<?php

namespace App\Package;

use PHPMailer\PHPMailer\PHPMailer;

class SendEmailLib
{
    public function __construct()
    {

    }

    public function sendEmail($to, $subject, $message)
    {
        try {
            $mail = new PHPMailer(true); // notice the \  you have to use root namespace here
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true; // use smpt auth
            $mail->SMTPSecure = "tls"; // or ssl
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587; // most likely something different for you. This is the mailtrap.io port i use for testing.
            $mail->Username = "amit.d9ithub@gmail.com";
            $mail->Password = "zbjkqfmxwikrygqa";
            $mail->setFrom("amit.d9ithub@gmail.com");
            $mail->Subject = $subject;
            $mail->MsgHTML($message);
            $mail->addAddress($to);
            if (!$mail->send()) {
                return false;
            }

            return true;

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
}
