<?php 
include("partials/header.php");
?>
<?php
$id = $_GET['id'];
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
            <br><br>
           

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current password: </td>

                        <td><input type="password" name="current_password" placeholder="Current password"></td>
                    </tr>
                    <tr>
                        <td>New Password</td>
                        <td>
                            <input type="password" name="new_password" placeholder="New password">
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm password: </td>
                        <td>

                            <input type="password" name="confirm_password" placeholder="Confirm password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            <a href=""><input type="submit" name="submit" value="Change" class="btn-primary"></a>
                        </td>
                    </tr>
                </table>
            </form>
        
    </div>
</div>

<?php 
 //Check whether the button is clicked;
if(isset($_POST['submit'])){
   
    //Get the data from the form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //Check if the user with the current id exists
    $sql = "SELECT * FROM `tbl_admin` WHERE id=$id AND password = '$current_password'";

    //Execute the query
    $query_exec = mysqli_query($con,$sql);

    if($query_exec){
        $numRows = mysqli_num_rows($query_exec);

        if($numRows == 1){
            //User exists password can be changed
            //echo "user found";
            //Check whether the new and confirm password match
            if($new_password == $confirm_password){
                //Update the password
                
                $sql2 = "UPDATE tbl_admin SET password = '$new_password' WHERE id=$id";

                $query_exec2 = mysqli_query($con, $sql2);

                if($query_exec2){
                    //Display success message
                    $_SESSION['pass-change'] = "<div class='success'> Password Changed Successfuly </div>";

                    //Redirect the message
                    header('location:'.$SITEURL.'Admin/manage-admin.php');
                }else{
                    //Display error message
                    $_SESSION['pass-change'] = "<div class='danger'> Failed To Change Password </div>";
                    //Redirect the message
                    header('location:'.$SITEURL.'Admin/manage-admin.php');
                }
            }else{
                //Set error mesaage
                $_SESSION['pass-not-match'] = "<div class='danger'>Password Does not match. </div>";

                //Redirect the error message
                header("location:".$SITEURL.'Admin/manage-admin.php');
            }
        }else{
            //User not found set message
            $_SESSION['change'] = "<div class='danger'>Username Does Not Exist. </div>";
            //Redirect the session message
            header("location:".$SITEURL.'Admin/manage-admin.php');
        }

    }
    
    

    //Change the password if all the above is true
     

}

?>
<?php include("partials/footer.php");?>