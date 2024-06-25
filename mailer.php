
<?php
try {
    $cced='';
    require 'phpmailer/PHPMailerAutoload.php';
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0;
    $mail->SMTPSecure = "ssl";
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = 'bookmyturf8@gmail.com';
    $mail->Password = 'noeubyuerynjnlms';
    $mail->From = 'bookmyturf8@gmail.com';
    $mail->FromName = 'TURF BOOKING SYSTEM';
    $mail->AddAddress($to);
    $cc = explode(',', $cced);
    foreach ($cc as $cces) {
        if ($cces != "") {
            $mail->addCC($cces);
        }
    }
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->MsgHTML($body);
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail_sent_status = 0;
    if ($mail->Send()) {
        $mail_sent_status = 1;
    }
}
catch (Exception $getinfo) {
        var_dump($getinfo);
         exit;
         return 0;
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return 0;
}
?>