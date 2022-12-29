<?php
session_start();
include 'connect.php';

if (!isset($_SESSION["gameID"])) {
    echo '<script>alert("Something went wrong, please try again."); window.location.href="classroom.php";</script>';
} else {
    $query = "select * from power";
    $statement = $db->prepare($query);
    $statement->execute();
    $count = $statement->rowCount();
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Power List</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/powerList.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    </head>
    <body>
        <!-- Top Nav Bar -->
        <div class="loginTopNavBar">
            <div class="topNavContent">
                <p class="topNavTxtLeft"></p>
                <p class="topNavTxtCenter">TARUMT Game-based Learning System</p>
                <p class="topNavTxtRight"></p>
            </div>
        </div>

        <div class="goBackBtn">
            <button class="backBtn" onclick="location.href = 'powerExchangeStore.php'">
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
                        <div class="card">

                            <!-- Power Title -->
                            <div class="powerTitle">
                                <div class="powerTitleText"><?php echo $row["powerName"]; ?></div>
                            </div>

                            <!-- Power Desc -->
                            <div>
                                <p class="powerCardContent belowContentDesc"><?php echo $row["powerDescription"]; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                
            </div>
        </div>
    </body>
</html>
