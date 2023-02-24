<?php include("partials/header.php")?> 
        <!-- main content section starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1><strong>Manage Product</strong></h1>

                <br>
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['remove'])){
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }

                    if(isset($_SESSION['unauthorized'])){
                        echo $_SESSION['unauthorized'];
                        unset($_SESSION['unauthorized']);
                    }
                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

                <br><br>
                <!-- button to add product -->
                <button class="btn-primary">
                    <a href="<?php echo $SITEURL;?>Admin/add-product.php">Add Product</a>
                </button>
                <br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                    //Create sql query to get all food
                    $sql = "SELECT * FROM tbl_product";
                    //Execute query
                    $query_exec = mysqli_query($con,$sql);

                    //Count the rown in the database
                    $numRows = mysqli_num_rows($query_exec);

                    //Create serial number and set default value
                    $sn=1;

                    if($numRows>0){
                        //we have product in database
                        while($row =mysqli_fetch_assoc($query_exec)){
                            //get the value from indivudual column
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active =$row['active'];

                            ?>
                                <tr>
                                    <td><?php echo $sn++?>.</td>
                                    <td><?php echo $title ?></td>
                                    <td>Ksh.<?php echo $price ?></td>
                                    <td><?php 
                                        //Check whether we do nt have an image
                                        if($image_name==!""){
                                           
                                            //We have an image
                                            ?>
                                            <img src="<?php echo $SITEURL;?>images/product/<?php echo $image_name;?> " width='100px'>
                                            <?php
                                        }
                                        else{
                                            echo "<div class='danger'>Image not added</div>";
                                        }
                                    ?>
                                    </td>
                                    <td><?php echo $featured ?></td>
                                    <td><?php echo $active ?></td>
                                    <td>
                                    <button class="btn-secondary">
                                        <a href="<?php echo $SITEURL;?>Admin/update-product.php?id=<?php echo $id;?>">Update Product</a>
                                    </button>
                                    </td>
                                    <td>
                                        <button class="btn-danger">
                                        <a href="<?php echo $SITEURL;?>Admin/delete-product.php?id=<?php echo $id;?>& image_name=<?php echo $image_name;?>">Delete Product</a>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                    else{
                        echo "<tr><td colspan='5' class='danger'>Product Not Added</td></tr>";
                         
                    }
                    ?>
                    
                </table>
                

            </div>
        </div>

        <!-- main content section ends -->
        
     <?php  include("partials/footer.php")?>   
