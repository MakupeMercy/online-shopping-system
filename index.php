<?php include('partials-front/header.php');?>

    <section class="product-search text-center">

      

        <form action="<?php  echo $SITEURL;?>product-search.php" method="POST">
            <input id ="input-1"type="search" name="search" placeholder="Search for Product" required>

            <input id="input-2"type="submit" name="submit" value="search"
            
            class="btn-primary">
        </form>
        
        
    </section>
    

    <!-- section 1 code -->

    <section class="section1">
    <?
    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    ?>
        <div class="banner">
            <h1>FIND YOUR BEST FASHION PRODUCTS HERE!</h1>
            <a href="#products"> SHOP NOW</a>
        </div>
    </section>

    <br><br>

    <!-- Section products categories -->
    <section class="categories text-center">
        <br><br>
    <h2>Explore Products Categories</h2>
    
           
        <div class="container text-center">
    
        <?php 
            //create sql query to display categores from database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 6";
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

    <!--Section 2 code  -->
            <br><br>
    <section class="section2" id="products">
        <br><br>
        <div class="title">
            <h2>PRODUCTS WE OFFER!!</h2>
        </div>
        <br><br>
        <div class="product">
            <?php 
                //Getting products from database

                $sql2 = "SELECT * FROM tbl_product WHERE featured='Yes' AND active='Yes' LIMIT 6";

                //Execute query
                $res = mysqli_query($con,$sql2);

                //count rows
                $numRows2 = mysqli_num_rows($res);
                //check whether products are available
                if($numRows2 > 0){
                    //product available
                    while($row = mysqli_fetch_assoc($res)){
                        //Get all the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];

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


<!-- This is side bar code -->

    <div class="cart-sidebar">
        <div class="cart">
            <span class="close-cart">
                <i class="fa fa-times"></i>
            </span>
            <h2>Your Cart</h2>
            <div class="cart-content"></div>
        </div>
        <div class="total-sum">
            <h1>Your Total:Ksh <span class="total-amount">0</span></h1>
        </div>
        <div class="clear-cart">
            <button class="btn clear-cart btn">Proceed</button>
        </div>
        <div class="clear-cart">
            <button class="btn clear-cart-btn">Clear Cart</button>
        </div>
    </div>

    <!-- Menubar on the Sidebar Code -->

        <div class="menu-sidebar">
            <div class="close-menu">
                <i class="fa fa-times"></i>
            </div>
            <div class="menu-menubar">
                <ul class="menu-list">
                    <li class="menu-list-items"><a href="#">Home</a></li>
                    <li class="menu-list-items"><a href="#">Categories</a></li>
                    <li class="menu-list-items"><a href="#">Products</a></li>
                    <li class="menu-list-items"><a href="#">Contacts</a></li>
                </ul>
            </div>
        </div>

        <?php include('partials-front/footer.php')?>

    <script type="text/javascript" src="app.js"></script>
    <script type="text/javascript" src="products.json"></script>
</body>
</html>