<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Student Profile</title>
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
            
            .editBtnContainer{
                margin: 20px auto 20px auto;
            }
            
            #editBtn {
                background-color: #812928;
                color: white;
                padding: 14px 78px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                letter-spacing: 2px;
                text-decoration: none;
                font-size: 14px;
            }
            
            .editBtn a{
                color:white;
                
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
            
            .infoContainer{
                text-align: center;
                line-height: 30px;
                margin-bottom: 30px;
            }
            
            .contactStudContainer a{
                background-color: #812928;
                color: white;
                padding: 14px 50px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                letter-spacing: 2px;
                text-decoration: none;
                font-size: 14px;
                text-transform: uppercase;
            }
            
            .contactStudContainer{
                margin-top: 40px;
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
                $classID = $_GET['classID'];
                $studentID = $_GET['studentID'];
                ?>
                <a href="classroom.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">Classroom</a>
                <a href="studentList.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">Student List</a>
                <div class="backBtn">
                    <a href="studentList.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">back</a>
                </div>
            </div>
            <?php
                $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                $query = "select * from instructorAccount WHERE instructorID = '$instructorID'";
                $result = $con->query($query);

                if($result){
                    while($row = $result->fetch_assoc()){
                        $profilePicture = $row["profilePicture"];
                        $instructorName = $row["instructorName"];
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
                    $query = "select * from studentAccount WHERE studentID = '$studentID'";
                    $result = $con->query($query);

                    if($result){
                        while($row = $result->fetch_assoc()){
                            $studentEmail = $row["email"];
                            $studentName = ucwords($row["studentName"]);
                            $username = $row["username"];
                            $profilePicture = $row["profilePicture"];
                            $gender = $row["gender"];
                        }
                    }
                    $con->close();
                    
                    ?>
                        <div class="upload">
                            <img class="userProfilePic" src="../Student/img/<?php echo$profilePicture;?>" alt="<?php echo$profilePicture;?>" /><br>
                        </div>
                        
                        <div class="infoContainer">
                            <?php
                            if($gender == 'F'){
                                echo"<p><i style='font-size:16px;font-weight: 800;color:salmon;' class='fa'>&#xf221;</i> ";
                                echo"$studentName ($username)</p>";
                            }else if($gender == 'M'){
                                echo"<p><i style='font-size:16px;font-weight: 800;color:blue;' class='fa'>&#xf222;</i> ";
                                echo"$studentName ($username)</p>";
                            }
                            ?>
                            <p><i style="font-size:14px;font-weight: 800;color:#541b1a;" class="fa">&#xf003;</i> <?php echo $studentEmail; ?></p>
                            <div class="contactStudContainer">
                                <a href="mailto:<?php echo"$studentEmail";?>?Subject=An email from instructor(<?php echo$instructorName;?>)&body=Dear Student, ">
                                 contact student</a>
                            </div>
                        </div>
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
