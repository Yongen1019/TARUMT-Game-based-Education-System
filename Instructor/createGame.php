<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create Game</title>
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

            .userProfileFormContainer{
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 30px 20px;
                width: 50%;
                margin: 150px auto;
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
            
            .addBtn {
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
                width: 70%;
                margin-bottom: 20px;
                cursor:default;
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
                <div class="userProfileFormContainer">
                    <?php
                    $instructorID = $_GET['instructorID'];
                    $classID = $_GET['classID'];
                    $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                    
                    // find latest game id 
                    $findLastID = "SELECT * FROM GAME
                                    ORDER BY gameID DESC LIMIT 1";
                    $findresult = $con->query($findLastID);
                    if ($findresult) {
                        while ($row = $findresult->fetch_assoc()){
                            $latestGameID = $row["gameID"];
                            $latestGameID++;
                        }
                    } else {
                        $latestGameID = "GA000001";
                    }
                    
                    function errorDetect(){
                        global $quizName;

                        $error = array();

                        if(strlen($quizName)>50){
                            $error['quizName'] = '<div class="errormsg"><b>Quiz Name</b> cannot be more than 50 characters.</div>';
                        }else if(!preg_match('/^[ A-Za-z0-9:-]*$/', $quizName)){
                            $error['quizName'] = '<div class="errormsg"><b>Quiz Name</b> cannot contain special characters except(:-).</div>';
                        }

                        return $error;
                    }
                    
                    if(isset($_POST["add"])){
                        if(!empty($_POST['quizName'])) $quizName = trim($_POST['quizName']);
                        
                        $error = errorDetect();
                        
                        if(empty($error) == TRUE){
                            $_SESSION['newQuizName'] = $quizName;
                            //add new game
                            $sql = "INSERT INTO Game(gameID, quizName, totalScore, classID)
                                    VALUES('$latestGameID', '$quizName', '0', '$classID')";

                            if ($con->query($sql) === TRUE) {
                                //find the latest game power ID
                                $findLastGID = "SELECT * FROM GamePower
                                                ORDER BY gamePowerID DESC LIMIT 1";

                                //execute find last id query
                                $findGresult = $con->query($findLastGID);
                                if ($findGresult) {
                                    while ($row = $findGresult->fetch_assoc()){
                                        $latestGamePowerID = $row["gamePowerID"];
                                        $latestGamePowerID++;
                                        $latestGamePowerID1 = $latestGamePowerID;
                                        $latestGamePowerID++;
                                        $latestGamePowerID2 = $latestGamePowerID;
                                        $latestGamePowerID++;
                                        $latestGamePowerID3 = $latestGamePowerID;
                                    }
                                } else {
                                    $latestGamePowerID1 = "GQ000001";
                                    $latestGamePowerID2 = "GQ000002";
                                    $latestGamePowerID3 = "GQ000003";
                                }
                                
                                //create default power
                                $power1Sql = "INSERT INTO GamePower(gamePowerID, status, pointExchange, gameID, powerID) VALUES
                                            ('$latestGamePowerID1', '1', '0', '$latestGameID', 'PO000001')";
                                $power2Sql = "INSERT INTO GamePower(gamePowerID, status, pointExchange, gameID, powerID) VALUES
                                            ('$latestGamePowerID2', '1', '0', '$latestGameID', 'PO000002')";
                                $power3Sql = "INSERT INTO GamePower(gamePowerID, status, pointExchange, gameID, powerID) VALUES
                                            ('$latestGamePowerID3', '1', '0', '$latestGameID', 'PO000003')";
                                
                                if($con->query($power1Sql) == true){
                                    if($con->query($power2Sql) == true){
                                        if($con->query($power3Sql) == true){
                                            echo"<script type='text/javascript'> 
                                            location.replace('game.php?instructorID={$instructorID}&classID={$classID}&gameID={$latestGameID}')
                                            alert('You are allowed to create a game with 0 questions, you can add questions afterwards by clicking the \'Edit Game\' button.')
                                             </script>";
                                        }   
                                    }
                                }else{
                                    
                                }
                            } else {
                                echo"<script type='text/javascript'> 
                                    location.replace('classroom.php?instructorID={$instructorID}&classID={$classID}')
                                    alert('Failed to create game.')
                                     </script>";
                            }
                        }
                    }
                    $con->close();
                    
                    ?>
                    <form action="" method="post" >
                        <label for="gameID">Game ID</label><br>
                        <input type="text" id="gameID" name="gameID" value="<?php echo $latestGameID;?>" disabled><br>
                        <label for="quizName">Quiz Name</label><br>
                        <input type="text" id="quizName" name="quizName" placeholder="Eg. Quiz: Chapter 1" value="<?php if(!empty($error)) echo $quizName?>" autofocus required><br>
                        <?php
                            if(!empty($error['quizName'])){
                                echo $error['quizName'];
                            }
                        ?>
                        <input type="submit" name="add" value="ADD" class="addBtn">                    
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
