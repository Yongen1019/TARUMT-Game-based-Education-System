<?php
session_start();
include 'connect.php';

if (!isset($_SESSION["gameID"])) {
    header("location:login.php");
} else {
    $query = "select * from score where studentID = :studentID";
    $statement = $db->prepare($query);
    $statement->execute(
            array(
                'studentID' => $_SESSION["studentID"]
            )
    );
    $count = $statement->rowCount();
    if ($count > 0) {
        $delquery = "delete from score WHERE studentID = :studentID";
        $delstatement = $db->prepare($delquery);
        $delstatement->execute(
                array(
                    'studentID' => $_SESSION["studentID"]
                )
        );
    }
    $query = "select scoreID from score order by scoreID DESC LIMIT 1";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchColumn();
    $result = substr($result, 2);
    $id = (int) $result;
    $id = sprintf("%06d", ++$id);
    $id = "SC$id";

    $query = "insert into score (scoreID, score, time, gameID, studentID) VALUES (:id, :score, :time, :gameID, :studentID)";
    $statement = $db->prepare($query);
    $statement->execute(
            array(
                'id' => $id,
                'score' => $_SESSION["currentScore"],
                'time' => $_SESSION["timeTaken"],
                'gameID' => $_SESSION["gameID"],
                'studentID' => $_SESSION["studentID"]
            )
    );
    unset($_SESSION["currentScore"]);
    unset($_SESSION["timeTaken"]);
    unset($_SESSION["currentPoint"]);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Homepage</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/endGame.css" />
    </head>
    <body>
        <div class="whole">
            <a href="viewScoreAndRanking.php?gameID=<?php echo $_SESSION["gameID"]; ?>" class="link">
                <div class="contentMiddle">
                    <p class="congrats">You have completed the game</p>
                    <p class="hint">Click anywhere to continue</p>
                </div>
            </a>
        </div>
    </body>
</html>
