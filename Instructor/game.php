<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Game</title>
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
            
            .contentTopNavBar ul li{
                display: inline;
            }
            
            .classroom{
                position: absolute;
                bottom: 10px;
                width: 100%;
            }
            
            .homeBtn{
                position: absolute;
                bottom: 0px;
                width: 100%;
                text-transform: uppercase;
                text-align: center;
                font-weight: 600;
                letter-spacing: 1px;
                font-size: 22px;
            }
            
            .homeBtn a{
                color: #541b1a;
            }
            
            .questionType{
                border:none;
                font-size: 16px;
                color: white;
                text-decoration: none;
                margin-left: 10px;
                background-color: #997c7c;
                padding: 10px 20px;
                border-radius: 2px;
            }
            
            .btnSelections{
                margin-left: 45px;
                margin-top: 10px;
                margin-bottom: 35px;
            }
            
            .questionType:hover{
                box-shadow: 1px 1px 5px rgba(153, 124, 124, 0.7);
            }
            
            
            /*Question List Start*/
            
            .titleBar{
                margin: 10px 35px;
                max-width: 100%;
                border-radius: 10px;
                padding: 10px 20px;
                position: relative;
                color: #541b1a;
                font-weight: 600;
                font-size: 22px;
            }
            
            .quizTotalScore{
                font-size: 18px;
                opacity:0.8;
                padding: 8px 0;
            }
            
            .quizCount{
                margin-left: 70px;
                color: #541b1a;
            }
            
            #quizCountTxt{
                text-transform: capitalize;
                font-weight: 500;
            }
            
            .menuButtonContainer{
                float: right;
            } 
            
            .gameQuiz{
                border: 2px solid #812928;
                border-radius: 10px;
                max-width: 100%;
                min-height: 100px;
                padding: 20px;
                margin: 10px 60px 35px 60px;
                color: #541b1a;
                background-color: white;
            }
            
                /*----------- Quiz Design Start ------------*/
                
                .classroomTxt{
                    text-transform: capitalize;
                }
                
                .quizName, .quizDesc, .quizScore, .quizTotalQuestion{
                    padding: 3px 0;
                }
                
                .quizName{
                    font-weight: 700;
                    font-size: 20px;
                    text-transform: capitalize;
                }
                
                .quizQuestionOrder{
                    text-transform: capitalize;
                    font-size: 20px;
                }
                
                .quizQuestionAndAnswer{
                    padding: 12px 0;
                }
                
                .quizAnswer{
                    padding-bottom: 5px;
                    margin-left: 20px;
                }
                
                .questionBorderLine{
                    margin: 10px 0;
                    border: none;
                    border-top:1px solid rgba(153, 124, 124, 0.4);
                }
                
                .questionDetails p{
                    margin-left: 5px;
                    margin-right: 20px;
                    display:inline-block;
                }
                
                /*----------- Quiz Design End ------------*/
            
            /*Game Page Content End*/
        </style>
        
        <script>
                      
            function enterGameName() {
              let gameName = prompt("Please enter a game name.", "quiz 1");
              if (gameName != null) {
                window.location.href = "game.php";
              }
            }
            
            function deleteGameConfirmation() {
                let text = "Are you sure to delete this game?\nPress OK to delete.";
                if (confirm(text) == true) {
                  //
                }
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
                <a href="game.php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}";?>">Game - Question List</a>
                <a href="powerStore.php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}";?>">Power Store</a>
                <div class="backBtn">
                    <a href="classroom.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">back</a>
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
                <?php
                $newQuizName = $_SESSION['newQuizName'];
                $defaultScore = 0;
                
                ?>
                <!-- Classroom Title Bar -->
                <div class="titleBar">
                    <p class="classroomTxt"><?php echo"$newQuizName";?></p>
                    <p class="quizTotalScore">Total score: <?php echo"$defaultScore";?></p>
                </div>
                
                <!-- Buttons -->
                <div class="btnSelections">
                    <!-- Multiple-choice question -->
                    <button onclick="window.location.href='questionFormulate(mcq).php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}"; ?>'" class="questionType multiChoiceQ">
                        <i style="font-size:16px;margin-right:3px;" class="fas">&#xf61f;</i> 
                        Multiple-Choice Question
                    </button>
                    
                    <!-- True-False question -->
                    <button onclick="window.location.href='questionFormulate(tf).php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}"; ?>'" class="questionType trueFalseQ">
                        <i style='font-size:16px;margin-right:3px;' class='far'>&#xf058;</i> 
                        True-False Question
                    </button>
                    
                    <!-- Fill-in-the-Blank question -->
                    <button onclick="window.location.href='questionFormulate(fitb).php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}"; ?>'" class="questionType openEndedQ">
                        <i style="font-size:16px;margin-right:3px;" class="fa">&#xf044;</i>
                        Fill-in-the-Blank Question
                    </button>
                </div>
                <?php
                    $instructorID = $_GET['instructorID'];
                    $classID = $_GET['classID'];
                    $gameID = $_GET['gameID'];
                    $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                    
                    $gameSql = "SELECT * FROM gamequestion WHERE gameID='$gameID'";
                    $gameResult = $con->query($gameSql);
                    
                    if($gameResult){
                        $totalQuestion = $gameResult->num_rows;
                    }else{
                        $totalQuestion = 0;
                    }
                ?>                
                <!-- Game Quiz Created -->
                <div class="gameQuizList">
                    <p class="quizCount">
                        <i style="font-size:16px;margin-right:3px;" class="fa">&#xf03a;</i>
                        <span id="quizCountTxt"><?php echo $totalQuestion;?> questions</span>
                    </p>
                    
                    <?php
                    $questionNumber = 1;
                        if($gameResult){
                            while ($row = $gameResult->fetch_assoc()){
                                $questionID = $row["questionID"];
                                $questionType = $row["questionType"];
                                $question = $row["question"];
                                $duration = $row["duration"];
                                $scoreAwarded = $row["scoreAwarded"];
                                $pointEarned = $row["pointEarned"];
                                
                                //question number
                                printf('
                                    <div class="gameQuiz">
                        
                                    <p class="quizQuestionOrder">
                                        <i style="font-size:16px;margin-right:3px;" class="fas">&#xf61f;</i> 
                                        Question %d
                                    </p> ', $questionNumber);
                                
                                //question
                                printf('<div class="quizQuestionAndAnswer">
                                        <p class="quizQuestion"><b>Q.</b> %s</p>
                                        <hr class="questionBorderLine">
                                        <div class="quizAnswerSet">', $question);
                                
                                //answer
                                $findAnswerSql = "SELECT * FROM answeroption WHERE questionID='$questionID'";
                                $answerResult = $con->query($findAnswerSql);

                                if($answerResult->num_rows > 0){
                                    while ($row = $answerResult->fetch_assoc()){
                                        $answerID = $row["answerID"];
                                        $answerText = $row["answerText"];
                                        $correctness = $row["correctness"];

                                        if($correctness == 1){
                                            printf('
                                                    <p class="quizAnswer">
                                                        <i style="font-size:16px;margin-right:3px;color: limegreen;" class="fas">&#xf058;</i>
                                                        %s
                                                    </p>
                                                     ', $answerText);
                                        }else if($correctness == 0){
                                            printf('
                                                    <p class="quizAnswer">
                                                        <i style="font-size:16px;margin-right:3px;color: red;" class="fas">&#xf057;</i>
                                                        %s
                                                    </p>
                                                    ', $answerText);
                                        }
                                    }
                                }
                                
                                // Duration, Point, Score
                                printf('
                                    </div>
                                    </div>
                                    <div>
                                        <div class="questionDetails">
                                            <p>
                                                <i style="font-size:16px;" class="fa">&#xf017;</i>
                                                %d seconds
                                            </p>
                                            <p>
                                                <i style="font-size:16px;" class="fa">&#xf005;</i>
                                                %d points
                                            </p>
                                            <p>
                                                <i style="font-size:16px;" class="fa">&#xf14a;</i>
                                                %d scores
                                            </p>
                                        </div>
                                    </div>
                                </div>', $duration, $pointEarned, $scoreAwarded);
                                $questionNumber++;
                            }
                        }
                    ?>
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
