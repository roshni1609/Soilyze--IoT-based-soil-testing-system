<?php
require('auth.php'); // check if user is logged in and session is set
session_destroy(); //destroy session and redirect to login page
header("Location: /");
?>