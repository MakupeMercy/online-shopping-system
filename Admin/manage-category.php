<?php include("partials/header.php")?> 
        <!-- main content section starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1><strong>Manage Category</strong></h1>
                <br><br>

                <?php
                    if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['remove'])){
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['no-id'])){
                        echo $_SESSION['no-id'];
                        unset($_SESSION['no-id']);
                    }
                    if(isset($_SESSION['no-category'])){
                        echo $_SESSION['no-category'];
                        unset($_SESSION['no-category']);
                    }
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['failed-remove'])){
                        echo $_SESSION['failed-remove'];
                        unset($_SESSION['failed-remove']);
                    }


                ?>
                <br>
                <!-- button to add category -->
                <button class="btn-primary">
                    <a href="<?php echo $SITEURL;?>Admin/add-category.php">Add Category</a>
                </button>
                <br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    //Get all categories 
                    $sql = "SELECT * FROM `tbl_category`";

                    //Execute query 
                    $query_exec = mysqli_query($con,$sql);

                    //count rows
                    $numRows = mysqli_num_rows($query_exec);

                    //create serialumber variale
                    $sn = 1;
                    //check whether we have data in database or not
                    if($numRows>0){
                        //WE have data in database
                        //Get the data and display
                        while($row=mysqli_fetch_assoc($query_exec)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                            
                                <tr>
                                <td><?php echo $sn++?></td>
                                <td><?php echo $title?></td>

                                <td>
                                    <?php 
                                    //Check whether image name is avialable or not
                                    if($image_name!=""){
                                        //Diplay essage
                                        ?>
                                        <img src="<?php echo $SITEURL;?>images/category/<?php echo $image_name;?> " width='100px'>
                                        <?php

                                    }else{
                                        echo"<div class='danger'>Image not added. </div>";

                                    }
                                    ?>
                                </td>

                                <td><?php echo $featured?></td>
                                <td><?php echo $active?></td>

                                <td>
                                <button class="btn-secondary">
                                <a href="<?php echo $SITEURL; ?>Admin/update-category.php?id=<?php echo $id;?> ">Update Category</a>
                                </button>
                                </td>

                                <td>
                                <button class="btn-danger">
                                    <a href="<?php echo $SITEURL;?>Admin/delete-category.php?id=<?php echo $id; ?>& image_name=<?php echo $image_name?> ">Delete Category</a>
                                </button>
                                </td>
                                </tr>
                                    
                            <?php
                        }

                    }else{
                        //We do not have data in the database
                        //We dispaly error message inside table
                        ?>
                        <tr>
                            <td colspan="6">
                                <div class="danger">No category added.</div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                   
                </table>

            </div>
        </div>

        <!-- main content section ends -->
        
     <?php  include("partials/footer.php")?>   
