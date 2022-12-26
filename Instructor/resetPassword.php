<html>
    <head>
        <meta charset="UTF-8">
        <title>Password Recovery</title>
        <link rel="stylesheet" href="style.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            
            
            .resetBtn {
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
            .tooltip {
                position: relative;
                display: inline-block;
                cursor: default;
            }

            .tooltip .tooltiptext {
                font-size: 12px;
                padding: 2px 10px;
                visibility: hidden;
                width: 230px;
                background-color: #541b1a;
                color: #fff;
                text-align: center;
                border-radius: 50px;
                margin-left: 2px;
                /* Position the tooltip */
                position: absolute;
                z-index: 1;
                top:-10px;
            }

            .tooltip:hover .tooltiptext {
                visibility: visible;
            }
            /*Form End*/
        </style>
    </head>
    <body>
        <div class="loginTopNavBar">
            <p>TARUMT Game-based Teaching System</p>
        </div>
        <div class="goBackBtn">
            <button class="backBtn" onclick="location.href = '../Instructor/login.php';">
                <i style='font-size:20px;color: #541b1a; cursor: pointer;' class='fas'>&#xf137;</i>
                <span style="font-size:20px;text-transform: uppercase;color: #541b1a;font-weight: 600;cursor: pointer;">Back</span>
            </button>
        </div>
        <div class="loginContent">
            <img class="logoImage" src="../tarumt-logo.png" alt="TARUMT LOGO" height="100px;">
            <h1>Password Recovery</h1>
            
            <div class="loginFormContainer">
                <?php
                $instructorID = $_GET['instructorID'];
                if($instructorID != null){
                    define('directAccess', TRUE);
                }
                
                function errorDetect(){
                    global $password, $confirmNewPassword;

                    $error = array();

                    //Minimum eight characters, at least one letter and one number:
                    if(strlen($password)<8){
                        $error['password'] = '<div class="errormsg"><b>New Password</b> must be at least 8 characters long.</div>';
                    }else if(!preg_match('^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$^', $password)){
                        $error['password'] = '<div class="errormsg">Invalid format of <b>New Password</b>, at least one letter and one number.</div>';
                    }else if(strcmp($password, $confirmNewPassword)){
                        $error['confirmNewPassword'] = '<div class="errormsg"><b>Confirm New Password</b> is mismatched with new password.</div>';
                    }
                    
                    return $error;
                }
                
                if(isset($_POST["submit"])){
                    if(!empty($_POST['password'])) $password = trim($_POST['password']);
                    if(!empty($_POST['password'])) $confirmNewPassword = trim($_POST['confirmNewPassword']);
                    
                    $error = errorDetect();
                    
                    if(empty($error)){
                        //hashed password
                        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
                                
                        //update password
                        $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                        
                        $query = "UPDATE InstructorAccount 
                                  SET password = '$passwordHashed' 
                                  WHERE instructorID = '$instructorID'";

                        if($con->query($query) == true){
                            echo"<script type='text/javascript'> 
                                location.replace('login.php')
                                alert('Your password has been successfully reset.');
                             </script>";
                            $passwordHashed = null;
                        }else{
                            echo"<script type='text/javascript'> 
                                location.replace('login.php')
                                alert('Failed to reset password, please try again.');
                             </script>";
                        }
                        $con->close();
                    }
                }
                ?>
                <form action="resetPassword.php?<?php echo "instructorID=$instructorID" ?>" method="post" class="loginForm">
                    <label for="password">New Password</label>
                    <div class="tooltip"><i style="font-size:16px" class="fa">&#xf29c;</i>
                        <span class="tooltiptext">Password must be at least 8 characters, minimum 1 letter and number.</span>
                    </div>
                    <br>
                    <input type="password" id="password" name="password" value="<?php if(!empty($error)) echo $_POST['password']?>"  required autofocus>
                    <input id="showPwCheckBox" type="checkbox" onclick="showPassword()" ><span id="showPwTxt">Show Password</span>
                    
                    <br>
                    <?php
                        if(!empty($error['password'])){
                            echo $error['password'];
                        }
                    ?>
                    <br>
                    <label for="password">Confirmed New Password</label><br>
                        <input type="password" id="confirmNewPassword" name="confirmNewPassword" value="<?php if(!empty($error)) echo $_POST['confirmNewPassword']?>" required>
                        <input id="showPwCheckBox" type="checkbox" onclick="showConfirmNewPassword()"><span id="showPwTxt">Show Password</span><br>
                    <?php
                            if(!empty($error['confirmNewPassword'])){
                                echo $error['confirmNewPassword'];
                            }
                        ?>
                    
                    <script>
                        function showPassword() {
                          var x = document.getElementById("password");
                          if (x.type === "password") {
                            x.type = "text";
                          } else {
                            x.type = "password";
                          }
                        }
                        
                        function showConfirmNewPassword() {
                              var x = document.getElementById("confirmNewPassword");
                              if (x.type === "password") {
                                x.type = "text";
                              } else {
                                x.type = "password";
                              }
                            }
                    </script>
                    
                    <input type="submit" name="submit" value="RESET" class="resetBtn">
                </form> 
            </div>
        </div>
        <?php
        if(!defined('directAccess')){
            echo"<script type='text/javascript'> 
                location.replace('login.php')
                alert('Direct access not permitted, please login first.')
                 </script>";
        }
        ?>
    </body>
</html>
