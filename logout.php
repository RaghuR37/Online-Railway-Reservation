<?php
session_start();
session_destroy();
echo '<script>alert("Logout Successfull")</script>';
header("Location:homepage.html");
?>