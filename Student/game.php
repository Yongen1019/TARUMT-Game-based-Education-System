<?php

session_start();
include 'connect.php';
if (isset($_GET["gameID"]) && $_GET["gameID"] != "") {
    if (isset($_SESSION["gameID"])) {
        if ($_SESSION["gameID"] != $_GET["gameID"]) {
            unset($_SESSION["scoreAwarded"]);
            unset($_SESSION["pointEarned"]);
            unset($_SESSION["questionNo"]);
            unset($_SESSION["questionID"]);
            unset($_SESSION["questionType"]);
            unset($_SESSION["questionDuration"]);
            unset($_SESSION["quizName"]);
            unset($_SESSION["currentScore"]);
            unset($_SESSION["timeTaken"]);
            unset($_SESSION["currentPoint"]);
            unset($_SESSION["time"]);
        }
    }
    $_SESSION["gameID"] = $_GET["gameID"];
    $gameID = $_SESSION["gameID"];
} else {
    $gameID = $_SESSION["gameID"];
    if ($gameID == "") {
        header("location:classroom.php");
    }
}

if (isset($gameID)) {
    if (isset($_SESSION["eliminatePower"]) || isset($_SESSION["randomEliminate"])) {
        unset($_SESSION["eliminatePower"]);
        unset($_SESSION["randomEliminate"]);
    }
    if (!isset($_SESSION["questionNo"])) {
        $_SESSION["questionNo"] = 0;
        $_SESSION["currentScore"] = 0;
        $_SESSION["currentPoint"] = 0;
    }
    if (isset($_GET["answer"])) {
        $_SESSION["currentScore"] = $_SESSION["currentScore"] + $_SESSION["scoreAwarded"];
        $_SESSION["currentPoint"] = $_SESSION["currentPoint"] + $_SESSION["pointEarned"];
    }
    $i = $_SESSION["questionNo"];
    $query = "select * from gamequestion q, game g where g.gameID = :gameID and q.gameID = g.gameID order by q.questionID asc limit $i,1";
    $statement = $db->prepare($query);
    $statement->execute(
            array(
                'gameID' => $gameID
            )
    );
    $row = $statement->fetch();
    $type = $row["questionType"];
    $_SESSION["scoreAwarded"] = $row["scoreAwarded"];
    $_SESSION["pointEarned"] = $row["pointEarned"];
    $_SESSION["questionID"] = $row["questionID"];
    $_SESSION["quizName"] = $row["quizName"];
    ++$_SESSION["questionNo"];
    if ($_SESSION["questionNo"] != 1) {
        if (isset($_SESSION["time"])) {
            $_SESSION["timeTaken"] = $_SESSION["timeTaken"] + ($_SESSION["questionDuration"] - $_SESSION["time"]);
        } else {
            $_SESSION["timeTaken"] = $_SESSION["timeTaken"] + $_SESSION["questionDuration"];
        }
    }
    unset($_SESSION["time"]);
    if ($type != "") {
        $_SESSION["questionType"] = $row["questionType"];
        $_SESSION["questionDuration"] = $row["duration"];
        if ($_SESSION["questionNo"] != 1) {
            header("location:breakPage.php");
        } else {
            include 'countdownRedirect.php';
        }
    } else {
        unset($_SESSION["scoreAwarded"]);
        unset($_SESSION["pointEarned"]);
        unset($_SESSION["questionNo"]);
        unset($_SESSION["questionID"]);
        unset($_SESSION["questionType"]);
        unset($_SESSION["questionDuration"]);
        unset($_SESSION["quizName"]);
        header("location:endGame.php");
    }
}
?>

