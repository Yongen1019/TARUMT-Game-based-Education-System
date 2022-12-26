<?php
include 'connect.php';
if ($_GET['email'] == "") {
    header("location:verifyEmail.php");
}

if (isset($_POST["reset"])) {
    if ($_POST["password"] == $_POST["confirmNewPassword"]) {
        $query = "update studentaccount set password = :password where email = :email";
        $statement = $db->prepare($query);
        $statement->execute(
                array(
                    'password' => $_POST["password"],
                    'email' => $_GET["email"]
                )
        );
        header("location:login.php");
    } else {
        echo '<script>alert("Confirm password not matched with new password.");</script>';
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/resetPassword.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    </head>
    <body>
        <div class="loginTopNavBar">
            <p>TARUMT Game-based Learning System</p>
        </div>
        <div class="goBackBtn">
            <button class="backBtn" onclick="location.href = 'verifyEmail.php'">
                <i style='font-size:20px;color: #1a1b54; cursor: pointer;' class='fas'>&#xf137;</i>
                <span style="font-size:20px;text-transform: uppercase;color: #1a1b54;font-weight: 600;cursor: pointer;">Back</span>
            </button>
        </div>
        <div class="loginContent">
            <img class="logoImage" src="https://www.tarc.edu.my/images/tarumt-logo.png" alt="TARC LOGO" height="100px;">
            <h1>Password Recovery</h1>

            <div class="loginFormContainer">
                <form method="post" class="loginForm">
                    <label for="password">New Password</label><br>
                    <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}" title="Password must contain at least one number and one alphabet, and at least 8 or more characters." value="<?php
                    if (isset($_POST["password"])) {
                        echo $_POST["password"];
                    }
                    ?>" maxlength="100" autofocus required>
                    <input id="showPwCheckBox" type="checkbox" onclick="showPassword()" ><span id="showPwTxt">Show Password</span><br><br>

                    <label for="password" class="changePwTitle">Confirmed New Password</label><br>
                    <input type="password" id="confirmNewPassword" name="confirmNewPassword" value="<?php
                    if (isset($_POST["confirmNewPassword"])) {
                        echo $_POST["confirmNewPassword"];
                    }
                    ?>" required>
                    <input id="showPwCheckBox" type="checkbox" onclick="showConfirmNewPassword()"><span id="showPwTxt">Show Password</span><br>

                    <script>
                        function showPassword() {
                            var x = document.getElementById("password");
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

                    <input type="submit" value="RESET" name="reset" class="resetBtn">
                </form> 
            </div>
        </div>
    </body>
</html>
