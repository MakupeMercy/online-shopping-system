<?php include('partials-front/header.php')?>

<section class="product-search text-center">
    <?php 
        //Get the search keywprd
        $search = $_POST['search'];
        if(isset($_POST['submit'])== ""){
            header("location:".$SITEURL.'index.php');
        }else{
            $search = $_POST['search'];
        }
    ?>

<h2>Product on search <a href="#" class="text-white"><?php echo $search;?></a></h2>
</section>

<!-- End of search section -->

<section class="section2" id="products">
        <div class="title">
            <h2>Products Menu</h2>
        </div>
        <br><br>
        <div class="product">
            <?php 
                
                //Getting products from database

                $sql = "SELECT * FROM tbl_product WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute query
                $query_Exec = mysqli_query($con,$sql);

                //count rows
                $numRows = mysqli_num_rows($query_Exec);
                //check whether products are available
                if($numRows>0){
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
                    echo "<div class='danger'>Product not Found</div>";
                }
                
            ?>

        </div>
    </section>

<!-- start of product menu section -->


</section>

<?php include('partials-front/footer.php')?>