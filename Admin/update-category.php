<?php include("partials/header.php")?>

<?php 
        //Check whether the id is fetched from the btn update category 
        if(isset($_GET['id'])){
            //Get the id and the other details
            $id = $_GET['id'];

            //Get the other details
            
            //Create sql query to get the data from the database
            $sql = "SELECT * FROM `tbl_category` WHERE id =$id ";

            //Execute the query
            
            $query_exec = mysqli_query($con,$sql);

            if($query_exec){
                //count the rows in the table 
                $numRows = mysqli_num_rows($query_exec);

                //fetch the rows from the databasse
                if($numRows==1){
                    //Get the data from the database
                    $row = mysqli_fetch_assoc($query_exec);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else{
                    //createa session 
                    $_SESSION['no-category'] = "<div class'danger'>No Category Found</div>";
                    //Redirect the message to manage category
                    header('location:'.$SITEURL.'Admin/manage-category.php');
                }
            }


        }
        else{
            //Create session and display error message in manage category page;
            $_SESSION['no-id'] = "<div class='danger'> Unauthorized Access</div>";
            //REdirect to manage category page
            header('location:'.$SITEURL.'Admin/manage-category.php');
        }
        ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image == ""){
                                //image not available
                                echo "<div class='danger'>Image Not Available</div>";
                            }else{
                                //image available
                                ?>
                                    <img src="<?php echo $SITEURL;?>images/category/<?php echo $current_image;?> " width="100px">
                                <?php
                            }
                            ?>
                    </td>
                </tr>

                <tr>
                    <td>New image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input  <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes

                        <input  <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes

                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image?>">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                //Get all thevalues from our form;
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // Update the new image if selected
                //Check whether the image is selected or no
                if(isset($_FILES['image']['name'])){
                    //Get the details
                    $image_name = $_FILES['image']['name'];
                    //check whether the image is available or not
                    if($image_name != ""){
                        //Image available;
                        //upload the new image

                        //Autorename the image
                        //Get Extension of our image (jpeg,jpg,png etc)
                        $ext = end(explode('.',$image_name));

                        //Rename image
                        $image_name = "Fashion_Category_".rand(0000,9999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //check whether the image is uploaded or not
                        //if the image is not uploade we will stopthe process and redirect with error message
                        if($upload==false){
                            //Set session message
                            $_SESSION['upload'] = "<div class='danger'> Failed to upload the image</div>";
                            //Redirect the message 
                            header('location:'.$SITEURL.'Admin/manage-category.php');
                            //Stop the process
                            die();
                        }

                        //Remove the current image if available
                        if($current_image!=""){
                                $remove_path = "../images/category/".$current_image;
                                $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                                if($remove==false){
                                    //Failed to reove the image
                                    //Session and message
                                    $_SESSION['failed-remove'] = "<div class='danger'>Failed To Remove Image</div>";
                                    //Redirect the session message
                                    header('location:'.$SITEURL.'Admin/manage-category.php');
                                    die();//Stop the process
                                }
                            }
                }

                    else{
                        $image_name = $current_image;
                    }
                    
                    
                }
                else{
                    $image_name = $current_image;
                }

                //Update the Database
                $sql2 = "UPDATE tbl_category SET
                title = '$title',
                image_name ='$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id = $id
                ";

                //Execute the query 
                $query_exec2 = mysqli_query($con,$sql2);

                if($query_exec2){
                    //Category updated;
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfuly.</div>";
                    //Redirect to manage category page
                    header('location:'.$SITEURL.'Admin/manage-category.php');

                }
                else{
                    //Failed to update category
                    $_SESSION['update'] = "<div class='danger'>Failed To Update Category</div>";
                    //redirect
                    header('location:'.$SITEURL.'Admin/manage-category.php');
                }

            }
            
        ?>

        
    </div>
</div>

<?php include("partials/footer.php")?>