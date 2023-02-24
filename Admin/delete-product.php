<?php
//include constants page
include('../config/db-connect.php');
//echo "This is delete product page";
//check whether the id is passed or not
if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //process to delete;
    //echo "process to Delete";

    //Get id and image name

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];


    //Remove the image if available
    if($image_name !=""){
        //image available remove
        $path = "../images/product/".$image_name;

        //Remove image file from folder
        $remove = unlink($path);

        //Check whether the image is removed or not
        if($remove==false){
            //Failed to remove image
            $_SESSION['remove'] = "<div class='danger'>Failed To Remove Image </div>";
            //Redirect
            header('location:'.$SITEURL.'Admin/manage-product.php');
            die();
        }
    }
    //Delete product from the database

    $sql = "DELETE FROM tbl_product WHERE id =$id";

    //Execute query
    $query_exec = mysqli_query($con,$sql);

    if($query_exec){
        //Product delete
        $_SESSION['delete'] = "<div class='success'>Product Deleted Successfuly.</div>";
        //Redirect to manage produt page;
        header('location:'.$SITEURL.'Admin/manage-product.php');
    }
    else{
        //Failed to delete product;
        $_SESSION['delete'] = "<div class='danger'>failed To Delete Product.</div>";
        //Redirect to manage produt page;
        header('location:'.$SITEURL.'Admin/manage-product.php');

    }
    //Redirect to manage food with session message
}
else{
    //Redirect to manage product page;
    //echo "Redirect";
    $_SESSION['unauthorized'] = "<div class='danger'>Unauthorized Access</div>";
    //Redirect
    header('location:'.$SITEURL.'Admin/manage-product.php');
}

?>