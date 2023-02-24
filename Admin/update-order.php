<?php include('partials/header.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
        //check whether id is set or not
        if(isset($_GET['id'])){
            //Get the details
            $id = $_GET['id'];
            //create an sql query
            $sql = "SELECT * FROM tbl_order WHERE id = $id";
            //execute the query
            $query_exec = mysqli_query($con,$sql);
            //count rows
            $numRows = mysqli_num_rows($query_exec);

            if($numRows==1){
                //DEtails  availabe
                $row=mysqli_fetch_assoc($query_exec);
                $product = $row['product'];
                $price  = $row['price'];
                $quantity = $row['quantity'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
                
            }else{
                header("location:".$SITEURL.'Admin/manage-order.php');
            }
        }
        else{
            //Redirect
            header("location:".$SITEURL.'Admin/manage-order.php');
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Product name</td>
                    <td><b><?php echo $product;?></b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <b>Ksh.<?php echo $price?></b>
                    </td>
                </tr>

                <tr>
                    <td>Quantity</td>
                    <td>
                        <input type="number" name="quantity" value="<?php echo $quantity;?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";}?>value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";}?>value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";}?>value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";}?>value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="email" name="customer_email" value="<?php echo $customer_email;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="customer_address" id="" cols="30" rows="5"><?php echo $customer_address;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="hidden" name="price" value="<?php echo $price?>">
                        <input type="submit" name="submit" value="Update"class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        //check whether update button is clicked
        if(isset($_POST['submit'])){
            //get all values form form
            $id = $_POST['id'];
            $product = $_POST['product'];
            $price =$_POST['price'];
            $quantity = $_POST['quantity'];

            $total = $price * $quantity;
            
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];


            //create an an sql query to update the database

            $sql2 = "UPDATE tbl_order SET
            quantity = '$quantity',
            total = '$total',
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'
            WHERE id = $id

             ";

             //execute query
             $query_exec2 = mysqli_query($con,$sql2);

             //check whether updated  or not
             if($query_exec2){
                //updated
                $_SESSION['update'] = "<div class='success'>Order Updated succssfuly</div>";
                header("location:".$SITEURL.'Admin/manage-order.php');
             }
             else{
                //Failed to update
                $_SESSION['update'] = "<div class='danger'>Failed To Update Order</div>";
                header("location:".$SITEURL.'Admin/manage-order.php');

             }
            
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php')?>