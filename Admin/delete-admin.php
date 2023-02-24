<?php
session_start();
//Establish connection to the database by including file
include("../config/db-connect.php");


//1. Get the id you want to delete
$id = $_GET['id'];

//2.SQL query 
$sql = "DELETE FROM `tbl_admin` WHERE id = $id";

//Execute query
$query_exec = mysqli_query($con,$sql);

if($query_exec){
    $_SESSION['delete']= "<div class='success'>Admin Deleted successfuly</div>";
    //3. Redirect the page to manage admin page witha message
    header("location:".'http://localhost/Fashion%20and%20Beauty%20website/Admin/manage-admin.php');
    
}
else{
    $_SESSION['delete']= "<div class='danger'>Failed to Delete Admin </div>";
    //3. Redirect the page to manage admin page witha message
    header("location:".'http://localhost/Fashion%20and%20Beauty%20website/Admin/manage-admin.php');
}



?>