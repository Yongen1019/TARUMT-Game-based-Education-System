<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit User Profile</title>
        <link rel="stylesheet" href="style.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        
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
            
            .profilePic { 
                float:left;
                border-radius: 50%; 
                display: block;
                height: 40px;
                width: 40px;
                cursor:pointer;
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

            .userProfileFormContainer{
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 30px 20px;
                width: 300px;
                margin: 15px auto 40px auto;
                box-shadow: 1px 2px 9px 0px rgba(153, 124, 124, 0.3);
            }

            input[type=text]{
                width: 100%;
                padding: 12px 10px;
                margin: 10px 0 22px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                
            }
            
            .editBtn {
                width: 100%;
                background-color: #812928;
                color: white;
                padding: 14px 20px;
                margin-top: 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                letter-spacing: 2px;
            }
            
            .userProfilePic{
                border-radius: 50%; 
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 200px;
                height: 200px;
                margin-bottom: 20px;
            }

            .upload{
              position: relative;
            }

            .upload .round{
              position: absolute;
              bottom: 0;
              right: 0;
              padding: 3px 1px 0px 1px;
              background: #541b1a;
              width: 25px;
              height: 20px;
              line-height: 2px;
              text-align: center;
              border-radius: 50%;
              overflow: hidden;
            }

            .upload .round input[type = "file"]{
              position: absolute;
              transform: scale(2);
              opacity: 0;
            }

            input[type=file]::-webkit-file-upload-button{
                cursor: pointer;
            }
            
            .errormsg{
                margin-bottom: 10px;
                padding-bottom: 0;
                color: red;
                font-size: 13px;
            }
            
            .imgErrormsg{
                margin-bottom: 15px;
                color: red;
                font-size: 13px;
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
                <a href="changePassword.php?<?php echo"instructorID={$instructorID}";?>">Change Password</a>
                <div class="backBtn">
                    <a href="userProfile.php?<?php echo"instructorID={$instructorID}";?>">Cancel</a>
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
                                    <img class="profilePic" src="profileImage/<?php echo$profilePicture;?>"/>
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
                <div class="userProfileFormContainer">
                        
                    <?php
                    $instructorID = $_GET['instructorID'];
                    $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                    $query = "select * from instructorAccount WHERE instructorID = '$instructorID'";
                    $result = $con->query($query);

                    if($result){
                        while($row = $result->fetch_assoc()){
                            $email = $row["email"];
                            $instructorName = $row["instructorName"];
                            $username = $row["username"];
                            $profilePicture = $row["profilePicture"];
                        }
                    }
                    
                    //check image
                    if(isset($_FILES["image"]["name"])){
                        $err = array();
                        $file_name = $_FILES['image']['name'];
                        $file_size = $_FILES['image']['size'];
                        $file_tmp = $_FILES['image']['tmp_name'];
                        
                        $file_type = $_FILES['image']['type'];
                        $file_ext = explode('.', $file_name);
                        $file_ext = strtolower(end($file_ext));;
                        $fileError = $_FILES['image']['error'];

                        if($fileError > 0){
                            switch ($fileError){
                                case UPLOAD_ERR_NO_FILE:
                                $err = '<div class="imgErrormsg">No file chosen.</div>';
                                break;
                                case UPLOAD_ERR_FORM_SIZE:
                                $err = '<div class="imgErrormsg">File chosen size is too large.</div>';
                                break;
                                default:
                                $err = '<div class="imgErrormsg">Error occurs when uploading file.</div>';
                                break;
                            }
                        }else if($file_size > 1048576){
                            $err = '<div class="imgErrormsg">File uploaded is too large. Max 1MB allowed.</div>';
                        }else{
                            if($file_ext !='jpg' && $file_ext !='jpeg' && $file_ext !='gif' && $file_ext !='png'){
                                $err = '<div class="imgErrormsg">Only JPG, GIF and PNG format are allowed.</div>';
                            }else{
                                
                                $newFileName = $instructorID;
                                $newFileName .= '.' . $file_ext;
                                $sql = "UPDATE InstructorAccount 
                                    SET profilePicture = '$newFileName'
                                    WHERE instructorID = '$instructorID'";
                                

                                if ($con->query($sql) === TRUE) {
                                    if($profilePicture != "red.png" && $profilePicture != "blue.png"){
                                        unlink('profileImage/'.$profilePicture);
                                    }
                                    move_uploaded_file($file_tmp, "profileImage/" . $newFileName);
                                    echo"<script type='text/javascript'> 
                                        location.replace('userProfile.php?instructorID={$instructorID}')
                                        alert('Profile Image updated.')
                                         </script>";
                                } else {
                                    echo"<script type='text/javascript'> 
                                        location.replace('userProfile.php?instructorID={$instructorID}')
                                        alert('Failed to update profile image.')
                                         </script>";
                                }
                                
                            }
                        }

                        global $err;

                        if($err){
                            echo$err;
                        }
                    }
                    
                    function errorDetect(){
                        global $username;

                        $error = array();

                        if(strlen($username)>50){
                            $error['username'] = '<div class="errormsg"><b>Username</b> cannot be more than 50 characters.</div>';
                        }else if(!preg_match('/^[ A-Za-z0-9._-]*$/', $username)){
                            $error['username'] = '<div class="errormsg"><b>Username</b> cannot contain special characters except(-._).</div>';
                        }else if($username == ""){
                            $error['username'] = '<div class="errormsg"><b>Username</b> cannot be empty.</div>';
                        }

                        return $error;
                    }
                    
                    if(isset($_POST["edit"])){
                        $username = ucwords($_POST['username']);
                        
                        $error = errorDetect();
                        
                        if(empty($error) == TRUE){
                            $sql = "UPDATE InstructorAccount 
                                    SET username = '$username'
                                    WHERE instructorID = '$instructorID'";

                            if ($con->query($sql) === TRUE) {
                                echo"<script type='text/javascript'> 
                                    location.replace('userProfile.php?instructorID={$instructorID}')
                                    alert('User Profile updated.')
                                     </script>";
                            } else {
                                echo"<script type='text/javascript'> 
                                    location.replace('userProfile.php?instructorID={$instructorID}')
                                    alert('Failed to update user profile.')
                                     </script>";
                            }
                        }
                    }
                    $con->close();
                    
                    ?>
                    <form action="" method="post" id="form" enctype="multipart/form-data">
                        <div class="upload">
                            <img class="userProfilePic" src="profileImage/<?php echo$profilePicture;?>" alt="<?php echo$profilePicture;?>" /><br>
                            <div class="round">
                                <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                                <i class="fa fa-camera" style="color: #fff;"></i>
                            </div>
                        </div>
                    </form>
                    <form class="userProfileForm" method="post">
                        <label for="className">Email</label><br>
                        <input type="text" id="email" name="email" value="<?php echo $email; ?>" disabled><br>
                        <label for="className">Instructor Name</label><br>
                        <input type="text" id="instructorName" name="instructorName" value="<?php echo $instructorName; ?>" disabled><br>
                        <label for="className">Username</label><br>
                        <input type="text" id="username" name="username" value="<?php echo $username; ?>"><br>
                        <?php
                            if(!empty($error['username'])){
                                echo $error['username'];
                            }
                        ?>
                        <input type="submit" name="edit" value="EDIT" class="editBtn">                    
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
    <script type="text/javascript">
        document.getElementById("image").onchange = function () {
            document.getElementById("form").submit();
        };
    </script>
</html>
