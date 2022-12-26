<?php
session_start();
include 'connect.php';
$email = "";
$studentID = "";
date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date("Y-m-d H:i:s");
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
    if (!isset($_SESSION["studentID"])) {
        $query = "select * from studentaccount where email = :email";
        $statement = $db->prepare($query);
        $statement->execute(
                array(
                    'email' => $email
                )
        );
        $row = $statement->fetch();
        $_SESSION["studentID"] = $row["studentID"];
        $_SESSION["profilePic"] = $row["profilePicture"];
    }
    $studentID = $_SESSION["studentID"];
    $query = "select * from classroomjoined j, classroom c where j.studentID = :studentID AND c.classID = j.classID";
    $statement = $db->prepare($query);
    $statement->execute(
            array(
                'studentID' => $studentID
            )
    );
    $count = $statement->rowCount();
} else {
    header("location:logout.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Homepage</title>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/homepage.css">
    </head>
    <body>
        <!-- The sidebar -->
        <div class="sidebar">
            <a class="active" href="homepage.php">Classroom List</a>
        </div>

        <!-- Page content -->
        <div class="content">
            <!-- Page content: TOP navigation bar -->
            <div class="contentTopNavBar">
                <a href="#"  style="color: #1a1b54;font-weight: 650;">TARUMT Game-based Learning System</a>
                <div class="usernamePosition">
                    <ul>
                        <li>
                            <button  onclick="window.location.href = 'userProfile.php'" class="profileBtn">
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
                <div class="createClassBtn">
                    <a href="joinclassroom.php"><i style='font-size:16px;margin-right:3px;' class='fas'>&#xf067;</i> Join Classroom</a>
                </div>

                <!-- Classroom List -->
                <div class="classRow">
                    <?php
                    if ($count > 0) {
                        while ($row = $statement->fetch()) {
                            ?>
                            <form method="post" action="classroom.php">
                                <div class="classColumn">
                                    <div class="card">
                                        <h3 class="classTitle"><?php echo $row["className"]; ?></h3>
                                        <p class="classCardContent subjectTxt"><?php echo $row["classSubject"]; ?></p>
                                        <p class="classCardContent descTxt"><?php echo $row["classDescription"]; ?></p>
                                    </div>
                                    <button class="intoClassBtn" type="submit">Select</button>
                                    <input type="hidden" id="classID" name="classID" value="<?php echo $row["classID"]; ?>" />

                                </div>
                            </form>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>