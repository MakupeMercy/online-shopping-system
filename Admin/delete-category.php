<?php
include('../config/db-connect.php');
//echo "delete page";
//check whether the id and image_nme is set or not
if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //GEt the value and deletes
    $id = $_GET['id'];
    $image_name= $_GET['image_name'];
    
    //Remove the image file if available then delete the data from the database 
    if($image_name != ""){
        //Remove the image
        $path = '../images/category/'.$image_name;
        $remove = unlink($path);
        //if failed to remove image then add an error message and stop the process
        if($remove == false){
            //Set session message then redirect to manage category page
            $_SESSION['remove'] ="<div class='danger'> Failed to remove the image </div>";

            //Redirect the message
            header('location:'.$SITEURL.'Admin/manage-category.php');
            //stop the process
            die();

        }
    }
    //Delete data from the database
    //SQL query to delete the database
    $sql= "DELETE FROM `tbl_category` WHERE id = $id;";

    //Execute the query
    $query_Exec = mysqli_query($con, $sql);

    //Check whether data is deleted in the database or not
    if($query_Exec){
        //Set success message
        $_SESSION['delete'] = "<div class='success'>Category deleted successfuly.</div>";
        //Redirect the message to manage category page
        header('location:'.$SITEURL.'Admin/manage-category.php');
    }else{
        //Sest error message
        $_SESSION['delete'] = "<div class'danger'>Failed to delete category.</div>";
        //Redirect the message
        header('location:'.$SITEURL.'Admin/manage-category.php');
    }
}
    //Redirect to manage-category page with message

else{
    //redirect to manage category
    header('location:'.$SITEURL.'Admin/manage-category.php');

}
?>