<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../partials/PHPMailer/src/Exception.php';
    require '../../partials/PHPMailer/src/PHPMailer.php';
    require '../../partials/PHPMailer/src/SMTP.php';

    $template_message = '<p>Good day Trainee!</p>
                        <h1>Congratulations!</h1>
                        <p>Your registration to <a href="www.nlrc.ph">www.nlrc.ph</a> has been approved. Please <a href="www.nlrc.ph/login">log in</a> to update your information as soon as possible.</p>
                        <p>For your questions and queries, kindly message us at <a href="mailto:support@zeldannlrc.com">support@zeldannlrc.com.</a></p>
                        <p><b>Note:</b> Do not reply to this message. Thank you!</p><br>
                        <p>Regards,</p>
                        <b>ZNLRC Support Team</b></p>';     

    try {
        $mail = new PHPMailer(true);
        $mail->setFrom('support@zeldannlrc.com', 'no-reply@zeldannlrc.com');
        $mail->addAddress($_POST['email']);
        $mail->Subject = "RE: Your account has been Approved!";
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