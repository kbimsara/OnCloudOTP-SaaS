<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require './PHPMailer/src/Exception.php';
// require './PHPMailer/src/PHPMailer.php';
// require './PHPMailer/src/SMTP.php';
// require './template-1.php';
require './mail/PHPMailer/src/Exception.php';
require './mail/PHPMailer/src/PHPMailer.php';
require './mail/PHPMailer/src/SMTP.php';

require './mail/template-1.php';

class sender
{
    var $to;
    var $otp;
    var $group_name;
    var $timeStamp;
    var $subject;

    function sendphp()
    {
        $temp = new template;
        $temp->otp = $this->otp;
        $temp->timeStamp = $this->timeStamp;
        $message = $temp->view();

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '${{ secrets.EMAIL_ID }}';
        $mail->Password = '${{ secrets.PW }}'';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->isHTML(true);
        $mail->setFrom($this->to, $this->group_name);
        $mail->addAddress($this->to);
        $mail->Subject = ("$this->subject");
        $mail->Body = $message;
        $mail->send();
    }
}
