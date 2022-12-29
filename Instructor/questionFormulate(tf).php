<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TFQ</title>
        <link rel="stylesheet" href="style.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .loginTopNavBar{
                text-align: center;
                padding: 15px 0;
                background-color: #812928;
                color:white;
                box-shadow: 2px 2px 5px #997c7c;
                text-transform: capitalize;
                font-weight: bold;
                font-size: 18px;
                overflow: hidden;
                position:fixed;
                top:0;
                width:100%;
            }
            
            .topNavContent{
                padding: 0 10px;
                display: flex;                 
                flex-direction: row;            
                flex-wrap: nowrap;              
                justify-content: space-between; 
                margin: 0 10px;
            }
            
            /*----------- Question Start ------------*/
            
            .answerTxtInstruction{
                text-align: center;
                font-size: 20px;
                color: #541b1a;
                padding-top: 20px;
            }
            
            .questionTxtArea textarea{
                display:block;
                margin-left:auto;
                margin-right:auto;
                margin-top: 80px;
                border: 2px solid rgba(153, 124, 124, 0.7);
                padding: 30px 0px;
            }
            
            .questionTxtArea textarea{
                border-radius: 10px;
                text-align: center;
                font-size: 22px;
                white-space: initial;
            }
            
            .answerTxtArea{
                text-align: center;
                display:flex;
                flex-direction: row;            
                flex-wrap: nowrap; 
                justify-content: center;
                align-items: center; 
                border:none;
                padding: 15px 0px;
            }
            
            .answerTrue{
                background-color: rgba(110, 224, 110, 0.9);
                color: white;
            }
            
            .answerFalse{
                background-color: rgba(255, 95, 59, 0.8);
                color:white;
            }
            
            .trueFalseTxt{
                padding-top: 130px;
                font-size: 26px;
                text-transform: uppercase;
                font-weight: 500;
                letter-spacing: 1px;
            }
            
            .ansTxtArea-container{
                border: 2px solid rgba(153, 124, 124, 0.7);
                width: 300px;
                border-radius: 20px;
                margin: 0 20px 50px 20px;
                height: 300px;
            }
            
            .ansTxtArea-container .correctAnsBtn{
                float:right;
                border:none;
                margin: 20px 20px 0 0;
            }
            
            .questionTxtArea textarea::placeholder{
                color: rgba(153, 124, 124, 0.4);
                text-transform: capitalize;
                opacity: 1; 
            }
            
            /*----------- Question End ------------*/
            
            /*----------- Bottom Nav Start ------------*/
            
            .fixedBottomNav{
                overflow: hidden;
                background-color: #812928;
                color:white;
                padding: 0px 15px;
                position: fixed;
                bottom: 0;
                width: 100%;
            }
            
            .detailSelectionArea{
                float:left;
                margin: 15px auto; 
            }
            
            .detailSelection{
                margin: 0px 50px 0px auto;
            }
            
            .bottomNavContent .fa{
                vertical-align: bottom;
            }
            
            .bottomNavContent select{
                border:none;
                padding: 2px 8px;
                border-radius: 5px;
                font-size: 14px;
            }
            
            .btnSelections{
                float:right;
            }
            
            .btnSelections a{
                text-decoration: none;
            }
            
            .questionSaveBtn{
                border:none;
                padding: 2px 20px;
                border-radius: 2px;
                background-color: white;
                text-transform: uppercase;
                font-size: 18px;
                height: 40px;
                letter-spacing: 2px;
                margin: 5px 50px 5px 0px;
                font-weight: 600;
            }
            
            .questionCancelBtn{
                text-transform: uppercase;
                font-size: 18px;
                height: 25px;
                letter-spacing: 1px;
                margin: 5px 40px 5px 0px;
                background-color: #812928;
                border:none;
                color:white;
            }
            
            .container {
                display: block;
                position: relative;
                padding-left: 35px;
                margin-bottom: 12px;
                cursor: pointer;
                font-size: 22px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .container input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
            }

            .checkmark {
                position: absolute;
                top: 0;
                right: 10px;
                height: 25px;
                width: 25px;
                background-color: #eee;
                border-radius: 50%;
            }

            .container:hover input ~ .checkmark {
                background-color: #ccc;
            }

            .container input:checked ~ .checkmark {
                 background-color: #812928;
            }

            .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }

            .container input:checked ~ .checkmark:after {
                 display: block;
            }

            .container .checkmark:after {
                top: 9px;
                left: 9px;
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: white;
            }
            
            .tooltip {
                position: absolute;
                display: inline-block;
                cursor: default;
                top:320px;
                left:160px;
            }

            .tooltip .tooltiptext {
                font-size: 12px;
                padding: 2px 10px;
                visibility: hidden;
                width: 150px;
                background-color: #541b1a;
                color: #fff;
                text-align: center;
                border-radius: 50px;
                margin-left: 2px;
                /* Position the tooltip */
                position: absolute;
                z-index: 1;
            }

            .tooltip:hover .tooltiptext {
                visibility: visible;
            }
            
            .tooltip_2 {
                position: absolute;
                display: inline-block;
                cursor: default;
            }

            .tooltip_2 .tooltiptext_2 {
                font-size: 12px;
                padding: 2px 10px;
                visibility: hidden;
                width: 330px;
                background-color: #541b1a;
                color: #fff;
                text-align: center;
                border-radius: 50px;
                margin-left: 2px;
                /* Position the tooltip */
                position: absolute;
                z-index: 1;
                top:-5px;
            }

            .tooltip_2:hover .tooltiptext_2 {
                visibility: visible;
            }
            /*----------- Bottom Nav End ------------*/
        </style>
        
        <script>
            function setNewQuestion() {
                let text = "Do you want to set a new question in the game?\nPress OK to set a new question.";
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
            $instructorID = $_GET['instructorID'];
            $classID = $_GET['classID'];
            $gameID = $_GET['gameID'];
        ?>
        <!-- Top Nav Bar -->
        <div class="loginTopNavBar">
            <?php
                $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');

                //get game details
                $findGameQuery = "select * from Game WHERE gameID = '$gameID'";
                $findGameResult = $con->query($findGameQuery);
                
                if($findGameResult){
                    while($row = $findGameResult->fetch_assoc()){
                        $quizName = $row["quizName"];
                    }
                }
                
                //get total of question
                $totalQuestionSql = "select * from Gamequestion WHERE gameID = '$gameID'";
                $totalQuestionResult = $con->query($totalQuestionSql);
                
                if($totalQuestionResult->num_rows > 0){
                    $questionNo = $totalQuestionResult->num_rows;
                    $questionNo++;
                }else{
                    $questionNo = 1;
                }
                
                $con->close();
            ?>
            <div class="topNavContent">
                <p class="topNavTxtLeft"><?php echo$quizName;?></p>
                <p class="topNavTxtCenter">TARUMT Game-based Teaching System</p>
                <p class="topNavTxtRight">Question <?php echo $questionNo;?></p>
            </div>
        </div>
        
        <?php
        function errorDetect(){
            global $questionTxt;
            
            $error = false;
            
            if($questionTxt == null){
                $error = true;
                echo "<script>alert('Please set a question.');</script>";
            }
            
            if(strlen($questionTxt)>100){
                $error = true;
                echo "<script>alert('Question is too long, it cannot be more than 100 characters.');</script>";
            }
            
            return $error;
        }
        
        if(isset($_POST["save"])){
            $questionTxt = ucfirst($_POST['questionTxt']);
            $correctAns = $_POST['correctAns'];
            $duration = $_POST['duration'];
            $pointEarned = $_POST['pointEarned'];
            $scoreAwarded = $_POST['scoreAwarded'];
            
            $error = errorDetect();            
            
            if($error == false){
                //connect DB
                $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');

                //sql query
                $findLastQID = "SELECT * FROM gamequestion
                                ORDER BY questionID DESC LIMIT 1";

                //execute find last id query
                $findQresult = $con->query($findLastQID);
                if ($findQresult) {
                    while ($row = $findQresult->fetch_assoc()){
                        $latestQuestionID = $row["questionID"];
                        $latestQuestionID++;
                    }
                } else {
                    $latestQuestionID = "GQ000001";
                }
                
                //question sql query
                $insertGameQuestionSql = "INSERT INTO Gamequestion (questionID, questionType, question, duration, scoreAwarded, pointEarned, gameID) VALUES 
                   ('$latestQuestionID', 'true-false question', '$questionTxt', '$duration', '$scoreAwarded', '$pointEarned', '$gameID')";   
                                
                if($con->query($insertGameQuestionSql) == true){
                    
                    //find last answer id
                    $findLastAID = "SELECT * FROM answeroption
                                    ORDER BY answerID DESC LIMIT 1";

                    //execute find last id query
                    $findAresult = $con->query($findLastAID);
                    if ($findAresult) {
                        while ($row = $findAresult->fetch_assoc()){
                            $latestAnswerID = $row["answerID"];
                            $latestAnswerID++;
                            $latestAnswerID1 = $latestAnswerID;
                            $latestAnswerID++;
                            $latestAnswerID2 = $latestAnswerID;
                        }
                    } else {
                        $latestAnswerID1 = "QA000001";
                        $latestAnswerID2 = "QA000002";
                    }
                    
                    //ans query
                    if($correctAns == "true"){
                        $insertTrueAnsSql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID1', 'True', '1', '$latestQuestionID')";  
                        $insertFalseAnsSql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID2', 'False', '0', '$latestQuestionID')";  
                        
                        if($con->query($insertTrueAnsSql) == true){
                            if($con->query($insertFalseAnsSql) == true){
                            //update total score of a game
                                //find the latest score of the game
                                $findTotalScoreQuery = "select * from game WHERE gameID = '$gameID'";
                                $findScoreResult = $con->query($findTotalScoreQuery);

                                if($findScoreResult){
                                    while($row = $findScoreResult->fetch_assoc()){
                                        $totalScore = $row["totalScore"];
                                    }
                                }

                                //update total score 
                                $newScore = $totalScore + $scoreAwarded;
                                $updateScoreSql = "UPDATE Game 
                                        SET totalScore = '$newScore'
                                        WHERE gameID = '$gameID'";

                                if ($con->query($updateScoreSql) === TRUE) {
                                    echo"<script type='text/javascript'> 
                                        location.replace('editGame.php?instructorID={$instructorID}&classID={$classID}&gameID={$gameID}')
                                        alert('Game set successfully.')
                                         </script>";
                                }
                            }
                        }
                    }else if($correctAns == "false"){
                        $insertTrueAnsSql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID1', 'True', '0', '$latestQuestionID')";  
                        $insertFalseAnsSql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID2', 'False', '1', '$latestQuestionID')";  
                        
                        if($con->query($insertTrueAnsSql) == true){
                            if($con->query($insertFalseAnsSql) == true){
                            //update total score of a game
                                //find the latest score of the game
                                $findTotalScoreQuery = "select * from game WHERE gameID = '$gameID'";
                                $findScoreResult = $con->query($findTotalScoreQuery);

                                if($findScoreResult){
                                    while($row = $findScoreResult->fetch_assoc()){
                                        $totalScore = $row["totalScore"];
                                    }
                                }

                                //update total score
                                $newScore = $totalScore + $scoreAwarded;
                                $updateScoreSql = "UPDATE Game 
                                        SET totalScore = '$newScore'
                                        WHERE gameID = '$gameID'";

                                if ($con->query($updateScoreSql) === TRUE) {
                                    echo"<script type='text/javascript'> 
                                        location.replace('editGame.php?instructorID={$instructorID}&classID={$classID}&gameID={$gameID}')
                                        alert('Game set successfully.')
                                         </script>";
                                }
                            }
                        }  
                    }
                    
                }
                $con->close();
            }
        }
        
        ?>
        
        
        <!-- Question Form -->
        <form method="post">
            <!-- Question -->
            <div>
                <div class="questionTxtArea">
                    <textarea style="resize:none" id="questionTxt" name="questionTxt" rows="8" cols="100" placeholder="please type your question here."></textarea>
                    <div class="tooltip">
                        <i style="font-size:35px; color: #541b1a;" class="fa">&#xf29c;</i>
                        <span class="tooltiptext">Please type your question inside the text box.</span>
                    </div>
                </div>
                <div class="answerTxtInstruction">
                    <label for="answerTxt">Please click on the <b>right-top button</b> to indicate the correct answer:</label>
                </div>
                <div class="answerTxtArea">
                    <div class="ansTxtArea-container answerTrue">
                        <div style="display:block;">
                            <label class="container">
                                <input type="radio" checked="checked" name="correctAns" value="true">
                                <span class="checkmark"></span>
                            </label>
                            <div class="answerTxt">
                                <p class='trueFalseTxt'>true</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="ansTxtArea-container answerFalse">
                        <div style="display:block;">
                            <label class="container">
                                <input type="radio" name="correctAns" value="false">
                                <span class="checkmark"></span>
                            </label>
                            <div class="answerTxt">
                                <p class='trueFalseTxt'>false</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bottom Fixed Bar -->
            <div class="fixedBottomNav">
                <div class="bottomNavContent">
                    <div class="detailSelectionArea">
                    <!-- duration -->
                    <i style="font-size:22px;" class="fa">&#xf017;</i>
                    <select name="duration" id="duration" class="detailSelection">
                        <option value="10">10 seconds</option>
                        <option value="20">20 seconds</option>
                        <option value="30" selected>30 seconds</option>
                        <option value="45">45 seconds</option>
                        <option value="60">60 seconds</option>
                    </select>
                    
                    <!-- points -->
                    <i style="font-size:22px;" class="fa">&#xf005;</i>
                    <select name="pointEarned" id="pointEarned" class="detailSelection">
                        <script>
                        for (let i = 1; i < 11; i++) {
                            document.write("<option value='" + i + "'>" + i + " points</option>");
                        }
                        </script>
                    </select>
                    
                    <!-- score -->
                    <i style='font-size:22px;' class='fa'>&#xf14a;</i>
                    <select name="scoreAwarded" id="scoreAwarded" class="detailSelection">
                        <script>
                        for (let i = 1; i < 11; i++) {
                            document.write("<option value='" + i + "' ");
                            document.write(">" + i +" scores</option>")
                        }
                        </script>
                    </select>
                    </div>
                    
                    <!-- buttons at bottom -->
                    <div class="btnSelections">
                        
                        <!-- cancel button -->
                        <?php
                        echo "<a onClick=\"javascript: return confirm('Are you sure to cancel?');\" href='editGame.php?instructorID={$instructorID}&classID={$classID}&gameID={$gameID}' class='questionCancelBtn'>cancel</a>"; 
                        ?>
                        
                        <!-- save button -->
                        <button type="submit" name="save" class="questionSaveBtn">
                            <i style='font-size:18px;margin-right:1px;' class='fas'>&#xf0c7;</i>
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
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
