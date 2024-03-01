<?php

if (isset($_POST['email_data'])) {
    require "../PHPMailer/PHPMailerAutoload.php";

    foreach ($_POST['email_data'] as $row) {
        $to = $row["email"];
        $from = 'tijani@blockchainsummit.africa';
        $from_name = 'Puubu Group';
        $subject = 'Your password for Voting';
        $body = '
            <p>Hola ' . $to . ',</p>
            <p>
                Your voting password is: <b>'.$row["password"].'</b>
                <br>
                NB: Please do not send or give your password to anyone. 
            </p>
            <br>
            <p>Visit this link to vote; https://puubu.blockchainsummit.africa</p>
            <br>
            <small>Contact Mr. Twumasi Obed the GHABSA EC on <a href="tel:+233248441894">+233248441894</a> or <a href="https://wa.link/gm2nnd">WhatsApp</a> incase of any challenges.
            <br><br>
            <small>Best Regards, Puubu Group.</small>
        ';

        //$mail = new PHPMailer();
        $mail = new PHPMailer(true); // with true in the parenthesis
        try {
            $mail->IsSMTP();
            $mail->SMTPAuth = true; 
                         
            $mail->SMTPSecure = 'ssl'; 
            $mail->Host = 'smtp.blockchainsummit.africa';
            $mail->Port = 465;  
            $mail->Username = 'tijani@blockchainsummit.africa';
            $mail->Password = 'Ni5965b50'; 
                           
            $mail->IsHTML(true);
            $mail->WordWrap = 50;
            $mail->From = "tijani@blockchainsummit.africa";
            $mail->FromName = $from_name;
            $mail->Sender = $from;
            $mail->AddReplyTo($from, $from_name);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($to);
            $mail->Send();

            // echo 'Message has been sent';
            echo 'ok';
            // break;
        } catch (Exception $e) {
             //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            echo "Message could not be sent.";
           // break;
        }
    }
}

?>