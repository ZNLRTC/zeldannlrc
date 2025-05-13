<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../partials/PHPMailer/src/Exception.php';
    require '../../partials/PHPMailer/src/PHPMailer.php';
    require '../../partials/PHPMailer/src/SMTP.php';

    $date_hash =  urlencode(sha1((string) $_POST['date']));
    $email = $_POST["email"];

    $template_message = 'Good day!
                        Forgot your password? No worries, you can change your password using the link below.
                        Link: www.nlrc.ph/resetpassword?email='.$email.'&token='.$date_hash.'

                        Note: This is a system generated message. Do not reply.
                        
                        Regards,
                        ZNLRC Support Team';     

    try {
        $mail = new PHPMailer(true);
        $mail->setFrom('support@zeldannlrc.com', 'no-reply@zeldannlrc.com');
        $mail->addAddress($_POST['email']);
        $mail->addBcc('miguelluciano202201@yahoo.com');
        $mail->Subject = "RE: Reset Password Link";
        $mail->Body = $template_message;
        $mail->send();

        $response['status'] = "success";
        $response['message'] = 'Email sent to user';
    } catch(Exception $e) {
        $response['status'] = "error";
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response);
    

?>