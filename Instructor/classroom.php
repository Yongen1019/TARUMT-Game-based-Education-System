<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Classroom</title>
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
            
            .shareCodebtn, .shareCodeEmail a{
                border:none;
                font-size: 16px;
                margin-left: 0px;
            }
            
            .btnSelections{
                margin-left: 35px;
                margin-top: 10px;
                margin-bottom: 35px;
            }
            
            .shareCodeEmail{
                float:left;
                margin-top: 10px;
            }
            
            .shareCodebtn:hover, .shareCodeEmail a:hover{
                box-shadow: 1px 1px 5px rgba(153, 124, 124, 0.7);
            }
            
             .shareCodebtn{
                color: white;
                text-decoration: none;
                margin-left: 50px;
                background-color: #997c7c;
                padding: 10px 20px;
                border-radius: 2px;
            }
            
            .shareCodeEmail a{
                color: white;
                text-decoration: none;
                margin-left: 75px;
                background-color: #997c7c;
                padding: 10px 20px;
                border-radius: 2px;
            }
            
            .createGamebtn{
                display: inline-block;
                margin-left:10px;
                float:left;
            }
            
            .createGamebtn a{
                text-decoration: none;
                color:white;
                display:block;
                width: 120%;
                text-align: center;
                padding-top: 10px;
                padding-bottom: 10px;
                background-color: #997c7c;
                border-radius: 2px;
            }
            
            .createGamebtn a:hover{
                box-shadow: 1px 1px 5px rgba(153, 124, 124, 0.7);
            }
            
            /*Game Page Content Start*/
            
            .titleBar{
                margin: 10px 35px;
                background-color: rgba(129, 41, 40, 0.2);
                max-width: 100%;
                min-height: 200px;
                border-radius: 10px;
                padding: 2%;
                position: relative;
                margin-bottom: 40px;
                color: black;
            }
            
            .classroomTxt, .subjectTxt, .descTxt, .classCodeTxt{
                padding: 8px;
                color: #541b1a;
            }
            
            .classroomTxt{
                text-transform: uppercase;
                font-size: 22px;
                padding-bottom: 30px;
                font-weight: 600;
            }
            
            #classCode{
                font-weight: 700;
            }
            
            .subjectTxt{
                font-size: 18px;
                text-transform: capitalize;
            }

            .descTxt{
                opacity: 0.8;
                text-transform: capitalize;
            }
            
            .classCodeTxt{
                opacity: 0.8;
            }
            
            .menuButtonContainer{
                float: right;
            } 
            
            .gameQuizList{
                border: 2px solid #812928;
                border-radius: 20px;
                max-width: 100%;
                min-height: 100px;
                padding: 25px 30px;
                margin: 10px 50px 30px 50px;
                color: #541b1a;
                background-color: white;
            }
            
            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                padding-top: 280px; /* Location of the box */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                
            }

            /* Modal Content */
            .modal-content {
                background-color: #fefefe;
                padding: 20px;
                border: 1px solid #888;
                width: 60%;
                margin: auto;
                
            }

            /* The Close Button */
            .close {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
            
            /*INSIDE MODAL*/
            
            .insideModal{
                margin: auto;
                width: 43%;
                padding: 10px;
            }
            
            .insideModal .fa {
                padding: 20px;
                font-size: 30px;
                width: 50px;
                text-align: center;
                text-decoration: none;
                margin: 5px 2px;
            }

            .fa:hover {
                opacity: 0.7;
            }

            .fa-facebook {
                background: #3B5998;
                color: white;
            }

            .fa-twitter {
                background: #55ACEE;
                color: white;
            }
            
            .fa-wechat {
                background: #09B83E;
                color: white;
            }

            .fa-whatsapp {
                background: #25D366;
                color: white;
            }

            /*END OF INSIDE MODAL*/
            
                /*----------- Drop Down Menu Start ------------*/
            
                .dropdown {
                    position: relative;
                    display: inline-block;
                }

                .dropdown-content {
                    display: none;
                    position: absolute;
                    right: 0;
                    background-color: #f9f9f9;
                    min-width: 200px;
                    box-shadow: 0px 8px 16px 0px rgba(153, 124, 124, 0.4);
                    z-index: 1;
                }

                .dropdown-content a , .deleteGameBtn{
                    color: black;
                    padding: 10px;
                    text-decoration: none;
                    display: block;
                    font-size: 15px;
                    font-weight: 400;
                }
                
                .deleteGameBtn{
                    border:none;
                    width: 100%;
                    text-align: left;
                    background: #f9f9f9;
                }

                .dropdown-content a:hover, .deleteGameBtn:hover{
                    background-color: #997c7c;
                    color:white;
                }

                .dropdown:hover .dropdown-content {
                    display: block;
                    width: 100px;
                }
            
                /*----------- Drop Down Menu End ------------*/
                
                /*----------- Quiz Design Start ------------*/
                
                .quizName, .quizDesc, .quizScore, .quizTotalQuestion{
                    padding: 3px 0;
                }
                
                .quizName{
                    font-weight: 700;
                    font-size: 20px;
                    text-transform: capitalize;
                }
                
                .quizDesc{
                    text-transform: capitalize;
                }
                
                .quizScore{
                    margin-top: 20px;
                }
                
                .quizScore, .quizTotalQuestion{
                    opacity: 0.7;
                    font-size: 15px;
                }
                
                .quizMenuBtn{
                    border:none;
                    background-color: white;
                    font-weight: 900;
                    font-size: 22px;
                    color: #812928;
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
                ?>
                <a class="active" href="classroom.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">Classroom</a>
                <a href="studentList.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">Student List</a>
                <div class="backBtn">
                    <a href="homepage.php?<?php echo"instructorID={$instructorID}";?>">home</a>
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
                        $classCode = $row["classCode"];
                    }
                }
                if(isset($_POST["delete"])){
                    
                    $sql = "DELETE FROM Classroom WHERE classID = '$classID'";
                    
                    if ($con->query($sql) === TRUE) {
                        echo"<script type='text/javascript'> 
                            location.replace('homepage.php?instructorID={$instructorID}')
                            alert('Classroom deleted.')
                             </script>";
                    } else {
                        echo"<script type='text/javascript'> 
                            location.replace('homepage.php?instructorID={$instructorID}')
                            alert('Failed to delete classroom.')
                             </script>";
                    }
                }
                $con->close();
                ?>
                
                <!-- Classroom Title Bar -->
                <div class="titleBar">
                    <div class="classroom">
                        <p class="classroomTxt"><?php echo $className; ?></p>
                        <p class="subjectTxt"><?php echo $classSubject; ?></p>
                        <p class="descTxt"><?php echo $classDescription; ?></p>
                        <p class="classCodeTxt">Classroom Code: <span id="classCode"><?php echo $classCode; ?></span></p>
                        <input type="hidden" id="classCodeTxt" name="classCodeTxt" value="<?php echo $classCode; ?>">
                    </div>
                </div>
                
                <!-- Buttons -->
                <div class="btnSelections">
                    <!-- Create Game -->
                    <div class="createGamebtn">
                        <a href="createGame.php?<?php echo "instructorID={$instructorID}&classID={$classID}"; ?>">
                            <i style='font-size:16px;margin-right:3px;' class='fas'>&#xf067;</i> 
                        Create Game</a>
                    </div>
                    <!-- Share Code -->
                    <div class="shareCodeEmail">
                        <a href="shareCodeByEmail.php?<?php echo "instructorID={$instructorID}&classID={$classID}&classCode={$classCode}"; ?>">
                        <i style="font-size:16px;margin-right:3px;" class="fa">&#xf003;</i> 
                        Share Code Via Email</a>
                    </div>
                    
                    <div class="shareCode">
                        <!-- Share Code -->
                        <button id="myBtn" class="shareCodebtn"> 
                            <i style="font-size:16px;margin-right:3px;" class="fa">&#xf24d;</i> 
                            Share Code Via Social Media</button>

                        <!-- The Modal -->
                        <div id="myModal" class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <div>Classroom code is copied, you may share it to the social media:</div>
                                <div class="insideModal">
                                    <a href="https://www.facebook.com"  target="_blank" class="fa fa-facebook"></a>
                                    <a href="https://www.twitter.com"  target="_blank" class="fa fa-twitter"></a>
                                    <a href="weixin://dl/chat"  target="_blank" class="fa fa-wechat"></a>
                                    <a href="https://web.whatsapp.com"  target="_blank" class="fa fa-whatsapp"></a>
                                </div>
                            </div>
                        </div>

                        <script>
                        /* open modal */    
                        var modal = document.getElementById("myModal");
                        var btn = document.getElementById("myBtn");
                        var span = document.getElementsByClassName("close")[0];
                        btn.onclick = function() {
                            modal.style.display = "block";
                            document.querySelector("body").style.overflow = 'hidden';
                            /* Copy classroom code */
                            var copyText = document.getElementById("classCodeTxt");
                            copyText.select();
                            navigator.clipboard.writeText(copyText.value);
                        }

                        span.onclick = function() {
                            modal.style.display = "none";
                            document.querySelector("body").style.overflow = 'visible';
                            
                        }

                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                                document.querySelector("body").style.overflow = 'visible';
                            }
                        }
                        </script>
                    </div>
                </div>
                                
                <!-- Game Quiz Created -->
                <?php
                $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                $query = "select * from GAME WHERE classID = '$classID'";
                $result = $con->query($query);
                
                if($result){
                    while($row = $result->fetch_assoc()){
                        $gameID = $row["gameID"];
                        $quizName = $row["quizName"];
                        $totalScore = $row["totalScore"];
                        
                        //question count
                        $countSQL = "select * from GameQuestion WHERE gameID = '$gameID'";
                        $countResult = $con->query($countSQL);
                        if($countResult->num_rows > 1){
                            $question = "questions";
                        }else{
                            $question = "question";
                        }
                        
                        printf(' 
                            <div class="gameQuizList">
                            <div class="gameQuiz">
                            <div class="dropdown" style="float:right;margin-bottom: 10px;">
                            <button class="quizMenuBtn">
                            <i style="font-size:24px;cursor:pointer" class="fa">&#xf0c9;</i>
                            </button>
                            <div class="dropdown-content">');
                ?>  
                
                    <a href="editGame.php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}";?>">Edit Game</a>
                    <a href="viewScoreAndRanking.php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}";?>">View Score and Ranking</a>
                    <a href="deleteGame.php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}";?>">Delete Game</a>
                
                <?php
                        printf('
                            </div>
                            </div>
                            <p class="quizName">%s</p>
                            <p class="quizScore">Total Score: %u</p>
                            <p class="quizTotalQuestion">%d %s</p></div></div>'
                            , $quizName, $totalScore, $countResult->num_rows, $question);
                    }
                }
                $con->close();
                ?>
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
