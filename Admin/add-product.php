<?php include("partials/header.php");?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Product</h1>
        <br>
        <?php 
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-50">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Product Title">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                       <textarea name="description" id="" cols="30" rows="4" placeholder="Product Description"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" id="">

                            <?php 
                                //Create PHP code to display categories from Database
                                //1. Craete sql to get all active categories from database

                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                //Execute query
                                $query_exec = mysqli_query($con,$sql);

                                //Count rows to check whether we have categories or not
                                $numRows = mysqli_num_rows($query_exec);
                                //if count is greater than 0 we have categories esle nocategpries
                                if($numRows >0){
                                    //categories found
                                    while($row=mysqli_fetch_assoc($query_exec)){
                                        //get the data of categories from the database
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                            <option value="<?php echo $id?>"><?php echo $title;?></option>
                                        <?php
                                        

                                    }
                                }
                                else{
                                    //No categories
                                    ?>
                                      <option value="0">No category Found</option>
                                    <?php 
                                }

                                //2. Display on Drop option
                            ?>
                          
                            
                        </select>
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
                        <input type="submit" name="submit" value="Add Product" class="btn-primary">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
            //Check whether the button is clicked or not
            if(isset($_POST['submit'])){
                //Add th product in the database;
                //echo "The button is clicked";

                //1.Get the data from from
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //check whether the radio buttons for featured and active is clicked
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }
                else{
                    $featured = 'No';
                }

                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }
                else{
                    $active = 'No';//This is the default value
                }

                //2. upload the image if selected
                //check whether select image is clicked
                if(isset($_FILES['image']['name'])){
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];
                    //check whether the image is selected or not and upload
                    if($image_name!=""){
                        //this means image is selected
                        //1.Rename the image

                        //Get the extension of selected image e.g jpg, jped etc
                        $ext = end(explode('.',$image_name));

                        //Create new name for the image
                        $image_name = "Fashion_Category_".rand(0000,9999).".".$ext;//new image name


                        //2.Upload the image
                        //Get the source path and Destination path
                        //sorce path is the current location of the image file
                        $source = $_FILES['image']['tmp_name'];

                        //Destination path 
                        $destination = "../images/product/".$image_name;

                        //Upload the image
                        $upload = move_uploaded_file($source,$destination);

                        //check whether image is uploade or not
                        if($upload==false){
                            //Failed to upload image and redirect to add product page;
                            $_SESSION['upload'] = "<div class='danger'>Failed To Upload Image </div>";
                            //Redirect to the same page
                            header('location:'.$SITEURL.'Admin/add-product.php');
                            //Stop the process
                            die();
                        }



                    } 
                }
                else{
                    //Set the default image name s blank
                    $image_name ="";
                }

                //3. Insert into database
                //create an sql query to save the data into the database
                //For numeric value we dont need to pass value inside quotes.
                $sql2 = "INSERT INTO tbl_product SET 
                title= '$title',
                description = '$description',
                price = '$price',
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active ='$active'
                ";
                //Execute the query
                $query_exec2 = mysqli_query($con,$sql2);

                //Check whether dta is inserted successfuly
                if($query_exec2 == true){
                    //Data inserted successfuly
                    $_SESSION['add'] = "<div class='success'>Product Added Successfuly</div>";
                    //Redirect
                    header('location:'.$SITEURL.'Admin/manage-product.php');
                }
                else{
                    //Failed to insert 
                    $_SESSION['add']="<div class='danger'>Failed To Add Product</div>";
                    //Redirect
                    header('location:'.$SITEURL.'Admin/manage-product.php');
                }
                //4.Redirect the page to manage product
            }
        ?>
    </div>
</div>

<?php include("partials/footer.php");?>

