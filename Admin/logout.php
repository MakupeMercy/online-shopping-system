<?php
include("../config/db-connect.php");
// Destroy the sessions

session_destroy();

//Redirect to login page
header('location:'.$SITEURL.'Admin/login.php');
?>