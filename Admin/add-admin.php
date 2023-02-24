<?php include("partials/header.php")?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
            <br><br>
            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//Display mssage
                unset($_SESSION['add']);//remove message
            }
            ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                <td>Full Name: </td>
                <td>
                <input type="text" name="full_name" placeholder="Enter your name">
                </td>
                </tr>

                <tr>
                <td>Username: </td>
                <td>
                <input type="text" name="username" placeholder="Your username">
                </td>
                </tr>

                <tr>
                <td>Password: </td>
                <td>
                <input type="password" name="password" placeholder="Your password">
                </td>
                </tr>

                <tr>
                    <td colspan="2" rowspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-submit">
                    </td>
                </tr>
                
            </table>
        </form>
    </div>
</div>

<?php  include("partials/footer.php")?>

<?php

//Get data from form
if(isset($_POST['submit'])){
$full_name = $_POST['full_name'];
$username = $_POST['username'];
$password =md5($_POST['password']);

//SQL quary to save data into database
$sql = "insert into `tbl_admin`(full_name,username,password) values('$full_name','$username','$password')";

//Execute Query
$query_exec = mysqli_query($con, $sql);

//check if data is inserted or not

if($query_exec ==TRUE){
    //Create session and display message
    $_SESSION['add']="<div class='success'>Admin added successfully </div>";

    //Redirect page
    header("location:".'http://localhost/Fashion%20and%20Beauty%20website/Admin/manage-admin.php');
}
else{
    $_SESSION['add']="<div class='danger'>Failed to add Admin </div>";

    //Redirect page
    header('Admin/add-admin.php');
}
}
?>