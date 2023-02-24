<?php  include('../config/db-connect.php')?>
<html>
    <head>
        <title>Login Fashion and Beauty System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
    
        <div class="login  text-center">
            <br><br>
            <h1>LOGIN</h1>
            <br>
            <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['not-login'])){
                echo $_SESSION['not-login'];
                unset($_SESSION['not-login']);
            }

            ?>
            <br>
                <!-- Login form starts here -->
            <form action="" method="POST">
                Username:
                <input type="text" name="username" placeholder="Enter Username">
                <br><br>

                Password:
                <input type="password" name="password" placeholder="Enter Password">
                <br><br>

                <input type="submit" name="submit" value="Login" class="btn-login">
            </form>
            <br><br>
            <!-- login form ends here -->
            <p>Created by: <a href="">Mercy Mnyazi</a></p>
        </div>
    </body>
</html>

<?php
//check whether the submit button is clicked
if(isset($_POST['submit'])){
    //Get data from form
  $username = $_POST['username'];
   $password = md5($_POST['password']);

    //Create an sql query to  check whether username and password exists or not
    $sql = "SELECT * FROM `tbl_admin` WHERE username ='$username' AND password ='$password'";

    //execute the query
    $query_Exec = mysqli_query($con,$sql);

    //Check if the query execute successfuly
    
        //count rows
        $numRows = mysqli_num_rows($query_Exec);
        if($numRows==1){
            //User available
            $_SESSION['login']= "<div class='success'> Login Successful</div>";

            $_SESSION['user'] = $username;//To check whether user is logged in or not logout will unset it
            //redirect to home page/index
            header('location:'.$SITEURL.'Admin/index.php');
        }
        else{
            //User not available
            $_SESSION['login']= "<div class='danger text-center'> Username or Password Incorrect</div>";
            //redirect to home page/index
            header('location:'.$SITEURL.'Admin/login.php');
        }
    }


?>
