<?php
session_start();
unset($_SESSION["MCQquestion"]);
unset($_SESSION["MCQanswer1"]);
unset($_SESSION["MCQanswer2"]);
unset($_SESSION["MCQanswer3"]);
unset($_SESSION["MCQanswer4"]);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MCQ</title>
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
            
            .questionTxtArea textarea, .answerTxtArea textarea{
                border-radius: 10px;
                text-align: center;
                font-size: 22px;
                white-space: initial;
            }
            
            .answerTxtArea textarea{
                margin: 0px 18px;
                border:none;
                padding: 15px 0px;
            }
            
            .answerTxtArea textarea:focus{
                border:none;
                outline: none !important;
            }
            
            .answerTxtArea{
                text-align: center;
                margin: 20px 0 80px 0;
                display:flex;
                flex-direction: row;            
                flex-wrap: nowrap; 
                justify-content: center;
                align-items: center; 
            }
            
            .ansTxtArea-container{
                border: 2px solid rgba(153, 124, 124, 0.7);
                width: 300px;
                background-color:white;
                border-radius: 20px;
                margin: 0 20px;
            }
            
            .ansTxtArea-container .correctAnsBtn{
                float:right;
                border:none;
                background-color:white;
                margin: 20px 20px 0 0;
                
            }
            
            .questionTxtArea textarea::placeholder, .answerTxtArea textarea::placeholder {
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
                left:170px;
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
                let text = "Are you sure to set the question?\nPress OK to save.";
                if (confirm(text)) {
                    return true;
                }
                return false;
            }
            
            function cancelGame() {
                let text = "Are you cancel the question?\nPress OK to cancel.";
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
            $instructorID = $_GET['instructorID'];
            $classID = $_GET['classID'];
            $gameID = $_GET['gameID'];
            $_SESSION["instructorID"] = $instructorID;
            $_SESSION["classID"] = $classID;
            $_SESSION["gameID"] = $gameID;
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
            global $questionTxt, $answerTxt1, $answerTxt2, $answerTxt3, $answerTxt4;
            
            $error = false;
            
            if($questionTxt == null){
                $error = true;
                echo "<script>alert('Please set a question.');</script>";
            }else if($answerTxt1 == null){
                $error = true;
                echo "<script>alert('Please provide answer 1.');</script>";
            }else if($answerTxt2 == null){
                $error = true;
                echo "<script>alert('Please provide answer 2.');</script>";
            }else if($answerTxt3 == null){
                $error = true;
                echo "<script>alert('Please provide answer 3.');</script>";
            }else if($answerTxt4 == null){
                $error = true;
                echo "<script>alert('Please provide answer 4.');</script>";
            }
            
            if(strlen($questionTxt)>100){
                $error = true;
                echo "<script>alert('Question is too long, it cannot be more than 100 characters.');</script>";
            }else if(strlen($answerTxt1)>50){
                $error = true;
                echo "<script>alert('Answer 1 is too long, it cannot be more than 50 characters.');</script>";
            }else if(strlen($answerTxt2)>50){
                $error = true;
                echo "<script>alert('Answer 2 is too long, it cannot be more than 50 characters.');</script>";
            }else if(strlen($answerTxt3)>50){
                $error = true;
                echo "<script>alert('Answer 3 is too long, it cannot be more than 50 characters.');</script>";
            }else if(strlen($answerTxt4)>50){
                $error = true;
                echo "<script>alert('Answer 4 is too long, it cannot be more than 50 characters.');</script>";
            }    
            
            return $error;
        }
        
        if(isset($_POST["save"])){
            $questionTxt = ucfirst($_POST['questionTxt']);
            $answerTxt1 = ucfirst($_POST['answerTxt1']);
            $answerTxt2 = ucfirst($_POST['answerTxt2']);
            $answerTxt3 = ucfirst($_POST['answerTxt3']);
            $answerTxt4 = ucfirst($_POST['answerTxt4']);
            
            $_SESSION['MCQquestion'] = ucfirst($_POST['questionTxt']);
            $_SESSION['MCQanswer1'] = ucfirst($_POST['answerTxt1']);
            $_SESSION['MCQanswer2'] = ucfirst($_POST['answerTxt2']);
            $_SESSION['MCQanswer3'] = ucfirst($_POST['answerTxt3']);
            $_SESSION['MCQanswer4'] = ucfirst($_POST['answerTxt4']);
            
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
                   ('$latestQuestionID', 'multiple-choice question', '$questionTxt', '$duration', '$scoreAwarded', '$pointEarned', '$gameID')";   
                                
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
                            $latestAnswerID++;
                            $latestAnswerID3 = $latestAnswerID;
                            $latestAnswerID++;
                            $latestAnswerID4 = $latestAnswerID;
                        }
                    } else {
                        $latestAnswerID1 = "QA000001";
                        $latestAnswerID2 = "QA000002";
                        $latestAnswerID3 = "QA000003";
                        $latestAnswerID4 = "QA000004";
                    }
                    
                    //ans query
                    if($correctAns == "ansOption1"){
                        $insertA1Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID1', '$answerTxt1', '1', '$latestQuestionID')";  
                        $insertA2Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID2', '$answerTxt2', '0', '$latestQuestionID')";  
                        $insertA3Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID3', '$answerTxt3', '0', '$latestQuestionID')";  
                        $insertA4Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID4', '$answerTxt4', '0', '$latestQuestionID')";  
                        
                        if($con->query($insertA1Sql) == true){
                            if($con->query($insertA2Sql) == true){
                                if($con->query($insertA3Sql) == true){
                                    if($con->query($insertA4Sql) == true){
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
                    }else if($correctAns == "ansOption2"){
                        $insertA1Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID1', '$answerTxt1', '0', '$latestQuestionID')";  
                        $insertA2Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID2', '$answerTxt2', '1', '$latestQuestionID')";  
                        $insertA3Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID3', '$answerTxt3', '0', '$latestQuestionID')";  
                        $insertA4Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID4', '$answerTxt4', '0', '$latestQuestionID')";  
                        
                        if($con->query($insertA1Sql) == true){
                            if($con->query($insertA2Sql) == true){
                                if($con->query($insertA3Sql) == true){
                                    if($con->query($insertA4Sql) == true){
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
                    }else if($correctAns == "ansOption3"){
                        $insertA1Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID1', '$answerTxt1', '0', '$latestQuestionID')";  
                        $insertA2Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID2', '$answerTxt2', '0', '$latestQuestionID')";  
                        $insertA3Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID3', '$answerTxt3', '1', '$latestQuestionID')";  
                        $insertA4Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID4', '$answerTxt4', '0', '$latestQuestionID')";  
                        
                        if($con->query($insertA1Sql) == true){
                            if($con->query($insertA2Sql) == true){
                                if($con->query($insertA3Sql) == true){
                                    if($con->query($insertA4Sql) == true){
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
                    }else if($correctAns == "ansOption4"){
                       $insertA1Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID1', '$answerTxt1', '0', '$latestQuestionID')";  
                        $insertA2Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID2', '$answerTxt2', '0', '$latestQuestionID')";  
                        $insertA3Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID3', '$answerTxt3', '0', '$latestQuestionID')";  
                        $insertA4Sql = "INSERT INTO AnswerOption (answerID, answerText, correctness, questionID) VALUES 
                            ('$latestAnswerID4', '$answerTxt4', '1', '$latestQuestionID')";  
                        
                        if($con->query($insertA1Sql) == true){
                            if($con->query($insertA2Sql) == true){
                                if($con->query($insertA3Sql) == true){
                                    if($con->query($insertA4Sql) == true){
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
                    }
                }
                $con->close();
            }
        }
        
        ?>
        
        
        <!-- Question Form -->
        <form method="post" onsubmit="return setNewQuestion();">
            <!-- Question -->
            <div>
                <div class="questionTxtArea">
                    <textarea style="resize:none" id="questionTxt" name="questionTxt" rows="8" cols="100" placeholder="please type your question here."><?php if(!empty($error)) echo $_SESSION['MCQquestion']?></textarea>
                    <div class="tooltip">
                        <i style="font-size:35px; color: #541b1a;" class="fa">&#xf29c;</i>
                        <span class="tooltiptext">Please type your question inside the text box.</span>
                    </div>
                </div>
                <div class="answerTxtInstruction">
                    <label for="answerTxt">Please provide <b>4 answer options</b> for multiple-choice question:</label> &nbsp;
                    <div class="tooltip_2">
                        <i style="font-size:25px; color: #541b1a;" class="fa">&#xf29c;</i>
                        <span class="tooltiptext_2">4 answer options must be filled in and please click on the right-top button if the answer option is correct.</span>
                    </div>
                </div>
                <div class="answerTxtArea">
                    <div class="ansTxtArea-container">
                        <div style="display:block;">
                            <label class="container">
                                <input type="radio" checked="checked" name="correctAns" value="ansOption1">
                                <span class="checkmark"></span>
                            </label>
                            <textarea style="resize:none" class="answerTxt" name="answerTxt1" rows="8" cols="20" placeholder="Answer 1"><?php if(!empty($error)) echo $_SESSION['MCQanswer1']?></textarea>
                        </div>
                    </div>
                    
                    <div class="ansTxtArea-container">
                        <div style="display:block;">
                            <label class="container">
                                <input type="radio" name="correctAns" value="ansOption2">
                                <span class="checkmark"></span>
                            </label>
                            <textarea style="resize:none" class="answerTxt" name="answerTxt2" rows="8" cols="20" placeholder="Answer 2"><?php if(!empty($error)) echo $_SESSION['MCQanswer2']?></textarea>
                        </div>
                    </div>
                    
                    <div class="ansTxtArea-container">
                        <div style="display:block;">
                            <label class="container">
                                <input type="radio" name="correctAns"  value="ansOption3">
                                <span class="checkmark"></span>
                            </label>
                            <textarea style="resize:none" class="answerTxt" name="answerTxt3" rows="8" cols="20" placeholder="Answer 3"><?php if(!empty($error)) echo $_SESSION['MCQanswer3']?></textarea>
                        </div>
                    </div>
                    
                    <div class="ansTxtArea-container">
                        <div style="display:block;">
                            <label class="container">
                                <input type="radio" name="correctAns" value="ansOption4">
                                <span class="checkmark"></span>
                            </label>
                            <textarea style="resize:none" class="answerTxt" name="answerTxt4" rows="8" cols="20" placeholder="Answer 4"><?php if(!empty($error)) echo $_SESSION['MCQanswer4']?></textarea>
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
                        //when onclick
                        //unset all the session
                        //unset($_SESSION['$questionTxt']);
                        //unset($_SESSION['$answerTxt1']);
                        //unset($_SESSION['$answerTxt2']);
                        //unset($_SESSION['$answerTxt3']);
                        //unset($_SESSION['$answerTxt4']);
                        echo "<a onClick=\"javascript: return confirm('Are you sure to cancel?');\" href='editGame.php?instructorID={$instructorID}&classID={$classID}&gameID={$gameID}' class='questionCancelBtn'>cancel</a>"; 
                        ?>
                        
                        <!-- save button -->
                        <button type="submit" class="questionSaveBtn" name="save">
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
