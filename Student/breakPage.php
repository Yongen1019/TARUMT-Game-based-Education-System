<?php
session_start();
include 'connect.php';

if (!isset($_SESSION["questionID"])) {
    echo '<script>alert("Something went wrong, please try again."); window.location.href="classroom.php";</script>';
} else {
    
    if (!isset($_SESSION["time"])) {
        $_SESSION["time"] = 9;
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Break Time</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/breakPage.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="jquery-1.8.0.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body>
        <!-- Top Nav Bar -->
        <div class="loginTopNavBar">
            <div class="topNavContent">
                <p class="topNavTxtLeft"><a style='color:white;text-decoration:none;' href="powerExchangeStore.php">Power Store <i style='font-size:24px;' class='fas fa-charging-station'></i></a>
                <p class="topNavTxtCenter">Score Obtained: <?php echo $_SESSION["currentScore"]; ?> &emsp; &emsp; &emsp; Point Obtained: <?php echo $_SESSION["currentPoint"]; ?></p>
                <p class="topNavTxtRight"><span class="tab"></span></p>
            </div>
        </div>

        <form method="post">
            <div>
                <div class="nextScoreArea">
                    <p>Next Question - <?php echo $_SESSION["scoreAwarded"]; ?> Score [<?php echo $_SESSION["questionType"]; ?>] (<?php echo $_SESSION["questionDuration"]; ?>s)</p>
                    <div id="timer"></div><h3>remaining break time</h3><br><br>
                    <div class="container">
                        <input type="button" class="play" value="RESUME"/>
                        <input type="button" class="pause" value="PAUSE"/>
                    </div>
                </div>

            </div>
        </form>
        
        <div class="fixed-left-bottom-btn">
            <p class="instructorLoginTxt"><a href="countdownRedirect.php?skip=true">SKIP</a></p>
        </div>
        <div class="hintFooter"><i style='color: yellow; font-size: 20px;' class="fas">&#xf0eb;</i>&nbsp;Hint: Score obtained is used for ranking purposes & point obtained is used for power exchange purposes. The power exchange store entrance is in the top left corner.</div>
    </body>
    <script>
        $(document).ready(function () {

            var isPaused = false;
            var count = <?php echo $_SESSION["time"]; ?>;
            window.setInterval(function ()
            {
                if (!isPaused)
                {
                    if (count !== 0) {
                        --count;
                        $("#timer").load('time.php');
                    } else {
                        window.location.href = "countdownRedirect.php";
                    }
                }
            }, 1000);

            $('.pause').on('click', function (e) {
                e.preventDefault();
                isPaused = true;
            });

            $('.play').on('click', function (e) {
                e.preventDefault();
                isPaused = false;
            });
        });
    </script>

</html>
