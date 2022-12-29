<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Score and Ranking</title>
        <link rel="stylesheet" href="style.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
            
            .goBackBtn{
                margin: 80px 0 0 30px;
            }
            
            .backBtn{
                border:none;
                background-color: #fffafa;
            }
            
            
            /*----------- Score and Rank Start ------------*/

            .scoreAndRankContent{
                margin-top: 30px;
                margin-left: 33%;
                margin-right: 33%;
            }
            
            .container {
                display: flex;
                align-items: flex-end;
            }

            .podium__item {
                width: 200px;
            }

            .podium__rank {
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 35px;
                color: white;
            }

            .podium__city {
                text-align: center;
                padding: 0 .5rem;
                text-transform: uppercase;
                font-size: 20px;
                padding-bottom: 10px;
                color: #812928;
            }

            .podium__number {
                width: 27px;
                height: 75px;
            }

            .podium .first {
                min-height: 300px;
                background: rgba(129, 41, 40, 0.3);
                box-shadow:2px -2px 3px 1px grey;
            }

            .podium .second {
                min-height: 200px;
                background: rgba(129, 41, 40, 0.6);
                box-shadow:0px -2px 2px 0 grey;
            }

            .podium .third {
                min-height: 100px;
                background: rgba(129, 41, 40, 0.9);
                box-shadow:2px -2px 2px 0 rgba(184, 184, 184, 0.9);
            }
            
            
            .outOfPodiumTable{
                margin-top: 20px;
                width: 100%;
                border-collapse: collapse;
                color: #812928;
            }
            
            .outOfPodiumTable tr:last-child td{
                border-bottom: 1px solid rgba(129, 41, 40, 0.9);
            }
                
            .outOfPodiumTable td{
                padding: 10px;
                text-align: left;
                border-bottom: 1px dashed rgba(129, 41, 40, 0.2);
            }
            
            .outOfPodiumTable th{
                text-align: left;
                padding-top: 10px;
            }
            
            .outOfPodiumTable .left{
                font-weight: 600;
            }
            
            .outOfPodiumTable .right{
                text-align: right;
                font-weight: 700;
            }
            
            .outOfPodiumTable .center{
                text-transform: uppercase;
            }
            
            .scoreBold{
                font-weight: 700;
                font-size: 15px;
                }

            /*----------- Score and Rank End ------------*/
            
        </style>
    </head>
    <body>
        <?php
        if($_SESSION["email"]) {
            define('directAccess', TRUE);
        ?>
        <!-- Top Nav Bar -->
        <div class="loginTopNavBar">
            <div class="topNavContent">
                <?php
                
                $rank = 3;
                
                function findStudentName($studentID){
                    $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                    $findSql = "select * from StudentAccount WHERE studentID = '$studentID'";
                    $findresult = $con->query($findSql);
                
                    if($findresult){
                        while($row = $findresult->fetch_assoc()){
                            $username = $row["username"];
                        }
                    }
                    return $username;
                    $con->close();
                }
                
                ?>
                
                <?php
                
                $instructorID = $_GET['instructorID'];
                $classID = $_GET['classID'];
                $gameID = $_GET['gameID'];
                
                $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                
                //check any student participate the game
                $checkQuery = "select * from Score WHERE gameID = '$gameID'";
                $checkResult = $con->query($checkQuery);
                
                if($checkResult->num_rows == 0){
                    echo "<script>
                        location.replace('classroom.php?instructorID={$instructorID}&classID={$classID}')
                        alert('No students participated in the quiz.')</script>";
                }else{
                    $totalPlayers = $checkResult->num_rows;
                
                    //find quiz name
                    $findNameQuery = "select * from Game WHERE gameID = '$gameID'";
                    $findNameResult = $con->query($findNameQuery);

                    if($findNameResult){
                        while($row = $findNameResult->fetch_assoc()){
                            $quizName = $row["quizName"];
                        }
                    }

                    //find first
                    $firstQuery = "select * from Score WHERE gameID = '$gameID'
                              ORDER BY score DESC, time ASC
                              LIMIT 1";

                    $firstResult = $con->query($firstQuery);

                    if($firstResult){
                        while($row = $firstResult->fetch_assoc()){
                            $firstScore = $row["score"];
                            $firstTime = $row["time"];
                            $firstStudID = $row["studentID"];

                            $firstStudName = findStudentName($firstStudID);
                        }
                    }
                    $row_count1 = $firstResult->num_rows;

                    //find second
                    $secondQuery = "select * from Score WHERE gameID = '$gameID'
                              ORDER BY score DESC, time ASC
                              LIMIT 1 OFFSET 1";

                    $secondResult = $con->query($secondQuery);

                    if($secondResult){
                        while($row = $secondResult->fetch_assoc()){
                            $secondScore = $row["score"];
                            $secondTime = $row["time"];
                            $secondStudID = $row["studentID"];

                            $secondStudName = findStudentName($secondStudID);
                        }
                    }
                    $row_count2 = $secondResult->num_rows;

                    //find third
                    $thridQuery = "select * from Score WHERE gameID = '$gameID'
                              ORDER BY score DESC, time ASC
                              LIMIT 1 OFFSET 2";

                    $thirdResult = $con->query($thridQuery);

                    if($thirdResult){
                        while($row = $thirdResult->fetch_assoc()){
                            $thirdScore = $row["score"];
                            $thirdTime = $row["time"];
                            $thirdStudID = $row["studentID"];

                            $thirdStudName = findStudentName($thirdStudID);
                        }
                    }
                    $row_count3 = $thirdResult->num_rows;

                    //find the rest
                    $restQuery = "select * from Score WHERE gameID = '$gameID'
                                    ORDER BY score DESC, time ASC
                                    LIMIT 1 OFFSET 3";

                    $restResult = $con->query($restQuery);

                    if($restResult){
                        while($row = $restResult->fetch_assoc()){
                            $restScore = $row["score"];
                            $restTime = $row["time"];
                            $restStudID = $row["studentID"];

                            $restStudName = findStudentName($restStudID);
                        }
                    }
                    $row_count4 = $restResult->num_rows;
                }
                
                $con->close();
                
                ?>
                <p class="topNavTxtLeft"></p>
                <p class="topNavTxtCenter"><?php echo$quizName;?></p>
                <p class="topNavTxtRight"></p>
            </div>
        </div>
        <div class="goBackBtn">
            <button class="backBtn" onclick="history.back()">
                <i style='font-size:20px;color: #541b1a; cursor: pointer;' class='fas'>&#xf137;</i>
                <span style="font-size:20px;text-transform: uppercase;color: #541b1a;font-weight: 600;cursor: pointer;">Back</span>
            </button>
        </div>
        <div class="scoreAndRankContent">
            <div class="container podium">
                <div class="podium__item">
                    <?php
                    if($row_count2 > 0){                    
                    ?>
                        <p class="podium__city scoreBold">Score: <?php echo$secondScore;?> <br/>[Time Taken: 
                            <?php echo $secondTime;?><span style="text-transform: lowercase">s</span>]</p>
                        <p class="podium__city"><?php echo$secondStudName;?></p>
                    <?php 
                    }
                    ?>
                    <div class="podium__rank second">2</div>
                </div>
                <div class="podium__item">
                    <p class="podium__city scoreBold">Score: <?php echo$firstScore;?> <br/>[Time Taken: 
                        <?php echo $firstTime;?><span style="text-transform: lowercase">s</span>]</p>
                    <p class="podium__city"><?php echo$firstStudName;?></p>
                    <div class="podium__rank first">
                        <svg class="podium__number" viewBox="0 0 27.476 75.03" xmlns="http://www.w3.org/2000/svg">
                        <g transform="matrix(1, 0, 0, 1, 214.957736, -43.117417)">
                            <path class="st8" d="M -198.928 43.419 C -200.528 47.919 -203.528 51.819 -207.828 55.219 C -210.528 57.319 -213.028 58.819 -215.428 60.019 L -215.428 72.819 C -210.328 70.619 -205.628 67.819 -201.628 64.119 L -201.628 117.219 L -187.528 117.219 L -187.528 43.419 L -198.928 43.419 L -198.928 43.419 Z" style="fill: #fff;"/>
                        </g>
                        </svg>
                    </div>
                </div>
                <div class="podium__item">
                    <?php
                    if($row_count3 > 0){
                    ?>
                    <p class="podium__city scoreBold">Score: <?php echo$thirdScore;?> <br/>[Time Taken: 
                        <?php echo $thirdTime;?><span style="text-transform: lowercase">s</span>]</p>
                    <p class="podium__city"><?php echo$thirdStudName;?></p>
                    <?php 
                    }
                    ?>
                    <div class="podium__rank third">3</div>
                </div>
            </div>
            
            <div class="container_outOfPodium">
                <div class="outOfPodium">
                    <table class="outOfPodiumTable">
                        <?php
                        if($row_count4 > 0){   
                            $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                            $restPlayersQuery = "select * from Score WHERE gameID = '$gameID'
                                                ORDER BY score DESC, time ASC
                                                LIMIT $totalPlayers OFFSET 3 ";
                            $restPlayersResult = $con->query($restPlayersQuery);
                            if($restPlayersResult){
                                while($row = $restPlayersResult->fetch_assoc()){
                                    $restScore = $row["score"];
                                    $restStudID = $row["studentID"];

                                    $restStudName = findStudentName($restStudID);
                                
                        ?>
                        <th colspan="3">Others' ranking:</th>
                        <tr>
                            <td class="left">
                                <?php echo ++$rank; ?>
                            </td>
                            <td class="center iListName"><?php echo$restStudName; ?></td>
                            <td class="right">Score: <?php echo$restScore; ?> <br/>[Time Taken: 
                                <?php echo $restTime;?><span style="text-transform: lowercase">s</span>]</td>
                        </tr>
                        <?php 
                                }
                            }
                            $con->close();
                        }
                        ?>
                    </table>
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
