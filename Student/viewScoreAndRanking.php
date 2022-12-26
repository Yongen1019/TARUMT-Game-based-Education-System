<?php
session_start();
include 'connect.php';
$i = 3;
$studentID = "";
$count = "";
if (isset($_SESSION["studentID"])) {
    $studentID = $_SESSION["studentID"];
} else {
    header("location:logout.php");
}

if ($_GET['gameID'] != "") {
    $_SESSION["gameID"] = $_GET["gameID"];
    $gameID = $_SESSION["gameID"];
} else {
    $gameID = $_SESSION["gameID"];
    if ($gameID == "") {
        header("location:classroom.php");
    }
}

if (isset($gameID)) {
    $query = "select quizName from game where gameID = :gameID";
    $statement = $db->prepare($query);
    $statement->execute(
            array(
                'gameID' => $gameID
            )
    );
    $result = $statement->fetchColumn();

    $query1 = "select studentName, username, score, time, row_num from (select st.studentName, st.username, s.score, s.time, ROW_NUMBER() over (order by s.score desc, time asc) as row_num from score s, studentaccount st where s.gameID = :gameID and st.studentID = s.studentID) nw where row_num = :rownum";
    $statement1 = $db->prepare($query1);
    $statement1->execute(
            array(
                'gameID' => $gameID,
                'rownum' => 1
            )
    );
    $count1 = $statement1->rowCount();

    $query2 = "select studentName, username, score, time, row_num from (select st.studentName, st.username, s.score, s.time, ROW_NUMBER() over (order by s.score desc, time asc) as row_num from score s, studentaccount st where s.gameID = :gameID and st.studentID = s.studentID) nw where row_num = :rownum";
    $statement2 = $db->prepare($query2);
    $statement2->execute(
            array(
                'gameID' => $gameID,
                'rownum' => 2
            )
    );
    $count2 = $statement2->rowCount();

    $query3 = "select studentName, username, score, time, row_num from (select st.studentName, st.username, s.score, s.time, ROW_NUMBER() over (order by s.score desc, time asc) as row_num from score s, studentaccount st where s.gameID = :gameID and st.studentID = s.studentID) nw where row_num = :rownum";
    $statement3 = $db->prepare($query3);
    $statement3->execute(
            array(
                'gameID' => $gameID,
                'rownum' => 3
            )
    );
    $count3 = $statement3->rowCount();

    $query4 = "select studentName, username, score, time, row_num from (select st.studentName, st.username, s.score, s.time, ROW_NUMBER() over (order by s.score desc, time asc) as row_num from score s, studentaccount st where s.gameID = :gameID and st.studentID = s.studentID) nw where row_num >= :rownum";
    $statement4 = $db->prepare($query4);
    $statement4->execute(
            array(
                'gameID' => $gameID,
                'rownum' => 4
            )
    );
    $count4 = $statement4->rowCount();
}
?>
<html>
    <head>
        <meta charset="UTF-8">
            <title>Score and Ranking</title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
                <link rel="stylesheet" type="text/css" href="css/viewScoreAndRanking.css">
                    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
                    </head>
                    <body>
                        <!-- Top Nav Bar -->
                        <div class="loginTopNavBar">
                            <div class="topNavContent">
                                <p class="topNavTxtLeft"></p>
                                <p class="topNavTxtCenter"><?php echo $result; ?></p>
                                <p class="topNavTxtRight"></p>
                            </div>
                        </div>
                        <div class="goBackBtn">
                            <button class="backBtn" onclick="location.href = 'classroom.php'">
                                <i style='font-size:20px;color: #1a1b54; cursor: pointer;' class='fas'>&#xf137;</i>
                                <span style="font-size:20px;text-transform: uppercase;color: #1a1b54;font-weight: 600;cursor: pointer;">Back</span>
                            </button>
                        </div>
                        <div class="scoreAndRankContent">
                            <?php
                            if ($count1 > 0) {
                                $row1 = $statement1->fetch();
                                ?>
                                <div class="container podium">
                                    <div class="podium__item">
                                        <?php
                                        if ($count2 > 0) {
                                            $row2 = $statement2->fetch();
                                            ?>
                                            <p class="podium__score">Score: <?php echo $row2["score"];?> <br/>[Time Taken: <?php echo $row2["time"];?><span style="text-transform: lowercase">s</span>]</p>
                                            <p class="podium__city"><?php echo $row2["username"]; ?></p>
                                            <?php
                                        }
                                        ?>
                                        <div class="podium__rank second">2</div>
                                    </div>
                                    <div class="podium__item">
                                        <p class="podium__score">Score: <?php echo $row1["score"]; ?> <br/>[Time Taken: <?php echo $row1["time"];?><span style="text-transform: lowercase">s</span>]</p>
                                        <p class="podium__city"><?php echo $row1["username"]; ?></p>
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
                                        if ($count3 > 0) {
                                            $row3 = $statement3->fetch();
                                            ?>
                                            <p class="podium__score">Score: <?php echo $row3["score"]; ?> <br/>[Time Taken: <?php echo $row3["time"];?><span style="text-transform: lowercase">s</span>]</p>
                                            <p class="podium__city"><?php echo $row3["username"]; ?></p>
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
                                            if ($count4 > 0) {
                                                ?>
                                                <span class="text">Ranking Out of Podium: </span>
                                                        
                                            <?php
                                                while ($row4 = $statement4->fetch()) {
                                                    ?>
                                                    <tr>
                                                        <td class="left">
                                                            <?php echo ++$i; ?>
                                                        </td>
                                                        <td class="center iListName"><?php echo $row4["username"]; ?> </td>
                                                        <td class="right">Score: <?php echo $row4["score"]; ?> <br/>[Time Taken: <?php echo $row4["time"];?><span style="text-transform: lowercase">s</span>]</td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <?php
                            } else {
                                echo '<script>alert("No players have completed the game, launch game to become the first player."); window.location.href="classroom.php";</script>';
                            }
                            ?>
                        </div>
                    </body>
                    </html>
