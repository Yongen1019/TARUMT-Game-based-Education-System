<?php
session_start();
include 'connect.php';
$id = "";
$joinedDate = "";
$classID = "";
$studentID = "";
if (isset($_SESSION["studentID"])) {
    $studentID = $_SESSION["studentID"];
} else {
    header("location:logout.php");
}

if (isset($_POST["join"])) {
    $query = "select * from classroom where classcode = :code";
    $statement = $db->prepare($query);
    $statement->execute(
            array(
                'code' => $_POST["code"]
            )
    );
    $count = $statement->rowCount();
    if ($count > 0) {
        $result = $statement->fetchColumn();
        $classID = $result;

        $query = "select * from classroomjoined where classID = :classID AND studentID = :studentID";
        $statement = $db->prepare($query);
        $statement->execute(
                array(
                    'classID' => $classID,
                    'studentID' => $studentID
                )
        );
        $count = $statement->rowCount();
        if ($count > 0) {
            echo '<script>alert("Classroom joined before.")</script>';
        } else {
            $query = "select classJoinedID from classroomjoined order by classJoinedID DESC LIMIT 1";
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchColumn();
            $result = substr($result, 2);
            $id = (int)$result;
            $id = sprintf("%06d", ++$id);
            $id = "CJ$id";
            
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $joinedDate = date("Y-m-d H:i:s");

            $query = "insert into classroomjoined (classJoinedID, joinedDate, classID, studentID) VALUES (:id, :joinedDate, :classID, :studentID)";
            $statement = $db->prepare($query);
            $statement->execute(
                    array(
                        'id' => $id,
                        'joinedDate' => $joinedDate,
                        'classID' => $classID,
                        'studentID' => $studentID
                    )
            );
            echo '<script>alert("Classroom joined successfully."); window.location.href="homepage.php";</script>';
        }
    } else {
        echo '<script>alert("Class code not found.")</script>';
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Join Class</title>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/joinClassroom.css">
    </head>
    <body>
        <!-- The sidebar -->
        <div class="sidebar">
            <a class="active" href="homepage.php">Classroom List</a>
            <div class="homeBtn">
                <a href="homepage.php">cancel</a>
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
                <form method="post" class="addClassForm">
                    <div class="join">
                        <ul>
                            <li class="hint">You can get the class code from your instructor.</li>
                            <li class="hint">Use a class code with 6 letters or numbers.</li>
                            <li class="hint">No spaces or symbols.</li>
                        </ul>
                        <label class="code" for="code">Class Code</label>
                        <input type="text" id="code" name="code" required>
                        <div class="btn">
                            <input type="submit" name="join" value="JOIN">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
