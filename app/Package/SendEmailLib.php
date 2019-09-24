<?php

namespace App\Package;
use PHPMailer\PHPMailer\PHPMailer;

class SendEmailLib
{
    function __construct(){

    }

    function sendEmail($to,$subject,$message){
        $mail = new PHPMailer(true); // notice the \  you have to use root namespace here
        $mail->isSMTP(); // tell to use smtp
        $mail->CharSet = "utf-8"; // set charset to utf8
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;  // use smpt auth
        $mail->SMTPSecure = "ssl"; // or ssl
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // most likely something different for you. This is the mailtrap.io port i use for testing. 
        $mail->Username = "amit.d9ithub@gmail.com";
        $mail->Password = "developer@567";
        $mail->setFrom("youremail@yourdomain.de", "Erjaan Solutions");
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->addAddress($to);
        if(!$mail->send())
        	return FALSE;
        return TRUE;
    }
}
