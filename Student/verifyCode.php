<?php

use PHPMailer\PHPMailer\PHPMailer;

session_start();
include 'connect.php';
if ($_GET['email'] == "" || !isset($_SESSION["verifyCode"])) {
    header("location:verifyEmail.php");
}

if (array_key_exists('resend', $_POST)) {
    resend();
}

if (array_key_exists('verify', $_POST)) {
    verify();
}

function resend() {
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
        $mail->addAddress($_GET["email"]);
        $mail->Subject = $subject;
        $mail->Body = "Your verfication code for password recovery: " . $random . "<br/><br/>From TARUMT Education System";

        if ($mail->send()) {
            echo '<script>alert("Done resend.")</script>';
        }
    } catch (Exception $e) {
        echo "EMAIL SENDING FAILED. INFO: " . $mail->ErrorInfo;
    }
}

function verify() {
    if ($_POST["verifyCode"] == $_SESSION["verifyCode"]) {
        unset($_SESSION["verifyCode"]);
        echo '<script>window.location.href="resetPassword.php?email='.$_GET["email"].'"</script>';
    } else {
        echo '<script>alert("Invalid code, you can request for a new verification code by clicking resend button.")</script>';
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/verifyCode.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    </head>
    <body>
        <div class="loginTopNavBar">
            <p>TARUMT Game-based Learning System</p>
        </div>
        <div class="goBackBtn">
            <button class="backBtn" onclick="location.href = 'verifyEmail.php'">
                <i style='font-size:20px;color: #1a1b54; cursor: pointer;' class='fas'>&#xf137;</i>
                <span style="font-size:20px;text-transform: uppercase;color: #1a1b54;font-weight: 600;cursor: pointer;">Back</span>
            </button>
        </div>
        <div class="loginContent">
            <img class="logoImage" src="https://www.tarc.edu.my/images/tarumt-logo.png" alt="TARC LOGO" height="100px;">
            <h1>Password Recovery</h1>

            <div class="verifyFormContainer">
                <form method="post" class="loginForm">
                    <label for="verifyCode">Verification Code</label><br>
                    <input type="text" id="verifyCode" name="verifyCode" placeholder="eg. xxx123" autofocus><br>
                    <div class="resendBtnContainer"><button class="resendBtn" type="submit" name="resend">Resend</button></div>
                    <input type="submit" name="verify" value="VERIFY" class="verifyBtn">
                </form> 
            </div>
        </div>
    </body>
</html>
