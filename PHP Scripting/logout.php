<?php
//closes users session and then sends them to the login page
session_start();
session_destroy();
header('Location: ans4.php');
exit;
?>
