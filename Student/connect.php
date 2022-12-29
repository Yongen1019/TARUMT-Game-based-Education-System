<?php
$DB_USER = "root";
$DB_PASSWORD = "";
$DB_HOST = "localhost";
$DB_NAME = "TARUMTEducationDB";

$db = new PDO("mysql:host=$DB_HOST; dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)
?>