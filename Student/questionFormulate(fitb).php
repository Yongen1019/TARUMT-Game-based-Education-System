<?php
session_start();
include 'connect.php';

if (!isset($_SESSION["questionID"])) {
    echo '<script>alert("Something went wrong, please try again."); window.location.href="classroom.php";</script>';
} else {
    $query = "select * from gamequestion where questionID = :questionID";
    $statement = $db->prepare($query);
    $statement->execute(
            array(
                'questionID' => $_SESSION["questionID"]
            )
    );
    $row = $statement->fetch();

    if (!isset($_SESSION["time"])) {
        $_SESSION["time"] = $row["duration"] - 1;
    }

    $ansquery = "select answerText from answeroption where questionID = :questionID";
    $ansstatement = $db->prepare($ansquery);
    $ansstatement->execute(
            array(
                'questionID' => $_SESSION["questionID"]
            )
    );
    $result = $ansstatement->fetchColumn();
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FITB</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/questionFormulate(fitb).css" />
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="jquery-1.8.0.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!-- Top Nav Bar -->
        <div class="loginTopNavBar">
            <div class="topNavContent">
                <p class="topNavTxtLeft"><?php echo $_SESSION["quizName"]; ?></p>
                <p class="topNavTxtCenter">TARUMT Game-based Learning System</p>
                <p class="topNavTxtRight">Question <?php echo $_SESSION["questionNo"]; ?></p>
            </div>
        </div>

        <button class="btnTimer">
            <h3><div id="timer"></div></h3>
        </button>
        <!-- Question Form -->
        <form id="ansForm" style="margin-top: -200px;">
            <!-- Question -->
            <div>
                <div class="questionTxtArea">
                    <textarea style="resize:none; background-color: white;" id="questionTxt" name="questionTxt" rows="7" cols="90" disabled><?php echo $row["question"]; ?></textarea>
                </div>
                <div class="answerTxtArea">
                    <label for="answerTxt">Answer:</label><br>
                    <input type="text" id="answerTxt" name="answerTxt" placeholder="Please type the answer here.">
                    <span hidden id="correct" class="correctTick"><i style='font-size:25px; cursor: pointer;' class='fas'>&#xf00c;</i></span>
                    <span hidden id="wrong" class="redCross"><i style='font-size:25px; cursor: pointer;' class='fas'>&#xf00d;</i></span><br>
                </div>
            </div>
        </form>
    </body>
    <script>

        $(document).ready(function () {

            var count = <?php echo $_SESSION["time"]; ?>;
            window.setInterval(function ()
            {
                if (count !== 0) {
                    --count;
                    $("#timer").load('time.php');
                } else {
                    window.location.href = "game.php";
                }
            }, 1000);
        });

        $('#ansForm').on('submit', function (e) {
            e.preventDefault();
            var input = $('#answerTxt').val();
            var ans = '<?php echo $result; ?>';
            
            $("#answerTxt").attr('disabled', 'disabled');
            if (input.toLowerCase() === ans.toLowerCase()) {
                document.getElementById("answerTxt").style.borderColor = "green";
                $("#correct").show();
                setTimeout(function () {
                    window.location.href = "game.php?answer=true";
                }, 1000);
            } else {
                document.getElementById("answerTxt").style.borderColor = "red";
                $("#wrong").show();
                setTimeout(function () {
                    window.location.href = "game.php";
                }, 1000);
            }
        });
    </script>
</html>
