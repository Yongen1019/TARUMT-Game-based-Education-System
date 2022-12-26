<?php
session_start();
include 'connect.php';

if (!isset($_SESSION["gameID"])) {
    echo '<script>alert("Something went wrong, please try again."); window.location.href="classroom.php";</script>';
} else {
    if ($_SESSION["questionType"] == "multiple-choice question") {
        $query = "select * from power p, gamepower g where p.powerID = g.powerID and g.status = 1 and g.gameID = :gameID";
        $statement = $db->prepare($query);
        $statement->execute(
                array(
                    'gameID' => $_SESSION["gameID"]
                )
        );
        $count = $statement->rowCount();
    } else {
        $query = "select * from power p, gamepower g where g.status = 1 and p.powerID = g.powerID and g.gameID = :gameID except (select * from power p, gamepower g where g.status = 1 and p.powerID = g.powerID and g.gameID = :gameID and p.powerID = :mcqPower)";
        $statement = $db->prepare($query);
        $statement->execute(
                array(
                    'gameID' => $_SESSION["gameID"],
                    'mcqPower' => "PO000002"
                )
        );
        $count = $statement->rowCount();
    }
}

if (isset($_POST["exchange"])) {
    $powerPointNeeded = $_POST["powerPointNeeded"];
    if ($_SESSION["currentPoint"] >= $powerPointNeeded) {
        $exchangedPowerID = $_POST["exchangedPowerID"];

        $_SESSION["currentPoint"] = $_SESSION["currentPoint"] - $powerPointNeeded;
        if ($exchangedPowerID == "PO000001") {
            $_SESSION["pointEarned"] = $_SESSION["pointEarned"] * 2;
        } else if ($exchangedPowerID == "PO000002") {
            $_SESSION["eliminatePower"] = "1";
        } else if ($exchangedPowerID == "PO000003") {
            $_SESSION["scoreAwarded"] = $_SESSION["scoreAwarded"] * 2;
        } else {
            echo '<script>alert("Something went wrong."); window.location.href="classroom.php";</script>';
        }
        unset($_SESSION["time"]);
        echo '<script>alert("Exchange power successfully."); window.location.href="countdownRedirect.php";</script>';
    } else {
        echo "<script>alert('Error. Your current point is not enough to exchange this power.');</script>";
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Homepage</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/powerExchangeStore.css" />

        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script>
            function exchangePower() {
                let text = "Are you sure to exchange this power?";
                if (confirm(text)) {
                    return true;
                }
                return false;
            }
        </script>
    </head>
    <body>
        <!-- Top Nav Bar -->
        <div class="loginTopNavBar">
            <div class="topNavContent">
                <p class="topNavTxtLeft"><a href="powerList.php"><i style='font-size:24px;cursor:pointer;color: white;' class='fas'>&#xf128;</i></a></p>
                <p class="topNavTxtCenter">Score Obtained: <?php echo $_SESSION["currentScore"]; ?> &emsp; &emsp; &emsp; Point Obtained: <?php echo $_SESSION["currentPoint"]; ?></p>
                <p class="topNavTxtRight">&emsp;</p>
            </div>
        </div>

        <div class="goBackBtn">
            <button class="backBtn" onclick="location.href = 'breakPage.php'">
                <i style='font-size:20px;color: #1a1b54; cursor: pointer;' class='fas'>&#xf137;</i>
                <span style="font-size:20px;text-transform: uppercase;color: #1a1b54;font-weight: 600;cursor: pointer;">Back</span>
            </button>
        </div>

        <!-- Page content -->
        <div class="content">

            <!-- Page content: Main Content -->
            <div class="contentMiddle">

                <div class="powerRow">
                    <?php
                    if ($count > 0) {
                        while ($row = $statement->fetch()) {
                            ?>
                            <div class="powerColumn">
                                <form method="post" onsubmit="return exchangePower()">
                                    <div class="card">
                                        <!-- Power Title -->
                                        <div class="powerTitle">
                                            <div class="powerTitleText"><?php echo $row["powerName"]; ?></div>
                                        </div>

                                        <!-- Power Desc -->
                                        <div>
                                            <p class="powerCardContent belowContentDesc"><?php echo $row["powerDescription"]; ?></p>
                                        </div>

                                        <!-- Bottom: Power Status and Point -->
                                        <div class="cardContentBelow">
                                            <button type="submit" name="exchange" class="powerCardContent belowContentPoints">
                                                <?php echo $row["pointExchange"]; ?> Points
                                                <input type="hidden" name="exchangedPowerID" value="<?php echo $row["powerID"]; ?>">
                                                <input type="hidden" name="powerPointNeeded" value="<?php echo $row["pointExchange"]; ?>">
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
        <div class="hintFooter"><i style='color: yellow; font-size: 20px;' class="fas">&#xf0eb;</i>&nbsp;Hint: You may use obtained points to exchange power, <i style='color: white' class='fas'>&#xf128;</i> in the top left corner shows all powers that the system currently has, you may ask your instructor to enable the powers you want for this game.</div>
    </body>
</html>
