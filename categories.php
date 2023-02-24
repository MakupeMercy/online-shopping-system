<?php include('partials-front/header.php')?>

<br><br>

<!-- Section products categories -->
<section class="categories text-center">
    <h2>Explore Products</h2>
    
           
        <div class="container text-center">
    
        <?php 
            //create sql query to display categores from database which are active
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
            //Execute query
            $query_exec = mysqli_query($con,$sql);

            //count the rows
            $numRows = mysqli_num_rows($query_exec);
            //check whether category is available
            if($numRows>0){
                //categories found
                
                while($row = mysqli_fetch_assoc($query_exec)){
                    //GEt the id and other details
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name= $row['image_name'];

                    ?>
                    
                    <a href="<?php echo $SITEURL;?>category-products.php?category_id=<?php echo $id;?>">
                        <div class="box-1 float-container">
                            <?php 
                            //Check whether image is available or not
                            if($image_name==""){
                                //Display the image
                                echo "<div class='danger'>Image not Available</div>";
                            }
                            else{
                                //image available
                                ?>
                                 <img src="<?php echo $SITEURL?>images/category/<?php echo $image_name;?>" alt=""  class="img-responsive">
                                <?php
                            }
                            
                            ?>
                            <h3 class="float-text text-white"><?php echo $title;?></h3>
                            
                           
                        </div>
                        
                    </a>
                    <?php
                }
            }
            else{
                echo "<div class='danger'>Categories Not Added</div>";
            }
            ?>

            
        </div>
    </section>


<?php include('partials-front/footer.php')?>