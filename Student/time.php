<?php

session_start();
include 'connect.php';

if (isset($_SESSION["time"])) {
    $time = $_SESSION["time"];

    echo $time;

    $_SESSION["time"] = $_SESSION["time"] - 1;


    if ($_SESSION["time"] == 0) {
        unset($_SESSION["time"]);
    }
}
?>