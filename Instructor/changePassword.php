<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Change Password</title>
        <link rel="stylesheet" href="style.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .profileBtn{
                background-color: #fffafa;
                margin-left: 15px;
                border:none;
                font-weight: bold;
                color: #812928;
                vertical-align: top;
                width: 38px;
            }
            
            .contentTopNavBar ul li{
                display: inline;
            }
            
            h1{
                color: #541b1a;
                text-align: center;
                font-size: 20px;
                margin-top: 20px;
                font-weight: 550;
            }
            
            .backBtn{
                position: absolute;
                bottom: 0px;
                width: 100%;
                text-transform: uppercase;
                text-align: center;
                font-weight: 600;
                letter-spacing: 1px;
                font-size: 22px;
            }

            .backBtn a{
                color: #541b1a;
            }
            /*Form Start*/

            .addClassFormContainer{
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 30px 20px;
                width: 300px;
                margin: 15px auto;
                box-shadow: 1px 2px 9px 0px rgba(153, 124, 124, 0.3);
            }

            input[type=text], input[type=password]{
                width: 100%;
                padding: 12px 10px;
                margin: 10px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            
            #showPwCheckBox{
                accent-color: #812928;
                width: 15px;
                height: 15px;
                margin-right: 5px;
                margin-left: 2px;
            }
            
            #showPwTxt{
                font-size: 12px;
                vertical-align: text-top;
            }
            
            
            .saveBtn {
                width: 100%;
                background-color: #812928;
                color: white;
                padding: 14px 20px;
                margin-top: 30px;
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
        <?php
        if($_SESSION["email"]) {
            define('directAccess', TRUE);
        ?>
            <!-- The sidebar -->
            <div class="sidebar">
                <?php
                $instructorID = $_GET['instructorID'];
                ?>
                <a href="userProfile.php?<?php echo"instructorID={$instructorID}";?>">User Profile</a>
                <a class="active" href="changePassword.php?<?php echo"instructorID={$instructorID}";?>">Change Password</a>
                <div class="backBtn">
                    <a href="homepage.php?<?php echo"instructorID={$instructorID}";?>">cancel</a>
                </div>
            </div>
            <?php
                $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                $query = "select * from instructorAccount WHERE instructorID = '$instructorID'";
                $result = $con->query($query);

                if($result){
                    while($row = $result->fetch_assoc()){
                        $profilePicture = $row["profilePicture"];
                    }
                }
            ?>
            <!-- Page content -->
            <div class="content">
                <!-- Page content: TOP navigation bar -->
                <div class="contentTopNavBar">
                    <a href="#"  style="color: #541b1a;font-weight: 650;">TARUMT Game-based Teaching System</a>
                    <div class="usernamePosition">
                        <ul>
                            <li>
                                <button  onclick="window.location.href='userProfile.php?<?php echo"instructorID={$instructorID}";?>'" class="profileBtn">
                                    <img class="profilePic" src="profileImage/<?php echo$profilePicture; ?>" />
                                </button>
                            </li>
                            <li>
                                <a href="logout.php" id="logoutBtn">logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            <!-- Page content: Main Content -->
            <div class="contentMiddle">
                <h1>Change Current Password</h1>
                <div class="addClassFormContainer">
                    
                    <?php
                    $instructorID = $_GET['instructorID'];
                    $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                    $query = "select * from instructorAccount WHERE instructorID = '$instructorID'";
                    $result = $con->query($query);

                    if($result){
                        while($row = $result->fetch_assoc()){
                            $passwordDB = $row["password"];
                        }
                    }
                    
                    function errorDetect(){
                        global $passwordDB, $currentPassword, $newPassword, $confirmNewPassword;

                        $error = array();
                        $verify = 0;
                        
                        //compare password
                        //if default password
                        if(is_numeric($currentPassword) == 1){
                            if($currentPassword == $passwordDB){
                                $verify = TRUE;
                            }
                        }else{ //password changed
                            $verify = password_verify($currentPassword, $passwordDB);
                        }
                        
                        if($verify == FALSE){
                            $error['currentPassword'] = '<div class="errormsg"><b>Current Password</b> is incorrect.</div>';
                        }else if(strlen($newPassword)<8){
                            $error['newPassword'] = '<div class="errormsg"><b>Password</b> must be at least 8 characters long.</div>';
                        }else if(!preg_match('^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$^', $newPassword)){
                            $error['newPassword'] = '<div class="errormsg">Invalid format of <b>Password</b>, at least one letter and one number.</div>';
                        }else if(strcmp($newPassword, $confirmNewPassword)){
                            $error['confirmNewPassword'] = '<div class="errormsg"><b>Confirm New Password</b> is mismatched with new password.</div>';
                        }

                        return $error;
                    }
                    
                    if(isset($_POST["save"])){
                        $currentPassword = $_POST['currentPassword'];
                        $newPassword = $_POST['newPassword'];
                        $confirmNewPassword = $_POST['confirmNewPassword'];
                        
                        $error = errorDetect();
                        
                        if(empty($error) == TRUE){
                            //hashed password
                            $passwordHashed = password_hash($newPassword, PASSWORD_DEFAULT);
                            
                            $updateSql = "UPDATE InstructorAccount 
                                    SET password = '$passwordHashed'
                                    WHERE instructorID = '$instructorID'";

                            if ($con->query($updateSql) === TRUE) {
                                echo"<script type='text/javascript'> 
                                    location.replace('userProfile.php?instructorID={$instructorID}')
                                    alert('Password successfully reset.')
                                     </script>";
                            } else {
                                echo"<script type='text/javascript'> 
                                    location.replace('userProfile.php?instructorID={$instructorID}')
                                    alert('Failed to reset password.')
                                     </script>";
                            }
                        }
                    }
                    $con->close();
                    ?>
                    
                    <form action="" method="post" class="addClassForm">
                        <label for="password">Current Password</label><br>
                        <input type="password" id="currentPassword" name="currentPassword" value="<?php if(!empty($error)) echo $_POST['currentPassword']?>" autofocus required>
                        <input id="showPwCheckBox" type="checkbox" onclick="showCurrentPassword()"><span id="showPwTxt">Show Password</span><br>
                        <?php
                            if(!empty($error['currentPassword'])){
                                echo $error['currentPassword'];
                            }
                            ?><br>
                        <label for="password">New Password</label>
                        <div class="tooltip"><i style="font-size:16px" class="fa">&#xf29c;</i>
                            <span class="tooltiptext">Password must be at least 8 characters, minimum 1 letter and number.</span>
                        </div>
                        <br>
                        <input type="password" id="newPassword" name="newPassword"  value="<?php if(!empty($error)) echo $_POST['newPassword']?>" required>
                        <input id="showPwCheckBox" type="checkbox" onclick="showNewPassword()"><span id="showPwTxt">Show Password</span><br>
                        <?php
                            if(!empty($error['newPassword'])){
                                echo $error['newPassword'];
                            }
                        ?><br>
                        <label for="password">Confirmed New Password</label><br>
                        <input type="password" id="confirmNewPassword" name="confirmNewPassword"  value="<?php if(!empty($error)) echo $_POST['confirmNewPassword']?>" required>
                        <input id="showPwCheckBox" type="checkbox" onclick="showConfirmNewPassword()"><span id="showPwTxt">Show Password</span><br>
                        <?php
                            if(!empty($error['confirmNewPassword'])){
                                echo $error['confirmNewPassword'];
                            }
                        ?>
                        <script>
                            function showCurrentPassword() {
                              var x = document.getElementById("currentPassword");
                              if (x.type === "password") {
                                x.type = "text";
                              } else {
                                x.type = "password";
                              }
                            }
                            
                            function showNewPassword() {
                              var x = document.getElementById("newPassword");
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

                        <input type="submit" name="save" value="SAVE" class="saveBtn">
                    </form> 
                </div>
            </div>
        </div>
        <?php
            if(!defined('directAccess')){
                echo"<script type='text/javascript'> 
                    location.replace('login.php')
                    alert('Direct access not permitted, please login first.')
                     </script>";
            }
        }else {
            echo '<script type="text/javascript">'; 
            echo 'alert("Please login first to continue.");'; 
            echo 'window.location.href = "login.php";';
            echo '</script>';
        };
        ?>
    </body>
</html>
