
<?php include("partials/header.php")?> 
        <!-- main content section starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1><strong>Manage Admin</strong></h1>
                <br><br>
                
                <?php
                // Session messages for adding and deleting admin displayed 
                 if(isset($_SESSION['add'])){
                    echo $_SESSION['add']; //Display session mesage
                    unset($_SESSION['add']);//Removes session message
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete']; //Display session mesage
                    unset($_SESSION['delete']);//Removes session message
                }

                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['change'])){
                    echo $_SESSION['change'];
                    unset($_SESSION['change']);
                }
                if(isset($_SESSION['pass-not-match'])){
                    echo $_SESSION['pass-not-match'];
                    unset($_SESSION['pass-not-match']);
                }
                if(isset($_SESSION['pass-change'])){
                    echo $_SESSION['pass-change'];
                    unset($_SESSION['pass-change']);
                }
                ?>
                <br><br>
                <!-- button to add admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                
                <br><br>
                <!-- //Table to display data from the database -->
                    <table class="tbl-50">
                    <tr>
                        <th>S.N</th>
                        <th>Full_name</th>
                        <th>username</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    //Query to get all admin
                    $sql = "select * from `tbl_admin`";

                    //Execute query
                    $query_exec = mysqli_query($con,$sql);

                    //Check whether query is executed

                    if($query_exec){
                        $numRows = mysqli_num_rows($query_exec);

                        // variable and assign the value
                        $sn = 1;
                        //Check num rows
                        if($numRows>0){
                            //We fetch the data in the database
                            while($rows = mysqli_fetch_assoc($query_exec)){
                                //using while loop get all the data from the database
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username =$rows['username'];

                                //Display the values in our table
                               ?>
                            <tr>
                                    <td><?php echo $sn++?></td>
                                    <td><?php echo $full_name?></td>
                                    <td><?php  echo $username?></td>
                                    <td>
                                    <button class="btn-pass">
                                        <a href="http://localhost/Fashion%20and%20Beauty%20website/Admin/change-password.php?id=
                                        <?php echo $id?>">Change Password</a>
                                    </button>
                                    </td>
                                    <td >
                                    
                                    <button class="btn-secondary">
                                        <a href="http://localhost/Fashion%20and%20Beauty%20website/Admin/update-admin.php?
                                        id=<?php echo $id?>">Update Admin</a>
                                    </button>
                                    </td>
                                    <td>
                                    <button class="btn-danger">
                                        <a href="http://localhost/Fashion%20and%20Beauty%20website/Admin/delete-admin.php?id=
                                        <?php echo $id?>" 
                                        >Delete Admin</a>
                                    </button>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else{
                            //We dont fetch data in the database
                        }
                
                    }
                    ?>
                    
                </table>

            </div>
        </div>

        <!-- main content section ends -->
        
     <?php  include("partials/footer.php")?>   
