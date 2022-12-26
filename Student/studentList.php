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
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Homepage</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/studentList.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!-- The sidebar -->
        <div class="sidebar">
            <a href="classroom.php">Classroom</a>
            <a class="active" href="studentList.php">Member List</a>
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

                        <!-- Instructor -->
                        <div class="instructorList">
                            <!--Student List Table-->
                            <table class="instructorListTable">
                                <th colspan="3">Instructor</th>

                                <?php
                                $insquery = "select * from instructoraccount where instructorID = :instructorID";
                                $insstatement = $db->prepare($insquery);
                                $insstatement->execute(
                                        array(
                                            'instructorID' => $row["instructorID"]
                                        )
                                );
                                $inscount = $insstatement->rowCount();
                                if ($inscount > 0) {
                                    while ($insrow = $insstatement->fetch()) {
                                        ?>
                                        <tr>
                                            <td class="left">
                                                <img class="instructorPic" src="../Instructor/profileImage/<?php echo $insrow["profilePicture"]; ?>" />
                                            </td>
                                            <td class="center iListName"><?php echo $insrow["username"]; ?> (<?php echo $insrow["instructorName"]; ?>)</td>
                                        </tr>

                                        <?php
                                    }
                                }
                                ?>
                            </table>

                        </div>

                        <!--Student List -->
                        <div class="studentList">

                            <!--Student List Table-->
                            <table class="studentListTable">
                                <th colspan="3">Student List</th>
                                <?php
                                $stuquery = "select * from classroomjoined j, studentaccount s where j.classID = :classID AND s.studentID = j.studentID";
                                $stustatement = $db->prepare($stuquery);
                                $stustatement->execute(
                                        array(
                                            'classID' => $classID
                                        )
                                );
                                $stucount = $stustatement->rowCount();
                                if ($stucount > 0) {
                                    while ($sturow = $stustatement->fetch()) {
                                        ?>
                                        <tr>
                                            <td class="left">
                                                <img class="studentPic" src="img/<?php echo $sturow["profilePicture"]; ?>" />
                                            </td>
                                            <td class="center sListName"><?php echo $sturow["username"]; ?> (<?php echo $sturow["studentName"]; ?>)</td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </table>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>
