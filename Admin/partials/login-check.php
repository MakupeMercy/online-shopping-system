<?php 
//Access control/Authorization
//Check whether user is logged in
if(!isset($_SESSION['user'])){
    //user is not logged in
    $_SESSION['not-login'] = "<div class='danger'> Please login to access admin Page</div>";
    //Redirect the page to login
    header('location:'.$SITEURL.'Admin/login.php');
}
?>