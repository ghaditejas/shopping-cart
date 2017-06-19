<?php

if (!function_exists('pr')) {

    function pr($data) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

}

if (!function_exists('send_mail')) {

    function send_mail($to, $subject, $body) {
        $CI = & get_instance();
        $CI->load->library('PHPMailer');
        $mail= new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "smtp.elasticemail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Username = "kunal.dethe.neo@gmail.com";
        $mail->Password = "a88af7ef-4829-433e-8212-9a8fb117fd5c";
        $mail->Port = 2525;
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->IsHTML(true);
        $mail->SetFrom("kunal.dethe.neo@gmail.com");
        $mail->AddAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;
        if ($mail->Send()) {
            return true;
        } else {
            return false;
        }
    }

}
?>

