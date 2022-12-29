<?php
session_start();
include 'connect.php';

if (isset($_GET["skip"])) {
    unset($_SESSION["time"]);;
}

if ($_SESSION["questionType"] == "fill-in-the-blank question") {
    header("location:questionFormulate(fitb).php");
} else if ($_SESSION["questionType"] == "true-false question") {
    header("location:questionFormulate(tf).php");
} else if ($_SESSION["questionType"] == "multiple-choice question") {
    header("location:questionFormulate(mcq).php");
} else {
    echo '<script>alert("Something went wrong."); window.location.href="classroom.php";</script>';
}
?>