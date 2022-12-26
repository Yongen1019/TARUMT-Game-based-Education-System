<?php
session_start();
include 'connect.php';
$studentID = "";
if (isset($_SESSION["studentID"])) {
    $studentID = $_SESSION["studentID"];
} else {
    header("location:logout.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Homepage</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/changePassword.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    </head>
    <body>
        <!-- The sidebar -->
        <div class="sidebar">
            <a href="userProfile.php">User Profile</a>
            <a class="active" href="changePassword.php">Change Password</a>
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
                <h1>Change Current Password</h1>
                <div class="addClassFormContainer">
                    <form method="post" class="addClassForm">
                        <label for="password">Current Password</label><br>
                        <input type="password" id="currentPassword" name="currentPassword" value="<?php
                        if (isset($_POST["currentPassword"])) {
                            echo $_POST["currentPassword"];
                        } else {
                            if (isset($_SESSION["current"])) {
                                echo $_SESSION["current"];
                            }
                        }
                        ?>" required>
                        <input id="showPwCheckBox" type="checkbox" onclick="showCurrentPassword()"><span id="showPwTxt">Show Password</span><br><br>

                        <label for="password" class="changePwTitle">New Password</label><br>
                        <input type="password" id="newPassword" name="newPassword" value="<?php
                        if (isset($_POST["newPassword"])) {
                            echo $_POST["newPassword"];
                        }
                        ?>" oninput="invalidNew(this);" pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}" title="Password must contain at least one number and one alphabet, and at least 8 or more characters." maxlength="100" required disabled>
                        <input id="showPwCheckBox" type="checkbox" onclick="showNewPassword()"><span id="showPwTxt">Show Password</span><br><br>

                        <label for="password" class="changePwTitle">Confirmed New Password</label><br>
                        <input type="password" id="confirmNewPassword" name="confirmNewPassword" value="<?php
                        if (isset($_POST["confirmNewPassword"])) {
                            echo $_POST["confirmNewPassword"];
                        }
                        ?>" required disabled>
                        <input id="showPwCheckBox" type="checkbox" onclick="showConfirmNewPassword()"><span id="showPwTxt">Show Password</span><br>

                        <script>
                            function showCurrentPassword() {
                                var x = document.getElementById("currentPassword");
                                if (x.type === "password") {
                                    x.type = "text";
                                } else {
                                    x.type = "password";
                                }
                            }

                            function showNewPassword() {
                                var x = document.getElementById("newPassword");
                                if (x.type === "password") {
                                    x.type = "text";
                                } else {
                                    x.type = "password";
                                }
                            }

                            function showConfirmNewPassword() {
                                var x = document.getElementById("confirmNewPassword");
                                if (x.type === "password") {
                                    x.type = "text";
                                } else {
                                    x.type = "password";
                                }
                            }
                        </script>

                        <input type="submit" value="CHANGE" name="change" class="saveBtn">
                    </form> 
                </div>
            </div>
        </div>
    </body>
    <script>
        function inputDisabled() {
            document.getElementById("currentPassword").disabled = true;

            document.getElementById("newPassword").disabled = false;

            document.getElementById("confirmNewPassword").disabled = false;
        }

        function invalidNew(textbox) {
            var x = document.getElementById("currentPassword").value;
            if (textbox.value === x) {
                textbox.setCustomValidity('New password must be different with current password.');
            } else {
                textbox.setCustomValidity('');
            }
        }

//        function invalidConfirm(textbox) {
//            var x = document.getElementById("newPassword").value;
//            if (textbox.value !== x) {
//                textbox.setCustomValidity('Confirm password not matched with new password.');
//            } else {
//                textbox.setCustomValidity('');
//            }
//        }
    </script>
    <?php
    if (isset($_POST["change"])) {
        if (isset($_POST["currentPassword"])) {
            $query = "select password from studentaccount where studentID = :studentID";
            $statement = $db->prepare($query);
            $statement->execute(
                    array(
                        'studentID' => $studentID
                    )
            );
            $result = $statement->fetchColumn();
            if ($result == $_POST["currentPassword"]) {
                $_SESSION["current"] = $_POST["currentPassword"];
                echo "<script> inputDisabled(); </script>";
            } else {
                echo '<script>alert("Current Password Incorrect.")</script>';
            }
        } else {
            if ($_POST["newPassword"] == $_POST["confirmNewPassword"]) {
                $query = "update studentaccount set password = :password where studentID = :studentID";
                $statement = $db->prepare($query);
                $statement->execute(
                        array(
                            'password' => $_POST["newPassword"],
                            'studentID' => $studentID
                        )
                );
                unset($_SESSION["current"]);
                echo '<script>alert("Password updated successfully, please login again."); window.location.href="logout.php";</script>';
            } else {
                echo '<script>alert("Confirm password not matched with new password.");</script>';
                echo "<script> inputDisabled(); </script>";
            }
        }
    }
    ?>
</html>
