<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete Classroom</title>
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

            input[type=text], textarea{
                width: 100%;
                padding: 12px 10px;
                margin: 10px 0 22px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .delClassBtn {
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
            
            /*Form End*/
        </style>
        <script>            
            function deleteClassroom() {
              let text = "Are you sure to delete the classroom?\nPress OK to delete.";
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
                ?>
                <a href="homepage.php?<?php echo"instructorID={$instructorID}";?>">Classroom List</a>
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
                <h1>Delete Classroom</h1>
                <?php
                $instructorID = $_GET['instructorID'];
                $classID = $_GET['classID'];
                $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                $query = "select * from classroom WHERE classID = '$classID'";
                $result = $con->query($query);
                
                if($result){
                    while($row = $result->fetch_assoc()){
                        $className = $row["className"];
                        $classDescription = $row["classDescription"];
                        $classSubject = $row["classSubject"];
                    }
                }
                if(isset($_POST["delete"])){
                    
                    //check student exist?
                    $checkStudentQuery = "select * from ClassroomJoined WHERE classID = '$classID'";
                    $checkStudentResult = $con->query($checkStudentQuery);
                    
                    if($checkStudentResult->num_rows > 0){
                        echo"<script type='text/javascript'> 
                            location.replace('homepage.php?instructorID={$instructorID}')
                            alert('Failed to delete classroom, already have student inside the classroom.')
                             </script>";
                    }else{
                        //check game set and delete it if exists
                        $checkGameQuery = "select * from Game WHERE classID = '$classID'";
                        $checkGameResult = $con->query($checkGameQuery);
                        
                        if ($checkGameResult->num_rows > 1) {
                            while ($row = $checkGameResult->fetch_assoc()){
                                $gameID = $row["gameID"];
                                
                                $delGamePowerSql = "DELETE FROM GamePower WHERE gameID = '$gameID'";
                                if($con->query($delGamePowerSql) === TRUE){
                                    $delGameSql = "DELETE FROM Game WHERE gameID = '$gameID' and classID = '$classID'";
                                    if ($con->query($delGameSql) === TRUE) {
                                        $delSql = "DELETE FROM Classroom WHERE classID = '$classID'";
                                        if ($con->query($delSql) === TRUE) {
                                            echo"<script type='text/javascript'> 
                                            location.replace('homepage.php?instructorID={$instructorID}')
                                            alert('Classroom deleted.')
                                             </script>";
                                        }else{
                                            echo"<script type='text/javascript'> 
                                            location.replace('homepage.php?instructorID={$instructorID}')
                                            alert('Failed to delete classroom, already have student inside the classroom.')
                                             </script>";
                                        }
                                    } 
                                }
                            }
                        }else{
                            $delSql = "DELETE FROM Classroom WHERE classID = '$classID'";
                            if ($con->query($delSql) === TRUE) {
                                echo"<script type='text/javascript'> 
                                    location.replace('homepage.php?instructorID={$instructorID}')
                                    alert('Classroom deleted.')
                                     </script>";
                            } else {
                                echo"<script type='text/javascript'> 
                                    location.replace('homepage.php?instructorID={$instructorID}')
                                    alert('Failed to delete classroom, already have student inside the classroom.')
                                     </script>";
                            }
                        }
                    }
                }
                $con->close();
                ?>
                <div class="addClassFormContainer">
                    <form method="post" class="addClassForm" onsubmit="return deleteClassroom();">
                        <label for="className">Classroom Name</label><br>
                        <input type="text" id="className" name="className" value="<?php echo $className; ?>" disabled><br>
                        <label for="classDesc">Description</label><br>
                        <textarea style="resize:none" id="classDesc" name="classDesc" rows="6" cols="39" disabled><?php echo $classDescription; ?></textarea><br>
                        <label for="classSubject">Subject</label><br>
                        <input type="text" id="classSubject" name="classSubject" value="<?php echo $classSubject; ?>" disabled><br>

                        <input type="submit" name="delete" value="DELETE CLASS" class="delClassBtn">
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
