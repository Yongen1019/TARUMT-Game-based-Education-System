<?php
session_start();
session_destroy();
define('directAccess', FALSE);
echo '<script type="text/javascript">'; 
echo 'alert("You have logged out.");'; 
echo 'window.location.href = "login.php";';
echo '</script>';
?>


