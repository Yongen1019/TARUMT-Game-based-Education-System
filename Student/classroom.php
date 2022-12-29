<?php
session_start();
include 'connect.php';
$studentID = "";
$count = "";
if (isset($_SESSION["studentID"])) {
    $studentID = $_SESSION["studentID"];
} else {
    header("location:logout.php");
}

if (isset($_POST["classID"])) {
    $_SESSION["classID"] = $_POST["classID"];
    $classID = $_SESSION["classID"];
} else {
    $classID = $_SESSION["classID"];
    if ($classID == "") {
        header("location:homepage.php");
    }
}
if (isset($classID)) {

    $query = "select * from classroom where classID = :classID";
    $statement = $db->prepare($query);
    $statement->execute(
            array(
                'classID' => $classID
            )
    );
    $count = $statement->rowCount();
}

//leave classroom
if (isset($_POST["leave"])) {
    $query = "delete from classroomjoined WHERE studentID = :studentID AND classID = :classID";
    $statement = $db->prepare($query);
    $statement->execute(
            array(
                'studentID' => $studentID,
                'classID' => $classID
            )
    );
    echo '<script>alert("Classroom left successfully."); window.location.href="homepage.php";</script>';
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Homepage</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/classroom.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

        <script>
            function leaveClassroom() {
                let text = "Are you sure to leave this classroom?";
                if (confirm(text)) {
                    return true;
                }
                return false;
            }
        </script> 
    </head>
    <body>
        <!-- The sidebar -->
        <div class="sidebar">
            <a class="active" href="classroom.php">Classroom</a>
            <a href="studentList.php">Member List</a>
            <div class="homeBtn">
                <a href="homepage.php">home</a>
            </div>
        </div>

        <!-- Page content -->
        <div class="content">

            <!-- Page content: TOP navigation bar -->
            <div class="contentTopNavBar">
                <a href="#"  style="color: #1a1b54;font-weight: 650;">TARUMT Game-based Learning System</a>
                <div class="usernamePosition">
                    <ul>
                        <li>
                            <button onclick="window.location.href = 'userProfile.php'" class="profileBtn">
                                <img class="profilePic" src="img/<?php echo $_SESSION["profilePic"]; ?>" />
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
                <!-- Classroom Title Bar -->
                <?php
                if ($count > 0) {
                    while ($row = $statement->fetch()) {
                        ?>
                        <div class="titleBar">
                            <div class="classroom">
                                <p class="classroomTxt"><?php echo $row["className"]; ?></p>
                                <p class="subjectTxt"><?php echo $row["classSubject"]; ?></p>
                                <p class="descTxt"><?php echo $row["classDescription"]; ?></p>
                            </div>
                        </div>

                        <?php
                    }
                }
                ?>

                <!-- Buttons -->
                <form method="post" onsubmit="return leaveClassroom()">
                    <div class="btnSelections">
                        <!-- Leave Classroom -->
                        <button type="submit" name="leave" class="shareCodebtn">
                            <i style="font-size:16px;margin-right:3px;" class="fa">&#xf071;</i> 
                            Leave Classroom
                        </button>
                    </div>
                </form>

                <!-- Game Quiz Created -->
                <?php
                $query = "select * from game where classID = :classID order by classID desc";
                $statement = $db->prepare($query);
                $statement->execute(
                        array(
                            'classID' => $classID
                        )
                );
                $count = $statement->rowCount();
                if ($count > 0) {
                    while ($row = $statement->fetch()) {

                        $gqquery = "select * from gamequestion where gameID = :gameID";
                        $gqstatement = $db->prepare($gqquery);
                        $gqstatement->execute(
                                array(
                                    'gameID' => $row["gameID"]
                                )
                        );
                        $gqcount = $gqstatement->rowCount();
                        if ($gqcount != 0) {
                            ?>
                            <div class="gameQuizList">
                                <div class="gameQuiz">
                                    <!-- Menu button of the power -->
                                    <div class="dropdown" style="float:right;margin-bottom: 10px;">
                                        <button class="quizMenuBtn">
                                            <i style="font-size:24px;cursor:pointer" class="fa">&#xf0c9;</i>
                                        </button>
                                        <div class="dropdown-content">
                                            <a id="dropdown-a" href="game.php?gameID=<?php echo $row["gameID"]; ?>">Launch Game</a>
                                            <a id="dropdown-a" href="viewScoreAndRanking.php?gameID=<?php echo $row["gameID"]; ?>">View Score and Ranking</a>
                                        </div>
                                    </div>

                                    <p class="quizName"><?php echo $row["quizName"]; ?></p>
                                    <p class="quizScore">Total score: <?php echo $row["totalScore"]; ?></p>
                                    <p class="quizTotalQuestion"><?php echo $gqcount; ?> questions</p>
                                </div>
                            </div>
                            <br>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>