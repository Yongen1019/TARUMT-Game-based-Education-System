<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Remove Student</title>
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

            .userProfileFormContainer{
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 30px 20px;
                width: 300px;
                margin: 15px auto;
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
            
            .removeBtn {
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
                width: 230px;
                height: 230px;
                margin-bottom: 20px;
                cursor:default;
            }
            
            .errormsg{
                margin-bottom: 10px;
                padding-bottom: 0;
                color: red;
                font-size: 13px;
            }
            
            .infoContainer{
                text-align: center;
                line-height: 30px;
                margin-bottom: 30px;
            }
            /*Form End*/
        </style>
        <script>            
            function removeStudent() {
              let text = "Are you sure to remove the student from classroom?\nPress OK to remove.";
              if (confirm(text)) {
                return true;
              }
              return false;
            }
        </script>
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
                ?>
                <a href="classroom.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">Classroom</a>
                <a href="studentList.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">Student List</a>
                
                <div class="backBtn">
                    <a href="studentList.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">cancel</a>
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
                                    <img class="profilePic" src="profileImage/<?php echo$profilePicture;?>" />
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
                    $classID = $_GET['classID'];
                    $studentID = $_GET['studentID'];
                    $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                    $query = "select * from StudentAccount WHERE studentID = '$studentID'";
                    $result = $con->query($query);

                    if($result){
                        while($row = $result->fetch_assoc()){
                            $email = $row["email"];
                            $username = $row["username"];
                            $gender = $row["gender"];
                            $studentName = ucwords($row["studentName"]);
                            $profilePicture = $row["profilePicture"];
                        }
                    }
                    
                    if(isset($_POST["remove"])){

                        $sql = "DELETE FROM ClassroomJoined 
                                WHERE classID = '$classID' AND
                                studentID = '$studentID'";

                        if ($con->query($sql) === TRUE) {
                            echo"<script type='text/javascript'> 
                                location.replace('studentList.php?instructorID={$instructorID}&classID={$classID}')
                                alert('Student removed from classroom.')
                                 </script>";
                        } else {
                            echo"<script type='text/javascript'> 
                                location.replace('studentList.php?instructorID={$instructorID}&classID={$classID}')
                                alert('Failed to remove student.')
                                 </script>";
                        }
                    }
                    $con->close();
                    
                    ?>
                    <form action="" method="post"  onsubmit="return removeStudent();">
                        <div class="upload">
                            <img class="userProfilePic" src="../Student/img/<?php echo$profilePicture;?>" alt="<?php echo$profilePicture;?>" /><br>
                        </div>
                        
                        <div class="infoContainer">
                            <?php
                            if($gender == 'F'){
                                echo"<p><i style='font-size:16px;font-weight: 800;color:salmon;' class='fa'>&#xf221;</i> ";
                            }else if($gender == 'M'){
                                echo"<p><i style='font-size:16px;font-weight: 800;color:blue;' class='fa'>&#xf222;</i> ";
                            }
                            echo"$studentName</p>";
                            ?>
                            <p><i style="font-size:14px;font-weight: 800;color:#541b1a;" class="fa">&#xf003;</i> <?php echo $email; ?></p>
                        </div>
                        <label for="className">Username</label><br>
                        <input type="text" id="username" name="username" value="<?php echo $username; ?>" disabled><br>
                        
                        <input type="submit" name="remove" value="REMOVE STUDENT" class="removeBtn">                    
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
