<?php
session_start();
include 'connect.php';
if (isset($_SESSION["studentID"])) {
    $studentID = $_SESSION["studentID"];
    $query = "select * from studentaccount where studentID = :studentID";
    $statement = $db->prepare($query);
    $statement->execute(
            array(
                'studentID' => $studentID
            )
    );
    $row = $statement->fetch();
} else {
    header("location:logout.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Profile</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">        
        <link rel="stylesheet" type="text/css" href="css/userProfile.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!-- The sidebar -->
        <div class="sidebar">
            <a class="active" href="userProfile.php">User Profile</a>
            <a href="changePassword.php">Change Password</a>
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
                <div class="userProfileFormContainer">
                    <div class="upload">
                        <img src="img/<?php echo $row["profilePicture"]; ?>" class="userProfilePic" title="<?php echo $_SESSION["profilePic"]; ?>">
                    </div>
                    <br/>
                    <div class="infoContainer">
                        <?php
                        if ($row["gender"] == "F") {
                            ?>
                            <p><i style="font-size:16px;font-weight: 800;color:salmon;" class="fa">&#xf221;</i>
                                <?php
                            } else {
                                ?>
                            <p><i style="font-size:16px;font-weight: 800;color:blue;" class="fa">&#xf222;</i>
                                <?php
                            }
                            ?>
                            <?php echo $row["studentName"]; ?></p>
                        <p><i style="font-size:14px;font-weight: 800;color:#541b1a;" class="fa">&#xf003;</i> <?php echo $row["email"]; ?></p>
                    </div>
                    <label for="className">Username</label><br>
                    <input type="text" id="username" name="username" value="<?php echo $row["username"]; ?>" disabled><br>

                    <button onclick="window.location.href = 'editUserProfile.php'" class="editBtn">UPDATE PROFILE</button>

                </div>
            </div>
        </div>
    </body>
</html>
