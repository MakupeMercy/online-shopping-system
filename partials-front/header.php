
<?php include('config/db-connect.php')?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="fashion-front.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almasi Beauty And Fashion Shop</title>

    
</head>
<body>

    <!-- NavBar Code -->
    <nav class="navbar">
        <div class="burger">
            <div class="layer1"></div>
            <div class="layer2"></div>
            <div class="layer3"></div>
        </div>

        <div class="logo">
            <span class="logo-text"> <i class="fa fa-book" style="margin-right: 0.1em;"></i>Almasi
            <span style="color:#f09d51; font-size: 1.1em;">Fashion & Beauty</span></span>
        </div>

        <div class="menubar">
            <ul class="list">
                <li class="list-items"><a href="<?php echo $SITEURL;?>index.php">Home</a></li>
                <li class="list-items"><a href="<?php echo $SITEURL;?>categories.php">Categories</a></li>
                <li class="list-items"><a href="<?php echo $SITEURL?>products.php">Products</a></li>
                <li class="list-items"><a href="#">Contact</a></li>
            </ul>
        </div>

        <div class="cart">
            <i class="fa fa-shopping-cart fa-1x"></i>
            <div class="number-of-items"><span class="noi">0</span></div>
        </div>
    </nav>