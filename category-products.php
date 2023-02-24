<?php include('partials-front/header.php')?>
<?php 
//check whether the id is passed
if(isset($_GET['category_id'])){
    //Category id is set
    $category_id = $_GET['category_id'];
    //Get the title of the category id
    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
    //Execute query
    $query_exec = mysqli_query($con,$sql);

    //Get the value fromthe databsase
    $row = mysqli_fetch_assoc($query_exec);

    //Get the title
    $category_title = $row['title'];
}
else{
    //category not passed
    //redirect
    header('location:'.$SITEURL."index.php");
}
?>

<!-- Serch section Starts -->
<section class="product-search text-center">

<h2>Product on  <a href="#" class="text-white"><?php echo $category_title;?></a></h2>
</section>
<!-- search section ends here -->



<!-- Section products categories -->
<section class="categories text-center">
        <br><br>
    <h2>Products Categories</h2>
    
           
        <div class="container text-center">
    
        <?php 
            //create sql query to displayproducts from database based no selected categories
            $sql2 = "SELECT * FROM tbl_product WHERE category_id=$category_id";
            //Execute query
            $query_exec2 = mysqli_query($con,$sql2);

            //count the rows
            $numRows2 = mysqli_num_rows($query_exec2);
            //check whether category is available
            if($numRows2>0){
                //categories found
                
                while($rows = mysqli_fetch_assoc($query_exec2)){
                    //GEt the id and other details
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $price =$rows['price'];
                    $description = $rows['description'];
                    $image_name= $rows['image_name'];

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
                            

                    
                    <?php
                }
            }
            else{
                echo "<div class='danger'>Product Not Added</div>";
            }
            ?>

            
        </div>
    </section>

<?php include('partials-front/footer.php')?>