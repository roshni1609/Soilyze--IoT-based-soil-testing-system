<?php
session_start(); //starts the session
if(!isset($_SESSION['username'])){
    session_destroy(); //destroy session if user is not logedin and redirect to login page
    header("Location: /");
}
?>