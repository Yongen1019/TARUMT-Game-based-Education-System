<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
define('directAccess', TRUE);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="style.css" />
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
                margin-top: 50px;
                margin-bottom: 50px;
            }
            
            h1{
                color: #541b1a;
            }
            
            /*Form Start*/
           
            .loginFormContainer{
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 30px 20px;
                width: 300px;
                margin: 35px auto;
            }
            
            input[type=text], input[type=password] {
                width: 100%;
                padding: 12px 10px;
                margin: 10px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            
            .loginBtn {
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
            
            #showPwCheckBox{
                accent-color: #812928;
                width: 15px;
                height: 15px;
                margin-right: 5px;
            }
            
            #showPwTxt{
                font-size: 12px;
                vertical-align: text-top;
            }
            
            .forgetPwTxt{
                text-align: right;
                margin-right: 8px;
                margin-top: 15px;
            }
            
            .forgetPwTxt a{
                font-size: 12px;
                text-decoration: underline;
                color: #997c7c;
            }
            
            
            .errormsg{
                margin-bottom: 10px;
                padding-bottom: 0;
                color: red;
                font-size: 13px;
            }
            
            /*Form End*/
            
            .fixed-left-bottom-btn{
                position: fixed;
                bottom:20px;
                left:20px;
            }
            
            .studentLoginTxt a{
                text-decoration: none;
                text-transform: capitalize;
                background-color: #997c7c;
                color:white;
                padding: 7px 15px;
                border-radius: 2px;
            }
        </style>
    </head>
    <body>
        <div class="loginTopNavBar">
            <p>TARUMT Game-based Teaching System</p>
        </div>
        <div class="loginContent">
            <img class="logoImage" src="../tarumt-logo.png" alt="TARUMT LOGO" height="100px;">
            <h1>Instructor Login</h1>
            
            <div class="loginFormContainer">
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
                                $instructorName = $row["instructorName"];
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

                    $query = "SELECT * FROM InstructorAccount WHERE password = '$password' AND email = '$email'";
                    $decryptQuery = "SELECT password FROM InstructorAccount WHERE email = '$email'";
                    
                    //if default password
                    if(is_numeric($password) == 1){
                        if($result = $con->query($query)){
                            if($result->num_rows > 0)
                            {
                                $match = true;
                            }
                        }
                    }else{ //password changed
                        $result = $con->query($decryptQuery);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $passwordDB = $row["password"];
                                $verify = password_verify($password, $passwordDB);
                                if($verify){
                                    $match = true;
                                }else{
                                    $match = false;
                                }
                            }
                        } else {
                            $match = false;
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
                    }else if(emailExist($email) == true){
                        if(passwordMatch($password, $email) == false){
                            $error['password'] = '<div class="errormsg"><b>Password</b> incorrect.</div>';
                        }
                    }
                    
                    return $error;
                }
                
                if(isset($_POST["submit"])){
                    if(!empty($_POST['email'])) $email = trim($_POST['email']);
                    if(!empty($_POST['password'])) $password = trim($_POST['password']);
                    
                    $error = errorDetect();
                    
                    if(empty($error) == TRUE){
                        if(emailExist($email) == true){
                            if(passwordMatch($password, $email)== true){
                                $username = ucwords($instructorName);

                                $_SESSION['email'] = $_POST['email'];

                                echo"<script type='text/javascript'> 
                                        location.replace('homepage.php?instructorID={$instructorID}')
                                        alert('Welcome, $username')
                                     </script>";
                                    define('directAccess', TRUE);
                            }
                        }   
                    }
                }
                ?>
                
                <form action="login.php" method="post" class="loginForm">
                    <label for="email">Email</label><br>
                    <input type="text" id="email" name="email" placeholder="Eg. abc@tarc.edu.my" 
                           value="<?php if(!empty($error)) echo $_POST['email']?>" required autofocus>
                    <br>
                    <?php
                        if(!empty($error['email'])){
                            echo $error['email'];
                        }
                    ?>
                    <label for="password">Password</label><br>
                    <input type="password" id="password" name="password" required>
                    <input id="showPwCheckBox" type="checkbox" onclick="showPassword()"><span id="showPwTxt">Show Password</span>
                    <?php
                        if(!empty($error['password'])){
                            echo $error['password'];
                        }
                    ?>
                    <div class="forgetPwTxt"><a href="verifyEmail.php">Forget Password?</a></div>
                    <script>
                        function showPassword() {
                          var x = document.getElementById("password");
                          if (x.type === "password") {
                            x.type = "text";
                          } else {
                            x.type = "password";
                          }
                        }
                    </script>
                    <input type="submit" name="submit" value="LOGIN" class="loginBtn">
                </form> 
            </div>
        </div>
        <div class="fixed-left-bottom-btn">
            <p class="studentLoginTxt"><a href="../Student/login.php">Student login</a></p>
        </div>
    </body>
</html>
