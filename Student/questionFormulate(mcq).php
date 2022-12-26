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

    $ansquery = "select * from answeroption where questionID = :questionID";
    $ansstatement = $db->prepare($ansquery);
    $ansstatement->execute(
            array(
                'questionID' => $_SESSION["questionID"]
            )
    );
    $count = $ansstatement->rowCount();

    if (isset($_SESSION["eliminatePower"])) {
        if (!isset($_SESSION["randomEliminate"])) {
            $_SESSION["randomEliminate"] = rand(0, $count - 2); //start from 0 and minus 1 correct answer
        }
        $ansquery = "select * from answeroption where questionID = :questionID except (select * from answeroption where questionID = :questionID and correctness = :wrong limit " . $_SESSION["randomEliminate"] . ", 1)";
        $ansstatement = $db->prepare($ansquery);
        $ansstatement->execute(
                array(
                    'questionID' => $_SESSION["questionID"],
                    'wrong' => '0'
                )
        );
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MCQ</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/questionFormulate(mcq).css">
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
        <form style="margin-top: -170px;" action="game.php">

            <!-- Question -->
            <div>
                <div class="questionTxtArea">
                    <textarea style="resize:none; background-color: white;" id="questionTxt" name="questionTxt" rows="7" cols="90" disabled><?php echo $row["question"]; ?></textarea>
                </div>
                <div class="answerTxtArea">
                    <?php
                    while ($ansrow = $ansstatement->fetch()) {
                        if ($ansrow["correctness"] == "0") {
                            ?>

                            <div class="ansTxtArea-container answerFalse">
                                <button class="trueFalseBtn answerFalse" id="<?php echo $ansrow["answerID"]; ?>" type="button" onclick="respond(this.id)">
                                    <div style="display:block;">
                                        <div class="answerTxt">
                                            <p class='trueFalseTxt'><?php echo $ansrow["answerText"]; ?></p>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <?php
                        } else if ($ansrow["correctness"] == "1") {
                            ?>

                            <div class="ansTxtArea-container answerTrue">
                                <button class="trueFalseBtn answerTrue" id="<?php echo $ansrow["answerID"]; ?>" type="button" onclick="respond(this.id)">
                                    <div style="display:block;">
                                        <div class="answerTxt">
                                            <p class='trueFalseTxt'><?php echo $ansrow["answerText"]; ?></p>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </form>
    </body>

    <script>

        var isTrue = null;

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


        function respond(answered_id) {
            var tr = document.getElementsByClassName("trueFalseBtn answerTrue");
            var fl = document.getElementById(answered_id);

            $(':button').prop('disabled', true);
            fl.className = fl.className.replace(" answerFalse", " red");
            tr[0].className = tr[0].className.replace(" answerTrue", " green");
            isTrue = document.getElementsByClassName("trueFalseBtn red");
            window.setTimeout(function () {
                if ($("button").hasClass("trueFalseBtn red")) {
                    window.location.href = "game.php";
                } else {
                    window.location.href = "game.php?answer=true";
                }
            }, 1000);

        };

    </script>
</html>
