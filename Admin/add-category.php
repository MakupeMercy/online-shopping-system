<? include("partials/header.php")?>

<div class="main-content">
    <div class="wrapper">
        <h1> Add Category</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br>
        <!-- Button to Add admin -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl_30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value='Yes'>Yes
                        <input type="radio" name="featured" value='No'>No
                    </td>
                </tr>
                    
                <tr>
                <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value='Yes'>Yes
                        <input type="radio" name="active" value='No'>No
                    </td> 
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            //Check whether the submit button is clicked
            if(isset($_POST['submit'])){
               // echo "Button clicked";

               //Get the value from the category form

               $title = $_POST['title'];

               //Check whether the radio buttons are selected or not
               if(isset($_POST['featured'])){
                    // Get the value from the form
                    $featured = $_POST['featured'];
               }
               else{
                //Set the default value NO
                $featured = 'No';
               }

               if(isset($_POST['active'])){
                //Get the value for active
                $active =$_POST['active'];
               }
               else{
                $active = 'No';
               }

               //Check whether the image is selected or not ad set the value of image name accordingly.
              // print_r($_FILES['image']);

               //die();//Break the ode here

               if(isset($_FILES['image']['name'])){
                    //Upload the image
                    //To upload image we need name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    if($image_name!= ""){

                    //Autorename the image
                    //Get Extension of our image (jpeg,jpg,png etc)
                    $ext = end(explode('.',$image_name));

                    //Rename image
                    $image_name = "Fashion_Category_".rand(000,999).'.'.$ext;

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
                        header('location:'.$SITEURL.'Admin/add-category.php');
                        //Stop the process
                        die();
                    }
             }
            }
            else{
                //Do not upload the image and set thename of the image as blank
                $image_name="";
               }

               
               
               //2.Create sql query to insert category into database
               $sql = "INSERT INTO `tbl_category` SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    ";

                //.Excute the Query and save in database
                $query_Exec = mysqli_query($con, $sql);

                if($query_Exec){
                    //Query execute
                    $_SESSION['add'] = "<div class='success'> Category added successfuly.</div>";
                    //Redirect the message to manage category page
                    header('location:'.$SITEURL.'Admin/manage-category.php');
                }else{
                    //Failed to execute query
                    $_SESSION['add'] = "<div class='success'> Failed to add category.</div>";
                    //Redirect the message to manage category page
                    header('location:'.$SITEURL.'Admin/add-category.php');
                }

            }
        ?>
    </div>
</div>
<?php include("partials/footer.php")?>