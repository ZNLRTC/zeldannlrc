<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../partials/PHPMailer/src/Exception.php';
    require '../../partials/PHPMailer/src/PHPMailer.php';
    require '../../partials/PHPMailer/src/SMTP.php';

    $template_message = '<p>Dear Trainee,</p>
                        <p>You have a new message on your dashboard. Click <a href="www.nlrc.ph/login">here</a> to login or go to <a href="www.nlrc.ph">www.nlrc.ph</a>.</p>
                        <p><b>Best Regards</b>,<br>
                        ZNLRC Support Team';

    try {

        

        $mail = new PHPMailer(true);
        $mail->setFrom('support@zeldannlrc.com', 'no-reply@zeldannlrc.com');
        $mail->addAddress($_POST['email']);
        $mail->Subject = "Re: You have a new message on your dashboard!";

        // $mail->isSMTP();
        // $mail->Host = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'pocyoymiguel@gmail.com';
        // $mail->Password = 'fqvfimfqlpwrsraw';
        // $mail->Port = 465;
        // $mail->SMTPSecure = 'ssl';

        $mail->Body = $template_message;
        $mail->isHTML(true);
        $mail->send();

        $response['status'] = "success";
        $response['message'] = 'Email sent to user';
    } catch(Exception $e) {
        $response['status'] = "error";
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response);
    

?>