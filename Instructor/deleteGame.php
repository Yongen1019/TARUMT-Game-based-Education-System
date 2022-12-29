<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete Game</title>
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

            .deleteClassBtn {
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
            
            .errormsg{
                margin-bottom: 10px;
                padding-bottom: 0;
                color: red;
                font-size: 13px;
            }
            /*Form End*/
        </style>
        <script>            
            function deleteGame() {
              let text = "Are you sure to the game?\nPress OK to delete.";
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
                $gameID = $_GET['gameID'];
                ?>
                <a href="classroom.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">Classroom</a>
                <a href="studentList.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">Student List</a>
                <div class="backBtn">
                    <a href="classroom.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">cancel</a>
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
                <h1>Delete Game</h1>
                <?php
                $instructorID = $_GET['instructorID'];
                $classID = $_GET['classID'];
                $gameID = $_GET['gameID'];
                $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                
                $classQuery = "select * from classroom WHERE classID = '$classID'";
                $classResult = $con->query($classQuery);
                
                if($classResult){
                    while($row = $classResult->fetch_assoc()){
                        $className = $row["className"];
                        $classSubject = $row["classSubject"];
                    }
                }
                
                $gameQuery = "select * from game WHERE gameID = '$gameID'";
                $gameResult = $con->query($gameQuery);
                
                if($gameResult){
                    while($row = $gameResult->fetch_assoc()){
                        $quizName = $row["quizName"];
                    }
                }
                
                if(isset($_POST["delete"])){
                    
                    //check any student play before? score in database

                    $findScoreSql = "select * from score WHERE gameID = '$gameID'";
                    $findScoreResult = $con->query($findScoreSql);

                    if($findScoreResult->num_rows > 0){
                        //if got score result means that have student played before
                        //then game could not be deleted
                        echo"<script type='text/javascript'> 
                            location.replace('classroom.php?instructorID={$instructorID}&classID={$classID}')
                            alert('Failed to delete quiz, there are students participated in the game.')
                             </script>";
                    }else{
                        //del power
                        $delPowerSql = "DELETE FROM GamePower WHERE gameID = '$gameID'";

                        if ($con->query($delPowerSql) === TRUE) {

                            //find question ID
                            $findQID = "select * from GameQuestion WHERE gameID = '$gameID'";
                            $findQresult = $con->query($findQID);
                            if ($findQresult) {
                                while ($row = $findQresult->fetch_assoc()){
                                    $questionID = $row["questionID"];
                                    //del answer
                                    $delAnsSql = "DELETE FROM AnswerOption WHERE questionID = '$questionID'";
                                    if ($con->query($delAnsSql) === TRUE) {
                                        //del question
                                        $delQuestionSql = "DELETE FROM GameQuestion WHERE gameID = '$gameID'";
                                        $con->query($delQuestionSql);
                                    }
                                }
                            }

                            //del whole game
                            $delGameSql = "DELETE FROM Game WHERE gameID = '$gameID'";

                            if ($con->query($delGameSql) === TRUE) {
                                echo"<script type='text/javascript'> 
                                    location.replace('classroom.php?instructorID={$instructorID}&classID={$classID}')
                                    alert('Quiz deleted.')
                                     </script>";
                            } else {
                                echo"<script type='text/javascript'> 
                                    location.replace('classroom.php?instructorID={$instructorID}&classID={$classID}')
                                    alert('Failed to delete quiz.')
                                     </script>";
                            }
                        }
                    }
                }
                $con->close();
                ?>
                
                <div class="addClassFormContainer">
                    <form method='POST' class="addClassForm"  onsubmit="return deleteGame();">
                        <label for="className">Classroom Name</label><br>
                        <input type="text" id="className" name="className" value="<?php echo$className;?>" disabled><br>
                        
                        <label for="classSubject">Subject</label><br>
                        <input type="text" id="classSubject" name="classSubject" value="<?php echo$classSubject;?>" disabled><br>
                        
                        
                        <label for="quizName">Quiz Name</label><br>
                        <input type="text" id="quizName" name="quizName" value="<?php echo $quizName;?>" disabled><br>
                        
                        <input type="submit" name="delete" value="DELETE QUIZ" class="deleteClassBtn">
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
