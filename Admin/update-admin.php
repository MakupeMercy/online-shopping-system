<?php include("partials/header.php");?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
    
        <br><br>

        <?php
        //Get the Details of the admin and display them first
        //Get the id
        $id = $_GET['id'];

        //SQL query 
        $sql = "SELECT * FROM `tbl_admin` WHERE id = $id";

        // Execute query
        $query_exec = mysqli_query($con,$sql);

        //Check the query
        if($query_exec){
            //check whether we have data in the table
            $numRows = mysqli_num_rows($query_exec);
                //count the data rows
                if($numRows==1){
                    $row = mysqli_fetch_assoc($query_exec);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }else{
                    //Redirect the page to manage admin
                    header("location:".'http://localhost/Fashion%20and%20Beauty%20website/Admin/manage-admin.php');
                }
            
        }
        
        
        ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td>FullName:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name?>" >
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-submit">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php
//check whether the submit button is clicked
if(isset($_POST['submit'])){
    //echo "button clicked";
   $id = $_POST['id'];
   $full_name = $_POST['full_name'];
   $username = $_POST['username'];

   //Create a sql
   $sql = "UPDATE tbl_admin SET 
   full_name = '$full_name',
   username = '$username' 
   WHERE id = '$id' ";
//Execute query
   $query_exec = mysqli_query($con,$sql);

   //Check whether queryis executed successfully or not
   if($query_exec){
    $_SESSION['update'] = "<div class='success'>Data updated successfully </div>";

    // Redirect page to manage-admin
    header("location:".'http://localhost/Fashion%20and%20Beauty%20website/Admin/manage-admin.php');
    
   }else{
    $_SESSION['update'] = "<div class='danger'>Failed to update the data </div>";

    //Redirect page to manage-admin
    header("location:".'http://localhost/Fashion%20and%20Beauty%20website/Admin/manage-admin.php');
   }
}
?>


<?php
include("partials/footer.php");
?>