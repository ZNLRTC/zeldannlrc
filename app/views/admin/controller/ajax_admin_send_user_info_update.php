<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../partials/PHPMailer/src/Exception.php';
    require '../../partials/PHPMailer/src/PHPMailer.php';
    require '../../partials/PHPMailer/src/SMTP.php';

    $status = $_POST['updateStatus'];

    if($status == 'approved'){
        $template_message = '<p>Dear Trainee,</p>
                        <p>An update has been made to your profile. Specifically, the information pertaining to the "Zeldan Nordic Language Training & Review Center Information" section has been revised.</p>
                        <p>We wanted to inform you promptly regarding this update to ensure you are aware of any changes made to your profile. Should you have any questions or require further clarification regarding these modifications, please do not hesitate to reach out to us.</p><br>
                        <p><b>Best Regards</b>,<br>
                        ZNLRC Support Team';
    }else{
        $template_message = '<p>Dear Trainee,</p>
                        <p>Your request to update your information under "Zeldan Nordic Language Training & Review Center Information" has been denied. If you have any questions you may email us at <a hred="mailto:znlrtc@gmail.com">znlrtc@gmail.com</a>.</p>
                        <p><b>Best Regards</b>,<br>
                        ZNLRC Support Team';
    }

    try {

        $mail = new PHPMailer(true);
        $mail->setFrom('support@zeldannlrc.com', 'no-reply@zeldannlrc.com');
        $mail->addAddress($_POST['email']);
        $mail->Subject = "Re: Update information status";

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