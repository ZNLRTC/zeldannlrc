<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../partials/PHPMailer/src/Exception.php';
    require '../../partials/PHPMailer/src/PHPMailer.php';
    require '../../partials/PHPMailer/src/SMTP.php';

    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $subject = htmlentities($_POST['subject']);
    $message = htmlentities($_POST['message']);
    $template_message = '<p>You have a new inquery from your website:</p>
                        <p><b>Details:</b></p>
                        <p><b>Name:</b> '.ucwords($name).'<br><b>Email:</b> '.$email.'<br><b>Message:</b> '.$message;

    try {
        $mail = new PHPMailer(true);
        // $mail->SMTPDebug;
        // $mail->isSMTP();
        // $mail->Host = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'znlrtc@gmail.com';
        // $mail->Password = 'jvtgnuncxrmajcri';
        // $mail->Port = 465;
        // $mail->SMTPSecure = 'ssl';
        // $mail->isHTML(true);

        $mail->setFrom('support@zeldannlrc.com', 'ZenldanNLRC Support');
        $mail->addAddress('znlrtc@gmail.com');
        $mail->addBcc('miguelluciano202201@yahoo.com');
        $mail->Subject = ("$subject)");
        $mail->Body = $template_message;
        $mail->send();

        $response['status'] = "success";
    }catch(Exception $e){
        $response['status'] = 'error';
        $response['error_message'] = $e->getMessage();
    }
    echo json_encode($response);
?>