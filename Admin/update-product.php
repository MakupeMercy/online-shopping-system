<?php include('partials/header.php')?>

<?php 
//Check if id is se or not
if(isset($_GET['id'])){
    //Get all the details.
    $id = $_GET['id'];
    $sql2 = "SELECT * FROM tbl_product WHERE id = $id";

    //Execute query
    $query_exec2 = mysqli_query($con,$sql2);

    //Get the value based on query executed;
    if($query_exec2){
        //count
        $numRows2 = mysqli_num_rows($query_exec2);

        if($numRows2 ==1){
            $row2 = mysqli_fetch_assoc($query_exec2);
            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];

            }
    }
}
else{
    //Redirect
    header('location:'.$SITEURL.'Admin/manage-product.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Product</h1>

        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-50">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title?>">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="4"><?php echo $description?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price?>">
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
                                    <img src="<?php echo $SITEURL;?>images/product/<?php echo $current_image;?> " width="100px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category" id="">
                            
                            <?php 
                                //Query to get active products
                                $sql = "SELECT * FROM tbl_category WHERE active =='Yes'";
                                //Execute the query
                                $query_exec = mysqli_query($con,$sql);
                                //Count rows
                                $numRows = mysqli_num_rows($query_exec);
                                //check whether the product is available or not
                                if($numRows>0){
                                    //Product found
                                    while($row=mysqli_fetch_assoc($query_exec)){
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                        //echo "<option value='$category_id'>$category_title</option>";
                                        ?>
                                        <option <?php 
                                        if($current_category == $category_id){ echo "selected";}?>
                                        value="<?php echo $category_id ?>"><?php echo $category_title?>
                                        </option>
                                        <?php
                                    }
                                }
                                else{
                                    //category not available
                                    echo "<option value='0'> Product Not Found </option>";
                                }
                            ?>
                           
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured == 'Yes'){echo 'checked';}?> type="radio" name="featured" value='Yes'>Yes
                        <input <?php if($featured == 'No'){echo 'checked';}?> type="radio" name="featured" value='No'>No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active == 'Yes'){echo 'checked';}?> type="radio" name="active" value='Yes'>Yes
                        <input <?php if($active == 'No'){echo 'checked';}?> type="radio" name="active" value='No'>No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="submit" name="submit" value="Update product" class="btn-primary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            // Check whether button is clicked
            if(isset($_POST['submit'])){
                //echo "button clicked";
                //Get all the details
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //upload the image if selected
                //check whether upload button is clickd or not
                if(isset($_FILES['image']['name'])){
                    //upload the image
                    $image_name= $_FILES['image']['name'];

                    //Check whether the file is available or not
                    if($image_name!= ""){
                        //image is available
                        //Rename the image

                        //Get extension
                        $ext = end(explode('.',$image_name));

                        $image_name = "Fashion_Category_".rand(0000,9999).'.'.$ext;

                        //Get the source path
                        $source_path = $_FILES['image']['tmp_name'];

                        //Get destination path
                        $destination_path = "../images/product/".$image_name;

                        //upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //check whether image is uploaded or not
                        if($upload == false){
                            //Failed to upload
                            $_SESSION['upload'] = "<div class='danger'> Failed To Upload</div>";
                            //Redirect
                            header('location:'.$SITEURL.'Admin/manage-product.php');
                            //Stop the process
                            die();
                        }

                        //Remove the image
                        if($current_image!=""){
                            //remove the currentimage
                            //upload new image
                            $remove_path = "../images/product/".$current_image;
                            $remove = unlink($remove_path);

                            //Check whether the image is removed
                            if($remove == false){
                                //failed to remove image
                                $_SESSION['remove-failed'] = "<div class='danger'>Failed To Remove Curent Image</div>";
                                //redirect
                                header('location:'.$SITEURL.'Admin/manage-product.php');
                                die(); //Stop the process;
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
            
                //update the database
                $sql3 = "UPDATE tbl_product SET 
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                WHERE id = $id
                ";
                //Execute the query
                $query_exec3 = mysqli_query($con,$sql3);

                //check whether the query is executed
                if($query_exec3){
                    //Query executed
                    $_SESSION['update'] = "<div class='success'>Product Updated Successfuly.</div>";
                    //Redirect
                    header('location:'.$SITEURL.'Admin/manage-product.php');
                }
                else{
                    //Failed to update product
                    $_SESSION['update'] = "<div class='danger'>Failed to Update Product.</div>";
                    //Redirect
                    header('location:'.$SITEURL.'Admin/manage-product.php');
                }
                //Redirect to manage product
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php')?>