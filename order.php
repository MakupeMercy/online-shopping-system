<?php include('partials-front/header.php')?>

<?php 
    //chck whether product id is set
    if(isset($_GET['product_id'])){
        //Get the product id and details of selected fields
        $product_id = $_GET['product_id'];

        //Get the details of the selected food
        $sql ="SELECT * FROM tbl_product  WHERE id =$product_id";
        
        //execute query
        $query_exec = mysqli_query($con,$sql);
        //count rows
        $numRows = mysqli_num_rows($query_exec);

        //check whether data is available
        if($numRows==1){
            //data available
            $row = mysqli_fetch_assoc($query_exec);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else{
            //product not available
            //redirect
            header("location:".$SITEURL.'index.php');
        }
    }
    else{
        //Redirect to home page
        header("location:".$SITEURL.'index.php');
    }
?>
<br><br>

<section class="product-order text-center">
    <div class="container-order">

    <h2 class="text-center text-white">Fill this form to Confirm your order.</h2>
        <form action="" method="POST">
            <fieldset style="width: 450px; margin-left:34%; border-radius:5px; ">
                <legend >Selected Food</legend>
                <br>
                <div class="food-menu-img" style="float: left;">
                    <?php 
                    if($image_name ==""){
                        //image not available
                        echo "<div class='error'>Image Not Available</div>";
                    }else{
                        //image is available
                        ?>
                        <img src="<?php echo $SITEURL;?>images/product/<?echo $image_name;?>" width="120px" height="90px">
                        <?php
                        
                    }
                    ?>
                    
                </div>

                <div class="product-menu-box">
                    <h3><?php echo $title?></h3>
                    <input type="hidden" name="product" value="<?php echo $title;?>">
                    <p class="product-price">
                        Ksh.<?php echo $price;?>
                    </p>
                    <input type="hidden" name="price" value="<?php echo $price;?>">
                    <div >Quantity</div>
                    <input type="number" name="qty" class="input-response" value="1" required style="margin-right:-130px; margin-bottom:20px;width:190px; ">
                </div>
            </fieldset>

            <fieldset style="width: 450px; margin-left:34%; border-radius:5px; ">
                <legend>Delivery Details</legend>
                <br>
                <div class="order-label">Full Name </div><br> 
                <input type="text" name="full_name" placeholder="E.g Mercy Makupe" class="input-responsive" required><br><br>

                <div class="order-label">Phone Number </div><br>
                <input type="tel" name="contact" placeholder="E.g 07xxxxxxxx" class="input-responsive" required><br><br>
                
                <div class="order-label">Email</div><br>
                <input type="email" name="email" placeholder="E.g mmercy@gmail.com" class="input-responsive" required><br><br>

                <div class="order-label">Address</div><br>
                <textarea name="address" rows="3" placeholder="E.g Street, City, Country" class="input-responsive" required></textarea><br><br>

                <br> <br>

                <input type="submit" name="submit" value="Confirm Order" class="btn-order">



            </fieldset>
        </form>
    
        <?php 
            //check whethr submit button is clicked
            if(isset($_POST['submit'])){
                //Get all the data
                $product = $_POST['product'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;//total calculation

                $order_date = date("Y-m-d h:i:sa");//order date gets the current date and time

                $status = "Ordered";//status Ordered On Delivery,Delivered,Cancelled

                $customer_name = $_POST['full_name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                //save the order in database

                //create sql query 
                $sql2 = "INSERT INTO tbl_order SET 
                    product = '$product',
                    price = '$price',
                    quantity = '$qty',
                    total = '$total',
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    ";
                    //execute the query

                    $query_exec2 = mysqli_query($con,$sql2);
                    //check if query is executed
                    if($query_exec2){
                        //Query executed
                        $_SESSION['order'] = "<div class='success  text-center'>Product ordered successfully.</div>";
                        header("location:".$SITEURL.'index.php');
                    }
                    else{
                        //query failed to execute
                        $_SESSION['order'] = "<div class='danger text-center' >Product  Order Failed.</div>";
                        header("location:".$SITEURL.'index.php');
                    }
            }
        ?>

    </div>
</section>


<?php include('partials-front/footer.php')?>