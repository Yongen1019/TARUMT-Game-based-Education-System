<?php

use PHPMailer\PHPMailer\PHPMailer;

session_start();
include 'connect.php';
if (isset($_POST["verify"])) {
    $query = "select * from studentaccount where email = :email";
    $statement = $db->prepare($query);
    $statement->execute(
            array(
                'email' => $_POST["email"]
            )
    );
    $count = $statement->rowCount();
    if ($count == 0) {
        echo '<script>alert("Email not registered.")</script>';
    } else {
        $subject = "TARUMT Game-Based Education System Reset Password Verification Code";
        $random = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 6);
        $_SESSION["verifyCode"] = $random;
        require_once 'PHPMailer/PHPMailer.php';
        require_once 'PHPMailer/SMTP.php';
        require_once 'PHPMailer/Exception.php';

        $developmentMode = true;
        $mail = new PHPMailer($developmentMode);
        try {
            $mail->isSMTP();

            if ($developmentMode) {
                $mail->SMTPOptions = [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    ]
                ];
            }

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "tarumteducation@gmail.com";
            $mail->Password = 'cjujjyhnpsjbpyhf';
            $mail->Port = 465;
            $mail->SMTPSecure = "ssl";

            $mail->isHTML(true);
            $mail->setFrom("EducationSystem@tarc.edu.my", "TARUMT Game-Based Education System");
            $mail->addAddress($_POST["email"]);
            $mail->Subject = $subject;
            $mail->Body = "Your verfication code for password recovery: " . $random . "<br/><br/>From TARUMT Education System";
            if ($mail->send()) {
                echo '<script>window.location.href="verifyCode.php?email=' . $_POST["email"] . '"</script>';
            }
        } catch (Exception $e) {
            echo "EMAIL SENDING FAILED. INFO: " . $mail->ErrorInfo;
        }
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/verifyEmail.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    </head>
    <body>
        <div class="loginTopNavBar">
            <p>TARUMT Game-based Learning System</p>
        </div>
        <div class="goBackBtn">
            <button class="backBtn" onclick="location.href = 'login.php'">
                <i style='font-size:20px;color: #1a1b54; cursor: pointer;' class='fas'>&#xf137;</i>
                <span style="font-size:20px;text-transform: uppercase;color: #1a1b54;font-weight: 600;cursor: pointer;">Back</span>
            </button>
        </div>
        <div class="loginContent">
            <img class="logoImage" src="https://www.tarc.edu.my/images/tarumt-logo.png" alt="TARC LOGO" height="100px;">
            <h1>Password Recovery</h1>

            <div class="verifyFormContainer">
                <form method="post" class="loginForm">
                    <label for="email">Email</label><br>
                    <input type="email" id="email" name="email" placeholder="eg. xxxxx-xx19@student.tarc.edu.my" autofocus required><br>

                    <input type="submit" value="VERIFY" name="verify" class="verifyBtn">
                </form> 
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</html>