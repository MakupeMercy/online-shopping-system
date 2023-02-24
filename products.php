 <?php include('partials-front/header.php')?>

<!-- Search section -->
<section class="product-search text-center">
    <form action="<?php  echo $SITEURL;?>product-search.php" method="POST">
        <input id ="input-1"type="search" name="search" placeholder="Search for Product" required>

        <input id="input-2"type="submit" name="submit" value="search"
        
        class="btn-primary">
</form>


</section>
<!-- End of search section -->

 <!--Section 2 code  -->
 <br><br>
    <section class="section2" id="products">
        <div class="title">
            <h2>Products Menu</h2>
        </div>
        <br><br>
        <div class="product">
            <?php 
                //Getting products from database

                $sql = "SELECT * FROM tbl_product WHERE featured='Yes'";

                //Execute query
                $query_Exec = mysqli_query($con,$sql);

                //count rows
                $numRows = mysqli_num_rows($query_Exec);
                //check whether products are available
                if($numRows > 0){
                    //product available
                    while($rows = mysqli_fetch_assoc($query_Exec)){
                        //Get all the values
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $price = $rows['price'];
                        $description = $rows['description'];
                        $image_name = $rows['image_name'];

                        ?>
                        <div class="container-2">
                            <div class="product-menu-box">
                                <div class="product-menu-img">
                                    <?php 
                                        //check whether image is available or not
                                        if($image_name ==""){
                                            //image not available
                                            echo "<div class='danger'>Image Not Available</div>";
                                        }
                                        else{
                                            //image available
                                            ?>
                                            <img src="<?php echo $SITEURL;?>images/product/<?php echo $image_name;?>" alt="" class="img-responsive2">
                                            <?php
                                        }
                                    ?>
                                    
                                </div>

                                <div class="product-menu-box float-text2">
                                    <h4><?php echo $title;?></h4>
                                    <p class="food-price">Ksh.<?php echo $price;?></p>
                                    <p class="food-detail">
                                        <?php echo $description;?>
                                    </p>
                                    <br>

                                    <button class="btn-secondary">
                                    <a href="<?php echo $SITEURL;?>order.php?product_id=<?php echo $id;?>">Order Now</a>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <?php
                    }
                }
                else{
                    //product not available
                    echo "<div class='danger'>Product not Available</div>";
                }
            ?>

        </div>
    </section>

    <?php include('partials-front/footer.php')?>



    
