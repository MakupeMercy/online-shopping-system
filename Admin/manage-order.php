<?php include("partials/header.php")?> 
        <!-- main content section starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1><strong>Manage Order</strong></h1>

                <!-- button to add order -->
                
                <br><br>
                <?php 
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                ?>
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Get all the data from the database
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC ";

                        //execuet query
                        $query_exec = mysqli_query($con, $sql);
                        //count the rows
                        $numRows = mysqli_num_rows($query_exec);

                        //create serial number
                        $sn =1;

                        //check whethr order is availableor not
                        if($numRows>0){
                            //order available  
                            while($row = mysqli_fetch_assoc($query_exec)){
                                //Get the details
                                $id = $row['id'];
                                $product = $row['product'];
                                $price = $row['price'];
                                $quantity = $row['quantity'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];

                                ?>
                                
                                    <tr>
                                        <td style="padding: 15px;"><?php echo $sn++?></td>
                                        <td style="padding: 15px;"><?php echo $product?></td>
                                        <td style="padding: 15px;"><?php echo $price?></td>
                                        <td style="padding: 10px;"><?php echo $quantity?></td>
                                        <td style="padding: 10px;"><?php echo $total?></td>
                                        <td style="padding: 20px;"><?php echo $order_date?></td>


                                        <td style="padding: 10px;" >
                                        <?php 
                                        if($status=='Ordered'){
                                            echo  "<label>$status</label>";
                                        }
                                        elseif($status=='On Delivery'){
                                            echo  "<label style='color:blue'>$status</label>";
                                        }
                                        elseif($status=='Delivered'){
                                            echo  "<label style='color:green'>$status</label>";
                                        }
                                        elseif($status=='Cancelled'){
                                            echo  "<label style='color:red'>$status</label>";
                                        }
                                        ?>
                                    </td>


                                        <td style="padding: 20px;"><?php echo $customer_name?></td>
                                        <td style="padding: 10px;"><?php echo $customer_contact?></td>
                                        <td style="padding: 10px;"><?php echo $customer_email?></td>
                                        <td style="padding: 10px;"><?php echo $customer_address?></td>
                                        
                                         <td style="padding: 10px;">
                                        <button class="btn-secondary" style="padding: 5px 20px;">
                                            <a href="<?php $SITEURL;?>update-order.php?id=<?php echo $id;?>">Update Order</a>
                                        </button>
                                        </td>
                                        
                                    </tr>

                                <?php
                            }                      
                        }
                        else{
                            //order not available
                            echo "<tr><td colspan='12' class='danger'> No Order Available</td></td>";
                        }

                    
                    ?>
                    
                </table>

            </div>
        </div>

        <!-- main content section ends -->
        
     <?php  include("partials/footer.php")?>   
