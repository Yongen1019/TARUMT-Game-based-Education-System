<?php
session_start();
include 'connect.php';
if (isset($_POST["login"])) {
    $query = "select * from studentaccount where email = :email and password = :password";
    $statement = $db->prepare($query);
    $statement->execute(
            array(
                'email' => $_POST["email"],
                'password' => $_POST["password"]
            )
    );
    $count = $statement->rowCount();
    if ($count > 0) {
        $_SESSION["email"] = $_POST["email"];
        header("location:homepage.php");
    } else {
        echo '<script>alert("Invalid email or password, Please try again.")</script>';
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <meta charset="UTF-8">
        <title>Student Login</title>
    </head>
    <body>
        <div class="loginTopNavBar">
            <p>TARUMT Game-Based Learning System</p>
        </div>
        <div class="loginContent">
            <img class="logoImage" src="https://www.tarc.edu.my/images/tarumt-logo.png" alt="TARC LOGO" height="100px;">
            <h1>Student Login</h1>

            <div class="loginFormContainer">
                <form method="POST" class="loginForm">
                    <label for="email">Email</label><br>
                    <input type="email" id="email" name="email" placeholder="eg. xxxxx-xx19@student.tarc.edu.my" onkeyup='saveInput(this);' autofocus required><br>
                    <label for="password">Password</label><br>
                    <input type="password" id="password" name="password" onkeyup="saveInput(this);" autofocus required>
                    <input id="showPwCheckBox" type="checkbox" onclick="showPassword()"><span id="showPwTxt" onkeyup='saveValue(this);'>Show Password</span>
                    <div class="forgetPwTxt"><a href="verifyEmail.php">Forget Password?</a></div>

                    <input type="submit" name="login" value="LOGIN" class="loginBtn">
                </form> 
            </div>
        </div>
        <div class="fixed-left-bottom-btn">
            <p class="instructorLoginTxt"><a href="../Instructor/login.php">Instructor login</a></p>
        </div>
    </body>

    <script type="text/javascript">
        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        document.getElementById("email").value = getSavedInput("email");
        document.getElementById("password").value = getSavedInput("password");

        //Save the value function - save it to localStorage as (ID, VALUE)
        function saveInput(e) {
            var id = e.id;
            var val = e.value;
            localStorage.setItem(id, val);
        }

        //get the saved value function - return the value of "v" from localStorage. 
        function getSavedInput(v) {
            if (!localStorage.getItem(v)) {
                return "";
            }
            return localStorage.getItem(v);
        }
    </script>
</html>
