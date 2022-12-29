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

if (isset($_FILES["image"]["name"])) {
    $imageName = $_FILES["image"]["name"];
    $imageSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    //Image validation
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $imageName);
    $imageExtension = strtolower(end($imageExtension));
    if (!in_array($imageExtension, $validImageExtension)) {
        echo'<script>alert("Invalid Image Extension!!")</script>';
    } elseif ($imageSize > 1200000) {
        echo'<script>alert("Image Size Is Too Large!!")</script>';
    } else {
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date("His");
        $newImageName = $studentID.$date;
        $newImageName .= '.' . $imageExtension;
        $query = "update studentaccount set profilePicture = :newImageName where studentID = :studentID";
        $statement = $db->prepare($query);
        $statement->execute(
                array(
                    'newImageName' => $newImageName,
                    'studentID' => $studentID
                )
        );
        if ($_SESSION["profilePic"] != "blue.png" && $_SESSION["profilePic"] != "red.png") {
            unlink('img/'.$_SESSION["profilePic"]);
        }
        move_uploaded_file($tmpName, 'img/' . $newImageName);
        $_SESSION["profilePic"] = $newImageName;
        header("location:editUserProfile.php");
    }
}

if (isset($_POST["update"])) {
    $query = "update studentaccount set username = :newusername where studentID = :studentID";
    $statement = $db->prepare($query);
    $statement->execute(
            array(
                'newusername' => $_POST["iUsername"],
                'studentID' => $studentID
            )
    );

    echo '<script>alert("User Profile Updated Successfully."); window.location.href="userProfile.php";</script>';
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Homepage</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/editUserProfile.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <!-- The sidebar -->
        <div class="sidebar">
            <a class="active" href="userProfile.php">User Profile</a>
            <a href="changePassword.php">Change Password</a>
            <div class="homeBtn">
                <a href="userProfile.php">cancel</a>
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
                <div class="userProfileFormContainer">
                    <form enctype="multipart/form-data" id="form" method="post">
                        <div class="upload">
                            <img src="img/<?php echo $row["profilePicture"]; ?>" class="userProfilePic" title="<?php echo $row["profilePicture"]; ?>">
                            <div class="round">
                                <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
                                <i class="fa fa-camera" style="color: #fff;"></i>
                            </div>
                        </div>
                    </form>
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
                    <form class="userProfileForm" method="post">
                        <label for="className">Username</label><br>
                        <input type="text" id="iUsername" name="iUsername" value="<?php echo $row["username"]; ?>" maxlength="50" autofocus required><br>

                        <input type="submit" value="UPDATE" name="update" class="saveBtn">
                    </form> 
                </div>
            </div>
        </div>
    </body>

    <script type="text/javascript">
        document.getElementById("image").onchange = function () {
            document.getElementById("form").submit();
        };
    </script>
</html>
