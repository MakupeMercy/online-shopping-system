
        <?php include("partials/header.php")?> 
        <!-- main content section starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1><strong>DASHBOARD</strong></h1>
                <br><br>
                <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                ?>
                    <br><br>
                <div class="col-4 text-center">
                    <?php
                    $sql = "SELECT * FROM tbl_category";
                    //execute query
                    $query_exec = mysqli_query($con,$sql);
                    //count rows
                    $numRows = mysqli_num_rows($query_exec);
                    ?>
                    <h1 style="color:peru"><?php echo $numRows;?></h1>
                    <br>
                    Categories
                </div>
                

                <div class="col-4 text-center">

                        <?php
                            $sql2 = "SELECT * FROM tbl_product";
                            //execute query
                            $query_exec2 = mysqli_query($con,$sql2);
                            //count rows
                            $numRows2 = mysqli_num_rows($query_exec2);
                        ?>
                    <h1 style="color:peru"><?php echo $numRows2?></h1>
                    <br>
                    Products
                </div>
                

                <div class="col-4 text-center">
                        <?php
                            $sql3 = "SELECT * FROM tbl_order";
                            //execute query
                            $query_exec3 = mysqli_query($con,$sql3);
                            //count rows
                            $numRows3 = mysqli_num_rows($query_exec3);
                        ?>

                    <h1 style="color:peru"><?php echo $numRows3?></h1>
                    <br>
                    Total Orders
                </div>
                

                <div class="col-4 text-center">
                    <?php
                    //get the revenue
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                    //execute query
                    $query_exec4 = mysqli_query($con,$sql4);

                    $row4 = mysqli_fetch_assoc($query_exec4);

                    //get the total revenue
                    $total_revenue = $row4['Total'];
                    ?>
                    <h1 style="color:peru">Ksh.<?php echo $total_revenue;?></h1>
                    <br>
                    Revenue Generated
                </div>

                <div class="clearfix"></div>
            </div>

           
        </div>

        <!-- main content section ends -->
        
     <?php  include("partials/footer.php")?>   
