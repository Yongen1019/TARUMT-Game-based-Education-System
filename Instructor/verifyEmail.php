<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/Exception.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Verify Email</title>
        <link rel="stylesheet" href="style.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <style>
            .loginTopNavBar{
                text-align: center;
                padding: 20px;
                background-color: #812928;
                color:white;
                box-shadow: 2px 2px 5px #997c7c;
                text-transform: capitalize;
                font-weight: bold;
                font-size: 20px;
            }
            
            .loginContent h1{
                text-align: center;
            }
            
            .logoImage{
                display: block;
                margin-left: auto;
                margin-right: auto;
                margin-top: 80px;
            }
            
            h1{
                color: #541b1a;
            }
            
            .goBackBtn{
                margin: 30px 0 0 30px;
            }
            
            .backBtn{
                border:none;
                background-color: #fffafa;
            }
            
            /*Form Start*/
           
            .verifyFormContainer{
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 30px 20px;
                width: 300px;
                margin: 35px auto;
            }
            
            input[type=text]{
                width: 100%;
                padding: 12px 10px;
                margin: 10px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            
            .verifyBtn {
                width: 100%;
                background-color: #812928;
                color: white;
                padding: 14px 20px;
                margin-top: 25px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                letter-spacing: 2px;
            }
                        
            .errormsg{
                margin-bottom: 10px;
                padding-bottom: 0;
                color: red;
                font-size: 13px;
            }
            /*Form End*/
        </style>
    </head>
    <body>
        <div class="loginTopNavBar">
            <p>TARUMT Game-based Teaching System</p>
        </div>
        <div class="goBackBtn">
            <button class="backBtn" onclick="history.back()">
                <i style='font-size:20px;color: #541b1a; cursor: pointer;' class='fas'>&#xf137;</i>
                <span style="font-size:20px;text-transform: uppercase;color: #541b1a;font-weight: 600;cursor: pointer;">Back</span>
            </button>
        </div>
        <div class="loginContent">
            <img class="logoImage" src="../tarumt-logo.png" alt="TARUMT LOGO" height="100px;">
            <h1>Verify Email</h1>
            
            <div class="verifyFormContainer">
                <?php
                function emailExist($email){
                    $exist = false;
                    
                    global $instructorName, $instructorID;

                    $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                    $query = "SELECT * FROM InstructorAccount WHERE email = '$email'";

                    if($result = $con->query($query)){
                        if($result->num_rows > 0)
                        {
                            while ($row = $result->fetch_assoc()){
                                $instructorName = $row["username"];
                                $instructorID = $row["instructorID"];
                            }
                            $exist = true;
                        }
                    }
                    $result->free();
                    $con->close();
                    return $exist;
                }

                function passwordMatch($password, $email){
                    $match = false;

                    $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');

                    $id = $con->real_escape_string($password);
                    $query = "SELECT * FROM InstructorAccount WHERE password = '$password' AND email = '$email'";

                    if($result = $con->query($query)){
                        if($result->num_rows > 0)
                        {
                            $match = true;
                        }
                    }
                    $result->free();
                    $con->close();
                    return $match;
                }

                function errorDetect(){
                    global $email, $password;

                    $error = array();

                    if(!preg_match('/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/', $email)){
                        $error['email'] = '<div class="errormsg">Invalid format of <b>Email</b>.</div>';
                    }else if(!preg_match('/^([a-zA-Z0-9_\-\.]+)@tarc\.edu\.my/', $email)){
                        $error['email'] = '<div class="errormsg">Please enter an instructor <b>Email</b>.</div>';
                    }else if(emailExist($email) == false){
                        $error['email'] = '<div class="errormsg"><b>Email</b> does not exist.</div>';
                    }
                    return $error;
                }
                
                if(isset($_POST["submit"])){
                    if(!empty($_POST['email'])) $email = trim($_POST['email']);
                    
                    $error = errorDetect();
                    
                    if(empty($error) == TRUE && emailExist($email) == true){
                        //random verification code
                        $verificationCode = random_int(100000, 999999);
                        setcookie('code', $verificationCode);
                        
                        //email message 
                        $subject = "TARUMT Game-Based Education System: Password Recovery Verification Code";
                        
                        $developmentMode = true;
                        $mail = new PHPMailer($developmentMode);
                        
                        //send email
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
                            $mail->Body = "Your verfication code for password recovery: <b>" . $verificationCode . 
                                    "</b><br/>Never tell the code to anyone!<br/><br/>From TARUMT Game-based Education System";
                            if ($mail->send()) {
                                echo"<script type='text/javascript'> 
                                location.replace('verifyCode.php?email={$email}')
                                alert('Please check your email: $email.\\nVerification code is sent to your email.')
                                </script>";
                            }
                        } catch (Exception $e) {
                            echo"<script type='text/javascript'> 
                            alert('Failed to send email. Info: " . $mail->ErrorInfo . " ')
                            </script>";
                        }
                    }
                }
                ?>
                
                <form action="verifyEmail.php" method="post" class="loginForm">
                    <label for="email">Email</label><br>
                    <input type="text" id="email" name="email" placeholder="Eg. abc@tarc.edu.my" value="<?php if(!empty($error)) echo $_POST['email']?>" required autofocus><br>
                    <?php
                        if(!empty($error['email'])){
                            echo $error['email'];
                        }
                    ?>
                    <input type="submit" name="submit" value="VERIFY" class="verifyBtn">
                </form> 
            </div>
        </div>
    </body>
</html>
